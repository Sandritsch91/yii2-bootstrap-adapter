<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use Yii;
use yii\helpers\ArrayHelper;
use DateInterval;
use DateTime;
use DateTimeInterface;

/**
 * Toasts renders an toast bootstrap component.
 *
 * For example,
 *
 * ```php
 * echo Toast::widget([
 *     'title' => 'Hello world!',
 *     'dateTime' => 'now',
 *     'body' => 'Say hello...',
 * ]);
 * ```
 *
 * The following example will show the content enclosed between the [[begin()]]
 * and [[end()]] calls within the toast box:
 *
 * ```php
 * Toast::begin([
 *     'title' => 'Hello world!',
 *     'dateTime' => 'now'
 * ]);
 *
 * echo 'Say hello...';
 *
 * Toast::end();
 * ```
 *
 * 
 * @property string|null body
 * @property string|null title
 * @property int|string|DateTime|DateTimeInterface|DateInterval|false dateTime
 * @property array|false closeButton
 * @property array titleOptions
 * @property array dateTimeOptions
 * @property array headerOptions
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
 * @see https://getbootstrap.com/docs/5.1/components/toasts/
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Toast extends Widget
{
    /**
     * @var string|null the body content in the alert component. Note that anything between
     * the [[begin()]] and [[end()]] calls of the Toast widget will also be treated
     * as the body content, and will be rendered before this.
     */
    public $body = null;

    /**
     * @var string|null The title content in the toast.
     */
    public $title = null;

    /**
     * @var int|string|DateTime|DateTimeInterface|DateInterval|false The date time the toast message references to.
     * This will be formatted as relative time (via formatter component). It will be omitted if
     * set to `false` (default).
     */
    public $dateTime = false;

    /**
     * @var array|false the options for rendering the close button tag.
     * The close button is displayed in the header of the toast. Clicking on the button will hide the toast.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to '&times;'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Toast documentation](https://getbootstrap.com/docs/5.1/components/toasts/)
     * for the supported HTML attributes.
     */
    public $closeButton = [];

    /**
     * @var array additional title options
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'strong'.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $titleOptions = [];

    /**
     * @var array additional date time part options
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'small'.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $dateTimeOptions = [];

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