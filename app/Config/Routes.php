<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['as' => 'home']);


$routes->group("Mahasiswa", ['filter' => 'role:Mahasiswa'], function ($routes) {
	$routes->get('/', 'Mahasiswa::index', ['as' => 'mahasiswa']);
	$routes->group("TugasAkhir", function ($routes) {
		$routes->get('judul', 'Mahasiswa::judul', ['as' => 'mahasiswa.judul']);
		$routes->post('judul', 'Mahasiswa::tambahjudul');
		$routes->get('downloadBimbingan/(:num)/(:num)/(:alpha)/(:num)', 'Mahasiswa::downloadBimbingan/$1/$2/$3/$4');
		$routes->get('downloadBimbingan/(:num)/(:num)/(:alpha)/(:num)/(:num)', 'Mahasiswa::downloadBimbingan/$1/$2/$3/$4/$5');
		$routes->get('bimbinganProposal', 'Mahasiswa::bimbinganProposal', ['as' => 'mahasiswa.bimbinganProposal']);
		$routes->post('bimbinganProposal', 'Mahasiswa::tambahbimbinganProposal');
		$routes->get('bimbinganTugasAkhir', 'Mahasiswa::bimbinganTugasAkhir', ['as' => 'mahasiswa.bimbinganTugasAkhir']);
		$routes->post('bimbinganTugasAkhir', 'Mahasiswa::tambahbimbinganTugasAkhir');
	});
	$routes->group("Jadwal", function ($routes) {
		$routes->get('SeminarProposal', 'Mahasiswa::jadwalSeminarProposal', ['as' => 'mahasiswa.jadwal.jadwalSeminarProposal']);
		$routes->get('SeminarTugasAkhir', 'Mahasiswa::jadwalSeminarTugasAkhir', ['as' => 'mahasiswa.jadwal.jadwalSeminarTugasAkhir']);
	});
	$routes->group("BA", function ($routes) {
		$routes->get('Download/(:num)/(:alpha)/(:num)', 'Mahasiswa::downloadUji/$1/$2/$3');
	});
});

$routes->group("Dosen", ['filter' => 'role:Dosen'], function ($routes) {
	$routes->get('/', 'Dosen::index', ['as' => 'dosen']);
	$routes->group("Validasi", function ($routes) {
		$routes->get('Judul', 'Dosen::validasiJudul', ['as' => 'dosen.validasi.judul'], ['filter' => 'permission:Dosen Pembimbing']);
		$routes->get('Judul/(:alpha)/(:num)/(:alpha)/(:alpha)', 'Dosen::tambahvalidasiJudul/$1/$2/$3/$4');
		$routes->get('Proposal', 'Dosen::validasiProposal', ['as' => 'dosen.validasi.proposal'], ['filter' => 'permission:Dosen Pembimbing']);
		$routes->post('Proposal', 'Dosen::tambahvalidasiProposal');
		$routes->get('TugasAkhir', 'Dosen::validasiTugasAkhir', ['as' => 'dosen.validasi.tugasAkhir'], ['filter' => 'permission:Dosen Pembimbing']);
		$routes->post('TugasAkhir', 'Dosen::tambahvalidasiTugasAkhir');
	});
	$routes->group("UjiSeminar", ['filter' => 'permission:Dosen Penguji'], function ($routes) {
		$routes->get('Download/(:num)/(:num)/(:alpha)/(:num)', 'Dosen::downloadUji/$1/$2/$3/$4');
		$routes->get('Proposal', 'Dosen::ujiProposal', ['as' => 'dosen.uji.proposal']);
		$routes->post('Proposal', 'Dosen::tambahUjiProposal');
		$routes->get('TugasAkhir', 'Dosen::ujiTugasAkhir', ['as' => 'dosen.uji.tugasakhir']);
		$routes->post('TugasAkhir', 'Dosen::tambahUjiTugasAkhir');
	});
	$routes->group("TugasAkhir", function ($routes) {
		$routes->get('downloadBimbingan/(:num)/(:num)/(:alpha)/(:num)', 'Mahasiswa::downloadBimbingan/$1/$2/$3/$4');
		$routes->get('downloadBimbingan/(:num)/(:num)/(:alpha)/(:num)/(:num)', 'Mahasiswa::downloadBimbingan/$1/$2/$3/$4/$5');
	});
	$routes->group("Jadwal", function ($routes) {
		$routes->get('SeminarProposal', 'Dosen::jadwalSeminarProposal', ['as' => 'dosen.jadwal.seminarProposal']);
		$routes->get('SeminarTugasAkhir', 'Dosen::jadwalSeminarTugasAkhir', ['as' => 'dosen.jadwal.seminarTugasAkhir']);
	});
});

$routes->group("Prodi", ['filter' => 'permission:Kaprodi'], function ($routes) {
	$routes->group("Validasi", function ($routes) {
		$routes->get('Judul', 'Prodi::validasiJudul', ['as' => 'prodi.validasi.judul']);
		$routes->get('Judul/(:alpha)/(:alpha)/(:num)/(:alpha)', 'Prodi::tambahvalidasiJudul/$1/$2/$3/$4');
	});
	$routes->group("Jadwal", function ($routes) {
		$routes->get('SeminarProposal', 'Prodi::jadwalSeminarProposal', ['as' => 'prodi.jadwal.seminarProposal']);
		$routes->post('SeminarProposal', 'Prodi::tambahjadwalSeminarProposal');
		$routes->get('SeminarTugasAkhir', 'Prodi::jadwalSeminarTugasAkhir', ['as' => 'prodi.jadwal.seminarTugasAkhir']);
		$routes->post('SeminarTugasAkhir', 'Prodi::tambahjadwalSeminarTugasAkhir');
	});
	$routes->group("BA", function ($routes) {
		$routes->get('Download/(:num)/(:num)/(:alpha)/(:num)', 'Prodi::downloadUji/$1/$2/$3/$4');
		$routes->get('downloadBimbingan/(:num)/(:num)/(:alpha)/(:num)', 'Prodi::downloadBimbingan/$1/$2/$3/$4');
		$routes->get('downloadBimbingan/(:num)/(:num)/(:alpha)/(:num)/(:num)', 'Prodi::downloadBimbingan/$1/$2/$3/$4/$5');
		$routes->get('Proposal', 'Prodi::beritaAcaraSeminarProposal', ['as' => 'prodi.berita.proposal']);
		$routes->get('Ketentuan/(:num)/(:num)', 'Prodi::tambahKetentuan/$1/$2', ['as' => 'prodi.tambah.ketentuan']);
	});
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
