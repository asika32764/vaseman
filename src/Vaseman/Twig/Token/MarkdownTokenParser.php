<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Twig\Token;

use Twig_Error_Syntax;
use Twig_NodeInterface;
use Twig_Token;

/**
 * The MarkdownTokenParser class.
 *
 * @since  {DEPLOY_VERSION}
 */
class MarkdownTokenParser extends \Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token A Twig_Token instance
     *
     * @return Twig_NodeInterface A Twig_NodeInterface instance
     *
     * @throws Twig_Error_Syntax
     */
    public function parse(Twig_Token $token)
    {
        $lineno = $token->getLine();
        $parser = $this->parser;
        $stream = $parser->getStream();

        $stream->expect(Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideBlockEnd'], true);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        return new MarkdownNode($body, $lineno, $this->getTag());
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'markdown';
    }

    public function decideBlockEnd(Twig_Token $token)
    {
        return $token->test('endmarkdown');
    }
}
