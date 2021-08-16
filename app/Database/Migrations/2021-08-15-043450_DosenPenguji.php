<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DosenPenguji extends Migration
{
	public function up()
	{
		// add dosen penguji on berita acara seminar proposal
		$this->forge->addColumn('beritaacaraseminarproposal', [
			'dosuji1_id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'jadwalSeminarProposal_id'],
			'dosuji2_id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'dosuji1_id'],
			'Berkas_saran_dosuji1'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true, 'after' => 'dosuji2_id'],
			'Berkas_saran_dosuji2'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true, 'after' => 'Berkas_saran_dosuji1'],
			'CONSTRAINT dosen_uji_1_id_proposal_foreign FOREIGN KEY(`dosuji1_id`) REFERENCES `dosen`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT',
			'CONSTRAINT dosen_uji_2_id_proposal_foreign FOREIGN KEY(`dosuji2_id`) REFERENCES `dosen`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT',
		]);

		// delete column nilai on berita acara seminar tugas akhir
		$this->forge->dropColumn('beritaacaraseminartugasakhir', 'nilai');

		// add dosen penguji on berita acara seminar tugas akhir
		$this->forge->addColumn('beritaacaraseminartugasakhir', [
			'dosuji1_id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'jadwalSeminarTugasAkhir_id'],
			'dosuji2_id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'dosuji1_id'],
			'Berkas_saran_dosuji1'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true, 'after' => 'dosuji2_id'],
			'Berkas_saran_dosuji2'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true, 'after' => 'Berkas_saran_dosuji1'],
			'dosuji1_nilai' 		=> ['type' => 'int', 'constraint' => 3, 'null' => true, 'after' => 'Berkas_saran_dosuji2'],
			'dosuji2_nilai' 		=> ['type' => 'int', 'constraint' => 3, 'null' => true, 'after' => 'dosuji1_nilai'],
			'CONSTRAINT dosen_uji_1_id_tugasakhir_foreign FOREIGN KEY(`dosuji1_id`) REFERENCES `dosen`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT',
			'CONSTRAINT dosen_uji_2_id_tugasakhir_foreign FOREIGN KEY(`dosuji2_id`) REFERENCES `dosen`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT',
		]);
	}

	public function down()
	{
	}
}
