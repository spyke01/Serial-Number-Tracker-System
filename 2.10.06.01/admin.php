<? 
/***************************************************************************
 *                               admin.php
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
include_once ('includes/xlsclass.php');

if ($_SESSION['user_level'] == ADMIN || $_SESSION['user_level'] == MOD) {
		//=======================================
		// Set up our variables
		//=======================================
		$actual_serial = keeptasafe($_REQUEST['serial']);
		$actual_owner = keeptasafe($_REQUEST['owner']);
		$actual_tech = keeptasafe($_REQUEST['tech']);
		$arguments = "";
		$limit1 = (isset($_REQUEST['limit1'])) ? parseurl($_REQUEST['limit1']) : 0;
		$limit2 = (isset($_REQUEST['limit2'])) ? parseurl($_REQUEST['limit2']) : 100;			

		//=======================================
		// Handle adding serials
		//=======================================
		if ($actual_action == "newserial") {
			if (isset($_POST['submit'])) {
				$sql = "INSERT INTO `" . DBTABLEPREFIX . "serials` (serial, cat_id, type, location, owner, datetimestamp, tech) VALUES ('" . keeptasafe($_POST['serial']) . "', '" . keeptasafe($_POST['cat_id']) . "', '" . keeptasafe($_POST['type']) . "', '" . keeptasafe($_POST['location']) . "', '" . keeptasafe($_POST['owner']) . "', '" . keeptasafe($_POST['date']) . "', '" . keeptasafe($_POST['tech']) . "')";
				$result = mysql_query($sql);
				
				if (!$result) {
					$content .= $T_ADD_SERIAL_ERROR . "
							<meta http-equiv=\"refresh\" content=\"5;url=" . $menuvar['ADMIN'] . "\">";
				}				
				else {
					$content .= $T_ADD_SERIAL_SUCCESS . "
							<meta http-equiv=\"refresh\" content=\"5;url=" . $menuvar['ADMIN'] . "\">";
				}
				
			}
			else {
				$content .= "\n<form action=\"" . $menuvar['ADMIN'] . "&amp;action=newserial\" method=\"post\">
							<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" class=\"contentBox\">
								<tr>
									<td class=\"title1\" colspan=\"2\">" . $T_ADD_SERIAL . "</td>
								</tr>
								<tr>
									<td class=\"row1\">" . $T_SERIAL_NUMBER . "</td><td class=\"row1\"><input type=\"text\" name=\"serial\" size=\"40\" /></td>
								</tr>
								<tr>
									<td class=\"row2\">" . $T_SERIAL_CATEGORY . "</td>
									<td class=\"row2\">
										<select name=\"cat_id\">
											<option value=\"\">--Select One--</option>";
						$sql2 = "SELECT * FROM `" . DBTABLEPREFIX . "categories` ORDER BY name ASC";
						$result2 = mysql_query($sql2);	
			
						if (mysql_num_rows($result2) > 0) {
							while ($row2 = mysql_fetch_array($result2)) {						
								$content .= "\n					 <option value=\"" . $row2['id'] . "\">" . $row2['name'] . "</option>";
							}
							mysql_free_result($result2);
						}
						$content .= "\n							
										</select>
									</td>
								</tr>
								<tr>
									<td class=\"row1\">" . $T_TYPE . "</td><td class=\"row1\"><input type=\"text\" name=\"type\" size=\"40\" /></td>
								</tr>
								<tr>
									<td class=\"row2\">" . $T_LOCATION . "</td>
									<td class=\"row2\">
										<textarea name=\"location\" cols=\"40\" rows=\"5\"></textarea>
									</td>
								</tr>
								<tr>
									<td class=\"row1\">" . $T_OWNER . "</td>
									<td class=\"row1\">
										<textarea name=\"owner\" cols=\"40\" rows=\"5\"></textarea>
									</td>
								</tr>
								<tr>
									<td class=\"row2\">" . $T_DATE . "</td><td class=\"row2\"><input type=\"text\" name=\"date\" size=\"40\" /></td>
								</tr>
								<tr>
									<td class=\"row1\">" . $T_TECH . "</td><td class=\"row1\"><input type=\"text\" name=\"tech\" size=\"40\" /></td>
								</tr>
							</table>
							<br />
							<div class=\"center\"><input type=\"submit\" name=\"submit\" class=\"button\" value=\"" . $T_ADD_SERIAL . "\" /></div>
						</form>";
			}
		}
		
		//=======================================
		// Handle editing serials
		//=======================================
		elseif ($actual_action == "editserial") {
			if (isset($_POST['submit'])) {
				$sql = "UPDATE `" . DBTABLEPREFIX . "serials` SET serial = '" . keeptasafe($_POST['serial']) . "', cat_id = '" . keeptasafe($_POST['cat_id']) . "', type = '" . keeptasafe($_POST['type']) . "', location = '" . keeptasafe($_POST['location']) . "', owner = '" . keeptasafe($_POST['owner']) . "', datetimestamp = '" . keeptasafe($_POST['date']) . "', tech = '" . keeptasafe($_POST['tech']) . "' WHERE id = '$_GET[id]'";
				$result = mysql_query($sql);
				
				if (!$result) {
					$content .= $T_EDIT_SERIAL_ERROR . "
							<meta http-equiv=\"refresh\" content=\"5;url=" . $menuvar['ADMIN'] . "\">";
				}				
				else {
					$content .= $T_EDIT_SERIAL_SUCCESS . "
							<meta http-equiv=\"refresh\" content=\"5;url=" . $menuvar['ADMIN'] . "\">";
				}
			}
			else {
				$content .= "\n<form action=\"" . $menuvar['ADMIN'] . "&amp;action=editserial&amp;id=" . $actual_id . "\" method=\"post\">
							<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" class=\"contentBox\">
								<tr>
									<td class=\"title1\" colspan=\"2\">" . $T_EDIT_SERIAL . "</td>
								</tr>";
					
				$sql = "SELECT * FROM `" . DBTABLEPREFIX . "serials` WHERE id = '" . $actual_id . "'";
				$result = mysql_query($sql);	
			
				if (mysql_num_rows($result) == 0) {
					$content .= "\n		<tr>
	    									<td class=\"row2\" colspan=\"2\">" . $T_NO_SERIALS_FOUND . "</td>
										</tr>";
				}	
				else {
					while ($row = mysql_fetch_array($result)) {

						$content .= "\n		<tr>
											<td class=\"row1\">" . $T_SERIAL_NUMBER . "</td><td class=\"row1\"><input type=\"text\" name=\"serial\" size=\"40\" value=\"" . $row['serial'] . "\" /></td>
										</tr>
										<tr>
											<td class=\"row2\">" . $T_SERIAL_CATEGORY . "</td>
											<td class=\"row2\">
												<select name=\"cat_id\">
													<option value=\"\">--Select One--</option>";
						$sql2 = "SELECT * FROM `" . DBTABLEPREFIX . "categories` ORDER BY name ASC";
						$result2 = mysql_query($sql2);	
			
						if (mysql_num_rows($result2) > 0) {
							while ($row2 = mysql_fetch_array($result2)) {						
								$content .= "\n							 <option value=\"" . $row2['id'] . "\"" . testSelected($row['cat_id'], $row2['id']) . ">" . $row2['name'] . "</option>";
							}
							mysql_free_result($result2);
						}
						$content .= "\n							
												</select>
											</td>
										</tr>
										<tr>
											<td class=\"row1\">" . $T_TYPE . "</td><td class=\"row1\"><input type=\"text\" name=\"type\" size=\"40\" value=\"" . $row['type'] . "\" /></td>
										</tr>
										<tr>
											<td class=\"row2\">" . $T_LOCATION . "</td>
											<td class=\"row2\">
												<textarea name=\"location\" cols=\"40\" rows=\"5\">" . $row['location'] . "</textarea>
											</td>
										</tr>
										<tr>
											<td class=\"row1\">" . $T_OWNER . "</td>
											<td class=\"row1\">
												<textarea name=\"owner\" cols=\"40\" rows=\"5\">" . $row['owner'] . "</textarea>
											</td>
										</tr>
										<tr>
											<td class=\"row2\">" . $T_DATE . "</td><td class=\"row2\"><input type=\"text\" name=\"date\" size=\"40\" value=\"" . $row['datetimestamp'] . "\" /></td>
										</tr>
										<tr>
											<td class=\"row1\">" . $T_TECH . "</td><td class=\"row1\"><input type=\"text\" name=\"tech\" size=\"40\" value=\"" . $row['tech'] . "\" /></td>
										</tr>";			   
					}	
				}
	
				$content .= "\n	</table>
							<br />
							<div class=\"center\"><input type=\"submit\" name=\"submit\" class=\"button\" value=\"" . $T_UPDATE_SERIAL . "\" /></div>
						</form>";
			}
		}
		else {	
		
		//=======================================
		// Handle searches
		//=======================================
		if (isset($actual_serial) || isset($actual_owner) || isset($actual_tech)) {
			$x = 0;
			$doneOnce= 1;
			$arguments = "";
			$searchedFor = array();
			$searchedItem = array();
			
			if ($actual_serial != "") { $searchedFor[$x] = $actual_serial; $searchedItem[$x] = "serial"; $x++; }
			if ($actual_owner != "") { $searchedFor[$x] = $actual_owner; $searchedItem[$x] = "owner"; $x++; }
			if ($actual_tech != "") { $searchedFor[$x] = $actual_tech; $searchedItem[$x] = "tech"; $x++; }
			
			if (count($searchedFor) == 0) { $arguments = ""; }
			else {
				for ($x = 0; $x < count($searchedFor); $x++) {
					if ($doneOnce == 1) { $arguments .= " AND "; }
					
					$arguments .= $searchedItem[$x] . " LIKE '%" . $searchedFor[$x] . "%'";					
					$doneOnce = 1;
				}
			}
		}
		
		//=======================================
		// Handle ordering
		//=======================================
		if ($actual_action == "order") {
			$arguments .= ($_GET['orderby'] != "") ? " ORDER BY " . $_GET['orderby'] : "";
		}
				
		//=======================================
		// Print our search box
		//=======================================
		$content .= "\n
				<form name=\"search\" action=\"" . $menuvar['ADMIN'] . "\" method=\"post\">
					<input type=\"hidden\" name=\"limit1\" value=\"" . $limit1 . "\" />
					<input type=\"hidden\" name=\"limit2\" value=\"" . $limit2 . "\" />
					<table cellpadding=\"1\" cellspacing=\"1\" class=\"contentBoxHalfWidth\">
						<tr>
							<td class=\"title1\" colspan=\"2\">" . $T_SEARCH . "</td>
						</tr>
						<tr>
							<td class=\"title2\" colspan=\"2\">" . $T_SEARCH_WARNING . "</td>
						</tr>
						<tr>
							<td class=\"row2\"><strong>" . $T_SERIAL_NUMBER . ": </strong></td>
							<td class=\"row2\"><input type=\"text\" name=\"serial\" value=\"" . $actual_serial . "\" /></td>
						</tr>
						<tr>
							<td class=\"row2\"><strong>" . $T_OWNER . ": </strong></td>
							<td class=\"row2\"><input type=\"text\" name=\"owner\" value=\"" . $actual_owner . "\" /></td>
						</tr>
						<tr>
							<td class=\"row2\"><strong>" . $T_TECH . ": </strong></td>
							<td class=\"row2\"><input type=\"text\" name=\"tech\" value=\"" . $actual_tech . "\" /></td>
						</tr>
					</table>
					<br />
					<input type=\"submit\" value=\"" . $T_SEARCH . "\" class=\"button\" />
				</form>";
		
		//=======================================
		// Print the rest of our page
		//=======================================
		$content .= "\n<br />
				<form name=\"list\" action=\"" . $menuvar['ADMIN'] . "&amp;serial=" . $actual_serial . "&amp;owner=" . $actual_owner . "&amp;tech=" . $actual_tech . "\" method=\"post\">
					" . $T_DISPLAY . " <input type=\"text\" size=\"4\" value=\"" . $limit2 . "\" name=\"limit2\" /> " . $T_STARTING_AT . " <input type=\"text\" size=\"4\" value=\"" . $limit1 . "\" name=limit1 /> <input name=\"submit\" type=\"submit\" value=\"" . $T_UPDATE . "\" class=\"button\" />
				</form>";
		
		// Export files into Excel
		$excel=new ExcelWriter("files/export.xls");    
		if($excel==false) {
			$content .= $excel->error;
        }		
	
		// Cycle through Categories
		$sql = "SELECT * FROM `" . DBTABLEPREFIX . "categories` ORDER BY name ASC";
		$result = mysql_query($sql);	
		$slideStatus = 1;
		$slideIcon = "themes/" .  $snts_config['ftssnts_theme'] . "/icons/collapseicon.jpg";
		$hidden = "";
		
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_array($result)) {						
				
				// Write our category to the excel file
				$myArr=array($row['name'], "", "", "", "", "");
				$excel->writeLine($myArr, 1);
				
				// Write our headings to the excel file
				$myArr=array($T_SERIAL_NUMBER, $T_TYPE, $T_LOCATION, $T_OWNER, $T_DATE, $T_TECH);
				$excel->writeLine($myArr, 1);
								
				// Cycle through serials in the cat we're on
				$content .= "\n<input type=\"hidden\" name=\"slideStatus" . $row['id'] . "\" id=\"slideStatus" . $row['id'] . "\" value=\"" . $slideStatus . "\" />
						<div class=\"contentBox-wrapper\">
							<span style=\"float: right;\"><a href=\"\" onClick=\"ajaxShowHideSliderWithImg('" . $row['id'] . "'); return false;\"><img id=\"slideImg" . $row['id'] . "\" src=\"" . $slideIcon . "\" alt=\"\" border=\"0\"></a></span>
							" . $row['name'] . "
						</div>
						<div id=\"slideDiv" . $row['id'] . "\"" . $hidden . ">
							<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" class=\"contentBox\">
							<tr>
								<td class=\"title1\" colspan=\"7\">
									<div style=\"float: right;\"><a href=\"" . $menuvar['ADMIN'] . "&action=newserial\"><img src=\"themes/" .  $snts_config['ftssnts_theme'] . "/icons/add.png\" alt=\"" . $T_ADD_SERIAL . "\" /></a></div>
									" . $T_SERIALS . "
								</td>
							</tr>
							<tr>
								<td class=\"title2 center\"><a href=\"" . $menuvar['ADMIN'] . "&action=order&orderby=serial\">" . $T_SERIAL_NUMBER . "</a></td>
								<td class=\"title2 center\"><a href=\"" . $menuvar['ADMIN'] . "&action=order&orderby=type\">" . $T_TYPE . "</a></td>
								<td class=\"title2 center\"><a href=\"" . $menuvar['ADMIN'] . "&action=order&orderby=location\">" . $T_LOCATION . "</a></td>
								<td class=\"title2 center\"><a href=\"" . $menuvar['ADMIN'] . "&action=order&orderby=owner\">" . $T_OWNER . "</a></td>
								<td class=\"title2 center\"><a href=\"" . $menuvar['ADMIN'] . "&action=order&orderby=datetimestamp\">" . $T_DATE . "</a></td>
								<td class=\"title2 center\"><a href=\"" . $menuvar['ADMIN'] . "&action=order&orderby=tech\">" . $T_TECH . "</a></td>
								<td class=\"title2 center\">&nbsp;</td>
							</tr>";
						
				$sql2 = "SELECT * FROM `" . DBTABLEPREFIX . "serials` WHERE cat_id = '" . $row['id'] . "'" . $arguments . " LIMIT $limit1, $limit2";
				$result2 = mysql_query($sql2);	
				
				if (mysql_num_rows($result2) == 0) {
					$content .= "\n<tr>
			    				<td class=\"row2\" colspan=\"7\">" . $T_NO_SERIALS_FOUND . "</td>
							</tr>";
				}	
				else {
					$x = 1;
					
					while ($row2 = mysql_fetch_array($result2)) {			   			
						// Write to file
		   				$myArr=array($row2['serial'], $row2['type'], nl2br($row2['location']), nl2br($row2['owner']), $row2['datetimestamp'], $row2['tech']);
		    			$excel->writeLine($myArr);
						
						// Write to screen
						$content .= "\n	<tr id=\"" . $row2['id'] . "_row\">							
										<td class=\"row" . $x . " center\">" . $row2['serial'] . "</td>
										<td class=\"row" . $x . " center\">" . $row2['type'] . "</td>
										<td class=\"row" . $x . " center\">" . nl2br($row2['location']) . "</td>
										<td class=\"row" . $x . " center\">" . nl2br($row2['owner']) . "</td>
										<td class=\"row" . $x . " center\">" . $row2['datetimestamp'] . "</td>
										<td class=\"row" . $x . " center\">" . $row2['tech'] . "</td>
										<td class=\"row" . $x . " center\"><a href=\"" . $menuvar['ADMIN'] . "&amp;action=editserial&amp;id=" . $row2['id'] . "\"><img src=\"themes/" .  $snts_config['ftssnts_theme'] . "/icons/check.png\" alt=\"" . $T_EDIT_SERIAL . "\" /></a> <a style=\"cursor: pointer; cursor: hand;\" onclick=\"ajaxDeleteNotifier('" . $row2['id'] . "SerialSpinner', 'ajax.php?action=deleteitem&table=serials&id=" . $row2['id'] . "', '$T_SERIAL', '" . $row2['id'] . "_row');\"><img src=\"themes/" .  $snts_config['ftssnts_theme'] . "/icons/delete.png\" alt=\"$T_DELETE_SERIAL\" /></a><span id=\"" . $row2['id'] . "SerialSpinner\" style=\"display: none;\"><img src=\"themes/" .  $snts_config['ftssnts_theme'] . "/icons/indicator.gif\" alt=\"spinner\" /></span></td>
									</tr>";
						
						$x = ($x == 1) ? 2 : 1;
					}	
					mysql_free_result($result2);
				}
				//$slideStatus = 0;
				//$slideIcon = "images/collapseicon_collapsed.jpg";
				//$hidden = " style=\"display: none;\"";
				
				$content .= "\n
							</table>
						</div>
						<br />";
			}
			mysql_free_result($result);
		}		
		
		$excel->close();
				
		$content .= "\n<div class=\"center\"><a href=\"" . $menuvar['ADMIN'] . "&amp;style=printerFriendly&amp;serial=" . $actual_serial . "&amp;owner=" . $actual_owner . "&amp;tech=" . $actual_tech . "&amp;limit1=" . $limit1 . "&amp;limit2=" . $limit2 . "\">" . $T_PRINTER_FRIENDLY_VERSION . "</a><br />
				<a href=\"files/export.xls\">$T_DOWNLOAD_AS_EXCEL</a></div>";
		}

	$page->setTemplateVar('PageContent', version_functions(yes) . "<br /><br />" . $content);
}
else {
	$page->setTemplateVar('PageContent', "\nYou Are Not Authorized To Access This Area. Please Refrain From Trying To Do So Again.");
}
?>