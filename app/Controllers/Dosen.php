<?php

namespace App\Controllers;

class Dosen extends BaseController
{
    public function index()
    {
        return view('dosen/profile');
    }

    public function validasiJudul()
    {
        return view('dosen/validasi/judul');
    }

    public function validasiProposal()
    {
        return view('dosen/validasi/proposal');
    }

    public function validasiTugasAkhir()
    {
        return view('dosen/validasi/tugasAkhir');
    }

    public function validasiNilai()
    {
        return view('dosen/validasi/nilai');
    }

    public function jadwalSeminarProposal()
    {
        return view('dosen/jadwal/seminarProposal');
    }

    public function jadwalSeminarTugasAkhir()
    {
        return view('dosen/jadwal/seminarTugasAkhir');
    }
}
