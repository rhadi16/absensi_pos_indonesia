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
}

function error_callback(p) {
	alert('error=' + p.message);
}

// set datatable
$(document).ready(function () {
    $('#pegawai').DataTable();
});

// logout
function logout(url) {
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
}
// hapus anggota
function hapusPegawai(nama, url) {
	Swal.fire({
		title: "Anda Yakin?",
		text: "Ingin Menghapus Karyawan " + nama,
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
}
// // mark pada saat search data
// function search(nips, namas, departs, searched) {
// 	let nip = document.getElementById(nips).innerHTML;
// 	let nama = document.getElementById(namas).innerHTML;
// 	let depart = document.getElementById(departs).innerHTML;

// 	let re = new RegExp(searched, "g"); // search for all instances

// 	let newNip = nip.replace(
// 		re,
// 		`<span class="text-bg-warning">${searched}</span>`
// 	);
// 	let newNama = nama.replace(
// 		re,
// 		`<span class="text-bg-warning">${searched}</span>`
// 	);
// 	let newDepart = depart.replace(
// 		re,
// 		`<span class="text-bg-warning">${searched}</span>`
// 	);

// 	document.getElementById(nips).innerHTML = newNip;
// 	document.getElementById(namas).innerHTML = newNama;
// 	document.getElementById(departs).innerHTML = newDepart;
// }
// // format number pada input text
// document.querySelectorAll("#gapok").forEach(
// 	(inp) =>
// 		new Cleave(inp, {
// 			numeral: true,
// 			numeralDecimalMark: "thousand",
// 			delimiter: ".",
// 		})
// );

document.addEventListener("DOMContentLoaded", function (event) {
	const showNavbar = (toggleId, navId, bodyId, headerId) => {
		const toggle = document.getElementById(toggleId),
			nav = document.getElementById(navId),
			bodypd = document.getElementById(bodyId),
			headerpd = document.getElementById(headerId);

		// Validate that all variables exist
		if (toggle && nav && bodypd && headerpd) {
			toggle.addEventListener("click", () => {
				// show navbar
				nav.classList.toggle("shows");
				// change icon
				toggle.classList.toggle("bx-x");
				// add padding to body
				bodypd.classList.toggle("body-pd");
				// add padding to header
				headerpd.classList.toggle("body-pd");
			});
		}
	};

	showNavbar("header-toggle", "nav-bar", "body-pd", "header");

	/*===== LINK ACTIVE =====*/
	// const linkColor = document.querySelectorAll(".nav_link");

	// function colorLink() {
	// 	if (linkColor) {
	// 		linkColor.forEach((l) => l.classList.remove("active"));
	// 		this.classList.add("active");
	// 	}
	// }
	// linkColor.forEach((l) => l.addEventListener("click", colorLink));

	// Your code to run since DOM is loaded and ready
});
