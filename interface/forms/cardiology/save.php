<?php
include_once ("../../globals.php");
include_once ("$srcdir/api.inc");
include_once ("$srcdir/forms.inc");
require_once 'common.php';

/**
 * CHANGE THIS - name of the database table associated with this form *
 */
$table_name = "formcardiologyencounter";

/**
 * CHANGE THIS name to the name of your form *
 */
$form_name = "Cardiology Encounter";

/**
 * CHANGE THIS to match the folder you created for this form *
 */
$form_folder = "cardiology";
function update_model_data_from_post($rec) {
	$rec->pid = $_SESSION ['pid'];
	$rec->date = isset ( $_POST ['date'] ) ? $_POST ['date'] : R::isoDate ();
	$rec->user = '';
	$rec->groupname = '';
	$rec->authorized = '';
	$rec->activity = '1';
	foreach ( $_POST as $field => $val ) {
		if (! is_array ( $val )) {
			$p = strrpos ( $field, "chkdetail_" );
			if ($p === 0) {
				$fieldname = substr ( $field, 10 );
				if (isset ( $_POST ["chk_" . $fieldname] )) {
					$b = $_POST ["chk_" . $fieldname];
					if ($b == 'on') {
						$val = "y|$val";
					}
				} else {
					$val = "n|$val";
				}
				$rec [$fieldname] = $val;
			} elseif (! (strrpos ( $field, "chk_" ) === 0)) {
				$rec [$field] = $val;
			}
		}
	}
}

if ($encounter == "")
	$encounter = date ( "Ymd" );

if ($_REQUEST ["mode"] == "new") {
	
	/*
	 * NOTE - for customization you can replace $_POST with your own array
	 * of key=>value pairs where 'key' is the table field name and
	 * 'value' is whatever it should be set to
	 * ex) $newrecord['parent_sig'] = $_POST['sig'];
	 * $newid = formSubmit($table_name, $newrecord, $_GET["id"], $userauthorized);
	 */
	$rec = R::dispense ( $table_name );
	update_model_data_from_post ( $rec );
	$newid = R::store ( $rec );
	
	/* save the data into the form's own table */
	// $newid = formSubmit($table_name, $_POST, $_GET["id"], $userauthorized);
	
	/* link the form to the encounter in the 'forms' table */
	addForm ( $encounter, $form_name, $newid, $form_folder, $pid, $userauthorized );
} elseif ($_REQUEST ["mode"] == "update") {
	/* update existing record */
	// $success = formUpdate($table_name, $_POST, $_GET["id"], $userauthorized);
	$rec = R::load ( $table_name, $_REQUEST ["id"] );
	update_model_data_from_post ( $rec );
	$result = R::store ( $rec );
}

$_SESSION ["encounter"] = $encounter;
formHeader ( "Redirecting...." );
formJump ();
formFooter ();
?>
