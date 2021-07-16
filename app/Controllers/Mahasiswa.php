<?php

namespace App\Controllers;

class Mahasiswa extends BaseController
{
    public function index()
    {
        return view('mahasiswa/profile');
    }

    public function judul()
    {
        return view('mahasiswa/pengajuanJudulTugasAkhir');
    }

    public function bimbinganProposal()
    {
        return view('mahasiswa/bimbinganProposalTugasAkhir');
    }
}
