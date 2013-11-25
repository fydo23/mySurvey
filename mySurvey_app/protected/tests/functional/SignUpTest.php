<?php
class SignUpTest extends PHPUnit_Extensions_Selenium2TestCase {
	
	private $url = "http://localhost/";
	private $email;
	private $password;
	private $firstName = "Test-FirstName";
	private $lastName = "Test-LastName";
	
	protected function setUp() {
		// configure selenium server (depends on your machine)
		$this->setHost ( "localhost" );
		$this->setBrowser ( "firefox" );
		$this->setPort ( 4444 );
		$this->setBrowserUrl ( $this->url );
	}
	
	public function testHasLoginForm() {
		// test button
		$this->url ( "index.php" );
		$this->assertEquals ( "sign-in", $this->byId ( "sign-in" )->attribute ( "id" ) );
		$this->assertEquals ( "register-link", $this->byId ( "register-link" )->attribute ( "id" ) );
		
		// test register button
		$this->clickOnElement ( "sign-in" );
		$this->assertEquals ( "", $this->byId ( "LoginForm_email" )->value () );
		$this->assertEquals ( "", $this->byId ( "LoginForm_password" )->value () );
		sleep(1);
		
		// test sign in button
		$this->clickOnElement ( "register-btn" );
		$this->assertEquals ( "", $this->byId ( "SurveyCreator_email" )->value () );
		$this->assertEquals ( "", $this->byId ( "SurveyCreator_password" )->value () );
		$this->assertEquals ( "", $this->byId ( "SurveyCreator_password_repeat" )->value () );
		sleep(1);
	}
	
	public function testRegister() {
		global $argv, $argc;
		
		$this->assertEquals(4, $argc);
		
		$this->email = $argv[2];
		$this->password = $argv[3];
		$this->url ( "index.php" );
		$this->clickOnElement ( "register-link" );
		
		// retrieve form information
		$form = $this->byId ( "register-form" );
		$action = $form->attribute ( "action" );
		$this->assertContains("register", $action);
		
		// create a new account and wait for 1 second to load the page
		$this->byId("SurveyCreator_first_name")->value($this->firstName);
		$this->byId("SurveyCreator_last_name")->value($this->lastName);
		$this->byId("SurveyCreator_email")->value($this->email);
		$this->byId("SurveyCreator_password")->value($this->password);
		$this->byId("SurveyCreator_password_repeat")->value($this->password);
		
		try {
			$form->submit();
			sleep(1);
			
			// after registration, check if the login account is correct
			// if the user has already been registered, catch the exception
			$loginAccount = $this->byId("logout")->text();
			$this->assertContains($email, $loginAccount);
			
		} catch (Exception $e) {
			sleep(1);
			echo "\n[ERROR] Incorrect signup information\n";
			return;
		} 
		
		// finally we logout the user
		$this->byLinkText("Logout")->click();
		$this->assertTrue($this->byId("login-logout")->displayed());
	}
}

?>