<?php

namespace Bundle\SeoBundle;

use Symfony\Component\DependencyInjection\ContainerInterface as BaseContainer;
use Bundle\SeoBundle\Renderer\RendererInterface as BaseInterface;
use Bundle\SeoBundle\Renderer\Renderer as BaseRenderer;
use Bundle\SeoBundle\Renderer\HttpEquivRenderer;
use Bundle\SeoBundle\Renderer\Html5CharsetRenderer;
use Bundle\SeoBundle\Renderer\TitleRenderer;

class Meta
{
    protected $name;
    protected $content;
    protected $renderer;
    protected $container;

    public function __construct(BaseContainer $container, $name)
    {
        $this->container = $container;
        $this->setName($name);
        $this->setContent('');
        
        // sets the right renderer for httpequiv meta
        if('title' === $this->getName())
        {
            $this->setRenderer(new TitleRenderer());
        }
        
        // sets the right renderer for httpequiv meta
        if(false !== strstr($this->getName(), 'content'))
        {
            $this->setRenderer(new HttpEquivRenderer());
        }
        
        // sets the right renderer for html5 charset
        if('charset' === $this->getName())
        {
            $this->setRenderer(new Html5CharsetRenderer());
        }
        
        $currentRoute = $this->container->get('request')->get('_route');
        
        // looking for defined routes current route from config
        // override if current route is configured
        if($this->container->hasParameter('seo.routing'))
        {
            $routing = $this->container->getParameter('seo.routing');
            if (isset($routing[$currentRoute])) 
            {
                $route = $routing[$currentRoute];
                
                if(isset($route[$this->getName()]))
                {
                    $this->setContent($route[$this->getName()]);
                }
            }
        }
        
        // setting for defaults from config
        if ('' === $this->getContent() && $this->container->hasParameter('seo.defaults')) 
        {
            $route = $this->container->getParameter('seo.defaults');
            if(isset($route[$this->getName()]))
            {
                $this->setContent($route[$this->getName()]);
            }
        }
    }

    /**
     * Gets the name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * @param string
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the content
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content
     * @param string
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setRenderer(BaseInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Gets renderer which is used to render items.
     *
     * @return Renderer $renderer Renderer.
     */
    public function getRenderer()
    {
        if(null === $this->renderer) {
            $this->setRenderer(new BaseRenderer());
        }

        return $this->renderer;
    }

    /*
     * Renders the meta element
     */
    public function render()
    {
        return $this->getRenderer()->render($this);
    }
}

