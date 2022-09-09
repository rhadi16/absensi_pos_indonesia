// set location
if (geo_position_js.init()) {
	geo_position_js.getCurrentPosition(success_callback, error_callback, {
		enableHighAccuracy: true
	});
} else {
	alert("Functionality not available");
}

function success_callback(p) {
	document.getElementById("lat").value = p.coords.latitude.toFixed(7);
	document.getElementById("lon").value = p.coords.longitude.toFixed(7);

	makeCode(p.coords.latitude.toFixed(7), p.coords.longitude.toFixed(7));
}

function error_callback(p) {
	alert('error=' + p.message);
}

$("#logout").on("click", function () {
	Swal.fire({
		title: "Anda Yakin?",
		text: "Ingin Logout?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#3085d6",
		confirmButtonText: "Ya",
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
});

var menu_btn = document.querySelector("#menu-btn");
var sidebar = document.querySelector("#sidebar");
var container = document.querySelector(".my-container");
menu_btn.addEventListener("click", () => {
	sidebar.classList.toggle("active-nav");
	container.classList.toggle("active-cont");
});

// generate qrcode
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 223,
	height : 223
});

function makeCode(lat, lon) {   
	var nip = document.getElementById("nip").value;
	var nama = document.getElementById("nama").value;
	// var strArr = siswa.split('-');

	// var nis = strArr[0];
	// var nama = strArr[1];

	var data_karyawan = nip + '||' + nama + '||' + lat + '||' + lon;

	if (!data_karyawan) {
		alert("Maaf Input Data Langkap Terlebih Dahulu!");
		return;
	}

		// $('#kartu-siswa').show();
		// $('#btn-kartu-siswa').show();

	qrcode.makeCode(data_karyawan); //kode utama
	$('#_nip').html(nip);
	$('#_nama').html(nama.toUpperCase());

}

// $(window).on('load', function(e) {
// 	makeCode();
// });