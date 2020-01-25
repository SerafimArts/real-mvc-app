<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Event;

/**
 * @Annotation
 */
class OnMouseEnter extends Handler
{
    /**
     * @var string
     */
    public string $name = 'mouseenter';
}
