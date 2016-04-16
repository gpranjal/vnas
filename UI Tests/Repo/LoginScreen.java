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
	public static WebElement getRegisterToolbarLink(WebDriver driver) {
		return driver.findElement(By.name("registerToolbarLink"));
	}
	public static void loginAsPatientUser(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("vnaspatient@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("patient1234");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
	
	public static void loginAsCaregiverUser(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("vnascaregiver@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("caregiver1234");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
	
	public static void loginAsAdminTest(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("vnas-admintest@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("admintest1234");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
	public static void loginAsAdminUser(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("vnas-adminuser@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("adminuser1234");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
	public static void loginAsAdminUserIncorrectPass(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("vnas-adminuser@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("1234");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
	public static void loginAsRegisterUser(WebDriver driver) {
		//Go to Screen
    	driver.get(LoginScreen.getURL());

    	//Add Login Credentials
    	LoginScreen.getEmailTextbox(driver).sendKeys("register_test@gmail.com");
    	LoginScreen.getPasswordTextbox(driver).sendKeys("register_test1234");
    	
    	//Click Login
    	LoginScreen.getLoginButton(driver).click();
	}
}