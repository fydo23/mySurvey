<?php
/* @var $this SiteController */


$this->pageTitle=Yii::app()->name;
?>

<div class="page-name">
	<h1>Survey Editor</h1>
</div>

<div id="toolbar">
	<div id="survey-name">
		<h2>Survey Name Here</h2>
	</div>
	
	<div id="sub-menu">
		<ul>
			<li><a href="#">Preview</a></li>
			<li><a href="#">Publish</a></li>
			<li><a href="#">Delete</a></li>
		</ul>
	</div>		
	
</div>



<div id="name-url">
		<div id="name">
			<h4>Edit Survey Name</h4>
			<input type="text" name="surveyname" value="Survey Name Here">
		</div>
		
		<div id="url">
			<h4>Survey URL</h4>
			<p>URL goes here</p>
		</div>
</div>
	
<div id="main-editor">
	<div id="question-editor">
		<h3>Edit Questions</h3>
		
		<p class="placeholder">Questions will go here.</p>
		
		<a href="#" class="button">Save</a>
			
	</div>
		
		
	<div id="question-sidebar">
		<h4 id="standard">Standard Questions</h4>
		<a href="#" class="question-button">Multiple Choice</a>
			
			
		<h4 id="advanced">Advanced Options</h4>
		<p>Options tk</p>
			
	</div>
		
		
</div>