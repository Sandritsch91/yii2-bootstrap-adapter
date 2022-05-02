<?php

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use Exception;

/**
 * Carousel renders a carousel bootstrap javascript component.
 *
 * For example:
 *
 * ```php
 * echo Carousel::widget([
 *     'items' => [
 *         // the item contains only the image
 *         '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-01.jpg"/>',
 *         // equivalent to the above
 *         ['content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-02.jpg"/>'],
 *         // the item contains both the image and the caption
 *         [
 *             'content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg"/>',
 *             'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
 *             'captionOptions' => ['class' => ['d-none', 'd-md-block']]
 *             'options' => [...],
 *         ],
 *     ]
 * ]);
 * ```
 *
 * 
 * @property array|null controls
 * @property bool showIndicators
 * @property array items
 * @property mixed options
 * @property array|bool clientOptions
 * @property array clientEvents
 * @property bool crossfade
 *
 * @method void init()
 * @method string run()
 * @method string renderIndicators()
 * @method string renderItems()
 * @method string renderItem(string|array $item, int $index)
 * @method string renderControls()
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
 * @see https://getbootstrap.com/docs/5.1/components/carousel/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Carousel extends Widget
{
    /**
     * @var array|null the labels for the previous and the next control buttons.
     * If null, it means the previous and the next control buttons should not be displayed.
     */
    public $controls = [0 => '<span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span>', 1 => '<span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span>'];

    /**
     * @var bool whether carousel indicators (<ol> tag with anchors to items) should be displayed or not.
     */
    public $showIndicators = true;

    /**
     * @var array list of slides in the carousel. Each array element represents a single
     * slide with the following structure:
     *
     * ```php
     * [
     *     // required, slide content (HTML), such as an image tag
     *     'content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-01.jpg"/>',
     *     // optional, the caption (HTML) of the slide
     *     'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
     *     // optional the HTML attributes of the slide container
     *     'options' => [],
     * ]
     * ```
     */
    public $items = [];

    /**
     * {@inheritdoc}
     */
    public $options = ['data' => ['bs-ride' => 'carousel']];

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
     * @var bool Animate slides with a fade transition instead of a slide. Defaults to `false`
     */
    public $crossfade = false;

}
