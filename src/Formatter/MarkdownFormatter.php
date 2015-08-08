<?php

/**
 * This file is part of Herbie.
 *
 * (c) Thomas Breuss <www.tebe.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Herbie\Formatter;

use Parsedown;

class MarkdownFormatter implements FormatterInterface
{
    /**
     * @param string $value
     * @return string
     */
    public function transform($value)
    {
        $parser = new Parsedown();
        return $parser->text($value);
    }
}
