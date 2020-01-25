<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Model;

/**
 * Trait Observable
 */
trait Observable
{
    /**
     * @var array|\Closure[]
     */
    private array $onChange = [];

    /**
     * @var array|\Closure[]
     */
    private array $onRead = [];

    /**
     * @var array
     */
    private array $attributes = [];

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->attributes;
    }

    /**
     * @return void
     */
    protected function bootObservableTrait(): void
    {
        $reflection = new \ReflectionObject($this);

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $this->attributes[$name = $property->getName()] = $property->getValue($this);

            unset($this->$name);
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    private function read(string $name)
    {
        if (isset($this->onRead[$name])) {
            $this->onRead[$name]($name);
        }

        return $this->attributes[$name] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    private function write(string $name, $value): void
    {
        if (isset($this->onChange[$name])) {
            $this->onChange[$name]($value, $name);
        }

        $this->attributes[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->read($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $this->write($name, $value);
    }

    /**
     * @param string $prop
     * @param \Closure $handler
     * @return void
     */
    public function onChange(string $prop, \Closure $handler): void
    {
        $this->onChange[$prop] = $handler;
    }

    /**
     * @param string $prop
     * @param \Closure $handler
     * @return void
     */
    public function onRead(string $prop, \Closure $handler): void
    {
        $this->onRead[$prop] = $handler;
    }
}
