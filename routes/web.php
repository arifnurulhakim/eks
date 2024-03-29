<?php

use App\Http\Controllers\{
    DashboardController,
    KategoriController,
    LaporanController,
    ProdukController,
    MemberController,
    PengeluaranController,
    PembelianController,
    PembelianDetailController,
    PenjualanController,
    PenjualanDetailController,
    SettingController,
    SupplierController,
    HargaController,
    CustomerController,
    PenerimaController,
    OrderanController,
    SuratAngkutController,
    InvoiceController,
    DaftarMuatController,
    PartyController,
    UserController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'level:1'], function () {
        Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
        Route::resource('/kategori', KategoriController::class);

        Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
        Route::post('/produk/delete-selected', [ProdukController::class, 'deleteSelected'])->name('produk.delete_selected');
        Route::post('/produk/cetak-barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetak_barcode');
        Route::resource('/produk', ProdukController::class);

        Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
        Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');
        Route::resource('/member', MemberController::class);

        Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
        Route::resource('/supplier', SupplierController::class);
        
        Route::get('/harga/data', [HargaController::class, 'data'])->name('harga.data');
        Route::resource('/harga', HargaController::class);

        Route::get('/customer/data', [CustomerController::class, 'data'])->name('customer.data');
        Route::resource('/customer', CustomerController::class);
        Route::get('/penerima/data', [PenerimaController::class, 'data'])->name('penerima.data');
        Route::resource('/penerima', PenerimaController::class);
        
        Route::get('/orderan/data', [OrderanController::class, 'data'])->name('orderan.data');
        Route::get('/orderan/exportCSV', [OrderanController::class, 'exportCSV'])->name('orderan.exportCSV');
        Route::get('/orderan/exportPDF/{id}', [OrderanController::class, 'exportPDF'])->name('orderan.exportPDF');
        Route::resource('/orderan', OrderanController::class);

        
        Route::get('/surat_angkut/data', [SuratAngkutController::class, 'data'])->name('surat_angkut.data');
        Route::get('/surat_angkut/update_status/{id}', [SuratAngkutController::class, 'update_status'])->name('surat_angkut.update_status');
        Route::get('/surat_angkut/exportCSV', [SuratAngkutController::class, 'exportCSV'])->name('surat_angkut.exportCSV');
        Route::get('/surat_angkut/exportPDF/{id}', [SuratAngkutController::class, 'exportPDF'])->name('surat_angkut.exportPDF');
        Route::resource('/surat_angkut', SuratAngkutController::class);

        Route::get('/invoice/data', [InvoiceController::class, 'data'])->name('invoice.data');
        Route::get('/invoice/update_status/{id}', [InvoiceController::class, 'update_status'])->name('invoice.update_status');
        Route::get('/invoice/exportCSV', [InvoiceController::class, 'exportCSV'])->name('invoice.exportCSV');
        Route::get('/invoice/exportPDF/{id}', [InvoiceController::class, 'exportPDF'])->name('invoice.exportPDF');
        Route::post('/invoice/exportfilter', [InvoiceController::class, 'exportfilter'])->name('invoice.exportfilter');
        Route::resource('/invoice', InvoiceController::class);

        Route::get('/dm/data', [DaftarMuatController::class, 'data'])->name('dm.data');
        Route::get('/dm/exportCSV', [DaftarMuatController::class, 'exportCSV'])->name('dm.exportCSV');
        Route::post('/dm/exportfilter', [DaftarMuatController::class, 'exportfilter'])->name('dm.exportfilter');
        Route::resource('/dm', DaftarMuatController::class);

        Route::get('/party/data', [PartyController::class, 'data'])->name('party.data');
        Route::get('/party/exportCSV', [PartyController::class, 'exportCSV'])->name('party.exportCSV');
        Route::post('/party/exportfilter', [PartyController::class, 'exportfilter'])->name('party.exportfilter');
        Route::resource('/party', PartyController::class);

        Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
        Route::resource('/pengeluaran', PengeluaranController::class);

        Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
        Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
        Route::resource('/pembelian', PembelianController::class)
            ->except('create');

        Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
        Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
        Route::resource('/pembelian_detail', PembelianDetailController::class)
            ->except('create', 'show', 'edit');

        Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
        Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
    });

    Route::group(['middleware' => 'level:1,2'], function () {
        Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
        Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
        Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
        Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
        Route::get('/transaksi/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');

        Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
        Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
        Route::resource('/transaksi', PenjualanDetailController::class)
            ->except('create', 'show', 'edit');
    });

    Route::group(['middleware' => 'level:1'], function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
        Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');

        Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
        Route::resource('/user', UserController::class);

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::get('/setting/first', [SettingController::class, 'show'])->name('setting.show');
        Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
    });
 
    Route::group(['middleware' => 'level:1,2'], function () {
        Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::post('/profil', [UserController::class, 'updateProfil'])->name('user.update_profil');
    });
});