<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\JudulProposalModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class Prodi extends BaseController
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

    public function validasiJudul()
    {
        $this->setDosen();
        $judulProposal = (new JudulProposalModel())->findAll();
        // dd($judulProposal); kaprodi_id
        $urut = 0;
        for ($i = 0; $i < count($judulProposal); $i++) {
            $mahasiswa = (new MahasiswaModel())->find($judulProposal[$i]['mahasiswa_id']);
            $prodi = (new ProdiModel())->find($mahasiswa['prodi_id']);
            if (($judulProposal[$i]['acc_dospem1'] == 1) && ($judulProposal[$i]['acc_dospem2'] == 1) && ($judulProposal[$i]['acc_prodi'] == null) && ($prodi['kaprodi_id'] == $this->dosen['id'])) {
                // if (($judulProposal[$i]['dospem1_id'] == $this->dosen['id']) || ($judulProposal[$i]['dospem2_id'] == $this->dosen['id'])) {
                $this->judulProposal[$urut] = $judulProposal[$i];
                $urut++;
                // }
            }
        }
        $data = [
            'person' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
            'judul' => $this->judulProposal,
            'mahasiswa' => new MahasiswaModel(),
        ];
        return view('prodi/validasi/judul', $data);
    }

    public function tambahvalidasiJudul($id, $acc)
    {
        $this->setDosen();
        // $judul = (new JudulProposalModel())->find($id);
        if ($acc == 'A') $a = true;
        if ($acc == 'R') $a = false;

        (new JudulProposalModel())
            ->where('id', $id)
            ->set(["acc_prodi" => $a])
            ->update();
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
