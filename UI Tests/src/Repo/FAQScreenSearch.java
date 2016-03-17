package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class FAQScreenSearch {
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/faq/search";
	}

	public static WebElement getQuestionText(WebDriver driver, int row) {
		// TODO Auto-generated method stub
		return driver.findElement(By.name("ques" + row));
	}

	public static WebElement getAnswerText(WebDriver driver, int row) {
		// TODO Auto-generated method stub
		return driver.findElement(By.name("ans" + row));
	}

	public static WebElement getRow(WebDriver driver, int row) {
		// TODO Auto-generated method stub
		return driver.findElement(By.name("row" + row));
	}


	





	}

