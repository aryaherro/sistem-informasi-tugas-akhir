<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\JadwalSeminarProposalModel;
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
        $this->setDosen();
        $judulProposal = (new JudulProposalModel())
            ->groupStart()
            ->Where('layak_dospem1', true)
            ->Where('layak_dospem2', true)
            ->Where('layak_prodi', true)
            ->groupEnd()
            ->findAll();
        $this->judulProposal = null;
        $i = 0;
        foreach ($judulProposal as $key) {
            if ((new JadwalSeminarProposalModel())->asArray()->where('judulProposal_id', $key['id'])->first() == null) {
                $this->judulProposal['$i'] = $key;
                $i++;
            }
        }
        $jadwalSeminarProposal = (new JadwalSeminarProposalModel())->findAll();
        $list_jadwal_seminar_proposal = null;
        $i = 0;
        foreach ($jadwalSeminarProposal as $jsp) {
            $judulProposal = (new JudulProposalModel())->find($jsp['judulProposal_id']);
            $mahasiswa = (new MahasiswaModel())->find($judulProposal['mahasiswa_id']);
            if ($mahasiswa['prodi_id'] == $this->prodi['id']) {
                $list_jadwal_seminar_proposal[$i] = $jsp;
                $i++;
            }
        }
        $data = [
            'person' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
            'judul' => $this->judulProposal,
            'list_jadwal' => $list_jadwal_seminar_proposal,
            'jud' => new JudulProposalModel(),
            'mahasiswa' => new MahasiswaModel(),
        ];
        return view('prodi/jadwal/seminarProposal', $data);
    }

    public function tambahjadwalSeminarProposal()
    {
        $this->setDosen();
        $this->judulProposal = (new JudulProposalModel())->find($this->request->getPost('judulProposal_id'));
        $data = [
            'judulProposal_id'  =>  $this->judulProposal['id'],
            'jadwal' => $this->request->getPost('tgl_seminar'),
        ];
        (new JadwalSeminarProposalModel())->save($data);
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
