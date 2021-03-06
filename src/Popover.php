<?php
/**
 * This file was autogenerated.
 * To regenerate, execute sandritsch91\yii2\bootstrapAdapter\commands\GeneratorController::actionAdapterClasses()
 */

namespace sandritsch91\yii2\bootstrapAdapter;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Popover renders a popover that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the modal window:
 *
 * ```php
 * Popover::begin([
 *     'title' => 'Hello world',
 *     'toggleButton' => ['label' => 'click me'],
 * ]);
 *
 * echo 'Say hello...';
 *
 * Popover::end();
 * ```
 *
 * 
 * @property string|null title
 * @property array headerOptions
 * @property array bodyOptions
 * @property array arrowOptions
 * @property string placement
 * @property array|false toggleButton
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
 * @see https://getbootstrap.com/docs/5.1/components/popovers/
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Popover extends Widget
{
    
    const PLACEMENT_AUTO = 'auto';

    
    const PLACEMENT_TOP = 'top';

    
    const PLACEMENT_BOTTOM = 'bottom';

    
    const PLACEMENT_LEFT = 'left';

    
    const PLACEMENT_RIGHT = 'right';

    
    const TRIGGER_CLICK = 'click';

    
    const TRIGGER_HOVER = 'hover';

    
    const TRIGGER_FOCUS = 'focus';

    
    const TRIGGER_MANUAL = 'manual';

    /**
     * @event Event an event that is triggered when the widget is initialized via [[init()]].
     * @since 2.0.11
     */
    const EVENT_INIT = 'init';

    /**
     * @event WidgetEvent an event raised right before executing a widget.
     * You may set [[WidgetEvent::isValid]] to be false to cancel the widget execution.
     * @since 2.0.11
     */
    const EVENT_BEFORE_RUN = 'beforeRun';

    /**
     * @event WidgetEvent an event raised right after executing a widget.
     * @since 2.0.11
     */
    const EVENT_AFTER_RUN = 'afterRun';

    /**
     * @var string|null the tile content in the popover.
     */
    public $title = null;

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
     * @var array arrow options
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $arrowOptions = [];

    /**
     * @var string How to position the popover - [[PLACEMENT_AUTO]] | [[PLACEMENT_TOP]] | [[PLACEMENT_BOTTOM]] |
     * [[PLACEMENT_LEFT]] | [[PLACEMENT_RIGHT]]. When auto is specified, it will dynamically reorient the popover.
     */
    public $placement = 'auto';

    /**
     * @var array|false the options for rendering the toggle button tag.
     * The toggle button is used to toggle the visibility of the popover.
     * If this property is false, no toggle button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to 'Show'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Popover plugin help](https://getbootstrap.com/docs/5.1/components/popovers/)
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

}
