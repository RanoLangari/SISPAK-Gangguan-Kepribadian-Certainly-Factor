//event pada saat link di klik
$('.page-sc').on('click', function(e){

	

	// //ambil isi href

	var tujuan = $(this).attr('href');




	// //tangkap elemen yang bersangkutan

	var elemenTujuan = $(tujuan);



	// // pindahkan scroll

	

	$('html').animate({
		scrollTop: elemenTujuan.offset().top - 50
	}, 1000,'easeInOutExpo');


	e.preventDefault();






});