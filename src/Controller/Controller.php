<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Controller;

use Kernel\Model\ContainerInterface;
use Kernel\Model\ModelInterface;

/**
 * Class Controller
 */
abstract class Controller implements ControllerInterface
{
    /**
     * @param string $id
     * @return ModelInterface|null
     */
    protected function findById(string $id): ?ModelInterface
    {
        return $this->findBy(fn(ModelInterface $model) => $model->getId() === $id);
    }

    /**
     * @param \Closure $match
     * @return ModelInterface|null
     */
    protected function findBy(\Closure $match): ?ModelInterface
    {
        return $this->lookup($this->getModel(), $match);
    }

    /**
     * @param ModelInterface $model
     * @param \Closure $match
     * @return ModelInterface|null
     */
    private function lookup(ModelInterface $model, \Closure $match): ?ModelInterface
    {
        if ($match($model)) {
            return $model;
        }

        if ($model instanceof ContainerInterface) {
            foreach ($model->getChildren() as $child) {
                if ($result = $this->lookup($child, $match)) {
                    return $result;
                }
            }
        }

        return null;
    }
}
