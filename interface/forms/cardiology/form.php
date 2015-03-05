<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");
require '../../../library/rb.php';

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "formcardiologyencounter";

/** CHANGE THIS name to the name of your form **/
$form_name = "Cardiology Encounter";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "cardiology";

formHeader("Form: ".$form_name);

$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

/* load the saved record */
if (isset ( $_GET["id"] )) {
	$record = formFetch ( $table_name, $_GET["id"] );
}

?>

<html><head>
<?php html_header_show();?>

<!-- supporting javascript code -->
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js"></script>

<!-- page styles -->
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css" type="text/css">

</head>

<body class="body_top">

<?php echo date("F d, Y", time()); ?>

<?php 	
// $rec = R::load ( 'cardiologyencounter', $_GET ["id"] );

?>
<form method=post action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=<?php echo $mode?>" name="my_form">

<input type=hidden name=id value='<?php echo  (isset($rec)) ? $rec->id : '' ;?>'>

<span class="title"><?php xl($form_name, 'e'); ?></span><br>

<!-- Save/Cancel buttons -->
<input type="button" class="save" value="<?php xl('Save','e'); ?>"> &nbsp; 
<input type="button" class="dontsave" value="<?php xl('Don\'t Save','e'); ?>">

<input type="button" class="save" value="<?php xl('Save Changes','e'); ?>"> &nbsp; 
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes','e'); ?>"> &nbsp; 
<input type="button" class="printform" value="<?php xl('Print','e'); ?>"> &nbsp; 

<br>

name: <input type="text" size="50" name='cef_name' value="">

<br>
<!-- Save/Cancel buttons -->
<input type="button" class="save" value="<?php xl('Save','e'); ?>"> &nbsp; 
<input type="button" class="dontsave" value="<?php xl('Don\'t Save','e'); ?>"> &nbsp; 
</form>

</body>

<script language="javascript">

// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    $(".save").click(function() { top.restoreSession(); document.my_form.submit(); });
    $(".dontsave").click(function() { location.href='<?php echo "$rootdir/patient_file/encounter/$returnurl";?>'; });
    $(".printform").click(function() { PrintForm(); });
});

</script>

</html>

