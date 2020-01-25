<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\View;

/**
 * Class TextView
 */
class HtmlTextView implements ViewInterface
{
    /**
     * @var string
     */
    private string $text;

    /**
     * HtmlTextView constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->text;
    }
}
