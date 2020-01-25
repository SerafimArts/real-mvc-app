<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Protocol\Command;

use Kernel\Controller\ControllerInterface;

/**
 * Class Render
 */
class Render extends Command implements ProceedCommandInterface
{
    /**
     * @var string
     */
    public const NAME = 'render';

    /**
     * SetController constructor.
     *
     * @param ControllerInterface $controller
     * @param int|null $id
     */
    public function __construct(ControllerInterface $controller, int $id = null)
    {
        $payload = [
            'html' => (string)$controller->getModel()->getView(),
        ];

        parent::__construct(self::NAME, $payload, $id);
    }
}
