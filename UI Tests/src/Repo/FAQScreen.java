package Repo;

public class FAQScreen {
	public static String getURL() {
		return BaseScreen.getURL() + getPath();
	}
	
	public static String getPath() {
		return "/faq";
	}
}
