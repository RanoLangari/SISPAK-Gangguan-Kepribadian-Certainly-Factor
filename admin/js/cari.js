$(document).ready(function(){


	$('#tabel').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');

	
	// var keyword = document.getElementById('#keywordg');
	// keyword.addEventListener('keyup', function(){

	// 	console.log(ok);

	// });


	//users.php

	 $('#keyword').on('keyup', function(){

		

		$('#cari').load('ajax/client.php?keyword=' + $('#keyword').val());

		

	});
	

	$('#keyword2').on('keyup', function(){

		$('#cari').load('ajax/client.php?keyword=' + $('#keyword2').val());

	});



	//konsultasi.php

	 $('#keywordk').on('keyup', function(){

		

		$('#cari').load('ajax/kons.php?keyword=' + $('#keywordk').val());

		

	});
	

	$('#keywordk2').on('keyup', function(){

		$('#cari').load('ajax/kons.php?keyword=' + $('#keywordk2').val());

	});



	//gejala.php

	$('#keywordg').on('keyup', function(){

		$('#cari').load('ajax/cgejala.php?keyword=' + $('#keywordg').val());

	});

	$('#keywordg2').on('keyup', function(){

		$('#cari').load('ajax/cgejala.php?keyword=' + $('#keywordg2').val());

	});


	$(document).on("click", "#ubahg", function(){

		let id = $(this).data('id');
		let gejala = $(this).data('gejala');


		$(".modal-body #uidG").val(id);
		$("#ungejala").val(gejala);



	});


	//penyakit.php

	$('#keywordp').on('keyup', function(){

		$('#cari').load('ajax/cpenyakit.php?keyword=' + $('#keywordp').val());

	});

	$('#keywordp2').on('keyup', function(){

		$('#cari').load('ajax/cpenyakit.php?keyword=' + $('#keywordp2').val());

	});


	$(document).on("click", "#ubahp", function(){

		let id = $(this).data('id');
		let penyakit = $(this).data('penyakit');
		let solusi = $(this).data('solusi');
		console.log(solusi);

		$(".modal-body #uidP").val(id);
		$("#unpenyakit").val(penyakit);
		$("#solusi").val(solusi);



	});


	//penanganan.php

	$('#keywords').on('keyup', function(){

		$('#cari').load('ajax/cpenanganan.php?keyword=' + $('#keywords').val());

	});

	$('#keywords2').on('keyup', function(){

		$('#cari').load('ajax/cpenanganan.php?keyword=' + $('#keywords2').val());

	});


	$(document).on("click", "#ubahs", function(){

		let id = $(this).data('id');
		let des = $(this).data('dessolusi');
		let spenyakit = $(this).data('spenyakit');


		$(".modal-body #uids").val(id);
		$("#udes_penanganan").val(des);
		$("#uspenyakit").val(spenyakit);



	});





	//Aturan.php

	$('#keyworda').on('keyup', function(){

		$('#cari').load('ajax/caturan.php?keyword=' + $('#keyworda').val());

	});

	$('#keyworda2').on('keyup', function(){

		$('#cari').load('ajax/caturan.php?keyword=' + $('#keyworda2').val());

	});


	$(document).on("click", "#ubaha", function(){

		let id = $(this).data('id');
		let agejala = $(this).data('agejala');
		let apenyakit = $(this).data('apenyakit');
		let frasa = $(this).data('frasa');


		$(".modal-body #uida").val(id);
		$("#uangejala").val(agejala);
		$("#uanpenyakit").val(apenyakit);
		$("#ubkeyy").val(frasa);



	});


	




});