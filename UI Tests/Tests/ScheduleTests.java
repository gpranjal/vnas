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
	//No ID Field
//	public void test_Caregiver_ClickScheduleDetailScreenIDText1() throws Exception {
//		for (WebDriver driver : super.getDrivers()) {
//			LoginScreen.loginAsCaregiverUser(driver);
//    		HomeScreen.getMyScheduleButton(driver).click();
//    		MyScheduleScreen.getTitleText(driver, 1).click();
//			//ID
//			assertEquals(MyScheduleScreen.getTitleText(driver, 1).getText(), "7159001");
//		}
//	}
	public void test_Caregiver_ClickScheduleDetailScreenTitleText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Title
			assertEquals(MyScheduleScreen.getTitleText(driver, 1).getText(), "CompCare");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenDateText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Date
			assertEquals(MyScheduleScreen.getDateText(driver, 1).getText(), "04/08/16");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenTimeText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Time
			assertEquals(MyScheduleScreen.getTimeText(driver, 1).getText(), "13:00 - 16:00");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenNameText1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Patient
			assertEquals(MyScheduleScreen.getNameText(driver, 1).getText(), "Alyce B");
		}
	}
//No LOV field anymore
//	public void test_Caregiver_ClickScheduleDetailScreenLOVText1() throws Exception {
//		for (WebDriver driver : super.getDrivers()) {
//			LoginScreen.loginAsCaregiverUser(driver);
//    		HomeScreen.getMyScheduleButton(driver).click();
//			//LOV
//			assertEquals(MyScheduleScreen.getLOVText(driver, 1).getText(), "2");
//		}
//	}
	public void test_Caregiver_ClickScheduleDetailScreenGetURLTest() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Schedule Details Screen
			MyScheduleScreen.getRowLink(driver, 1).click();
			assertEquals(CaregiverScheduleDetailsScreen.getURL() + "/3814", driver.getCurrentUrl());
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenPatientID1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Patient Id
			assertEquals(CaregiverScheduleDetailsScreen.getIdLabel(driver, 1).getText(),"133668");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenPatientName1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Patient Name
			assertEquals(CaregiverScheduleDetailsScreen.getNameLabel(driver, 1).getText(),"Alyce B");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenPatientAddress1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Address
			assertEquals(CaregiverScheduleDetailsScreen.getAddressLabel(driver, 1).getText(),"3319 South 45th Street");
			
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenPatientPhone1() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Patient Phone
			assertEquals(CaregiverScheduleDetailsScreen.getPhoneLabel(driver, 1).getText(),"(402) 556-4367");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenComments() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Comments
			assertEquals(CaregiverScheduleDetailsScreen.getCommentsLabel(driver, 1).getText(),"");
		}
	}
	public void test_Caregiver_ClickScheduleDetailScreenHomeScreenURL() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsCaregiverUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
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
			MyScheduleScreen.getTitleText(driver, 1).click();
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
// No ID field
//	public void test_Patient_ClickScheduleCheckID() throws Exception {
//				for (WebDriver driver : super.getDrivers()) {
//					LoginScreen.loginAsPatientUser(driver);
//		    		HomeScreen.getMyScheduleButton(driver).click();
//		    		MyScheduleScreen.getIdText(driver, 1).click();
//			//ID
//			assertEquals(MyScheduleScreen.getIdText(driver, 1).getText(), "27927");
//				}
//	}
	public void test_Patient_ClickScheduleCheckTitle() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Title
			assertEquals(MyScheduleScreen.getTitleText(driver, 1).getText(), "CompCare");
		}
	}
	public void test_Patient_ClickScheduleCheckDate() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Date
			assertEquals(MyScheduleScreen.getDateText(driver, 1).getText(), "03/12/16");
		}
	}
	public void test_Patient_ClickScheduleCheckTime() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Time
			assertEquals(MyScheduleScreen.getTimeText(driver, 1).getText(), "09:00 - 16:00");
		}
	}
	public void test_Patient_ClickScheduleCheckPatient() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Patient
			assertEquals(MyScheduleScreen.getNameText(driver, 1).getText(), "Diana M");
		}
	}
// No LOV Field	
//	public void test_Patient_ClickScheduleCheckLOV() throws Exception {
//		for (WebDriver driver : super.getDrivers()) {
//			LoginScreen.loginAsPatientUser(driver);
//    		HomeScreen.getMyScheduleButton(driver).click();
//			//LOV
//			assertEquals(MyScheduleScreen.getLOVText(driver, 1).getText(), "2");
//		}
//	}
	public void test_Patient_ClickScheduleCheckDetailsURL() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
			//Schedule Details Screen
			MyScheduleScreen.getRowLink(driver, 1).click();
			assertEquals(PatientScheduleDetailsScreen.getURL() + "/4396", driver.getCurrentUrl());
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsPatientTitle() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Patient Id
			assertEquals(PatientScheduleDetailsScreen.getTitleLabel(driver, 1).getText(),"CompCare");
		}
	}
//  No ID Field
//	public void test_Patient_ClickScheduleCheckDetailsPatientID() throws Exception {
//		for (WebDriver driver : super.getDrivers()) {
//			LoginScreen.loginAsPatientUser(driver);
//    		HomeScreen.getMyScheduleButton(driver).click();
//			//Patient Name
//			assertEquals(PatientScheduleDetailsScreen.getIdLabel(driver, 1).getText(),"27927");
//		}
//	}
	public void test_Patient_ClickScheduleCheckDetailsAddress() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Address
			assertEquals(PatientScheduleDetailsScreen.getNameLabel(driver, 1).getText(),"Diana M");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsPatientPhone() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Patient Phone
			assertEquals(PatientScheduleDetailsScreen.getPhoneLabel(driver, 1).getText(),"(402) 930-4240");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsComments() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
			//Comments
			assertEquals(PatientScheduleDetailsScreen.getMobileLabel(driver, 1).getText(),"(402) 930-4240");
		}
	}
	public void test_Patient_ClickScheduleCheckDetailsCheckEmailButton() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsPatientUser(driver);
    		HomeScreen.getMyScheduleButton(driver).click();
    		MyScheduleScreen.getTitleText(driver, 1).click();
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
    		MyScheduleScreen.getTitleText(driver, 1).click();
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