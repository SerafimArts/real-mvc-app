<?php

/**
 * This file is part of RealMVC package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Model\Button;
use App\Model\Container;
use App\Model\Form;
use App\Model\TextElement;
use Kernel\Controller\Controller;
use Kernel\Event\Event;
use Kernel\Event\OnBlur;
use Kernel\Event\OnClick;
use Kernel\Event\OnFocus;
use Kernel\Event\Route;
use Kernel\Model\ModelInterface;

/**
 * @Route(path="/")
 */
class ExampleController extends Controller
{
    /**
     * @var int
     */
    private int $clicked = 0;

    /**
     * @return ModelInterface
     */
    public function getModel(): ModelInterface
    {
        return Container::new([
            TextElement::new('text')
                ->with(static function (TextElement $text) {
                    $text->style = 'border: none; box-shadow: 0 0 0 1px #666; outline: none;';
                }),
            new Button('button')
        ])
            ->with(static function (Container $container) {
                $container->style = 'padding: 100px';
            });
    }

    /**
     * @OnClick("button")
     *
     * @param Button $button
     * @return void
     */
    public function onButtonClick(Button $button): void
    {
        /** @var TextElement $text */
        $text = $this->findById('text');

        $button->value = 'Жмякнуто целых ' . (++$this->clicked) . ' раз!';
    }

    /**
     * @OnFocus("text")
     *
     * @param TextElement $input
     * @return void
     */
    public function onInputFocus(TextElement $input): void
    {
        $input->style = 'border: none; box-shadow: 0 0 1px 1px #03f; outline: none;';
    }

    /**
     * @OnBlur("text")
     *
     * @param TextElement $input
     * @return void
     */
    public function onInputBlur(TextElement $input): void
    {
        $input->style = 'border: none; box-shadow: 0 0 0 1px #666; outline: none;';

        $input->placeholder = '';
    }

    /**
     * @OnClick("text")
     *
     * @param TextElement $input
     * @return void
     */
    public function onInputClick(TextElement $input): void
    {
        $input->placeholder = 'Введите какую-нибудь хуйню!';
    }
}
