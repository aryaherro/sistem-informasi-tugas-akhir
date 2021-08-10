<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\JudulProposalModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class Dosen extends BaseController
{
    protected $dosen;
    protected $prodi;
    protected $fakultas;
    protected $judulProposal;


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
            'person' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
        ];
        return view('profile', $data);
    }

    public function validasiJudul()
    {
        $this->setDosen();
        $this->judulProposal = [
            'dospem1' => ((new JudulProposalModel())->where('dospem1_id', $this->dosen['id'],)
                ->GroupStart()
                ->where('acc_dospem1', true)->orWhere('acc_dospem1', null)
                ->where('acc_dospem2', true)->orWhere('acc_dospem1', null)
                ->where('acc_prodi', true)->orWhere('acc_dospem1', null)
                ->groupEnd())->findAll(),
            'dospem2' => ((new JudulProposalModel())->where('dospem2_id', $this->dosen['id'],)
                ->GroupStart()
                ->where('acc_dospem1', true)->orWhere('acc_dospem1', null)
                ->where('acc_dospem2', true)->orWhere('acc_dospem2', null)
                ->where('acc_prodi', true)->orWhere('acc_prodi', null)
                ->groupEnd())->findAll(),
        ];
        $data = [
            'person' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
            'judul' => $this->judulProposal,
            'mahasiswa' => new MahasiswaModel(),
        ];
        return view('dosen/validasi/judul', $data);
    }

    public function tambahvalidasiJudul($id, $acc)
    {
        $this->setDosen();
        $judul = (new JudulProposalModel())->find($id);
        $dospem = ($judul['dospem1_id'] == $this->dosen['id']) ? "acc_dospem1" : "acc_dospem2";
        $a = true;
        if ($acc == 'A') $a = true;
        if ($acc == 'R') $a = false;

        (new JudulProposalModel())->where('id', "{$judul['id']}")->set([(($judul['dospem1_id'] == $this->dosen['id']) ? "acc_dospem1" : "acc_dospem2") => $a])->update();
        // ->save(
        //     [
        //         'id'    => $id,
        //         $dospem => $a,
        //     ],
        // );

        return redirect()->route('dosen.validasi.judul');
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
