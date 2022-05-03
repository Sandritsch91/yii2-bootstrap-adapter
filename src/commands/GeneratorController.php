<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter\commands;

use yii\base\InvalidConfigException;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\helpers\FileHelper;

class GeneratorController extends Controller
{
    /** @var string Temporary directory where the repos are cloned into */
    public $tmpDir = "C:\\tmp";

    public $namespace = 'sandritsch91\yii2\bootstrapAdapter';

    protected $magicMethods = [
        '__construct',
        '__destruct',
        '__call',
        '__callStatic',
        '__get',
        '__set',
        '__isset',
        '__unset',
        '__sleep',
        '__wakeup',
        '__toString',
        '__invoke',
        '__set_state',
        '__clone',
    ];

    /**
     * {@inheritDoc}
     */
    public function options($actionID)
    {
        return ArrayHelper::merge(
            parent::options($actionID),
            ['tmpDir']
        );
    }

    /**
     * @param string[] $versions
     * @return void
     * @throws InvalidConfigException
     * @throws \ReflectionException
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     */
    public function actionAdapterClasses($versions = ['', '4', '5'])
    {
        if (file_exists($this->tmpDir)) {
            FileHelper::removeDirectory($this->tmpDir);
        }
        if (!FileHelper::createDirectory($this->tmpDir)) {
            throw new InvalidConfigException('Directory ' . $this->tmpDir . ' could not be created.');
        }
        if (!is_writable($this->tmpDir)) {
            throw new InvalidConfigException('Directory ' . $this->tmpDir . ' is not writable.');
        }

        foreach ($versions as $version) {
            exec('git clone https://github.com/yiisoft/yii2-bootstrap' . $version . ' ' . $this->tmpDir . '/yii2-bootstrap' . $version);
        }

        $classes = [
            'Accordion',
            'Alert',
            'Breadcrumbs',
            'Button',
            'ButtonDropdown',
            'ButtonGroup',
            'ButtonToolbar',
            'Carousel',
            'Dropdown',
            'LinkPager',
            'Modal',
            'Nav',
            'NavBar',
            'OffCanvas',
            'Popover',
            'Progress',
            'Tabs',
            'Toast',
            'ToggleButtonGroup'
        ];

        $infos = [];

        // Collect class infos
        foreach ($versions as $version) {
            Console::stdout('Version: ' . $version . "\n");
            foreach ($classes as $class) {

                // skip this. We lack the classes because composer can not load the newest version of bs3 and bs5 together
                if ($version == '' && $class == 'ToggleButtonGroup') {
                    continue;
                }

                $file = $this->tmpDir . '/yii2-bootstrap' . $version . '/src/' . $class . '.php';
                Console::stdout('File: ' . $file . "\n");

                if (!file_exists($file)) {
                    Console::stdout("Skipped\n");
                    continue;
                }

                require_once $file;

                $fq = "yii\bootstrap$version\\$class";
                $r = new \ReflectionClass($fq);

                $infos[$class]['comment'] = $r->getDocComment();
                $infos[$class]['extends'] = basename($r->getParentClass()->name);

                // Get uses
                if (!isset($infos[$class]['uses'])) $infos[$class]['uses'] = [];
                $handle = fopen($file, 'r');
                while (($line = fgets($handle)) !== false) {
                    if (substr($line, 0, 4) == 'use ') {
                        $infos[$class]['uses'][$line] = 1;
                    }
                }
                fclose($handle);

                // Add properties
                foreach ($r->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
                    if ($property->isStatic()) {
                        continue;
                    }

                    $infos[$class]['properties'][$property->name] = [
                        'type' => $property->getType(),
                        'description' => $property->getDocComment(),
                        'isReadOnly' => $property->isReadOnly(),
                        'isPublic' => $property->isPublic()
                    ];
                    if ($property->hasDefaultValue()) {
                        $infos[$class]['properties'][$property->name]['default'] = $property->getDefaultValue();
                    }
                }

                // Add public methods
                foreach ($r->getMethods(\ReflectionProperty::IS_PUBLIC) as $method) {
                    if ($method->isStatic()) continue;
                    if (in_array($method->name, $this->magicMethods)) continue;
                    $infos[$class]['methods'][$method->name] = [
                        'returnType' => $method->getReturnType(),
                        'description' => $method->getDocComment(),
                        'parameters' => $method->getParameters()
                    ];
                }
            }
        }

        // save files
        foreach ($infos as $class => $attributes) {
            $contents = $this->renderPartial('/class', [
                'namespace' => $this->namespace,
                'uses' => $attributes['uses'],
                'description' => preg_replace(
                    '#<br ?/?>#i',
                    '',
                    $attributes['comment']
                ),
                'className' => $class,
                'extends' => $attributes['extends'],
                'properties' => $attributes['properties'],
                'methods' => $attributes['methods'],
                'module' => $this->module,
            ]);

            if(!file_put_contents(\Yii::getAlias('@sandritsch91/yii2/bootstrapAdapter') . '/' . $class . '.php', $contents))
            {
                Console::stdout('Could not save to file ' . \Yii::getAlias('@sandritsch91/yii2/bootstrapAdapter') . '/' . $class . '.php');
            }
        }
    }
}
