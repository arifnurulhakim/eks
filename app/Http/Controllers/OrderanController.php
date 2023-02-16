<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orderan;
use App\Models\Harga;
class OrderanController extends Controller
{
    public function index()
    {
        return view('orderan.index');
    }

    public function data()
    {
        $orderan = Orderan::get();

        return datatables()
            ->of($orderan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($orderan) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('orderan.update', $orderan->id_orderan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('orderan.destroy', $orderan->id_orderan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $get_nama_customer = $request->nama_customer;
        $get_alamat_customer = $request->alamat_customer;
        $get_alamat_penerima = $request->alamat_penerima;
        
        $get_harga = Harga::where('nama_customer', $get_nama_customer)
                        ->where('alamat_customer', $get_alamat_customer)
                        ->where('alamat_penerima', $get_alamat_penerima)
                        ->first();
        $harga = ($request->berat_barang * $get_harga->harga) * $request->jumlah_barang;
   
        $orderan = new Orderan();
        $orderan->kode_tanda_penerima = $request->kode_tanda_penerima;
        $orderan->nama_customer = $request->nama_customer;
        $orderan->alamat_customer = $request->alamat_customer;
        $orderan->telepon_customer = $request->telepon_customer;
        $orderan->nama_barang = $request->nama_barang;
        $orderan->jumlah_barang = $request->jumlah_barang;
        $orderan->berat_barang = $request->berat_barang;
        $orderan->nama_penerima = $request->nama_penerima;
        $orderan->alamat_penerima = $request->alamat_penerima;
        $orderan->telepon_penerima = $request->telepon_penerima;
        $orderan->supir = $request->supir;
        $orderan->no_mobil = $request->no_mobil;
        $orderan->keterangan = $request->keterangan;
        $orderan->tanggal_pengambilan = $request->tanggal_pengambilan;
        $orderan->harga = $harga;
        $orderan->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderan = Orderan::find($id);

        return response()->json($orderan);
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
        $orderan = Orderan::find($id);
        $orderan->id_orderan = $request->kode_tanda_penerima;
        $orderan->nama_customer = $request->nama_customer;
        $orderan->alamat_customer = $request->alamat_customer;
        $orderan->telepon_customer = $request->telepon_customer;
        $orderan->nama_barang = $request->nama_barang;
        $orderan->jumlah_barang = $request->jumlah_barang;
        $orderan->berat_barang = $request->berat_barang;
        $orderan->nama_penerima = $request->nama_penerima;
        $orderan->alamat_penerima = $request->alamat_penerima;
        $orderan->telepon_penerima = $request->telepon_penerima;
        $orderan->supir = $request->supir;
        $orderan->no_mobil = $request->no_mobil;
        $orderan->keterangan = $request->keterangan;
        $orderan->tanggal_pengambilan = $request->tanggal_pengambilan;
        $orderan->update();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderan = Orderan::find($id)->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_orderan as $id) {
            $orderan = Orderan::find($id);
            $orderan->delete();
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
