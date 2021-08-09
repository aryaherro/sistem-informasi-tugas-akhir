<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\ProdiModel;

class Dosen extends BaseController
{
    protected $dosen;
    protected $prodi;
    protected $fakultas;


    private function setDosen()
    {
        $this->dosen = (new DosenModel())->asArray()->where('users_id', user_id())->first();
        $this->prodi = (new ProdiModel())->find($this->dosen['prodi_id']);
        $this->fakultas = (new FakultasModel())->find($this->prodi['fakultas_id']);
    }

    public function index()
    {
        $this->setDosen();
        $data = [
            'dosen' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
        ];
        return view('profile', $data);
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
