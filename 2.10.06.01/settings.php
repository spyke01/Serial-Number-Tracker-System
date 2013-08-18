<? 
/***************************************************************************
 *                               settings.php
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

if ($_SESSION['user_level'] == ADMIN) {
		if (isset($_POST['submit'])) {		
			foreach($_POST as $name => $value) {
				if ($name != 'submit'){			
					if ($name == "ftstss_active") {
						if ($value == "") { $value = 0; }
						else { $value = 1; }	
					}
					$sql = "UPDATE `" . DBTABLEPREFIX . "config` SET value = '" . $value . "' WHERE name = '" . $name . "'";
					
					$result = mysql_query($sql);
				}
			}		
			unset($_POST['submit']);
		}
		
		$sql = "SELECT * FROM `" . DBTABLEPREFIX . "config`";
		$result = mysql_query($sql);
		
		// This is used to let us get the actual items and not just name and value
		while ($row = mysql_fetch_array($result)) {
			$current_config[$row['name']] = $row['value'];
		}	
		//extract($current_config);
			
		//==================================================
		// Print out our config table
		//==================================================
		$content = "<form action=\"" . $menuvar['SETTINGS'] . "\" method=\"post\" target=\"_top\">
						<table class=\"contentBox\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">
							<tr><td class=\"title1\" colspan=\"2\">" . $T_SNTS_SETTINGS . "</td></tr>
							<tr class=\"row1\">
								<td width=\"32%\"><strong>" . $T_ACTIVE . ": </strong></td>
								<td width=\"68%\">
									<select name=\"ftssnts_active\">
										<option value=\"". ACTIVE . "\"" . testSelected($current_config['ftssnts_active'], ACTIVE) . ">Active</option>
										<option value=\"". INACTIVE . "\"" . testSelected($current_config['ftssnts_active'], INACTIVE) . ">Inactive</option>
									</select>
								</td>
							</tr>
							<tr class=\"row2\">
								<td><strong>" . $T_INACTIVE_MSG . ":</strong></td>
								<td>
									<textarea name=\"ftssnts_inactive_msg\" cols=\"45\" rows=\"10\">" . $current_config['ftssnts_inactive_msg'] . "</textarea>
								</td>
							</tr>
							<tr class=\"row1\">
								<td><strong>" . $T_COOKIE_NAME . ": </strong></td>
								<td>
									<input name=\"ftssnts_cookie_name\" type=\"text\" size=\"60\" value=\"" . $current_config['ftssnts_cookie_name'] . "\" />
								</td>
							</tr>
							<tr class=\"row2\">
								<td><strong>" . $T_SNTS_DEFAULT_LANGUAGE . ": </strong></td>
								<td>
									<select name=\"ftssnts_language\">";
		foreach ($LANGUAGES as $abbrev => $long) {
			$content .= "\n								<option value=\"" . $abbrev . "\"" . testSelected($current_config['ftssnts_language'], $abbrev) . ">" . $long . "</option>";
		}
		$content .= "								
									</select>
								</td>
							</tr>
							<tr class=\"row1\">
								<td><strong>" . $T_ADMIN_EMAIL . ": </strong></td>
								<td>
									<input name=\"ftssnts_admin_email\" type=\"text\" size=\"60\" value=\"" . $current_config['ftssnts_admin_email'] . "\" />
								</td>
							</tr>
						</table>
						<br />
						<div class=\"center\"><input type=\"submit\" name=\"submit\" class=\"button\" value=\"" . $T_SETTINGS_UPDATE_BUTTON . "\" /></div>
					</form>";

		//==================================================
		// Print out our pcats table
		//==================================================
		$content .= "<br /><br />
					<div id=\"updateMe\">" . returnCatsTable() . "</div>";
	
	$page->setTemplateVar('PageContent', $content);
}
else {
	$page->setTemplateVar('PageContent', "\nYou Are Not Authorized To Access This Area. Please Refrain From Trying To Do So Again.");
}
?>