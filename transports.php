<?php
/**
 * Created by PhpStorm.
 * User: talivaldis.olekss
 * Date: 13.05.2017
 * Time: 10:49
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



$saraksts=sqltoarray(' * ','transports'," izbraucis='0000-00-00 00:00:00' ",$db);

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



    $sql = "INSERT INTO transports SET ";

    $sql=$sql." reisa_nr=:reisa_nr,
        klients=:klients,
        krava=:krava,
        masinas_nr=:masinas_nr,
        piekabes_nr=:piekabes_nr,
        valsts=:valsts,
        vaditajs=:vaditajs,
        pilseta=:pilseta,
        iekraut_izkraut=:iekraut_izkraut,
        status=:status,
        gaidams=:gaidams,
        ieradies=:ieradies,
        iebrauca=:iebrauca,
        uzkravies=:uzkravies,
        izbraucis=:izbraucis,
        devas_uz=:devas_uz,
        kur_ievadits=:kur_ievadits,
        piev_fails=:piev_fails,
        komentars=:komentars,
        kad_ievadits=:kad_ievadits";

    $q = $db->prepare($sql);

    $data = array(
        'reisa_nr' => 0,
        'klients' => '',
        'krava' => '',
        'masinas_nr' => '',
        'piekabes_nr' => '',
        'valsts' => '',
        'vaditajs' => '',
        'pilseta' => '',
        'iekraut_izkraut' => '',
        'status' => 0,
        'gaidams' => '0000-00-00',
        'ieradies' => '0000-00-00',
        'iebrauca' => '0000-00-00',
        'uzkravies' => '0000-00-00',
        'izbraucis' => '0000-00-00',
        'devas_uz' => '',
        'kur_ievadits' => '',
        'piev_fails' => '',
        'komentars' => '',
        'kad_ievadits'=>'0000-00-00');

    $q->execute($data);


    // Failu pievienošana

//###################  Tabulas dati  ################################################

    $saraksts = sqltoarray(' * ', 'transports', '', $db);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="pretenz.css" />
    <link rel="stylesheet" type="text/css" href="teksti.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="jquery/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jquery/jquery-ui.theme.min.css">
    <script src="jquery/jquery-3.1.1.min.js"></script>
    <script src="jquery/jquery-ui.min.js"></script>
</head>

<body>

<form action="#" method="post" enctype="multipart/form-data">
    <div>
        <a href="index.php">Atpakaļ</a>
     </div>
    <div>
        <ul>
            <li id='mnNavig'><a id='mnaNavig' href="?navig=mnSaraksts">Saraksts</a></li>
            <li id='mnNavig'><a id='mnaNavig' href="?navig=mnNew">Jauns reiss</a></li>
            <li id='mnNavig'><a id='mnaNavig' href="?navig=mnArhiv">Arhīvs</a></li>
        </ul>

    </div>
<?php if (isset($_GET['navig'])){

if ($_GET['navig']=='mnSaraksts') {?>
    <div id="divView" style="width:100%;"><!-- Saraksta rāmis  -->
            <table id="tabTitle" style="width:100%;">
                <tr>
                    <td style="width:3%;text-align: center;background: darkgray;color:ivory;">Vieta</td>
                    <td style="width:5%;text-align: center;background: darkgray;color:ivory;">Reiss</td>
                    <td style="width:20%;text-align: center;background: darkgray;color:ivory;">Klients</td>
                    <td style="width:18%;text-align: center;background: darkgray;color:ivory;">Krava</td>
                    <td style="width:8%;text-align: center;background: darkgray;color:ivory;">Iekraut/Izkraut</td>
                    <td style="width:8%;text-align: center;background: darkgray;color:ivory;">Status</td>
                    <td style="width:15%;text-align: center;background: darkgray;color:ivory;">Dosies uz</td>
                    <td style="width:7%;text-align: center;background: darkgray;color:ivory;">Maš.Nr</td>
                    <td style="width:3%;text-align: center;background: darkgray;color:ivory;">Instrumenti</td>
                </tr>
            </table>
        <?php foreach($saraksts  as $rec ) { ?>

        <div id="dvIeraksts" style="width:100%;border:solid 1px red;" >
            <table id="tabList" style="width:100%;">
                <tr>
                    <td style="width:3%;background: gray;color:ivory;"><?php echo $rec['kur_ievadits']; ?></td>
                    <td style="width:5%;text-align: center;background: gray;color:ivory;"><?php echo $rec['reisa_nr']; ?></td>
                    <td style="width:20%;text-align: center;background: gray;color:ivory;"><?php echo $rec['klients']; ?></td>
                    <td style="width:18%;text-align: center;background: gray;color:ivory;"><?php echo $rec['krava']; ?></td>
                    <td style="width:8%;text-align: center;background: gray;color:ivory;"><?php echo $rec['iekraut_izkraut']; ?></td>
                    <td style="width:8%;text-align: center;background: gray;color:ivory;"><?php echo $rec['status']; ?></td>
                    <td style="width:15%;text-align: center;background: gray;color:ivory;"><?php echo $rec['devas_uz']; ?></td>
                    <td style="width:7%;text-align: center;background: gray;color:ivory;"><?php echo $rec['masinas_nr'].'/'.$rec['piekabes_nr']; ?></td>
                    <td style="width:3%;text-align: center;background: gray;color:ivory;">Instrumenti</td>
                </tr>
            </table>

        </div>
    <?php } ?>
    </div><!--divView    -->
<?php } }?>
    <?php if ($_GET['navig']=='mnNew') {
        include 'kartina_jauns.php';
    } ?>
    <?php if ($_GET['navig']=='mnArhiv') {?>

    <?php } ?>

</form>
</body>
</html>