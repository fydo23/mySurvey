<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>
<style>
    
    
    [draggable="true"]{
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        /* Required to make elements draggable in old WebKit */
        -khtml-user-drag: element;
        -webkit-user-drag: element;
    }
    .question_summary{
        height:10px;
        width:500px; 
        border:1px solid #5887A2;
        background:#A1DCE7;
        padding: 8px 20px;
        margin: 5px 0px;
    }
    #sortable li{
        cursor: move;
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
    input[name="Survey[title]"]{
        font-size: 23px;
        width:530px;
    }
    .success input{
        border-color: green;
    }
    .error .errorMessage, .error .arrow-left{
        margin-top:6px;
    }
    .error .errorMessage{
        padding:7px 15px;
    }
</style>


<h1>Edit Survey:</h1>

<div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'survey-form',
                'focus'=>array($model, 'title'),
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                       'validateOnChange'=>true,
                       'validateOnType'=>true,
                )
        )); ?>
            <?php echo $form->errorSummary($model); ?>
            <div class="row">
                    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
                    <span class="arrow-left"></span><?php echo $form->error($model,'title',array('successCssClass','success')); ?>
            </div>
        <?php $this->endWidget(); ?>
            
            
            <h4>Questions</h4>
            <div>  
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'=>'question_order',
                    'action'=>'/survey/reorderQuestions/survey_id/'.$model->id
                ));?>
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
                <?php $this->endWidget(); ?>
            </div>
            <div class="row buttons">
                <?php echo CHtml::link('Add new question',array('/question/create/survey_id/' . $model->id)); ?>
            </div>
            

</div><!-- form -->
