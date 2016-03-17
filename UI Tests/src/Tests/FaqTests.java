package Tests;
//assertEquals
//assertTrue
//assertFalse
//assertNotNull
//assertNull
//assertSame
//assertNotSame
//assertArrayEquals
//Examples: http://www.tutorialspoint.com/junit/junit_using_assertion.htm
import Framework.BaseTestCase;
//import Repo.PatientScheduleDetailsScreen;
//import Repo.PatientScheduleDetailsScreen;
import Repo.FAQScreen;
import Repo.FAQScreenSearch;
import Repo.HomeScreen;
import Repo.LoginScreen;
//import Repo.MyScheduleScreen;
//import Repo.PatientScheduleDetailsScreen;
import Repo.ToolbarScreen;
import Repo.WelcomeScreen;

//import java.util.regex.Matcher;
//import java.util.regex.Pattern;

import org.openqa.selenium.*;

public class FaqTests extends BaseTestCase {
	
	public void test_Patient_SearchExistingInputKeywordInFAQScreen() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			
			LoginScreen.loginAsPatientUser(driver);
			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());			
			//Home Screen
			HomeScreen.getFAQButton(driver).click();
			assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());
			
			//FAQ Search Input
			FAQScreen.getSearchBox(driver, 1).sendKeys("Caregivers");
			FAQScreen.getSearchSubmitButton(driver, 1).click();
			assertEquals(FAQScreenSearch.getURL(), driver.getCurrentUrl());
			
			//Compare Values
			assertEquals(FAQScreenSearch.getQuestionText(driver, 1).getText(), "Who are the VNA Companion Care caregivers?");
			FAQScreenSearch.getRow(driver, 1).click();
			assertEquals(FAQScreenSearch.getAnswerText(driver, 1).getText(), "VNA Companion Care employs well-trained staff to provide all levels of care. All employees are competency tested and receive continual training in specialized areas. All VNA Companion Care staff are thoroughly screened, background checked, drug tested, bonded, and insured.");
			assertEquals(FAQScreenSearch.getQuestionText(driver, 2).getText(), "Can Caregivers provide nursing care?");
			FAQScreenSearch.getRow(driver, 2).click();
			assertEquals(FAQScreenSearch.getAnswerText(driver, 2).getText(), "As a licensed home healthcare agency, VNA is able to provide skilled medical care in the home in addition to Companion Care services. Skilled care is often covered paid for under a person’s insurance plan.");
			
			//Go Back To FAQ Screen
			driver.navigate().back();
			assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());			
			ToolbarScreen.getUserMenuLink(driver).click();
			ToolbarScreen.getLogoutLink(driver).click();
			assertEquals(WelcomeScreen.getURL() + "/", driver.getCurrentUrl());
		}
	}
		public void test_Patient_SearchNullInputKeywordInFAQScreen() throws Exception {
			for (WebDriver driver : super.getDrivers()) {
				
				LoginScreen.loginAsPatientUser(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());			
				//Home Screen
				HomeScreen.getFAQButton(driver).click();
				assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());
				
				//FAQ Search Input
				FAQScreen.getSearchBox(driver, 1).sendKeys("");
				FAQScreen.getSearchSubmitButton(driver, 1).click();
				assertEquals(FAQScreenSearch.getURL(), driver.getCurrentUrl());
				
				//Compare Values
				assertEquals(FAQScreenSearch.getQuestionText(driver, 1).getText(), "How are Companion Care services paid for?");
				FAQScreenSearch.getRow(driver, 1).click();
				assertEquals(FAQScreenSearch.getAnswerText(driver, 1).getText(), "VNA Companion Care services are typically Private Pay, however VNA Companion Care does accept payment from long-term care insurance, trust officers, the VA, Medicaid Waiver, Workmen’s Compensation, Respite Grants and other third party payers.");
				assertEquals(FAQScreenSearch.getQuestionText(driver, 2).getText(), "When are VNA Companion Care Services available?");
				FAQScreenSearch.getRow(driver, 2).click();
				assertEquals(FAQScreenSearch.getAnswerText(driver, 2).getText(), "VNA Companion Care services are available from as few as 3 hours a week to 24 hours a day, 7 days a week, 365 days a year. VNA Companion Care serves the greater Omaha / Council Bluffs metropolitan area.");
				assertEquals(FAQScreenSearch.getQuestionText(driver, 3).getText(), "Who are the VNA Companion Care caregivers?");
				FAQScreenSearch.getRow(driver, 3).click();
				assertEquals(FAQScreenSearch.getAnswerText(driver, 3).getText(), "VNA Companion Care employs well-trained staff to provide all levels of care. All employees are competency tested and receive continual training in specialized areas. All VNA Companion Care staff are thoroughly screened, background checked, drug tested, bonded, and insured.");
				assertEquals(FAQScreenSearch.getQuestionText(driver, 4).getText(), "Can Caregivers provide nursing care?");
				FAQScreenSearch.getRow(driver, 4).click();
				assertEquals(FAQScreenSearch.getAnswerText(driver, 4).getText(), "As a licensed home healthcare agency, VNA is able to provide skilled medical care in the home in addition to Companion Care services. Skilled care is often covered paid for under a person’s insurance plan.");
				assertEquals(FAQScreenSearch.getQuestionText(driver, 5).getText(), "What services are offered?");
				FAQScreenSearch.getRow(driver, 5).click();
				assertEquals(FAQScreenSearch.getAnswerText(driver, 5).getText(), "VNA Caregivers provide help with day-to-day living, ranging from light housekeeping and meal preparation, to assistance with activities of daily living and help with medications.");
			
				//Go Back To FAQ Screen
				driver.navigate().back();
				assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());			
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getLogoutLink(driver).click();
				assertEquals(WelcomeScreen.getURL() + "/", driver.getCurrentUrl());
			}
		}	
					
			public void test_Patient_SearchNonExistingInputKeywordInFAQScreen_Fail() throws Exception {
				for (WebDriver driver : super.getDrivers()) {
					
					LoginScreen.loginAsPatientUser(driver);
					assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());			
					//Home Screen
					HomeScreen.getFAQButton(driver).click();
					assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());
					
					//FAQ Search Input
					FAQScreen.getSearchBox(driver, 1).sendKeys("Zoro");
					FAQScreen.getSearchSubmitButton(driver, 1).click();
					assertEquals(FAQScreenSearch.getURL(), driver.getCurrentUrl());
					
					//Compare Values
					
					assertEquals(FAQScreenSearch.getQuestionText(driver, 1).getText(), "This is a patient specific FAQ.");
					FAQScreenSearch.getRow(driver, 1).click();
					assertEquals(FAQScreenSearch.getAnswerText(driver, 1).getText(), "Only patients can see FAQs like this.");
					
					//Go Back To FAQ Screen
					driver.navigate().back();
					assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());			
					ToolbarScreen.getUserMenuLink(driver).click();
					ToolbarScreen.getLogoutLink(driver).click();
					assertEquals(WelcomeScreen.getURL() + "/", driver.getCurrentUrl());
				}}
				
			//Login as Caregiver
			public void test_Caregiver_SearchExistingInputKeywordInFAQScreen() throws Exception {
				for (WebDriver driver : super.getDrivers()) {
					
					LoginScreen.loginAsPatientUser(driver);
					assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());			
					//Home Screen
					HomeScreen.getFAQButton(driver).click();
					assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());
					
					//FAQ Search Input
					FAQScreen.getSearchBox(driver, 1).sendKeys("Caregivers");
					FAQScreen.getSearchSubmitButton(driver, 1).click();
					assertEquals(FAQScreenSearch.getURL(), driver.getCurrentUrl());
					
					//Compare Values
					assertEquals(FAQScreenSearch.getQuestionText(driver, 1).getText(), "Who are the VNA Companion Care caregivers?");
					FAQScreenSearch.getRow(driver, 1).click();
					assertEquals(FAQScreenSearch.getAnswerText(driver, 1).getText(), "VNA Companion Care employs well-trained staff to provide all levels of care. All employees are competency tested and receive continual training in specialized areas. All VNA Companion Care staff are thoroughly screened, background checked, drug tested, bonded, and insured.");
					assertEquals(FAQScreenSearch.getQuestionText(driver, 2).getText(), "Can Caregivers provide nursing care?");
					FAQScreenSearch.getRow(driver, 2).click();
					assertEquals(FAQScreenSearch.getAnswerText(driver, 2).getText(), "As a licensed home healthcare agency, VNA is able to provide skilled medical care in the home in addition to Companion Care services. Skilled care is often covered paid for under a person’s insurance plan.");
					
					//Go Back To FAQ Screen
					driver.navigate().back();
					assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());			
					ToolbarScreen.getUserMenuLink(driver).click();
					ToolbarScreen.getLogoutLink(driver).click();
					assertEquals(WelcomeScreen.getURL() + "/", driver.getCurrentUrl());
				}
			}
				public void test_Caregiver_SearchNullInputKeywordInFAQScreen() throws Exception {
					for (WebDriver driver : super.getDrivers()) {
						
						LoginScreen.loginAsCaregiverUser(driver);
						assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());			
						//Home Screen
						HomeScreen.getFAQButton(driver).click();
						assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());
						
						//FAQ Search Input
						FAQScreen.getSearchBox(driver, 1).sendKeys("");
						FAQScreen.getSearchSubmitButton(driver, 1).click();
						assertEquals(FAQScreenSearch.getURL(), driver.getCurrentUrl());
						
						//Compare Values
						assertEquals(FAQScreenSearch.getQuestionText(driver, 1).getText(), "How are Companion Care services paid for?");
						FAQScreenSearch.getRow(driver, 1).click();
						assertEquals(FAQScreenSearch.getAnswerText(driver, 1).getText(), "VNA Companion Care services are typically Private Pay, however VNA Companion Care does accept payment from long-term care insurance, trust officers, the VA, Medicaid Waiver, Workmen’s Compensation, Respite Grants and other third party payers.");
						assertEquals(FAQScreenSearch.getQuestionText(driver, 2).getText(), "When are VNA Companion Care Services available?");
						FAQScreenSearch.getRow(driver, 2).click();
						assertEquals(FAQScreenSearch.getAnswerText(driver, 2).getText(), "VNA Companion Care services are available from as few as 3 hours a week to 24 hours a day, 7 days a week, 365 days a year. VNA Companion Care serves the greater Omaha / Council Bluffs metropolitan area.");
						assertEquals(FAQScreenSearch.getQuestionText(driver, 3).getText(), "Who are the VNA Companion Care caregivers?");
						FAQScreenSearch.getRow(driver, 3).click();
						assertEquals(FAQScreenSearch.getAnswerText(driver, 3).getText(), "VNA Companion Care employs well-trained staff to provide all levels of care. All employees are competency tested and receive continual training in specialized areas. All VNA Companion Care staff are thoroughly screened, background checked, drug tested, bonded, and insured.");
						assertEquals(FAQScreenSearch.getQuestionText(driver, 4).getText(), "Can Caregivers provide nursing care?");
						FAQScreenSearch.getRow(driver, 4).click();
						assertEquals(FAQScreenSearch.getAnswerText(driver, 4).getText(), "As a licensed home healthcare agency, VNA is able to provide skilled medical care in the home in addition to Companion Care services. Skilled care is often covered paid for under a person’s insurance plan.");
						assertEquals(FAQScreenSearch.getQuestionText(driver, 5).getText(), "What services are offered?");
						FAQScreenSearch.getRow(driver, 5).click();
						assertEquals(FAQScreenSearch.getAnswerText(driver, 5).getText(), "VNA Caregivers provide help with day-to-day living, ranging from light housekeeping and meal preparation, to assistance with activities of daily living and help with medications.");
					
						//Go Back To FAQ Screen
						driver.navigate().back();
						assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());			
						ToolbarScreen.getUserMenuLink(driver).click();
						ToolbarScreen.getLogoutLink(driver).click();
						assertEquals(WelcomeScreen.getURL() + "/", driver.getCurrentUrl());
					}
				}	
											
						public void test_Caregiver_SearchNonExistingInputKeywordInFAQScreen_Fail() throws Exception {
						for (WebDriver driver : super.getDrivers()) {
							
							LoginScreen.loginAsPatientUser(driver);
							assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());			
							//Home Screen
							HomeScreen.getFAQButton(driver).click();
							assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());
							
							//FAQ Search Input
							FAQScreen.getSearchBox(driver, 1).sendKeys("Zoro");
							FAQScreen.getSearchSubmitButton(driver, 1).click();
							assertEquals(FAQScreenSearch.getURL(), driver.getCurrentUrl());
							
							//Compare Values
							
							assertEquals(FAQScreenSearch.getQuestionText(driver, 1).getText(), "This is a patient specific FAQ.");
							FAQScreenSearch.getRow(driver, 1).click();
							assertEquals(FAQScreenSearch.getAnswerText(driver, 1).getText(), "Only patients can see FAQs like this.");
							
							//Go Back To FAQ Screen
							driver.navigate().back();
							assertEquals(FAQScreen.getURL(), driver.getCurrentUrl());			
							ToolbarScreen.getUserMenuLink(driver).click();
							ToolbarScreen.getLogoutLink(driver).click();
							assertEquals(WelcomeScreen.getURL() + "/", driver.getCurrentUrl());
						}}
						
}
