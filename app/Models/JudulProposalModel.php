<?php

namespace App\Models;

use CodeIgniter\Model;

class JudulProposalModel extends Model
{
    protected $table      = 'judulProposal';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields =
    [
        'mahasiswa_id',
        'dospem1_id',
        'dospem2_id',
        'judul',
        'deskripsi',
        'Berkas_judul',
        'acc_dospem1',
        'acc_dospem2',
        'acc_prodi',
        'layak_dospem1',
        'layak_dospem2',
        'layak_prodi',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
