package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class FAQScreen {
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/faq";
	}


	public static WebElement getSearchBox(WebDriver driver, int row) {
		// TODO Auto-generated method stub
		return driver.findElement(By.name("keyword"));
	}
	public static WebElement getSearchSubmitButton(WebDriver driver, int row) {
		// TODO Auto-generated method stub
		return driver.findElement(By.name("SearchSubmit"));
	}
	public static WebElement getQuestion(WebDriver driver, int row) {
		return driver.findElement(By.name("ques"+row));
	}









	}

