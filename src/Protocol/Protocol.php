<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Protocol;

use Kernel\Protocol\Command\CommandInterface;

/**
 * Class Protocol
 */
abstract class Protocol implements ProtocolInterface
{
    /**
     * @param CommandInterface $command
     * @return array
     */
    protected function toArray(CommandInterface $command): array
    {
        return [
            'id'   => $command->getId(),
            'name' => $command->getName(),
            'data' => $command->getPayload(),
        ];
    }
}
