<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class Html
{
    use AdapterTrait;

    /**
     * @param $value
     * @param $options
     * @return string
     * @throws InvalidConfigException|\ReflectionException
     * @see \yii\bootstrap4\Html::staticControl()
     * @see \yii\bootstrap5\Html::staticControl()
     */
    public static function staticControl($value, $options = [])
    {
        $config['class'] = static::class;
        if (isset($options['bsVersion'])) {
            $config['bsVersion'] = ArrayHelper::remove($options, 'bsVersion');
        }
        /** @var static $object */
        $object = \Yii::createObject($config);
        return $object->call('staticControl', $config, $options, $value);
    }

    /**
     * @param Model $model
     * @param $attribute
     * @param $options
     * @return string
     * @throws InvalidConfigException|\ReflectionException
     * @see \yii\bootstrap5\Html::activeStaticControl()
     * @see \yii\bootstrap4\Html::activeStaticControl()
     */
    public static function activeStaticControl(Model $model, $attribute, $options = [])
    {
        $config['class'] = static::class;
        if (isset($options['bsVersion'])) {
            $config['bsVersion'] = ArrayHelper::remove($options, 'bsVersion');
        }
        /** @var static $object */
        $object = \Yii::createObject($config);
        return $object->call('activeStaticControl', $config, $options, null, $model, $attribute);
    }

    /**
     * @param $name
     * @param $selection
     * @param $items
     * @param $options
     * @return string
     * @throws InvalidConfigException|\ReflectionException
     * @see \yii\bootstrap4\Html::radioList()
     * @see \yii\bootstrap5\Html::radioList()
     */
    public static function radioList($name, $selection = null, $items = [], $options = [])
    {
        $config['class'] = static::class;
        if (isset($options['bsVersion'])) {
            $config['bsVersion'] = ArrayHelper::remove($options, 'bsVersion');
        }
        /** @var static $object */
        $object = \Yii::createObject($config);
        return $object->call('radioList', $config, $options, null, null, null, $name, $selection, $items);
    }

    /**
     * @param $name
     * @param $selection
     * @param $items
     * @param $options
     * @return string
     * @throws InvalidConfigException|\ReflectionException
     * @see \yii\bootstrap4\Html::checkboxList()
     * @see \yii\bootstrap5\Html::checkboxList()
     */
    public static function checkboxList($name, $selection = null, $items = [], $options = [])
    {
        $config['class'] = static::class;
        if (isset($options['bsVersion'])) {
            $config['bsVersion'] = ArrayHelper::remove($options, 'bsVersion');
        }
        /** @var static $object */
        $object = \Yii::createObject($config);
        return $object->call('checkboxList', $config, $options, null, null, null, $name, $selection, $items);
    }

    /**
     * @param $model
     * @param $attribute
     * @param $options
     * @return string
     * @throws InvalidConfigException|\ReflectionException
     * @see \yii\bootstrap5\Html::error()
     * @see \yii\bootstrap4\Html::error()
     */
    public static function error($model, $attribute, $options = [])
    {
        $config['class'] = static::class;
        if (isset($options['bsVersion'])) {
            $config['bsVersion'] = ArrayHelper::remove($options, 'bsVersion');
        }
        /** @var static $object */
        $object = \Yii::createObject($config);
        return $object->call('error', $config, $options, null, $model, $attribute);
    }

    /**
     * Detects the current bsVersion and calls the static function of the appropriate bs Version
     * @param $method
     * @param $config
     * @param $options
     * @param null $value
     * @param null $model
     * @param null $attribute
     * @param null $name
     * @param null $selection
     * @param null $items
     * @return string
     * @throws InvalidConfigException
     * @throws \ReflectionException
     */
    protected function call(
        $method,
        $config,
        $options,
        $value = null,
        $model = null,
        $attribute = null,
        $name = null,
        $selection = null,
        $items = null
    ) {
        $bsVersion = $this->getBsVersion($config);
        $majorBsVersion = $this->getMajorBsVersion($bsVersion);

        /** @var \yii\bootstrap4\Html|\yii\bootstrap5\Html $fq */
        $fq = $this->getClass($majorBsVersion);
        $config = $this->sanitizeConfig($fq, $config);
        switch ($method) {
            case 'staticControl':
                return $fq::staticControl($value, $options);
            case 'activeStaticControl':
                return $fq::activeStaticControl($model, $attribute, $options);
            case 'radioList':
                return $fq::radioList($name, $selection, $items, $options);
            case 'checkboxList':
                return $fq::checkboxList($name, $selection, $items, $options);
            case 'error':
                return $fq::error($model, $attribute, $options);
            default:
                throw new InvalidConfigException('Method ' . $method . ' of class ' . $fq . ' does not exist.');
        }
    }
}
