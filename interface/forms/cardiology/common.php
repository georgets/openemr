<?php
require '../../../library/rb.php';
R::setup ( "mysql:host=$host;dbname=$dbase", $login, $pass ); 
$flds_gr = array (
		"atrest" => "Ηρεμία",
		"atexcercise" => "Κόπωση",
		"radiation" => "Αντανάκλαση",
		"duration" => "Διάρκεια",
		"stops" => "Υποχώρηση",
		"asymptomaticcheckup" => "Asymptomatic for checkup",
		"healthcertificate" => "Health certificate",
		"followupcad" => "CAD",
		"followuphf" => "HF",
		"followuparrhythmias" => "Arrhythmias",
		"followupother" => "Other",
		"backpain" => "Πόνος στην πλάτη",
		"armpain" => "Πόνος στο χέρι",
		"easyfatigue" => "Έυκολη κόπωση",
		"dyspnea" => "Δύσπνοια",
		"palpitations" => "Αίσθημα παλμών",
		"syncope" => "Απώλεια αισθήσεων",
		"presyncoptic" => "Προλιποθυμικό επεισόδειο",
		"oedema" => "Οιδήματα άκρων",
		"cough" => "Βήχας",
		"othercomplaint" => "Άλλο",
		"look" => "Όψη",
		"palpation" => "Palpation",
		"ecg" => "ECG",
		"ett" => "ETT",
		"holter" => "Holter",
		"echo" => "ECHO",
		"stressecho" => "Stress Echo",
		"carotids" => "Carotids",
		"examinationother" => "Other",
		"s1s2normal" => "S1 S2 κφ",
		"pulmonicfieldsclear" => "Καθαρά Πν. Πεδία",
		"weezes" => "Εκπνευστικός Συρριγμός",
		"crackles" => "Εισπνευστικός Συρριγμός",
		"pleuralrub" => "Παράταση Εκπνοής",
		"reducedpulmonicsounds" => "Μειωμένο ψυθίρισμα",
		
		"systolicmurmur" => "Συστολικό φύσημα",
		"diastolicmurmur" => "Διαστολικό φύσημα",
		"murmur" => "Ολοσυστολικό φύσημα",
		"systolicmurmur_mv" => "Συστολικό φύσημα MV",
		"diastolicmurmur_mv" => "Διαστολικό φύσημα MV",
		"murmur_mv" => "Ολοσυστολικό φύσημα MV",
		"systolicmurmur_aov" => "Συστολικό φύσημα AOV",
		"diastolicmurmur_aov" => "Διαστολικό φύσημα AOV",
		"murmur_aov" => "Ολοσυστολικό φύσημα AOV",
		
		"reghazontesbase" => "Ρεγχάζοντες - Βάσεων",
		"reghazontespulm" => "Ρεγχάζοντες - Μέσα Πν. Πεδία",
		"reghazontesbase_mv" => "Ρεγχάζοντες - Βάσεων - MV",
		"reghazontespulm_mv" => "Ρεγχάζοντες - Μέσα Πν. Πεδία - mv",
		"reghazontesbase_aov" => "Ρεγχάζοντες - Βάσεων - AOV",
		"reghazontespulm_aov" => "Ρεγχάζοντες - Μέσα Πν. Πεδία - AOV",

		"reghazontesdiahyta" => "Ρεγχάζοντες - Διάχυτα",
		
		"trizontesbase" => "Τρίζοντες - Βάσεων",
		"trizontespulm" => "Τρίζοντες - Μέσα Πν. Πεδία",
		
		"trizontesbase_left" => "Τρίζοντες - Βάσεων - Αριστερά",
		"trizontespulm_left" => "Τρίζοντες - Μέσα Πν. Πεδία - Αριστερά",
		
		"trizontesbase_right" => "Τρίζοντες - Βάσεων - Δεξιά",
		"trizontespulm_right" => "Τρίζοντες - Μέσα Πν. Πεδία - Δεξιά",
		
		"trizontesbase_both" => "Τρίζοντες - Βάσεων - Άμφω",
		"trizontespulm_both" => "Τρίζοντες - Μέσα Πν. Πεδία - Άμφω",
		
		"trizontesdiahyta" => "Ρεγχάζοντες - Διάχυτα",
		
		"ihostrivis" => "Ήχος τριβής",
		"diagnosis" => "Diagnosis",
		"changes" => "Changes",
		"plan" => "Plan",
		"p" => "P" 
);
$flds_en = array (
		"atrest" => "At Rest",
		"atexcercise" => "At Excercise",
		"reflection" => "Reflection",
		"duration" => "Duration",
		"releaved" => "Releaved",
		"asymptomaticcheckup" => "Asymptomatic for checkup",
		"healthcertificate" => "Health certificate",
		"followupcad" => "CAD",
		"followuphf" => "HF",
		"followuparrhythmias" => "Arrhythmias",
		"followupother" => "Other",
		"backpain" => "Back pain",
		"armpain" => "Arm pain",
		"easyfatigue" => "Easy Fatique",
		"dyspnea" => "Dyspnea",
		"palpitations" => "Palpitations",
		"syncope" => "Syncope",
		"presyncoptic" => "Presyncoptic",
		"oedema" => "Oedema",
		"cough" => "Cough",
		"othercomplaint" => "Other",
		"look" => "Observation",
		"palpation" => "Palpation",
		"ecg" => "ECG",
		"ett" => "ETT",
		"holter" => "Holter",
		"bpmonitor" => "BP Monitor",
		"echo" => "ECHO",
		"stressecho" => "Stress Echo",
		"stresstreadmill" => "Stress Test Treadmill",
		"carotids" => "Carotids",
		"examinationother" => "Other",
		"workupother" => "Other",
		"s1s2normal" => "S1 S2 Normal",
		"pulmonicfieldsclear" => "Clear Pulmonic fields",
		"weezes" => "Weezing",
		"crackles" => "Crackles",
		"frictionrub" => "Friction Rub",
		"reducedpulmonicsounds" => "Reduced Pulmonic Sounds",

		"systolicmurmur" => "Systolic Murmur",
		"systolicmurmur_mv" => "Systolic MurmurMV",
		"systolicmurmur_aov" => "Systolic Murmur AOV",
		
		"diastolicmurmur" => "Diastolic Murmur",
		"diastolicmurmur_mv" => "Diastolic Murmur MV",
		"diastolicmurmur_aov" => "Diastolic Murmur AOV",
		
		"holosystolicmurmur" => "Holosystolic Murmur",
		"holosystolicmurmur_mv" => "Holosystolic Murmur MV",
		"holosystolicmurmur_aov" => "Holosystolic Murmur AOV",
		
		"diagnosis" => "Diagnosis",
		"changes" => "Changes",
		"plan" => "Plan",
		"p" => "P"
);

$flds = $flds_en;

$fld_groups = array (
		"atrest" => "Reason for Visit - Chest Pain",
		"atexcercise" => "Reason for Visit - Chest Pain",
		"reflection" => "Reason for Visit - Chest Pain",
		"duration" => "Reason for Visit - Chest Pain",
		"releaved" => "Reason for Visit - Chest Pain",
		
		"asymptomaticcheckup" => "Reason for Visit - Other",
		"healthcertificate" => "Reason for Visit - Other",
		
		"followupcad" => "Reason for Visit - Follow-up",
		"followuphf" => "Reason for Visit - Follow-up",
		"followuparrhythmias" => "Reason for Visit - Follow-up",
		"followupother" => "Reason for Visit - Follow-up",
		
		"backpain" => "Reason for Visit - Complaints",
		"armpain" => "Reason for Visit - Complaints",
		"easyfatigue" => "Reason for Visit - Complaints",
		"dyspnea" => "Reason for Visit - Complaints",
		"palpitations" => "Reason for Visit - Complaints",
		"syncope" => "Reason for Visit - Complaints",
		"presyncoptic" => "Reason for Visit - Complaints",
		"oedema" => "Reason for Visit - Complaints",
		"cough" => "Reason for Visit - Complaints",
		"othercomplaint" => "Reason for Visit - Complaints",
		
		"look" => "Examination",
		"palpation" => "Examination",
		"s1s2normal" => "Examination",
		"pulmonicfieldsclear" => "Examination",
		"weezes" => "Examination",
		"crackles" => "Examination",
		"frictionrub" => "Examination",
		"reducedpulmonicsounds" => "Examination",
		"systolicmurmur_mv" => "Examination",
		"systolicmurmur_aov" => "Examination",
		"diastolicmurmur_mv" => "Examination",
		"diastolicmurmur_aov" => "Examination",
		"holosystolicmurmur_mv" => "Examination",
		"holosystolicmurmur_aov" => "Examination",
		
		"ecg" => "Workup",
		"ett" => "Workup",
		"holter" => "Workup",
		"echo" => "Workup",
		"stressecho" => "Workup",
		"stresstreadmill" => "Workup",
		"bpmonitor" => "Workup",
		"workupother" => "Workup",
		"carotids" => "Workup",
		"examinationother" => "Workup",
		
		"diagnosis" => "Diagnosis -Changes - Plan",
		"changes" => "Diagnosis -Changes - Plan",
		"plan" => "Diagnosis -Changes - Plan",
		"p" => "Diagnosis -Changes - Plan" 
);

$lrb = array (
		"both" => "Άμφω",
		"left" => "Αριστερά",
		"right" => "Δεξιά" 
);

$mvaov = array (
		"mv" => "MV: ",
		"aov" => "AoV: " 
);
?>
