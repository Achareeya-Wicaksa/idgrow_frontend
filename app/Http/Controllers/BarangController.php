<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class BarangController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('API_URL'),
            'headers' => [
                'Authorization' => 'Bearer ' . session('access_token'),
                'Accept'        => 'application/json',
            ]
            
        ]);
    }

    public function index()
    {
        $response = $this->client->get('/barang');
        $barangs = json_decode($response->getBody(), true);

        return view('barang.index', compact('barangs'));
    }
    public function edit($id)
    {
        // Ambil data barang berdasarkan ID
        $response = $this->client->get("/barang/{$id}");
        $barang = json_decode($response->getBody(), true);

        // Tampilkan form edit dengan data barang yang sudah diambil
        return view('barang.edit', compact('barang'));
    }
    public function store(Request $request)
    {
        $headers = [
            'Authorization' => 'Bearer ' . session('access_token'),
            'Accept'        => 'application/json',
        ];

        $response = $this->client->post('/barang', [
            'headers' => $headers,
            'json'    => $request->all(),
        ]);
        return redirect()->route('barang.index');
    }

    public function update(Request $request, $id)
    {
        $response = $this->client->put("/barang/{$id}", [
            'json' => $request->all()
        ]);

        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        $response = $this->client->delete("/barang/{$id}");

        return redirect()->route('barang.index');
    }
}