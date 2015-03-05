<?php
require 'library/rb.php';
R::setup('mysql:host=192.168.10.14;dbname=kardiagnosis', 'openemr','pzma'); 
$rec = R::dispense ( 'test' );
// update_model_data_from_post ( $rec );
$rec->fldtest="george";
$newid = R::store ( $rec );
?>