package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class DonateScreen {
	public static String getURL() {
		return BaseScreen.getURL();
	}
	
	public static WebElement getUserManagement(WebDriver driver) {
		return driver.findElement(By.linkText("Donate to VNA"));
	}
	public static String getPath() {
		return "https://www.paypal.com/";
	}
}
