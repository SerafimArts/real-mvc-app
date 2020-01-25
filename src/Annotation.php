<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel;

/**
 * Class Annotation
 */
abstract class Annotation
{
    /**
     * @var string
     */
    protected const DOCTRINE_DEFAULT_KEY = 'value';

    /**
     * EventHandler constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if ($key === self::DOCTRINE_DEFAULT_KEY) {
                $key = $this->getDefaultAttribute();
            }

            $this->$key = $value;
        }
    }

    /**
     * @return string
     */
    abstract public function getDefaultAttribute(): string;
}
