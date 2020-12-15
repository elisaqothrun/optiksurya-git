<?php 
echo validation_errors('<div class= "alert alert-danger">', '</div>');
// form open
echo form_open(base_url('admin/rekening/tambah'),' class="form-horizontal"');
?>
<div class="form-group row">
  <label class="col-md-2 col-form-label">Nama Bank</label>
    <div class="col-md-5">
      <input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank" value="<?php echo set_value('nama_bank')?>" required>
    </div>
</div>

<div class="form-group row">
  <label class="col-md-2 col-form-label">Nomor Rekening</label>
    <div class="col-md-5">
      <input type="number" name="no_rekening" class="form-control" placeholder="Nomor Rekening" value="<?php echo set_value('no_rekening')?>" required>
</div>
</div>

<div class="form-group row">
  <label class="col-md-2 col-form-label">Nama Pemilik Rekening</label>
    <div class="col-md-5">
      <input type="text" name="nama_pemilik" class="form-control" placeholder="Nama Pemilik Rekening" value="<?php echo set_value('nama_pemilik')?>" required>
  </div>
  </div>
  
</div>
<div class="form-group row">
  <label class="col-md-2 col-form-label"></label>
  <div class="col-md-5">
    <button class="btn btn-success btn-lg" name= "submit" type="submit">
    <i class="fa fa-save"></i> Simpan
    </button>
    <button class="btn btn-danger btn-lg" name= "reset" type="reset">
    <i class="fa fa-times"></i> Reset
    </button>
   </div>
</div>
<?php echo form_close(); ?>
