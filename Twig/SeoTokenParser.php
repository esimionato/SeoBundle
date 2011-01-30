<?php

namespace Bundle\SeoBundle\Twig;

use Bundle\SeoBundle\Twig\SeoNode as BaseNode;

class SeoTokenParser extends \Twig_TokenParser
{
    /**
     * @param \Twig_Token  $token
     * @return \Bundle\MenuBundle\Twig\MenuNode
     * @throws \Twig_SyntaxError
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        
        $stream = $this->parser->getStream();

        $value = $this->parser->getExpressionParser()->parseExpression();

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new BaseNode($value, $lineno, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'seo';
    }
}
