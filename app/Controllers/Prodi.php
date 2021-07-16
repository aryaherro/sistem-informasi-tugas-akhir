<?php

namespace App\Controllers;

class Prodi extends BaseController
{
    public function index()
    {
        return view('prodi/profile');
    }

    public function validasiJudul()
    {
        return view('prodi/validasi/judul');
    }

    public function validasiProposal()
    {
        return view('prodi/validasi/proposal');
    }

    public function validasiTugasAkhir()
    {
        return view('prodi/validasi/tugasAkhir');
    }

    public function jadwalSeminarProposal()
    {
        return view('prodi/jadwal/seminarProposal');
    }

    public function jadwalSeminarTugasAkhir()
    {
        return view('prodi/jadwal/seminarTugasAkhir');
    }
}
