package Tests;

import Framework.BaseTestCase;
import Repo.AdminScreen;
import Repo.HomeScreen;
import Repo.LoginScreen;
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
// Now leaving Register User in system
//		public void test_FRegisterTestUser() throws Exception{
//			for (WebDriver driver : super.getDrivers()){
//				//register the register_test user
//				driver.get(RegisterUserScreen.getURL());
//				Thread.sleep(5000);
//				RegisterUserScreen.getNameTextbox(driver).sendKeys("Register_Test");
//				RegisterUserScreen.getEmailTextbox(driver).sendKeys("register_test@gmail.com");
//				RegisterUserScreen.getPasswordTextbox(driver).sendKeys("register_test1234");
//				RegisterUserScreen.getConfirmPasswordTextbox(driver).sendKeys("register_test1234");
//				RegisterUserScreen.getRegisterButton(driver).click();
//			}
//		}
		public void test_GRegisterTestUserIsSetupUserAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
				//Login with Register User
				LoginScreen.loginAsRegisterUser(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
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
		        AdminScreen.getRemoveButton(driver, 7).click();
		        assertEquals(AdminScreen.getRemoveURL(), driver.getCurrentUrl());
		        AdminScreen.getRemoveButtonVer(driver).sendKeys(Keys.BACK_SPACE);
			}
		}
// Register user can be removed if uncommented
//		public void test_IEnsureRegisterUserIsNotRegistered() throws Exception{
//			for (WebDriver driver : super.getDrivers()){
//				//register the register_test user
//				driver.get(RegisterUserScreen.getURL());
//				Thread.sleep(5000);
//				RegisterUserScreen.getNameTextbox(driver).sendKeys("Register_Test");
//				RegisterUserScreen.getEmailTextbox(driver).sendKeys("register_test@gmail.com");
//				RegisterUserScreen.getPasswordTextbox(driver).sendKeys("register_test1234");
//				RegisterUserScreen.getConfirmPasswordTextbox(driver).sendKeys("register_test1234");
//				RegisterUserScreen.getRegisterButton(driver).click();
//    			String actualText = LoginScreen.getLoginErrorMessageLabel(driver).getText();
//    			String testText = "Whoops! There were some problems with your input.\n\nThese credentials do not match our records.";
//    			assertEquals(testText, actualText);	
//			}
//		}
//		public void test_JTestUserAddRoles() throws Exception{
//			for (WebDriver driver : super.getDrivers()){
//				//Test User logs in
//				LoginScreen.loginAsAdminTest(driver);
//				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
//				//Dropdown menu select
//				ToolbarScreen.getUserMenuLink(driver).click();
//				ToolbarScreen.getManageLink(driver).click();
//				//Admin Screen select
//		        AdminScreen.getUserManagement(driver).click();
//		        Thread.sleep(5000);
//		        AdminScreen.getRoleButton(driver, 9);
//		        //Role Assignment screen
//		        AdminScreen.getChangeRoleToPatientID100(driver).sendKeys("100");
//		        AdminScreen.getChangeRoleToPatientID100SbmtBtn(driver).click();
//			}
//		}
	//This function uses JavaScript to set the value of the hidden inputbox. The value of this inputbox will be sent

    //to the server and then used to update the role of the given user.

//    public void setAttributeValue(WebDriver driver, WebElement elem, String attribute, String value){
//
//    	JavascriptExecutor js = (JavascriptExecutor) driver; 
//        String scriptSetAttrValue = "arguments[0].setAttribute('" + attribute + "', '" + value + "')";
//        js.executeScript(scriptSetAttrValue, elem);
//
//    }
//
//    public void test_test() throws Exception {
//    	for (WebDriver driver : super.getDrivers()) {
//	    	driver.get(LoginScreen.getURL());
//	    	LoginScreen.loginAsAdminTest(driver);
//	    	driver.get("https://app-vnasdev.rhcloud.com/role/8");
//    		//This is the piece of the test that matters
//	    	//Get the WebElement
//    		WebElement we = driver.findElement(By.name("patient_autocomplete"));
//    		//Use the other function to set the value
//	        Thread.sleep(5000);
//    		setAttributeValue(driver, we, "value", "jo");
//	        Thread.sleep(5000);
//	        AdminScreen.getChangeRoleToPatientID100SbmtBtn(driver).click();
//	        Thread.sleep(5000);
//    	}
//
//    }
//}
		public void test_JLockUnLockVNASAdminUserUserAdminTest() throws Exception{
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
		        AdminScreen.getUnlockButton(driver, 6);
			}
			}
		public void test_KLoginAsAdminUserTestUserAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
				LoginScreen.loginAsAdminUser(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			}
		}
		public void test_LLoginAsAdminTestAndClickUnAssignedAdminTestShouldBeThereUserAdminTest() throws Exception{
			for (WebDriver driver : super.getDrivers()){
				LoginScreen.loginAsAdminTest(driver);
				//Dropdown menu select
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				//Admin Screen select
		        AdminScreen.getUserManagement(driver).click();
		        AdminScreen.getUnassignedButton(driver).click();
		        AdminScreen.getRemoveButton(driver, 7).click();
		        assertEquals(AdminScreen.getRemoveURL(), driver.getCurrentUrl());
			}
		}
		public void test_MLoginAsAdminTestAndReviewSystemConfigurationSettingsTest() throws Exception{
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
}
