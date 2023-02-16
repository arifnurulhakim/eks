<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat_angkut;
use App\Models\Orderan;
class SuratAngkutController extends Controller
{
    public function index()
    {
        return view('surat_angkut.index');
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
                    <button type="button" onclick="editForm(`'. route('sa.update', $surat_angkut->id_sa) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('sa.destroy', $surat_angkut->id_sa) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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

    // public function cetakBarcode(Request $request)
    // {
    //     $dataproduk = array();
    //     foreach ($request->id_produk as $id) {
    //         $produk = Produk::find($id);
    //         $dataproduk[] = $produk;
    //     }

    //     $no  = 1;
    //     $pdf = PDF::loadView('produk.barcode', compact('dataproduk', 'no'));
    //     $pdf->setPaper('a4', 'potrait');
    //     return $pdf->stream('produk.pdf');
    // }
}
