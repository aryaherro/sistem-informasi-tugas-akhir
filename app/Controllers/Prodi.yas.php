 <?php

    namespace App\Controllers;

    class Mahasiswa extends BaseController
    {
        public function index()
        {
            return view('prodi/profile');
        }

        public function judul()
        {
            return view('prodi/judulTugasAkhir');
        }

        public function bimbinganProposal()
        {
            return view('prodi/proposalTugasAkhirMahasiswa');
        }

        public function bimbinganTugasAkhir()
        {
            return view('prodi/tugasAkhirMahasiswa');
        }

        public function jadwalSeminarProposal()
        {
            return view('prodi/jadwal/seminarProposal');
        }

        public function jadwalSeminarTugasAkhir()
        {
            return view('prodi/jadwal/seminarTugasAkhir');
        }
    }
