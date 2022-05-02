<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;

/**
 * ToggleButtonGroup allows rendering form inputs Checkbox/Radio toggle button groups.
 *
 * You can use this widget in an [[yii\bootstrap5\ActiveForm|ActiveForm]] using the [[yii\widgets\ActiveField::widget()|widget()]]
 * method, for example like this:
 *
 * ```php
 * <?= $form->field($model, 'item_id')->widget(\yii\bootstrap5\ToggleButtonGroup::class, [
 *     'type' => \yii\bootstrap5\ToggleButtonGroup::TYPE_CHECKBOX
 *     'items' => [
 *         'fooValue' => 'BarLabel',
 *         'barValue' => 'BazLabel'
 *     ]
 * ]) ?>
 * ```
 *
 * 
 * @property string type
 * @property array items
 * @property array labelOptions
 * @property bool encodeLabels
 * @property \yii\widgets\ActiveField field
 * @property Model model
 * @property string attribute
 * @property string name
 * @property string value
 * @property array options
 * @property array|bool clientOptions
 * @property array clientEvents
 *
 * @method void init()
 * @method string run()
 * @method string renderItem(int $index, string $label, string $name, bool $checked, string $value)
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
 * @see https://getbootstrap.com/docs/5.1/components/buttons/#checkbox-and-radio-buttons
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class ToggleButtonGroup extends InputWidget
{
    /**
     * @var string input type, can be [[TYPE_CHECKBOX]] or [[TYPE_RADIO]]
     */
    public $type = null;

    /**
     * @var array the data item used to generate the checkboxes.
     * The array values are the labels, while the array keys are the corresponding checkbox or radio values.
     */
    public $items = [];

    /**
     * @var array, the HTML attributes for the label (button) tag.
     * @see Html::checkbox()
     * @see Html::radio()
     */
    public $labelOptions = ['class' => [0 => 'btn', 1 => 'btn-outline-secondary']];

    /**
     * @var bool whether the items labels should be HTML-encoded.
     */
    public $encodeLabels = true;

    /**
     * @var \yii\widgets\ActiveField active input field, which triggers this widget rendering.
     * This field will be automatically filled up in case widget instance is created via [[\yii\widgets\ActiveField::widget()]].
     * @since 2.0.11
     */
    public $field = null;

    /**
     * @var Model the data model that this widget is associated with.
     */
    public $model = null;

    /**
     * @var string the model attribute that this widget is associated with.
     */
    public $attribute = null;

    /**
     * @var string the input name. This must be set if [[model]] and [[attribute]] are not set.
     */
    public $name = null;

    /**
     * @var string the input value.
     */
    public $value = null;

    /**
     * @var array the HTML attributes for the input tag.
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