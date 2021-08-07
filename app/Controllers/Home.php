<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if (in_groups('Mahasiswa'))	return redirect()->route('mahasiswa');
		if (in_groups('Dosen'))	return redirect()->route('dosen');
		return redirect()->to(base_url("/logout"));
	}

	public function profile()
	{
		return view('profile');
	}
}
