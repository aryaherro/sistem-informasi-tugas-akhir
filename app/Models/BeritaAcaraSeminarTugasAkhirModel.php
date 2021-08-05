<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaAcaraSeminarTugasAkhirModel extends Model
{
    protected $table      = 'beritaAcaraSeminarTugasAkhir';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields =
    [
        'jadwalSeminarTugasAkhir_id',
        'ketentuan',
        'nilai',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
