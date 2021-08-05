<?php

namespace App\Models;

use CodeIgniter\Model;

class BimbinganProposalModel extends Model
{
    protected $table      = 'bimbinganProposal';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields =
    [
        'judulProposal_id',
        'Deskripsi',
        'Berkas_bimbingan',
        'Berkas_saran_dospem1',
        'Berkas_saran_dospem2',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
