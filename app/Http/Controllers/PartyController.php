<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat_angkut;
use App\Models\Orderan;
use App\Models\Daftar_muat;
use App\Models\Party;
use Illuminate\Support\Facades\DB;
class PartyController extends Controller
{
    public function index()
    {
        return view('party.index');
    }

    public function data()
    {
        $party = DB::table('parties')
        ->leftJoin('surat_angkuts', 'parties.nomor_sa', '=', 'surat_angkuts.nomor_sa')
        ->leftJoin('orderans', 'surat_angkuts.kode_tanda_penerima', '=', 'orderans.kode_tanda_penerima')
        ->select('parties.*','orderans.tagihan_by','orderans.status as status','orderans.tanggal_pengambilan as tanggal_pengambilan','orderans.tanggal_kirim as tanggal_kirim','orderans.tanggal_terima as tanggal_terima','orderans.tanggal_ditagihkan as tanggal_ditagihkan')->get();

        return datatables()
            ->of($party)
            ->addIndexColumn()
            ->addColumn('aksi', function ($party) {
                return '
                <div class="btn-group">

                    <button type="button" onclick="deleteData(`'. route('party.destroy', $party->id_party) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
        $get_orderan = $request->kode_tanda_penerima;
        
        $orderan = Orderan::where('kode_tanda_penerima', $get_orderan)->first();

        if(!empty($party)){
            $party = new Party();
            $party->kode_party = $request->nomor_sa;
                $party->kode_dm = $daftar_muat->kode_daftar_muat;
                $party->nomor_sa = $request->nomor_sa;

                $party->nama_customer = $orderan->nama_customer;
                $party->alamat_customer = $orderan->alamat_customer;
                $party->telepon_customer = $orderan->telepon_customer;

                $party->total_jumlah_barang = null;
                $party->total_berat_barang = null;

                $party->nama_penerima = $orderan->nama_penerima;
                $party->alamat_penerima = $orderan->alamat_penerima;
                $party->telepon_penerima = $orderan->telepon_penerima;

                $party->supir = $orderan->supir;
                $party->no_mobil = $orderan->no_mobil;
                $party->keterangan = $orderan->keterangan;
            $party->save();
            return response()->json('berhasil', 200);
        }else{
            return response()->json('gagal', 200);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $party = Party::find($id);

        return response()->json($party);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $get_party = $request->kode_party;
        
        $party = Party::where('kode_party', $get_party)->first();
        if(!empty($party)){
            $party = Party::find($id);

            $party->nomor_sa = $request->nomor_sa;

            $party->nama_customer = $request->nama_customer;
            $party->alamat_customer = $request->alamat_customer;
            $party->telepon_customer = $request->telepon_customer;

            $party->total_jumlah_barang = $request->total_jumlah_barang;
            $party->total_berat_barang = $request->total_berat_barang;

            $party->nama_penerima = $request->nama_penerima;
            $party->alamat_penerima = $request->alamat_penerima;
            $party->telepon_penerima = $request->telepon_penerima;

            $party->supir = $orderan->supir;
            $party->no_mobil = $orderan->no_mobil;
            $party->keterangan = $request->keterangan;
            $party->update();
            return response()->json('berhasil', 200);
        }else{
            return response()->json('gagal', 200);
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Party::find($id)->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->party as $id) {
            $party = Party::find($id);
            $party->delete();
        }

        return response(null, 204);
    }

    // public function exportCSV()
    // {
        
        
    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename="party_' . date('Ymd_His') . '.csv"',
    //     ];
    
    //     $callback = function () use ($party) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, array_keys($party[0]));
    //         foreach ($party as $row) {
    //             fputcsv($file, $row);
    //         }
    //         fclose($file);
    //     };
    
    //     return response()->stream($callback, 200, $headers);
    // }

    public function exportCSV()
{
    $party = Party::get()->toArray();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="party_' . date('Ymd_His') . '.csv"',
    ];

    $callback = function () use ($party) {
        $file = fopen('php://output', 'w');
        fputcsv($file, array_keys($party[0]));
        foreach ($party as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
public function exportfilter(Request $request)
{

    $kode_party = $request->kode_party;
    $kode_dm = $request->kode_dm;
    $nomor_sa = $request->nomor_sa;
    $nama_customer = $request->nama_customer;
    $nama_penerima = $request->nama_penerima;
    $supir = $request->supir;
    $no_mobil = $request->no_mobil;


    $party = Party::when($kode_party, function ($query) use ($kode_party) {
        return $query->where('kode_party', $kode_party);
    })
    ->when($kode_dm, function ($query) use ($kode_dm) {
        return $query->where('kode_dm', $kode_dm);
    })
    ->when($nomor_sa, function ($query) use ($nomor_sa) {
        return $query->where('nomor_sa', $nomor_sa);
    })
    ->when($nama_customer, function ($query) use ($nama_customer) {
        return $query->where('nama_customer', $nama_customer);
    })
    ->when($nama_penerima, function ($query) use ($nama_penerima) {
        return $query->where('nama_penerima', $nama_penerima);
    })
    ->when($supir, function ($query) use ($supir) {
        return $query->where('supir', $supir);
    })
    ->when($no_mobil, function ($query) use ($no_mobil) {
        return $query->where('no_mobil', $no_mobil);
    })
    ->get()->toArray();


    $total_berat = 0;
    $total_semua_harga = 0;
    $total_jumlah_barang = 0;
    foreach($party as $pt) {
        $total_berat += $pt['berat_barang'];
        $total_semua_harga += $pt['total_harga'];
        $total_jumlah_barang += $pt['jumlah_barang'];
    }
    $party[] = ['', '', '', '', '', ''];
    $party[] = ['Total Berat Barang', $total_berat, '', '', '', ''];
    $party[] = ['Total Semua Harga',  $total_semua_harga, '', '', ''];
    $party[] = ['Total Jumlah Barang',  $total_jumlah_barang, '', '', ''];

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="party_' . date('Ymd_His') . '.csv"',
    ];

    $callback = function () use ($party) {
        $file = fopen('php://output', 'w');
        fputcsv($file, array_keys($party[0]));
        foreach ($party as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}
