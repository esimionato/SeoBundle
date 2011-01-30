<?php

namespace Bundle\SeoBundle\Twig;

class SeoNode extends \Twig_Node
{
    /**
     * @param \Twig_NodeInterface $value
     * @param integer $lineno
     * @param string $tag (optional)
     * @return void
     */
    public function __construct(\Twig_NodeInterface $value, $lineno, $tag = null)
    {
        parent::__construct(array('value' => $value), array(), $lineno, $tag);
    }

    /**
     * @param \Twig_Compiler $compiler
     * @return void
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

       $compiler
            ->write("echo \$this->env->getExtension('".$this->getName()."')->render(")
            ->subcompile($this->getNode('value'))
            ->raw(");\n");
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'seo';
    }
}
