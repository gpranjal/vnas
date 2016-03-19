package Tests;

import Framework.BaseTestCase;
import Repo.AdminScreen;
import Repo.HomeScreen;
import Repo.LoginScreen;
import Repo.ToolbarScreen;
import org.junit.runners.MethodSorters;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.junit.FixMethodOrder;
import org.openqa.selenium.*;
@FixMethodOrder(MethodSorters.NAME_ASCENDING)
public class AdminTests extends BaseTestCase{

	public void test_ACheckAdminTestIsAdmin() throws Exception {
		for (WebDriver driver : super.getDrivers()) {
			LoginScreen.loginAsAdminTest(driver);
			assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
			
			ToolbarScreen.getUserMenuLink(driver).click();
			ToolbarScreen.getManageLink(driver).click();
	        assertEquals(AdminScreen.getURL(), driver.getCurrentUrl());
		}
	}
		public void test_BCheckAdminTestCanOpenUserManagementURL() throws Exception {
			for (WebDriver driver : super.getDrivers()) {
				LoginScreen.loginAsAdminTest(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
				
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				
		        AdminScreen.getUserManagement(driver).click();
		        assertEquals(AdminScreen.getManageURL(), driver.getCurrentUrl());
			}
		}
		public void test_CCheckAdminUserASAdminThenSetAsAdminIfNeeded() throws Exception{
			for (WebDriver driver : super.getDrivers()) 
			try
			{
				LoginScreen.loginAsAdminUser(driver);
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				
			}
			catch(NoSuchElementException e)
			{
				ToolbarScreen.getLogoutLink(driver).click();
				LoginScreen.loginAsAdminTest(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
				//Dropdown menu select
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				//Admin Screen select
		        AdminScreen.getUserManagement(driver).click();
		        AdminScreen.getEditUserManagement(driver).click();
		        AdminScreen.getChangeRoleToAdmin(driver).click();
		        AdminScreen.getChangeRoleToAdmin(driver).sendKeys("a");
		        AdminScreen.getChangeRoleToAdmin(driver).sendKeys(Keys.ENTER);
		        AdminScreen.getClickSave(driver).click();
		        //assertEquals(AdminScreen.getManageURL(), driver.getCurrentUrl());
			}
		}
		public void test_DCheckAdminUserIfStillAdmin() throws Exception{
			for (WebDriver driver : super.getDrivers()) {
				
				LoginScreen.loginAsAdminUser(driver);
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
			}
		}
		public void test_ERemoveAdminUserFromAdmin() throws Exception{
			for (WebDriver driver : super.getDrivers()) {
				
				LoginScreen.loginAsAdminTest(driver);
				assertEquals(HomeScreen.getURL(), driver.getCurrentUrl());
				//Dropdown menu select
				ToolbarScreen.getUserMenuLink(driver).click();
				ToolbarScreen.getManageLink(driver).click();
				//Admin Screen select
		        AdminScreen.getUserManagement(driver).click();
		        AdminScreen.getEditUserManagement(driver).click();
		        AdminScreen.getChangeRoleToAdmin(driver).click();
		        AdminScreen.getChangeRoleToAdmin(driver).sendKeys("r");
		        AdminScreen.getChangeRoleToAdmin(driver).sendKeys(Keys.ENTER);
		        AdminScreen.getClickSave(driver).click();
			}
		}
}
