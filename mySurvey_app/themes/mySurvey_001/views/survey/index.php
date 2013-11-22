<?php
    $this->pageTitle=Yii::app()->name;
?>

<!--======== SURVEY LANDING PAGE ========-->
<div class="stripe">
	<div class="page-name">
		<h1>Surveys</h1>
		<p class="intro-text">To get started, create a new survey. Or, manage your existing surveys below. </p>
		
		<div id="new">
    		<a href="<?php echo $this->createUrl('/survey/create')?>" class="button">Create New Survey</a>
		</div>
	
	</div>
	
	

</div>

<!--======== CREATE NEW SURVEY ========-->

<script>

	$(function(){
		$('.delete-confirm').on('click', function(e){
			e.preventDefault();
		})
		$('.delete-confirm').confirmOn('click', function(e, confirmed){
			if(confirmed) window.location = $(e.target).attr('href');
		});
	});

</script>

<div class="content-width">
<!--======== PUBLISHIED SURVEYS ========-->
<div id="published">
	<h2>Published</h2>
    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/static/js/jquery.confirm_on.js', CClientScript::POS_END); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(	Yii::app()->baseUrl.'/static/css/jquery.confirm_on.css'); ?>
    
	<ul class="survey-lists">
		<?php foreach($published_dataProvider->getData() as $record) { ?>
		<li>
        	<?php echo $record->title ?>
			<a class="delete-confirm" href="<?php echo Yii::app()->request->baseUrl . '/survey/delete/' . $record->id; ?>">Delete</a>
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/unpublish/' . $record->id; ?>">Unpublish</a>
                        <?php $url = Yii::app()->request->baseUrl."/survey/take/".$record->url; ?>
                        <a href="<?php echo $url; ?>">Preview</a>
		</li>
		<?php } ?>
	</ul>
</div>

<!--======== UNPUBLISHED SURVEYS ========-->
<div id="unpublished">
	<h2>Unpublished</h2>

	<ul class="survey-lists">
		<?php foreach($unPublished_dataProvider->getData() as $record) { ?>
		<li>
        	<?php echo $record->title ?>
			<a class="delete-confirm" href="<?php echo Yii::app()->request->baseUrl . '/survey/delete/' . $record->id; ?>">Delete</a>
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/publish/' . $record->id; ?>">Publish</a>
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/update/' . $record->id; ?>">Edit</a>
        
        
		</li>
		<?php } ?>
	</ul>
</div>

</div>