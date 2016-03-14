<script
	src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
<script src="../../forms/cardiology/cardiology.js"></script>


<?php
include_once ("../../globals.php");
include_once ($GLOBALS ["srcdir"] . "/api.inc");
include_once ($GLOBALS ["srcdir"] . "/patient.inc");
require_once 'common.php';

/**
 * the name of the function is significant and **
 * * must be changed to match the folder name *
 */
function cardiology_report($pid, $encounter, $cols, $id) {
	global $flds, $fld_groups;
	$patient = getPatientData ( $pid, "fname,lname,pid,pubpid,phone_home,pharmacy_id,DOB,DATE_FORMAT(DOB,'%d/%m/%Y') as DOB_DMY" );
	
	$info = 'Patient: '.$patient ['lname'].', '.$patient ['fname'].' (' . $patient ['pubpid'].")";
	if ($patient ['DOB'])
		$info .= ', DOB: ' . $patient ['DOB_DMY'] ;
	if ($patient ['phone_home'])
		$info .= ', Home: ' . $patient ['phone_home'];
	
	$rec = R::load ( 'formcardiologyencounter', $id );
	$count = 0;
	// $data = formFetch($table_name, $id);
	$data = $rec;
	$current_group = "";
	$group_content = array ();
	
	if ($data) {
		$cols = 3;
		foreach ( $data as $key => $value ) {
			if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized" || $key == "activity" || $key == "date") {
				// skip certain fields and blank data
				continue;
			}
			
			$show = ($value != "n|" && $value != "");
			
			if (strpos ( $value, "y|" ) === 0) {
				$tmp = htmlspecialchars ( substr ( $value, 2 ) );
				$value = "Yes";
			} elseif (strpos ( $value, "n|" ) === 0) {
				$tmp = htmlspecialchars ( substr ( $value, 2 ) );
				$value = "No";
			}
			if ($tmp != "") {
				$value = "$value, $tmp";
				$tmp = "";
			}
			$fg = $fld_groups [$key];
			// $group_content[$fg] .= $fg;
			if ($show) {
				$label = $flds [$key];
				$value = str_replace ( "\n", "<br>", $value );
				$item = "<td style=\"border-left: thin solid  #aaa;vertical-align: text-top;\" ><span class=bold>$label: </span><span class=text>$value</span></td>";
				$group_content [$fg] .= $item;
				if (substr_count ( $group_content [$fg], "<td" ) % $cols == 0) {
					$group_content [$fg] .= "</tr><tr>\n";
				}
			}
		}
	}
	// print '<script src="../../forms/cardiology/cardiology.js"></script>';
	print '<a href="#" class="btn btn-primary download-pdf" id="print_link" >print</a>';
	print "<div id=\"content\">";
	print "<style>
	@page {
		size: A4;
		margin: 1cm;
	}
	</style>";
	print $info."<br><hr><table><tr>";
	foreach ( $group_content as $groupname => $content ) {
		print "<tr><td style=\"text-decoration: underline;\"colspan=10>$groupname:</td></tr><tr>" . $content;
	}
	print "</tr></table></div>";
	
}

?> 
