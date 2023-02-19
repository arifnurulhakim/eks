<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat_angkut;
use App\Models\Daftar_muat;
use App\Models\Orderan;
use League\Csv\Writer;
use Dompdf\Dompdf;
use Dompdf\Options;
class SuratAngkutController extends Controller
{
    public function index()
    {
        $orderans = Orderan::all();
        return view('surat_angkut.index', compact('orderans'));
    }

    public function data()
    {
        

        $surat_angkut = Surat_angkut::get();

        return datatables()
            ->of($surat_angkut)
            ->addIndexColumn()
            ->addColumn('aksi', function ($surat_angkut) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('surat_angkut.update', $surat_angkut->id_sa) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('surat_angkut.destroy', $surat_angkut->id_sa) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                    <button type="button" onclick="exportPDF(`'. route('surat_angkut.exportPDF', $surat_angkut->id_sa) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-book"></i></button>
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


        if(!empty($orderan)){
            $Surat_angkut = new Surat_angkut();
            $Surat_angkut->nomor_sa = $request->nomor_sa;
            $Surat_angkut->kode_tanda_penerima = $request->kode_tanda_penerima;
            $Surat_angkut->nama_customer = $orderan->nama_customer;
            $Surat_angkut->alamat_customer = $orderan->alamat_customer;
            $Surat_angkut->telepon_customer = $orderan->telepon_customer;
            $Surat_angkut->nama_barang = $orderan->nama_barang;
            $Surat_angkut->jumlah_barang = $orderan->jumlah_barang;
            $Surat_angkut->berat_barang = $orderan->berat_barang;
            $Surat_angkut->nama_penerima = $orderan->nama_penerima;
            $Surat_angkut->alamat_penerima = $orderan->alamat_penerima;
            $Surat_angkut->telepon_penerima = $orderan->telepon_penerima;
            $Surat_angkut->supir = $orderan->supir;
            $Surat_angkut->no_mobil = $orderan->no_mobil;
            $Surat_angkut->keterangan = $orderan->keterangan;
            $Surat_angkut->tanggal_pengambilan = $orderan->tanggal_pengambilan;
            $Surat_angkut->harga = $orderan->harga;
            $Surat_angkut->save();
            if(!empty($Surat_angkut)){


            $daftar_muat = new Daftar_muat();

            $total_harga = ($orderan->jumlah_barang * $orderan->berat_barang) * $orderan->harga;

            $daftar_muat->kode_daftar_muat = $request->nomor_sa;
            $daftar_muat->nomor_sa = $request->nomor_sa;
            $daftar_muat->supir = $orderan->supir;
            $daftar_muat->no_mobil = $orderan->no_mobil;
            $daftar_muat->nama_customer = $orderan->nama_customer;
            $daftar_muat->nama_penerima = $orderan->nama_penerima;
            $daftar_muat->jumlah_barang = $orderan->jumlah_barang;
            $daftar_muat->berat_barang = $orderan->berat_barang;
            $daftar_muat->harga = $orderan->harga;
            $daftar_muat->total_harga =$total_harga;


            $daftar_muat->keterangan = $orderan->keterangan;
            $daftar_muat->save();
            
            }
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
        $surat_angkut = Surat_angkut::find($id);

        return response()->json($surat_angkut);
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
        $get_orderan = $request->kode_tanda_penerima;
        
        $orderan = Orderan::where('kode_tanda_penerima', $get_orderan)->first();
        if(!empty($orderan)){
            $Surat_angkut = Surat_angkut::find($id);
            $berat_barang = $orderan->berat_barang;
            $Surat_angkut->nomor_sa = $request->nomor_sa;
            $Surat_angkut->kode_tanda_penerima = $request->kode_tanda_penerima;
            $Surat_angkut->nama_customer = $request->nama_customer;
            $Surat_angkut->alamat_customer = $request->alamat_customer;
            $Surat_angkut->telepon_customer = $request->telepon_customer;
            $Surat_angkut->nama_barang = $request->nama_barang;
            $Surat_angkut->jumlah_barang = $orderan->jumlah_barang;
            $Surat_angkut->berat_barang = $orderan->berat_barang;
            $Surat_angkut->nama_penerima = $orderan->nama_penerima;
            $Surat_angkut->alamat_penerima = $orderan->alamat_penerima;
            $Surat_angkut->telepon_penerima = $orderan->telepon_penerima;
            $Surat_angkut->supir = $orderan->supir;
            $Surat_angkut->no_mobil = $orderan->no_mobil;
            $Surat_angkut->keterangan = $orderan->keterangan;
            $Surat_angkut->tanggal_pengambilan = $orderan->tanggal_pengambilan;
            $Surat_angkut->harga = $orderan->harga;
            $Surat_angkut->update();
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
        $surat_angkut = Surat_angkut::find($id)->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->surat_angkut as $id) {
            $surat_angkut = Surat_angkut::find($id);
            $surat_angkut->delete();
        }

        return response(null, 204);
    }

    public function exportCSV()
{
    $surat_angkut = Surat_angkut::get()->toArray();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="sa_' . date('Ymd_His') . '.csv"',
    ];

    $callback = function () use ($surat_angkut) {
        $file = fopen('php://output', 'w');
        fputcsv($file, array_keys($surat_angkut[0]));
        foreach ($surat_angkut as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

    public function exportPDF($id)
{
    $surat_angkut = Surat_angkut::find($id);

    // Membuat file PDF
    $options = new Options();
    $options->setIsRemoteEnabled(true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml(view('surat_angkut.pdf', compact('surat_angkut'))->render());
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Menghasilkan file PDF dan mengirimkan ke browser
    return $dompdf->stream('surat_angkut'.$surat_angkut->nomor_sa . $surat_angkut->created_at . '.pdf');
}
}
