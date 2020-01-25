<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Model;

use Kernel\View\ViewInterface;

/**
 * Class TextElement
 */
class TextElement extends HtmlElement
{
    /**
     * @var string
     */
    public string $value = '';

    /**
     * @var string
     */
    public string $placeholder = '';

    /**
     * @return ViewInterface
     * @throws \Exception
     */
    public function getView(): ViewInterface
    {
        return $this->render('input', ['type' => 'text']);
    }
}
