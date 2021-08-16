<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaAcaraSeminarProposalModel extends Model
{
    protected $table      = 'beritaAcaraSeminarProposal';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields =
    [
        'jadwalSeminarProposal_id',
        'dosuji1_id',
        'dosuji2_id',
        'Berkas_saran_dosuji1',
        'Berkas_saran_dosuji2',

        'ketentuan',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
