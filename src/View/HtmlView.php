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
 * Class View
 */
class HtmlView implements ViewInterface
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @var array|string[]|int[]|float[]|bool[]
     */
    protected array $attributes = [];

    /**
     * @var array|ViewInterface[]
     */
    protected array $children = [];

    /**
     * HtmlView constructor.
     *
     * @param string $name
     * @param iterable|string[]|int[]|float[]|bool[] $attributes
     * @param iterable $children
     */
    public function __construct(string $name, iterable $attributes, iterable $children = [])
    {
        $this->name = $name;

        foreach ($attributes as $attribute => $value) {
            $this->attributes[$attribute] = $value;
        }

        foreach ($children as $child) {
            $this->children[] = $child;
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $tag = '<' . $this->name;

        foreach ($this->attributes as $name => $value) {
            if (\is_scalar($value)) {
                $tag .= ' ' . \htmlspecialchars($name) . '="' . \htmlspecialchars((string)$value) . '"';
            }
        }

        if ($this->children) {
            $tag .= '>';

            foreach ($this->children as $child) {
                $tag .= (string)$child;
            }

            return $tag . '<' . $this->name . '>';
        }

        return $tag . ' />';
    }
}
