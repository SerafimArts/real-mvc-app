<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\Reader;
use Kernel\Controller\ControllerInterface;
use Kernel\Event\Event;
use Kernel\Event\Handler;
use Kernel\Protocol\Command\IncomingCommandInterface;
use Kernel\Protocol\Command\Listen;
use Kernel\Protocol\Command\Render;
use Kernel\Reader\ControllerReader;
use Kernel\Reader\ModelReader;

/**
 * Class Context
 */
class Context
{
    /**
     * @var ControllerInterface
     */
    private ControllerInterface $controller;

    /**
     * @var ControllerReader
     */
    private ControllerReader $handlers;

    /**
     * @var ModelReader
     */
    private ModelReader $models;

    /**
     * @var Client
     */
    private Client $client;

    /**
     * Context constructor.
     *
     * @param Client $client
     * @param ControllerInterface $controller
     * @param Reader $reader
     * @throws AnnotationException
     */
    public function __construct(Client $client, ControllerInterface $controller, Reader $reader)
    {
        $this->client = $client;
        $this->controller = $controller;

        $this->models = new ModelReader($client, $controller->getModel(), $reader);

        $this->handlers = new ControllerReader($client, $this->models, $controller, $reader);
    }

    /**
     * @return void
     */
    public function apply(): void
    {
        $this->client->send(new Render($this->controller, $this->client->getId()));

        /** @var Handler $handler */
        foreach ($this->handlers->getEventHandlers() as $handler) {
            $this->client->send(new Listen($handler, $this->client->getId()));
        }
    }

    /**
     * @param Event $event
     * @return void
     */
    public function emit(Event $event): void
    {
        $this->handlers->emit($event);
    }

    /**
     * @return ControllerInterface
     */
    public function getController(): ControllerInterface
    {
        return $this->controller;
    }
}
