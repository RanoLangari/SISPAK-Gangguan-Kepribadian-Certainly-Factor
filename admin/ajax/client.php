<?php 

session_start();

require'../../functions.php';



if (isset($_GET["keyword"])) {

  $keyword = $_GET["keyword"];

  $_SESSION['keyword'] = $keyword;

  

}

//pagenation

$batas = 5;

$jdata = count(query("SELECT * FROM tuser WHERE 
                    id_tuser LIKE '%$keyword%' OR
                  nama LIKE '%$keyword%' OR
                  username LIKE '%$keyword%' OR
                  alamat LIKE '%$keyword%' OR
                  hp LIKE '%$keyword%' OR
                  level LIKE '%$keyword%'"));

$jhal = ceil($jdata / $batas);


// ternari (halaman aktif)

$hal = (isset($_GET["hal"]) ) ? $_GET["hal"] : 1;

$hal_awal = ($batas * $hal) - $batas;  

//limit pagination

$bts_hal = 1;

$send_num = ($hal < ($jhal - $bts_hal))? $hal + $bts_hal : $hal;

//akhir pagenation

$query = "SELECT * FROM tuser WHERE
id_tuser LIKE '%$keyword%' OR
nama LIKE '%$keyword%' OR
username LIKE '%$keyword%' OR
alamat LIKE '%$keyword%' OR
hp LIKE '%$keyword%' OR
level LIKE '%$keyword%' ORDER BY id_tuser DESC LIMIT $hal_awal,$batas";

$client = query($query);


?>

<?php if($keyword != ""): ?>
  <p id="jhp">Terdapat <?= $jdata;?> hasil pencarian untuk <i class="text-info"><?= $keyword;?></i></p>
<?php endif; ?>

<table class="table table-hover table-bordered table-striped" role="button" style="color: black;">
 <tr class="text-center">
  <th>No.</th>
  <th>ID</th>
  <th>Nama</th>
  <th>Username</th>             
  <th>Alamat</th>
  <th>Kontak</th>
  <th>Status</th>
</tr>



<?php

$nomor = $hal_awal + 1;
foreach ($client as $user): 
  ?>

  <tr>
   <td class="text-center"><?=$nomor++;?></td>
   <td class="text-center"><?=$user['id_tuser'];?></td>
   <td class="font-weight-bold"><?=$user['nama'];?></td>
   <td><?=$user['username'];?></td>
   <td><?=$user['alamat'];?></td>
   <td><?=$user['hp'];?></td>
   <td class="text-center"><?=$user['level'];?></td>                   

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