<? 
/***************************************************************************
 *                               index.php
 *                            -------------------
 *   begin                : Tuseday, March 14, 2006
 *   copyright            : (C) 2006 Fast Track Sites
 *   email                : sales@fasttracksites.com
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
// If the db connection file is missing we should redirect the user to install page
if (!file_exists('_db.php')) {
	header("Location: http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/install.php");	
	exit();
}

include 'includes/header.php';

$requested_page_id = $_GET['p'];
$requested_section = $_GET['s'];
$requested_id = $_GET['id'];
$requested_style = $_GET['style'];
$requested_action = $_GET['action'];

$actual_page_id = ($requested_page_id == "" || !isset($requested_page_id)) ? 1 : $requested_page_id;
$actual_page_id = parseurl($actual_page_id);
$actual_section = parseurl($requested_section);
$actual_id = parseurl($requested_id);
$actual_style = parseurl($requested_style);
$actual_action = parseurl($requested_action);
$actual_language_changer = parseurl($requested_language_changer);
$page_content = "";

// Warn the user if the install.php script is present
if (file_exists('install.php')) {
	$page_content = "<div class=\"errorMessage\">Warning: install.php is present, please remove this file for security reasons.</div>";
}

//========================================
// Logout Function
//========================================
// Prevent spanning between apps to avoid a user getting more acces that they are allowed
if ($_SESSION['script_locale'] != rtrim(dirname($_SERVER['PHP_SELF']), '/\\') && session_is_registered('userid')) {
	session_destroy();
}

if ($actual_page_id == "logout") {
	define('IN_FTSSNTS', true);
	include '_db.php';
	include_once ('includes/menu.php');
	include_once ('config.php');
	global $snts_config;
	
	//Destroy Session Cookie
	$cookiename = $snts_config['ftssnts_cookie_name'];
	setcookie($cookiename, false, time()-2592000); //set cookie to delete back for 1 month
	
	//Destroy Session
	session_destroy();
	if(!session_is_registered('first_name')){
		header("Location: http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . "/index.php");	
		exit();
	}
}

//Check to see if advanced options are allowed or not
if (version_functions("advancedOptions") == true) {
	// If the system is locked, then only a moderator or admin should be able to view it
	if ($_SESSION['user_level'] != ADMIN && $_SESSION['user_level'] != MOD && $snts_config['ftssnts_active'] != ACTIVE) {
		if ($actual_page_id == "login") {
			include 'login.php';
		}
		else {	
			$page->setTemplateVar("PageTitle", $T_DISABLED);
			$page->setTemplateVar("PageContent", bbcode($snts_config['ftssnts_inactive_msg']));
		}
		// Top Menus
		$page->makeMenuItem("top", "<img src=\"images/logo.gif\" alt=\"Fast Track Sites Logo\" />", "", "logo");
		$page->makeMenuItem("top", $T_HOME, $menuvar['HOME'], "");
	
		if (!isset($_SESSION['username'])) {
			$page->makeMenuItem("top", $T_LOGIN, $menuvar['LOGIN'], "");
			$page->makeMenuItem("top", $T_REGISTER, $menuvar['REGISTER'], "");
		}
		else {
			$page->makeMenuItem("top", $T_LOGOUT, $menuvar['LOGOUT'], "");
		}
	}
	else {
		//========================================
		// Admin panel options
		//========================================
		if ($actual_page_id == "admin") {
			if (!$_SESSION['username']) { include 'login.php'; }
			else {
				if ($_SESSION['user_level'] == MOD || $_SESSION['user_level'] == ADMIN) {
					if ($actual_section == "" || !isset($actual_section)) {
						include 'admin.php'; 
						$page->setTemplateVar("PageTitle", $T_ADMIN_PANEL);
					}
					elseif ($actual_section == "settings") {
						include 'settings.php';				
						$page->setTemplateVar("PageTitle", $T_CONFIGURATION);
					}
					elseif ($actual_section == "themes") {
						include 'themes.php';			
						$page->setTemplateVar("PageTitle", $T_THEMES);	
					}
					elseif ($actual_section == "users") {
						include 'users.php';			
						$page->setTemplateVar("PageTitle", $T_USER_ADMINISTRATION);	
					}
				}
				else { setTemplateVar("PageContent", "You are not authorized to access the admin panel."); }
			}
		}
		elseif ($actual_page_id == "login") {
			include 'login.php';
			$page->setTemplateVar("PageTitle", "$T_LOGIN");	
		}
		elseif ($actual_page_id == "version") {
			$page->setTemplateVar("PageTitle", "Version Information");	
			
			include('_license.php');
		
			$page_content .= "
				<div class=\"roundedBox\">
					<h1>Version Information</h1>
					<strong>Application:</strong> " . A_NAME . "<br />
					<strong>Version:</strong> " . A_VERSION . "<br />
					<strong>Registered to:</strong> " . $A_Licensed_To . "<br />
					<strong>Serial:</strong> " . $A_License . "
				</div>";
			
			$page->setTemplateVar("PageContent", $page_content);	
		}
		else {
			//========================================
			// Print the Main Page
			//========================================			
			if ($_SESSION['user_level'] == MOD || $_SESSION['user_level'] == ADMIN) {
				$page_content .= $T_THANKS_LOGIN . " <a href=\"" . $menuvar['ADMIN'] . "\">" . $T_LOWER_ADMIN_PANEL . "</a>.<br />";
			}
			else { $page_content .= $T_HOMEPAGE_MSG; }
				
			$page->setTemplateVar("PageTitle", "Home");
			$page->setTemplateVar("PageContent", $page_content);	
	
		}
	
		//================================================
		// Get Menus
		//================================================
		
		// Top Menus
		$page->makeMenuItem("top", "<img src=\"images/logo.gif\" alt=\"Fast Track Sites Logo\" />", "", "logo");
		$page->makeMenuItem("top", $T_HOME, $menuvar['HOME'], "");
		
		if ($_SESSION['user_level'] == MOD || $_SESSION['user_level'] == ADMIN) {
			$page->makeMenuItem("top", $T_ADMIN_PANEL, $menuvar['ADMIN'], "");
			$page->makeMenuItem("top", $T_CONFIGURATION, $menuvar['SETTINGS'], "");
			$page->makeMenuItem("top", $T_THEMES, $menuvar['THEMES'], "");
			$page->makeMenuItem("top", $T_USER_ADMINISTRATION, $menuvar['USERS'], "");
		}
	
		if (!isset($_SESSION['username'])) {
			$page->makeMenuItem("top", $T_LOGIN, $menuvar['LOGIN'], "");
		}
		else {
			$page->makeMenuItem("top", $T_LOGOUT, $menuvar['LOGOUT'], "");
			$page->makeMenuItem("top", make_language_dropdown($languageidentifier), "", "");
		}
	}
}
else { $page->setTemplateVar("PageContent", version_functions("advancedOptionsText")); }

version_functions("no");
if (isset($actual_style) && $actual_style == "printerFriendly") { include "themes/" . $snts_config['ftssnts_theme'] . "/printerFriendlyTemplate.php"; }
else { include "themes/" . $snts_config['ftssnts_theme'] . "/template.php"; }
?>