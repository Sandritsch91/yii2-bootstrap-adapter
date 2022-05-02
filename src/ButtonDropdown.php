<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Throwable;
use Yii;

/**
 * ButtonDropdown renders a group or split button dropdown bootstrap component.
 *
 * For example,
 *
 * ```php
 * // a button group using Dropdown widget
 * echo ButtonDropdown::widget([
 *     'label' => 'Action',
 *     'dropdown' => [
 *         'items' => [
 *             ['label' => 'DropdownA', 'url' => '/'],
 *             ['label' => 'DropdownB', 'url' => '#'],
 *         ],
 *     ],
 * ]);
 * ```
 * 
 * @property string|null label
 * @property array containerOptions
 * @property array options
 * @property array dropdown
 * @property bool split
 * @property string tagName
 * @property bool encodeLabel
 * @property string dropdownClass
 * @property array|bool clientOptions
 * @property array clientEvents
 * @property array buttonOptions
 * @property string direction
 * @property bool renderContainer
 *
 * @method string run()
 * @method void init()
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
 * @see https://getbootstrap.com/docs/5.1/components/buttons/
 * @see https://getbootstrap.com/docs/5.1/components/dropdowns/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 */
class ButtonDropdown extends Widget
{
    /**
     * @var string|null the button label
     */
    public $label = null;

    /**
     * @var array the HTML attributes for the container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     * @since 2.0.1
     */
    public $containerOptions = [];

    /**
     * @var array the HTML attributes for the container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the name of the container tag.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the configuration array for [[Dropdown]].
     */
    public $dropdown = [];

    /**
     * @var bool whether to display a group of split-styled button group.
     */
    public $split = false;

    /**
     * @var string the tag to use to render the button
     */
    public $tagName = 'button';

    /**
     * @var bool whether the label should be HTML-encoded.
     */
    public $encodeLabel = true;

    /**
     * @var string name of a class to use for rendering dropdowns withing this widget. Defaults to [[Dropdown]].
     */
    public $dropdownClass = 'yii\bootstrap5\Dropdown';

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
     * @var array the HTML attributes of the button.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $buttonOptions = [];

    /**
     * @var string the drop-direction of the widget
     *
     * Possible values are 'left', 'right', 'up', or 'down' (default)
     */
    public $direction = 'down';

    /**
     * @var bool whether to render the container using the [[options]] as HTML attributes. If set to `false`,
     * the container element enclosing the button and dropdown will NOT be rendered.
     */
    public $renderContainer = true;

}
