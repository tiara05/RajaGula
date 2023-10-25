<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\review;
use App\Models\Kategori;

class PelangganHomeController extends Controller
{
    public function landing()
    {

        return view('Pelanggan.landing');
    }

    public function index()
    {
        $produk = Produk::with(['kategori'])->get();
        $produk2 = Produk::orderBy('harga', 'desc')->get();
        $produk3 = Produk::orderBy('harga', 'desc')->get();
        
        return view('Pelanggan.page.home.home', compact('produk', 'produk2', 'produk3'));
    }

    public function view($id)
    {
        $kategori = kategori::all();

        $produk = produk::find($id);

        $review = review::with(['produk'])
        ->with(['user'])
        ->where('id_produk', '=', $id)
        ->get();

        return view('Pelanggan.Page.home.detail', compact('produk', 'kategori', 'review'));
    }
}