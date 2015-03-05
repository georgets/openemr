<?php
include_once ("../../globals.php");
include_once ("$srcdir/api.inc");
include_once ("$srcdir/forms.inc");
require '../../../library/rb.php';
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

R::setup('mysql:host=192.168.10.14;dbname=kardiagnosis', 'openemr','pzma'); //mysql

function update_model_data_from_post($rec) {
	foreach ( $_POST as $field => $val ) {
		if ( ! is_array ( $val )) {
			if (strrpos($field,"cef_")==0){
				$fieldname=substr($field, 4);
				$rec[$fieldname]=$val;
			}
		} 
	}
}

if ($encounter == "")
	$encounter = date ( "Ymd" );

if ($_GET ["mode"] == "new") {
	
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
} elseif ($_GET ["mode"] == "update") {
	/* update existing record */
	// $success = formUpdate($table_name, $_POST, $_GET["id"], $userauthorized);
	$rec = R::load ( $table_name, $_GET ["id"] );
// 	update_model_data_from_post ( $rec );
	$rec->name="george";
	R::store ( $rec );
}

$_SESSION ["encounter"] = $encounter;
formHeader ( "Redirecting...." );
formJump ();
formFooter ();
?>
