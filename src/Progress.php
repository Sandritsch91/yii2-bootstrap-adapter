<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use Yii;
use Exception;

/**
 * Progress renders a bootstrap progress bar component.
 *
 * For example,
 *
 * ```php
 * // default with label
 * echo Progress::widget([
 *     'percent' => 60,
 *     'label' => 'test'
 * ]);
 * // or
 * echo Progress::widget([
 *     'bars' => [
 *         ['percent' => 60, 'label' => 'test']
 *     ]
 * ]);
 *
 * // styled
 * echo Progress::widget([
 *     'percent' => 65,
 *     'barOptions' => ['class' => 'bg-danger']
 * ]);
 * // or
 * echo Progress::widget([
 *     'bars' => [
 *         ['percent' => 65, 'options' => ['class' => 'bg-danger']]
 *     ]
 * ]);
 *
 * // striped
 * echo Progress::widget([
 *     'percent' => 70,
 *     'barOptions' => ['class' => ['bg-warning', 'progress-bar-striped']]
 * ]);
 * // or
 * echo Progress::widget([
 *     'bars' => [
 *         ['percent' => 70, 'options' => ['class' => ['bg-warning', 'progress-bar-striped']]]
 *     ]
 * ]);
 *
 * // striped animated
 * echo Progress::widget([
 *     'percent' => 70,
 *     'barOptions' => ['class' => ['bg-success', 'progress-bar-animated', 'progress-bar-striped']]
 * ]);
 * // or
 * echo Progress::widget([
 *     'bars' => [
 *         ['percent' => 70, 'options' => ['class' => ['bg-success', 'progress-bar-animated', 'progress-bar-striped']]]
 *     ]
 * ]);
 *
 * // stacked bars
 * echo Progress::widget([
 *     'bars' => [
 *         ['percent' => 30, 'options' => ['class' => 'bg-danger']],
 *         ['percent' => 30, 'label' => 'test', 'options' => ['class' => 'bg-success']],
 *         ['percent' => 35, 'options' => ['class' => 'bg-warning']],
 *     ]
 * ]);
 * ```
 * 
 * @property string label
 * @property int percent
 * @property array barOptions
 * @property array bars
 * @property array options
 * @property array|bool clientOptions
 * @property array clientEvents
 *
 * @method void init()
 * @method string run()
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
 * @see https://getbootstrap.com/docs/5.1/components/progress/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Progress extends Widget
{
    /**
     * @var string the button label. This property will only be considered if [[bars]] is empty
     */
    public $label = null;

    /**
     * @var int the amount of progress as a percentage. This property will only be considered if [[bars]] is empty
     */
    public $percent = 0;

    /**
     * @var array the HTML attributes of the bar. This property will only be considered if [[bars]] is empty
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     * @since 2.0.6
     */
    public $barOptions = [];

    /**
     * @var array a set of bars that are stacked together to form a single progress bar.
     * Each bar is an array of the following structure:
     *
     * ```php
     * [
     *     // required, the amount of progress as a percentage.
     *     'percent' => 30,
     *     // optional, the label to be displayed on the bar
     *     'label' => '30%',
     *     // optional, array, additional HTML attributes for the bar tag
     *     'options' => [],
     * ]
     * ```
     */
    public $bars = null;

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