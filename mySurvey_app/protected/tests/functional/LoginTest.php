<?
/**
* 
*/
class LoginTest extends PHPUnit_Extensions_Selenium2TestCase {
	
	private $url = "http://localhost/mySurvey/mySurvey_app";
	private $email = "aaa@aaa.com";
	private $password = "12341234";
	
	protected function setUp() {
		// configure selenium server (depends on your machine)
		$this->setHost ( "localhost" );
		$this->setBrowser ( "firefox" );
		$this->setPort ( 4444 );
		$this->setBrowserUrl ( $this->url );
	}
	
	public function testLogin() {
		$this->url ( "index.php" );
		$this->clickOnElement ( "sign-in" );
		
		// retrieve form information
		$form = $this->byId ( "login-form" );
		$action = $form->attribute ( "action" );
		$this->assertContains ( "login", $action );
		
		// create a new account and wait for 1 second to load the page
		$this->byId ( "LoginForm_email" )->value ( $this->email );
		$this->byId ( "LoginForm_password" )->value ( $this->password );
		$form->submit ();
		sleep ( 1 );
		
		// after login, check if the login account shows up
		$loginAccount = $this->byId ( "logout" )->text ();
		$this->assertContains ( $this->email, $loginAccount );
		
		// finally we logout the user
		$this->byLinkText("Logout")->click();
		$this->assertTrue($this->byId("login-logout")->displayed());
	}
}

?>