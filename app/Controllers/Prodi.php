<?php

namespace App\Controllers;

use App\Models\BeritaAcaraSeminarProposalModel;
use App\Models\BeritaAcaraSeminarTugasAkhirModel;
use App\Models\BimbinganProposalModel;
use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\JadwalSeminarProposalModel;
use App\Models\JadwalSeminarTugasAkhirModel;
use App\Models\JudulProposalModel;
use App\Models\JudulTugasAkhirModel;
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
        $isi = (new ProdiModel())
            ->join('mahasiswa', 'mahasiswa.prodi_id = prodi.id')
            ->join('judulproposal', 'judulproposal.mahasiswa_id = mahasiswa.id')
            ->join('judultugasakhir', 'judultugasakhir.judulProposal_id = judulproposal.id')
            ->where('kaprodi_id', $this->dosen['id'])
            ->findAll();
        $data = [
            'person' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
            'judul' => $this->judulProposal,
            'isi' => $isi,
            'mahasiswa' => new MahasiswaModel(),
        ];
        return view('prodi/validasi/judul', $data);
    }

    public function tambahvalidasiJudul($PT, $type, $id, $acc)
    {
        $this->setDosen();
        if ($acc == 'A') $a = true;
        if ($acc == 'R') $a = false;
        if ($type == 'A') $key = "acc_prodi";
        if ($type == 'L') $key = "layak_prodi";
        if ($PT == 'P') (new JudulProposalModel())->where('id', $id)->set([$key => $a])->update();
        if ($PT == 'T') (new JudulTugasAkhirModel())->where('id', $id)->set([$key => $a])->update();
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
        $jadwal = new JadwalSeminarProposalModel();
        $data = [
            'judulProposal_id'  =>  $this->judulProposal['id'],
            'jadwal' => $this->request->getPost('tgl_seminar'),
        ];
        $jadwal->save($data);
        $berita_acara = new BeritaAcaraSeminarProposalModel();
        $dosuji1 = (new DosenModel())->asArray()->where('nama', 'Anik Vega Vitianingsih, S. Kom., MT')->first();
        $dosuji2 = (new DosenModel())->asArray()->where('nama', 'Lambang Probo Sumirat, S.Kom., M.Kom')->first();
        // dd($dosuji1['id']);
        $data = [
            'jadwalSeminarProposal_id'  => $jadwal->getInsertID(),
            'dosuji1_id'                => $dosuji1['id'],
            'dosuji2_id'                => $dosuji2['id'],
        ];
        $berita_acara->save($data);
        return redirect()->back();
    }

    public function jadwalSeminarTugasAkhir()
    {
        $this->setDosen();
        $list_tugas_akhir = (new JudulProposalModel())
            ->join('judultugasakhir', 'judulproposal.id = judultugasakhir.judulProposal_id')
            ->join('jadwalseminartugasakhir', 'jadwalseminartugasakhir.judulTugasAkhir_id = judultugasakhir.id', 'LEFT')
            ->join('bimbingantugasakhir', 'bimbingantugasakhir.judultugasakhir_id = judultugasakhir.id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->Where('judultugasakhir.layak_dospem1', true)
            ->Where('judultugasakhir.layak_dospem2', true)
            ->Where('judultugasakhir.layak_prodi', true)
            ->where('prodi.kaprodi_id', $this->dosen['id'])
            ->where('jadwalseminartugasakhir.id', null)
            ->set('judulTugasAkhir_id', 'judultugasakhir.id')
            ->findAll();
        $list_jadwal_tugas_akhir = (new JadwalSeminarTugasAkhirModel())
            ->join('judultugasakhir', 'jadwalseminartugasakhir.judulTugasAkhir_id = judultugasakhir.id', 'LEFT')
            ->join('judulproposal', 'judulproposal.id = judultugasakhir.judulProposal_id', 'LEFT')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->where('prodi.kaprodi_id', $this->dosen['id'])
            ->findAll();
        // dd($list_tugas_akhir);

        $data = [
            'person' => $this->dosen,
            'prodi'     => $this->prodi,
            'fakultas'  => $this->fakultas,
            'judul' => $list_tugas_akhir,
            'list_jadwal' => $list_jadwal_tugas_akhir,
        ];
        return view('prodi/jadwal/seminarTugasAkhir', $data);
    }

    public function tambahjadwalSeminarTugasAkhir()
    {
        $this->setDosen();
        $jadwal = new JadwalSeminarTugasAkhirModel();
        $data = [
            'judulTugasAkhir_id'  =>  $this->request->getPost('judulTugasAkhir_id'),
            'jadwal' => $this->request->getPost('tgl_seminar'),
        ];
        $jadwal->save($data);
        $berita_acara = new BeritaAcaraSeminarTugasAkhirModel();
        $dosuji1 = (new DosenModel())->asArray()->where('nama', 'Anik Vega Vitianingsih, S. Kom., MT')->first();
        $dosuji2 = (new DosenModel())->asArray()->where('nama', 'Lambang Probo Sumirat, S.Kom., M.Kom')->first();
        // dd($dosuji1['id']);
        $data = [
            'jadwalSeminarTugasAkhir_id'  => $jadwal->getInsertID(),
            'dosuji1_id'                => $dosuji1['id'],
            'dosuji2_id'                => $dosuji2['id'],
        ];
        $berita_acara->save($data);
        return redirect()->back();
    }

    public function beritaAcaraSeminarProposal()
    {
        $this->setDosen();
        $berita_acara = (new BeritaAcaraSeminarProposalModel())
            ->join('jadwalseminarproposal', 'jadwalseminarproposal.id = beritaacaraseminarproposal.jadwalSeminarProposal_id')
            ->join('judulproposal', 'judulproposal.id = jadwalseminarproposal.judulProposal_id')
            ->join('mahasiswa', 'mahasiswa.id = judulproposal.mahasiswa_id')
            ->where('prodi_id', $this->prodi['id'])
            ->findAll();
        // dd($berita_acara);
        $data = [
            'person' => $this->dosen,
            'berita_acara' => $berita_acara,
            'bimbingan' => new BimbinganProposalModel(),
        ];
        // dd($data);
        return view('prodi/berita/proposal', $data);
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
        return $this->response->download("uploads/{$mahasiswa_id}/{$judul_id}/{$type}/" . $data[$berkas], null);
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

    public function tambahKetentuan($id, $ketentuan)
    {
        $this->setDosen();
        $jadwalSeminarProposal = (new JadwalSeminarProposalModel())->find($id);
        $berita_acara = (new BeritaAcaraSeminarProposalModel())->where('jadwalSeminarProposal_id', $jadwalSeminarProposal['id'])->first();
        (new BeritaAcaraSeminarProposalModel())->where('jadwalSeminarProposal_id', $jadwalSeminarProposal['id'])
            ->set(['ketentuan' => $ketentuan])
            ->update();
        // dd($berita_acara);
        if ($ketentuan) {
            $data = [
                'judulProposal_id'  => $jadwalSeminarProposal['judulProposal_id'],
                'beritaAcaraSeminarProposal_id'    => $berita_acara['id'],
            ];
            (new JudulTugasAkhirModel())->save($data);
        }
        return redirect()->back();
    }
}
