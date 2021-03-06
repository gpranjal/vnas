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
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenIDText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//ID
			assertEquals(MyScheduleScreen.getIdText(driver, 1).getText(), "100");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenTitleText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Title
			assertEquals(MyScheduleScreen.getTitleText(driver, 1).getText(), "Routine Visit");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenDateText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Date
			assertEquals(MyScheduleScreen.getDateText(driver, 1).getText(), "04/01/2016");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenTimeText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Time
			assertEquals(MyScheduleScreen.getTimeText(driver, 1).getText(), "17:00");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenNameText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Patient
			assertEquals(MyScheduleScreen.getNameText(driver, 1).getText(), "Joseph Forsythe");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenLOVText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//LOV
			assertEquals(MyScheduleScreen.getLOVText(driver, 1).getText(), "2");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenGetURLTest() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Schedule Details Screen
			MyScheduleScreen.getRowLink(driver, 1).click();
			assertEquals(CaregiverScheduleDetailsScreen.getURL() + "/1", driver.getCurrentUrl());
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenPatientID1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Patient Id
			assertEquals(CaregiverScheduleDetailsScreen.getIdLabel(driver, 1).getText(),"100");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenPatientName1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Patient Name
			assertEquals(CaregiverScheduleDetailsScreen.getNameLabel(driver, 1).getText(),"Joseph Forsythe");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenPatientAddress1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Address
			assertEquals(CaregiverScheduleDetailsScreen.getAddressLabel(driver, 1).getText(),"1400 Douglas St, 68179");
			
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenPatientPhone1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Patient Phone
			assertEquals(CaregiverScheduleDetailsScreen.getPhoneLabel(driver, 1).getText(),"402-555-5555");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenComments() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Comments
			assertEquals(CaregiverScheduleDetailsScreen.getCommentsLabel(driver, 1).getText(),"");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenHomeScreenURL() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Action - Email
			String emailHrefValue = CaregiverScheduleDetailsScreen.getEmailButton(driver).getAttribute("href");
			Pattern emailPattern = Pattern.compile("^.+@.+\\..+$");
			//The substring is to remove "mailto:" from the emailHrefValue
			Matcher emailMatcher = emailPattern.matcher(emailHrefValue.substring(emailHrefValue.indexOf(':') + 1).trim());			
			assertTrue(emailMatcher.matches());
		}
	}

	public void test_Caregiver_ClickScheduleDetailScreenPhoneButton() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);

			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
    		HomeScreen.getMyScheduleButton(driver).click();
			MyScheduleScreen.getIdText(driver, 1).click();
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
		}
	}
	public void test_Patient_ClickScheduleCheckID() throws Exception {
				for (WebDriver driver : super.getDrivers()) {
					LoginScreen.loginAsPatientUser(driver);
		    		HomeScreen.getMyScheduleButton(driver).click();
		    		MyScheduleScreen.getIdText(driver, 1).click();
			//ID
			assertEquals(MyScheduleScreen.getIdText(driver, 1).getText(), "900");
				}
	}
	public void test_Patient_ClickScheduleCheckTitle() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Title
			assertEquals(MyScheduleScreen.getTitleText(driver, 1).getText(), "Routine Visit");
		}
	}
	public void test_Patient_ClickScheduleCheckDate() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Date
			assertEquals(MyScheduleScreen.getDateText(driver, 1).getText(), "04/01/16");
		}
	}
	public void test_Patient_ClickScheduleCheckTime() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Time
			assertEquals(MyScheduleScreen.getTimeText(driver, 1).getText(), "17:00");
		}
	}
	public void test_Patient_ClickScheduleCheckPatient() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Patient
			assertEquals(MyScheduleScreen.getNameText(driver, 1).getText(), "Pranjal Gupta");
		}
	}
	public void test_Patient_ClickScheduleCheckLOV() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//LOV
			assertEquals(MyScheduleScreen.getLOVText(driver, 1).getText(), "2");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsURL() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Schedule Details Screen
			MyScheduleScreen.getRowLink(driver, 1).click();
			assertEquals(PatientScheduleDetailsScreen.getURL() + "/1", driver.getCurrentUrl());
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsPatientID() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Patient Id
			assertEquals(PatientScheduleDetailsScreen.getTitleLabel(driver, 1).getText(),"Routine Visit");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsPatientName() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Patient Name
			assertEquals(PatientScheduleDetailsScreen.getIdLabel(driver, 1).getText(),"1");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsAddress() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Address
			assertEquals(PatientScheduleDetailsScreen.getNameLabel(driver, 1).getText(),"Pranjal Gupta");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsPatientPhone() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Patient Phone
			assertEquals(PatientScheduleDetailsScreen.getPhoneLabel(driver, 1).getText(),"402-555-1234");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsComments() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Comments
			assertEquals(PatientScheduleDetailsScreen.getMobileLabel(driver, 1).getText(),"402-555-4321");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsCheckEmailButton() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
			//Action - Email
			String emailHrefValue = PatientScheduleDetailsScreen.getEmailButton(driver).getAttribute("href");
			Pattern emailPattern = Pattern.compile("^.+@.+\\..+$");
			//The substring is to remove "mailto:" from the emailHrefValue
			Matcher emailMatcher = emailPattern.matcher(emailHrefValue.substring(emailHrefValue.indexOf(':') + 1).trim());			
			assertTrue(emailMatcher.matches());
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsPhoneButton() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getIdText(driver, 1).click();
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