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
			LoginScreen.loginAsPatientUser(driver);
			//assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			HomeScreen.getDonateButton(driver).click();
			driver.switchTo().activeElement().sendKeys(Keys.LEFT_CONTROL, Keys.TAB);
			Thread.sleep(5000);
	    	assertEquals(DonateScreen.getURL(), driver.getCurrentUrl());	
		}
	}
}
