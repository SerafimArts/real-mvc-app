<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel;

use App\Controller\ExampleController;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Kernel\Controller\ControllerInterface;
use Kernel\Protocol\Command\ProceedCommandInterface;
use Kernel\Protocol\ProtocolInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Railt\Container\Container;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\Server\IoConnection;
use Ratchet\WebSocket\WsConnection;

/**
 * Class Application
 */
class Application extends Container implements MessageComponentInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var array|Client[]
     */
    protected array $clients = [];

    /**
     * @var ProtocolInterface
     */
    private ProtocolInterface $protocol;

    /**
     * @var array|ControllerInterface[]
     */
    private array $controllers = [];

    /**
     * Application constructor.
     *
     * @param ProtocolInterface $protocol
     * @param LoggerInterface|null $logger
     */
    public function __construct(ProtocolInterface $protocol, LoggerInterface $logger = null)
    {
        $this->protocol = $protocol;

        $this->setLogger($logger ?? new NullLogger());

        $this->boot();

        parent::__construct();
    }

    /**
     * @return void
     */
    private function boot(): void
    {
        $this->instance(self::class, $this);

        $this->register(Reader::class, static function () {
            return new AnnotationReader();
        });
    }

    /**
     * @param string|ControllerInterface[] $controller
     * @return $this
     */
    public function addController(string $controller): self
    {
        $this->controllers[] = $controller;

        return $this;
    }

    /**
     * @param string $message
     * @param array $data
     * @return void
     */
    public function info(string $message, array $data = []): void
    {
        $this->logger->info($message, $data);
    }

    /**
     * @param Server $server
     * @return void
     */
    public function run(Server $server): void
    {
        $this->logger->info('Starting application at ' . $server->getHost() . ':' . $server->getPort());

        $server->run($this);
    }

    /**
     * @param ConnectionInterface|WsConnection|IoConnection $connection
     * @return void
     */
    public function onOpen(ConnectionInterface $connection): void
    {
        $id = $this->getId($connection);

        $this->logger->debug('Connection established #' . $id);

        $this->clients[$id] = new Client($this, $connection);

        // TODO
        $this->clients[$id]->show(ExampleController::class);
    }

    /**
     * @param ConnectionInterface|mixed $connection
     * @return int
     */
    private function getId(ConnectionInterface $connection): int
    {
        try {
            return (int)$connection->resourceId;
        } catch (\Throwable $e) {
            return 0;
        }
    }

    /**
     * @param ConnectionInterface $connection
     * @param ProceedCommandInterface $command
     * @return void
     */
    public function send(ConnectionInterface $connection, ProceedCommandInterface $command): void
    {
        $connection->send($this->protocol->encode($command));
    }

    /**
     * @param ConnectionInterface|WsConnection|IoConnection $connection
     * @return void
     */
    public function onClose(ConnectionInterface $connection): void
    {
        $id = $this->getId($connection);

        $this->logger->debug('Connection closed #' . $id);

        unset($this->clients[$id]);
    }

    /**
     * @param ConnectionInterface|WsConnection|IoConnection $connection
     * @param \Exception $e
     * @return void
     */
    public function onError(ConnectionInterface $connection, \Exception $e): void
    {
        $this->logger->error('Connection error #' . $this->getId($connection), [$e]);

        $connection->close();
    }

    /**
     * @param ConnectionInterface|WsConnection|IoConnection $connection
     * @param string $message
     * @return void
     */
    public function onMessage(ConnectionInterface $connection, $message): void
    {
        $id = $this->getId($connection);

        $this->logger->debug('Message received #' . $id);

        $this->clients[$id]->fire(
            $this->protocol->decode($message)
        );
    }
}
