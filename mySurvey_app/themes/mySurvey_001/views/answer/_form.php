<?php
/**
 * @var $this SurveyController
 * @var $question SurveyQuestion 
 */
?>

<li class="answer_summary <?php echo $answer->get_class(); ?>"> 
	<div class="row answers clearfix" data-editable="true">
        <div class="details">
		    <?php echo CHtml::error($answer, 'text',array('successCssClass','success'));?>
		    <span data-hide-on-edit="true" class="text"><?php echo $answer->text ?></span>   
		    <span data-hide-on-edit="true" class="choice_letter"><?php echo $answer->choice_letter ?></span>
		    <?php 
		        echo CHtml::activeTextField($answer, 'text', array(
		            'name'=>$answer->getNameForAttribute('text'), 
		            'disabled'=>$answer->disabled,
		            'data-show-on-edit'=>'true',
		            'data-source'=>'.text'
		        ));
                echo '<br/>disabled:'.$answer->disabled;
                echo '<br/>class:'.$answer->get_class();
                echo '<br/>scenario:'.$answer->scenario;
		        echo CHtml::activeHiddenField($answer, 'id', array(
		            'name'=>$answer->getNameForAttribute('id'), 
		            'disabled'=>$answer->disabled
		        )); 
		        echo CHtml::activeHiddenField($answer, 'delete', array(
		            'name'=>$answer->getNameForAttribute('delete'), 
		            'disabled'=>$answer->disabled
		        )); 
		    ?>
		
			<div class="buttons">
		    	<a class="delete <?php echo $answer->delete_button_class; ?>" href="#">Delete Answer</a>
				<a class="edit" href="#">Edit Answer</a>
			</div> 
	    </div>
	</div>
</li>