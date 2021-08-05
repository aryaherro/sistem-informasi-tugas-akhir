<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use Config\Database;

class TugasAkhir extends Migration
{
	public function up()
	{
		/*
         * Users
         */
		$this->forge->addField([
			'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'email'            => ['type' => 'varchar', 'constraint' => 255],
			'username'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
			'password_hash'    => ['type' => 'varchar', 'constraint' => 255],
			'reset_hash'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'reset_at'         => ['type' => 'datetime', 'null' => true],
			'reset_expires'    => ['type' => 'datetime', 'null' => true],
			'activate_hash'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'status'           => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'status_message'   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'active'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
			'force_pass_reset' => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
			'created_at'       => ['type' => 'datetime', 'null' => true],
			'updated_at'       => ['type' => 'datetime', 'null' => true],
			'deleted_at'       => ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('email');
		$this->forge->addUniqueKey('username');

		$this->forge->createTable('users', true);

		/*
         * Auth Login Attempts
         */
		$this->forge->addField([
			'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'ip_address' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'email'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true], // Only for successful logins
			'date'       => ['type' => 'datetime'],
			'success'    => ['type' => 'tinyint', 'constraint' => 1],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey('email');
		$this->forge->addKey('user_id');
		// NOTE: Do NOT delete the user_id or email when the user is deleted for security audits
		$this->forge->createTable('auth_logins', true);

		/*
         * Auth Tokens
         * @see https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence
         */
		$this->forge->addField([
			'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'selector'        => ['type' => 'varchar', 'constraint' => 255],
			'hashedValidator' => ['type' => 'varchar', 'constraint' => 255],
			'user_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'expires'         => ['type' => 'datetime'],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey('selector');
		$this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
		$this->forge->createTable('auth_tokens', true);

		/*
         * Password Reset Table
         */
		$this->forge->addField([
			'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'email'      => ['type' => 'varchar', 'constraint' => 255],
			'ip_address' => ['type' => 'varchar', 'constraint' => 255],
			'user_agent' => ['type' => 'varchar', 'constraint' => 255],
			'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at' => ['type' => 'datetime', 'null' => false],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('auth_reset_attempts', true);

		/*
         * Activation Attempts Table
         */
		$this->forge->addField([
			'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'ip_address' => ['type' => 'varchar', 'constraint' => 255],
			'user_agent' => ['type' => 'varchar', 'constraint' => 255],
			'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at' => ['type' => 'datetime', 'null' => false],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('auth_activation_attempts', true);

		/*
         * Groups Table
         */
		$fields = [
			'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'name'        => ['type' => 'varchar', 'constraint' => 255],
			'description' => ['type' => 'varchar', 'constraint' => 255],
		];

		$this->forge->addField($fields);
		$this->forge->addKey('id', true);
		$this->forge->createTable('auth_groups', true);

		/*
         * Permissions Table
         */
		$fields = [
			'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'name'        => ['type' => 'varchar', 'constraint' => 255],
			'description' => ['type' => 'varchar', 'constraint' => 255],
		];

		$this->forge->addField($fields);
		$this->forge->addKey('id', true);
		$this->forge->createTable('auth_permissions', true);

		/*
         * Groups/Permissions Table
         */
		$fields = [
			'group_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
			'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
		];

		$this->forge->addField($fields);
		$this->forge->addKey(['group_id', 'permission_id']);
		$this->forge->addForeignKey('group_id', 'auth_groups', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', '', 'CASCADE');
		$this->forge->createTable('auth_groups_permissions', true);

		/*
         * Users/Groups Table
         */
		$fields = [
			'group_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
			'user_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
		];

		$this->forge->addField($fields);
		$this->forge->addKey(['group_id', 'user_id']);
		$this->forge->addForeignKey('group_id', 'auth_groups', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
		$this->forge->createTable('auth_groups_users', true);

		/*
         * Users/Permissions Table
         */
		$fields = [
			'user_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
			'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
		];

		$this->forge->addField($fields);
		$this->forge->addKey(['user_id', 'permission_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', '', 'CASCADE');
		$this->forge->createTable('auth_users_permissions', true);

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
         * Prodi
         */
		$this->forge->addField([
			'id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'nama'			=> ['type' => 'varchar', 'constraint' => 255],
			'fakultas_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'kaprodi_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
			'created_at'	=> ['type' => 'datetime', 'null' => true],
			'updated_at'	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'	=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addUniqueKey('nama');
		$this->forge->addForeignKey('fakultas_id', 'fakultas', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('kaprodi_id', 'dosen', 'id', '', 'CASCADE');

		$this->forge->createTable('prodi', true);

		// add prodi to dosen
		$this->forge->addColumn('dosen', [
			'prodi_id'		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'agama'],
			'CONSTRAINT dosen_prodi_id_foreign FOREIGN KEY(`prodi_id`) REFERENCES `prodi`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT',
		]);

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
			'layak_dospem1'	=> ['type' => 'tinyint', 'constraint' => 1, 'null' => true],
			'layak_dospem2'	=> ['type' => 'tinyint', 'constraint' => 1, 'null' => true],
			'layak_prodi'	=> ['type' => 'tinyint', 'constraint' => 1, 'null' => true],
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
			'id'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'judulProposal_id'		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'Deskripsi'				=> ['type' => 'varchar', 'constraint' => 255],
			'Berkas_bimbingan'		=> ['type' => 'varchar', 'constraint' => 255],
			'Berkas_saran_dospem1'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'Berkas_saran_dospem2'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'			=> ['type' => 'datetime', 'null' => true],
			'updated_at'			=> ['type' => 'datetime', 'null' => true],
			'deleted_at'			=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('judulProposal_id', 'judulProposal', 'id', '', 'CASCADE');

		$this->forge->createTable('bimbinganProposal', true);

		/*
		 * Jadwal Seminar Proposal
		 */
		$this->forge->addField([
			'id'				=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'judulProposal_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'jadwal'			=> ['type' => 'datetime', 'null' => true],
			'created_at'		=> ['type' => 'datetime', 'null' => true],
			'updated_at'		=> ['type' => 'datetime', 'null' => true],
			'deleted_at'		=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('judulProposal_id', 'judulProposal', 'id', '', 'CASCADE');

		$this->forge->createTable('jadwalSeminarProposal', true);

		/*
		 * Berita Acara Seminar Proposal
		 */
		$this->forge->addField([
			'id'						=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'jadwalSeminarProposal_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'ketentuan'					=> ['type' => 'tinyint', 'constraint' => 1, 'null' => true],
			'created_at'				=> ['type' => 'datetime', 'null' => true],
			'updated_at'				=> ['type' => 'datetime', 'null' => true],
			'deleted_at'				=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('jadwalSeminarProposal_id', 'jadwalSeminarProposal', 'id', '', 'CASCADE');

		$this->forge->createTable('beritaAcaraSeminarProposal', true);

		/*
         * Judul Tugas Akhir
         */
		$this->forge->addField([
			'id'								=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'judulProposal_id'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'beritaAcaraSeminarProposal_id'		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'						=> ['type' => 'datetime', 'null' => true],
			'updated_at'						=> ['type' => 'datetime', 'null' => true],
			'deleted_at'						=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('judulProposal_id', 'judulProposal', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('beritaAcaraSeminarProposal_id', 'beritaAcaraSeminarProposal', 'id', '', 'CASCADE');

		$this->forge->createTable('judulTugasAkhir', true);

		/*
		 * Bimbingan Tugas Akhir
		 */
		$this->forge->addField([
			'id'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'judulTugasAkhir_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'Deskripsi'				=> ['type' => 'varchar', 'constraint' => 255],
			'Berkas_bimbingan'		=> ['type' => 'varchar', 'constraint' => 255],
			'Berkas_saran_dospem1'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'Berkas_saran_dospem2'	=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'created_at'			=> ['type' => 'datetime', 'null' => true],
			'updated_at'			=> ['type' => 'datetime', 'null' => true],
			'deleted_at'			=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('judulTugasAkhir_id', 'judulTugasAkhir', 'id', '', 'CASCADE');

		$this->forge->createTable('bimbinganTugasAkhir', true);

		/*
		 * Jadwal Seminar Tugas Akhir
		 */
		$this->forge->addField([
			'id'					=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'judulTugasAkhir_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'jadwal'				=> ['type' => 'datetime', 'null' => true],
			'created_at'			=> ['type' => 'datetime', 'null' => true],
			'updated_at'			=> ['type' => 'datetime', 'null' => true],
			'deleted_at'			=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('judulTugasAkhir_id', 'judulTugasAkhir', 'id', '', 'CASCADE');

		$this->forge->createTable('jadwalSeminarTugasAkhir', true);

		/*
		 * Berita Acara Seminar Tugas Akhir
		 */
		$this->forge->addField([
			'id'							=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'jadwalSeminarTugasAkhir_id'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'ketentuan'						=> ['type' => 'tinyint', 'constraint' => 1, 'null' => true],
			'nilai'							=> ['type' => 'int', 'constraint' => 2, 'null' => true],
			'created_at'					=> ['type' => 'datetime', 'null' => true],
			'updated_at'					=> ['type' => 'datetime', 'null' => true],
			'deleted_at'					=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('jadwalSeminarTugasAkhir_id', 'jadwalSeminarTugasAkhir', 'id', '', 'CASCADE');

		$this->forge->createTable('beritaAcaraSeminarTugasAkhir', true);
	}

	public function down()
	{
		//
	}
}
