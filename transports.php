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
                    <td style="width:2%;text-align: center;background: darkgray;color:ivory;"></td>
                    <td style="width:2%;text-align: center;background: darkgray;color:ivory;">ID</td>
                    <td style="width:5%;text-align: center;background: darkgray;color:ivory;">Kompānija</td>
                    <td style="width:8%;text-align: center;background: darkgray;color:ivory;">Datums</td>
                    <td style="width:10%;text-align: center;background: darkgray;color:ivory;">Šoferis</td>
                    <td style="width:10%;text-align: center;background: darkgray;color:ivory;">A/M num.</td>
                    <td style="width:10%;text-align: center;background: darkgray;color:ivory;">Laiks, iebrauca</td>
                    <td style="width:10%;text-align: center;background: darkgray;color:ivory;">Laiks, izbrauca</td>
                    <td style="width:8%;text-align: center;background: darkgray;color:ivory;">Pasūtījuma num.</td>
                    <td style="width:25%;text-align: center;background: darkgray;color:ivory;">Komentāri / Apraksts</td>
                </tr>
            </table>
        <?php foreach($saraksts  as $rec ) { ?>

        <div id="dvIeraksts" style="width:100%;border-bottom-color:red;" >
            <table id="tabList" style="width:100%;">
                <tr>
                    <td style="width:2%;text-align: center;background: darkgray;color:ivory;"></td>
                    <td style="width:2%;text-align: center;background: darkgray;color:ivory;"><a href="?reisa_id=' <?php echo $rec['ID']; ?>'" title="Atvērt"><?php echo $rec['ID']; ?></td>
                    <td style="width:5%;text-align: center;background: gray;color:ivory;"><?php echo $rec['kompanija']; ?></td>
                    <td style="width:8%;text-align: center;background: gray;color:ivory;"><?php echo $rec['rec_time']; ?></td>
                    <td style="width:10%;text-align: center;background: gray;color:ivory;"><?php echo $rec['vaditajs']; ?></td>
                    <td style="width:10%;text-align: center;background: gray;color:ivory;"><?php echo $rec['masinas_nr']; ?></td>
                    <td style="width:10%;text-align: center;background: gray;color:ivory;"><?php echo $rec['iebrauca']; ?></td>
                    <td style="width:10%;text-align: center;background: gray;color:ivory;"><?php echo $rec['izbrauca']; ?></td>
                    <td style="width:8%;text-align: center;background: gray;color:ivory;"><?php echo $rec['pasut_nr']; ?></td>
                    <td style="width:25%;text-align: center;background: gray;color:ivory;"><?php echo $rec['komentars']; ?></td>
                </tr>
            </table>

        </div>
    <?php } ?>
    </div><!--divView    -->
<?php } }
if (isset($_GET['navig'])) {
    if ($_GET['navig'] == 'mnNew') {
        $reis=max_reis($db)+1;
        $_SESSION['REISS']['ID']=$reis;
        $_SESSION['REISS']['IEKRAUT']=1;
        $_SESSION['REISS']['KLIENTS']="";
        $_SESSION['REISS']['VALSTS']="";
        $_SESSION['REISS']['KRAVA']="";
        $_SESSION['REISS']['PILSĒTA']="";
        $_SESSION['REISS']['KOMPANIJA']="";
        $_SESSION['REISS']['LAIKS']="";
        $_SESSION['REISS']['VADITAJS']="";
        $_SESSION['REISS']['MAS_NR']="";
        $_SESSION['REISS']['IEBRAUCA']="";
        $_SESSION['REISS']['IZBRAUCA']="";
        $_SESSION['REISS']['PASUT_NR']="";
        $_SESSION['REISS']['KOMENTARS']="";
        $_SESSION['REISS']['STADIJA']="NEW";  // EDIT, VIEW, DELETE

        include 'kartina_jauns.php';
    }
    if ($_GET['navig'] == 'mnArhiv') {

    }
}?>

</form>
</body>
</html>