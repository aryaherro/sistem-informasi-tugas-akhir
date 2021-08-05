<?php

namespace App\Controllers;

class Prodi extends BaseController
{
    public function validasiJudul()
    {
        return view('prodi/validasi/judul');
    }

    public function tambahvalidasiJudul()
    {
        return redirect()->back();
    }

    public function validasiProposal()
    {
        return view('prodi/validasi/proposal');
    }

    public function tambahvalidasiProposal()
    {
        return redirect()->back();
    }

    public function validasiTugasAkhir()
    {
        return view('prodi/validasi/tugasAkhir');
    }

    public function tambahvalidasiTugasAkhir()
    {
        return redirect()->back();
    }

    public function jadwalSeminarProposal()
    {
        return view('prodi/jadwal/seminarProposal');
    }

    public function tambahjadwalSeminarProposal()
    {
        return redirect()->back();
    }

    public function jadwalSeminarTugasAkhir()
    {
        return view('prodi/jadwal/seminarTugasAkhir');
    }

    public function tambahjadwalSeminarTugasAkhir()
    {
        return redirect()->back();
    }
}
