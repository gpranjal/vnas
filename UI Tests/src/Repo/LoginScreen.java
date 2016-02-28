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
}