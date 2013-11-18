<?php

namespace View;

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
     * @var    string $template     The template pathname, relative to the template base directory
     * @return string               The rendered template
     * @throws \RuntimeException    If resolved template pathname is not a valid file
     */
    public function render($template)
    {
        $twig = $this->getTwig();

	    if (!is_file(PROTOTYPE_ROOT . '/templates/' . $template . '.twig'))
	    {
		    $template = $template . '/index';
	    }
        
        return $twig->render($template . '.twig', $this->data->all());
    }
}