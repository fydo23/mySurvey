<?php

require __DIR__ . '/../php-webdriver/__init__.php';

class LoginTest extends PHPUnit_Framework_TestCase {
	
	// change this url according to your local machine
	private $url = "http://localhost/mySurvey/mySurvey_app/";
	// default selenium server setting
	private $host = "http://localhost:4444/wd/hub";
	private $capability = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');
	// user login information 
	private $email;
	private $password;
	
	public function testLogin() {
		global $argv, $argc;
		// must have 4 arguments to run the test script
		$this->assertEquals(4, $argc);
		$this->email = $argv[2];
		$this->password = $argv[3];		
		
		// instantiate a WebDriver
		$web_driver = new RemoteWebDriver($this->host, $this->capability);
		$web_driver->manage()->window()->maximize();
		
		echo "\n[INFO] Current URL: " . $web_driver->getCurrentURL() . "\n";
		
		// click on the sign-in link, then retrieve the form element
		$web_driver->get($this->url)->findElement(WebDriverBy::id("sign-in"))->click();
		$form = $web_driver->findElement(WebDriverBy::id("login-form"));
		$this->assertNotNull($form);
		// enter user login information
		$form->findElement(WebDriverBy::id("LoginForm_email"))->sendKeys($this->email);
		$form->findElement(WebDriverBy::id("LoginForm_password"))->sendKeys($this->password);
		
		try {
			// try to submit the form
			$form->submit();
			sleep(1);
			// if successfully loged in, check if the account is correct
			$loginAccount = $web_driver->findElement(WebDriverBy::id("logout"))->getText();
			$this->assertContains ( $this->email, $loginAccount );
			
		} catch (Exception $e) {
			// if login failed, check if the error message shows up
			$this->assertTrue($web_driver->findElement(WebDriverBy::id("LoginForm_password_em_"))->isDisplayed());
			echo "[ERROR] Incorrect password\n";
			$web_driver->quit();
			return;
		}
		
		echo "[INFO] Current URL: " . $web_driver->getCurrentURL() . "\n";
		
		// logout the user, check if the login form is displayed
		$web_driver->findElement(WebDriverBy::linkText("Logout"))->click();
		$this->assertTrue( $web_driver->findElement(WebDriverBy::id("login-logout"))->isDisplayed() );
		$web_driver->quit();
	}
}
?>