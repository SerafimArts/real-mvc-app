<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Protocol;

use Kernel\Protocol\Command\IncomingCommandInterface;
use Kernel\Protocol\Command\ProceedCommandInterface;

/**
 * Interface ProtocolInterface
 */
interface ProtocolInterface
{
    /**
     * @param ProceedCommandInterface $command
     * @return string
     */
    public function encode(ProceedCommandInterface $command): string;

    /**
     * @param string $data
     * @return IncomingCommandInterface
     */
    public function decode(string $data): IncomingCommandInterface;
}
