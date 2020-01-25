<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Event;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;
use Kernel\Annotation;

/**
 * @Target({"METHOD"})
 */
abstract class Handler extends Annotation
{
    /**
     * @Required()
     * @var string
     */
    public string $id;

    /**
     * @Required()
     * @var string
     */
    public string $name;

    /**
     * @return string
     */
    public function getDefaultAttribute(): string
    {
        return 'id';
    }
}
