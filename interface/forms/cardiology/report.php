<?php
include_once ("../../globals.php");
include_once ($GLOBALS ["srcdir"] . "/api.inc");
require_once 'common.php';

/**
 * CHANGE THIS, the name of the function is significant and **
 * * must be changed to match the folder name *
 */
function cardiology_report($pid, $encounter, $cols, $id) {
	global $flds, $fld_groups;
	$rec = R::load ( 'formcardiologyencounter', $id );
	$count = 0;
	// $data = formFetch($table_name, $id);
	$data = $rec;
	$current_group="";
	if ($data) {
		
		print "<table><tr>";
		$cols = 3;
		foreach ( $data as $key => $value ) {
			if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized" || $key == "activity" || $key == "date") {
				// skip certain fields and blank data
				continue;
			}
			$show=($value!="n|" && $value!="");
			
			if (strpos ( $value, "y|" ) === 0) {
				$tmp=htmlspecialchars ( substr ( $value, 2 ) );
				$value = "Ναι";
			} elseif (strpos ( $value, "n|" ) === 0) {
				$tmp=htmlspecialchars ( substr ( $value, 2 ) );
				$value = "όχι";
			} 
			if ($tmp!=""){
				$value="$value, $tmp";
				$tmp="";
			}
			if ($show) {
				$fg=$fld_groups[$key];
				if($fg!=$current_group){
					$current_group=$fg;
					print "<tr><td style=\"text-decoration: underline;\"colspan=10>$fg:</td></tr><tr>";
				}
				$label = $flds [$key];
				$value=str_replace("\n","<br>",$value);
				print "<td style=\"border-left: thin solid  #aaa;vertical-align: text-top;\" ><span class=bold>$label: </span><span class=text>$value</span></td>";
				$count ++;
				if ($count == $cols) {
					$count = 0;
					print "</tr><tr>\n";
				}
			}
		}
	}
	print "</tr></table>";
}

?> 
