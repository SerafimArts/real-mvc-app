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
 * Class Event
 */
class Event
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var array
     */
    private array $payload;

    /**
     * Event constructor.
     *
     * @param string $id
     * @param string $name
     * @param array $payload
     */
    public function __construct(string $id, string $name, array $payload)
    {
        $this->id = $id;
        $this->name = $name;
        $this->payload = $payload;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->payload[$name] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
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
