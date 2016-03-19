package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class HomeScreen extends BaseScreen{	
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/home";
	}
	
	public static WebElement getMyAccountButton(WebDriver driver) {
		return driver.findElement(By.name("myAccountButton"));
	}
	
	public static WebElement getMyScheduleButton(WebDriver driver) {
		return driver.findElement(By.name("myScheduleButton"));
	}
	
	public static WebElement getFAQButton(WebDriver driver) {
		return driver.findElement(By.name("faqButton"));
	}
	
	public static WebElement getDonateButton(WebDriver driver) {
		return driver.findElement(By.name("submit"));
	}
}