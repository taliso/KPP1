<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";
include "funkcijas.php";
include "konekcija.php";
include "\\phpmailer\\mailset.php";

define("MAX_FILE_SIZE",5000000);

// ******************************************W*********************************
//*	Mainigie:
//* 		$autor_ir - false/true - ir vai nav notikusi veiksmīga autorizācija

$kl_statusi=array (
					'Gaidam',
					'Atbraucis',
					'Uz iekraušanu',
					'Uzkrauts',
					'Izbrucis');


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

	<?php 
//Rindas pievienošana	

if (isset($_POST['pievienot_rindu'])){
	   $sql = "INSERT INTO transports SET
        numurs=:numurs,
	    valsts=:valsts,
   	    vaditajs=:vaditajs,
   	    piegadatajs=:piegadatajs,
        krava=:krava,
        status=:status,
        komentars=:komentars,
        datums=:datums";
    $q = $db->prepare($sql);
	$data = array(
          ':numurs'=>$_POST['numurs'],
          ':valsts'=>$_POST['valsts'],
          ':vaditajs'=>$_POST['vaditajs'],
          ':piegadatajs'=>$_POST['piegadatajs'],
          ':krava'=>$_POST['krava'],
          ':status'=>$_POST['status'],
          ':komentars'=>$_POST['komentars'],
          ':datums'=>date("Y-m-d"));

    $q->execute($data);
}
	
 // Failu pievienošana

//###################  Tabulas dati  ################################################

$saraksts=sqltoarray(' * ' , 'transports', '', $db)


?>
<form action="#" method="post" enctype="multipart/form-data">
<div id="divMaster" style="width:100%;"><!--divMaster    -->
	<div id="divDarba" style="width:100%;"><!--divDarba    -->
		<div id="divForma" style="width:100%;"><!--divForma    -->
			<div id="divView" style="width:100%;">
				<table style="width:100%;">
					<tr>
						<td style="width:8%;"><input type="text" name="piegadatajs"  placeholder="Piegādātājs" value="" size="20">
						</td>
						<td style="width:8%;"><input type="text" name="krava"  placeholder="Krava" value="" size="30">
						</td>
						<td style="width:8%;"><input type="text" name="valsts"  placeholder="Valsts" value="" size="20">
						</td>
						<td style="width:8%;"><input type="text" name="numurs"  placeholder="Numurs" value="" size="10">
						</td>
						<td style="width:8%;"><input type="text" name="vaditajs"  placeholder="Vadītājs" value="" size="15">
						</td>
						<td style="width:8%;"><input type="text" name="datums"  placeholder="Datums" value="" size="15">
						</td>
						<td style="width:50%;"><input type="text" name="komentars"  placeholder="Komentārs" value="" size="120">
						</td>
						<td style="width:8%;">
						<input type="text" name="status"  placeholder="Status" value="" size="15">
						
						</td>
						<td style="width:3%;"><input type="submit" name="pievienot_rindu" value=" + ">
						</td>
						
					</tr>

					<tr>
						<td style="width:8%; text-align:center; background:black; color:white;">Piegādātājs
						</td>
						<td style="width:10%; text-align:center; background:black; color:white;">Krava
						</td>
						<td style="width:8%; text-align:center; background:black; color:white;">Valsts
						</td>
						<td style="width:8%; text-align:center; background:black; color:white;">Numurs
						</td>
						<td style="width:8%; text-align:center; background:black; color:white;">Vadītājs
						</td>
						<td style="width:8%; text-align:center; background:black; color:white;">Datums
						</td>
						<td style="width:40%; text-align:center; background:black; color:white;">Komentārs
						</td>
						<td style="width:5%; text-align:center; background:black; color:white;">Status
						</td>
						<td style="width:2%; text-align:center; background:black; color:white;">
						</td>

					</tr>
					
					<?php 
					foreach($saraksts as $sar){ 
					//#################################################################
					?>
					<tr>
						<td style="width:8%;"><?php echo $sar['piegadatajs']  ?>
						</td>
						<td style="width:8%;"><?php echo $sar['krava']  ?>
						</td>
						<td style="width:8%;"><?php echo $sar['valsts']  ?>
						</td>
						<td style="width:8%;"><?php echo $sar['numurs']  ?>
						</td>
						<td style="width:8%;"><?php echo $sar['vaditajs']  ?>
						</td>
						<td style="width:8%;"><?php echo $sar['datums']  ?>
						</td>
						<td style="width:50%;"><?php echo $sar['komentars']  ?>
						</td>
						<td style="width:8%;">
						 <select name="agents">
							  <?php
								foreach($kl_statusi as $st){
									echo "<option value='$st'>$st</option>";
								} 
							  ?>
						   </select>
						
						</td>
						<td style="width:3%;">
						</td>
						
					</tr>
						
					
					<?php 
					//##################################################################
					}
					?>
					
					
				</table>
			</div><!--divView    -->	
		</div><!--divForma    -->
	</div><!--divDarba    -->
</div><!--divMaster    -->
</form>	
</body>
</html>