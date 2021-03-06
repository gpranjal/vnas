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
		return driver.findElement(By.name("mailtoButton"));
	}
	
	public static WebElement getPhoneButton(WebDriver driver) {
		return driver.findElement(By.name("callButton"));
	}
	
	public static WebElement getIdLabel1(WebDriver driver) {
		return driver.findElement(By.name("idText1"));
	}
	
	public static WebElement getNameLabel1(WebDriver driver) {
		return driver.findElement(By.name("nameText1"));
	}
	
	public static WebElement getAddressLabel(WebDriver driver) {
		return driver.findElement(By.name("addressText1"));
	}
	
	public static WebElement getPhoneLabel(WebDriver driver) {
		return driver.findElement(By.name("phoneText1"));
	}
	
	public static WebElement getEmailLabel(WebDriver driver) {
		return driver.findElement(By.name("emailText1"));
	}
}
