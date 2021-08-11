<?php

namespace App\Controllers;

use App\Models\BimbinganProposalModel;
use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\JudulProposalModel;
use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class Dosen extends BaseController
{
    protected $dosen;
    protected $mahasiswa;
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
        $judulProposal = (new JudulProposalModel())->where('dospem1_id', $this->dosen['id'],)->orWhere('dospem2_id', $this->dosen['id'],)->findAll();

        $urut = 0;
        for ($i = 0; $i < count($judulProposal); $i++) {
            if ((($judulProposal[$i]['acc_dospem1'] == 1) || ($judulProposal[$i]['acc_dospem1'] == null)) && (($judulProposal[$i]['acc_dospem2'] == 1) || ($judulProposal[$i]['acc_dospem2'] == null))) {
                if (($judulProposal[$i]['dospem1_id'] == $this->dosen['id']) || ($judulProposal[$i]['dospem2_id'] == $this->dosen['id'])) {
                    $this->judulProposal[$urut] = $judulProposal[$i];
                    $urut++;
                }
            }
        }
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
        if ($acc == 'A') $a = true;
        if ($acc == 'R') $a = false;

        (new JudulProposalModel())
            ->where('id', "{$judul['id']}")
            ->set([
                (($judul['dospem1_id'] == $this->dosen['id']) ? "acc_dospem1" : "acc_dospem2") => $a
            ])
            ->update();

        return redirect()->back();
    }

    public function validasiProposal()
    {
        $this->setDosen();
        $this->judulProposal = ((new JudulProposalModel())
            ->GroupStart()
            ->where('dospem1_id', $this->dosen['id'],)->orWhere('dospem2_id', $this->dosen['id'],)
            ->groupEnd()
            ->where('acc_dospem1', true)
            ->where('acc_dospem2', true)
            ->where('acc_prodi', true))->findAll();
        foreach ($this->judulProposal as $key) {
            $temp[$key['id']] = (((new BimbinganProposalModel())->where('judulProposal_id', $key['id'],))->findAll());
        }
        $this->bimbinganProposal = $temp;
        $data = [
            'person' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
            'judul' => $this->judulProposal,
            'mahasiswa' => new MahasiswaModel(),
            'bimbingan' => $this->bimbinganProposal,
        ];
        return view('dosen/validasi/proposal', $data);
    }

    public function tambahvalidasiProposal()
    {
        $this->setDosen();
        $this->mahasiswa = (new MahasiswaModel())->asArray()->where('nim', $this->request->getPost('nim'))->first();
        $judulProposal = (new JudulProposalModel())->find($this->request->getPost('jud'));
        $bimbingan = (new BimbinganProposalModel())->find($this->request->getPost('bim'));

        $berkas = $this->request->getFile('Berkas_bimbingan');
        $file_name = $berkas->getRandomName();
        if ($judulProposal['dospem1_id'] == $this->dosen['id']) $berkas_tipe = "Berkas_saran_dospem1";
        else
            if ($judulProposal['dospem2_id'] == $this->dosen['id']) $berkas_tipe = "Berkas_saran_dospem2";

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
        $berkas->move("uploads/{$this->mahasiswa['id']}/{$judulProposal['id']}/P/", $file_name);
        (new BimbinganProposalModel())
            ->where('id', $bimbingan['id'])
            ->set([
                $berkas_tipe => $file_name,
            ])
            ->update();
        return redirect()->back();
    }

    public function downloadBimbingan($mahasiswa_id, $judul_id, $type, $bimbingan_id, $sardos = null)
    {
        switch ($sardos) {
            case 1:
                $berkas = 'Berkas_saran_dospem1';
                break;

            case 2:
                $berkas = 'Berkas_saran_dospem2';
                break;

            case null:
                $berkas = 'Berkas_bimbingan';
                break;
        }
        $data = (new BimbinganProposalModel())->find($bimbingan_id);
        return $this->response->download("uploads/{$mahasiswa_id}/{$judul_id}/{$type}/" . $data[$berkas], null);
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
