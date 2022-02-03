<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace App\Processor;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use App\Exception\NoConfigException;
use App\Processor\Helper\ProcessorHelper;
use Windwalker\Data\Collection;
use Windwalker\Event\Event;
use Windwalker\Filesystem\FileObject;

/**
 * The AbstractFileProcessor class.
 *
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractFileProcessor
{
    protected array $data = [];

    protected string $output;

    protected Collection $config;

    protected string $target;

    public function __construct(protected FileObject $file, protected string $root, protected string $folder)
    {
        if (!is_dir($this->root)) {
            throw new \RuntimeException('Path: ' . $root . ' not exists.');
        }

        $this->config = new Collection();
    }

    public static function getInstance(string $type, FileObject $file, string $root = '', string $folder = ''): static
    {
        $class = sprintf(__NAMESPACE__ . '\%sProcessor', ucfirst($type));

        if (!class_exists($class)) {
            return new GeneralProcessor($file, $root, $folder);
        }

        return new $class($file, $root, $folder);
    }

    /**
     * render
     *
     * @return  string
     */
    abstract public function render(): string;

    /**
     * extractConfig
     *
     * @param  string  $template
     *
     * @return  string
     */
    public function prepareData(string $template): string
    {
        $templateParts = explode('---', $template, 3);

        // URI
        $uri = Ioc::get('view.data.uri');

        $this->config->merge(Ioc::getConfig()->toArray());

        try {
            if (\count($templateParts) !== 3) {
                throw new NoConfigException('No config');
            }

            $config = Yaml::parse($templateParts[1]);
            $this->config->load($config);

            if ($config) {
                array_shift($templateParts);
                array_shift($templateParts);
            }

            // Target permalink
            if ($this->config->get('permalink')) {
                $this->target = rtrim($this->config->get('permalink'), '/');

                if (substr($this->target, -5) !== '.html') {
                    $this->target .= '/index.html';
                }

                $uri['base']  = ProcessorHelper::getBackwards($this->target) ?: '.';
                $uri['asset'] = ProcessorHelper::getBackwards($this->target) . 'asset';
            } else {
                $this->target = $this->getTarget();
            }

            $template = implode('---', $templateParts);
        } catch (ParseException $e) {
            $template = implode('---', $templateParts);
        } catch (NoConfigException $e) {
            $template = implode('---', $templateParts);
        }

        $this->data->bind(['config' => $this->config]);
        $this->data->uri   = $uri;
        $this->data->paths = Ioc::get('view.data.path');

        $event              = new Event('loadProvider');
        $event['data']      = $this->data;
        $event['processor'] = $this;

        $dispatcher = Ioc::getDispatcher();
        $dispatcher->triggerEvent($event);

        return $template;
    }

    /**
     * Method to get property Target
     *
     * @return  string
     */
    public function getTarget()
    {
        if (!$this->target) {
            $this->target = rtrim($this->getFolder(), '\\/') . DIRECTORY_SEPARATOR . ltrim($this->getLayout(), '\\/');
        }

        return $this->target;
    }

    /**
     * Method to set property target
     *
     * @param   string $target
     *
     * @return  static  Return self to support chaining.
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Method to get property Folder
     *
     * @return  string
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Method to set property folder
     *
     * @param   string $folder
     *
     * @return  static  Return self to support chaining.
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * getLayout
     *
     * @return  string
     */
    public function getLayout()
    {
        return trim(str_replace($this->getRoot(), '', $this->file->getPathname()), '/\\');
    }

    /**
     * Method to get property Root
     *
     * @return  string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Method to set property root
     *
     * @param   string $root
     *
     * @return  static  Return self to support chaining.
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Method to get property Data
     *
     * @return  Data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Method to set property data
     *
     * @param   Data $data
     *
     * @return  static  Return self to support chaining.
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Method to get property Output
     *
     * @return  string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Method to set property output
     *
     * @param   string $output
     *
     * @return  static  Return self to support chaining.
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Method to get property Config
     *
     * @return  Structure
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Method to set property config
     *
     * @param   Structure $config
     *
     * @return  static  Return self to support chaining.
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * __get
     *
     * @param string $name
     *
     * @return  Structure
     */
    public function __get($name)
    {
        if ($name == 'config') {
            return $this->config;
        }

        return null;
    }
}
