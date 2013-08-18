<?php
/***************************************************************************
 *                               en.php
 *                            -------------------
 *   begin                : Saturday, Sept 24, 2005
 *   copyright            : (C) 2005 Paden Clayton - Fast Track Sites
 *   email                : sales@fasttacksites.com
 *
 *
 ***************************************************************************/

/***************************************************************************
Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of the <organization> nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 ***************************************************************************/

//============================
// Text values in English
//============================
/*Globally Used Values*/
	/*~~Navigation~~*/
		$T_HOME = "Home";
		$T_LOGIN = "Login";
		$T_LOGOUT = "Logout";
		$T_ADMIN_PANEL = "Admin Panel";
		$T_USER_ADMINISTRATION = "User Administration";
		$T_CONFIGURATION = "Configuration";
		$T_THEMES = "Themes";
	
	/*~~General~~*/
		$T_PLEASE = "Please";
		$T_ALL = "All";
		$T_HOMEPAGE_MSG = "Welcome to the Fast Track Sites Serial Number Tracker System. Using this system, you can keep track of the serial numbers of computers, programs, equipment, or any other products that you need to have a list of.";
		$T_THANKS_LOGIN = "Thank you for logging in, you may now access the";
		$T_PLEASE_LOGIN = "Before being able to use the system, you must first";
		$T_LOWER_LOGIN = "login";
		$T_LOWER_ADMIN_PANEL = "admin panel";
		$T_NOW = "now";
		$T_LANGUAGE_CHANGED = "Your language has been changed, and you are being redirected to the homepage.";
		$T_PRINTER_FRIENDLY_VERSION = "Printer Friendly Version";
		$T_DOWNLOAD_AS_EXCEL = "Download as an Excel Document";
		
	/*~~Logins, Joining, and User Administration~~*/
		$T_USERNAME = "Username";
		$T_PASSWORD = "Password";
		$T_CONFIRM_PASSWORD = "Confirm Password";
		$T_NEW_PASSWORD = "New Password";
		$T_CONFIRM_NEW_PASSWORD = "Confirm New Password";
		$T_EMAIL_ADDRESS = "Email Address";
		$T_USER_LEVEL = "Access Level";
		$T_ADD_USER = "Add a new user";
		$T_EDIT_USER = "Edit a current user";
		$T_DELETE_USER = "Delete a current user";
	
	/*~~Errors~~*/
		$T_NOT_AUTHORIZED = "You are not Authorized to View This Section.";
		$T_NO_SERIALS_FOUND = "No serial numbers were found. Please create one and try again.";
		$T_REQUIRED_USERNAME = "Desired Username is a required field. Please try again.";
		$T_TAKEN_USERNAME = "The username you have selected has already been used by another member in our database. Please choose a different Username!";
		$T_CREATION_ERROR = "There has been an error creating your account. Please contact the webmaster.";
		$T_COULD_NOT_LOGIN = "You could not be logged in! Either the username and password do not match or you have not validated your membership!";
		$T_TRY_AGAIN = "Please try again!";
		$T_ADD_USER_ERROR = "There was an error while creating your new user. You are being redirected to the main page.";
		$T_EDIT_USER_ERROR = "There was an error while accessing the user's details you are trying to update. You are being redirected to the main page.";
		$T_ADD_SERIAL_ERROR = "There was a problem while adding your serial information. You are being redirected to the main page.";
		$T_EDIT_SERIAL_ERROR = "There was a problem while updating your serial information. You are being redirected to the main page.";
		$T_INSERTION_ERROR = "ERROR: SQL query to insert has failed";
		$T_DELETION_ERROR = "ERROR: SQL query to delete has failed";
		$T_UPDATE_ERROR = "ERROR: SQL query to update has failed";

/*Values for admin.php*/
	$T_DISPLAY = "Display";
	$T_SERIAL = "Serial";
	$T_SERIALS = "Serials";
	$T_STARTING_AT ="rows starting at row";
	$T_UPDATE = "UPDATE";
	$T_SEARCH = "Search Serials";
	$T_SERIAL_NUMBER = "Serial Number";
	$T_TYPE = "Type";
	$T_LOCATION = "Location";
	$T_OWNER = "Owner";
	$T_DATE = "Purchase Date";
	$T_TECH = "Technician";
	$T_SEARCH_WARNING = "Input all or part of the following fields to search the database.";
	$T_SEARCH = "Search";
	$T_ADD_SERIAL = "Add serial";
	$T_EDIT_SERIAL = "Edit serial";
	$T_UPDATE_SERIAL = "Update Serial";
	$T_ADD_SERIAL_SUCCESS = "Your serial information was successfully added. You are being redirected to the main page.";
	$T_EDIT_SERIAL_SUCCESS = "Your serial information was successfully updated. You are being redirected to the main page.";

/*Values for settings.php*/
	$T_SNTS_SETTINGS = "Serial Number Tracker System Settings";
	$T_ACTIVE = "Active";
	$T_INACTIVE_MSG = "Inactive Message";
	$T_COOKIE_NAME = "Cookie Name";
	$T_SNTS_DEFAULT_LANGUAGE = "Default Language";
	$T_ADMIN_EMAIL = "Admin Email";
	$T_SETTINGS_UPDATE_BUTTON = "Update Settings";
	$T_CHANGE_LANGUAGE = "Change Language";	
	
	$T_ADD_CAT_SUCCESS = "Your new category has been added, and you are being redirected to the main page.";
	$T_EDIT_CAT_SUCCESS = "Your pcategory have been updated, and you are being redirected to the main page.";
	$T_ADD_CAT = "Create Category";
	$T_EDIT_CAT = "Edit Category";
	$T_DELETE_CAT = "Delete Category";
	$T_ADD_CAT_BUTTON = "Create Category";
	$T_EDIT_CAT_BUTTON = "Change It!";
	$T_SERIAL_CATEGORY = "Category";
	$T_CATEGORIES = "Categories";
	$T_CATEGORY_NAME = "Category Name";
	
/*Values for footer.php*/
	$T_POWERED_BY = "Powered By";
	$T_FTSSNTS = "Fast Track Sites Serial Number Tracker System";
	$T_COPYRIGHT = "Copyright";
	$T_FTS = "Fast Track Sites";
	
/*Values for header.php*/
	$T_WELCOME_BACK = "Welcome Back";
	$T_WELCOME_GUEST = "Welcome Guest";
	
/*Values for index.php*/
	$T_CURRENT_TICKETS = "Current Tickets";

/*Values for login.php*/
	$T_NOW_LOGGED_IN_MSG = "You are now logged in as";
	$T_AND_BEING_REDIRECTED_MAIN = "and are being redirected to the main page.";
	$T_STAY_LOGGED_IN = "Stay logged in";
	
/*Values for users.php*/
	$T_ADD_USER_SUCCESS = "Your new user has been added, and you are being redirected to the main page.";
	$T_EDIT_USER_SUCCESS = "Your user's details have been updated, and you are being redirected to the main page.";
	$T_ADD_USER_BUTTON = "Create User";
	$T_EDIT_USER_BUTTON = "Change It!";
	$T_CURRENT_USERS = "Current Users";
	
/*Values for themes.php*/
	$T_CHANGE_THEME_SUCCESS = "Your theme has been successfully changed.";
	$T_CHANGE_THEME_ERROR = "There was an error while attempting to change your theme.";
	$T_PREVIEW = "Preview";
	$T_FIRST_NAME = "First Name";
	$T_LAST_NAME = "Last Name";
	$T_AUTHOR = "Author";
	$T_ACTIVE = "Active";
	$T_THEMES_UPDATE_BUTTON = "Change It!";

?>