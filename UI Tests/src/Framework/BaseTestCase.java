package Framework;

import junit.framework.TestCase;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.edge.EdgeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.ie.InternetExplorerDriver;
import org.openqa.selenium.remote.DesiredCapabilities;

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
				
		//Setup the Chrome Web Driver
		System.setProperty("webdriver.chrome.driver", "WebDrivers/chromedriver.exe");
		WebDriver chromeDriver = new ChromeDriver();
		drivers.add(chromeDriver);
		
		//Notes: https://github.com/SeleniumHQ/selenium/wiki/InternetExplorerDriver#required-configuration
		//Setup the Internet Explorer Web Driver
		//System.setProperty("webdriver.ie.driver", "WebDrivers/IEDriverServer.exe");		
		//DesiredCapabilities caps = DesiredCapabilities.internetExplorer();
		//caps.setCapability(InternetExplorerDriver.INTRODUCE_FLAKINESS_BY_IGNORING_SECURITY_DOMAINS, true);		
		//WebDriver ieDriver = new InternetExplorerDriver(caps);
		//drivers.add(ieDriver);
		
		//Setup the Edge Web Driver
		//System.setProperty("webdriver.edge.driver", "WebDrivers/MicrosoftWebDriver.exe");
		//WebDriver edgeDriver = new EdgeDriver();
		//drivers.add(edgeDriver);
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
