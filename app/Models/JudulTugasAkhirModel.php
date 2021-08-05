<?php

namespace App\Models;

use CodeIgniter\Model;

class JudulTugasAkhirModel extends Model
{
    protected $table      = 'judulTugasAkhir';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields =
    [
        'judulProposal_id',
        'beritaAcaraSeminarProposal_id',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
