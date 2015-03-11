<?php
// echo 'select lbf_data.*,encounter from lbf_data JOIN forms ON lbf_data.form_id=forms.id ORDER BY id ' | mysql -uroot kardiagnosis > /tmp/lbfdata.txt
// echo "SELECT field_id,layout_options.title,list_options.title,group_name FROM layout_options LEFT OUTER JOIN list_options ON layout_options.list_id = list_options.list_id WHERE form_id LIKE 'LBFcardio_visit';" | mysql -uroot kardiagnosis > /tmp/lbf.txt
function field_translate($o) {
	$o = str_replace ( "_", "x", $o );
	$o = str_replace ( "0", "j", $o );
	$o = str_replace ( "1", "a", $o );
	$o = str_replace ( "2", "b", $o );
	$o = str_replace ( "3", "c", $o );
	$o = str_replace ( "4", "d", $o );
	$o = str_replace ( "5", "e", $o );
	$o = str_replace ( "6", "f", $o );
	$o = str_replace ( "7", "g", $o );
	$o = str_replace ( "8", "h", $o );
	$o = str_replace ( "9", "i", $o );
	return $o;
}

function handle_attribute($encouter, $form, $field, $value, $note) {
	if ($value != 'NO' || $note != ''){
		printf ( "enc='%s form='%s' field='%s' value='%s' note='%s'\n", $encouter, $form, $field, $value, $note );
	}
}

require 'library/rb.php';
R::setup ( 'mysql:host=localhost;dbname=kardiagnosis', 'openemr', 'pzma' );

$handle = fopen ( "/tmp/lbf.txt", "r" );
$last_id = "";
$i = 0;
$fiels=array();
$dummy=R::dispense('formcardiologyencounter');
$dummy['george']='';
while ( $line = stream_get_line ( $handle, 4096, "\n" ) ) {

	$line = trim ( $line );
	
	$flds = explode ( "\t", $line );
	
	$field_id = $flds [0];
	$field_name = $flds [1];
	$option_name = $flds [2];
	$group = $flds [3];
	
	if ($field_id != $last_id) {
		$i = 0;
	} else {
		$i = $i + 1;
	}
	$last_id = $field_id;
	$clean_name = field_translate ( $field_id . $i );
	
	printf ( "%s|%s|%s|%d|%s\n", $field_id, $clean_name, $field_name, $i, $option_name );
	$dummy[$clean_name]='';
}

R::store($dummy);
// R::freeze(['formcardiologyencounter','forms']);

$forms = array ();
$newformid=-1;
$last_form=-1;
$handle = fopen ( "/tmp/lbfdata.txt", "r" );
while ( $line = stream_get_line ( $handle, 4096, "\n" ) ) {
	$line = trim ( $line );
// 	echo "*****" . $line . "\n";
	$flds = explode ( "\t", $line );
	$form = $flds [0];
	$field = $flds [1];
	$value = $flds [2];
	$encouter = $flds [3];
	$value = str_replace ( "\r", "", $value );
	$value = str_replace ( '\n', "!@#$", $value );
	$values = explode ( '|', $value );
	$basefield = $field;
	if (preg_match ( '/[0-9]*:[0-9]:/', $value )) {
		foreach ( $values as $opt ) {
			$opts = explode ( ":", $opt );
			// printf (" opt %s %s %s \n",$opts[0],($opts[1]=="0") ? 'No' : "Yes",$opts[2]);
			$field = $basefield . $opts [1];
			$value = $opts [1] == '1' ? 'y' : 'n';
			$note = $opts [2];
			// $field_array[$field.$opts[1]]=
		}
		handle_attribute( $encouter, $form, $field, $value, $note );
		
		if (! isset ( $forms [$form] )) {
			$forms [$form] = array ();
 			echo "new form $form \n";
		}
		$forms [$form]['encounter']=$encouter;
		$forms [$form][field_translate($field)]=$value;
		$forms [$form][field_translate($field.'note')]=$note;

		$cef=R::load('formcardiologyencounter',$newformid);
		$cef[field_translate($field)]=$value;
		$cef[field_translate($field.'note')]=$note;
		$newformid=R::store($cef);
		
		if ($form!=$last_form){
			$old_record=R::findOne('forms',' form_id = ? AND formdir=\'LBFcardio_visit\' ',array($form));
			$new_record=R::dispense('forms');
			$new_record->date=$old_record->date;
			$new_record->pid=$old_record->pid;
			$new_record->encounter=$old_record->encounter; // pid
			$new_record->form_name='Cardiology Encounter';
			$new_record->form_id=$newformid;
			$new_record->user='admin';
			$new_record->groupname='Default';
			$new_record->authorized=1;
			$new_record->deleted=0;
			$new_record->formdir='cardiology';
			$formentryid=R::store($new_record);
			echo "creating new form id ".$formentryid." based on ".$old_record->id;
			echo "\n";
			$last_form=$form;
		}

	}
}

foreach ($forms as $form => $values){
	echo $form.' ';
	foreach ($values as $key => $value){
		echo $key.'='.$value." ";
	}
	echo "\n";
}

// $rec->fldtest="george";
// $newid = R::store ( $rec );
?>