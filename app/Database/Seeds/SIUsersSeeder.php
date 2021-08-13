<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SIUsersSeeder extends Seeder
{
	public function run()
	{
		// Tabel Auth Groups
		$data_groups =
			[
				[
					'name'			=> 'Dosen',
					'description'	=> 'Mengelompokkan Dosen menjadi satu',
				],
				[
					'name'			=> 'Mahasiswa',
					'description'	=> 'Mengelompokkan Mahasiswa menjadi satu',
				],
			];
		foreach ($data_groups as $key) {
			$this->db->table('auth_groups')->insert($key);
		}
		// Tabel Auth Groups Done

		// Tabel Auth Permissions
		$data_permissions =
			[
				[
					'name'			=> 'Kaprodi',
					'description'	=> 'Memberi permissions kepada Dosen sebagai Kaprodi, agar memiliki akses lebih',
				],
				[
					'name'			=> 'Dosen Pembimbing',
					'description'	=> 'Memberi permissions kepada Dosen agar bisa membimbing Mahasiswa yang mengajukan Proposal Tugas Akhir',
				],
				[
					'name'			=> 'Dosen Penguji',
					'description'	=> 'Memberi permissions kepada Dosen agar bisa menguji Mahasiswa yang mengajukan Proposal Tugas Akhir',
				],
			];
		foreach ($data_permissions as $key) {
			$this->db->table('auth_permissions')->insert($key);
		}
		// Tabel Auth Permissions Done

		// Tabel Users
		$data_user =
			[
				[
					'email'            => 'edi_prihartono@unitomo.ac.id',
					'username'         => 'ediprihartono',
					'password_hash'    => '$2y$10$B/iLh8cseJ0Vo/VGATvmQ.KhwXoi8fb3QzzQviU4CUhr.SagvyH8.',
					'active'           => 1
				],
				[
					'email'            => 'ratna_nur_tiara_shanty@unitomo.ac.id',
					'username'         => 'ratnanur',
					'password_hash'    => '$2y$10$xnNrjy3Sfo4UFVmlz1Q6Out7xqaxufUIk5PaPJz0zeeu.AqNalGyq',
					'active'           => 1
				],
				[
					'email'            => 'cempaka_Ananggadipa_swastyastu@unitomo.ac.id',
					'username'         => 'cempakaananggadipa',
					'password_hash'    => '$2y$10$7t8Zkp61E7PSIjBtNL1edO/uGOpSeze7S81wm/duy1q781/kmf3r6',
					'active'           => 1
				],
				[
					'email'            => 'anik_vega_vitianingsih@unitomo.ac.id',
					'username'         => 'anikvega',
					'password_hash'    => '$2y$10$8eljzrXZCB9EwKK2CLgjFeZyoI8cq5Vj.Bi1yy/5xAyUA4iAyX7mi',
					'active'           => 1
				],
				[
					'email'            => 'lambang_probo_sumirat@unitomo.ac.id',
					'username'         => 'lambangprobo',
					'password_hash'    => '$2y$10$BUcaVtKOxXrHjOF40p3Pgef0GOPI9l9D9qar.BE.kZIpbtJ0nSn5.',
					'active'           => 1
				],
				[
					'email'            => 'syaiful_hidayat@unitomo.ac.id',
					'username'         => 'syaifulhidayat',
					'password_hash'    => '$2y$10$6QqiHgQfLBvqTwK52DhsIO.DbsDe/b3u5g4ZzjYKnUWzWkwJMw9qe',
					'active'           => 1
				],
				[
					'email'            => 'wahyu_suci_oktaviani@gmail.com',
					'username'         => 'wahyusuci',
					'password_hash'    => '$2y$10$oJh5GkfagYArfAISPqMB8esBJkvL99OkewJfYwH7uvt7RCCj8sVPi',
					'active'           => 1
				],
				[
					'email'            => 'qoirudin@gmail.com',
					'username'         => 'qoirudin',
					'password_hash'    => '$2y$10$p2ntJaD/emzNGpN.ToTU5Odvkn9Is80KYFzmFr4VQKJeYCLlRHVnK',
					'active'           => 1
				],
				[
					'email'            => 'yasmine_novtiristya@gmail.com',
					'username'         => 'yasminenov',
					'password_hash'    => '$2y$10$XxhID4fTiYhrvB0l8Rw31ehz8XtJzTKU2yTsKqAkpfhTCWpTOEc96',
					'active'           => 1
				],
				[
					'email'            => 'aryaherro@yahoo.co.id',
					'username'         => 'aryaherro',
					'password_hash'    => '$2y$10$gdosi4xfK8emxxx8j8NTROeJlpexhyZ9qYsGt8wvdjhcOs.GtRmrq',
					'active'           => 1
				]
			];
		foreach ($data_user as $key) {
			$this->db->table('users')->insert($key);
		}
		// tabel users done

		// Tabel auth_groups_users
		$data_auth_groups_users =
			[
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Dosen")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "ediprihartono")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Dosen")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "ratnanur")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Dosen")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "cempakaananggadipa")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Dosen")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "anikvega")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Dosen")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "lambangprobo")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Dosen")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "syaifulhidayat")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Mahasiswa")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "wahyusuci")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Mahasiswa")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "qoirudin")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Mahasiswa")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "yasminenov")->get()->getFirstRow())->id,
				],
				[
					'group_id'	=> ($this->db->table('auth_groups')->where("name", "Mahasiswa")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "aryaherro")->get()->getFirstRow())->id,
				],
			];
		foreach ($data_auth_groups_users as $key) {
			$this->db->table('auth_groups_users')->insert($key);
		}
		// tabel auth_groups_users done

		// Tabel auth_users_permissions
		$data_auth_users_permissions =
			[
				[
					'permission_id'	=> ($this->db->table('auth_permissions')->where("name", "Kaprodi")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "ediprihartono")->get()->getFirstRow())->id,
				],
				[
					'permission_id'	=> ($this->db->table('auth_permissions')->where("name", "Dosen Pembimbing")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "ediprihartono")->get()->getFirstRow())->id,
				],
				[
					'permission_id'	=> ($this->db->table('auth_permissions')->where("name", "Dosen Penguji")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "ediprihartono")->get()->getFirstRow())->id,
				],
				[
					'permission_id'	=> ($this->db->table('auth_permissions')->where("name", "Dosen Pembimbing")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "ratnanur")->get()->getFirstRow())->id,
				],
				[
					'permission_id'	=> ($this->db->table('auth_permissions')->where("name", "Dosen Pembimbing")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "cempakaananggadipa")->get()->getFirstRow())->id,
				],
				[
					'permission_id'	=> ($this->db->table('auth_permissions')->where("name", "Dosen Penguji")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "anikvega")->get()->getFirstRow())->id,
				],
				[
					'permission_id'	=> ($this->db->table('auth_permissions')->where("name", "Dosen Penguji")->get()->getFirstRow())->id,
					'user_id'         => ($this->db->table('users')->where("username", "lambangprobo")->get()->getFirstRow())->id,
				],
			];
		foreach ($data_auth_users_permissions as $key) {
			$this->db->table('auth_users_permissions')->insert($key);
		}
		// tabel auth_users_permissions done

		// Tabel Fakultas 
		$data_fakultas =
			[
				[
					"nama"	=> "Ilmu Administrasi",
				],
				[
					"nama"	=> 'Pertanian',
				],
				[
					"nama"	=> 'Keguruan dan Ilmu Pendidikan',
				],
				[
					"nama"	=> 'Ekonomi dan Bisnis',
				],
				[
					"nama"	=> 'Teknik',
				],
				[
					"nama"	=> 'Sastra',
				],
				[
					"nama"	=> 'Ilmu Komunikasi',
				],
				[
					"nama"	=> 'Hukum',
				],
				[
					"nama"	=> 'Ilmu Kesehatan',
				],
			];
		foreach ($data_fakultas as $key) {
			$this->db->table('fakultas')->insert($key);
		}
		// Tabel Fakultas Done

		// Tabel Dosen
		$data_dosen =
			[
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'ediprihartono')->get()->getFirstRow())->id,
					'nama'	=> 'Edi Prihartono, S.Kom.,MT',
					'nik'	=> '0728057202',
					'nip'	=> '0728057202',
					'jk'	=> 'L',
				],
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'ratnanur')->get()->getFirstRow())->id,
					'nama'	=> 'Ratna Nur Tiara Shanty,S.ST., M.Kom',
					'nik'	=> '0715048901',
					'nip'	=> '0715048901',
					'jk'	=> 'P',
				],
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'cempakaananggadipa')->get()->getFirstRow())->id,
					'nama'	=> 'Cempaka Ananggadipa Swastyastu, S.Kom., M.Kom',
					'nik'	=> '0718048301',
					'nip'	=> '0718048301',
					'jk'	=> 'P',
				],
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'anikvega')->get()->getFirstRow())->id,
					'nama'	=> 'Anik Vega Vitianingsih, S. Kom., MT',
					'nik'	=> '0704017101',
					'nip'	=> '0704017101',
					'jk'	=> 'P',
				],
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'lambangprobo')->get()->getFirstRow())->id,
					'nama'	=> 'Lambang Probo Sumirat, S.Kom., M.Kom',
					'nik'	=> '0712067201',
					'nip'	=> '0712067201',
					'jk'	=> 'L',
				],
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'syaifulhidayat')->get()->getFirstRow())->id,
					'nama'	=> 'Syaiful Hidayat, S.Kom., M.Kom',
					'nik'	=> '0729098302',
					'nip'	=> '0729098302',
					'jk'	=> 'L',
				],
			];
		foreach ($data_dosen as $key) {
			$this->db->table('dosen')->insert($key);
		}
		// Tabel Dosen Done

		// Tabel Prodi 
		$data_prodi =
			[
				// Ilmu Administrasi
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", "Ilmu Administrasi")->get()->getFirstRow())->id,
					"nama"		=> 'Ilmu Administrasi Niaga',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", "Ilmu Administrasi")->get()->getFirstRow())->id,
					"nama"	=> 'Ilmu administrasi Negara',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", "Ilmu Administrasi")->get()->getFirstRow())->id,
					"nama"	=> 'Kesekertariat',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", "Ilmu Administrasi")->get()->getFirstRow())->id,
					"nama"	=> 'Magister Ilmu Administrasi',
				],
				// Pertanian
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Pertanian')->get()->getFirstRow())->id,
					"nama"	=> 'Teknologi Pangan',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Pertanian')->get()->getFirstRow())->id,
					"nama"	=> 'Budidaya Perairan',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Pertanian')->get()->getFirstRow())->id,
					"nama"	=> 'Pemanfaatan Sumber Daya Perikanan',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Pertanian')->get()->getFirstRow())->id,
					"nama"	=> 'Agrobisnis Perikanan',
				],
				// Keguruan dan Ilmu Pendidikan
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Keguruan dan Ilmu Pendidikan')->get()->getFirstRow())->id,
					"nama"	=> 'Pendidikan Bahasa dan Sastra Indonesia',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Keguruan dan Ilmu Pendidikan')->get()->getFirstRow())->id,
					"nama"	=> 'Pendidikan Matematika',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Keguruan dan Ilmu Pendidikan')->get()->getFirstRow())->id,
					"nama"	=> 'Magister Pendidikan Bahasa Indonesia',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Keguruan dan Ilmu Pendidikan')->get()->getFirstRow())->id,
					"nama"	=> 'Magister Teknologi Pendidikan',
				],
				// Ekonomi dan Bisnis
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Ekonomi dan Bisnis')->get()->getFirstRow())->id,
					"nama"	=> 'Ekonomi Pembangunan',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Ekonomi dan Bisnis')->get()->getFirstRow())->id,
					"nama"	=> 'Manajemen',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Ekonomi dan Bisnis')->get()->getFirstRow())->id,
					"nama"	=> 'Akuntansi',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Ekonomi dan Bisnis')->get()->getFirstRow())->id,
					"nama"	=> 'Magister Manajemen',
				],
				// Teknik
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Teknik')->get()->getFirstRow())->id,
					"nama"	=> 'Teknik Sipil',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Teknik')->get()->getFirstRow())->id,
					"nama"	=> 'Teknik Informatika',
					"kaprodi_id" => ($this->db->table('dosen')->where("nama", 'Edi Prihartono, S.Kom.,MT')->get()->getFirstRow())->id,
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Teknik')->get()->getFirstRow())->id,
					"nama"	=> 'Teknik Geomatika',
				],
				// Sastra
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Sastra')->get()->getFirstRow())->id,
					"nama"	=> 'Sastra Inggris',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Sastra')->get()->getFirstRow())->id,
					"nama"	=> 'Sastra Jepang',
				],
				// Ilmu Komunikasi
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Ilmu Komunikasi')->get()->getFirstRow())->id,
					"nama"	=> 'Ilmu Komunikasi',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Ilmu Komunikasi')->get()->getFirstRow())->id,
					"nama"	=> 'Magister Ilmu Komunikasi',
				],
				// Hukum
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Hukum')->get()->getFirstRow())->id,
					"nama"	=> 'Ilmu Hukum',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Hukum')->get()->getFirstRow())->id,
					"nama"	=> 'Magister Ilmu Hukum',
				],
				// Ilmu Kesehatan
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Ilmu Kesehatan')->get()->getFirstRow())->id,
					"nama"	=> 'Kebidanan',
				],
				[
					'fakultas_id'	=> ($this->db->table('fakultas')->where("nama", 'Ilmu Kesehatan')->get()->getFirstRow())->id,
					"nama"	=> 'Teknologi Bank Darah',
				],
			];
		foreach ($data_prodi as $key) {
			$this->db->table('prodi')->insert($key);
		}
		// Tabel Prodi Done

		// Tabel Mahasiswa
		$data_mahasiswa =
			[
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'wahyusuci')->get()->getFirstRow())->id,
					'nama'		=> 'Wahyu Suci Oktaviani',
					'nik'		=> '2018420007',
					'nim'		=> '2018420007',
					'jk'		=> 'P',
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'qoirudin')->get()->getFirstRow())->id,
					'nama'		=> 'Qoirudin',
					'nik'		=> '2018420014',
					'nim'		=> '2018420014',
					'jk'		=> 'L',
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'yasminenov')->get()->getFirstRow())->id,
					'nama'		=> 'Yasmine Novtiristya',
					'nik'		=> '2018420097',
					'nim'		=> '2018420097',
					'jk'		=> 'P',
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
				[
					'users_id'	=> ($this->db->table('users')->where('username', 'aryaherro')->get()->getFirstRow())->id,
					'nama'		=> 'R. Arya Herro Kusuma Buditama',
					'nik'		=> '2018420117',
					'nim'		=> '2018420117',
					'jk'		=> 'L',
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
			];
		foreach ($data_mahasiswa as $key) {
			$this->db->table('mahasiswa')->insert($key);
		}
		// Tabel Mahasiswa Done
	}
}
