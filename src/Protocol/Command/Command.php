<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Protocol\Command;

/**
 * Class Command
 */
class Command implements CommandInterface
{
    /**
     * @var int|null
     */
    public ?int $id;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var array
     */
    public array $payload;

    /**
     * Command constructor.
     *
     * @param string $name
     * @param array $payload
     * @param int|null $id
     */
    public function __construct(string $name, array $payload, int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->payload = $payload;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }
}
