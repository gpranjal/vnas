package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class AdminScreen extends BaseScreen{

	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/admin";
	}
	
	public static WebElement getManageToolBarLink(WebDriver driver) {
		return driver.findElement(By.name("manageToolbarLink"));
	}
	public static WebElement getUserManagement(WebDriver driver) {
		return driver.findElement(By.linkText("User Management"));
	}
	public static String getManageURL(){
		return BaseScreen.getURL()+getManagePath();
	}
	public static String getManagePath(){
		return "/manage";
	}
	public static WebElement getEditUserManagement(WebDriver driver){
		return driver.findElement(By.name("editButton8"));
	}
	public static WebElement getChangeRoleToAdmin(WebDriver driver){
		return driver.findElement(By.name("role"));
	}
	public static WebElement getSelectRoleAdmin(WebDriver driver){
		return driver.findElement(By.id("Admin"));
	}
	public static WebElement getClickSave(WebDriver driver){
		return driver.findElement(By.name("btnSave"));
	}
}
