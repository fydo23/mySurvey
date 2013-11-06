<?php

require __DIR__ . '/../php-webdriver/__init__.php';

class SurveyTest extends PHPUnit_Framework_TestCase {
	
	// change this url according to your local machine
	private $url = "http://localhost/mySurvey/mySurvey_app/";
	// default selenium server setting
	private $host = "http://localhost:4444/wd/hub";
	private $capability = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');
	// user login information 
	private $email;
	private $password;
	
	function testSurveyFunction() {
		global $argv, $argc;
		// must have 4 arguments to run the test script
		$this->assertEquals(4, $argc);
		$this->email = $argv[2];
		$this->password = $argv[3];
		
		// instantiate a WebDriver
		$web_driver = new RemoteWebDriver($this->host, $this->capability);
		$web_driver->manage()->window()->maximize();
		
		// click on the sign-in link, then retrieve the form element
		$web_driver->get($this->url)->findElement(WebDriverBy::id("sign-in"))->click();
		$form = $web_driver->findElement(WebDriverBy::id("login-form"));
		$this->assertNotNull($form);
		
		// enter user login information
		$form->findElement(WebDriverBy::id("LoginForm_email"))->sendKeys($this->email);
		$form->findElement(WebDriverBy::id("LoginForm_password"))->sendKeys($this->password);
		$form->submit();
		sleep(1);
		
		// check if the 'Create New Survey' button is displayed 
		$button = $web_driver->findElement(WebDriverBy::linkText("Create New Survey"));
		$this->assertTrue($button->isDisplayed());
		$this->assertContains("create", $button->getAttribute("href"));
		
		// click on create survey button
		$button->click();
		sleep(1);
		$surveyForm = $web_driver->findElement(WebDriverBy::id("survey-form"));
		$surveyTileInput = $web_driver->findElement(WebDriverBy::id("Survey_title"));
		$this->assertTrue($surveyTileInput->isDisplayed());
		
		// craete a new survey
		$surveyTileInput->sendKeys("Test Survey");
		$surveyForm->submit();
		sleep(1);
		$this->assertContains("TEST SURVEY", $web_driver->findElement(WebDriverBy::id("unpublished"))->getText());
		
		// click on edit link
		$web_driver->findElement(WebDriverBy::linkText("Edit"))->click();
		sleep(1);
		$this->assertContains("update", $web_driver->getCurrentURL());
		$web_driver->findElement(WebDriverBy::linkText("Add new question"))->click();
		
		// update existing survey
		$surveyQuestionForm = $web_driver->findElement(WebDriverBy::id("survey-question-form"));
		$this->assertTrue($surveyQuestionForm->isDisplayed());
		
		// add two questions to testing survey
		$surveyQuestionForm->findElement(WebDriverBy::id("SurveyQuestion_text"))->sendKeys("Q1")->submit();
		sleep(1);
		$web_driver->findElement(WebDriverBy::linkText("Add new question"))->click();
		$surveyQuestionForm->findElement(WebDriverBy::id("SurveyQuestion_text"))->sendKeys("Q2")->submit();
		sleep(1);
		
		// delete survey
		
		
		
		$web_driver->quit();
	}
}