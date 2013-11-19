<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $questions_dataProvider CActiveDataProvider*/

?>

<!--======== EDIT SURVEY ========-->
<div class="stripe">
	<div class="page-name">
		<h1>Survey Editor</h1>
		<p class="intro-text">Edit your survey fields including Survey Title, Questions &amp; Answers.</p>
	</div>
</div>

<div class="content-width">
    <div class="form">
        <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/static/js/survey_update.js', CClientScript::POS_END); ?>
        
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
                <div class="row buttons" id="save-cancel">
                    <?php echo CHtml::submitButton('Save Changes'); ?>
                    <?php echo CHtml::link('Back to all Surveys', Yii::app()->request->baseUrl.'/survey') ?>
                </div>

                <div class="row">
                	<?php echo $form->labelEx($model,'title'); ?>
                    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100, 'class'=>'title')); ?>
                    <span class="arrow-left"></span><?php echo $form->error($model,'title',array('successCssClass','success')); ?>
                </div>
                
                <div id="survey-url">
                    <?php $url = Yii::app()->request->baseUrl."/survey/take/".$model->url; ?>
					<h3>Survey URL:</h3><a href="<?php echo yii::app()->baseUrl . $url; ?>"><?php echo $url; ?></a>
				</div>

                <h4 id="question-title">Questions</h4>
                <ul id="questions" class="sortable">
                    <?php echo $this->renderPartial('/question/_form',array(
                        'question'=>new SurveyQuestion('template')
                    )); ?>
                    <?php foreach($questions as $record) { ?>
                        <?php echo $this->renderPartial('/question/_form',array(
                            'question'=>$record
                        )); 
                    ?>
                    <?php } ?>  
                    <li class="trash"><?php //trash goes after this list item. ?></li>
                </ul>

                <div class="row buttons" id="add-new-question">
                        <a class="add-sortable" data-model="question" data-target="#questions" href="#">Add New Question</a>
                </div>
        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>