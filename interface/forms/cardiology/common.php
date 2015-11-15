<?php
require '../../../library/rb.php';
R::setup ( "mysql:host=$host;dbname=$dbase", $login, $pass ); 
$flds = array (
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

$fld_groups = array (
		"atrest" => "Reason for Visit - Πόνος στο στήθος",
		"atexcercise" => "Reason for Visit - Πόνος στο στήθος",
		"radiation" => "Reason for Visit - Πόνος στο στήθος",
		"duration" => "Reason for Visit - Πόνος στο στήθος",
		"stops" => "Reason for Visit - Πόνος στο στήθος",
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
		"ecg" => "Examination",
		"ett" => "Examination",
		"holter" => "Examination",
		"echo" => "Examination",
		"stressecho" => "Examination",
		"carotids" => "Examination",
		"examinationother" => "Examination",
		"s1s2normal" => "Auscultation",
		"pulmonicfieldsclear" => "Auscultation",
		"weezes" => "Auscultation",
		"crackles" => "Auscultation",
		"pleuralrub" => "Auscultation",
		"reducedpulmonicsounds" => "Auscultation",
		"systolicmurmur_mv" => "Auscultation",
		"systolicmurmur_aov" => "Auscultation",
		"diastolicmurmur_mv" => "Auscultation",
		"diastolicmurmur_aov" => "Auscultation",
		"murmur_mv" => "Auscultation",
		"murmur_aov" => "Auscultation",
		
		"reghazontesbase" => "Auscultation",
		"reghazontespulm" => "Auscultation",
		"reghazontesbase_mv" => "Auscultation",
		"reghazontespulm_mv" => "Auscultation",
		"reghazontesbase_aov" => "Auscultation",
		"reghazontespulm_aov" => "Auscultation",

		"reghazontesdiahyta" => "Auscultation",
		
		
		"ihostrivis" => "Auscultation",
		
		"trizontesbase" => "Auscultation",
		"trizontespulm" => "Auscultation",
		"trizontesbase_left" => "Auscultation",
		"trizontespulm_left" => "Auscultation",
		"trizontesbase_right" => "Auscultation",
		"trizontespulm_right" => "Auscultation",
		"trizontesbase_both" => "Auscultation",
		"trizontespulm_both" => "Auscultation",
		
		"trizontesdiahyta" => "Auscultation",
		
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
