<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

/**
 * Modal renders a modal window that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the modal window:
 *
 * ~~~php
 * Modal::begin([
 *     'title' => 'Hello world',
 *     'toggleButton' => ['label' => 'click me'],
 * ]);
 *
 * echo 'Say hello...';
 *
 * Modal::end();
 * ~~~
 *
 * 
 * @property string header
 * @property array headerOptions
 * @property array bodyOptions
 * @property string|null footer
 * @property array footerOptions
 * @property string|null size
 * @property array|false closeButton
 * @property array|false toggleButton
 * @property array options
 * @property array|bool clientOptions
 * @property array clientEvents
 * @property string title
 * @property array titleOptions
 * @property boolean centerVertical
 * @property boolean scrollable
 * @property array dialogOptions
 *
 * @method void init()
 * @method void run()
 * @method string|null getId(bool $autoGenerate = true)
 * @method void setId(string $value)
 * @method \yii\web\View getView()
 * @method void setView(View $view)
 * @method string render(string $view, array $params = [])
 * @method string renderFile(string $file, array $params = [])
 * @method string getViewPath()
 * @method bool beforeRun()
 * @method mixed afterRun(mixed $result)
 * @method bool hasProperty(string $name, bool $checkVars = true, bool $checkBehaviors = true)
 * @method bool canGetProperty(string $name, bool $checkVars = true, bool $checkBehaviors = true)
 * @method bool canSetProperty(string $name, bool $checkVars = true, bool $checkBehaviors = true)
 * @method bool hasMethod(string $name, bool $checkBehaviors = true)
 * @method array behaviors()
 * @method bool hasEventHandlers(string $name)
 * @method void on(string $name, callable $handler, mixed $data = null, bool $append = true)
 * @method bool off(string $name, callable $handler = null)
 * @method void trigger(string $name, \yii\base\Event $event = null)
 * @method null|Behavior getBehavior(string $name)
 * @method Behavior getBehaviors()
 * @method Behavior attachBehavior(string $name, string|array|Behavior $behavior)
 * @method void attachBehaviors(array $behaviors)
 * @method null|Behavior detachBehavior(string $name)
 * @method void detachBehaviors()
 * @method void ensureBehaviors()
 *
 * @see https://getbootstrap.com/docs/5.1/components/modal/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Modal extends Widget
{
    /**
     * @var string the header content in the modal window.
     */
    public $header = null;

    /**
     * @var array additional header options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $headerOptions = [];

    /**
     * @var array body options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $bodyOptions = [];

    /**
     * @var string|null the footer content in the modal window.
     */
    public $footer = null;

    /**
     * @var array additional footer options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $footerOptions = [];

    /**
     * @var string|null the modal size. Can be [[SIZE_LARGE]] or [[SIZE_SMALL]], or empty for default.
     */
    public $size = null;

    /**
     * @var array|false the options for rendering the close button tag.
     * The close button is displayed in the header of the modal window. Clicking
     * on the button will hide the modal window. If this is false, no close button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Modal plugin help](http://getbootstrap.com/javascript/#modals)
     * for the supported HTML attributes.
     */
    public $closeButton = [];

    /**
     * @var array|false the options for rendering the toggle button tag.
     * The toggle button is used to toggle the visibility of the modal window.
     * If this property is false, no toggle button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to 'Show'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Modal plugin help](http://getbootstrap.com/javascript/#modals)
     * for the supported HTML attributes.
     */
    public $toggleButton = false;

    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array|bool the options for the underlying Bootstrap JS plugin.
     * Please refer to the corresponding Bootstrap plugin Web page for possible options.
     * For example, [this page](http://getbootstrap.com/javascript/#modals) shows
     * how to use the "Modal" plugin and the supported options (e.g. "remote").
     * If this property is false, registerJs will not be called on the view to initialize the module.
     */
    public $clientOptions = [];

    /**
     * @var array the event handlers for the underlying Bootstrap JS plugin.
     * Please refer to the corresponding Bootstrap plugin Web page for possible events.
     * For example, [this page](http://getbootstrap.com/javascript/#modals) shows
     * how to use the "Modal" plugin and the supported events (e.g. "shown").
     */
    public $clientEvents = [];

    /**
     * @var string the title content in the modal window.
     */
    public $title = null;

    /**
     * @var array additional title options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $titleOptions = [];

    /**
     * @var boolean whether to center the modal vertically
     *
     * When true the modal-dialog-centered class will be added to the modal-dialog
     * @since 2.0.9
     */
    public $centerVertical = false;

    /**
     * @var boolean whether to make the modal body scrollable
     *
     * When true the modal-dialog-scrollable class will be added to the modal-dialog
     * @since 2.0.9
     */
    public $scrollable = false;

    /**
     * @var array modal dialog options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     * @since 2.0.9
     */
    public $dialogOptions = [];

}
