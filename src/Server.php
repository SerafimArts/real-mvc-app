<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel;

use Dotenv\Dotenv;
use Ratchet\Http\HttpServer as SocketHttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\LoopInterface;

/**
 * Class Server
 */
class Server
{
    /**
     * @var array
     */
    private array $env;

    /**
     * Server constructor.
     *
     * @param Dotenv $env
     */
    public function __construct(Dotenv $env)
    {
        $this->env = $env->load();
    }

    /**
     * @param Application $app
     * @return void
     */
    public function run(Application $app): void
    {
        $loop = $this->withSocketServer($app);

        $loop->run();
    }

    /**
     * @param Application $app
     * @return LoopInterface
     */
    private function withSocketServer(Application $app): LoopInterface
    {
        $socket = new SocketHttpServer(new WsServer($app));

        return IoServer::factory($socket, $this->getPort(), $this->getHost())->loop;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return (int)($this->env['SOCKET_PORT'] ?? 81);
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->env['SOCKET_HOST'] ?? '';
    }
}
