<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Mutasi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => env('API_URL', 'http://localhost:8080'),
            'headers' => [
                'Authorization' => 'Bearer ' . session('access_token'),
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function index()
    {
        $response = $this->client->get('/mutasi');
        $mutasis = json_decode($response->getBody(), true);

        return view('mutasi.index', compact('mutasis'));
    }

    public function create()
    {
        return view('mutasi.create');
    }

    public function store(Request $request)
{
    // Mengambil tanggal dan waktu saat ini
    $tanggal = Carbon::now()->format('Y-m-d\TH:i:s\Z');

    // Mengirim request ke API Golang dengan data yang diperlukan
    $response = $this->client->post('/mutasi', [
        'json' => [
            'tanggal' => $tanggal, // Menggunakan tanggal saat ini
            'jenis_mutasi' => $request->jenis_mutasi,
            'jumlah' => $request->jumlah,
            'barang_id' => $request->barang_id,
        ],
    ]);

    return redirect()->route('mutasi.index');
}
public function edit(Request $request, $id)
{
    $response = $this->client->put("/mutasi/{$id}", [
        'json' => $request->all(),
        'headers' => [
            'Authorization' => 'Bearer ' . session('access_token'),
        ]
    ]);

    return redirect()->route('mutasi.index');
}


    public function update(Request $request, $id)
    {
        $response = $this->client->put("/mutasi/{$id}", [
            'json' => $request->all()
        ]);

        return redirect()->route('mutasi.index');
    }

    public function destroy($id)
    {
        $response = $this->client->delete("/mutasi/{$id}");

        return redirect()->route('mutasi.index');
    }
}
