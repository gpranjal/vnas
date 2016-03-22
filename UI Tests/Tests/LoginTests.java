package Tests;

import Framework.BaseTestCase;
import Repo.HomeScreen;
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
	
	//function name format:
	//test<action><Expected Result>
    public void testLoginScreenTitleShouldBeCorrect() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());
	        assertEquals("VNA-Visiting Nurse Association", driver.getTitle());
    	}
    }
    
    public void testLoginCaregiverUserShouldWork() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());

	    	LoginScreen.getEmailTextbox(driver).sendKeys("vnascaregiver@gmail.com");
	    	LoginScreen.getPasswordTextbox(driver).sendKeys("caregiver1234");
	    	LoginScreen.getLoginButton(driver).click();
	    	assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());	    	
    	}
    }
    
    public void testLoginPatientUserShouldWork() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());

	    	LoginScreen.getEmailTextbox(driver).sendKeys("vnaspatient@gmail.com");
	    	LoginScreen.getPasswordTextbox(driver).sendKeys("patient1234");
	    	LoginScreen.getLoginButton(driver).click();
	    	assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());	    	
    	}
    }    
    
    public void testLoginAutoUserIncorrectUsernameShouldFail() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());

	    	LoginScreen.getEmailTextbox(driver).sendKeys("incorrect.user@gmail.com");
	    	LoginScreen.getPasswordTextbox(driver).sendKeys("automationpassword");
	    	LoginScreen.getLoginButton(driver).click();
	    	String actualText = LoginScreen.getLoginErrorMessageLabel(driver).getText();
	    	String testText = "Whoops! There were some problems with your input.\n\nThese credentials do not match our records.";
	    	assertEquals(testText, actualText);		
    	}
    }
    
    public void testLoginAutoUserIncorrectPasswordShouldFail() throws Exception {    	
    	for (WebDriver driver : super.getDrivers()) {    	
	    	driver.get(LoginScreen.getURL());

	    	LoginScreen.getEmailTextbox(driver).sendKeys("automation.user@gmail.com");
	    	LoginScreen.getPasswordTextbox(driver).sendKeys("incorrectpassword");
	    	LoginScreen.getLoginButton(driver).click();
	    	String actualText = LoginScreen.getLoginErrorMessageLabel(driver).getText();
	    	String testText = "Whoops! There were some problems with your input.\n\nThese credentials do not match our records.";
	    	assertEquals(testText, actualText);	
    	}
    }
}