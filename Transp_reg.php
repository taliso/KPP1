<?php
/**
 * Created by PhpStorm.
 * User: talivaldis.olekss
 * Date: 27.06.2017
 * Time: 22:56
 */
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include "config.php";
include "funkcijas.php";
include "konekcija.php";
//include "\\phpmailer\\mailset.php";
//include "sesion_list.php";



$saraksts=sqltoarray(' * ','transports'," status>-1 and status<10 ",$db);

if (isset($_POST['sub_iekr_izkr']) or isset($_POST['sub_reis_nr']) or isset($_POST['sub_kart_saglabat'])) {

    if (isset($_POST['sub_iekr_izkr'])) {
        if ($_SESSION['REISS']['IEKRAUT']==1) {
            $_SESSION['REISS']['IEKRAUT']=0; }
        else {
            $_SESSION['REISS']['IEKRAUT']=1;
        }
    }
    if (isset($_POST['sub_reis_nr'])) {

    }
    if (isset($_POST['sub_kart_saglabat'])) {

    }





    // Failu pievienošana

//###################  Tabulas dati  ################################################

    $saraksts = sqltoarray(' * ', 'transports', ' status<10 ', $db);
}
// ################   Reisa kartiņas atvēršana  #####################################
if (isset($_GET['reisa_id'])) {
    $reisa_id = $_GET['reisa_id'];



}




?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="kpp.css" />
    <link rel="stylesheet" type="text/css" href="teksti.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="jquery/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jquery/jquery-ui.theme.min.css">
    <script src="jquery/jquery-3.1.1.min.js"></script>
    <script src="jquery/jquery-ui.min.js"></script>
</head>

<body>

<form action="Transp_reg.php" method="post" enctype="multipart/form-data">
    <div id="dvGlobal">
        <div id="dvGalva">
            <div id="dvGalvaLeft">

            </div>
            <div id="dvGalvaCenter">

            </div>
            <div id="dvGalvaRight">

            </div>

        </div>
        <div id="dvMenju">

        </div>
        <div id="dvInfo">

        </div>
        <div id="dvAlert">

        </div>
        <div id="dvDarba">
            <div id="dvKartina">
                <div id="dvKTitle">

                </div>
                <div id="dvKForma">

                </div>
                <div id="dvKFooter">

                </div>
            </div>
            <div id="dvSaraksts">
                <div id="dvSTitle">

                </div>
                <div id="dvSForma">

                </div>
                <div id="dvSFooter">

                </div>

            </div>

        </div>

    </div>

</form>
</body>
</html>