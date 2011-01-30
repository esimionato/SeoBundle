<?php

namespace Bundle\SeoBundle\Renderer;

use Bundle\SeoBundle\Meta as ItemToRender;
use Bundle\SeoBundle\Renderer\RendererInterface as BaseInterface;

class Html5CharsetRenderer implements BaseInterface
{
    public function render(ItemToRender $item)
    {
        $html = '<meta charset="'.$item->getContent().'" />';

        return $html;
    }
}
