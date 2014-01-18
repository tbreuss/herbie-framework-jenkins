<?php

namespace Herbie\Twig;

use GeSHi;
use Twig_Compiler;
use Twig_Node;
use Twig_NodeInterface;

class HighlightNode extends Twig_Node
{
    /**
     * @param array $name
     * @param Twig_NodeInterface $body
     * @param int $lineno
     * @param string $tag
     */
    public function __construct($name, Twig_NodeInterface $body, $lineno, $tag = 'spaceless')
    {
        parent::__construct(['body' => $body], ['name' => $name], $lineno, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param Twig_Compiler A Twig_Compiler instance
     */
    public function compile(Twig_Compiler $compiler)
    {
        $source = trim($this->getNode('body')->getAttribute('data'));
        $name = $this->getAttribute('name');

        $geshi = new GeSHi($source, $name);
        $geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);

        $parsedCode = sprintf('<div class="highlight highlight-%s">%s</div>',
            $name,
            $geshi->parse_code()
        );

        $compiler
            ->addDebugInfo($this)
            ->write('echo ')
            ->string($parsedCode)
            ->raw(";\n");
    }
}
