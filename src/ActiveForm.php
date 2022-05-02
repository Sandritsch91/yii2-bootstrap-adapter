<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class ActiveForm
{
    use AdapterTrait;

    /**
     * @throws InvalidConfigException
     * @see \yii\widgets\ActiveForm::widget()
     */
    public static function widget($config = [])
    {
        $config['class'] = static::class;
        $object = \Yii::createObject($config);
        return $object->call('widget', $config);
    }

    /**
     * @throws InvalidConfigException
     * @see \yii\widgets\ActiveForm::begin()
     */
    public static function begin($config = [])
    {
        $config['class'] = static::class;
        $object = \Yii::createObject($config);
        return $object->call('begin', $config);
    }

    /**
     * @throws InvalidConfigException
     * @see \yii\widgets\ActiveForm::end()
     */
    public static function end()
    {
        $config['class'] = static::class;
        $object = \Yii::createObject($config);
        return $object->call('end');
    }

    /**
     * To change the bs version, add bsVersion => x to the attributes parameter
     * @throws InvalidConfigException
     * @see \yii\widgets\ActiveForm::validate()
     */
    public static function validate($model, $attributes = null)
    {
        $config['class'] = static::class;
        if (isset($attributes['bsVersion'])) {
            $config['bsVersion'] = ArrayHelper::remove($attributes, 'bsVersion');
        }
        $object = \Yii::createObject($config);
        return $object->call('validate', $config, $model, $attributes);
    }

    /**
     * To change the bs version, add bsVersion => x to the attributes parameter
     * @throws InvalidConfigException
     * @see \yii\widgets\ActiveForm::validateMultiple()
     */
    public static function validateMultiple($models, $attributes = null)
    {
        $config['class'] = static::class;
        if (isset($attributes['bsVersion'])) {
            $config['bsVersion'] = ArrayHelper::remove($attributes, 'bsVersion');
        }
        $object = \Yii::createObject($config);
        return $object->call('validateMultiple', $config, $models, $attributes);
    }

    /**
     * Detects the current bsVersion and calls the static function of the appropriate bs Version
     * @throws InvalidConfigException|\ReflectionException
     * @throws \Exception
     */
    protected function call($method, $config = [], $model = null, $attributes = null)
    {
        if ($method == 'end') {
            $bsVersion = static::$_bsVersion;
        } else {
            $bsVersion = $this->getBsVersion($config);
        }
        $majorBsVersion = $this->getMajorBsVersion($bsVersion);

        /** @var \yii\bootstrap\ActiveForm|\yii\bootstrap4\ActiveForm|\yii\bootstrap5\ActiveForm $fq */
        $fq = $this->getClass($majorBsVersion);
        $config = $this->sanitizeConfig($fq, $config);
        switch ($method) {
            case 'widget':
                return $fq::widget($config);
            case 'begin':
                static::$_bsVersion = $majorBsVersion;
                return $fq::begin($config);
            case 'end':
                return $fq::end();
            case 'validate':
                return $fq::validate($model, $attributes);
            case 'validateMultiple':
                return $fq::validateMultiple($model, $attributes);
            default:
                throw new InvalidConfigException('Method ' . $method . ' of class ' . $fq . ' does not exist.');
        }
    }
}
