<?php 
if ($this->session->flashdata('sukses')) 
{
	echo '<p class="alert alert-info">';
	echo $this->session->flashdata('sukses');
	echo'</div>';
}
?>
<?php 
// error upload
if(isset($error)){
  echo '<p class="alert alert-warning">';
  echo $error;
  echo '</p>';
}
echo validation_errors('<div class= "alert alert-danger">', '</div>');
// form open
echo form_open_multipart(base_url('admin/konfigurasi'),' class="form-horizontal"');
?>
<div class="form-group form-group-lg row">
  <label class="col-md-3 col-form-label">Nama Website</label>
    <div class="col-md-8">
      <input type="text" name="namaweb" class="form-control" placeholder="Nama Website" value="<?php echo $konfigurasi->namaweb ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Tagline</label>
    <div class="col-md-8">
      <input type="text" name="tagline" class="form-control" placeholder="Tagline" value="<?php echo $konfigurasi->tagline ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Email</label>
    <div class="col-md-8">
      <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $konfigurasi->email ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Website</label>
    <div class="col-md-8">
      <input type="text" name="website" class="form-control" placeholder="Website" value="<?php echo $konfigurasi->website ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Telepon/Hp</label>
    <div class="col-md-8">
      <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $konfigurasi->telepon ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Alamat</label>
    <div class="col-md-8">
      <input type="text" name="alamat" class="form-control" placeholder="alamat" value="<?php echo $konfigurasi->alamat ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Telepon/Hp</label>
    <div class="col-md-8">
      <input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $konfigurasi->telepon ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Alamat Facebook</label>
    <div class="col-md-8">
      <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="<?php echo $konfigurasi->facebook ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Alamat Instagram</label>
    <div class="col-md-8">
      <input type="text" name="instagram" class="form-control" placeholder="Instagram" value="<?php echo $konfigurasi->instagram ?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Keyword(Untuk SEO Google)</label>
    <div class="col-md-9">
      <textarea name="keyword" class="form-control" placeholder="Keyword" ><?php echo $konfigurasi->keyword ?></textarea>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Metatext</label>
    <div class="col-md-9">
      <textarea name="metatext" class="form-control" placeholder="Metatext" ><?php echo $konfigurasi->metatext ?></textarea>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Deskripsi Website</label>
    <div class="col-md-9">
      <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" ><?php echo $konfigurasi->deskripsi ?></textarea>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label">Rekening Pembayaran</label>
    <div class="col-md-9">
      <textarea name="rekening_pembayaran" class="form-control" placeholder="Rekening Pembayaran" ><?php echo $konfigurasi->rekening_pembayaran ?></textarea>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-3 col-form-label"></label>
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
