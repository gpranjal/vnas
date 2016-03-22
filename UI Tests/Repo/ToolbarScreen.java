package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class ToolbarScreen extends BaseScreen {

	public static WebElement getHomeLink(WebDriver driver) {
		return driver.findElement(By.name("homeToolbarLink"));
	}
	
	public static WebElement getLoginLink(WebDriver driver) {
		return driver.findElement(By.name("loginToolbarLink"));
	}
	
	public static WebElement getRegisterLink(WebDriver driver) {
		return driver.findElement(By.name("registerToolbarLink"));
	}
	
	public static WebElement getLogoutLink(WebDriver driver) {
		return driver.findElement(By.name("logoutToolbarLink"));
	}
	
	public static WebElement getManageLink(WebDriver driver) {
		return driver.findElement(By.name("manageToolbarLink"));
	}
	
	public static WebElement getEditInformationLink(WebDriver driver) {
		return driver.findElement(By.name("EditInformationToolbarLink"));
	}
	
	public static WebElement getUserMenuLink(WebDriver driver) {
		return driver.findElement(By.name("userMenuToolbarLink"));
	}
}