<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

trait AdapterTrait
{
    /** @var int[] All existing bootstrap versions with their suffix */
    protected $bsVersions = [3 => '', 4 => '4', 5 => '5'];

    /** @var array Array of available configs per class. Used to save time if class gets called multiple times */
    protected $arrAvailable = [];

    /** @var int Save bsVersion in method begin, to use in method end */
    protected static $_bsVersion = null;

    /** @var mixed instance of the wrapped class */
    private $_instance;

    /**
     * Overwrite magic method __call
     * @param $name
     * @param $params
     * @return mixed|void
     */
    public function __call($name, $params)
    {
        $r = new \ReflectionClass(get_class($this->_instance));
        if (!$r->hasMethod($name)) {
            return;
        }
        return call_user_func_array([$this->_instance, $name], $params);
    }

    /**
     * Overwrite magic method __set
     * @param $name
     * @param $value
     * @return void
     */
    public function __set($name, $value)
    {
        if (!is_object($this->_instance)) {
            return;
        }

        $r = new \ReflectionClass(get_class($this->_instance));
        if (!$r->hasProperty($name)) {
            return;
        }

        $this->_instance->{$name} = $value;
    }

    /**
     * Overwrite magic method __get
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $r = new \ReflectionClass(get_class($this->_instance));
        if (!$r->hasProperty($name)) {
            return null;
        }

        return $this->_instance->{$name};
    }

    /**
     * Returns the bootstrap version determined by the following order
     * - parameter bsVersion passed to widget
     * - parameter bsVersion defined in $app params
     * - A fallback
     * @param $config
     * @return int|mixed|null
     */
    protected function getBsVersion(&$config)
    {
        $fallback = 5;
        if (ArrayHelper::keyExists('bsVersion', $config)) {
            $bsVersion = ArrayHelper::remove($config, 'bsVersion');
        } elseif (isset(\Yii::$app->params['bsVersion'])) {
            $bsVersion = \Yii::$app->params['bsVersion'];
        } else {
            $bsVersion = $fallback;
        }
        return $bsVersion;
    }

    /**
     * Get major bs version. E.g 3, 4 or 5
     * @return int
     */
    protected function getMajorBsVersion($str)
    {
        $version = substr($str, 0, 1);
        return (int)$version;
    }

    /**
     * Create and return full qualified class name by bootstrap version
     * @param $bsVersion
     * @return string
     * @throws InvalidConfigException
     */
    protected function getClass($bsVersion)
    {
        // Get bootstrap version and create fq of target framework
        $versionSuffix = $this->bsVersions[$bsVersion];
        $class = basename(static::class);
        $fq = "yii\\bootstrap$versionSuffix\\$class";
        if (!class_exists($fq)) {
            throw new InvalidConfigException('Class ' . $fq . ' does not exist!');
        }
        return $fq;
    }

    /**
     * Removes properties not defined by the class to instantiate
     * @param $fq
     * @param $config
     * @return array
     * @throws \ReflectionException
     */
    protected function sanitizeConfig($fq, $config)
    {
        $r = new \ReflectionClass($fq);
        if (array_key_exists($fq, $this->arrAvailable)) {
            $available = $this->arrAvailable[$fq];
        } else {
            $available = ArrayHelper::getColumn($r->getProperties(\ReflectionProperty::IS_PUBLIC), 'name');
            $this->arrAvailable[$fq] = $available;
        }

        foreach($config as $key => $value) {
            if (!in_array($key, $available)){
                ArrayHelper::remove($config, $key);
            }
        }

        return $config;
    }
}
