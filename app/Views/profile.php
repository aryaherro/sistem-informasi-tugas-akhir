<?php

use PHPUnit\TextUI\XmlConfiguration\Group;
?>
<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<?php (in_groups("Mahasiswa")) ? $person = $mahasiswa : $person = $dosen; ?>
<div class="content-wrapper">
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">Profil <?= (in_groups("Mahasiswa")) ? "Mahasiswa" : "Dosen"; ?></h3>

                    </div>
                    <div>
                        <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                            <span class="m-subheader__daterange-label">
                                <span class="m-subheader__daterange-title"></span>
                                <span class="m-subheader__daterange-date m--font-brand"></span>
                            </span>

                        </span>
                    </div>
                </div>
            </div>

            <div class="m-content">
                <h3>Ubah Profil <?= (in_groups("Mahasiswa")) ? "Mahasiswa" : "Dosen"; ?></h3>
                <hr>
                <br>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="m-portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Foto
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="m-section">
                                    <div class="m-section__content">
                                        <img src="/profile/<?= user()->__get('username'); ?>.png" height="180" onerror="this.onerror=null;this.src='/profile/default.png';">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-9">
                        <div class="m-portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Biodata <?= (in_groups("Mahasiswa")) ? "Mahasiswa" : "Dosen"; ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">

                                <div class="m-section">
                                    <div class="m-section__content">

                                        <form id="form_profil" name="form_profil" method="post" enctype="multipart/form-data">
                                            <table class="table table-striped m-table">
                                                <tbody>
                                                    <tr>
                                                        <td width="40%"><b>Nama Lengkap</b></td>
                                                        <td width="1%">:</td>
                                                        <td><input type="text" class="form-control m-input m-input--square" name="namaupdate" id="namaupdate" value="<?= $person['nama']; ?>" disabled>
                                                            <input type="hidden" class="form-control m-input m-input--square" name="namamhs" id="namamhs" value="<?= $person['nama']; ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b><?= (in_groups("Mahasiswa")) ? "NIM" : "NIP"; ?></b></td>
                                                        <td width="1%">:</td>
                                                        <td><?= $person[(in_groups('Mahasiswa')) ? 'nim' : 'nip']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>NIK</b></td>
                                                        <td width="1%">:</td>
                                                        <td><input type="text" class="form-control m-input m-input--square" height="1px" id="noktp" name="noktp" value="<?= $person['nik']; ?>" disabled></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Jurusan / Fakultas</b></td>
                                                        <td width="1%">:</td>
                                                        <td> <?= $prodi['nama']; ?>/<?= $fakultas['nama']; ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Jenis Kelamin</b></td>
                                                        <td width="1%">:</td>
                                                        <td>
                                                            <?= ($person['jk'] == "L") ? 'Laki-Laki' : 'Perempuan'; ?>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Agama</b></td>
                                                        <td width="1%">:</td>
                                                        <td>
                                                            <?= $person['agama']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tempat Lahir</b></td>
                                                        <td width="1%">:</td>
                                                        <td><select class="form-control m-select2" id="m_select2_2" name="kota">
                                                                <option value="0">-PILIH KOTA-</option>
                                                                <option value="1">Luar Negeri</option>
                                                                <option value="2">Kab. Aceh Selatan</option>
                                                                <option value="3">Kab. Aceh Tenggara</option>
                                                                <option value="4">Kab. Aceh Timur</option>
                                                                <option value="5">Kab. Aceh Tengah</option>
                                                                <option value="6">Kab. Aceh Barat</option>
                                                                <option value="7">Kab. Aceh Besar</option>
                                                                <option value="8">Kab. Pidie</option>
                                                                <option value="9">Kab. Aceh Utara</option>
                                                                <option value="10">Kab. Simeulue</option>
                                                                <option value="11">Kab. Aceh Singkil</option>
                                                                <option value="12">Kab. Bireuen</option>
                                                                <option value="13">Kab. Aceh Barat Daya</option>
                                                                <option value="14">Kab. Gayo Lues</option>
                                                                <option value="15">Kab. Aceh Jaya</option>
                                                                <option value="16">Kab. Nagan Raya</option>
                                                                <option value="17">Kab. Aceh Tamiang</option>
                                                                <option value="18">Kab. Bener Meriah</option>
                                                                <option value="19">Kab. Pidie Jaya</option>
                                                                <option value="20">Kota Banda Aceh</option>
                                                                <option value="21">Kota Sabang</option>
                                                                <option value="22">Kota Lhokseumawe</option>
                                                                <option value="23">Kota Langsa</option>
                                                                <option value="24">Kota Subulussalam</option>
                                                                <option value="25">Kab. Tapanuli Tengah</option>
                                                                <option value="26">Kab. Tapanuli Utara</option>
                                                                <option value="27">Kab. Tapanuli Selatan</option>
                                                                <option value="28">Kab. Nias</option>
                                                                <option value="29">Kab. Langkat</option>
                                                                <option value="30">Kab. Karo</option>
                                                                <option value="31">Kab. Deli Serdang</option>
                                                                <option value="32">Kab. Simalungun</option>
                                                                <option value="33">Kab. Asahan</option>
                                                                <option value="34">Kab. Labuhanbatu</option>
                                                                <option value="35">Kab. Dairi</option>
                                                                <option value="36">Kab. Toba Samosir</option>
                                                                <option value="37">Kab. Mandailing Natal</option>
                                                                <option value="38">Kab. Nias Selatan</option>
                                                                <option value="39">Kab. Pakpak Bharat</option>
                                                                <option value="40">Kab. Humbang Hasundutan</option>
                                                                <option value="41">Kab. Samosir</option>
                                                                <option value="42">Kab. Serdang Bedagai</option>
                                                                <option value="43">Kab. Batu Bara</option>
                                                                <option value="44">Kab. Padang Lawas Utara</option>
                                                                <option value="45">Kab. Padang Lawas</option>
                                                                <option value="46">Kab. Labuhanbatu Selatan</option>
                                                                <option value="47">Kab. Labuhanbatu Utara</option>
                                                                <option value="48">Kab. Nias Utara</option>
                                                                <option value="49">Kab. Nias Barat</option>
                                                                <option value="50">Kota Medan</option>
                                                                <option value="51">Kota Pematang Siantar</option>
                                                                <option value="52">Kota Sibolga</option>
                                                                <option value="53">Kota Tanjung Balai</option>
                                                                <option value="54">Kota Binjai</option>
                                                                <option value="55">Kota Tebing Tinggi</option>
                                                                <option value="56">Kota Padangsidimpuan</option>
                                                                <option value="57">Kota Gunungsitoli</option>
                                                                <option value="58">Kab. Pesisir Selatan</option>
                                                                <option value="59">Kab. Solok</option>
                                                                <option value="60">Kab. Sijunjung</option>
                                                                <option value="61">Kab. Tanah Datar</option>
                                                                <option value="62">Kab. Padang Pariaman</option>
                                                                <option value="63">Kab. Agam</option>
                                                                <option value="64">Kab. Lima Puluh Kota</option>
                                                                <option value="65">Kab. Pasaman</option>
                                                                <option value="66">Kab. Kepulauan Mentawai</option>
                                                                <option value="67">Kab. Dharmasraya</option>
                                                                <option value="68">Kab. Solok Selatan</option>
                                                                <option value="69">Kab. Pasaman Barat</option>
                                                                <option value="70">Kota Padang</option>
                                                                <option value="71">Kota Solok</option>
                                                                <option value="72">Kota Sawahlunto</option>
                                                                <option value="73">Kota Padang Panjang</option>
                                                                <option value="74">Kota Bukittinggi</option>
                                                                <option value="75">Kota Payakumbuh</option>
                                                                <option value="76">Kota Pariaman</option>
                                                                <option value="77">Kab. Kampar</option>
                                                                <option value="78">Kab. Indragiri Hulu</option>
                                                                <option value="79">Kab. Bengkalis</option>
                                                                <option value="80">Kab. Indragiri Hilir</option>
                                                                <option value="81">Kab. Pelalawan</option>
                                                                <option value="82">Kab. Rokan Hulu</option>
                                                                <option value="83">Kab. Rokan Hilir</option>
                                                                <option value="84">Kab. Siak</option>
                                                                <option value="85">Kab. Kuantan Singingi</option>
                                                                <option value="86">Kab. Kepulauan Meranti</option>
                                                                <option value="87">Kota Pekanbaru</option>
                                                                <option value="88">Kota Dumai</option>
                                                                <option value="89">Kab. Kerinci</option>
                                                                <option value="90">Kab. Merangin</option>
                                                                <option value="91">Kab. Sarolangun</option>
                                                                <option value="92">Kab. Batanghari</option>
                                                                <option value="93">Kab. Muaro Jambi</option>
                                                                <option value="94">Kab. Tanjung Jabung Barat
                                                                </option>
                                                                <option value="95">Kab. Tanjung Jabung Timur
                                                                </option>
                                                                <option value="96">Kab. Bungo</option>
                                                                <option value="97">Kab. Tebo</option>
                                                                <option value="98">Kota Jambi</option>
                                                                <option value="99">Kota Sungai Penuh</option>
                                                                <option value="100">Kab. Ogan Komering Ulu</option>
                                                                <option value="101">Kab. Ogan Komering Ilir</option>
                                                                <option value="102">Kab. Muara Enim</option>
                                                                <option value="103">Kab. Lahat</option>
                                                                <option value="104">Kab. Musi Rawas</option>
                                                                <option value="105">Kab. Musi Banyuasin</option>
                                                                <option value="106">Kab. Banyuasin</option>
                                                                <option value="107">Kab. Oku Timur</option>
                                                                <option value="108">Kab. Oku Selatan</option>
                                                                <option value="109">Kab. Ogan Ilir</option>
                                                                <option value="110">Kab. Empat Lawang</option>
                                                                <option value="111">Kota Palembang</option>
                                                                <option value="112">Kota Pagar Alam</option>
                                                                <option value="113">Kota Lubuk Linggau</option>
                                                                <option value="114">Kota Prabumulih</option>
                                                                <option value="115">Kab. Bengkulu Selatan</option>
                                                                <option value="116">Kab. Rejang Lebong</option>
                                                                <option value="117">Kab. Bengkulu Utara</option>
                                                                <option value="118">Kab. Kaur</option>
                                                                <option value="119">Kab. Seluma</option>
                                                                <option value="120">Kab. Muko Muko</option>
                                                                <option value="121">Kab. Lebong</option>
                                                                <option value="122">Kab. Kepahiang</option>
                                                                <option value="123">Kab. Bengkulu Tengah</option>
                                                                <option value="124">Kota Bengkulu</option>
                                                                <option value="125">Kab. Lampung Selatan</option>
                                                                <option value="126">Kab. Lampung Tengah</option>
                                                                <option value="127">Kab. Lampung Utara</option>
                                                                <option value="128">Kab. Lampung Barat</option>
                                                                <option value="129">Kab. Tulang Bawang</option>
                                                                <option value="130">Kab. Tanggamus</option>
                                                                <option value="131">Kab. Lampung Timur</option>
                                                                <option value="132">Kab. Way Kanan</option>
                                                                <option value="133">Kab. Pesawaran</option>
                                                                <option value="134">Kab. Pringsewu</option>
                                                                <option value="135">Kab. Mesuji</option>
                                                                <option value="136">Kab. Tulang Bawang Barat
                                                                </option>
                                                                <option value="137">Kota Bandar Lampung</option>
                                                                <option value="138">Kota Metro</option>
                                                                <option value="139">Kab. Bangka</option>
                                                                <option value="140">Kab. Belitung</option>
                                                                <option value="141">Kab. Bangka Selatan</option>
                                                                <option value="142">Kab. Bangka Tengah</option>
                                                                <option value="143">Kab. Bangka Barat</option>
                                                                <option value="144">Kab. Belitung Timur</option>
                                                                <option value="145">Kota Pangkal Pinang</option>
                                                                <option value="146">Kab. Bintan</option>
                                                                <option value="147">Kab. Karimun</option>
                                                                <option value="148">Kab. Natuna</option>
                                                                <option value="149">Kab. Lingga</option>
                                                                <option value="150">Kab. Kepulauan Anambas</option>
                                                                <option value="151">Kota Batam</option>
                                                                <option value="152">Kota Tanjung Pinang</option>
                                                                <option value="153">Kab. Kepulauan Seribu</option>
                                                                <option value="154">Kota Jakarta Pusat</option>
                                                                <option value="155">Kota Jakarta Utara</option>
                                                                <option value="156">Kota Jakarta Barat</option>
                                                                <option value="157">Kota Jakarta Selatan</option>
                                                                <option value="158">Kota Jakarta Timur</option>
                                                                <option value="159">Kab. Bogor</option>
                                                                <option value="160">Kab. Sukabumi</option>
                                                                <option value="161">Kab. Cianjur</option>
                                                                <option value="162">Kab. Bandung</option>
                                                                <option value="163">Kab. Garut</option>
                                                                <option value="164">Kab. Tasikmalaya</option>
                                                                <option value="165">Kab. Ciamis</option>
                                                                <option value="166">Kab. Kuningan</option>
                                                                <option value="167">Kab. Cirebon</option>
                                                                <option value="168">Kab. Majalengka</option>
                                                                <option value="169">Kab. Sumedang</option>
                                                                <option value="170">Kab. Indramayu</option>
                                                                <option value="171">Kab. Subang</option>
                                                                <option value="172">Kab. Purwakarta</option>
                                                                <option value="173">Kab. Karawang</option>
                                                                <option value="174">Kab. Bekasi</option>
                                                                <option value="175">Kab. Bandung Barat</option>
                                                                <option value="176">Kota Bogor</option>
                                                                <option value="177">Kota Sukabumi</option>
                                                                <option value="178">Kota Bandung</option>
                                                                <option value="179">Kota Cirebon</option>
                                                                <option value="180">Kota Bekasi</option>
                                                                <option value="181">Kota Depok</option>
                                                                <option value="182">Kota Cimahi</option>
                                                                <option value="183">Kota Tasikmalaya</option>
                                                                <option value="184">Kota Banjar</option>
                                                                <option value="185">Kab. Cilacap</option>
                                                                <option value="186">Kab. Banyumas</option>
                                                                <option value="187">Kab. Purbalingga</option>
                                                                <option value="188">Kab. Banjarnegara</option>
                                                                <option value="189">Kab. Kebumen</option>
                                                                <option value="190">Kab. Purworejo</option>
                                                                <option value="191">Kab. Wonosobo</option>
                                                                <option value="192">Kab. Magelang</option>
                                                                <option value="193">Kab. Boyolali</option>
                                                                <option value="194">Kab. Klaten</option>
                                                                <option value="195">Kab. Sukoharjo</option>
                                                                <option value="196">Kab. Wonogiri</option>
                                                                <option value="197">Kab. Karanganyar</option>
                                                                <option value="198">Kab. Sragen</option>
                                                                <option value="199">Kab. Grobogan</option>
                                                                <option value="200">Kab. Blora</option>
                                                                <option value="201">Kab. Rembang</option>
                                                                <option value="202">Kab. Pati</option>
                                                                <option value="203">Kab. Kudus</option>
                                                                <option value="204">Kab. Jepara</option>
                                                                <option value="205">Kab. Demak</option>
                                                                <option value="206">Kab. Semarang</option>
                                                                <option value="207">Kab. Temanggung</option>
                                                                <option value="208">Kab. Kendal</option>
                                                                <option value="209">Kab. Batang</option>
                                                                <option value="210">Kab. Pekalongan</option>
                                                                <option value="211">Kab. Pemalang</option>
                                                                <option value="212">Kab. Tegal</option>
                                                                <option value="213">Kab. Brebes</option>
                                                                <option value="214">Kota Magelang</option>
                                                                <option value="215">Kota Surakarta</option>
                                                                <option value="216">Kota Salatiga</option>
                                                                <option value="217">Kota Semarang</option>
                                                                <option value="218">Kota Pekalongan</option>
                                                                <option value="219">Kota Tegal</option>
                                                                <option value="220">Kab. Kulon Progo</option>
                                                                <option value="221">Kab. Bantul</option>
                                                                <option value="222">Kab. Gunung Kidul</option>
                                                                <option value="223">Kab. Sleman</option>
                                                                <option value="224">Kota Yogyakarta</option>
                                                                <option value="225">Kab. Pacitan</option>
                                                                <option value="226">Kab. Ponorogo</option>
                                                                <option value="227">Kab. Trenggalek</option>
                                                                <option value="228">Kab. Tulungagung</option>
                                                                <option value="229">Kab. Blitar</option>
                                                                <option value="230">Kab. Kediri</option>
                                                                <option value="231">Kab. Malang</option>
                                                                <option value="232">Kab. Lumajang</option>
                                                                <option value="233">Kab. Jember</option>
                                                                <option value="234">Kab. Banyuwangi</option>
                                                                <option value="235">Kab. Bondowoso</option>
                                                                <option value="236">Kab. Situbondo</option>
                                                                <option value="237">Kab. Probolinggo</option>
                                                                <option value="238">Kab. Pasuruan</option>
                                                                <option value="239">Kab. Sidoarjo</option>
                                                                <option value="240">Kab. Mojokerto</option>
                                                                <option value="241">Kab. Jombang</option>
                                                                <option value="242">Kab. Nganjuk</option>
                                                                <option value="243">Kab. Madiun</option>
                                                                <option value="244">Kab. Magetan</option>
                                                                <option value="245">Kab. Ngawi</option>
                                                                <option value="246">Kab. Bojonegoro</option>
                                                                <option value="247">Kab. Tuban</option>
                                                                <option value="248">Kab. Lamongan</option>
                                                                <option value="249">Kab. Gresik</option>
                                                                <option value="250">Kab. Bangkalan</option>
                                                                <option value="251">Kab. Sampang</option>
                                                                <option value="252">Kab. Pamekasan</option>
                                                                <option value="253">Kab. Sumenep</option>
                                                                <option value="254">Kota Kediri</option>
                                                                <option value="255">Kota Blitar</option>
                                                                <option value="256">Kota Malang</option>
                                                                <option value="257">Kota Probolinggo</option>
                                                                <option value="258">Kota Pasuruan</option>
                                                                <option value="259">Kota Mojokerto</option>
                                                                <option value="260">Kota Madiun</option>
                                                                <option value="261" selected="selected">Kota
                                                                    Surabaya</option>
                                                                <option value="262">Kota Batu</option>
                                                                <option value="263">Kab. Pandeglang</option>
                                                                <option value="264">Kab. Lebak</option>
                                                                <option value="265">Kab. Tangerang</option>
                                                                <option value="266">Kab. Serang</option>
                                                                <option value="267">Kota Tangerang</option>
                                                                <option value="268">Kota Cilegon</option>
                                                                <option value="269">Kota Serang</option>
                                                                <option value="270">Kota Tangerang Selatan</option>
                                                                <option value="271">Kab. Jembrana</option>
                                                                <option value="272">Kab. Tabanan</option>
                                                                <option value="273">Kab. Badung</option>
                                                                <option value="274">Kab. Gianyar</option>
                                                                <option value="275">Kab. Klungkung</option>
                                                                <option value="276">Kab. Bangli</option>
                                                                <option value="277">Kab. Karangasem</option>
                                                                <option value="278">Kab. Buleleng</option>
                                                                <option value="279">Kota Denpasar</option>
                                                                <option value="280">Kab. Lombok Barat</option>
                                                                <option value="281">Kab. Lombok Tengah</option>
                                                                <option value="282">Kab. Lombok Timur</option>
                                                                <option value="283">Kab. Sumbawa</option>
                                                                <option value="284">Kab. Dompu</option>
                                                                <option value="285">Kab. Bima</option>
                                                                <option value="286">Kab. Sumbawa Barat</option>
                                                                <option value="287">Kab. Lombok Utara</option>
                                                                <option value="288">Kota Mataram</option>
                                                                <option value="289">Kota Bima</option>
                                                                <option value="290">Kab. Kupang</option>
                                                                <option value="291">Kab. Timor Tengah Selatan
                                                                </option>
                                                                <option value="292">Kab. Timor Tengah Utara</option>
                                                                <option value="293">Kab. Belu</option>
                                                                <option value="294">Kab. Alor</option>
                                                                <option value="295">Kab. Flores Timur</option>
                                                                <option value="296">Kab. Sikka</option>
                                                                <option value="297">Kab. Ende</option>
                                                                <option value="298">Kab. Ngada</option>
                                                                <option value="299">Kab. Manggarai</option>
                                                                <option value="300">Kab. Sumba Timur</option>
                                                                <option value="301">Kab. Sumba Barat</option>
                                                                <option value="302">Kab. Lembata</option>
                                                                <option value="303">Kab. Rote Ndao</option>
                                                                <option value="304">Kab. Manggarai Barat</option>
                                                                <option value="305">Kab. Nagekeo</option>
                                                                <option value="306">Kab. Sumba Tengah</option>
                                                                <option value="307">Kab. Sumba Barat Daya</option>
                                                                <option value="308">Kab. Manggarai Timur</option>
                                                                <option value="309">Kab. Sabu Raijua</option>
                                                                <option value="310">Kota Kupang</option>
                                                                <option value="311">Kab. Sambas</option>
                                                                <option value="312">Kab. Pontianak</option>
                                                                <option value="313">Kab. Sanggau</option>
                                                                <option value="314">Kab. Ketapang</option>
                                                                <option value="315">Kab. Sintang</option>
                                                                <option value="316">Kab. Kapuas Hulu</option>
                                                                <option value="317">Kab. Bengkayang</option>
                                                                <option value="318">Kab. Landak</option>
                                                                <option value="319">Kab. Sekadau</option>
                                                                <option value="320">Kab. Melawi</option>
                                                                <option value="321">Kab. Kayong Utara</option>
                                                                <option value="322">Kab. Kubu Raya</option>
                                                                <option value="323">Kota Pontianak</option>
                                                                <option value="324">Kota Singkawang</option>
                                                                <option value="325">Kab. Kotawaringin Barat</option>
                                                                <option value="326">Kab. Kotawaringin Timur</option>
                                                                <option value="327">Kab. Kapuas</option>
                                                                <option value="328">Kab. Barito Selatan</option>
                                                                <option value="329">Kab. Barito Utara</option>
                                                                <option value="330">Kab. Katingan</option>
                                                                <option value="331">Kab. Seruyan</option>
                                                                <option value="332">Kab. Sukamara</option>
                                                                <option value="333">Kab. Lamandau</option>
                                                                <option value="334">Kab. Gunung Mas</option>
                                                                <option value="335">Kab. Pulang Pisau</option>
                                                                <option value="336">Kab. Murung Raya</option>
                                                                <option value="337">Kab. Barito Timur</option>
                                                                <option value="338">Kota Palangkaraya</option>
                                                                <option value="339">Kab. Tanah Laut</option>
                                                                <option value="340">Kab. Kotabaru</option>
                                                                <option value="341">Kab. Banjar</option>
                                                                <option value="342">Kab. Barito Kuala</option>
                                                                <option value="343">Kab. Tapin</option>
                                                                <option value="344">Kab. Hulu Sungai Selatan
                                                                </option>
                                                                <option value="345">Kab. Hulu Sungai Tengah</option>
                                                                <option value="346">Kab. Hulu Sungai Utara</option>
                                                                <option value="347">Kab. Tabalong</option>
                                                                <option value="348">Kab. Tanah Bumbu</option>
                                                                <option value="349">Kab. Balangan</option>
                                                                <option value="350">Kota Banjarmasin</option>
                                                                <option value="351">Kota Banjarbaru</option>
                                                                <option value="352">Kab. Paser</option>
                                                                <option value="353">Kab. Kutai Kartanegara</option>
                                                                <option value="354">Kab. Berau</option>
                                                                <option value="355">Kab. Bulungan</option>
                                                                <option value="356">Kab. Nunukan</option>
                                                                <option value="357">Kab. Malinau</option>
                                                                <option value="358">Kab. Kutai Barat</option>
                                                                <option value="359">Kab. Kutai Timur</option>
                                                                <option value="360">Kab. Penajam Paser Utara
                                                                </option>
                                                                <option value="361">Kab. Tana Tidung</option>
                                                                <option value="362">Kota Balikpapan</option>
                                                                <option value="363">Kota Samarinda</option>
                                                                <option value="364">Kota Tarakan</option>
                                                                <option value="365">Kota Bontang</option>
                                                                <option value="366">Kab. Bulungan</option>
                                                                <option value="367">Kab. Malinau</option>
                                                                <option value="368">Kab. Nunukan</option>
                                                                <option value="369">Kab. Tana Tidung</option>
                                                                <option value="370">Kota Tarakan</option>
                                                                <option value="371">Kab. Bolaang Mongondow</option>
                                                                <option value="372">Kab. Minahasa</option>
                                                                <option value="373">Kab. Kepulauan Sangihe</option>
                                                                <option value="374">Kab. Kepulauan Talaud</option>
                                                                <option value="375">Kab. Minahasa Selatan</option>
                                                                <option value="376">Kab. Minahasa Utara</option>
                                                                <option value="377">Kab. Minahasa Tenggara</option>
                                                                <option value="378">Kab. Bolaang Mongondow Utara
                                                                </option>
                                                                <option value="379">Kab. Kep. Siau Tagulandang Barat
                                                                </option>
                                                                <option value="380">Kab. Bolaang Mongondow Timur
                                                                </option>
                                                                <option value="381">Kab. Bolaang Mongondow Selatan
                                                                </option>
                                                                <option value="382">Kota Manado</option>
                                                                <option value="383">Kota Bitung</option>
                                                                <option value="384">Kota Tomohon</option>
                                                                <option value="385">Kota Kotamobagu</option>
                                                                <option value="386">Kab. Banggai</option>
                                                                <option value="387">Kab. Poso</option>
                                                                <option value="388">Kab. Donggala</option>
                                                                <option value="389">Kab. Toli Toli</option>
                                                                <option value="390">Kab. Buol</option>
                                                                <option value="391">Kab. Morowali</option>
                                                                <option value="392">Kab. Banggai Kepulauan</option>
                                                                <option value="393">Kab. Parigi Moutong</option>
                                                                <option value="394">Kab. Tojo Una Una</option>
                                                                <option value="395">Kab. Sigi</option>
                                                                <option value="396">Kota Palu</option>
                                                                <option value="397">Kab. Kepulauan Selayar</option>
                                                                <option value="398">Kab. Bulukumba</option>
                                                                <option value="399">Kab. Bantaeng</option>
                                                                <option value="400">Kab. Jeneponto</option>
                                                                <option value="401">Kab. Takalar</option>
                                                                <option value="402">Kab. Gowa</option>
                                                                <option value="403">Kab. Sinjai</option>
                                                                <option value="404">Kab. Bone</option>
                                                                <option value="405">Kab. Maros</option>
                                                                <option value="406">Kab. Pangkajene Kepulauan
                                                                </option>
                                                                <option value="407">Kab. Barru</option>
                                                                <option value="408">Kab. Soppeng</option>
                                                                <option value="409">Kab. Wajo</option>
                                                                <option value="410">Kab. Sidenreng Rappang</option>
                                                                <option value="411">Kab. Pinrang</option>
                                                                <option value="412">Kab. Enrekang</option>
                                                                <option value="413">Kab. Luwu</option>
                                                                <option value="414">Kab. Tana Toraja</option>
                                                                <option value="415">Kab. Luwu Utara</option>
                                                                <option value="416">Kab. Luwu Timur</option>
                                                                <option value="417">Kab. Toraja Utara</option>
                                                                <option value="418">Kota Makassar</option>
                                                                <option value="419">Kota Pare Pare</option>
                                                                <option value="420">Kota Palopo</option>
                                                                <option value="421">Kab. Kolaka</option>
                                                                <option value="422">Kab. Konawe</option>
                                                                <option value="423">Kab. Muna</option>
                                                                <option value="424">Kab. Buton</option>
                                                                <option value="425">Kab. Konawe Selatan</option>
                                                                <option value="426">Kab. Bombana</option>
                                                                <option value="427">Kab. Wakatobi</option>
                                                                <option value="428">Kab. Kolaka Utara</option>
                                                                <option value="429">Kab. Konawe Utara</option>
                                                                <option value="430">Kab. Buton Utara</option>
                                                                <option value="431">Kota Kendari</option>
                                                                <option value="432">Kota Bau Bau</option>
                                                                <option value="433">Kab. Gorontalo</option>
                                                                <option value="434">Kab. Boalemo</option>
                                                                <option value="435">Kab. Bone Bolango</option>
                                                                <option value="436">Kab. Pohuwato</option>
                                                                <option value="437">Kab. Gorontalo Utara</option>
                                                                <option value="438">Kota Gorontalo</option>
                                                                <option value="439">Kab. Mamuju Utara</option>
                                                                <option value="440">Kab. Mamuju</option>
                                                                <option value="441">Kab. Mamasa</option>
                                                                <option value="442">Kab. Polewali Mandar</option>
                                                                <option value="443">Kab. Majene</option>
                                                                <option value="444">Kab. Maluku Tengah</option>
                                                                <option value="445">Kab. Maluku Tenggara</option>
                                                                <option value="446">Kab. Maluku Tenggara Barat
                                                                </option>
                                                                <option value="447">Kab. Buru</option>
                                                                <option value="448">Kab. Seram Bagian Timur</option>
                                                                <option value="449">Kab. Seram Bagian Barat</option>
                                                                <option value="450">Kab. Kepulauan Aru</option>
                                                                <option value="451">Kab. Maluku Barat Daya</option>
                                                                <option value="452">Kab. Buru Selatan</option>
                                                                <option value="453">Kota Ambon</option>
                                                                <option value="454">Kota Tual</option>
                                                                <option value="455">Kab. Halmahera Barat</option>
                                                                <option value="456">Kab. Halmahera Tengah</option>
                                                                <option value="457">Kab. Halmahera Utara</option>
                                                                <option value="458">Kab. Halmahera Selatan</option>
                                                                <option value="459">Kab. Kepulauan Sula</option>
                                                                <option value="460">Kab. Halmahera Timur</option>
                                                                <option value="461">Kab. Pulau Morotai</option>
                                                                <option value="462">Kota Ternate</option>
                                                                <option value="463">Kota Tidore Kepulauan</option>
                                                                <option value="464">Kab. Merauke</option>
                                                                <option value="465">Kab. Jayawijaya</option>
                                                                <option value="466">Kab. Jayapura</option>
                                                                <option value="467">Kab. Nabire</option>
                                                                <option value="468">Kab. Kepulauan Yapen</option>
                                                                <option value="469">Kab. Biak Numfor</option>
                                                                <option value="470">Kab. Puncak Jaya</option>
                                                                <option value="471">Kab. Paniai</option>
                                                                <option value="472">Kab. Mimika</option>
                                                                <option value="473">Kab. Sarmi</option>
                                                                <option value="474">Kab. Keerom</option>
                                                                <option value="475">Kab. Pegunungan Bintang</option>
                                                                <option value="476">Kab. Yahukimo</option>
                                                                <option value="477">Kab. Tolikara</option>
                                                                <option value="478">Kab. Waropen</option>
                                                                <option value="479">Kab. Boven Digoel</option>
                                                                <option value="480">Kab. Mappi</option>
                                                                <option value="481">Kab. Asmat</option>
                                                                <option value="482">Kab. Supiori</option>
                                                                <option value="483">Kab. Mamberamo Raya</option>
                                                                <option value="484">Kab. Mamberamo Tengah</option>
                                                                <option value="485">Kab. Yalimo</option>
                                                                <option value="486">Kab. Lanny Jaya</option>
                                                                <option value="487">Kab. Nduga</option>
                                                                <option value="488">Kab. Puncak</option>
                                                                <option value="489">Kab. Dogiyai</option>
                                                                <option value="490">Kab. Intan Jaya</option>
                                                                <option value="491">Kab. Deiyai</option>
                                                                <option value="492">Kota Jayapura</option>
                                                                <option value="493">Kab. Sorong</option>
                                                                <option value="494">Kab. Manokwari</option>
                                                                <option value="495">Kab. Fak Fak</option>
                                                                <option value="496">Kab. Sorong Selatan</option>
                                                                <option value="497">Kab. Raja Ampat</option>
                                                                <option value="498">Kab. Teluk Bintuni</option>
                                                                <option value="499">Kab. Teluk Wondama</option>
                                                                <option value="500">Kab. Kaimana</option>
                                                                <option value="501">Kab. Tambrauw</option>
                                                                <option value="502">Kab. Maybrat</option>
                                                                <option value="503">Kota Sorong</option>
                                                                <option value="0">Lain - Lain</option>
                                                            </select>
                                                            <input type="text" id="kota_custom" name="kota_custom" value="" class="form-control m-input m-input--square" hidden>
                                                            <span style="color: red">*Pilih Lain-Lain jika tidak
                                                                ditemukan Tempat Lahir Yang Sesuai</span><br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tanggal Lahir</b></td>
                                                        <td width="1%">:</td>
                                                        <td>
                                                            <div class="form-group m-form__group row">
                                                                <div class="col-lg-12 col-md-9 col-sm-12">
                                                                    <div class="input-group date">
                                                                        <input type="text" class="form-control m-input" value="<?= $person['tgl_lahir']; ?>" id="m_datepicker_2" name="tgllahir" />
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <i class="la la-calendar"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Alamat</b></td>
                                                        <td width="1%">:</td>
                                                        <td><textarea class="form-control" name="address" id="address" rows="2" data-error-container="#editor2_error"><?= $person['alamat']; ?></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>No. Telp</b></td>
                                                        <td width="1%">:</td>
                                                        <td><input type="text" class="form-control m-input m-input--square" id="phone" name="phone" value="<?= $person['no_telp']; ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email</b></td>
                                                        <td width="1%">:</td>
                                                        <td><input type="text" class="form-control m-input m-input--square" id="email" name="email" value="<?= user()->email; ?>"></td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td><b>Pin</b></td>
                                                        <td width="1%">:</td>
                                                        <td><input type="text" class="form-control m-input m-input--square" id="nopin" name="nopin" value=""></td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                        </form>
                                        <br>
                                        <!-- <button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" name="kirim" id="kirim" style="float: right;">Proses</button> -->
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>

    <?= $this->section('css'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/toastr/toastr.min.css">


    <link href="https://lik.unitomo.ac.id/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

    <link href="https://lik.unitomo.ac.id/assets/demo/demo10/base/style.bundle.css" rel="stylesheet" type="text/css" />



    <link href="https://lik.unitomo.ac.id/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />


    <link rel="shortcut icon" href="https://lik.unitomo.ac.id/assets/img/favicon.ico" />
    <?= $this->endSection(); ?>

    <?= $this->section('script'); ?>
    <script src="https://lik.unitomo.ac.id/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="https://lik.unitomo.ac.id/assets/demo/demo10/base/scripts.bundle.js" type="text/javascript"></script>


    <script src="https://lik.unitomo.ac.id/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
    <script src="https://lik.unitomo.ac.id/assets/vendors/custom/flot/flot.bundle.js" type="text/javascript"></script>


    <script src="https://lik.unitomo.ac.id/assets/app/js/dashboard.js" type="text/javascript"></script>

    <script src="https://lik.unitomo.ac.id/assets/demo/custom/components/base/sweetalert2.js" type="text/javascript">
    </script>



    <script src="https://lik.unitomo.ac.id/assets/demo/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="https://lik.unitomo.ac.id/assets/demo/custom/crud/forms/widgets/select2.js" type="text/javascript">
    </script>
    <?= $this->endSection(); ?>