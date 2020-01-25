<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Protocol;

use Kernel\Protocol\Command\GenericIncomingMessage;
use Kernel\Protocol\Command\IncomingCommandInterface;
use Kernel\Protocol\Command\ProceedCommandInterface;

/**
 * Class JsonProtocol
 */
class JsonProtocol extends Protocol
{
    /**
     * @param ProceedCommandInterface $command
     * @return string
     */
    public function encode(ProceedCommandInterface $command): string
    {
        return \json_encode($this->toArray($command), \JSON_THROW_ON_ERROR);
    }

    /**
     * @param string $data
     * @return IncomingCommandInterface
     */
    public function decode(string $data): IncomingCommandInterface
    {
        $payload = \json_decode($data, true, 512, \JSON_THROW_ON_ERROR);

        return new GenericIncomingMessage(
            $payload['name'] ?? 'unknown',
            $payload['data'] ?? [],
            $payload['id'] ?? null
        );
    }
}
