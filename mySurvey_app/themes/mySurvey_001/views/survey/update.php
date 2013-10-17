<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>

<h1>Update Survey <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<div class="form">
    <h4>Questions</h4>
    <div>
        <ul>
            <?php if(isset($questions_dataProvider)) { ?>
                <?php foreach($questions_dataProvider->getData() as $record) { ?>
                   <li>
                       <?php echo $record->order_number ?>: 
                       <?php echo $record->text ?>
                       <a href="<?php echo Yii::app()->request->baseUrl . '/question/update/' . $record->id; ?>">Edit</a>
                       <a href="<?php echo Yii::app()->request->baseUrl . '/question/delete/' . $record->id; ?>">Delete</a>
                   </li>
                <?php } ?>   
            <?php } ?>
        </ul>
        <?php if (isset($model->id)) { ?>
            <div class="row buttons">
                <?php echo CHtml::link('Add new question',array('/question/create/survey_id/' . $model->id)); ?>
            </div>
        <?php } ?> 
    </div>
</div>