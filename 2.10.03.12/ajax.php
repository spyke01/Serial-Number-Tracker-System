<? 
/***************************************************************************
 *                               ajax.php
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
	include 'includes/header.php';
	
	$actual_id = keepsafe($_GET['id']);
	
	//================================================
	// Main updater and get functions
	//================================================
	// Update an item in a DB table
	if ($_GET['action'] == "updateitem") {
		$item = keepsafe($_GET['item']);
		$table = keepsafe($_GET['table']);
		$value = keeptasafe($_REQUEST['value']);
		$updateto = ($item == "datetimestamp" || $item == "date_ordered" || $item == "date_shipped") ? strtotime($value) : $value;
		
		$sql = "UPDATE `" . DBTABLEPREFIX . $table . "` SET " . $item ." = '" . $updateto . "' WHERE id = '" . $actual_id . "'";
		//echo $sql;
		
		// Only admins or Mods should be able to get whatever they want things
		if ($_SESSION['user_level'] == MOD || $_SESSION['user_level'] == ADMIN) {
			$result = mysql_query($sql);
			echo stripslashes($updateto);	
		}		
		else {
			// Run checks to verify access rights
		 	$authorized = 0;
			
			if ($table == "users" && $item == "language") { $authorized = 1; }
			
			if ($authorized) {
				$result = mysql_query($sql);
				echo stripslashes($updateto);
			}
		}		
	}
	
	// Get an item from a DB table
	elseif ($_GET['action'] == "getitem") {
		$item = keepsafe($_GET['item']);
		$table = keepsafe($_GET['table']);
		
		$sql = "SELECT " . $item . " FROM `" . DBTABLEPREFIX . $table . "` WHERE id = '" . $actual_id . "'";
		$result = mysql_query($sql);
		
		$row = mysql_fetch_array($result);
		mysql_free_result($result);		
		
		// Only admins or Mods should be able to get whatever they want things
		if ($_SESSION['user_level'] == MOD || $_SESSION['user_level'] == ADMIN) {
			if ($item == "datetimestamp" || $item == "date_ordered" || $item == "date_shipped") { 
				$result =  (trim($row[$item]) != "") ? @gmdate('m/d/Y h:i A', $row[$item] + (3600 * '-5.00')) : ""; 
				echo $result;
			}
			else { echo bbcode($row[$item]); }		
		}		
	}	
	
	// Delete a row from a DB table
	elseif ($_GET['action'] == "deleteitem") {
		$table = $_GET['table'];
		$sql = "DELETE FROM `" . DBTABLEPREFIX . $table . "` WHERE id = '" . $actual_id . "'";
		
		// Only admins or Mods should delete things
		if ($_SESSION['user_level'] == MOD || $_SESSION['user_level'] == ADMIN) {
			$result = mysql_query($sql);
		}
	}
		
	//================================================
	// Put our new category into the database
	//================================================
	elseif ($_GET['action'] == "postCat") {
		$newcatname = keeptasafe($_POST['newcatname']);	
		$sql = "INSERT INTO `" . DBTABLEPREFIX . "categories` (`name`) VALUES ('" . $newcatname . "')";
		$result = mysql_query($sql);
		
		echo returnCatsTable();
	}
		
	//================================================
	// Echos the indicator to the screen
	//================================================
	elseif ($_GET['action'] == "showIndicator") {		
		echo "	Please Wait...
				<br />
				<img src=\"themes/" .  $snts_config['ftssnts_theme'] . "/icons/indicator.gif\" alt=\"spinner\" />";
	}
	
	else {
		// Do Nothing
	}

?>
