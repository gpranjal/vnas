package Tests;

import Framework.BaseTestCase;
import Repo.CaregiverScheduleDetailsScreen;
import Repo.HomeScreen;
import Repo.LoginScreen;
import Repo.MyScheduleScreen;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.openqa.selenium.*;

public class ScheduleTests extends BaseTestCase {
	
	public void test_Caregiver_ClickScheduleDetailLinkShouldNavigateToDetailScreen() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			
			HomeScreen.getMyScheduleButton(driver).click();
			assertEquals(MyScheduleScreen.getURL(), driver.getCurrentUrl());
			
			MyScheduleScreen.getIdLink(driver, 1).click();
			assertEquals(CaregiverScheduleDetailsScreen.getURL() + "/1", driver.getCurrentUrl());

			//Patient Id
			assertEquals(CaregiverScheduleDetailsScreen.getIdLabel(driver, 1).getText() ,"100");
			
			//Patient Name
			assertEquals(CaregiverScheduleDetailsScreen.getNameLabel(driver, 1).getText() ,"Joseph Forsythe");
			
			//Address
			assertEquals(CaregiverScheduleDetailsScreen.getAddressLabel(driver, 1).getText() ,"1400 Douglas St. 68179");
			
			//Patient Phone
			assertEquals(CaregiverScheduleDetailsScreen.getPhoneLabel(driver, 1).getText() ,"402-555-55555");
			
			//Comments
			assertEquals(CaregiverScheduleDetailsScreen.getCommentsLabel(driver, 1).getText() ,"");
			
			//Action - Email
			String emailHrefValue = CaregiverScheduleDetailsScreen.getEmailButton(driver).getAttribute("href");
			Pattern emailPattern = Pattern.compile("^.+@.+\\..+$");
			Matcher emailMatcher = emailPattern.matcher(emailHrefValue.substring(emailHrefValue.indexOf(':') + 1));			
			assertTrue(emailMatcher.matches());
						
			//Action - Call
			String phoneHrefValue = CaregiverScheduleDetailsScreen.getPhoneButton(driver).getAttribute("href");
			Pattern phonePattern = Pattern.compile("^(\\+\\d{1,2}\\s)?\\(?\\d{3}\\)?[\\s.-]\\d{3}[\\s.-]\\d{4}$");
			Matcher phoneMaterch = phonePattern.matcher(phoneHrefValue.substring(phoneHrefValue.indexOf(':')));
			assertTrue(phoneMaterch.matches());
		}
	}
}