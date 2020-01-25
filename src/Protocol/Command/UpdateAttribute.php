<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Protocol\Command;

use Kernel\Model\ModelInterface;

/**
 * Class UpdateAttribute
 */
class UpdateAttribute extends Command implements ProceedCommandInterface
{
    /**
     * @var string
     */
    public const NAME = 'update';

    /**
     * UpdateAttribute constructor.
     *
     * @param ModelInterface $model
     * @param string $attr
     * @param mixed $value
     * @param int|null $id
     */
    public function __construct(ModelInterface $model, string $attr, $value, int $id = null)
    {
        $payload = [
            'id'    => $model->getId(),
            'attr'  => $attr,
            'value' => $value,
        ];

        parent::__construct(self::NAME, $payload, $id);
    }
}
