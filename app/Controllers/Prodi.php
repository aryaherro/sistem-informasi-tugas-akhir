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
        $judulProposal = (new JudulProposalModel())
            ->groupStart()
            ->Where('acc_dospem1', true)
            ->Where('acc_dospem2', true)
            ->Where('acc_prodi', null)
            ->orWhere('acc_prodi', true)
            ->groupEnd()
            ->findAll();
        $urut = 0;
        for ($i = 0; $i < count($judulProposal); $i++) {
            $mahasiswa = (new MahasiswaModel())->find($judulProposal[$i]['mahasiswa_id']);
            $prodi = (new ProdiModel())->find($mahasiswa['prodi_id']);
            if ($prodi['kaprodi_id'] == $this->dosen['id']) {
                $this->judulProposal[$urut] = $judulProposal[$i];
                $urut++;
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

    public function tambahvalidasiJudul($type, $id, $acc)
    {
        $this->setDosen();
        if ($acc == 'A') $a = true;
        if ($acc == 'R') $a = false;
        if ($type == 'A') $key = "acc_prodi";
        if ($type == 'L') $key = "layak_prodi";
        (new JudulProposalModel())
            ->where('id', $id)
            ->set([$key => $a])
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
