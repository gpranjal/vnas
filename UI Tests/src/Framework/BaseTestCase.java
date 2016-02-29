package Framework;

import junit.framework.TestCase;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.edge.EdgeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.ie.InternetExplorerDriver;

import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.TimeUnit;


public class BaseTestCase extends TestCase{
	
	private List<WebDriver> drivers;	 
	
	public void setUp() {
		drivers = new ArrayList<WebDriver>();
		
		//Setup the Firefox Web Driver
		WebDriver firefoxDriver = new FirefoxDriver();
		drivers.add(firefoxDriver);
		
		System.getProperty("user.dir");
		//Setup the Chrome Web Driver
		System.setProperty("webdriver.chrome.driver", "WebDrivers/chromedriver.exe");
		WebDriver chromeDriver = new ChromeDriver();
		drivers.add(chromeDriver);
		
		//Setup the Internet Explorer Web Driver
		//WebDriver ieDriver = new InternetExplorerDriver();
		
		
		//Setup the Edge Web Driver
		//WebDriver edgeDriver = new EdgeDriver();
	}
	
	public void tearDown() {
		for (WebDriver driver : drivers) {
			driver.quit();
		}
	}
	
	protected List<WebDriver> getDrivers() {
		return drivers;
	}
}
