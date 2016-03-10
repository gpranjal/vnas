package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class MyScheduleScreen extends BaseScreen{
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/vnas_records";
	}
	
	public static WebElement getRowLink(WebDriver driver, int row) {
		return driver.findElement(By.name("rowLink" + row));
	}
	
	public static WebElement getIdText(WebDriver driver, int row) {
		return driver.findElement(By.name("idText" + row));
	}
	
	public static WebElement getTitleText(WebDriver driver, int row) {
		return driver.findElement(By.name("titleText" + row));
	}
	
	public static WebElement getDateText(WebDriver driver, int row) {
		return driver.findElement(By.name("dateText" + row));
	}
	
	public static WebElement getTimeText(WebDriver driver, int row) {
		return driver.findElement(By.name("timeText" + row));
	}
	
	public static WebElement getNameText(WebDriver driver, int row) {
		return driver.findElement(By.name("nameText" + row));
	}
	
	public static WebElement getLOVText(WebDriver driver, int row) {
		return driver.findElement(By.name("lovText" + row));
	}
}
