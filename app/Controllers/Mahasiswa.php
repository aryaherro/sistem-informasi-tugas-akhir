<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\JudulProposalModel;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswa;
    protected $judul;

    private function setMahasiswa()
    {
        $this->mahasiswa = (new MahasiswaModel())->asArray()->where('users_id', user_id())->first();
        $this->judul = (new JudulProposalModel())->asArray()->where('mahasiswa_id', $this->mahasiswa['id'],)->findAll();
        // dd($this->judul());
    }

    public function index()
    {
        $this->setMahasiswa();
        $data = [
            'mahasiswa' => $this->mahasiswa,
        ];
        return view('mahasiswa/profile', $data);
    }

    public function judul()
    {
        $this->setMahasiswa();
        $data = [
            'mahasiswa' => $this->mahasiswa,
            'judul'     => $this->judul,
        ];
        return view('mahasiswa/pengajuanJudulTugasAkhir', $data);
    }
    public function tambahjudul()
    {
        $this->setMahasiswa();
        $judul = new JudulProposalModel();
        $data = [
            'mahasiswa_id'  => $this->mahasiswa['id'],
            'dospem1_id'    => ((new DosenModel())->asArray()->where('nama', 'Ratna Nur Tiara Shanty,S.ST., M.Kom')->first())['id'],
            'dospem2_id'    => ((new DosenModel())->asArray()->where('nama', 'Cempaka Ananggadipa Swastyastu, S.Kom., M.Kom')->first())['id'],
            'judul'         => ($this->request->getPost())['judul'],
            'deskripsi'     => ($this->request->getPost())['deskripsi'],
        ];
        $judul->save($data);
        return redirect()->back();
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
