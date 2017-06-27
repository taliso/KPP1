<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";
include "funkcijas.php";

include "konekcija.php";
include "\\phpmailer\\mailset.php";
include "sesion_list.php";
define("MAX_FILE_SIZE",5000000);

// ******************************************W*********************************
//*	Mainigie:
//* 		$autor_ir - false/true - ir vai nav notikusi veiksmīga autorizācija

$kl_statusi=array (
					'Gaidam',
					'Atbraucis',
					'Uz iekraušanu',
					'Uzkrauts',
					'Izbraucis');

?>

<!DOCTYPE html>
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

	<?php
    $saraksts = sqltoarray(' * ', 'transports', '', $db);


?>
    <form action="#" method="post" enctype="multipart/form-data">
        <div id="dvMaster" style="width:100%;"><!--kopējais    -->
            <div id="dvVirsraksts"><!-- Title -->
                <span id="spTitle"> CAURLAIDE </span>
                <div>
                    <table style="width:100%;">
                        <tr>
                            <td>
<!--                            Skats no:-->
<!--                                <input type="submit" name="spodribas" value="Spodrības">-->
<!--                                <input type="submit" name="lauku" value="Lauku">-->
<!--                                <input type="submit" name="valmiera" value="Valmiera">-->
<!--                            </td>-->
                            <td></td>
<!--                            <td><input type="submit" name="jauns_ieraksts" value="+"></td>-->
                        </tr>
                    </table>



                </div>
                <?php include 'intro.php'; ?>

            </div> <!-- dvVirsraksts -->


         </div><!--divMaster    -->
    </form>
</body>
</html>