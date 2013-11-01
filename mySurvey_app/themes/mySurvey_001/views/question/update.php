<?php
/* @var $this SurveyQuestionController */
/* @var $model SurveyQuestion */ 

?>

<li class="question_summary <?php echo $model->template; ?>"> 
        <?php if($model->hasErrors()):?>
            <div class="row error">
                <?php if ($model->hasErrors()) echo reset(reset($model->getErrors())); //gets the first error ?>
            </div>
        <?php endif; ?>
        <br>
        <span class="text"><?php echo $model->text ?></span>      
        <input <?php echo $model->disabled; ?> type="hidden" name="SurveyQuestion[<?php echo $model->order_number?>][text]" value="<?php echo $model->text ?>"/> 
        <br>
        <?php // echo CHtml::activeRadioButtonList($model, 'type', array('Short Answer','Multiple Choice'));?>
        <input <?php echo $model->disabled; ?> type="radio" name="SurveyQuestion[<?php echo $model->order_number?>][type]" value="0" <?php if($model->type==0) echo 'checked="checked"'; ?> />
        <lable>Multiple Choice</lable>
        <input <?php echo $model->disabled; ?> type="radio" name="SurveyQuestion[<?php echo $model->order_number?>][type]" value="1" <?php if($model->type==1) echo 'checked="checked"'; ?>/>
        <lable>Short Answer</lable>
        <input <?php echo $model->disabled; ?> type="hidden" name="SurveyQuestion[<?php echo $model->order_number?>][id]" value="<?php echo $model->id ?>"/>
        <input <?php echo $model->disabled; ?> type="hidden" name="SurveyQuestion[<?php echo $model->order_number?>][status]" value="<?php echo $model->status ?>"/>
        <a class="delete" href="#">Delete</a>
        <a class="edit" href="#">Edit</a>
</li>
