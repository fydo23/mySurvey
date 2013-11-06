<?php
    $this->pageTitle=Yii::app()->name;
?>

<!--======== SURVEY LANDING PAGE ========-->
<div class="page-name">
	<h1>Surveys</h1>
</div>


<!--======== CREATE NEW SURVEY ========-->
<div id="new">
    <a href="<?php echo $this->createUrl('/survey/create')?>" class="button">Create New Survey</a>
</div>


<!--======== PUBLISHIED SURVEYS ========-->
<div id="published">
	<h2>Published</h2>

	<ul class="survey-lists">
		<?php foreach($published_dataProvider->getData() as $record) { ?>
		<li>
        	<?php echo $record->title ?>
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/delete/' . $record->id; ?>">Delete</a>
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/unpublish/' . $record->id; ?>">Unpublish</a>
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/update/' . $record->id; ?>">Edit</a>
                
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
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/delete/' . $record->id; ?>">Delete</a>
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/publish/' . $record->id; ?>">Publish</a>
			<a href="<?php echo Yii::app()->request->baseUrl . '/survey/update/' . $record->id; ?>">Edit</a>
        
        
		</li>
		<?php } ?>
	</ul>
</div>