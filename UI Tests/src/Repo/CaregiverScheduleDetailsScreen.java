package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class CaregiverScheduleDetailsScreen {
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/vnas_records/caregiver";
	}
	
	public static WebElement getEmailButton(WebDriver driver) {
		return driver.findElement(By.name("mailtoButton"));
	}
	
	public static WebElement getPhoneButton(WebDriver driver) {
		return driver.findElement(By.name("callButton"));
	}
	
	public static WebElement getIdLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("idText" + row));
	}
	
	public static WebElement getNameLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("nameText" + row));
	}
	
	public static WebElement getAddressLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("addressText" + row));
	}
	
	public static WebElement getPhoneLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("phoneText" + row));
	}
	
	public static WebElement getCommentsLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("commentsText" + row));
	}
}
