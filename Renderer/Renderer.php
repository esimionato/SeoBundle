<?php

namespace Bundle\SeoBundle\Renderer;

use Bundle\SeoBundle\Meta as ItemToRender;
use Bundle\SeoBundle\Renderer\RendererInterface as BaseInterface;

class Renderer implements BaseInterface
{
    public function render(ItemToRender $item)
    {
        $html = '<meta name="'.$item->getName().'" content="'.$item->getContent().'" />';

        return $html;
    }
}
