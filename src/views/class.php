<?php
/**
 * @author Sandro Venetz <venetz@tonic.ag>
 * @date 02.05.2022
 */

/** @var $this \yii\web\View */
/** @var $namespace string */
/** @var $uses array */
/** @var $description string */
/** @var $className string */
/** @var $extends string */
/** @var $constants ReflectionClassConstant[] */
/** @var $properties array */
/** @var $methods array */
/** @var $module Module */

use sandritsch91\yii2\bootstrapAdapter\Module;

$separator = str_contains($description, '@') ? '@' : '*/';
$arrDescription = explode($separator, $description, 2);

echo '<?php' . "\n";
?>
/**
 * This file was autogenerated.
 * To regenerate, execute sandritsch91\yii2\bootstrapAdapter\commands\GeneratorController::actionAdapterClasses()
 */

namespace <?= $namespace ?>;

<?php foreach ($uses as $line => $value): ?>
<?= $line; ?>
<?php endforeach ?>

<?= $arrDescription[0] ?>
<?php foreach ($properties as $name => $property) : ?>
<?php
if ($property['type']) {
    $type = $property['type'];
} else {
    $matches = [];
    if (preg_match_all('/@var\s*([A-Za-z\|\\\]*)/', $property['description'], $matches)) {
        $type = $matches[1][0];
    } else {
        $type = 'mixed';
    }
}
?>

 * <?= $property['isReadOnly'] ? '@property-read' : '@property' ?> <?= $type ?> <?= $name ?>
<?php endforeach ?>
<?= "\n *\n" ?>
<?php foreach ($methods as $name => $method) : ?>
<?php
if ($method['returnType']) {
    $returnType = $method['returnType'];
} else {
    $matches = [];
    if (preg_match_all('/@return\s*([A-Za-z\|\\\]*)/', $method['description'], $matches)) {
        $returnType = $matches[1][0];
    } else {
        $returnType = 'void';
    }
}
?>
 * @method <?= $returnType ?> <?= $name ?>(<?= $module::printMethodParameters($method['parameters'], true, $method['description']) ?>)
<?php endforeach ?>
<?= " *\n * " . $separator . $arrDescription[1] . "\n" ?>
class <?= $className ?> extends <?= $extends . "\n" ?>
{
<?php foreach ($constants as $constant) : ?>
    <?= $constant->getDocComment() . "\n" ?>
    const <?= $constant->name ?><?= $module::printDefault($constant->getValue()) ?>;

<?php endforeach ?>
<?php foreach ($properties as $name => $property) : ?>
    <?= $property['description'] . "\n" ?>
    public $<?= $name ?><?=$module::printDefault($property['default'])?>;

<?php endforeach ?>
}
