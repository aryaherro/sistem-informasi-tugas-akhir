<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswa;

    public function index()
    {
        $this->mahasiswa = new MahasiswaModel();
        $data = [
            'mahasiswa' => $this->mahasiswa->asArray()->where('users_id', user_id())->find(),
        ];
        return view('mahasiswa/profile', $data);
    }

    public function judul()
    {
        return view('mahasiswa/pengajuanJudulTugasAkhir');
    }

    public function bimbinganProposal()
    {
        return view('mahasiswa/bimbinganProposalTugasAkhir');
    }

    public function bimbinganTugasAkhir()
    {
        return view('mahasiswa/bimbinganTugasAkhir');
    }

    public function jadwalSeminarProposal()
    {
        return view('mahasiswa/jadwal/seminarProposal');
    }

    public function jadwalSeminarTugasAkhir()
    {
        return view('mahasiswa/jadwal/seminarTugasAkhir');
    }
}
