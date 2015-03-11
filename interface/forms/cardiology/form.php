<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");


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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  
</head>

<body class="body_top">

<?php echo date("F d, Y", time()); ?>

<?php
require '../../../library/rb.php';
R::setup('mysql:host=192.168.10.14;dbname=kardiagnosis', 'openemr','pzma'); //mysql
$rec = R::load ( 'formcardiologyencounter', $_GET ["id"] );
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
name: <input type="text" size="50" name='cef_name' value="<?php echo $rec->name;?>">
name2: <input type="text" size="50" name='cef_nametwo' value="<?php echo $rec->name;?>">

date: <input type="text" name="date" id="date" value="<?php echo $rec->date;?>">
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

<!-- Prepended checkbox -->
<div class="form-group">
  <label class="col-md-2 control-label" for="pain">pain</label>
  <div class="col-md-2">
    <div class="input-group">
      <span class="input-group-addon">     
          <input type="checkbox">     
      </span>
      <input id="pain" name="cef_pain" class="form-control" type="text" placeholder="details">
    </div>
  </div>
</div>

<!-- Prepended checkbox -->
<div class="form-group">
  <label class="col-md-2 control-label" for="pain">pain</label>
  <div class="col-md-2">
    <div class="input-group">
      <span class="input-group-addon">     
          <input type="checkbox">     
      </span>
      <input id="pain" name="cef_pain" class="form-control" type="text" placeholder="details">
    </div>
  </div>
</div>

</fieldset>
</form>

<br>
<!-- Save/Cancel buttons -->
<input type="button" class="save" value="<?php xl('Save','e'); ?>"> &nbsp; 
<input type="button" class="dontsave" value="<?php xl('Don\'t Save','e'); ?>"> &nbsp; 
</form>

</body>

<script language="javascript">

// jQuery stuff to make the page a little easier to use
$( "#date" ).datepicker( "option", "dateFormat", "yy/mm/dd");
$(document).ready(function(){
    $(".save").click(function() { top.restoreSession(); document.my_form.submit(); });
    $(".dontsave").click(function() { location.href='<?php echo "$rootdir/patient_file/encounter/$returnurl";?>'; });
    $(".printform").click(function() { PrintForm(); });
});

</script>

</html>

