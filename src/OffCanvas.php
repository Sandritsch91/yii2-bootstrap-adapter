<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Offcanvas is a sidebar component that can be toggled via JavaScript to appear from the left, right, or bottom edge
 * of the viewport. Buttons or anchors are used as triggers that are attached to specific elements you toggle, and data
 * attributes are used to invoke the required JavaScript.
 *
 * The following example will show the content enclosed the [[begin()]] and [[end()]] calls within the offcancas
 * container:
 *
 * ```php
 * Offcanvas::begin([
 *     'placement' => Offcanvas::PLACEMENT_END,
 *     'backdrop' => true,
 *     'scrolling' => true
 * ]);
 *
 * Nav::widget([...]);
 *
 * Offcanvas::end();
 * ```
 *
 * 
 * @property string placement
 * @property boolean backdrop
 * @property boolean scrolling
 * @property string title
 * @property array|false closeButton
 * @property array|false toggleButton
 * @property array headerOptions
 * @property array titleOptions
 * @property array bodyOptions
 * @property array options
 * @property array|bool clientOptions
 * @property array clientEvents
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
 * @see https://getbootstrap.com/docs/5.1/components/offcanvas/
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class OffCanvas extends Widget
{
    /**
     * @var string Where to place the offcanvas. Can be of of the [[PLACEMENT_*]] constants.
     */
    public $placement = 'start';

    /**
     * @var boolean Whether to enable backdrop or not. Defaults to `true`.
     */
    public $backdrop = true;

    /**
     * @var boolean Whether to enable body scrolling or not. Defaults to `false`.
     */
    public $scrolling = false;

    /**
     * @var string The title content in the offcanvas container.
     */
    public $title = null;

    /**
     * @var array|false the options for rendering the close button tag.
     * The close button is displayed in the header of the offcanvas container. Clicking
     * on the button will hide the offcanvas container. If this is false, no close button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Offcanvas plugin help](https://getbootstrap.com/docs/5.1/components/offcanvas/)
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
     * @var array Additional header options.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $headerOptions = [];

    /**
     * @var array Additional title options.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'h5'.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $titleOptions = [];

    /**
     * @var array Additional body options.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $bodyOptions = [];

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

}
