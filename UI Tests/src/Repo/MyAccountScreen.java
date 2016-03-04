package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class MyAccountScreen  extends BaseScreen{
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/vnas_users";
	}
	
	public static WebElement getEmailButton(WebDriver driver) {
		return driver.findElement(By.name("emailButton"));
	}
	
	public static WebElement getPhoneButton(WebDriver driver) {
		return driver.findElement(By.name("phoneButton"));
	}
	
	public static WebElement getIdLabel(WebDriver driver) {
		return driver.findElement(By.name("id"));
	}
	
	public static WebElement getNameLabel(WebDriver driver) {
		return driver.findElement(By.name("name"));
	}
	
	public static WebElement getAddressLabel(WebDriver driver) {
		return driver.findElement(By.name("address"));
	}
	
	public static WebElement getPhoneLabel(WebDriver driver) {
		return driver.findElement(By.name("phone"));
	}
	
	public static WebElement getEmailLabel(WebDriver driver) {
		return driver.findElement(By.name("email"));
	}
}
