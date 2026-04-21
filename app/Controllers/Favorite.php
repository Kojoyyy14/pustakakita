<?php

namespace App\Controllers;

class Favorite extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function tambah($id_buku)
    {
        $id_user = session()->get('id_user');
        if (!$id_user) return redirect()->to('login');
        
        $cek = $this->db->table('favorite')->where(['id_user' => $id_user, 'id_buku' => $id_buku])->get()->getRow();
        
        if (!$cek) {
            $this->db->table('favorite')->insert([
                'id_user' => $id_user,
                'id_buku' => $id_buku
            ]);
            return redirect()->back()->with('success', 'Buku berhasil masuk daftar favorit!');
        }
        
        return redirect()->back()->with('success', 'Buku sudah ada di favorit.');
    }

    public function index()
    {
        $id_user = session()->get('id_user');
        if (!$id_user) return redirect()->to('login');
        
        $data['buku_favorite'] = $this->db->table('favorite')
            ->join('buku', 'buku.id_buku = favorite.id_buku')
            ->where('favorite.id_user', $id_user)
            ->get()->getResultArray();

        return view('users/favorite', $data);
    }
}