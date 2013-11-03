<?php
/**
 * @var $this SurveyQuestionController
 * @var $model SurveyQuestion 
 * @var $form CActiveForm
 */

?>
<li class="question_summary <?php echo $model->class; ?>"> 
        <div class="row">
            <?php echo CHtml::error($model, 'text',array('successCssClass','success'));?>
            <span class="text"><?php echo $model->text ?></span>   
            <?php 
                echo CHtml::activeHiddenField($model, 'text', array(
                    'name'=>$model->getNameForAttribute('text'), 
                    'disabled'=>$model->disabled
                ));
                echo CHtml::activeDropDownList($model, 'type', $model->type_choices, array(
                    'name'=>$model->getNameForAttribute('type'), 
                    'disabled'=>$model->disabled,
                ));
                echo CHtml::activeHiddenField($model, 'id', array(
                    'name'=>$model->getNameForAttribute('id'), 
                    'disabled'=>$model->disabled
                )); 
                echo CHtml::activeHiddenField($model, 'delete', array(
                    'name'=>$model->getNameForAttribute('delete'), 
                    'disabled'=>$model->disabled
                )); 
            ?>
            <a class="delete" href="#">Delete</a>
            <a class="edit" href="#">Edit</a> 
        </div>
</li>
