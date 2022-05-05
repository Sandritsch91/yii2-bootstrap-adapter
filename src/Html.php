<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter;

use yii\base\Model;

/**
 * @method string staticControl(string $value, array $options = [])
 * @method string activeStaticControl(Model $model, string $attribute, array $options = [])
 *
 *
 * @method string encode($content, $doubleEncode = true)
 * @method string decode($content)
 * @method string tag($name, $content = '', $options = [])
 * @method string beginTag($name, $options = [])
 * @method string endTag($name)
 * @method string style($content, $options = [])
 * @method string script($content, $options = [])
 * @method string cssFile($url, $options = [])
 * @method string jsFile($url, $options = [])
 * @method string csrfMetaTags()
 * @method string beginForm($action = '', $method = 'post', $options = [])
 * @method string endForm()
 * @method string a($text, $url = null, $options = [])
 * @method string mailto($text, $email = null, $options = [])
 * @method string img($src, $options = [])
 * @method string label($content, $for = null, $options = [])
 * @method string button($content = 'Button', $options = [])
 * @method string submitButton($content = 'Submit', $options = [])
 * @method string resetButton($content = 'Reset', $options = [])
 * @method string input($type, $name = null, $value = null, $options = [])
 * @method string buttonInput($label = 'Button', $options = [])
 * @method string submitInput($label = 'Submit', $options = [])
 * @method string resetInput($label = 'Reset', $options = [])
 * @method string textInput($name, $value = null, $options = [])
 * @method string hiddenInput($name, $value = null, $options = [])
 * @method string passwordInput($name, $value = null, $options = [])
 * @method string fileInput($name, $value = null, $options = [])
 * @method string textarea($name, $value = '', $options = [])
 * @method string radio($name, $checked = false, $options = [])
 * @method string checkbox($name, $checked = false, $options = [])
 * @method string dropDownList($name, $selection = null, $items = [], $options = [])
 * @method string listBox($name, $selection = null, $items = [], $options = [])
 * @method string checkboxList($name, $selection = null, $items = [], $options = [])
 * @method string radioList($name, $selection = null, $items = [], $options = [])
 * @method string ul($items, $options = [])
 * @method string ol($items, $options = [])
 * @method string activeLabel($model, $attribute, $options = [])
 * @method string activeHint($model, $attribute, $options = [])
 * @method string errorSummary($models, $options = [])
 * @method string error($model, $attribute, $options = [])
 * @method string activeInput($type, $model, $attribute, $options = [])
 * @method array activeTextInput($model, $attribute, $options = [])
 * @method string activeHiddenInput($model, $attribute, $options = [])
 * @method string activePasswordInput($model, $attribute, $options = [])
 * @method string activeFileInput($model, $attribute, $options = [])
 * @method string activeTextarea($model, $attribute, $options = [])
 * @method string activeRadio($model, $attribute, $options = [])
 * @method string activeCheckbox($model, $attribute, $options = [])
 * @method string activeDropDownList($model, $attribute, $items, $options = [])
 * @method string activeListBox($model, $attribute, $items, $options = [])
 * @method string activeCheckboxList($model, $attribute, $items, $options = [])
 * @method string activeRadioList($model, $attribute, $items, $options = [])
 * @method string renderSelectOptions($selection, $items, &$tagOptions = [])
 * @method string renderTagAttributes($attributes)
 * @method string addCssClass(&$options, $class)
 * @method string removeCssClass(&$options, $class)
 * @method string addCssStyle(&$options, $style, $overwrite = true)
 * @method string removeCssStyle(&$options, $properties)
 * @method string cssStyleFromArray(array $style)
 * @method array cssStyleToArray($style)
 * @method string getAttributeName($attribute)
 * @method array getAttributeValue($model, $attribute)
 * @method string getInputName($model, $attribute)
 * @method string getInputIdByName($name)
 * @method string getInputId($model, $attribute)
 * @method string escapeJsRegularExpression($regexp)
 */
class Html
{
    use AdapterTrait;
}
