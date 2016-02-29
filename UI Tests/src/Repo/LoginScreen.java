package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class LoginScreen extends BaseScreen{
	
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/auth/login";
	}
	
	public static WebElement getEmailTextbox(WebDriver driver) {
		return driver.findElement(By.name("email"));
	}
	
	public static WebElement getPasswordTextbox(WebDriver driver) {
		return driver.findElement(By.name("password"));
	}
	
	public static WebElement getRememberMeCheckbox(WebDriver driver) {
		return driver.findElement(By.name("remember"));
	}
	
	public static WebElement getLoginButton(WebDriver driver) {
		return driver.findElement(By.name("loginButton"));
	}
	
	public static WebElement getForgotPasswordLink(WebDriver driver) {
		return driver.findElement(By.name("forgot"));
	}
	
	public static WebElement getLoginErrorMessageLabel(WebDriver driver) {
		return driver.findElement(By.name("loginErrorMessage"));
	}
	
	public static void loginAsAutomationUser(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("automation.user@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("automationpassword");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
	
	public static void loginAsPatientUser(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("patient.user@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("patientpassword");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
	
	public static void loginAsCaregiverUser(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("caregiver.user@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("caregiverpassword");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
}