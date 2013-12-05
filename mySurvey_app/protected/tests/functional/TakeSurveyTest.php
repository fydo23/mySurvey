<?php
require __DIR__ . '/../php-webdriver/__init__.php';
class TakeSurveyTest extends PHPUnit_Framework_TestCase {
	
	// change this url according to your root directory
	//private $localUrl = "http://localhost/";
	private $remoteUrl = "http://128.197.103.79/mysurvey/mySurvey_app/";
	// default selenium server setting
	private $host = "http://localhost:4444/wd/hub";
	private $capability = array (WebDriverCapabilityType::BROWSER_NAME => 'firefox' );
	// user login information
	private $email;
	private $password;
	private $form;
	//private $localSurveyUrl = "http://localhost/survey/take/SyzB4u";
	private $remoteSurveyUrl = "http://128.197.103.79/mysurvey/mySurvey_app/survey/take/wBzn09";
	
	function testPreviewSurvey() {
		echo "\n------------------- Start testPreviewSurvey() -------------------";
		global $argv, $argc;
		// must have 4 arguments to run the test script
		$this->assertEquals ( 4, $argc );
		$this->email = $argv [2];
		$this->password = $argv [3];
		
		// instantiate a WebDriver
		$web_driver = new RemoteWebDriver ( $this->host, $this->capability );
		$web_driver->manage ()->window ()->maximize ();
		// click on the sign-in link, then retrieve the form element
		$web_driver->get ( $this->remoteUrl )->findElement ( WebDriverBy::id( "sign-in" ) )->click ();
		
		// wait for at most 10 seconds until the web driver retrieves login form
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $this->form = $web_driver->findElement ( WebDriverBy::id ( "login-form" ) );
		});
			
		$this->assertNotNull ( $this->form );
		
		// enter user login information
		$this->form->findElement ( WebDriverBy::id ( "LoginForm_email" ) )->sendKeys ( $this->email );
		$this->form->findElement ( WebDriverBy::id ( "LoginForm_password" ) )->sendKeys ( $this->password );
		$this->form->submit ();
		
		// wait for at most 10 seconds until the URL is 'http://128.197.103.79/mysurvey/mySurvey_app/survey'.
		// check again 500ms after the previous attempt.
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $web_driver->getCurrentURL() === ($this->remoteUrl."survey");
		});
			
		// check if the 'Create New Survey' button is displayed
		$button = $web_driver->findElement ( WebDriverBy::linkText ( "Create New Survey" ) );
		$this->assertTrue ( $button->isDisplayed () );
		$this->assertContains ( "create", $button->getAttribute ( "href" ) );
		echo "\n[INFO] User logged in";
		sleep(1);
		
		// click on report page link
		$web_driver->findElement ( WebDriverBy::linkText ( "Reports" ) )->click ();
		echo "\n[INFO] Clicked on report page link";
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $web_driver->getCurrentURL() === ($this->remoteUrl."site/reports");
		});
		
		// select a specific survey
		$select = new WebDriverSelect($web_driver->findElement(WebDriverBy::id ( "Survey_id" ) ));
		$select->selectByValue('30');
		echo "\n[INFO] Selected Programmer Survey";
		$web_driver->executeScript("window.scrollTo(0,800);", array());
		sleep(2);
		
		// click on bar chart link
		$web_driver->findElement ( WebDriverBy::id ( "yt0" ) )->click ();
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $web_driver->getCurrentURL() === ($this->remoteUrl."site/reports/type/bar");
		});
		echo "\n[INFO] Clicked on bar chart link";
		$web_driver->executeScript("window.scrollTo(0,800);", array());
		sleep(2);
		
		// click on survey page link
		$web_driver->get ( $this->remoteUrl )->findElement ( WebDriverBy::linkText ( "Surveys" ) )->click ();
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $web_driver->getCurrentURL() === ($this->remoteUrl."survey");
		});
		
		// click on preview link (simple demo for presentation)
		$web_driver->get( $this->remoteUrl."survey")->findElement ( WebDriverBy::xpath( "//a[@href='/mysurvey/mySurvey_app/survey/take/wBzn09']" ) )->click();
		//$web_driver->get( $this->remoteUrl."survey")->findElement ( WebDriverBy::xpath( "//a[@href='/survey/take/7pZZuk']" ) )->click();
		echo "\n[INFO] Clicked on preview link";
		sleep(2);
		
		$web_driver->quit();
	}
	
	
	function testTakeSurvey() {
		echo "\n------------------- Start testTakeSurvey() -------------------";
		$web_driver = new RemoteWebDriver ( $this->host, $this->capability );
		$web_driver->manage ()->window ()->maximize ();
		
		for($x=0; $x<=4; $x++) {
			$web_driver->get($this->remoteSurveyUrl);
			$web_driver->wait(10,500)->until(function($web_driver) {
				return $web_driver->getCurrentURL() === ($this->remoteSurveyUrl);
			});
			$web_driver->findElement( WebDriverBy::id ( "SurveyResponse_74_text_0" ) )->click();
			$web_driver->findElement( WebDriverBy::id ( "SurveyResponse_75_text_".$x ) )->click();
			$web_driver->findElement( WebDriverBy::id ( "SurveyResponse_76_text_".$x ) )->click();
			$web_driver->findElement( WebDriverBy::id ( "SurveyResponse_77_text_".$x ) )->click();
			$web_driver->findElement( WebDriverBy::id ( "SurveyResponse_78_text" ) )->sendKeys("Test response");
			sleep(1);
			$web_driver->findElement ( WebDriverBy::name ( "yt0" ) )->click ();
			$web_driver->wait(10,500)->until(function($web_driver) {
				return $web_driver->getCurrentURL() === ($this->remoteUrl."successfulSubmit");
			});
			echo "\n[INFO] Submitted sample survey";
			$web_driver->manage()->deleteAllCookies();
		}
		
		$web_driver->quit();
	}
	
	function testReport() {
		echo "\n------------------- Start testReport() -------------------";
		global $argv, $argc;
		// must have 4 arguments to run the test script
		$this->assertEquals ( 4, $argc );
		$this->email = $argv [2];
		$this->password = $argv [3];
		
		// instantiate a WebDriver
		$web_driver = new RemoteWebDriver ( $this->host, $this->capability );
		$web_driver->manage ()->window ()->maximize ();
		// click on the sign-in link, then retrieve the form element
		$web_driver->get ( $this->remoteUrl )->findElement ( WebDriverBy::id( "sign-in" ) )->click ();
		
		// wait for at most 10 seconds until the web driver retrieves login form
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $this->form = $web_driver->findElement ( WebDriverBy::id ( "login-form" ) );
		});
			
		$this->assertNotNull ( $this->form );
		
		// enter user login information
		$this->form->findElement ( WebDriverBy::id ( "LoginForm_email" ) )->sendKeys ( $this->email );
		$this->form->findElement ( WebDriverBy::id ( "LoginForm_password" ) )->sendKeys ( $this->password );
		$this->form->submit ();
		
		// wait for at most 10 seconds until the URL is 'http://128.197.103.79/mysurvey/mySurvey_app/survey'.
		// check again 500ms after the previous attempt.
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $web_driver->getCurrentURL() === ($this->remoteUrl."survey");
		});
			
		// check if the 'Create New Survey' button is displayed
		$button = $web_driver->findElement ( WebDriverBy::linkText ( "Create New Survey" ) );
		$this->assertTrue ( $button->isDisplayed () );
		$this->assertContains ( "create", $button->getAttribute ( "href" ) );
		echo "\n[INFO] User logged in";
		
		// click on report page link
		$web_driver->findElement ( WebDriverBy::linkText ( "Reports" ) )->click ();
		echo "\n[INFO] Clicked on report page link";
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $web_driver->getCurrentURL() === ($this->remoteUrl."site/reports");
		});
		
		// select a specific survey
		$select = new WebDriverSelect($web_driver->findElement(WebDriverBy::id ( "Survey_id" ) ));
		$select->selectByValue('30');
		echo "\n[INFO] Selected Programmer Survey";
		$web_driver->executeScript("window.scrollTo(0,800);", array());
		sleep(2);
		
		// click on bar chart link
		$web_driver->findElement ( WebDriverBy::id ( "yt0" ) )->click ();
		$web_driver->wait(10,500)->until(function($web_driver) {
			return $web_driver->getCurrentURL() === ($this->remoteUrl."site/reports/type/bar");
		});
		echo "\n[INFO] Clicked on bar chart link";
		$web_driver->executeScript("window.scrollTo(0,800);", array());
		sleep(2);
		$web_driver->quit();
	}
	
}
?>