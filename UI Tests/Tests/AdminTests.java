package Tests;

import Framework.BaseTestCase;
import Repo.AdminScreen;
import Repo.FAQScreen;
import Repo.HomeScreen;
import Repo.LoginScreen;
import Repo.MyAccountScreen;
import Repo.ToolbarScreen;
import org.junit.runners.MethodSorters;
import org.junit.FixMethodOrder;
import org.openqa.selenium.*;

@FixMethodOrder(MethodSorters.NAME_ASCENDING)
public class AdminTests extends BaseTestCase{

	public void test_ACheckAdminTestIsAdminUserAdminTest() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsAdminTest(driver);
			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			
			ToolbarScreen.getUserMenuLink(driver).click();
			ToolbarScreen.getManageLink(driver).click();
	        assertEquals(AdminScreen.getURL(), driver.getCurrentUrl());
		}
	}
		public void test_BCheckAdminTestCanOpenUserManagementURLUserAdminTest() throws Exception {
			for (WebDriver driver : super.getDrivers()) {
				LoginScreen.loginAsAdminTest(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
				
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				
		        AdminScreen.getUserManagement(driver).click();
		        assertEquals(AdminScreen.getManageURL(), driver.getCurrentUrl());
			}
		}
		public void test_CCSetAdminUserASAdminUserAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
			
			LoginScreen.loginAsAdminTest(driver);
			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			//Dropdown menu select
			ToolbarScreen.getUserMenuLink(driver).click();
			ToolbarScreen.getManageLink(driver).click();
			//Admin Screen select
	        AdminScreen.getUserManagement(driver).click();
	        AdminScreen.getEditUserManagement(driver, 6).click();
	        AdminScreen.getChangeRoleToAdmin(driver).click();
	        AdminScreen.getChangeRoleToAdmin(driver).sendKeys("a");
	        AdminScreen.getChangeRoleToAdmin(driver).sendKeys(Keys.ENTER);
	        AdminScreen.getClickSave(driver).click();
	        assertEquals(AdminScreen.getManageURL(), driver.getCurrentUrl());
		}
	}
		
		public void test_DCheckAdminUserIfStillAdminUserAdminConfig() throws Exception{
			for (WebDriver driver : super.getDrivers()) {
				
				LoginScreen.loginAsAdminUser(driver);
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
			}
		}
		public void test_ERemoveAdminFunctionFromAdminUserUserAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()) {
				
				LoginScreen.loginAsAdminTest(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
				//Dropdown menu select
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				//Admin Screen select
		        AdminScreen.getUserManagement(driver).click();
		        AdminScreen.getEditUserManagement(driver, 6).click();
		        AdminScreen.getChangeRoleToAdmin(driver).click();
		        AdminScreen.getChangeRoleToAdmin(driver).sendKeys("r");
		        AdminScreen.getChangeRoleToAdmin(driver).sendKeys(Keys.ENTER);
		        AdminScreen.getClickSave(driver).click();
		        assertEquals(AdminScreen.getManageURL(), driver.getCurrentUrl());
			}
		}

		public void test_HRemoveTestUserFromSystemTestUserAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
				//Remove Register Test User
				LoginScreen.loginAsAdminTest(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
				//Dropdown menu select
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				//Admin Screen select
		        AdminScreen.getUserManagement(driver).click();
		        AdminScreen.getRemoveButton(driver, 6).click();
		        assertEquals(AdminScreen.getRemoveURL(), driver.getCurrentUrl());
		        AdminScreen.getRemoveButtonVer(driver).sendKeys(Keys.BACK_SPACE);
			}
		}
    public void setAttributeValue(WebDriver driver, WebElement elem, String attribute, String value){

    	JavascriptExecutor js = (JavascriptExecutor) driver; 
        String scriptSetAttrValue = "arguments[0].setAttribute('" + attribute + "', '" + value + "')";
        js.executeScript(scriptSetAttrValue, elem);

    }

    public void test_L1TestUserAddRoles() throws Exception {
    	for (WebDriver driver : super.getDrivers()) {
	    	driver.get(LoginScreen.getURL());
	    	LoginScreen.loginAsAdminTest(driver);
	    	driver.get("https://app-vnasdev.rhcloud.com/role/6");
    		//This is the piece of the test that matters
	    	//Get the WebElement
    		WebElement we = driver.findElement(By.id("patient_search"));
    		//Use the other function to set the value
    		setAttributeValue(driver, we, "value", "133668");
	        AdminScreen.getChangeRoleToPatientSbmtBtn(driver).click();
    	}
    }
    public void test_L2TestUserVerifyRolesTest() throws Exception {
    	for (WebDriver driver : super.getDrivers()) {
	    	driver.get(LoginScreen.getURL());
	    	LoginScreen.loginAsAdminUser(driver);
	    	HomeScreen.getMyAccountButton(driver).click();
	    	assertEquals(MyAccountScreen.getNameLabel1(driver).getText(), "Alyce B");
    	}
    }
    public void test_L3TestUserRemoveRoles() throws Exception {
    	for (WebDriver driver : super.getDrivers()) {
	    	driver.get(LoginScreen.getURL());
	    	LoginScreen.loginAsAdminTest(driver);
	    	driver.get("https://app-vnasdev.rhcloud.com/role/6");
    		AdminScreen.getRemovePatientID(driver).click();
	        AdminScreen.getChangeRoleToPatientSbmtBtn(driver).click();
    	}
    }
    public void test_L4TestUserVerifyRolesTest() throws Exception {
    	for (WebDriver driver : super.getDrivers()) {
	    	driver.get(LoginScreen.getURL());
	    	LoginScreen.loginAsAdminTest(driver);
	    	driver.get("https://app-vnasdev.rhcloud.com/role/6");
	    	assertEquals(AdminScreen.getUserManagementPatientRole(driver).getText(),"");
    	}
    }
		public void test_M1LockUnLockVNASAdminUserUserAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
				LoginScreen.loginAsAdminUserIncorrectPass(driver);
				LoginScreen.loginAsAdminUserIncorrectPass(driver);
				LoginScreen.loginAsAdminUserIncorrectPass(driver);
				LoginScreen.loginAsAdminUserIncorrectPass(driver);
				LoginScreen.loginAsAdminUserIncorrectPass(driver);
				LoginScreen.loginAsAdminTest(driver);
				//Dropdown menu select
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				//Admin Screen select
		        AdminScreen.getUserManagement(driver).click();
		        AdminScreen.getUnlockButton(driver, 6).click();	
			}
		}
		public void test_M2LoginAsAdminUserTestUserAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
				LoginScreen.loginAsAdminUser(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			}
		}
		public void test_NLoginAsAdminTestAndClickRemoveButtonAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
				LoginScreen.loginAsAdminTest(driver);
				//Dropdown menu select
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				//Admin Screen select
		        AdminScreen.getUserManagement(driver).click();
		        AdminScreen.getRemoveButton(driver, 6).click();
		        assertEquals(AdminScreen.getRemoveURL(), driver.getCurrentUrl());
			}
		}
		public void test_OLoginAsAdminTestAndReviewSystemConfigurationSettingsTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
			LoginScreen.loginAsAdminTest(driver);
			//Dropdown menu select
			ToolbarScreen.getUserMenuLink(driver).click();
			ToolbarScreen.getManageLink(driver).click();
			//System Configuration Settings Screen select
			AdminScreen.getSystemConfigurationSettings(driver).click();
			assertEquals(AdminScreen.getSessionTimeout(driver).getAttribute("value"), "15");
			assertEquals(AdminScreen.getGoogleMapsAPIKey(driver).getAttribute("value"), "AIzaSyDUpg0PlDtAK9fsqO9QFE4zkAjKKzdy7y4");
			assertEquals(AdminScreen.getPayPalAPIKey(driver).getAttribute("value"), "GHN68S7FB25TG");
			assertEquals(AdminScreen.getEmailLockoutCount(driver).getAttribute("value"), "5");
			assertEquals(AdminScreen.getEmailLockoutDurationMins(driver).getAttribute("value"), "60");
			}
		}
		public void test_P1CreatePatientTestFAQTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
			LoginScreen.loginAsAdminTest(driver);
			//Dropdown menu select
			ToolbarScreen.getUserMenuLink(driver).click();
			ToolbarScreen.getManageLink(driver).click();
			//System Configuration Settings Screen select
			AdminScreen.getFAQManagement(driver).click();
			AdminScreen.getFAQAddNewFAQ(driver).click();
			AdminScreen.getFAQQuestionField(driver).sendKeys("Automation Test Patient Question");
			AdminScreen.getFAQAnswerField(driver).sendKeys("Automation Test Patient Answer");
			AdminScreen.getFAQRoleField(driver).sendKeys("Patient");
			AdminScreen.getFAQTagsField(driver).sendKeys("Patient");
			AdminScreen.getFAQSaveBtn(driver).click();
			}
		}
		public void test_P2ValidatePatientTestFAQTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
			LoginScreen.loginAsPatientUser(driver);
			//Click FAQ
			HomeScreen.getFAQButton(driver).click();
			assertEquals(FAQScreen.getQuestion(driver,1).getText(), "Automation Test Patient Question");
			}
		}
		public void test_P3RemovePatientTestFAQTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
				LoginScreen.loginAsAdminTest(driver);
				//Dropdown menu select
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				//System Configuration Settings Screen select
				AdminScreen.getFAQManagement(driver).click();
				AdminScreen.getFAQRemoveFAQ(driver, 1).click();
				Thread.sleep(5000);
				driver.switchTo().alert().accept();
				Thread.sleep(5000);
				//AdminScreen.getFAQRemoveFAQ(driver, 1).sendKeys(Keys.ENTER);
			}
		}
}
