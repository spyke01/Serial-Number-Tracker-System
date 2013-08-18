<?php 
/***************************************************************************
 *                               users.php
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

	//===================================================
	// This function is designed to get the name 
	// of a user based on the id passed.
	//
	// USAGE:
	// $userName = getUsername(userID);
	//
	// This will return the user's username from the DB.
	//===================================================
	function getUsername($userID) {		
		$sql = "SELECT username, first_name, last_name FROM `" . USERSDBTABLEPREFIX . "users` WHERE id='" . $userID . "' LIMIT 1";
		$result = mysql_query($sql);
			
		if($result && mysql_num_rows($result) > 0) {
	   		$row = mysql_fetch_array($result);
			$returnVal = (trim($row['username']) != "") ? $row['username'] : "N/A";
			$returnVal .= (trim($row['first_name']) != "") ? " (" . $row['last_name'] . ", " . $row['first_name'] . ")" : "";
	   		return $returnVal;
	   	}
	   	else {
	   		return "N/A"; 
	   	}
	   	mysql_free_result($result);
	}
	
	//===================================================
	// This function is designed to get the full name 
	// of a user based on the id passed.
	//
	// USAGE:
	// $userName = getUsersFullName(userID);
	//
	// This will return the user's full name from the DB.
	//===================================================
	function getUsersFullName($userID) {		
		$sql = "SELECT first_name, username FROM `" . USERSDBTABLEPREFIX . "users` WHERE id='" . $userID . "' LIMIT 1";
		$result = mysql_query($sql);
			
		if($result && mysql_num_rows($result) > 0) {
	   		$row = mysql_fetch_array($result);
			$returnVal = (trim($row['first_name']) != "") ? $row['first_name'] : "N/A";
			$returnVal .= (trim($row['last_name']) != "") ? " " . $row['last_name'] : "";
			$returnVal .= (trim($row['username']) != "") ? " (" . $row['username'] . ")" : "";
	   		return $returnVal;
	   	}
	   	else {
	   		return "N/A"; 
	   	}
	   	mysql_free_result($result);
	}
	
	//===================================================
	// This function is designed to get the language 
	// for the current user.
	//
	// USAGE:
	// $language = getUsersLanguageFromID(userid);
	//
	// This will return the user's language from the DB.
	//===================================================
	function getUsersLanguageFromID($currentuser) {	
		global $snts_config;
		
		if (isset($currentuser) && $currentuser != " ") {						
			$sql = "SELECT language FROM `" . USERSDBTABLEPREFIX . "users` WHERE id='" . $currentuser . "' LIMIT 1";
			$result = mysql_query($sql);
			
			if($result && mysql_num_rows($result) > 0) {
	   			$row = mysql_fetch_array($result);
	   			return $row['language'];   			
	   		}
			else { return $snts_config['ftssnts_language']; }
		}
		else { return $snts_config['ftssnts_language']; }
	}
	
	

?>