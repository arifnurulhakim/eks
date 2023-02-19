<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orderan;
use App\Models\Harga;
use League\Csv\Writer;
use Dompdf\Dompdf;
use Dompdf\Options;
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
                    <button type="button" onclick="exportPDF(`'. route('orderan.exportPDF', $orderan->id_orderan) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-book"></i></button>
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

    public function exportCSV()
    {
        $orderan = Orderan::get();
     
// Generate a timestamp for the filename
$timestamp = date('YmdHis');

// Set the headers to download the file with the timestamp in the filename
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="orderan_'.$timestamp.'.csv"');
    
        // Create a new instance of the League CSV Writer
        $csv = Writer::createFromString('');
    
        // Add the header row
        $csv->insertOne([
            'ID Orderan',
            'Kode Tanda Penerima',
            'Nama Customer',
            'Alamat Customer',
            'Telepon Customer',
            'Nama Barang',
            'Jumlah Barang',
            'Berat Barang',
            'Nama Penerima',
            'Alamat Penerima',
            'Telepon Penerima',
            'Supir',
            'No. Mobil',
            'Keterangan',
            'Tanggal Pengambilan',
            'Tanggal Kirim',
            'Tanggal Terima',
            'Harga',
            'Created At',
            'Updated At'
        ]);
    
        // Add the data rows
        foreach ($orderan as $order) {
            $csv->insertOne([
                $order->id_orderan,
                $order->kode_tanda_penerima,
                $order->nama_customer,
                $order->alamat_customer,
                $order->telepon_customer,
                $order->nama_barang,
                $order->jumlah_barang,
                $order->berat_barang,
                $order->nama_penerima,
                $order->alamat_penerima,
                $order->telepon_penerima,
                $order->supir,
                $order->no_mobil,
                $order->keterangan,
                $order->tanggal_pengambilan,
                $order->tanggal_kirim,
                $order->tanggal_terima,
                $order->harga,
                $order->created_at,
                $order->updated_at
            ]);
        }
    
        // Return the CSV file as a response
        return response($csv->__toString());
    }

    public function exportPDF($id)
{
    $orderan = Orderan::find($id);

    // Membuat file PDF
    $options = new Options();
    $options->setIsRemoteEnabled(true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml(view('orderan.pdf', compact('orderan'))->render());
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Menghasilkan file PDF dan mengirimkan ke browser
    return $dompdf->stream('orderan'.$orderan->kode_tanda_penerima . $orderan->created_at . '.pdf');
}
    

}
