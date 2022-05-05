<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

namespace sandritsch91\yii2\bootstrapAdapter;

/**
 * @method init()
 * @method run()
 * @method registerClientScript()
 * @method string errorSummary($models, $options = [])
 * @method \yii\bootstrap5\ActiveField field($model, $attribute, $options = [])
 * @method string beginField($model, $attribute, $options = [])
 * @method string endField()
 *
 * @method \yii\bootstrap5\ActiveForm begin($config = [])
 * @method \yii\bootstrap5\ActiveForm end()
 * @method string widget($config = [])
 */
class ActiveForm
{
    use AdapterTrait;
}
