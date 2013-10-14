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
	<p>
            <?php
                $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=>$published_dataProvider,
                        'itemView'=>'_view',
                )); 
            ?>
        </p>
</div>


<div id="unpublished">
	<h2>Unpublished</h2>
	<p>
            <?php
                $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=>$unPublished_dataProvider,
                        'itemView'=>'_view',
                )); 
            ?>
        </p>
</div>