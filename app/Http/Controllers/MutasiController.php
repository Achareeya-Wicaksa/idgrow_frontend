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
    $request->validate([
        'tanggal' => 'required|date',
        'jenis_mutasi' => 'required|string',
        'jumlah' => 'required|integer',
        'barang_id' => 'required|integer',
    ]);

    // Mendapatkan user_id dari auth
    $user_id = auth()->id();

    // Menyimpan data mutasi
    $mutasi = new Mutasi([
        'tanggal' => $request->input('tanggal'),
        'jenis_mutasi' => $request->input('jenis_mutasi'),
        'jumlah' => $request->input('jumlah'),
        'barang_id' => $request->input('barang_id'),
        'user_id' => $user_id,
    ]);

    $mutasi->save();

    return redirect()->route('mutasi.index')->with('success', 'Mutasi berhasil ditambahkan');
}


    public function edit($id)
    {
        // Ambil data barang berdasarkan ID
        $response = $this->client->get("/mutasi/{$id}");
        $mutasi = json_decode($response->getBody(), true);
        //dd($mutasi);
        // Tampilkan form edit dengan data barang yang sudah diambil
        return view('mutasi.edit', compact('mutasi'));
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
