<? 
/***************************************************************************
 *                               themes.php
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

	//==================================================
	// Handle editing, adding, and deleting of pages
	//==================================================	
	if (isset($_POST['submit'])) {
		$sql = "UPDATE `" . DBTABLEPREFIX . "config` SET value ='" . $_POST['theme'] . "' WHERE name ='ftssnts_theme' LIMIT 1";
		$result = mysql_query($sql);
		
		if ($result) {
			$content = $T_CHANGE_THEME_SUCCESS . "
						<meta http-equiv=\"refresh\" content=\"5;url=" . $menuvar['THEMES'] . "\">";	
		}
		else {
			$content = $T_CHANGE_THEME_ERROR . "
						<meta http-equiv=\"refresh\" content=\"5;url=" . $menuvar['THEMES'] . "\">";	
		}		
	}		
	else {
		
		$x = 1; //reset the variable we use for our row colors	
		
		//==================================================
		// Get and store our available themes
		//==================================================		
		$stylepath = "themes";
		if($dir = opendir($stylepath)){					
			$sub_dir_names = array();
			while (false !== ($file = readdir($dir))) {				
				if ($file != "." && $file != ".." && $file != "installer" && is_dir($stylepath . '/' . $file)) {
					$sub_dir_names[$file] .= '';	
				}
			}			
		}		
		ksort($sub_dir_names); //sort by name			
			
		//==================================================
		// Print our table
		//==================================================
		$content = "<form name=\"themechanger\" action=\"" . $menuvar['THEMES'] . "\" method=\"post\">
						<table class=\"contentBox\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\">
							<tr>
								<td class=\"title1\" colspan=\"4\">" . $T_THEMES . "</td>
							</tr>							
							<tr class=\"title2\">
								<td><strong>" . $T_PREVIEW . "</strong></td><td><strong>" . $T_NAME . "</strong></td><td><strong>" . $T_AUTHOR . "</strong></td><td><strong>" . $T_ACTIVE . "</strong></td>
							</tr>";			
			
		foreach($sub_dir_names as $name => $nothing) { 			
			$preview = (is_file($stylepath . '/' . $name . '/preview.jpg')) ? $stylepath . "/" . $name . "/preview.jpg" : "images/nopreview.jpg"; // Thanks Joe!		
			$THEME_NAME = "N/A"; // Reset variable
			$THEME_AUTHOR = "N/A"; // Reset variable
			
			if (file_exists($stylepath . '/' . $name . '/themedetails.php')) { include ($stylepath . '/' . $name . '/themedetails.php'); }	
			
			$content .=			"<tr class=\"row" . $x . "\">
									<td width=\"20%\"><center><img src=\"$preview\" alt=\"" . $T_PREVIEW . "\" /></center></td>
									<td width=\"40%\">" . $THEME_NAME . "</td>
									<td width=\"30%\">" . $THEME_AUTHOR . "</td>
									<td width=\"10%\"><center><input name=\"theme\" type=\"radio\" value=\"" . $name . "\"" . testChecked($name, $snts_config['ftssnts_theme']) . " /></center></td>
								</tr>";
								
			$x = ($x==2) ? 1 : 2;					
		}		
		$content .=	"	</table>
					<br />
					<center><input name=\"submit\" class=\"button\" type=\"submit\" value=\"" . $T_THEMES_UPDATE_BUTTON . "\" /></center>
				</form>";
	}
	$page->setTemplateVar('PageContent', $content);
?>