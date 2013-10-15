<?php
    $this->pageTitle=Yii::app()->name;
?>

<div class="page-name">
	<h1>Surveys</h1>
</div>

<div id="new">
    <a href="<?php echo $this->createUrl('/survey/create')?>" class="button">Create New Survey</a>
</div>


<div id="published">
	<h2>Published</h2>
</div>
<ul>
<?php foreach($published_dataProvider->getData() as $record) { ?>
    <li>
        <?php echo $record->title ?>
        <a href="<?php echo Yii::app()->request->baseUrl . '/survey/update/' . $record->id; ?>">Edit</a>
        <a href="<?php echo Yii::app()->request->baseUrl . '/survey/unpublish/' . $record->id; ?>">Unpublish</a>
        <a href="<?php echo Yii::app()->request->baseUrl . '/survey/delete/' . $record->id; ?>">Delete</a>
    </li>
<?php } ?>
</ul>

<div id="unpublished">
	<h2>Unpublished</h2>
</div>
<ul>
<?php foreach($unPublished_dataProvider->getData() as $record) { ?>
    <li>
        <?php echo $record->title ?>
        <a href="<?php echo Yii::app()->request->baseUrl . '/survey/update/' . $record->id; ?>">Edit</a>
        <a href="<?php echo Yii::app()->request->baseUrl . '/survey/publish/' . $record->id; ?>">Publish</a>
        <a href="<?php echo Yii::app()->request->baseUrl . '/survey/delete/' . $record->id; ?>">Delete</a>
    </li>
<?php } ?>
</ul>