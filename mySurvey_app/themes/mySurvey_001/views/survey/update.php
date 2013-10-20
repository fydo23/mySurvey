<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>

<h1>Edit Survey: <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<style>
    [draggable="true"]{
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        /* Required to make elements draggable in old WebKit */
        -khtml-user-drag: element;
        -webkit-user-drag: element;
        cursor: move;
    }
    .question_summary{
        height:10px;
        width:500px; 
        border:1px solid #5887A2;
        background:#A1DCE7;
        padding: 8px 20px;
        margin: 5px 0px;
    }
    .question_summary .order_number{
        float: left;
    }
    .question_summary a{
        float:right;
        margin-left: 10px;
    }
    .dragging{
        border: 2px dashed;
        margin:-1px;
        background:#E4F5F8;
    }
</style>

<div class="form">
    <h4>Questions</h4>
    <div>
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'question_order',
            'action'=>'/survey/reorderQuestions/survey_id/'.$model->id
        ));
        
        ?>
        <ul>
            <?php if(isset($questions_dataProvider)) { ?>
                <?php foreach($questions_dataProvider->getData() as $record) { ?>
                   <li class="question_summary" draggable="true">
                       <span class="text"><?php echo $record->text ?></span>
                       <input class="order_number" type="hidden" name="SurveyQuestion[<?php echo $record->id ?>][order_number]" value="<?php echo $record->order_number ?>"/>
                       <a href="<?php echo Yii::app()->request->baseUrl . '/question/delete/' . $record->id; ?>">Delete</a>
                       <a href="<?php echo Yii::app()->request->baseUrl . '/question/update/' . $record->id; ?>">Edit</a>
                   </li>
                <?php } ?>   
            <?php } ?>
        </ul>
        <div class="row buttons">
            <?php echo CHtml::link('Add new question',array('/question/create/survey_id/' . $model->id)); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>