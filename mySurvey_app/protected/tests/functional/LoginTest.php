<?php
class LoginTest extends PHPUnit_Extensions_Selenium2TestCase {
	
	protected function setUp() {
		// configure selenium server (depends on your machine)
		$this->setHost ( "localhost" );
		$this->setBrowser ( "firefox" );
		$this->setPort ( 4444 );
		$this->setBrowserUrl ( "http://localhost/mySurvey/mySurvey_app" );
	}
	
	public function testHasLoginForm() {
		// test button
		$this->url ( "index.php" );
		$this->assertEquals ( "sign-in", $this->byId ( "sign-in" )->attribute ( "id" ) );
		$this->assertEquals ( "register-link", $this->byId ( "register-link" )->attribute ( "id" ) );
		
		// clicked register button
		$this->clickOnElement ( "sign-in" );
		$this->assertEquals ( "", $this->byId ( "LoginForm_email" )->value () );
		$this->assertEquals ( "", $this->byId ( "LoginForm_password" )->value () );
		sleep(1);
		
		// clicked sign in button
		$this->clickOnElement ( "register-btn" );
		$this->assertEquals ( "", $this->byId ( "SurveyCreator_email" )->value () );
		$this->assertEquals ( "", $this->byId ( "SurveyCreator_password" )->value () );
		$this->assertEquals ( "", $this->byId ( "SurveyCreator_password_repeat" )->value () );
		sleep(1);
	}
	
	public function testRegister() {
		$this->url ( "index.php" );
		$this->clickOnElement ( "register-link" );
		
		// retrieve form information
		$form = $this->byId ( "register-form" );
		$action = $form->attribute ( "action" );
		$this->assertContains("register", $action);
		
		// create a new account and wait for 1 second to load the page
		$email = "aaa@aaa.com";
		$this->byId("SurveyCreator_first_name")->value("Test-FirstName");
		$this->byId("SurveyCreator_last_name")->value("Test-LastName");
		$this->byId("SurveyCreator_email")->value($email);
		$this->byId("SurveyCreator_password")->value("12341234");
		$this->byId("SurveyCreator_password_repeat")->value("12341234");
		
		try {
			$form->submit();
			sleep(1);
			
			// after registration, check if the login account is correct
			// if the user has already been registered, catch the exception
			$loginAccount = $this->byId("logout")->text();
			$this->assertContains($email, $loginAccount);
			
		} catch (Exception $e) {
			sleep(1);
			// check if the error message shows up
			$this->assertTrue($this->byId("SurveyCreator_email_em_")->displayed());
		}
	}
	
	public function testLogout(){
		// test user logout
	}
	
	public function testLogin(){
		// test user login
	}
}

?>