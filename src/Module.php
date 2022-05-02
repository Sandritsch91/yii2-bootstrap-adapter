<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\console\Application;

class Module extends \tonic\hq\base\Module
{
    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();
    }

    /**
     * {@inheritDoc}
     */
    public function bootstrap($app)
    {
        if ($app instanceof Application) {
            $this->controllerNamespace = 'sandritsch91\yii2\bootstrapAdapter\commands';
            $this->defaultRoute = 'generator';
        }

        parent::bootstrap($app);
    }

    /**
     * Print default values
     * @param $value
     * @return string
     */
    public static function printDefault($value, $printEqual = true)
    {
        $str = '';
        if (is_null($value)) {
            $str = 'null';
        } elseif (is_numeric($value)) {
            $str = $value;
        } elseif (is_string($value)) {
            $str = "'$value'";
        } elseif (is_bool($value)) {
            $str = $value ? 'true' : 'false';
        } elseif (is_array($value)) {
            $str = static::printArray($value);
        }
        return ($printEqual ? ' = ' : '') . $str;
    }

    /**
     * Prints an array recursively
     * @param $array
     * @return string
     */
    protected static function printArray($array)
    {
        $str = '[';
        foreach ($array as $key => $value) {
            $key = is_integer($key) ? $key : "'$key'";
            $str .= $str != '[' ? ', ' : '';

            if (is_array($value)) {
                $str .= $key . ' => ' . static::printArray($value);
            } else {
                $str .= $key . ' => ' . static::printDefault($value, false);
            }
        }
        $str .= ']';
        return $str;
    }

    /**
     * @param \ReflectionParameter[] $parameters
     * @return string
     * @throws \ReflectionException
     */
    public static function printMethodParameters($parameters, $isComment = false, $description = '')
    {
        $str = '';
        foreach ($parameters as $parameter) {
            $str .= $str != '' ? ', ' : '';
            if ($parameter->hasType()) {
                $type = $parameter->getType();
                if (!$type->isBuiltin() || $isComment) {
                    $str .= str_replace('?', '\\', $type) . ' ';
                }
            } elseif ($isComment) {
                if (preg_match_all('/@param\s*([A-Za-z\|\\\]*)\s*\\$' . $parameter->name . '/', $description, $matches)) {
                    $type = $matches[1][0];
                    $str .= $type . ' ';
                }
            }
            $str .= '$' . $parameter->name;

            if ($parameter->isOptional()) {
                $value = $parameter->getDefaultValue();
                $str .= static::printDefault($value);
            }
        }
        return $str;
    }
}
