<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalSeminarProposalModel extends Model
{
    protected $table      = 'jadwalSeminarProposal';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields =
    [
        'judulProposal_id',
        'jadwal',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
