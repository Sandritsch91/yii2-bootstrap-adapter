<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\InvalidConfigException;
use yii\helpers\ReplaceArrayValue;
use yii\helpers\UnsetArrayValue;

/**
 * Helper class to help with yii2's bootstrap repos
 */
class AdapterHelper extends \yii\base\BaseObject
{
    const BEFORE = 'input-group-prepend';
    const AFTER = 'input-group-append';

    /**
     * Returns the majorBsVersion
     * @return int
     */
    public static function getMajorBsVersion()
    {
        $obj = new Widget();
        $bsVersion = $obj->getBsVersion();

        return $obj->getMajorBsVersion($bsVersion);
    }

    /**
     * Print strings depending on bsVersion
     *
     * E.g. different classes for each bsVersion:
     * [3 => ['class1', 'class2'], 4 => ['class3'], ...]
     *
     * @param array $strings An array containing majorBsVersion as keys, and sub-arrays with classes as values
     * @param string $separator The separator to use. Default is a space ' '
     * @return string The strings according to the bsVersion. Empty string if no matching classes were found
     */
    public static function printStrings($strings, $separator = ' ')
    {
        $bsVersion = static::getMajorBsVersion();
        if (isset($strings[$bsVersion])) {
            return implode($separator, $strings[$bsVersion]);
        }
        return '';
    }

    /**
     * Alias of printStrings
     * @return string
     * @see AdapterHelper::printStrings()
     */
    public static function ps()
    {
        return call_user_func_array([static::class, 'printStrings'], func_get_args());
    }

    /**
     * Handle suffixes of data attributes
     * @param array $classes Additional classes to append
     * @return string
     */
    public static function dataSuffix($classes = [])
    {
        $strings = [5 => ['bs-']];
        $strings = static::merge($strings, $classes);
        return static::printStrings($strings);
    }

    /**
     * Handle class for form-group
     * @param array $classes Additional classes to append
     * @return string
     */
    public static function formGroup(array $classes = [])
    {
        $strings = [3 => ['form-group'], 4 => ['form-group']];
        $strings = static::merge($strings, $classes);
        return static::printStrings($strings);
    }

    /**
     * Handle class for form-row / row
     * @param array $classes Additional classes to append
     * @return string
     */
    public static function formRow($classes = [])
    {
        $strings = [3 => ['form-row'], 4 => ['form-row'], 5 => ['row']];
        $strings = static::merge($strings, $classes);
        return static::printStrings($strings);
    }

    /**
     * Handle class for form-inline / row
     * @param array $classes Additional classes to append
     * @return string
     */
    public static function formInline($classes = [])
    {
        $strings = [3 => ['form-inline'], 4 => ['form-inline'], 5 => []];
        $strings = static::merge($strings, $classes);
        return static::printStrings($strings);
    }

    /**
     * Handle class for label-tag
     * @param array $classes Additional classes to append
     * @return string
     */
    public static function labelClass($classes = [])
    {
        $strings = [4 => ['form-label']];
        $strings = static::merge($strings, $classes);
        return static::printStrings($strings);
    }

    /**
     * Handle class for close button
     * @param array $classes Additional classes to append
     * @return string
     */
    public static function closeBtn($classes = [])
    {
        $strings = [3 => ['close'], 4 => ['close'], 5 => ['btn-close']];
        $strings = static::merge($strings, $classes);
        return static::printStrings($strings);
    }

    /**
     * Handle text / font monospace
     * @param array $classes Additional classes to append
     * @return string
     */
    public static function monospace($classes = [])
    {
        $strings = [4 => ['text-monospace'], 5 => ['font-monospace']];
        $strings = static::merge($strings, $classes);
        return static::printStrings($strings);
    }

    /**
     * Handle font-weight / fw
     * @param string $class Pass either one, the correct classes are returned according to the bsVersion
     * @return string
     */
    public static function fontWeight($class)
    {
        switch (static::getMajorBsVersion()) {
            case 3:
                // NOP
                break;
            case 4:
                $class = str_replace('fw', 'font-weight', $class);
                break;
            case 5:
                $class = str_replace('font-weight', 'fw', $class);
                break;
        }
        return $class;
    }

    /**
     * Handle font-style / fst
     * @param string $class Pass either one, the correct classes are returned according to the bsVersion
     * @return string
     */
    public static function fontStyle($class)
    {
        switch (static::getMajorBsVersion()) {
            case 3:
                // NOP
                break;
            case 4:
                $class = str_replace('fst', 'font-style', $class);
                break;
            case 5:
                $class = str_replace('font-style', 'fst', $class);
                break;
        }
        return $class;
    }

    /**
     * Handle sr-only / visually-hidden
     * @param string $class Pass either one, the correct classes are returned according to the bsVersion
     * @return string
     */
    public static function screenReader($class)
    {
        switch (static::getMajorBsVersion()) {
            case 3:
            case 4:
                $class = str_replace('visually-hidden', 'sr-only', $class);
                $class = str_replace('visually-hidden-focusable', 'sr-only-focusable', $class);
                break;
            case 5:
                $class = str_replace('sr-only', 'visually-hidden', $class);
                $class = str_replace('sr-only-focusable', 'visually-hidden-focusable', $class);
                break;
        }
        return $class;
    }

    /**
     * Handle left / right - start / end classes
     * @param string $class Pass either one, the correct classes are returned according to the bsVersion
     * @return string
     */
    public static function leftRight($class)
    {
        switch (static::getMajorBsVersion()) {
            case 3:
            case 4:
                $class = str_replace('start', 'left', $class);
                $class = str_replace('end', 'right', $class);

                $class = str_replace('ms-', 'ml-', $class);
                $class = str_replace('me-', 'mr-', $class);
                $class = str_replace('ps-', 'pl-', $class);
                $class = str_replace('pe-', 'pr-', $class);
                break;
            case 5:
                $class = str_replace('left', 'start', $class);
                $class = str_replace('right', 'end', $class);

                $class = str_replace('ml-', 'ms-', $class);
                $class = str_replace('mr-', 'me-', $class);
                $class = str_replace('pl-', 'ps-', $class);
                $class = str_replace('pr-', 'pe-', $class);
                break;
        }
        return $class;
    }

    /**
     * Handle badges
     * @param array $class Pass either one, the correct classes are returned according to the bsVersion
     * @return string
     */
    public static function badge($class)
    {
        switch (static::getMajorBsVersion()) {
            case 3:
                // NOP
                break;
            case 4:
                $class = str_replace('rounded-pill', 'badge-pill', $class);
                $class = str_replace('bg-', 'badge-', $class);
                break;
            case 5:
                $class = str_replace('badge-pill', 'rounded-pill', $class);
                $class = str_replace('badge-', 'bg-', $class);
                break;
        }
        return $class;
    }

    /**
     * Wraps the content in a div with the appropriate class (input-group-prepend or input-group-append) if necessary
     * @param string $content the content to be wrapped if necessary
     * @param string $type AdapterHelper::AFTER or AdapterHelper::BEFORE
     * @return string
     */
    public static function inputGroup($content, $type)
    {
        $str = $content;
        switch (static::getMajorBsVersion()) {
            case 3:
            case 4:
                $str = Html::tag('div', $str, ['class' => $type]);
                break;
            case 5:
                // NOP
                break;
        }
        return $str;
    }

    /**
     * Merges 2 indexed arrays
     * @param array $a
     * @param array $b
     * @return array
     */
    protected static function merge($a, $b)
    {
        foreach ($b as $k => $v) {
            if (!array_key_exists($k, $b)) {
                $a[$k] = [];
            }
            foreach ($v as $class) {
                $a[$k][] = $class;
            }
        }
        return $a;
    }
}
