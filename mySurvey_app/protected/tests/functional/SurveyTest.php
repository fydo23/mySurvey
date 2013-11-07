<?php
require __DIR__ . '/../php-webdriver/__init__.php';
class SurveyTest extends PHPUnit_Framework_TestCase {
	
	// change this url according to your local machine
	private $url = "http://localhost/";
	// default selenium server setting
	private $host = "http://localhost:4444/wd/hub";
	private $capability = array (
			WebDriverCapabilityType::BROWSER_NAME => 'firefox' 
	);
	// user login information
	private $email;
	private $password;
	function testSurveyFunction() {
		global $argv, $argc;
		// must have 4 arguments to run the test script
		$this->assertEquals ( 4, $argc );
		$this->email = $argv [2];
		$this->password = $argv [3];
		
		// instantiate a WebDriver
		$web_driver = new RemoteWebDriver ( $this->host, $this->capability );
		$web_driver->manage ()->window ()->maximize ();
		
		// click on the sign-in link, then retrieve the form element
		$web_driver->get ( $this->url )->findElement ( WebDriverBy::id ( "sign-in" ) )->click ();
		sleep(1);
		$form = $web_driver->findElement ( WebDriverBy::id ( "login-form" ) );
		$this->assertNotNull ( $form );
		
		// enter user login information
		$form->findElement ( WebDriverBy::id ( "LoginForm_email" ) )->sendKeys ( $this->email );
		$form->findElement ( WebDriverBy::id ( "LoginForm_password" ) )->sendKeys ( $this->password );
		$form->submit ();
		sleep (1);
		
		// check if the 'Create New Survey' button is displayed
		$button = $web_driver->findElement ( WebDriverBy::linkText ( "Create New Survey" ) );
		$this->assertTrue ( $button->isDisplayed () );
		$this->assertContains ( "create", $button->getAttribute ( "href" ) );
		echo "\n[INFO] Test user has loged in";
		
		// click on create survey button
		$button->click ();
		sleep (1);
		$surveyForm = $web_driver->findElement ( WebDriverBy::id ( "survey-form" ) );
		$surveyTileInput = $surveyForm->findElement ( WebDriverBy::id ( "Survey_title" ) );
		$this->assertTrue ( $surveyTileInput->isDisplayed () );
		echo "\n[INFO] Creating test survey";
		
		// craete a new survey
		$surveyTileInput->sendKeys ( "Test Survey" );
		$surveyForm->submit ();
		sleep (1);
		// $this->assertContains("TEST SURVEY", $web_driver->findElement(WebDriverBy::id("unpublished"))->getText());
		
		// click on edit link
		// $web_driver->findElement(WebDriverBy::linkText("Edit"))->click();
		// sleep(1);
		$this->assertContains ( "update", $web_driver->getCurrentURL () );
// 		$web_driver->findElement ( WebDriverBy::linkText ( "Add New Question" ) )->click();
		// update existing survey

		$surveyQuestionForm = $web_driver->findElement ( WebDriverBy::id ( "survey-form" ) );
		$this->assertTrue ( $surveyQuestionForm->isDisplayed () );
		echo "\n[INFO] Updating test survey";
		
		// add two questions to testing survey
		$web_driver->findElement ( WebDriverBy::linkText ( "Add New Question" ) )->click();
		sleep(1);
		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
		sleep(1);
// 		$web_driver->findElement(WebDriverBy::name("SurveyQuestion[0][SurveyAnswer][0][text]"))->sendKeys("test answer 1");
		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
		sleep(1);
		echo "\n[INFO] Added 7 answers to test survey";
		$surveyQuestionForm->submit();
		sleep (1);
		$web_driver->findElement ( WebDriverBy::linkText ( "Back to all Surveys" ) )->click ();
		sleep(1);
		$web_driver->findElement ( WebDriverBy::linkText ( "Publish" ) )->click();
		echo "\n[INFO] Published test survey";
		sleep(1);
		
		
// 		
// 		sleep(1);
// 		
// 		$web_driver->findElement(WebDriverBy::id("SurveyQuestion_0_SurveyAnswer_0_text"))->sendKeys("test answer 2");
// 		$web_driver->findElement ( WebDriverBy::linkText ( "Add new question" ) )->click ();
// 		sleep(1);
// 		$web_driver->findElement ( WebDriverBy::id ("SurveyQuestion_0_text") )->sendKeys ( "Question 2" );
// 		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
// 		sleep(1);
// 		$web_driver->findElement(WebDriverBy::id("SurveyQuestion_0_SurveyAnswer_0_text"))->sendKeys("test answer 3");
// 		$web_driver->findElement(WebDriverBy::linkText("Add New Answer"))->click();
// 		sleep(1);
// 		$web_driver->findElement(WebDriverBy::id("SurveyQuestion_0_SurveyAnswer_0_text"))->sendKeys("test answer 4");
		$web_driver->findElement ( WebDriverBy::linkText ( "Logout" ) )->click ();
		echo "\n[INFO] Test user has loged out";
		$web_driver->quit ();
	}
}