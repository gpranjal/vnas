package Repo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class AdminScreen extends BaseScreen{

	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/admin";
	}
	public static WebElement getManageToolBarLink(WebDriver driver) {
		return driver.findElement(By.name("manageToolbarLink"));
	}
	public static WebElement getUserManagement(WebDriver driver) {
		return driver.findElement(By.linkText("User Management"));
	}
	public static WebElement getUserManagementPatientRole(WebDriver driver) {
		return driver.findElement(By.id("patient_fetch"));
	}
	public static WebElement getSystemConfigurationSettings(WebDriver driver) {
		return driver.findElement(By.linkText("System Configuration Settings"));
	}
	public static WebElement getFAQManagement(WebDriver driver) {
		return driver.findElement(By.linkText("FAQ Management"));
	}
	public static String getManageURL(){
		return BaseScreen.getURL()+getManagePath();
	}
	public static String getManagePath(){
		return "/mnge";
	}
	public static String getRemovePath(){
		return "/remove/7";
	}
	public static String getRemoveURL(){
		return BaseScreen.getURL()+getRemovePath();
	}
	public static WebElement getEditUserManagement(WebDriver driver, int row){
		return driver.findElement(By.name("editButton"+ row));
	}
	public static WebElement getChangeRoleToAdmin(WebDriver driver){
		return driver.findElement(By.name("role"));
	}
	public static WebElement getChangeRoleToPatientID100(WebDriver driver){
		return driver.findElement(By.name("patient_autocomplete"));
	}
	public static WebElement getChangeRoleToPatientSbmtBtn(WebDriver driver){
		return driver.findElement(By.name("btnSubmit"));
	}
	public static WebElement getSelectRoleAdmin(WebDriver driver){
		return driver.findElement(By.id("Admin"));
	}
	public static WebElement getClickSave(WebDriver driver){
		return driver.findElement(By.name("btnSave"));
	}
	public static WebElement getRemoveButton(WebDriver driver, int row ) {
		return driver.findElement(By.name("removeButton" + row));
	}
	public static WebElement getRemoveButtonVer(WebDriver driver){
		return driver.findElement(By.name("removeButton"));
	}
	public static WebElement getRoleButton(WebDriver driver, int row){
		return driver.findElement(By.name("rolebutton" + row));
	}
	public static WebElement getUnlockButton(WebDriver driver, int row){
		return driver.findElement(By.name("unlockButton" + row));
	}
	public static WebElement getUnassignedButton(WebDriver driver){
		return driver.findElement(By.name("btnFilterUnassigned"));
	}
	public static WebElement getRemovePatientID(WebDriver driver){
		return driver.findElement(By.name("link_remove_pateint_role"));
	}
	public static WebElement getRemoveCaregiverID(WebDriver driver){
		return driver.findElement(By.name("link_remove_caregiver_role"));
	}
	//System Config Elements
	public static WebElement getSessionTimeout(WebDriver driver){
		return driver.findElement(By.id("session_timeout_minutes"));
	}
	public static WebElement getGoogleMapsAPIKey(WebDriver driver){
		return driver.findElement(By.id("google_maps_api_key"));
	}
	public static WebElement getPayPalAPIKey(WebDriver driver){
		return driver.findElement(By.id("paypal_api_key"));
	}
	public static WebElement getEmailLockoutCount(WebDriver driver){
		return driver.findElement(By.id("email_lockout_count"));
	}
	public static WebElement getEmailLockoutDurationMins(WebDriver driver){
		return driver.findElement(By.id("email_lockout_duration_mins"));
	}
	//FAQ Management Elements
	public static WebElement getFAQQuestionField(WebDriver driver){
		return driver.findElement(By.name("question"));
	}
	public static WebElement getFAQAnswerField(WebDriver driver){
		return driver.findElement(By.name("answer"));
	}
	public static WebElement getFAQRoleField(WebDriver driver){
		return driver.findElement(By.name("faq_role"));
	}
	public static WebElement getFAQTagsField(WebDriver driver){
		return driver.findElement(By.name("txtTags"));
	}
	public static WebElement getFAQSaveBtn(WebDriver driver){
		return driver.findElement(By.name("btnSave"));
	}
	public static WebElement getFAQAddNewFAQ(WebDriver driver){
		return driver.findElement(By.name("btnAddNewFAQ"));
	}
	public static WebElement getFAQRemoveFAQ(WebDriver driver, int row){
		return driver.findElement(By.name("btnFaqRemove"+row));
	}
}
