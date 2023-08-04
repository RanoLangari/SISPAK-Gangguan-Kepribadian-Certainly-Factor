<?php 

session_start();

require'../../functions.php';



if (isset($_GET["keyword"])) {

  $keyword = $_GET["keyword"];

  $_SESSION['keyworda'] = $keyword;

  

}

//pagenation

$batas = 5;

 $jdata = count(query("SELECT * FROM taturancf WHERE 
                          id_cf LIKE '%$keyword%' OR
                          agejala LIKE '%$keyword%' OR
                          apenyakit LIKE '%$keyword%'OR
                          frasa LIKE '%$keyword%' OR
                          bobotcf LIKE '%$keyword%'"));


$jhal = ceil($jdata / $batas);


// ternari (halaman aktif)

$hal = (isset($_GET["hal"]) ) ? $_GET["hal"] : 1;

$hal_awal = ($batas * $hal) - $batas;  

//limit pagination

$bts_hal = 1;

$send_num = ($hal < ($jhal - $bts_hal))? $hal + $bts_hal : $hal;

//akhir pagenation

//query data

 $aturancf = "SELECT * FROM taturancf WHERE
              id_cf LIKE '%$keyword%' OR
              agejala LIKE '%$keyword%' OR
              apenyakit LIKE '%$keyword%' OR
              frasa LIKE '%$keyword%' OR
              bobotcf LIKE '%$keyword%' ORDER BY 
              id_cf DESC LIMIT $hal_awal,$batas";

$aturan = query($aturancf);


?>

<?php if($keyword != ""): ?>
  <p id="jhp">Terdapat <?= $jdata;?> hasil pencarian untuk <i class="text-info"><?= $keyword;?></i></p>
<?php endif; ?>

<table class="table table-hover table-bordered table-striped" role="button" style="color: black;">
  <tr class="text-center">
    <th>No.</th>
    <th>ID</th>
    <th>Gejala</th>
    <th>Penyakit</th>
    <th>Keyakinan</th>
    <th>Bobot CF</th>                           
    <th>Aksi</th>         

  </tr>

  <?php 
  $nomor = $hal_awal+1;

  foreach ($aturan as $atr): 
    ?>

    <tr>
     <td class="text-center col-md-1"><?=$nomor++;?></td>
     <td class="text-center"><?=$atr['id_cf'];?></td>
     <td class="text-left text-capitalize"><?=$atr['agejala'];?></td>
     <td class="font-weight-bold text-capitalize text-danger text-center"><?=$atr['apenyakit'];?></td>
     <td class="text-capitalize text-center"><?=$atr['frasa'];?></td>
     <td class="text-capitalize text-center"><?=$atr['bobotcf'];?></td>                        
     <td class="text-center"><a id="ubaha" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ubah_data" data-id="<?=$atr['id_cf'];?>" data-agejala="<?=$atr['agejala'];?>" data-apenyakit="<?= $atr['apenyakit'];?>" data-frasa="<?= $atr['frasa'];?>" ><i class="fa fa-edit"></i> edit</a></td>
   </tr>   


<?php endforeach; ?>


</table>


<!--pagenation -->

<?php if ($jdata > $batas): ?>


<nav>
  <ul class="pagination">

    <?php if ($hal > 1): ?>

     <li class="page-item"><a class="page-link font-weight-bold" href="?hal=1">First</a></li>

     <li class="page-item"><a class="page-link font-weight-bold" href="?hal=<?= $hal-1 ?>"><i class="fa fa-caret-left"></i></a></li>

    <?php endif ?>

    <?php for($i=1; $i <= $send_num; $i++) : ?>

      <?php if ($i == $hal): ?>

       <li class="page-item"><a class="page-link text-danger font-weight-bold" href="?hal=<?= $i; ?>"><?= $i;  ?></a></li>

       <?php else: ?>

        <li class="page-item"><a class="page-link font-weight-bold" href="?hal=<?= $i; ?>"><?= $i;  ?></a></li>

      <?php endif; ?>               


    <?php endfor; ?>

    <?php if ($hal < $jhal): ?>

      <li class="page-item"><a class="page-link font-weight-bold" href="?hal=<?= $hal + 1 ?>"><i class="fa fa-caret-right"></i></a></li>

      <li class="page-item"><a class="page-link font-weight-bold" href="?hal=<?= $jhal;?>">Last</a></li>

    <?php endif ?>

  </ul>
</nav>

<?php endif ?>