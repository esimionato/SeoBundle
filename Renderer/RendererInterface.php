<?php

namespace Bundle\SeoBundle\Renderer;

use Bundle\SeoBundle\Meta as ItemToRender;

interface RendererInterface
{
  /**
   * Renders meta tag.
   *
   * @param ItemToRender    $item   Meta tag
   *
   * @return string
   */
  public function render(ItemToRender $item);
}
