<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Model;

use Kernel\Model\ContainerInterface;
use Kernel\Model\ModelInterface;
use Kernel\View\ViewInterface;

/**
 * Class Container
 */
class Container extends HtmlElement implements ContainerInterface
{
    /**
     * @var array|ModelInterface[]
     */
    private array $children;

    /**
     * Form constructor.
     *
     * @param array|ModelInterface[] $children
     * @param string|null $id
     */
    public function __construct(array $children, string $id = null)
    {
        $this->children = $children;

        parent::__construct($id);
    }

    /**
     * @return iterable|ModelInterface[]
     */
    public function getChildren(): iterable
    {
        return $this->children;
    }

    /**
     * @return ViewInterface
     * @throws \Exception
     */
    public function getView(): ViewInterface
    {
        return $this->render('div');
    }
}
