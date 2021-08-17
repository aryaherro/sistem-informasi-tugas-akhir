<?php

namespace App\Controllers;

use App\Models\BeritaAcaraSeminarProposalModel;
use App\Models\BimbinganProposalModel;
use App\Models\BimbinganTugasAkhirModel;
use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\JadwalSeminarProposalModel;
use App\Models\JadwalSeminarTugasAkhirModel;
use App\Models\JudulProposalModel;
use App\Models\JudulTugasAkhirModel;
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
            $temp[$key['id']] = (((new BimbinganProposalModel())->where('judulProposal_id', $key['id'],))->findAll());
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
        $isi = (new BeritaAcaraSeminarProposalModel())
            ->join('jadwalseminarproposal', 'jadwalseminarproposal.id = beritaacaraseminarproposal.jadwalSeminarProposal_id')
            ->join('judulproposal', 'judulproposal.id = jadwalseminarproposal.judulProposal_id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->join('judultugasakhir', 'judulproposal.id = judultugasakhir.judulProposal_id')
            ->where('mahasiswa_id', $this->mahasiswa['id'])
            ->findAll();
        // dd($isi);
        $data = [
            'person' => $this->mahasiswa,
            'judul'     => $this->judulProposal,
            'isi'   => $isi
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
        $this->judulProposal = ((new JudulProposalModel())->where('mahasiswa_id', $this->mahasiswa['id'],)
            ->GroupStart()
            ->where('acc_dospem1', true)
            ->where('acc_dospem2', true)
            ->where('acc_prodi', true)
            ->groupEnd())->findAll();
        // dd($this->judulProposal);
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
        if ($type == 'P') $data = (new BimbinganProposalModel())->find($bimbingan_id);
        if ($type == 'T') $data = (new BimbinganTugasAkhirModel())->find($bimbingan_id);
        return $this->response->download("uploads/{$mahasiswa_id}/{$judul_id}/{$type}/" . $data[$berkas], null);
    }

    public function bimbinganTugasAkhir()
    {
        $this->setMahasiswa();
        $judul_tugas_akhir = (new JudulProposalModel())
            ->join('judultugasakhir', 'judultugasakhir.judulProposal_id = judulproposal.id')
            ->where('mahasiswa_id', $this->mahasiswa['id'],)
            ->findAll();
        $temp = array();
        foreach ($judul_tugas_akhir as $key) {
            $temp[$key['id']] = (new BimbinganTugasAkhirModel())
                ->where('judulTugasAkhir_id', $key['id'])
                ->findAll();
        }
        $bimbingan_tugas_akhir = $temp;
        // dd($bimbingan_tugas_akhir);
        $data = [
            'person' => $this->mahasiswa,
            'judul'     => $judul_tugas_akhir,
            'bimbingan' => $bimbingan_tugas_akhir,
        ];
        return view('mahasiswa/bimbinganTugasAkhir', $data);
    }

    public function tambahbimbinganTugasAkhir()
    {
        $this->setMahasiswa();
        $judul_tugas_akhir = (new JudulTugasAkhirModel())->find($this->request->getPost('judulTugasAkhir_id'));
        $bimbingan_tugas_akhir = new BimbinganTugasAkhirModel();
        $berkas = $this->request->getFile('Berkas_bimbingan');
        $file_name = $berkas->getRandomName();
        $data = [
            'Berkas_bimbingan'  => $file_name,
            'judulTugasAkhir_id'  =>  $judul_tugas_akhir['id'],
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
        $berkas->move("uploads/{$this->mahasiswa['id']}/{$judul_tugas_akhir['id']}/T/", $file_name);
        $bimbingan_tugas_akhir->save($data);
        return redirect()->back();
    }

    public function jadwalSeminarProposal()
    {
        $this->setMahasiswa();
        $jadwal = (new JadwalSeminarProposalModel())->findAll();
        $list_jadwal = null;
        $i = 0;
        foreach ($jadwal as $key) {
            $judul = (new JudulProposalModel())->find($key['judulProposal_id']);
            $mahasiswa = (new MahasiswaModel())->find($judul['mahasiswa_id']);
            if ($mahasiswa['id'] == $this->mahasiswa['id']) {
                $list_jadwal[$i] = $key;
                $i++;
            }
        }

        $berita_acara = (new BeritaAcaraSeminarProposalModel())->join('jadwalseminarproposal', 'jadwalseminarproposal.id = beritaacaraseminarproposal.jadwalSeminarProposal_id')
            ->join('judulproposal', 'judulproposal.id = jadwalseminarproposal.judulProposal_id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->where('mahasiswa.id', $this->mahasiswa['id'])
            ->findAll();
        // dd($berita_acara);
        $data = [
            'person' => $this->mahasiswa,
            'jadwal' => $list_jadwal,
            'judul' => new JudulProposalModel(),
            'berita_acara' => $berita_acara,
        ];
        return view('mahasiswa/jadwal/seminarProposal', $data);
    }

    public function jadwalSeminarTugasAkhir()
    {
        $this->setMahasiswa();
        $jadwal = (new JadwalSeminarTugasAkhirModel())
            ->join('judultugasakhir', 'judultugasakhir.id = jadwalseminartugasakhir.judultugasakhir_id')
            ->join('judulproposal', 'judulproposal.id = judultugasakhir.judulproposal_id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->where('mahasiswa.id', $this->mahasiswa['id'])
            ->findAll();


        $berita_acara = (new BeritaAcaraSeminarProposalModel())->join('jadwalseminarproposal', 'jadwalseminarproposal.id = beritaacaraseminarproposal.jadwalSeminarProposal_id')
            ->join('judulproposal', 'judulproposal.id = jadwalseminarproposal.judulProposal_id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->where('mahasiswa.id', $this->mahasiswa['id'])
            ->findAll();
        // dd($berita_acara);
        $data = [
            'person' => $this->mahasiswa,
            'jadwal' => $jadwal,
            'judul' => new JudulProposalModel(),
            'berita_acara' => $berita_acara,
        ];
        return view('mahasiswa/jadwal/seminarTugasAkhir', $data);
    }

    public function downloadUji($judul_id, $type, $dos)
    {
        $this->setMahasiswa();
        switch ($type) {
            case 'P':
                if ($dos == 1) {
                    $berkas = 'Berkas_saran_dosuji1';
                }
                if ($dos == 2) {
                    $berkas = 'Berkas_saran_dosuji2';
                }
                break;

            case 'T':
                if ($dos == 1) {
                    $berkas = 'Berkas_saran_dosuji1';
                }
                if ($dos == 2) {
                    $berkas = 'Berkas_saran_dosuji2';
                }
                break;
        }
        $jadwal = (new JadwalSeminarProposalModel())->asArray()->where('judulProposal_id', $judul_id)->first();
        $data = (new BeritaAcaraSeminarProposalModel())->asArray()->where('jadwalSeminarProposal_id', $jadwal['id'])->first();
        return $this->response->download("uploads/{$this->mahasiswa['id']}/{$judul_id}/{$type}/" . $data[$berkas], null);
    }
}
