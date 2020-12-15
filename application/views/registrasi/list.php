<!-- Shopping Cart Section Begin --> 
<section class="shopping-cart spad">
<div class="container">
<h2><?php echo $title ?></h2>
<br>
<?php if($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-warning">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
?>
<p class="alert alert-success">Sudah punya akun ? Silahkan <a href="<?php echo base_url('masuk') ?>" class="btn btn-info"> Login Disini</a></p>
<div class="col-md-12">
<!--  -->
<?php 
	//valiadasi error
	echo validation_errors('<div class="alert alert-warning">','</div>');
	//form open
	echo form_open(base_url('registrasi'), 'class="leave-comment"'); ?>
		<table class="table">
			<thead>
				<tr>
					<th>Nama </th>
					<th><input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama_pelanggan')?>" required></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>Email </th>
					<td><input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email')?>" required></td>
				</tr>
				<tr>
					<th>Password </th>
					<td><input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password')?>" required></td>
				</tr>
				<tr>
					<th>Telepon/Hp </th>
					<td><input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo set_value('telepon')?>" required></td>
				</tr>
				<tr>
					<th>Alamat </th>
					<td><textarea name="alamat" class="form-control" placeholder="Alamat"  required><?php echo set_value('alamat') ?></textarea> 
				</tr>
				<tr>
					<td></td>
					<td>
					<button class="btn btn-success btn-lg" type="submit">Daftar</button>
					</td>
				</tr>
			</tbody>
		</table>

<?php echo form_close(); ?>
	
</div>

<div class="col-lg-12">
</div>
</div>
</section>
<!-- Shopping Cart Section End