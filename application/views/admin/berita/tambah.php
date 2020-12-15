<?php 
// error upload
if(isset($error)){
  echo '<p class="alert alert-warning">';
  echo $error;
  echo '</p>';
}
echo validation_errors('<div class= "alert alert-danger">', '</div>');
// form open
echo form_open_multipart(base_url('admin/berita/tambah'),' class="form-horizontal"');
?>
<div class="form-group form-group-lg row">
  <label class="col-md-2 col-form-label">Jenis Berita</label>
    <div class="col-md-5">
      <input type="text" name="jenis_berita" class="form-control" placeholder="Jenis Berita" value="<?php echo set_value('jenis_berita')?>" required>
    </div>
</div>
<div class="form-group form-group-lg row">
  <label class="col-md-2 col-form-label">Judul Berita</label>
    <div class="col-md-5">
      <input type="text" name="judul_berita" class="form-control" placeholder="Judul Berita" value="<?php echo set_value('judul_berita')?>" required>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-2 col-form-label">Detail Berita</label>
    <div class="col-md-10">
      <textarea name="keterangan" class="form-control" placeholder="Keterangan" id="editor"><?php echo set_value('keterangan')?></textarea>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-2 col-form-label">Keyword(Untuk SEO Google)</label>
    <div class="col-md-10">
      <textarea name="keyword" class="form-control" placeholder="Keyword" ><?php echo set_value('keyword')?></textarea>
    </div>
</div>
<div class="form-group row">
  <label class="col-md-2 col-form-label">Gambar Berita</label>
    <div class="col-md-10">
      <input type="file" name="gambar" class="form-control" required="required">
    </div>
</div>
<div class="form-group row">
  <label class="col-md-2 col-form-label">Status Berita</label>
    <div class="col-md-10">
    <select name="status_berita" class="form-control">
      <option value="Publish">Publikasikan</option>
      <option value="Draft">Simpan Sebagai Draft</option>      
    </select>
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
