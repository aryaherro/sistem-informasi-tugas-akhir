<?php

namespace App\Controllers;

use App\Models\BimbinganProposalModel;
use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\JudulProposalModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswa;
    protected $prodi;
    protected $fakultas;
    protected $judulProposal;
    protected $bimbinganProposal;

    private function setMahasiswa()
    {
        $this->mahasiswa = (new MahasiswaModel())->asArray()->where('users_id', user_id())->first();
        $this->prodi = (new ProdiModel())->find($this->mahasiswa['prodi_id']);
        $this->fakultas = (new FakultasModel())->find($this->prodi['fakultas_id']);

        $this->judulProposal = ((new JudulProposalModel())->where('mahasiswa_id', $this->mahasiswa['id'],)
            ->GroupStart()
            ->where('acc_dospem1', true)->orWhere('acc_dospem1', null)
            ->where('acc_dospem2', true)->orWhere('acc_dospem2', null)
            ->where('acc_prodi', true)->orWhere('acc_prodi', null)
            ->groupEnd())->findAll();
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
            'person' => $this->mahasiswa,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
        ];
        return view('profile', $data);
    }

    public function judul()
    {
        $this->setMahasiswa();
        $data = [
            'person' => $this->mahasiswa,
            'judul'     => $this->judulProposal,
        ];
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
            'judul'         => $this->request->getPost('judul'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ];
        $judulProposal->save($data);
        return redirect()->back();
    }

    public function bimbinganProposal()
    {
        $this->setMahasiswa();
        $data = [
            'person' => $this->mahasiswa,
            'judul'     => $this->judulProposal,
            'bimbingan' => $this->bimbinganProposal,
        ];
        return view('mahasiswa/bimbinganProposalTugasAkhir', $data);
    }

    public function tambahbimbinganProposal()
    {
        $this->setMahasiswa();
        $this->judulProposal = (new JudulProposalModel())->find($this->request->getPost('judulProposal_id'));
        $bimbinganProposal = new BimbinganProposalModel();
        $berkas = $this->request->getFile('Berkas_bimbingan');
        $file_name = $berkas->getRandomName();
        $data = [
            'Berkas_bimbingan'  => $file_name,
            'judulProposal_id'  =>  $this->judulProposal['id'],
            'Deskripsi'         => $this->request->getPost('Deskripsi'),
        ];
        if (!$this->validate([
            'Berkas_bimbingan' => [
                'rules' => 'uploaded[Berkas_bimbingan]|mime_in[Berkas_bimbingan,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.rar,text/plain,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/zip]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa doc,docx,pdf,ppt,pptx,rar,txt,xls,xlsx,zip',
                ],
            ],
        ],)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $berkas->move("uploads/{$this->mahasiswa['id']}/{$this->judulProposal['id']}/P/", $file_name);
        $bimbinganProposal->save($data);
        return redirect()->back();
    }

    public function downloadBimbingan($type, $mahasiswa_id, $judul_id, $bimbingan_id)
    {
        $data = (new BimbinganProposalModel())->find($bimbingan_id);
        return $this->response->download("uploads/{$mahasiswa_id}/{$judul_id}/{$type}" . $data['Berkas_bimbingan'], null);
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
