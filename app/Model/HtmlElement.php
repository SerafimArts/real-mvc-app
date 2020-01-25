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
use Kernel\Model\Model;
use Kernel\Model\ModelInterface;
use Kernel\View\HtmlView;
use Kernel\View\ViewInterface;

/**
 * Class HtmlElement
 */
abstract class HtmlElement extends Model
{
    /**
     * @var string|null
     */
    public ?string $name = null;

    /**
     * @var string|null
     */
    public ?string $style = null;

    /**
     * @param string $name
     * @param array $attributes
     * @return ViewInterface
     * @throws \Exception
     */
    protected function render(string $name, array $attributes = []): ViewInterface
    {
        $attributes = \array_merge($this->getProperties(), $attributes, [
            'id' => $this->getId(),
        ]);

        return new HtmlView($name, $attributes, $this->getChildrenViews());
    }

    /**
     * @param \Closure $then
     * @return $this
     */
    public function with(\Closure $then): self
    {
        $then($this);

        return $this;
    }

    /**
     * @return array|ViewInterface[]
     */
    private function getChildrenViews(): array
    {
        if (! $this instanceof ContainerInterface) {
            return [];
        }

        $map = fn(ModelInterface $model): ViewInterface => $model->getView();

        return \array_map($map, $this->getChildren());
    }
}
