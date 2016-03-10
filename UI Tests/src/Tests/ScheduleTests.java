package Tests;

import Framework.BaseTestCase;
import Repo.CaregiverScheduleDetailsScreen;
import Repo.HomeScreen;
import Repo.LoginScreen;
import Repo.MyScheduleScreen;
import Repo.PatientScheduleDetailsScreen;
import Repo.ToolbarScreen;
import Repo.WelcomeScreen;

import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.openqa.selenium.*;

public class ScheduleTests extends BaseTestCase {
	
	public void test_Caregiver_ClickScheduleDetailLinkShouldNavigateToDetailScreen() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			
			//Schedule Screen
			HomeScreen.getMyScheduleButton(driver).click();
			assertEquals(MyScheduleScreen.getURL(), driver.getCurrentUrl());
			
			//ID
			assertEquals(MyScheduleScreen.getIdText(driver, 1).getText(), "1");
			
			//Title
			assertEquals(MyScheduleScreen.getTitleText(driver, 1).getText(), "Routine Visit");
			
			//Date
			assertEquals(MyScheduleScreen.getDateText(driver, 1).getText(), "04/01/2016");
			
			//Time
			assertEquals(MyScheduleScreen.getTimeText(driver, 1).getText(), "17:00");
			
			//Patient
			assertEquals(MyScheduleScreen.getNameText(driver, 1).getText(), "Joseph Forsythe");
			
			//LOV
			assertEquals(MyScheduleScreen.getLOVText(driver, 1).getText(), "2");
			
			//Schedule Details Screen
			MyScheduleScreen.getRowLink(driver, 1).click();
			assertEquals(CaregiverScheduleDetailsScreen.getURL() + "/1", driver.getCurrentUrl());

			//Patient Id
			assertEquals(CaregiverScheduleDetailsScreen.getIdLabel(driver, 1).getText(),"100");
			
			//Patient Name
			assertEquals(CaregiverScheduleDetailsScreen.getNameLabel(driver, 1).getText(),"Joseph Forsythe");
			
			//Address
			assertEquals(CaregiverScheduleDetailsScreen.getAddressLabel(driver, 1).getText(),"1400 Douglas St, 68179");
			
			//Patient Phone
			assertEquals(CaregiverScheduleDetailsScreen.getPhoneLabel(driver, 1).getText(),"402-555-5555");
			
			//Comments
			assertEquals(CaregiverScheduleDetailsScreen.getCommentsLabel(driver, 1).getText(),"");
			
			//Action - Email
			String emailHrefValue = CaregiverScheduleDetailsScreen.getEmailButton(driver).getAttribute("href");
			Pattern emailPattern = Pattern.compile("^.+@.+\\..+$");
			//The substring is to remove "mailto:" from the emailHrefValue
			Matcher emailMatcher = emailPattern.matcher(emailHrefValue.substring(emailHrefValue.indexOf(':') + 1).trim());			
			assertTrue(emailMatcher.matches());
						
			//Action - Call
			String phoneHrefValue = CaregiverScheduleDetailsScreen.getPhoneButton(driver).getAttribute("href");
			Pattern phonePattern = Pattern.compile("^(\\+\\d{1,2}\\s)?\\(?\\d{3}\\)?[\\s.-]\\d{3}[\\s.-]\\d{4}$");
			//The substring is to remove "tel:" from the emailHrefValue
			Matcher phoneMaterch = phonePattern.matcher(phoneHrefValue.substring(phoneHrefValue.indexOf(':') + 1).trim());
			assertTrue(phoneMaterch.matches());
			
			driver.navigate().back();
			assertEquals(MyScheduleScreen.getURL(), driver.getCurrentUrl());
			
			ToolbarScreen.getUserMenuLink(driver).click();
			ToolbarScreen.getLogoutLink(driver).click();
			assertEquals(WelcomeScreen.getURL() + "/", driver.getCurrentUrl());
		}
	}
	
	public void test_Patient_ClickScheduleDetailLinkShouldNavigateToDetailScreen() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			
			//Schedule Screen
			HomeScreen.getMyScheduleButton(driver).click();
			assertEquals(MyScheduleScreen.getURL(), driver.getCurrentUrl());
			
			//ID
			assertEquals(MyScheduleScreen.getIdText(driver, 1).getText(), "1");
			
			//Title
			assertEquals(MyScheduleScreen.getTitleText(driver, 1).getText(), "Routine Visit");
			
			//Date
			assertEquals(MyScheduleScreen.getDateText(driver, 1).getText(), "04/01/2016");
			
			//Time
			assertEquals(MyScheduleScreen.getTimeText(driver, 1).getText(), "17:00");
			
			//Patient
			assertEquals(MyScheduleScreen.getNameText(driver, 1).getText(), "Joseph Forsythe");
			
			//LOV
			assertEquals(MyScheduleScreen.getLOVText(driver, 1).getText(), "2");
			
			//Schedule Details Screen
			MyScheduleScreen.getRowLink(driver, 1).click();
			assertEquals(PatientScheduleDetailsScreen.getURL() + "/1", driver.getCurrentUrl());

			//Patient Id
			assertEquals(PatientScheduleDetailsScreen.getTitleLabel(driver, 1).getText(),"Routine Visit");
			
			//Patient Name
			assertEquals(PatientScheduleDetailsScreen.getIdLabel(driver, 1).getText(),"900");
			
			//Address
			assertEquals(PatientScheduleDetailsScreen.getNameLabel(driver, 1).getText(),"Pranjal Gupta");
			
			//Patient Phone
			assertEquals(PatientScheduleDetailsScreen.getPhoneLabel(driver, 1).getText(),"402-555-1234");
			
			//Comments
			assertEquals(PatientScheduleDetailsScreen.getMobileLabel(driver, 1).getText(),"402-555-4321");
			
			//Action - Email
			String emailHrefValue = PatientScheduleDetailsScreen.getEmailButton(driver).getAttribute("href");
			Pattern emailPattern = Pattern.compile("^.+@.+\\..+$");
			//The substring is to remove "mailto:" from the emailHrefValue
			Matcher emailMatcher = emailPattern.matcher(emailHrefValue.substring(emailHrefValue.indexOf(':') + 1).trim());			
			assertTrue(emailMatcher.matches());
						
			//Action - Call
			String phoneHrefValue = PatientScheduleDetailsScreen.getPhoneButton(driver).getAttribute("href");
			Pattern phonePattern = Pattern.compile("^(\\+\\d{1,2}\\s)?\\(?\\d{3}\\)?[\\s.-]\\d{3}[\\s.-]\\d{4}$");
			//The substring is to remove "tel:" from the emailHrefValue
			Matcher phoneMaterch = phonePattern.matcher(phoneHrefValue.substring(phoneHrefValue.indexOf(':') + 1).trim());
			assertTrue(phoneMaterch.matches());
			
			driver.navigate().back();
			assertEquals(MyScheduleScreen.getURL(), driver.getCurrentUrl());
			
			ToolbarScreen.getUserMenuLink(driver).click();
			ToolbarScreen.getLogoutLink(driver).click();
			assertEquals(WelcomeScreen.getURL() + "/", driver.getCurrentUrl());
		}
	}
}