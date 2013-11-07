<?php
/**
 * @var $this SurveyController
 * @var $question SurveyQuestion 
 */
?>

<li class="answer_summary <?php echo $answer->class; ?>"> 
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
		        echo CHtml::activeHiddenField($answer, 'choice_letter', array(
		            'name'=>$answer->getNameForAttribute('choice_letter'), 
		            'disabled'=>$answer->disabled,
		            'data-show-on-edit'=>'true',
		            'data-source'=>'.choice_letter'
		        ));
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
		    	<a class="delete" href="#">Delete Answer</a>
				<a class="edit" href="#">Edit Answer</a>
			</div> 
	    </div>
	</div>
</li>