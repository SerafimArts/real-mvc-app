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
use Kernel\Model\Attribute;
use Kernel\Model\ContainerInterface;
use Kernel\Model\ModelInterface;
use Kernel\Protocol\Command\UpdateAttribute;

/**
 * Class ModelReader
 */
class ModelReader
{
    /**
     * @var ModelInterface
     */
    private ModelInterface $model;

    /**
     * @var Reader
     */
    private Reader $reader;

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var array|ModelInterface[]
     */
    private array $models = [];

    /**
     * AnnotatedAttributesReader constructor.
     *
     * @param Client $client
     * @param ModelInterface $model
     * @param Reader|null $reader
     * @throws AnnotationException
     */
    public function __construct(Client $client, ModelInterface $model, Reader $reader = null)
    {
        $this->model = $model;
        $this->client = $client;
        $this->reader = $reader ?? new AnnotationReader();

        $this->bootModels($model);
        $this->bootObservers();
    }

    /**
     * @return void
     */
    private function bootObservers(): void
    {
        foreach ($this->models as $model) {
            foreach ($model->getProperties() as $name => $value) {
                $model->onChange($name, function ($value) use ($model, $name) {
                    $command = new UpdateAttribute($model, $name, $value, $this->client->getId());

                    $this->client->send($command);
                });
            }
        }
    }

    /**
     * @param ModelInterface $model
     * @return void
     */
    private function bootModels(ModelInterface $model): void
    {
        if ($model->getId()) {
            $this->models[$model->getId()] = $model;
        }

        if ($model instanceof ContainerInterface) {
            foreach ($model->getChildren() as $child) {
                $this->bootModels($child);
            }
        }
    }

    /**
     * @param string $id
     * @return ModelInterface|null
     */
    public function getById(string $id): ?ModelInterface
    {
        return $this->models[$id] ?? null;
    }
}
