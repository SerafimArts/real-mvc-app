<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Reader;

use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Kernel\Client;
use Kernel\Controller\ControllerInterface;
use Kernel\Event\Event;
use Kernel\Event\Handler;
use Kernel\Model\ModelInterface;

/**
 * Class ControllerReader
 */
class ControllerReader
{
    /**
     * @var string
     */
    private const KEY_EVENT = 'event';

    /**
     * @var string
     */
    private const KEY_HANDLER = 'handler';

    /**
     * @var array
     */
    private array $events = [];

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var ModelReader
     */
    private ModelReader $models;

    /**
     * EventHandlers constructor.
     *
     * @param Client $client
     * @param ModelReader $models
     * @param ControllerInterface $controller
     * @param Reader|null $reader
     * @throws AnnotationException
     */
    public function __construct(
        Client $client,
        ModelReader $models,
        ControllerInterface $controller,
        Reader $reader = null
    ) {
        $this->client = $client;
        $this->models = $models;

        $this->bootEvents($controller, $reader ?? new AnnotationReader());
    }

    /**
     * @param ControllerInterface $controller
     * @param Reader $reader
     * @return void
     */
    private function bootEvents(ControllerInterface $controller, Reader $reader): void
    {
        foreach ($this->getMethodEvents($controller, $reader) as $annotation => $callback) {
            $this->events[] = [
                self::KEY_EVENT   => $annotation,
                self::KEY_HANDLER => $callback,
            ];
        }
    }

    /**
     * @param ControllerInterface $controller
     * @param Reader $reader
     * @return iterable
     */
    private function getMethodEvents(ControllerInterface $controller, Reader $reader): iterable
    {
        $reflection = new \ReflectionObject($controller);

        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $fn = $method->getClosure($controller);

            foreach ($reader->getMethodAnnotations($method) as $annotation) {
                if ($annotation instanceof Handler) {
                    yield $annotation => $fn;
                }
            }
        }
    }

    /**
     * @return iterable|Handler[]
     */
    public function getEventHandlers(): iterable
    {
        foreach ($this->events as [self::KEY_EVENT => $event]) {
            yield $event;
        }
    }

    /**
     * @param Event $event
     * @return void
     */
    public function emit(Event $event): void
    {
        $model = $this->models->getById($event->getId());

        if ($model === null) {
            return;
        }

        /** @var Handler $handler */
        foreach ($this->getHandlersByEvent($event) as $handler => $callback) {
            $this->call($callback, $model, $event, $handler);
        }
    }

    /**
     * @param Event $event
     * @return iterable|\Closure[]
     */
    private function getHandlersByEvent(Event $event): iterable
    {
        /**
         * @var Handler $handler
         * @var \Closure $fn
         */
        foreach ($this->events as [self::KEY_EVENT => $handler, self::KEY_HANDLER => $fn]) {
            if ($event->getId() === $handler->id && $event->getName() === $handler->name) {
                yield $handler => $fn;
            }
        }
    }

    /**
     * @param \Closure $callback
     * @param ModelInterface $model
     * @param Event $event
     * @param Handler $handler
     * @return void
     */
    private function call(\Closure $callback, ModelInterface $model, Event $event, Handler $handler): void
    {
        $this->client->call($callback, [
            \get_class($model)    => $model,
            \get_class($handler)  => $handler,
            ModelInterface::class => $model,
            Handler::class        => $handler,
            Event::class          => $event,
        ]);
    }
}
