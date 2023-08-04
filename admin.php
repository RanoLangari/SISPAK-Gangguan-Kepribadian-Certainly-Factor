<?php 


// //cara membuat id_Gelaja Otomatis

// $query = "SELECT max(id_gejala) as max_code FROM tgejala";

// $hasil = mysqli_query($conn, $query);

// $data = mysqli_fetch_assoc($hasil);

// $id = $data['max_code'];

// $urutan = (int)substr($id, 1,3);

// $urutan++;

// $huruf = 'G';

// $id_gejala = $huruf. sprintf("%03s",$urutan);

// echo $id_gejala;


echo "Berhasil Login";




 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Halaman Admin</title>
 </head>
 <body>
 
<br>

<a href="index.php">Kembali</a>



 </body>
 </html>