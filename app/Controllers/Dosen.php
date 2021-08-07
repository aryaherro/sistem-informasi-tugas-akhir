<?php

namespace App\Controllers;

class Dosen extends BaseController
{
    public function index()
    {
        return view('profile');
    }

    public function validasiJudul()
    {
        return view('dosen/validasi/judul');
    }

    public function tambahvalidasiJudul()
    {
        return redirect()->back();
    }

    public function validasiProposal()
    {
        return view('dosen/validasi/proposal');
    }

    public function tambahvalidasiProposal()
    {
        return redirect()->back();
    }

    public function validasiTugasAkhir()
    {
        return view('dosen/validasi/tugasAkhir');
    }

    public function tambahvalidasiTugasAkhir()
    {
        return redirect()->back();
    }

    public function validasiNilai()
    {
        return view('dosen/validasi/nilai');
    }

    public function tambahvalidasiNilai()
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
