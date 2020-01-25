<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Kernel\Model;

use App\Model\Container;
use Ramsey\Uuid\Uuid;

/**
 * Class Model
 */
abstract class Model implements ModelInterface
{
    use Observable;

    /**
     * @var string|null
     */
    private ?string $id = null;

    /**
     * Input constructor.
     *
     * @param string|null $id
     */
    public function __construct(string $id = null)
    {
        $this->id = $id;

        $this->bootObservableTrait();
    }

    /**
     * @param mixed ...$args
     * @return static
     */
    public static function new(...$args)
    {
        return new static(...$args);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getId(): string
    {
        return $this->id ?? $this->id = Uuid::uuid4()->toString();
    }
}
