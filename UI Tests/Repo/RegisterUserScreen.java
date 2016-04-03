package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class RegisterUserScreen extends BaseScreen{

	public static String getURL (){
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/auth/register";
	}
	
	public static WebElement getNameTextbox(WebDriver driver) {
		return driver.findElement(By.name("name"));
	}
	
	public static WebElement getEmailTextbox(WebDriver driver) {
		return driver.findElement(By.name("email"));
	}

	public static WebElement getRoleTextbox(WebDriver driver) {
		return driver.findElement(By.name("role"));
	}
	
	public static WebElement getPasswordTextbox(WebDriver driver) {
		return driver.findElement(By.name("password"));
	}
	
	public static WebElement getConfirmPasswordTextbox(WebDriver driver) {
		return driver.findElement(By.name("password_confirmation"));
	}
	
	public static WebElement getRegisterButton(WebDriver driver) {
		return driver.findElement(By.name("register"));
	}
}
