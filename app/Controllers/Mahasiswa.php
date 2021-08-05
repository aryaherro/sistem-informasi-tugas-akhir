<?php

namespace App\Controllers;

use App\Models\BimbinganProposalModel;
use App\Models\DosenModel;
use App\Models\JudulProposalModel;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswa;
    protected $judulProposal;
    protected $bimbinganProposal;

    private function setMahasiswa()
    {
        $this->mahasiswa = (new MahasiswaModel())->asArray()->where('users_id', user_id())->first();
        $this->judulProposal = ((new JudulProposalModel())->asArray()->where('mahasiswa_id', $this->mahasiswa['id'],))->findAll();

        $temp = array();
        foreach ($this->judulProposal as $key) {
            $temp[$key['id']] = (((new BimbinganProposalModel())->asArray()->where('judulProposal_id', $key['id'],))->findAll());
        }
        $this->bimbinganProposal = $temp;
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
            'judul'     => $this->judulProposal,
        ];
        // dd(count($this->judulProposal));
        return view('mahasiswa/pengajuanJudulTugasAkhir', $data);
    }

    public function tambahjudul()
    {
        $this->setMahasiswa();
        $judulProposal = new JudulProposalModel();
        $data = [
            'mahasiswa_id'  => $this->mahasiswa['id'],
            'dospem1_id'    => ((new DosenModel())->asArray()->where('nama', 'Ratna Nur Tiara Shanty,S.ST., M.Kom')->first())['id'],
            'dospem2_id'    => ((new DosenModel())->asArray()->where('nama', 'Cempaka Ananggadipa Swastyastu, S.Kom., M.Kom')->first())['id'],
            'judul'         => ($this->request->getPost())['judul'],
            'deskripsi'     => ($this->request->getPost())['deskripsi'],
        ];
        $judulProposal->save($data);
        return redirect()->back();
    }

    public function bimbinganProposal()
    {
        $this->setMahasiswa();
        $data = [
            'mahasiswa' => $this->mahasiswa,
            'judul'     => $this->judulProposal,
            'bimbingan' => $this->bimbinganProposal,
        ];
        return view('mahasiswa/bimbinganProposalTugasAkhir', $data);
    }

    public function tambahbimbinganProposal()
    {
        // dd(($this->request->getPost()));
        // $this->setMahasiswa();
        // $judulProposal = new JudulProposalModel();
        // $data = [
        //     'judulProposal_id' => ($this->request->getPost())['value'],
        //     'mahasiswa_id'  => $this->mahasiswa['id'],
        //     'dospem1_id'    => ((new DosenModel())->asArray()->where('nama', 'Ratna Nur Tiara Shanty,S.ST., M.Kom')->first())['id'],
        //     'dospem2_id'    => ((new DosenModel())->asArray()->where('nama', 'Cempaka Ananggadipa Swastyastu, S.Kom., M.Kom')->first())['id'],
        //     'judul'         => ($this->request->getPost())['judul'],
        //     'deskripsi'     => ($this->request->getPost())['deskripsi'],
        // ];
        // $judulProposal->save($data);
        return redirect()->back();
    }

    public function bimbinganTugasAkhir()
    {
        return view('mahasiswa/bimbinganTugasAkhir');
    }

    public function tambahbimbinganTugasAkhir()
    {
        return redirect()->back();
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
