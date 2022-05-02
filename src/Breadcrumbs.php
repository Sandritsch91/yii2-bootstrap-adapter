<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use RuntimeException;

/**
 * Breadcrumbs represents a Bootstrap 5 version of [[\yii\widgets\Breadcrumbs]]. It displays
 * a list of links indicating the position of the current page in the whole site hierarchy.
 *
 * To use Breadcrumbs, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ```php
 * echo Breadcrumbs::widget([
 *     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
 *     'options' => [],
 * ]);
 * ```
 * 
 * @property string tag
 * @property bool encodeLabels
 * @property array|bool homeLink
 * @property array links
 * @property string itemTemplate
 * @property string activeItemTemplate
 * @property array navOptions
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
 * @method self activeItemTemplate(string $value)
 * @method self encodeLabels(bool $value)
 * @method self homeLink(array|bool $value)
 * @method self itemTemplate(string $value)
 * @method self links(array $value)
 * @method self navOptions(array $value)
 * @method self options(array $value)
 * @method self tag(string $value)
 *
 * @see https://getbootstrap.com/docs/5.1/components/breadcrumb/
 * @author Alexandr Kozhevnikov <onmotion1@gmail.com>
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Breadcrumbs extends Widget
{
    /**
     * @var string the name of the breadcrumb container tag.
     */
    public $tag = 'ol';

    /**
     * @var bool whether to HTML-encode the link labels.
     */
    public $encodeLabels = true;

    /**
     * @var array|bool the first hyperlink in the breadcrumbs (called home link).
     * Please refer to [[links]] on the format of the link.
     * If this property is not set, it will default to a link pointing to [[\yii\web\Application::homeUrl]]
     * with the label 'Home'. If this property is false, the home link will not be rendered.
     */
    public $homeLink = [];

    /**
     * @var array list of links to appear in the breadcrumbs. If this property is empty,
     * the widget will not render anything. Each array element represents a single link in the breadcrumbs
     * with the following structure:
     *
     * ```php
     * [
     *     'label' => 'label of the link',  // required
     *     'url' => 'url of the link',      // optional, will be processed by Url::to()
     *     'template' => 'own template of the item', // optional, if not set $this->itemTemplate will be used
     * ]
     * ```
     *
     *
     */
    public $links = [];

    /**
     * @var string the template used to render each inactive item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each inactive item.
     */
    public $itemTemplate = '<li class="breadcrumb-item">{link}</li>
';

    /**
     * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each active item.
     */
    public $activeItemTemplate = '<li class="breadcrumb-item active" aria-current="page">{link}</li>
';

    /**
     * @var array the HTML attributes for the widgets nav container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $navOptions = ['aria' => ['label' => 'breadcrumb']];

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