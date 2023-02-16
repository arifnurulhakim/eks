<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="kode_tanda_penerima" class="col-lg-2 col-lg-offset-1 control-label">Kode Tanda Terima</label>
                        <div class="col-lg-6">
                            <input type="number" name="kode_tanda_penerima" id="kode_tanda_penerima" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_customer" class="col-lg-2 col-lg-offset-1 control-label">Nama customer</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_customer" id="nama_customer" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat_customer" class="col-lg-2 col-lg-offset-1 control-label">Alamat customer</label>
                        <div class="col-lg-6">
                            <textarea name="alamat_customer" id="alamatcustomera" rows="3" class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telepon_customer" class="col-lg-2 col-lg-offset-1 control-label">Telepon customer</label>
                        <div class="col-lg-6">
                            <input type="number" name="telepon_customer" id="telepon_customer" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_barang" class="col-lg-2 col-lg-offset-1 control-label">Nama barang</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_barang" class="col-lg-2 col-lg-offset-1 control-label">Jumlah Barang</label>
                        <div class="col-lg-6">
                            <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="berat_barang" class="col-lg-2 col-lg-offset-1 control-label">Berat Barang</label>
                        <div class="col-lg-6">
                            <input type="number" name="berat_barang" id="berat_barang" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_penerima" class="col-lg-2 col-lg-offset-1 control-label">Nama Penerima</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat_penerima" class="col-lg-2 col-lg-offset-1 control-label">Alamat Penerima</label>
                        <div class="col-lg-6">
                            <textarea name="alamat_penerima" id="alamat_penerima" rows="3" class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telepon_penerima" class="col-lg-2 col-lg-offset-1 control-label">Telepon Penerima</label>
                        <div class="col-lg-6">
                            <input type="number" name="telepon_penerima" id="telepon_penerima" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="supir" class="col-lg-2 col-lg-offset-1 control-label">Supir</label>
                        <div class="col-lg-6">
                            <input type="text" name="supir" id="supir" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_mobil" class="col-lg-2 col-lg-offset-1 control-label">Nomor Mobil</label>
                        <div class="col-lg-6">
                            <input type="text" name="no_mobil" id="no_mobil" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="keterangan" class="col-lg-2 col-lg-offset-1 control-label">Keterangan</label>
                        <div class="col-lg-6">
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_pengambilan" class="col-lg-2 col-lg-offset-1 control-label">tanggal Pengambilan</label>
                        <div class="col-lg-6">
                            <input type="datetime-local" name="tanggal_pengambilan" id="tanggal_pengambilan" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>