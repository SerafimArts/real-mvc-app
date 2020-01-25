<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Model;

use Kernel\View\ViewInterface;

/**
 * Interface ModelInterface
 */
interface ModelInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return ViewInterface
     */
    public function getView(): ViewInterface;

    /**
     * @return array
     */
    public function getProperties(): array;

    /**
     * @param string $prop
     * @param \Closure $handler
     * @return mixed
     */
    public function onChange(string $prop, \Closure $handler): void;

    /**
     * @param string $prop
     * @param \Closure $handler
     * @return void
     */
    public function onRead(string $prop, \Closure $handler): void;
}
