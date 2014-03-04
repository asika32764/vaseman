<?php
/**
 * Part of the Vaseman Prototype System files.
 *
 * @copyright  Copyright (C) 2013 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace View;

/**
 * Class Page
 *
 * @package View
 */
class Page extends \Slim\View
{
    protected $twig;
    
    /**
     * Constructor
     */
    public function getTwig()
    {
        if($this->twig)
        {
            return $this->twig;
        }
        
        $loader = new \Twig_Loader_Filesystem($this->getTemplatesDirectory());
        $loader->addPath(PROTOTYPE_ROOT . '/src/Template');
        
        $twig = new \Twig_Environment($loader);
        
        return $this->twig = $twig;
    }
    
    /**
     * Render a template file
     *
     * NOTE: This method should be overridden by custom view subclasses
     *
     * @param  string $template     The template pathname, relative to the template base directory
     * @param  array  $data         Any additonal data to be passed to the template.
     * @return string               The rendered template
     * @throws \RuntimeException    If resolved template pathname is not a valid file
     */
    public function render($template, $data = null)
    {
        $twig = $this->getTwig();
        
        return $twig->render($template . '.twig', $this->data->all());
    }
}
