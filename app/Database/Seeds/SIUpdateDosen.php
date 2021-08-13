<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SIUpdateDosen extends Seeder
{
	public function run()
	{
		// Tabel Dosen
		$data_dosen =
			[
				[
					'id'	=> ($this->db->table('dosen')->where('nama', 'Edi Prihartono, S.Kom.,MT')->get()->getFirstRow())->id,
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
				[
					'id'	=> ($this->db->table('dosen')->where('nama', 'Ratna Nur Tiara Shanty,S.ST., M.Kom')->get()->getFirstRow())->id,
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
				[
					'id'	=> ($this->db->table('dosen')->where('nama', 'Cempaka Ananggadipa Swastyastu, S.Kom., M.Kom')->get()->getFirstRow())->id,
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
				[
					'id'	=> ($this->db->table('dosen')->where('nama', 'Anik Vega Vitianingsih, S. Kom., MT')->get()->getFirstRow())->id,
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
				[
					'id'	=> ($this->db->table('dosen')->where('nama', 'Lambang Probo Sumirat, S.Kom., M.Kom')->get()->getFirstRow())->id,
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
				[
					'id'	=> ($this->db->table('dosen')->where('nama', 'Syaiful Hidayat, S.Kom., M.Kom')->get()->getFirstRow())->id,
					'prodi_id'	=> ($this->db->table('prodi')->where('nama', 'Teknik Informatika')->get()->getFirstRow())->id,
				],
			];
		foreach ($data_dosen as $key) {
			$this->db->table('dosen')->update(['prodi_id' => $key['prodi_id']], ['id' => $key['id']]);
		}
		// Tabel Dosen Done
	}
}
