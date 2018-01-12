<?php
use yii\helpers\Html;
?>
<?php
$content = Html::beginTag('div');
$content .= Html::hiddenInput($this->name, null, [
    'class' => 'empty-value',
    'id' => $this->options['id']
]);
$content .= Html::fileInput($this->getFileInputName(), null, [
    'name' => $this->getFileInputName(),
    'id' => $this->getId(),
]);
$content .= Html::endTag('div');
$html=$this->render('_inner',[]);
echo $content.$html;
?>