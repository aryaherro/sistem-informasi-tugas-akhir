<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TugasAkhir extends Migration
{
	public function up()
	{
		/*
         * Fakultas
         */
		$this->forge->addField([
			'id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'nama'			=> ['type' => 'varchar', 'constraint' => 255],
			'created_at'	=> ['type' => 'datetime', 'null' => true],
			'updated_at'	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'	=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('nama');

		$this->forge->createTable('fakultas', true);

		/*
         * Prodi
         */
		$this->forge->addField([
			'id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'nama'			=> ['type' => 'varchar', 'constraint' => 255],
			'fakultas_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'	=> ['type' => 'datetime', 'null' => true],
			'updated_at'	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'	=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('nama');
		$this->forge->addForeignKey('fakultas_id', 'fakultas', 'id', '', 'CASCADE');

		$this->forge->createTable('prodi', true);

		/*
         * Dosen
         */
		$this->forge->addField([
			'id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'users_id'		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'nama'			=> ['type' => 'varchar', 'constraint' => 255],
			'nik'			=> ['type' => 'varchar', 'constraint' => 255],
			'nip'			=> ['type' => 'varchar', 'constraint' => 255],
			'jk'			=> ['type' => 'char', 'null' => true],
			'tgl_lahir'		=> ['type' => 'datetime', 'null' => true],
			'tmpt_lahir'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'alamat'		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'no_telp'		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'agama'			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'	=> ['type' => 'datetime', 'null' => true],
			'updated_at'	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'	=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('users_id');
		$this->forge->addUniqueKey('nip');
		$this->forge->addForeignKey('users_id', 'users', 'id', '', 'CASCADE');

		$this->forge->createTable('dosen', true);

		/*
         * Mahasiswa
         */
		$this->forge->addField([
			'id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'users_id'		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'nama'			=> ['type' => 'varchar', 'constraint' => 255],
			'nik'			=> ['type' => 'varchar', 'constraint' => 255],
			'nim'			=> ['type' => 'varchar', 'constraint' => 255],
			'jk'			=> ['type' => 'char', 'null' => true],
			'tgl_lahir'		=> ['type' => 'datetime', 'null' => true],
			'tmpt_lahir'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'alamat'		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'no_telp'		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'agama'			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'prodi_id'		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'	=> ['type' => 'datetime', 'null' => true],
			'updated_at'	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'	=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('users_id');
		$this->forge->addUniqueKey('nim');
		$this->forge->addForeignKey('users_id', 'users', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('prodi_id', 'prodi', 'id', '', 'CASCADE');

		$this->forge->createTable('mahasiswa', true);

		/*
         * Judul Proposal
         */
		$this->forge->addField([
			'id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'mahasiswa_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'dospem1_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'dospem2_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'judul'			=> ['type' => 'varchar', 'constraint' => 255],
			'deskripsi'		=> ['type' => 'varchar', 'constraint' => 255],
			'acc_dospem1'	=> ['type' => 'tinyint', 'constraint' => 1, 'null' => true],
			'acc_dospem2'	=> ['type' => 'tinyint', 'constraint' => 1, 'null' => true],
			'acc_prodi'		=> ['type' => 'tinyint', 'constraint' => 1, 'null' => true],
			'created_at'	=> ['type' => 'datetime', 'null' => true],
			'updated_at'	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'	=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('judul');
		$this->forge->addForeignKey('mahasiswa_id', 'mahasiswa', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('dospem1_id', 'dosen', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('dospem2_id', 'dosen', 'id', '', 'CASCADE');

		$this->forge->createTable('judulProposal', true);

		/*
		 * Bimbingan Proposal
		 */
		$this->forge->addField([
			'id'				=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'judulProposal_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'Deskripsi'			=> ['type' => 'varchar', 'constraint' => 255],
			'created_at'		=> ['type' => 'datetime', 'null' => true],
			'updated_at'		=> ['type' => 'datetime', 'null' => true],
			'deleted_at'		=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('judul');
		$this->forge->addForeignKey('judulProposal_id', 'judulProposal', 'id', '', 'CASCADE');

		$this->forge->createTable('judulProposal', true);
	}

	public function down()
	{
		//
	}
}
