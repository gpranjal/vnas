package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class LoginScreen {
	
	public static String getURL() {
		return "http://app-vnasdev.rhcloud.com/auth/login";
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
		return driver.findElement(By.name("submit"));
	}
	
	public static WebElement getForgotPasswordLink(WebDriver driver) {
		return driver.findElement(By.name("forgot"));
	}
	
	public static WebElement getLoginErrorMessageLabel(WebDriver driver) {
		return driver.findElement(By.name("loginErrorMessage"));
	}
}