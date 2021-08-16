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
        'dosuji1_id',
        'dosuji2_id',
        'Berkas_saran_dosuji1',
        'Berkas_saran_dosuji2',
        'dosuji1_nilai',
        'dosuji2_nilai',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
