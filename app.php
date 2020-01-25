<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationRegistry;
use Dotenv\Dotenv;
use Kernel\{Application, Protocol\JsonProtocol, Server};
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$loader = require __DIR__ . '/vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$logger = new Logger('mvc', [new StreamHandler(\STDOUT)]);

$app = new Application(new JsonProtocol(), $logger);
$server = new Server(Dotenv::create(__DIR__, '.env'));

$server->run($app);

