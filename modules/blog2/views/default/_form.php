<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Category;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Category::find()->getActive()->all(),'id','title'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a category ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]); ?>
    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'options' => ['row' => 6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'options' => ['row' => 6],
        'preset' => 'basic',
    ]) ?>
    <?= $form->field($model, 'img')->widget(FileInput::classname(), [
    'name' => 'img[]',
    'options'=>[
        'multiple'=>true
    ],
    'pluginOptions' => [
        'initialPreview'=>($model->img) ? Html::img($model->img, ['class'=>'file-preview-image']) : '',
        'overwriteInitial'=>true
    ]
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
