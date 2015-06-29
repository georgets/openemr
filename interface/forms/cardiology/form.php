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
<?php function chkbText($label,$id,$lwidth=4,$bwidth=6){
$s = '
  <label class="col-lg-'.$lwidth.' control-label text-right" for="'.$id.'">'.$label.'</label>
  <div class="col-lg-'.$bwidth.'">
    <div class="input-group">
      <span class="input-group-addon">     
          <input type="checkbox">     
      </span>
      <input id="'.$id.'" name="cef_'.$id.'" class="form-control" type="text" placeholder="details">
    </div>
  </div>
';

return $s;
} 

function chkbTextGroup($label,$id,$associativelist,$tlwidth=2,$lwidth=4,$bwidth=6){
	$s = '<div>
<label class="col-lg-'.$tlwidth.' control-label text-right" for="'.$id.'">'.$label.'</label>
<div class="col-lg-'.($lwidth+$bwidth).'">';
	$lwidth=floor($lwidth*12/($lwidth+$bwidth));
	$bwidth=12-$lwidth-1;
	foreach ($associativelist as $lid => $lbl) {
		$s.=chkbText($lbl,$id.'_'.$lid,$lwidth,$bwidth);
	}
$s.="</div></div>";
return $s;
}
?>

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
<br>
<!-- 
name: <input type="text" size="50" name='cef_name' value="<?php echo $rec->name;?>">
name2: <input type="text" size="50" name='cef_nametwo' value="<?php echo $rec->name;?>">

date: <input type="text" name="date" id="date" value="<?php echo $rec->date;?>">
 -->
<form class="form-horizontal">


<div class="container col-lg-12">
    <ul class="nav nav-tabs">
        <li class="nav active"><a href="#A" data-toggle="tab">Reason for Visit</a></li>
        <li class="nav"><a href="#B" data-toggle="tab">Examination</a></li>
        <li class="nav"><a href="#C" data-toggle="tab">Auscultation</a></li>
        <li class="nav"><a href="#E" data-toggle="tab">Diagnosis</a></li>

        </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="A">
			<div class="row">
				<div class="col-lg-6">
					<h4>Πόνος στο στήθος:</h4>
					<div class="row"><?php echo chkbText("Ηρεμία","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Κόπωση","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Αντανάκλαση","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Διάρκεια","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Υποχώρηση","pain",2,10); ?></div><br>
				</div>
				<div class="col-lg-6">
					<h4>Complaints:	</h4>
					<div class="row"><?php echo chkbText("Πόνος στην πλάτη","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Πόνος στο χέρι","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Έυκολη κόπωση","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Δύσπνοια","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Αίσθημα παλμών","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Απώλεια αισθήσεων","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Προλιποθυμικό επεισόδειο","pain",3,9); ?></div><br>
					<div class="row"><?php echo chkbText("Οιδήματα άκρων","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Βήχας","pain",2,10); ?></div><br>
					<div class="row"><?php echo chkbText("Άλλο","pain",2,10); ?></div><br>
				</div>
			</div>
		</div>
        <div class="tab-pane fade" id="B">
			<div class="row">
				<div class="col-lg-6">
					<label class="col-lg-1 control-label" for="'.$id.'">Όψη:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<label class="col-lg-2 control-label" for="'.$id.'">Palpation:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-lg-6">
					<label class="col-lg-1 control-label" for="'.$id.'">ECG:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<label class="col-lg-2 control-label" for="'.$id.'">ECHO:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-lg-6">
					<label class="col-lg-1 control-label" for="'.$id.'">ETT:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<label class="col-lg-2 control-label" for="'.$id.'">Stress Echo:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-lg-6">
					<label class="col-lg-1 control-label" for="'.$id.'">Holter:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<label class="col-lg-2 control-label" for="'.$id.'">Carotids:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-lg-6">
					<label class="col-lg-1 control-label" for="'.$id.'">Other:</label>
					<div class="col-lg-10">
					    <textarea class="form-control" rows="3"></textarea>
					</div>
				</div>
			</div>
        </div>
        <div class="tab-pane fade" id="C">
        <br>
			<div class="row">
				<div class="col-lg-6">
					<div class="row"><?php echo chkbText("S1 S2 κφ","pain"); ?></div>
					<div class="row"><?php echo chkbText("Καθαρά Πν. Πεδία:","pain"); ?></div>
					<div class="row"><?php echo chkbText("Εκπνευστικός Συρριγμός:","pain"); ?></div>
					<div class="row"><?php echo chkbText("Εισπνευστικός Συρριγμός:","pain"); ?></div>
					<div class="row"><?php echo chkbText("Παράταση Εκπνοής:","pain"); ?></div>
					<div class="row"><?php echo chkbText("Μειωμένο ψυθίρισμα:","pain"); ?></div>
				</div>
				<div class="col-lg-6">

						<div class="row"><?php $mvaov = array( "mv" => "MV: ", "aov" => "AoV: ",); 
					      echo chkbTextGroup("Συστολικό φύσημα:","pain",$mvaov,2,2,8); ?></div>
						<br>
						<div class="row"><?php echo chkbTextGroup("Διαστολικό φύσημα:","pain",$mvaov,2,2,8); ?></div>
						<br>
						<div class="row"><?php echo chkbTextGroup("Ολοσυστολικό φύσημα:","pain",$mvaov,2,2,8); ?></div>
		
				</div>

			</div>
			<br>
			<div class="row">
				<div class="col-lg-6">
					<div class="row"><?php echo chkbTextGroup("Ρεγχάζοντες - Βάσεων:","pain",$mvaov,3,2,7); ?></div>
					<br>
					<div class="row"><?php echo chkbTextGroup("Ρεγχάζοντες - Μέσα Πν. Πεδία:","pain",$mvaov,3,2,7); ?></div>
					<br>
					<div class="row"><?php echo chkbText("Ρεγχάζοντες - Διάχυτα:","pain",4,7); ?></div>			
				</div>
				<div class="col-lg-6">
					<div class="row"><?php echo chkbText("Ήχος τριβής:","pain",3,8); ?></div>
					<br>							
					<div class="row"><?php $lrb = array( "both" => "Άμφω", "left" => "Αριστερά", "right" => "Δεξιά"); 
				      echo chkbTextGroup("Τρίζοντες - Βάσεων:","pain",$lrb,2,2,8); ?></div>
					<br>
					<div class="row"><?php echo chkbTextGroup("Τρίζοντες - Μέσα Πν. Πεδία:","pain",$lrb,2,2,8); ?></div>
					<br>
					<div class="row"><?php echo chkbText("Ρεγχάζοντες - Διάχυτα:","pain",3,8); ?></div>							
				</div>

			</div>
        </div>

        <div class="tab-pane fade" id="E">
			<div class="row">
				<label class="col-lg-1 control-label" for="'.$id.'">Diagnosis:</label>
				<div class="col-lg-6">
				    <textarea class="form-control" rows="3"></textarea>
				</div>
			</div><br>
			<div class="row">
				<label class="col-lg-1 control-label" for="'.$id.'">Changes:</label>
				<div class="col-lg-6">
				    <textarea class="form-control" rows="3"></textarea>
				</div>
			</div><br>
			<div class="row">
				<label class="col-lg-1 control-label" for="'.$id.'">Plan:</label>
				<div class="col-lg-6">
				    <textarea class="form-control" rows="3"></textarea>
				</div>
			</div><br>
			<div class="row">
				<label class="col-lg-1 control-label" for="'.$id.'">P:</label>
				<div class="col-lg-6">
				    <textarea class="form-control" rows="3"></textarea>
				</div>
			</div>
        </div>

                
    </div>
</div>



</form>

<br>
<br>
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

