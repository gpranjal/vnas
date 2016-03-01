package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

class BaseScreen {
	//Possible Values: { Test | Dev }
	public static String Env = "Dev";
	
	public static String getURL() {		
		if (Env == "Test") {
			//NOTE: Never put a trailing / on this URL.
			return "https://app-vnastest.rhcloud.com";
			
		} else {		
			//NOTE: Never put a trailing / on this URL.
			return "https://app-vnasdev.rhcloud.com";
		}
	}	
}