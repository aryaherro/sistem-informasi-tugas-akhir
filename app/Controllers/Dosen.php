<?php

namespace App\Controllers;

class Dosen extends BaseController
{
    public function index()
    {
        return view('dosen/profile');
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
