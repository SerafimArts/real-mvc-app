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
use Kernel\Protocol\Command\IncomingCommandInterface;
use Kernel\Protocol\Command\ProceedCommandInterface;
use Railt\Container\Container;
use Ratchet\ConnectionInterface;

/**
 * Class Client
 */
class Client extends Container
{
    /**
     * @var int
     */
    private int $counter = 0;

    /**
     * @var Application
     */
    private Application $app;

    /**
     * @var ConnectionInterface
     */
    private ConnectionInterface $conn;

    /**
     * @var Context|null
     */
    private ?Context $context = null;

    /**
     * Client constructor.
     *
     * @param Application $app
     * @param ConnectionInterface $conn
     */
    public function __construct(Application $app, ConnectionInterface $conn)
    {
        parent::__construct($app);

        $this->app = $app;
        $this->conn = $conn;

        $this->boot();
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        $this->instance(self::class, $this);

        $this->register(ConnectionInterface::class, function () {
            return $this->conn;
        });
    }

    /**
     * @return Application
     */
    public function app(): Application
    {
        return $this->app;
    }

    /**
     * @param string|ControllerInterface|object $controller
     * @return void
     * @throws AnnotationException
     */
    public function show($controller): void
    {
        if (\is_string($controller)) {
            $controller = $this->make($controller);
        }

        $this->context = new Context($this, $controller, $this->make(Reader::class));
        $this->context->apply();
    }

    /**
     * @param ProceedCommandInterface $command
     * @return void
     */
    public function send(ProceedCommandInterface $command): void
    {
        $this->app->send($this->conn, $command);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->counter++;
    }

    /**
     * @param IncomingCommandInterface $command
     * @return void
     */
    public function fire(IncomingCommandInterface $command): void
    {
        if ($this->context && $command->getName() === 'listen') {
            $this->context->emit($this->createEvent($command));
        }
    }

    /**
     * @param IncomingCommandInterface $command
     * @return Event
     */
    private function createEvent(IncomingCommandInterface $command): Event
    {
        // TODO Capture errors
        $payload = $command->getPayload();

        return new Event($payload['id'] ?? '',
            $payload['event'] ?? 'unknown',
            $payload['payload'] ?? []
        );
    }
}
