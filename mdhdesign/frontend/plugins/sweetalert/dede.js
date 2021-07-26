const flashData = $('.flash-data').data('flashdata');
const gagal = $('.gagal').data('gagal');

if(flashData){
	Swal.fire({
		icon: 'success',
		title: 'Berhasil',
		text: '' + flashData,
		showCloseButton: true,
	});
}

if(gagal) {
	Swal.fire({
		icon: 'error',
		title: 'Gagal',
		text: '' + gagal,
		showCloseButton: true,
	});
}



$('.tombolhapus').on('click', function(e) {

	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
			  title: 'Apa Anda Yakin?',
			  text: "Data Yang Dihapus Tidak Akan Pernah Kembali!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Iya, Hapus Saja!'
			}).then((result) => {
			  if (result.value) {
			    document.location.href = href;
			  }
			})
});

$('.proses').on('click', function(e) {
	
	e.preventDefault();
	const href = $(this).attr('href');
	let timerInterval
	Swal.fire({
	title: 'Proses Keluar Akun',
	html: 'Saya akan keluar dalam hitungan <b></b> detik.',
	timer: 2000,
	timerProgressBar: true,
	onBeforeOpen: () => {
		Swal.showLoading()
		timerInterval = setInterval(() => {
		const content = Swal.getContent()
		if (content) {
			const b = content.querySelector('b')
			if (b) {
			b.textContent = Swal.getTimerLeft()
			}
		}
		}, 100)
	}
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		  }
	  })

});

$('.tombolkaluar').on('click', function(e) {

	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
			  title: 'Apa Anda Yakin?',
			  text: "Pastikan Anda Mengingat Kata Sandi Dan Email Akses Anda Sebelum Keluar",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Iya, Hapus Saja!'
			}).then((result) => {
			  if (result.value) {
			    document.location.href = href;
			  }
			})
});
