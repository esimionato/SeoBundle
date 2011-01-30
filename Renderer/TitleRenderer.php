<?php

namespace Bundle\SeoBundle\Renderer;

use Bundle\SeoBundle\Meta as ItemToRender;
use Bundle\SeoBundle\Renderer\RendererInterface as BaseInterface;

class TitleRenderer implements BaseInterface
{
    public function render(ItemToRender $item)
    {
        $html = '<title>'.$item->getContent().'</title>';

        return $html;
    }
}
