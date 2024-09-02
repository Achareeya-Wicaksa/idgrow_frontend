<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function index()
{
    $response = Http::get("{$this->apiUrl}/barang");
    $barangs = $response->json();

    // Debug untuk memeriksa struktur data
    //dd($barangs);

    return view('barang.index', ['barangs' => $barangs]);
}

    public function store(Request $request)
    {
        $token = Session::get('access_token');
        Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post("{$this->apiUrl}/barang", $request->all());

        return redirect()->route('barang.index');
    }
    public function edit($id)
    {
        $response = Http::get("{$this->apiUrl}/barang/{$id}");
        $barang = $response->json();

    // Debugging: Tampilkan data barang untuk melihat struktur array-nya
    //dd($barang);
        return view('barang.edit', ['barang' => $response->json()]);
    }
    public function update(Request $request, $id)
    {
        $token = Session::get('access_token');
        Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put("{$this->apiUrl}/barang/{$id}", $request->all());

        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        $token = Session::get('access_token');
        Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete("{$this->apiUrl}/barang/{$id}");

        return redirect()->route('barang.index');
    }
}