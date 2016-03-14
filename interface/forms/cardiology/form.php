<?php
include_once ("../../globals.php");
include_once ("$srcdir/api.inc");
require_once 'common.php';
global $rec;

/**
 * CHANGE THIS - name of the database table associated with this form *
 */
$table_name = "formcardiologyencounter";

$rec = R::load ( $table_name, $_GET ["id"] );

/**
 * CHANGE THIS name to the name of your form *
 */
$form_name = "Cardiology Encounter";

/**
 * CHANGE THIS to match the folder you created for this form *
 */
$form_folder = "cardiology";

formHeader ( "Form: " . $form_name );

$returnurl = $GLOBALS ['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

?>

<html>
<head>
<?php html_header_show();?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
<script src="../../forms/cardiology/cardiology.js"></script>

</head>

<body class="body_top">
<?php
function chkbText($label, $id, $lwidth = 3, $bwidth = 9) {
	global $flds, $rec, $lrb, $mvaov;
	if ($label == '=') {
		$label = $flds [$id];
	}
	$val = $rec [$id];
	if (strpos ( $val, "y|" ) === 0) {
		$checked = "checked";
	} else {
		$checked = "";
	}
	$detail = htmlspecialchars ( substr ( $val, 2 ) );
	$s = '
  <label style="padding-left: 5px; padding-right: 5px" class="col-lg-' . $lwidth . ' control-label text-right" for="' . $id . '">' . $label . '</label>
  <div class="col-lg-' . $bwidth . '" style="padding-left: 5px; padding-right: 5px">
    <div class="input-group">
      <span class="input-group-addon">     
          <input type="checkbox" name="chk_' . $id . '" ' . $checked . '>     
      </span>
      <input id="chkdetail_' . $id . '" name="chkdetail_' . $id . '" class="form-control" type="text" value="' . $detail . '">
    </div>
  </div>
';
	
	return $s;
}
function chkbTextGroup($label, $id, $associativelist, $tlwidth = 2, $lwidth = 4, $bwidth = 6) {
	global $flds, $rec;
	if ($label == '=') {
		$label = $flds [$id];
	}
	
	$s = '<div>
<label class="col-lg-' . $tlwidth . ' control-label text-right" for="' . $id . '">' . $label . '</label>
<div class="col-lg-' . ($lwidth + $bwidth) . '">';
	$lwidth = floor ( $lwidth * 12 / ($lwidth + $bwidth) );
	$bwidth = 12 - $lwidth - 1;
	foreach ( $associativelist as $lid => $lbl ) {
		$s .= chkbText ( $lbl, $id . '_' . $lid, $lwidth, $bwidth );
	}
	$s .= "</div></div>";
	return $s;
}
function textArea($label, $id, $rows = 3, $lwidth = 4, $bwidth = 6) {
	global $flds, $rec;
	if ($label == '=') {
		$label = $flds [$id];
	}
	$val = $rec [$id];
	$s = '<label class="col-lg-' . $lwidth . ' control-label" for="' . $id . '">' . $label . ':</label>
	<div class="col-lg-' . $bwidth . '">
	<textarea class="form-control" rows="' . $rows . '" id="' . $id . '" name="' . $id . '">' . $val . '</textarea>
	</div>';
	
	return $s;
}
?>


<form method=post
		action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=<?php echo $mode?>"
		name="my_form">

		<input type=hidden name=id
			value='<?php echo  (isset($rec)) ? $rec->id : '' ;?>'> <span
			class="title"><?php xl($form_name, 'e'); ?></span>&nbsp;

		<!-- Save/Cancel buttons -->
		<input type="button" class="save" value="<?php xl('Save','e'); ?>">
		&nbsp; <input type="button" class="dontsave"
			value="<?php xl('Don\'t Save','e'); ?>"> <br>

		<div class="container col-lg-12">
			<ul class="nav nav-tabs">
				<li class="nav active"><a href="#A" data-toggle="tab">Reason for
						Visit</a></li>
				<li class="nav"><a href="#B" data-toggle="tab">Examination</a></li>
				<li class="nav"><a href="#C" data-toggle="tab">Workup</a></li>
				<li class="nav"><a href="#E" data-toggle="tab">Diagnosis</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane fade in active" id="A">
					<br>
					<div class="row">
						<div class="col-lg-4">
							<h4>Chest Pain:</h4>
							<div class="row"><?php echo chkbText("=","atrest"); ?></div>
							<div class="row"><?php echo chkbText("=","atexcercise"); ?></div>
							<div class="row"><?php echo chkbText("=","reflection"); ?></div>
							<div class="row"><?php echo chkbText("=","duration"); ?></div>
							<div class="row"><?php echo chkbText("=","releaved"); ?></div>
							<h4>Follow up for:</h4>
							<div class="row"><?php echo chkbText("=","followupcad"); ?></div>
							<div class="row"><?php echo chkbText("=","followuphf"); ?></div>
							<div class="row"><?php echo chkbText("=","followuparrhythmias"); ?></div>
							<div class="row"><?php echo chkbText("=","followupother"); ?></div>
							<h4>Other:</h4>
							<div class="row"><?php echo chkbText("=","asymptomaticcheckup",4,8); ?></div>
							<div class="row"><?php echo chkbText("=","healthcertificate"); ?></div>
							<div class="row"><?php echo chkbText("=","preoperativecheck"); ?></div>
						</div>
						<div class="col-lg-6">
							<h4>Complaints:</h4>
							<div class="row"><?php echo chkbText("=","backpain"); ?></div>
							<div class="row"><?php echo chkbText("=","armpain"); ?></div>
							<div class="row"><?php echo chkbText("=","easyfatigue"); ?></div>
							<div class="row"><?php echo chkbText("=","dyspnea"); ?></div>
							<div class="row"><?php echo chkbText("=","palpitations"); ?></div>
							<div class="row"><?php echo chkbText("=","syncope"); ?></div>
							<div class="row"><?php echo chkbText("=","presyncoptic"); ?></div>
							<div class="row"><?php echo chkbText("=","oedema"); ?></div>
							<div class="row"><?php echo chkbText("=","cough"); ?></div>
							<div class="row"><?php echo chkbText("=","othercomplaint"); ?></div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="B">
					<br>
					<div class="row">
						<div class="col-lg-6">
							<div class="row"><?php echo textArea("=","look",4,3,9); ?></div>
							<hr>

							<h4>Auscultation:</h4>
							<div class="row"><?php echo chkbText("S1 S2 Normal","s1s2normal"); ?></div>
							<hr />
							<div class="row"><?php echo chkbTextGroup ( "=", "systolicmurmur", $mvaov, 1, 2, 9 );?></div>
							<hr />
							<div class="row"><?php echo chkbTextGroup("=","diastolicmurmur",$mvaov,1,2,9); ?></div>
							<hr />
							<div class="row"><?php echo chkbTextGroup("=","holosystolicmurmur",$mvaov,1,2,9); ?></div>
							<hr />

							<div class="row"><?php echo chkbText("=","frictionrub"); ?></div>
							<div class="row"><?php echo chkbText("=","pulmonicfieldsclear"); ?></div>
							<div class="row"><?php echo chkbText("=","weezes"); ?></div>
							<div class="row"><?php echo chkbText("=","crackles"); ?></div>
							<div class="row"><?php echo chkbText("=","reducedpulmonicsounds"); ?></div>
							<hr />
							<h4>Palpation</h4>
							<div class="row"><?php echo textArea("=","palpation",4,3,9); ?></div>
							<br />
						</div>
					</div>

				</div>
				<div class="tab-pane fade" id="C">

					<div class="row">
						<div class="col-lg-6"><?php echo textArea("=","ecg",3); ?></div>
						<div class="col-lg-6"><?php echo textArea("=","echo",3); ?></div>
					</div>
					<div class="row">
						<div class="col-lg-6"><?php echo textArea("=","stresstreadmill",3); ?></div>
						<div class="col-lg-6"><?php echo textArea("=","stressecho",3); ?></div>

					</div>
					<div class="row">
						<div class="col-lg-6"><?php echo textArea("=","carotids",3); ?></div>
						<div class="col-lg-6"><?php echo textArea("=","holter",3); ?></div>

					</div>
					<div class="row">
						<div class="col-lg-6"><?php echo textArea("=","bpmonitor",3); ?></div>
					</div>
					<div class="row">
						<div class="col-lg-12"><?php echo textArea("=","workupother",9); ?></div>
					</div>
				</div>

				<div class="tab-pane fade" id="E">
					<div class="row">
						<div class="col-lg-6"><?php echo textArea("=","diagnosis",3); ?></div>
					</div>
					<div class="row">
						<div class="col-lg-6"><?php echo textArea("=","changes",3); ?></div>
					</div>
					<div class="row">
						<div class="col-lg-6"><?php echo textArea("=","plan",3); ?></div>
					</div>
					<div class="row">
						<div class="col-lg-6"><?php echo textArea("=","p",3); ?></div>
					</div>
				</div>


			</div>
		</div>

		<!-- Save/Cancel buttons -->
		<input type="button" class="save" value="<?php xl('Save','e'); ?>">
		&nbsp; <input type="button" class="dontsave"
			value="<?php xl('Don\'t Save','e'); ?>"> &nbsp;

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

