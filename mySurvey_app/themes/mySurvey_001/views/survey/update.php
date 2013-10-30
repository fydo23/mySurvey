<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>

<!--======== EDIT SURVEY ========-->
<h1>Edit Survey: <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>


<!--======== FORM ========-->
<div class="form">
    <h4>Questions</h4>
    <div>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'question_order',
            'action'=>'/survey/reorderQuestions/survey_id/'.$model->id
        ));
        
        ?>
        <!--======== QUESTION LIST ========-->
        <ul id="sortable">
            <?php if(isset($questions_dataProvider)) { ?>
                <?php foreach($questions_dataProvider->getData() as $record) { ?>
                   <li class="question_summary" >
                       <span class="text"><?php echo $record->text ?></span>
                       <input class="order_number" type="hidden" name="SurveyQuestion[<?php echo $record->id ?>][order_number]" value="<?php echo $record->order_number ?>"/>
                       <a href="<?php echo Yii::app()->request->baseUrl . '/question/delete/' . $record->id; ?>">Delete</a>
                       <a href="<?php echo Yii::app()->request->baseUrl . '/question/update/' . $record->id; ?>">Edit</a>
                   </li>
                <?php } ?>   
            <?php } ?>
        </ul>
       
       
       <!--======== ADD NEW QUESTION ========-->
        <div class="row buttons">
            <?php echo CHtml::link('Add new question',array('/question/create/survey_id/' . $model->id)); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div><!-- form -->