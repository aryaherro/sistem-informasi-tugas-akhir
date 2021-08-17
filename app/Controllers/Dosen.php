<?php

namespace App\Controllers;

use App\Models\BeritaAcaraSeminarProposalModel;
use App\Models\BeritaAcaraSeminarTugasAkhirModel;
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
        $this->judulProposal = (new JudulProposalModel())
            ->groupStart()
            ->where('dospem1_id', $this->dosen['id'],)
            ->orWhere('dospem2_id', $this->dosen['id'],)
            ->groupEnd()
            ->groupStart()
            ->Where('acc_dospem1', true)
            ->orWhere('acc_dospem1', null)
            ->groupEnd()
            ->groupStart()
            ->Where('acc_dospem2', true)
            ->orWhere('acc_dospem2', null)
            ->groupEnd()
            ->groupStart()
            ->Where('acc_prodi', true)
            ->orWhere('acc_prodi', null)
            ->groupEnd()
            ->findAll();
        $judul_tugas_akhir = (new JudulProposalModel())
            ->join('judultugasakhir', 'judulproposal.id = judultugasakhir.judulProposal_id')
            ->where('dospem1_id', $this->dosen['id'],)
            ->orWhere('dospem2_id', $this->dosen['id'],)
            ->findAll();
        // dd($judul_tugas_akhir);
        $data = [
            'person' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
            'judul' => $this->judulProposal,
            'judul_akhir' => $judul_tugas_akhir,
            'mahasiswa' => new MahasiswaModel(),
        ];
        return view('dosen/validasi/judul', $data);
    }

    public function tambahvalidasiJudul($type, $id, $acc, $PT = null)
    {
        $this->setDosen();
        if ($PT == 'P') $judul = (new JudulProposalModel())->find($id);
        if ($PT == 'T') $judul = (new JudulProposalModel())
            ->join('judultugasakhir', 'judulproposal.id = judultugasakhir.judulProposal_id')
            ->where('judulProposal_id', $id)
            ->first();
        // dd($judul);
        if ($type == 'A') $key = ($judul['dospem1_id'] == $this->dosen['id']) ? "acc_dospem1" : "acc_dospem2";
        if ($type == 'L') $key = ($judul['dospem1_id'] == $this->dosen['id']) ? "layak_dospem1" : "layak_dospem2";
        if ($acc == 'A') $a = true;
        if ($acc == 'R') $a = false;
        if ($PT == 'P') (new JudulProposalModel())->where('id', "{$judul['id']}")->set([$key => $a])->update();
        $akhir = (new JudulTugasAkhirModel())->where('judulProposal_id', $id)->first();
        // dd([$key => $a]);
        if ($PT == 'T') (new JudulTugasAkhirModel())->where('id', $akhir['id'])->set([$key => $a])->update();

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
        $this->bimbinganProposal = new BimbinganProposalModel();
        if ($this->judulProposal != null) {
            foreach ($this->judulProposal as $key) {
                $temp[$key['id']] = (((new BimbinganProposalModel())->where('judulProposal_id', $key['id'],))->findAll());
            }
            $this->bimbinganProposal = $temp;
        }
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
        $this->setDosen();
        $judul = (new JudulProposalModel())
            ->join('judultugasakhir', 'judulproposal.id = judultugasakhir.judulProposal_id')
            ->where('dospem1_id', $this->dosen['id'],)
            ->orWhere('dospem2_id', $this->dosen['id'],)
            ->findAll();
        // dd($judul);
        $bimbingan_tugas_akhir = new BimbinganTugasAkhirModel();
        if ($judul != null) {
            foreach ($judul as $key) {
                $temp[$key['id']] = (((new BimbinganTugasAkhirModel())->where('judulTugasAkhir_id', $key['id'],))->findAll());
            }
            $bimbingan_tugas_akhir = $temp;
        }
        $data = [
            'person' => $this->dosen,
            'judul' => $judul,
            'mahasiswa' => new MahasiswaModel(),
            'bimbingan' => $bimbingan_tugas_akhir,
        ];
        return view('dosen/validasi/tugasAkhir', $data);
    }

    public function tambahvalidasiTugasAkhir()
    {
        $this->setDosen();
        $this->mahasiswa = (new MahasiswaModel())->asArray()->where('nim', $this->request->getPost('nim'))->first();
        $judul_tugas_akhir = (new JudulProposalModel())
            ->join('judultugasakhir', 'judulproposal.id = judultugasakhir.judulProposal_id')
            ->find($this->request->getPost('jud'));
        // dd($judul_tugas_akhir);
        $bimbingan = (new BimbinganTugasAkhirModel())->find($this->request->getPost('bim'));

        $berkas = $this->request->getFile('Berkas_bimbingan');
        $file_name = $berkas->getRandomName();
        if ($judul_tugas_akhir['dospem1_id'] == $this->dosen['id']) $berkas_tipe = "Berkas_saran_dospem1";
        else
            if ($judul_tugas_akhir['dospem2_id'] == $this->dosen['id']) $berkas_tipe = "Berkas_saran_dospem2";

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
        (new BimbinganTugasAkhirModel())
            ->where('id', $bimbingan['id'])
            ->set([
                $berkas_tipe => $file_name,
            ])
            ->update();
        return redirect()->back();
    }

    public function jadwalSeminarProposal()
    {
        $this->setDosen();
        $jadwal = (new JadwalSeminarProposalModel())->findAll();
        $list_jadwal = null;
        $i = 0;
        foreach ($jadwal as $key) {
            $judul = (new JudulProposalModel())->find($key['judulProposal_id']);
            if (($judul['dospem1_id'] == $this->dosen['id']) || ($judul['dospem2_id'] == $this->dosen['id'])) {
                $list_jadwal[$i] = $key;
                $i++;
            }
        }
        $data = [
            'person' => $this->dosen,
            'jadwal' => $list_jadwal,
            'judul' => new JudulProposalModel(),
            'mahasiswa' => new MahasiswaModel(),
        ];
        return view('dosen/jadwal/seminarProposal', $data);
    }

    public function jadwalSeminarTugasAkhir()
    {
        $this->setDosen();
        $jadwal = (new JadwalSeminarTugasAkhirModel())
            ->join('judultugasakhir', 'judultugasakhir.id = jadwalseminartugasakhir.judultugasakhir_id')
            ->join('judulproposal', 'judulproposal.id = judultugasakhir.judulproposal_id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->where('judulproposal.dospem1_id', $this->dosen['id'])
            ->orWhere('judulproposal.dospem2_id', $this->dosen['id'])
            ->findAll();

        $data = [
            'person' => $this->dosen,
            'jadwal' => $jadwal,
        ];
        return view('dosen/jadwal/seminarTugasAkhir', $data);
    }

    public function ujiProposal()
    {
        $this->setDosen();
        $berita_acara = (new BeritaAcaraSeminarProposalModel())
            ->where('dosuji1_id', $this->dosen['id'])
            ->orWhere('dosuji2_id', $this->dosen['id'])
            ->join('jadwalseminarproposal', 'jadwalseminarproposal.id = beritaacaraseminarproposal.jadwalSeminarProposal_id')
            ->join('judulproposal', 'judulproposal.id = jadwalseminarproposal.judulProposal_id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->findAll();
        $data = [
            'person' => $this->dosen,
            'berita_acara' => $berita_acara,
        ];
        return view('dosen/uji/proposal', $data);
    }

    public function tambahUjiProposal()
    {
        $this->setDosen();
        $berita_acara = (new BeritaAcaraSeminarProposalModel())->asArray()->where('jadwalSeminarProposal_id', $this->request->getPost('jad'))->first();
        $jadwal = (new JadwalSeminarProposalModel())->find($this->request->getPost('jad'));
        $judulProposal = (new JudulProposalModel())->find($jadwal['judulProposal_id']);
        $this->mahasiswa = (new MahasiswaModel())->find($judulProposal['mahasiswa_id']);
        $berkas = $this->request->getFile('Berkas_saran');
        $file_name = $berkas->getRandomName();
        $val = [
            'Berkas_saran' => [
                'rules' => 'uploaded[Berkas_saran]|mime_in[Berkas_saran,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.rar,text/plain,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/zip]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa doc,docx,pdf,ppt,pptx,rar,txt,xls,xlsx,zip',
                ],
            ],
        ];
        if (!$this->validate($val)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        if ($berita_acara['dosuji1_id'] == $this->dosen['id']) $berkas_tipe = "Berkas_saran_dosuji1";
        else
            if ($berita_acara['dosuji2_id'] == $this->dosen['id']) $berkas_tipe = "Berkas_saran_dosuji2";
        $berkas->move("uploads/{$this->mahasiswa['id']}/{$judulProposal['id']}/P/", $file_name);
        (new BeritaAcaraSeminarProposalModel())
            ->where('id', $berita_acara['id'])
            ->set([
                $berkas_tipe => $file_name,
            ])
            ->update();
        return redirect()->back();
    }
    public function ujiTugasAkhir()
    {
        $this->setDosen();
        $berita_acara = (new BeritaAcaraSeminarTugasAkhirModel())
            ->where('dosuji1_id', $this->dosen['id'])
            ->orWhere('dosuji2_id', $this->dosen['id'])
            ->join('jadwalseminartugasakhir', 'jadwalseminartugasakhir.id = beritaacaraseminartugasakhir.jadwalSeminartugasakhir_id')
            ->join('judultugasakhir', 'judultugasakhir.id = jadwalseminartugasakhir.judultugasakhir_id')
            ->join('judulproposal', 'judulproposal.id = judultugasakhir.judulProposal_id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->findAll();
        // dd($berita_acara);
        $data = [
            'person' => $this->dosen,
            'berita_acara' => $berita_acara,
        ];
        return view('dosen/uji/tugasakhir', $data);
    }

    public function tambahUjiTugasAkhir()
    {
        $this->setDosen();
        $berita_acara = (new BeritaAcaraSeminarTugasAkhirModel())->asArray()->where('jadwalSeminarTugasAkhir_id', $this->request->getPost('jad'))->first();
        $jadwal = (new JadwalSeminarTugasAkhirModel())->find($this->request->getPost('jad'));
        $judul_tugas_akhir = (new JudulTugasAkhirModel())->find($jadwal['judulTugasAkhir_id']);
        $judul_proposal = (new JudulProposalModel())->find($judul_tugas_akhir['judulProposal_id']);
        $this->mahasiswa = (new MahasiswaModel())->find($judul_proposal['mahasiswa_id']);
        $berkas = $this->request->getFile('Berkas_saran');
        $file_name = $berkas->getRandomName();
        $val = [
            'Berkas_saran' => [
                'rules' => 'uploaded[Berkas_saran]|mime_in[Berkas_saran,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.rar,text/plain,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/zip]',
                'errors' => [
                    'uploaded' => 'Harus Ada File yang diupload',
                    'mime_in' => 'File Extention Harus Berupa doc,docx,pdf,ppt,pptx,rar,txt,xls,xlsx,zip',
                ],
            ],
        ];
        if (!$this->validate($val)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $ketentuan = null;
        if ($berita_acara['dosuji1_id'] == $this->dosen['id']) {
            $berkas_tipe = "Berkas_saran_dosuji1";
            $nilai_tipe = "dosuji1_nilai";
            if ($berita_acara['dosuji2_nilai'] != null) {
                $rata = ($this->request->getPost('nilai') + $berita_acara['dosuji2_nilai']) / 2;
                $ketentuan = ($rata > 60) ? true : false;
            }
        } else {
            if ($berita_acara['dosuji2_id'] == $this->dosen['id']) {
                $berkas_tipe = "Berkas_saran_dosuji2";
                $nilai_tipe = "dosuji2_nilai";
                if ($berita_acara['dosuji2_nilai'] != null) {
                    $rata = ($this->request->getPost('nilai') + $berita_acara['dosuji1_nilai']) / 2;
                    $ketentuan = ($rata > 60) ? true : false;
                }
            }
        }
        $berkas->move("uploads/{$this->mahasiswa['id']}/{$judul_tugas_akhir['id']}/T/", $file_name);
        (new BeritaAcaraSeminarTugasAkhirModel())
            ->where('id', $berita_acara['id'])
            ->set([
                $berkas_tipe => $file_name,
                $nilai_tipe => $this->request->getPost('nilai'),
                'ketentuan' => $ketentuan,
            ])
            ->update();
        return redirect()->back();
    }

    public function downloadUji($mahasiswa_id, $judul_id, $type, $dos)
    {
        switch ($type) {
            case 'P':
                if ($dos == 1) {
                    $berkas = 'Berkas_saran_dosuji1';
                }
                if ($dos == 2) {
                    $berkas = 'Berkas_saran_dosuji2';
                }
                $jadwal = (new JadwalSeminarProposalModel())->asArray()->where('judulProposal_id', $judul_id)->first();
                $data = (new BeritaAcaraSeminarProposalModel())->asArray()->where('jadwalSeminarProposal_id', $jadwal['id'])->first();
                break;

            case 'T':
                if ($dos == 1) {
                    $berkas = 'Berkas_saran_dosuji1';
                }
                if ($dos == 2) {
                    $berkas = 'Berkas_saran_dosuji2';
                }
                $jadwal = (new JadwalSeminarTugasAkhirModel())->asArray()->where('judulTugasAkhir_id', $judul_id)->first();
                $data = (new BeritaAcaraSeminarTugasAkhirModel())->asArray()->where('jadwalSeminarTugasAkhir_id', $jadwal['id'])->first();
                break;
        }

        return $this->response->download("uploads/{$mahasiswa_id}/{$judul_id}/{$type}/" . $data[$berkas], null);
    }
}
