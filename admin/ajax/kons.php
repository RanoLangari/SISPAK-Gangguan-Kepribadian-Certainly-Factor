<?php 

session_start();

require'../../functions.php';



if (isset($_GET["keyword"])) {

  $keyword = $_GET["keyword"];

  $_SESSION['keywordk'] = $keyword;

  

}

//pagenation

$batas = 5;

$jdata = count(query("SELECT * FROM konsultasi WHERE 
                      id_konsultasi LIKE '%$keyword%' OR
                      id_kuser LIKE '%$keyword%' OR
                      kpenyakit LIKE '%$keyword%' OR
                      persentase LIKE '%$keyword%' OR
                      id_ksolusi LIKE '%$keyword%' OR
                      kdate LIKE '%$keyword%'"));

$jhal = ceil($jdata / $batas);


// ternari (halaman aktif)

$hal = (isset($_GET["hal"]) ) ? $_GET["hal"] : 1;

$hal_awal = ($batas * $hal) - $batas;  

//limit pagination

$bts_hal = 1;

$send_num = ($hal < ($jhal - $bts_hal))? $hal + $bts_hal : $hal;

//akhir pagenation

$query = "SELECT * FROM konsultasi WHERE
id_konsultasi LIKE '%$keyword%' OR
id_kuser LIKE '%$keyword%' OR
kpenyakit LIKE '%$keyword%' OR
persentase LIKE '%$keyword%' OR
id_ksolusi LIKE '%$keyword%' OR
kdate LIKE '%$keyword%' ORDER BY id_konsultasi DESC LIMIT $hal_awal,$batas";

$kons = query($query);


?>

<?php if($keyword != ""): ?>
  <p id="jhp">Terdapat <?= $jdata;?> hasil pencarian untuk <i class="text-info"><?= $keyword;?></i></p>
<?php endif; ?>

<table class="table table-hover table-bordered table-striped" role="button" style="color: black;">
 <tr class="text-center">
   <th>No.</th>
   <th>ID</th>
   <th>User</th>
   <th>Penyakit</th>
   <th>Persentase</th>
   <th>Penanganan</th>
   <th>Date/Time</th>
</tr>



<?php

$nomor = $hal_awal + 1;
foreach ($kons as $ko): 
  ?>

  <tr>
   <td class="text-center"><?=$nomor++;?></td>
   <td class="text-center font-weight-bold"><?=$ko['id_konsultasi'];?></td>
   <td class="font-weight-bold text-capitalize text-center"><?=$ko['id_kuser'];?></td>
   <td class="font-weight-bold text-capitalize text-center"><?=$ko['kpenyakit'];?></td>
   <td class="font-weight-bold text-capitalize text-center"><?=$ko['persentase'];?> %</td>
   <td class="font-weight-bold text-capitalize text-center"><?=$ko['id_ksolusi'];?></td>
   <td class="text-capitalize text-center"><?=$ko['kdate'];?></td>
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