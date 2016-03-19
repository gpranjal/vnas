package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class WelcomeScreen extends BaseScreen {
	
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "";
	}
	
	public static WebElement getCallButton(WebDriver driver) {
		return driver.findElement(By.name("callButton"));
	}
	
	public static WebElement getDonateButton(WebDriver driver) {
		return driver.findElement(By.name("submit"));
	}
}
