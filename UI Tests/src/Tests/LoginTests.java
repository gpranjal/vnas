package Tests;

import Framework.BaseTestCase;
import Repo.LoginScreen;
import org.openqa.selenium.*;

//assertEquals
//assertTrue
//assertFalse
//assertNotNull
//assertNull
//assertSame
//assertNotSame
//assertArrayEquals
//Examples: http://www.tutorialspoint.com/junit/junit_using_assertion.htm

public class LoginTests extends BaseTestCase {
	
    public void testLoginScreenTitleShouldBeCorrect() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());
	        assertEquals("VNA-Visiting Nurse Association", driver.getTitle());
    	}
    }
    
    public void testLoginAutoUserShouldWork() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());

	    	LoginScreen.getEmailTextbox(driver).sendKeys("automation.user@gmail.com");
	    	LoginScreen.getPasswordTextbox(driver).sendKeys("automationpassword");
	    	LoginScreen.getLoginButton(driver).click();
    	}
    }
    
    public void testLoginAutoUserIncorrectUsernameShouldFail() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());

	    	LoginScreen.getEmailTextbox(driver).sendKeys("incorrect.user@gmail.com");
	    	LoginScreen.getPasswordTextbox(driver).sendKeys("automationpassword");
	    	LoginScreen.getLoginButton(driver).click();
	    	LoginScreen.getLoginErrorMessageLabel(driver).getText();
    	}
    }
    
    public void testLoginAutoUserIncorrectPasswordShouldFail() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());

	    	LoginScreen.getEmailTextbox(driver).sendKeys("automation.user@gmail.com");
	    	LoginScreen.getPasswordTextbox(driver).sendKeys("incorrectpassword");
	    	LoginScreen.getLoginButton(driver).click();
	    	//LoginScreen.getLoginErrorMessageLabel(driver)
    	}
    }
    

}