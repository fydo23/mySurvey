<?php

require __DIR__ . '/../php-webdriver/__init__.php';

class LoginTest extends PHPUnit_Framework_TestCase {
	
	private $url = "http://localhost/mySurvey/mySurvey_app/";
	private $email;
	private $password;
	private $host = "http://localhost:4444/wd/hub";
	private $capability = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');
	
	public function testLogin() {
		global $argv, $argc;
		
		$this->assertEquals(4, $argc);
		
		$this->email = $argv[2];
		$this->password = $argv[3];		
		$web_driver = new RemoteWebDriver($this->host, $this->capability);
		$web_driver->get($this->url)->findElement(WebDriverBy::id("sign-in"))->click();
		
		echo "\n[INFO] Current URL: " . $web_driver->getCurrentURL() . "\n";
		
		$form = $web_driver->findElement(WebDriverBy::id("login-form"));
		$this->assertNotNull($form);
		$form->findElement(WebDriverBy::id("LoginForm_email"))->sendKeys($this->email);
		$form->findElement(WebDriverBy::id("LoginForm_password"))->sendKeys($this->password);
		
		try {
			$form->submit();
			sleep(1);
			
			$loginAccount = $web_driver->findElement(WebDriverBy::id("logout"))->getText();
			$this->assertContains ( $this->email, $loginAccount );
			
		} catch (Exception $e) {
			// check if the error message shows up
			$this->assertTrue($web_driver->findElement(WebDriverBy::id("LoginForm_password_em_"))->isDisplayed());
			echo "[ERROR] Incorrect password\n";
			$web_driver->quit();
			return;
		}
		
		echo "[INFO] Current URL: " . $web_driver->getCurrentURL() . "\n";
		
		$web_driver->findElement(WebDriverBy::linkText("Logout"))->click();
		$this->assertTrue( $web_driver->findElement(WebDriverBy::id("login-logout"))->isDisplayed() );
		$web_driver->quit();
	}
}
?>