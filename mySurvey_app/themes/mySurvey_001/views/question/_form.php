<?php
/**
 * @var $this SurveyController
 * @var $question SurveyQuestion 
 */

?>

<li class="question_summary <?php echo $question->class; ?>"> 
        <div class="row clearfix" data-editable="true">
            <div class="details">
                <?php echo CHtml::error($question, 'text',array('successCssClass','success'));?>
                <span data-hide-on-edit="true" class="text"><?php echo $question->text ?></span>  
                <span data-hide-on-edit="true" class="type"><?php echo $question->type_choices[$question->type]; ?></span>  
                <?php 
                    echo CHtml::activeTextField($question, 'text', array(
                        'name'=>$question->getNameForAttribute('text'), 
                        'disabled'=>$question->disabled,
                        'data-show-on-edit'=>'true',
                        'data-source'=>'.text'
                    ));
                    echo CHtml::activeDropDownList($question, 'type', $question->type_choices, array(
                        'name'=>$question->getNameForAttribute('type'), 
                        'disabled'=>$question->disabled,
                        'data-show-on-edit'=>'true',
                        'data-source'=>'.type'
                    ));
                    echo CHtml::activeHiddenField($question, 'id', array(
                        'name'=>$question->getNameForAttribute('id'), 
                        'disabled'=>$question->disabled
                    )); 
                    echo CHtml::activeHiddenField($question, 'delete', array(
                        'name'=>$question->getNameForAttribute('delete'), 
                        'disabled'=>$question->disabled
                    )); 
                ?>
            </div>
            <div class="buttons">
                <a class="delete" href="#">Delete</a>
                <a class="edit" href="#">Edit</a> 
            </div>
        </div>
        <div class="row">
            <ul id="answers_<?php echo $question->answersUniqueId; ?>" class="sortable">
                <?php $this->renderPartial('/answer/_form',array(
                    'answer'=>new SurveyAnswer('template')
                )); ?>
                <?php foreach($question->answers as $idx => $answer) {?>
                    <?php $this->renderPartial('/answer/_form',array(
                        'answer'=>$answer
                    )); ?>
                <?php }?>
                <li class="trash"><?php //trash goes after this list item. ?></li>
            </ul>
            <div class="row buttons">
                    <a class="add-sortable <?php if($question->type == 0 && count($question->answers)>0){echo "hide";} ?>" data-parent-type="<?php echo $question->type; ?>" data-target="#answers_<?php echo $question->answersUniqueId; ?>" href="#">Add new answer'</a>
            </div>
        </div>
</li>