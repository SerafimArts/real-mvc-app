<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Protocol\Command;

use Kernel\Event\Handler;

/**
 * Class Listen
 */
class Listen extends Command implements ProceedCommandInterface
{
    /**
     * @var string
     */
    public const NAME = 'listen';

    /**
     * Listen constructor.
     *
     * @param Handler $handler
     * @param int|null $id
     */
    public function __construct(Handler $handler, int $id = null)
    {
        parent::__construct(self::NAME, [
            'id'    => $handler->id,
            'event' => $handler->name,
        ], $id);
    }
}
