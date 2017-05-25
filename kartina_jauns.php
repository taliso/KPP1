<?php
/**
 * Created by PhpStorm.
 * User: talivaldis.olekss
 * Date: 13.05.2017
 * Time: 10:47
 */

if ($_SESSION['REC']['ID']>0) {
    $saraksts = sqltoarray($_SESSION['REC']['ID'], 'transports', '', $db);
    $rec=$saraksts[0];
} else {
    $reis=max_reis($db);
    $rec=array(
        'reisa_nr'=> $reis,
        'klients'=>'' ,
        'krava'=> '',
        'masinas_nr'=>'' ,
        'piekabes_nr'=>'' ,
        'valsts'=>'' ,
        'vaditajs'=>'' ,
        'pilseta'=>'' ,
        'iekraut_izkraut'=>'' ,
        'status'=> 0,
        'gaidams'=> '0000-00-00',
        'ieradies'=> '',
        'iebrauca'=> '',
        'uzkravies'=> '',
        'izbraucis'=> '',
        'devas_uz'=> '',
        'kur_ievadits'=>'' ,
        'piev_fails'=> '',
        'komentars'=>'',
        'kad_ievadits'=>date('d-m-Y G:i')
    );
}

?>
<div id="dvKartina" style="width: 50%;margin-left: 20%;">
    <div id="dvKartGalv" style="width: 100%;text-align: center; ">
        Reisa kartiņa

    </div>
    <div id="dvKartForm">
        <table style="width: 100%;">
            <tr>
                <td id="kart_tab_td_1">Reisa Nr.</td>

                <td id="kart_tab_td_2">
                    <input type="text" name="reisa_nr" value="<?php echo $rec['reisa_nr']; ?>" disabled>
                </td>
                <td id="kart_tab_td_3"><input type="submit" name="sub_reis_nr" value="+"></td>
            </tr>
            <tr>
                <td id="kart_tab_td_1">Klients</td>

                <td id="kart_tab_td_2"><input type="text" name="klients" value="<?php echo $rec['klients']; ?>"></td>
                <td id="kart_tab_td_3"><input type="submit" name="sub_klients" value="..."></td>
            </tr>
            <tr>
                <td id="kart_tab_td_1">Krava</td>

                <td id="kart_tab_td_2"><input type="text" name="krava" value="<?php echo $rec['krava']; ?>"></td>
                <td id="kart_tab_td_3"></td>
            </tr>
            <tr>

            <tr>
                <td id="kart_tab_td_1">Valsts</td>

                <td id="kart_tab_td_2"><input type="text" name="valsts" value="<?php echo $rec['valsts']; ?>"></td>
                <td id="kart_tab_td_3"><input type="submit" name="sub_klients" value="..."></td>
            </tr>
            <tr>
                <td id="kart_tab_td_1">Pilsēta</td>

                <td id="kart_tab_td_2"><input type="text" name="pilseta" value="<?php echo $rec['pilseta']; ?>"></td>
                <td id="kart_tab_td_3"></td>
            </tr>
            <tr>
                <td id="kart_tab_td_1">Gaidam</td>

                <td id="kart_tab_td_2">
                    <input ID="gaidam_datums" type="text" name="gaidams" value="<?php echo  $rec['gaidams']; ?>"><br>
                 <td id="kart_tab_td_3"></td>
            </tr>

            <tr>
                <td id="kart_tab_td_1">Mašīnas Nr.</td>

                <td id="kart_tab_td_2"><input type="text" name="masinas_nr" value="<?php echo $rec['masinas_nr']; ?>"></td>
                <td id="kart_tab_td_3"></td>
            </tr>

            <tr>
                <td id="kart_tab_td_1">Piekabes Nr.</td>

                <td id="kart_tab_td_2"><input type="text" name="piekabes_nr" value="<?php echo $rec['piekabes_nr']; ?>"></td>
                <td id="kart_tab_td_3"></td>
            </tr>

            <tr>
                <td id="kart_tab_td_1">Vadītājs</td>

                <td id="kart_tab_td_2"><input type="text" name="vaditajs" value="<?php echo $rec['vaditajs']; ?>"></td>
                <td id="kart_tab_td_3"></td>
            </tr>

            <tr>
                <td id="kart_tab_td_1">Iekraut / izkraut</td>

<!--                <td id="kart_tab_td_2"><input type="text" name="iekraut_izkraut" value="--><?php //echo $rec['iekraut_izkraut']; ?><!--"></td>-->
                <?php if ($_SESSION['REISS']['IEKRAUT']==0) {
                    $iekr_izkr = "Izkraut";
                } else {
                    $iekr_izkr = "Iekraut";
                }?>
                <td id="kart_tab_td_3"><input type="submit" name="sub_iekr_izkr" value="<?php echo $iekr_izkr ?> "></td>
            </tr>

              <tr>
                <td id="kart_tab_td_1">Devās uz</td>

                <td id="kart_tab_td_2"><input type="text" name="devas_uz" value="<?php echo $rec['devas_uz']; ?>"></td>
                <td id="kart_tab_td_3"></td>
            </tr>
            <tr>
                <td id="kart_tab_td_1">Kad ievadīts</td>

                <td id="kart_tab_td_2">

                    <input type="text" name="kad_ievadits" value="<?php echo $rec['kad_ievadits']; ?>"></td>
                <td id="kart_tab_td_3"></td>
            </tr>

            <tr>
                <td id="kart_tab_td_1">Komentārs</td>

                <td id="kart_tab_td_2"><input type="text" name="komentars" value="<?php echo $rec['komentars']; ?>"></td>
                <td id="kart_tab_td_3"></td>
            </tr>

            <tr>
                <td id="kart_tab_td_1"></td>
                <td id="kart_tab_td_2"></td>
                <td id="kart_tab_td_3">
                    <input type="submit" name="sub_kart_saglabat" value="Saglabāt">
                    <input type="submit" name="sub_kart_cancel" value="Iziet">
                </td>
            </tr>


        </table>

    </div>
</div>

<script>
    $( function() {
        $( "#gaidam_datums" ).datepicker({dateFormat: 'yy-mm-dd'});
    } );

</script>
