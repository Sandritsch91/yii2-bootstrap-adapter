<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * LinkPager represents a Bootstrap 5 version of [[\yii\widgets\LinkPager]]. It displays a list of hyperlinks
 * that lead to different pages of target.
 *
 * LinkPager works with a [[\yii\widget\Pagination]] object which specifies the total number
 * of pages and the current page number.
 *
 * To apply LinkPager globally e.g. in all GridViews, set in configuration DI:
 *
 * ```php
 * 'container' => [
 *    'definitions' => [
 *       \yii\widgets\LinkPager::class => \yii\bootstrap5\LinkPager::class,
 *    ],
 * ],
 * ```
 *
 * 
 * @property Pagination pagination
 * @property array options
 * @property array listOptions
 * @property array linkContainerOptions
 * @property array linkOptions
 * @property string pageCssClass
 * @property string firstPageCssClass
 * @property string lastPageCssClass
 * @property string prevPageCssClass
 * @property string nextPageCssClass
 * @property string activePageCssClass
 * @property string disabledPageCssClass
 * @property array disabledListItemSubTagOptions
 * @property int maxButtonCount
 * @property string|bool nextPageLabel
 * @property string|bool prevPageLabel
 * @property string|bool firstPageLabel
 * @property string|bool lastPageLabel
 * @property bool registerLinkTags
 * @property bool hideOnSinglePage
 * @property bool disableCurrentPageButton
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
 * @see https://getbootstrap.com/docs/5.1/components/pagination/
 * @author Simon Karlen <simi.albi@outlook.com>
 * @since 2.0.2
 *
 * @property-read array $pageRange
 */
class LinkPager extends Widget
{
    /**
     * @var Pagination the pagination object that this pager is associated with.
     * You must set this property in order to make LinkPager work.
     */
    public $pagination = null;

    /**
     * @var array HTML attributes for the pager container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array HTML attributes for the pager list tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $listOptions = ['class' => [0 => 'pagination']];

    /**
     * @var array HTML attributes which will be applied to all link containers
     */
    public $linkContainerOptions = ['class' => [0 => 'page-item']];

    /**
     * @var array HTML attributes for the link in a pager container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $linkOptions = ['class' => [0 => 'page-link']];

    /**
     * @var string the CSS class for the each page button.
     */
    public $pageCssClass = 'page-item';

    /**
     * @var string the CSS class for the "first" page button.
     */
    public $firstPageCssClass = 'first';

    /**
     * @var string the CSS class for the "last" page button.
     */
    public $lastPageCssClass = 'last';

    /**
     * @var string the CSS class for the "previous" page button.
     */
    public $prevPageCssClass = 'prev';

    /**
     * @var string the CSS class for the "next" page button.
     */
    public $nextPageCssClass = 'next';

    /**
     * @var string the CSS class for the active (currently selected) page button.
     */
    public $activePageCssClass = 'active';

    /**
     * @var string the CSS class for the disabled page buttons.
     */
    public $disabledPageCssClass = 'disabled';

    /**
     * @var array the options for the disabled tag to be generated inside the disabled list element.
     * In order to customize the html tag, please use the tag key.
     *
     * ```php
     * $disabledListItemSubTagOptions = ['class' => 'disabled-link'];
     * ```
     */
    public $disabledListItemSubTagOptions = [];

    /**
     * @var int maximum number of page buttons that can be displayed. Defaults to 10.
     */
    public $maxButtonCount = 10;

    /**
     * @var string|bool the label for the "next" page button. Note that this will NOT be HTML-encoded.
     * If this property is false, the "next" page button will not be displayed.
     */
    public $nextPageLabel = '<span aria-hidden="true">&raquo;</span>';

    /**
     * @var string|bool the text label for the "previous" page button. Note that this will NOT be HTML-encoded.
     * If this property is false, the "previous" page button will not be displayed.
     */
    public $prevPageLabel = '<span aria-hidden="true">&laquo;</span>';

    /**
     * @var string|bool the text label for the "first" page button. Note that this will NOT be HTML-encoded.
     * If it's specified as true, page number will be used as label.
     * Default is false that means the "first" page button will not be displayed.
     */
    public $firstPageLabel = false;

    /**
     * @var string|bool the text label for the "last" page button. Note that this will NOT be HTML-encoded.
     * If it's specified as true, page number will be used as label.
     * Default is false that means the "last" page button will not be displayed.
     */
    public $lastPageLabel = false;

    /**
     * @var bool whether to register link tags in the HTML header for prev, next, first and last page.
     * Defaults to `false` to avoid conflicts when multiple pagers are used on one page.
     * @see http://www.w3.org/TR/html401/struct/links.html#h-12.1.2
     * @see registerLinkTags()
     */
    public $registerLinkTags = false;

    /**
     * @var bool Hide widget when only one page exist.
     */
    public $hideOnSinglePage = true;

    /**
     * @var bool whether to render current page button as disabled.
     */
    public $disableCurrentPageButton = false;

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
