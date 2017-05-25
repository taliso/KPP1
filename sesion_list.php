<?php
session_regenerate_id();
$_SESSION['WAY'] = "CLAIM";  //"CLAIM"-pretenzija, "EVENT"-notikums,"TASK"- uzdevums
$_SESSION['STATUS'] = "LIST"; // 'VIEW','EDIT','LIST'
$_SESSION['TITLE'] = "Pretenziju saraksts";
$_SESSION['DEBUG'] ='';
$_SESSION['FORMA'] = 'pret_list.php';
$_SESSION['FORM_TITLE'] = -1;
$_SESSION['NAVIG'] = -1;
$_SESSION['VERSIJA'] = '';
$_SESSION['MAIL'] = 'N';

$_SESSION['USER']['ID'] = 0;
$_SESSION['USER']['VARDS'] = '';
$_SESSION['USER']['TIESIBAS'] = '';
$_SESSION['USER']['LOMA'] = '';
$_SESSION['USER']['STRUKT'] = '';
$_SESSION['USER']['STATUS']=0;

$_SESSION['REC']['ID']=0;

$_SESSION['REISS']['IEKRAUT']=1;


session_write_close();
