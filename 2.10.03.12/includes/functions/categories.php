<?php 
/***************************************************************************
 *                               categories.php
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
	// This function is designed to print the problem 
	// categories table.
	//
	// USAGE:
	// $content = returnTicketEntries($ticketID);
	//
	// This will return the ticket entries table.
	//===================================================
	function returnCatsTable() {		
		global $snts_config, $menuvar;
		global $T_CATEGORIES, $T_CATEGORY_NAME, $T_SERIAL_CATEGORY, $T_EDIT_CAT, $T_DELETE_CAT;
		
				
		$sql = "SELECT * FROM `" . DBTABLEPREFIX . "categories` ORDER BY name ASC";
		$result = mysql_query($sql);
			
		$x = 1; //reset the variable we use for our row colors			
		$content .= "\n<table class=\"contentBox\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">
						<tr>
							<td class=\"title1\" colspan=\"3\">
								<div style=\"float: right;\">
									<form name=\"newCatForm\" action=\"" . $PHP_SELF . "\" method=\"post\" onSubmit=\"ValidateForm(this); return false;\">
										<input type=\"text\" name=\"newcatname\" />
										<input type=\"image\" src=\"themes/" .  $snts_config['ftssnts_theme'] . "/icons/add.png\" />
									</form>
								</div>
								" . $T_CATEGORIES . "
							</td>
						</tr>
						<tr>
							<td class=\"title2\"><strong>" . $T_CATEGORY_NAME . "</strong></td><td class=\"title2\">&nbsp;</td>
						</tr>";
								
		while ($row = mysql_fetch_array($result)) {
			$content .= "\n	<tr id=\"" . $row['id'] . "_row\">
								<td width=\"80%\" class=\"row" . $x . "\"><span id=\"" . $row['id'] . "_text\">" . $row['name'] . "</span></td>
								<td width=\"20%\" class=\"row" . $x . "\">
									<center><a style=\"cursor: pointer; cursor: hand;\" onclick=\"ajaxDeleteNotifier('" . $row['id'] . "CatSpinner', 'ajax.php?action=deleteitem&table=categories&id=" . $row['id'] . "', '" . $T_SERIAL_CATEGORY . "', '" . $row['id'] . "_row');\"><img src=\"themes/" .  $snts_config['ftssnts_theme'] . "/icons/delete.png\" alt=\"" . $T_DELETE_CAT . "\" /></a><span id=\"" . $row['id'] . "CatSpinner\" style=\"display: none;\"><img src=\"themes/" .  $snts_config['ftssnts_theme'] . "/icons/indicator.gif\" alt=\"spinner\" /></span></center>
								</td>
							</tr>";
			$catids[$row['id']] = $row['name'];		
			$x = ($x==2) ? 1 : 2;
		}
		mysql_free_result($result);
			
		$content .= "\n</table>
							<script type=\"text/javascript\">";
		
		$x = 1; //reset the variable we use for our highlight colors
		foreach($catids as $key => $value) {
			$content .= ($x == 1) ? "\n							new Ajax.InPlaceEditor('" . $key . "_text', 'ajax.php?action=updateitem&table=categories&item=name&id=" . $key . "', {rows:1,cols:50,highlightcolor:'#CBD5DC',highlightendcolor:'#5194B6',loadTextURL:'ajax.php?action=getitem&table=categories&item=name&id=" . $key . "'});" : "\n							new Ajax.InPlaceEditor('" . $key . "_text', 'ajax.php?action=updateitem&table=categories&item=name&id=" . $key . "', {rows:1,cols:50,highlightcolor:'#5194B6',highlightendcolor:'#CBD5DC',loadTextURL:'ajax.php?action=getitem&table=categories&item=name&id=" . $key . "'});";
			$x = ($x==2) ? 1 : 2;
		}
		
		$content .= "\n						
			
								function ValidateForm(theForm){
									var name=document.newCatForm.newcatname
				
									if ((name.value==null)||(name.value==\"\")){
										alert(\"Please enter the new categories name.\")
										name.focus()
										return false
									}
									new Ajax.Updater('updateMe', 'ajax.php?action=showIndicator', {asynchronous:true, evalScripts:true});
									new Ajax.Updater('updateMe', 'ajax.php?action=postCat', {asynchronous:true, parameters:Form.serialize(theForm), evalScripts:true});	
									return false;
								 }
							</script>";
						
		// Return our table
		return $content;
	}
	
	//===================================================
	// This function is designed to get the name 
	// of a category based on the id passed.
	//
	// USAGE:
	// $catName = getCatName(catID);
	//
	// This will return the cat's name from the DB.
	//===================================================
	function getCatName($catID) {		
		$sql = "SELECT name FROM `" . DBTABLEPREFIX . "categories` WHERE id='" . $catID . "' LIMIT 1";
		$result = mysql_query($sql);
			
		if($result && mysql_num_rows($result) > 0) {
	   		$row = mysql_fetch_array($result);
	   		return $row['name'];
	   	}
	   	else {
	   		return "N/A"; 
	   	}
	   	mysql_free_result($result);
	}

?>