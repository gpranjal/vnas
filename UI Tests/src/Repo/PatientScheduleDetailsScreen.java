package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class PatientScheduleDetailsScreen {
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/vnas_records/patient";
	}
	
	public static WebElement getEmailButton(WebDriver driver) {
		return driver.findElement(By.name("mailtoButton"));
	}
	
	public static WebElement getPhoneButton(WebDriver driver) {
		return driver.findElement(By.name("callButton"));
	}
	
	public static WebElement getIdLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("titleText" + row));
	}
	
	public static WebElement getNameLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("caregiverId" + row));
	}
	
	public static WebElement getAddressLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("caregiverName" + row));
	}
	
	public static WebElement getPhoneLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("caregiverPhone" + row));
	}
	
	public static WebElement getCommentsLabel(WebDriver driver, int row) {
		return driver.findElement(By.name("caregiverModbile" + row));
	}
}
