package Tests;

import Framework.BaseTestCase;
import Repo.AdminScreen;
import Repo.DonateScreen;
import Repo.HomeScreen;
import Repo.LoginScreen;
import Repo.ToolbarScreen;
import org.junit.runners.MethodSorters;
import org.openqa.selenium.*;

import org.junit.Test;

public class DonationTests extends BaseTestCase{

	public void test_LoginAsAdminTestAndVerifyDonationURL() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsAdminTest(driver);
			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			
			HomeScreen.getDonateButton(driver).click();
	    	String actualText = DonateScreen.getPath();
	    	Boolean incorrectURL = actualText.startsWith("https://www.paypal.com");
	    	assertTrue(incorrectURL);
		}
	}
}
