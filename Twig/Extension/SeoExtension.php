<?php

namespace Bundle\SeoBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Bundle\SeoBundle\Twig\SeoTokenParser as BaseTokenParser;
use Bundle\SeoBundle\Meta;

class SeoExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $items = array();

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @return void
     */
    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
        
        $this->items = $this->container->getParameter('seo.services');
    }

    /**
     * @return array
     */
    public function getTokenParsers()
    {
        return array(
            // {% seo "type" %}
            new BaseTokenParser(),
        );
    }

    /**
     * @param string $name
     * @return \Bundle\EaseSeoBundle\??
     * @throws \InvalidArgumentException
     */
    public function get($name)
    {
        if (!isset($name)) {
            throw new \InvalidArgumentException(sprintf('The '.$this->getName().' "%s" is not defined.', $name));
        }
        $object = $name;
        if (is_string($name))
        {
            $object = $this->container->get($this->items[$name]);
        }
        
        return $object;
    }

    /**
     * @param string $name
     * @return string
     */
    public function render($name)
    {
        return $this->get($name)->render();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'seo';
    }
}
