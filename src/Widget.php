<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;

/**
 * Adapter class for bootstraps Button class
 *
 * @extends \yii\base\Widget
 */
class Widget
{
    use AdapterTrait;

    /**
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @return string the rendering result of the widget.
     * @throws \Exception
     * @see \yii\base\Widget::widget()
     */
    public static function widget($config = [])
    {
        $config['class'] = static::class;
        $object = \Yii::createObject($config);
        return $object->call('widget', $config);
    }

    /**
     * @return \yii\bootstrap\Widget|\yii\bootstrap4\Widget|\yii\bootstrap5\Widget
     * @throws InvalidConfigException
     * @see \yii\base\Widget::begin()
     */
    public static function begin($config = [])
    {
        $config['class'] = static::class;
        $object = \Yii::createObject($config);
        return $object->call('begin', $config);
    }

    /**
     * @return \yii\bootstrap\Widget|\yii\bootstrap4\Widget|\yii\bootstrap5\Widget
     * @throws InvalidConfigException
     * @see \yii\base\Widget::end()
     */
    public static function end()
    {
        $config['class'] = static::class;
        $object = \Yii::createObject($config);
        return $object->call('end');
    }

    /**
     * Detects the current bsVersion and calls the static function of the appropriate bs Version
     * @throws InvalidConfigException
     * @throws \Exception
     */
    protected function call($method, $config = [])
    {
        if ($method == 'end') {
            $bsVersion = static::$_bsVersion;
        } else {
            $bsVersion = $this->getBsVersion($config);
        }
        $majorBsVersion = $this->getMajorBsVersion($bsVersion);

        /** @var \yii\bootstrap\Widget|\yii\bootstrap4\Widget|\yii\bootstrap5\Widget $fq */
        $fq = $this->getClass($majorBsVersion);
        $config = $this->sanitizeConfig($fq, $config);
        switch ($method) {
            case 'widget':
                return $fq::widget($config);
            case 'begin':
                static::$_bsVersion = $majorBsVersion;
                $this->_instance = $fq::begin($config);
                return $this;
            case 'end':
                $this->_instance = $fq::end();
                return $this;
            default:
                throw new InvalidConfigException('Method ' . $method . ' of class ' . $fq . ' does not exist.');
        }
    }
}
