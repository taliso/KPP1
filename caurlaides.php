<?php
/**
 * Created by PhpStorm.
 * User: talivaldis.olekss
 * Date: 25.05.2017
 * Time: 16:09
 */
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";
include "funkcijas.php";
include "konekcija.php";
include "\\phpmailer\\mailset.php";
$cnr='';
if (isset($_POST['meklet_caurlaidi'])) {
    $cnr=$_POST['mnumurs'];
}
if (isset($_POST['pievienot_caurlaidi'])) {

    $mvards= $_POST['vards'];
    $mmcnr =$_POST['numurs'];
    $mkods =$_POST['kods'];

    if (strlen($mvards)>0&&strlen($mmcnr)) {

        if (vai_ir('caurlaides','caurl_nr',$mmcnr,$db)==0) {
                $sql = "INSERT INTO caurlaides SET ";
                $sql = $sql . "vards=:vards,
                            caurl_nr=:caurl_nr,
                            kods=:kods,
                            ieksa_ara=:ieksa_ara,
                            status=:status";

                $q = $db->prepare($sql);

                $data = array(
                    ':vards' => $mvards,
                    ':caurl_nr' => $mmcnr,
                    ':kods' => $mkods,
                    ':ieksa_ara' => 1,
                    ':status' => 1);

                $q->execute($data);
        } else {

            $malert = "Norādītais caurlaides numurs jau eksistē. Ieraksts nav saglabāts.";
         }

    } else {
            $malert = "Nav ievadīti visi dati. Ieraksts nav saglabāts.";
    }

}
if (isset($_GET['nav_caurl'])&&$_GET['nav_caurl']=='mnSaraksts') {
    $_SESSION['CAURLAIDES']['STATUS']='LIST';
}
if (isset($_GET['nav_caurl'])&&$_GET['nav_caurl']=='mnNew') {
    $_SESSION['CAURLAIDES']['STATUS']='NEW';
}
if (isset($_GET['nav_caurl'])&&$_GET['nav_caurl']=='mnAtleg') {
    $_SESSION['CAURLAIDES']['STATUS']='KEY';
}
if (isset($_GET['nav_caurl'])&&$_GET['nav_caurl']=='mnIdent') {
    $_SESSION['CAURLAIDES']['STATUS']='IDENT';
}
if (isset($_GET['nav_caurl'])&&$_GET['nav_caurl']=='mnArhiv') {
    $_SESSION['CAURLAIDES']['STATUS']='ARH';
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="pretenz.css" />
    <link rel="stylesheet" type="text/css" href="kpp.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="jquery/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jquery/jquery-ui.theme.min.css">
    <script src="jquery/jquery-3.1.1.min.js"></script>
    <script src="jquery/jquery-ui.min.js"></script>
</head>

<body>
    <form action="caurlaides.php" method="post" enctype="multipart/form-data">
        <div>
            <a href="index.php">Atpakaļ</a>
        </div>

        <div>
            <ul>
                <li id='mnNavig'><a id='mnaNavig' href="?nav_caurl=mnSaraksts">Saraksts</a></li>
                <li id='mnNavig'><a id='mnaNavig' href="?nav_caurl=mnNew">Jauna </a></li>
                <li id='mnNavig'><a id='mnaNavig' href="?nav_caurl=mnAtleg">Atslēgas </a></li>
                <li id='mnNavig'><a id='mnaNavig' href="?nav_caurl=mnIdent">Identifikācija</a></li>
                <li id='mnNavig'><a id='mnaNavig' href="?nav_caurl=mnArhiv">Arhīvs</a></li>
            </ul>

        </div>
        <?php
        if (isset($malert)&&strlen($malert)>0) {
            $_SESSION['CAURLAIDES']['STATUS']='ALERT'?>
            <div id="dvAlert">
                <span id="spAlert" >
                    <?php echo $malert; ?>
                </span>
            </div>
        <?php }


        ?>
        <div>
<?php if($_SESSION['CAURLAIDES']['STATUS']=='NEW'&&$_SESSION['CAURLAIDES']['STATUS']!='ALERT') { ?>
        <table style="width:100%">
            <tr>
                <td id="caurl_1">
                    <input type="text" name="numurs"  placeholder="Numurs" value="">
                </td>
                <td id="caurl_2">
                    <input style="width:95%;" type="text" name="vards"  placeholder="Vārds, Uzvārds" value="">
                </td>
                  <td id="caurl_4">
                    <input type="text" name="kods"  placeholder="Caurlaides kods" value="" >
                </td>
                <td id="caurl_1">
                    <input type="submit" name="pievienot_caurlaidi" value=" + ">
                </td>
            </tr>
        </table>
<?php } ?>
<?php if($_SESSION['CAURLAIDES']['STATUS']=='LIST'&&$_SESSION['CAURLAIDES']['STATUS']!='ALERT') { ?>
    <table style="width:100%">
        <tr>
            <td id="caurl_1">
                <input type="text" name="mnumurs"  placeholder="Numurs" value="">
            </td>
            <td id="caurl_2">
                <input type="submit" name="meklet_caurlaidi" value=" + ">
            </td>
            <td id="caurl_4">
             </td>
            <td id="caurl_1">
            </td>
        </tr>
    </table>
<?php } ?>

  <?php if (($_SESSION['CAURLAIDES']['STATUS']=='LIST' or $_SESSION['CAURLAIDES']['STATUS']=='NEW')&&$_SESSION['CAURLAIDES']['STATUS']!='ALERT') {
    $csaraksts= sqltoarray(' * ', 'caurlaides', ' status = 1 ', $db) ?>
                <div id="dvCaurlSar">
                    <table style="width:100%">
                        <tr>
                            <td id="caurl_1h">
                                Caurlaide Nr.
                            </td>
                            <td id="caurl_2h">
                                Vārds, Uzvārds
                            </td>
                            <td id="caurl_3h">
                                Ienācis/izgājis
                            </td>
                            <td id="caurl_4h">
                                Kad
                            </td>
                            <td id="caurl_5h">
                                Firma
                            </td>

                            <td id="caurl_6h">
                                Status
                            </td>
                             <td id="caurl_7h">
                                Atslēgas
                            </td>
                            <td id="caurl_8h">

                            </td>
                        </tr>
                        <?php
                        foreach ($csaraksts as $cone){
                            if ($cnr>0&&$cnr==$cone['caurl_nr']){
                                $id_c="caurl_1".'a';
                            }else {
                                $id_c='';
                            }?>
                            <tr>
                                <td id="caurl_1">
                                    <?php echo $cone['caurl_nr']; ?>
                                </td>
                                <td id="caurl_2">
                                    <?php echo $cone['vards']; ?>
                                </td>
                                <td id="caurl_3">
                                    <?php echo $cone['ieksa_ara']; ?>
                                </td>
                                <td id="caurl_4">
                                    <?php echo $cone['ped_izm']; ?>
                                </td>
                                <td id="caurl_5">
                                    <?php echo $cone['firma']; ?>
                                </td>
                                <td id="caurl_6">
                                    <?php echo $cone['status']; ?>
                                </td>
                                <td id="caurl_7">
                                    <?php echo $cone['cik_atslegas']; ?>
                                </td>

                                <td id="caurl_8">
                                    <img id="logo" src="icons\error.png" alt="WAIT" >
                                </td>
                            </tr>

                 <?php } ?>

                    </table>
                </div>
            <?php } ?>
        </div>
    </form>
</body>
</html>
