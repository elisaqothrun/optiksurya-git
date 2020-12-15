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
<p class="alert alert-success">Belum punya akun ? Silahkan <a href="<?php echo base_url('registrasi') ?>" class="btn btn-info"> Daftar Disini</a></p>
<div class="col-md-12">
<!--  -->
<?php 
	//valiadasi error
	echo validation_errors('<div class="alert alert-warning">','</div>');

	//display notifikasi error login
	if($this->session->flashdata('warning')) {
		echo '<div class="alet alert-warning">';
		echo $this->session->flashdata('warning');
		echo '</div>';
	}

	//display notifikasi sukses logout
	if($this->session->flashdata('sukses')) {
		echo '<div class="alet alert-success">';
		echo $this->session->flashdata('sukses');
		echo '</div>';
	}
	//form open
	echo form_open(base_url('masuk'), 'class="leave-comment"'); ?>
		<table class="table">
			<tbody>
				<tr>
					<td>Email </td>
					<td><input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email')?>" required></td>
				</tr>
				<tr>
					<td>Password </td>
					<td><input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password')?>" required></td>
				</tr>
				<tr>
					<td></td>
					<td>
					<button class="btn btn-success btn-lg" type="submit">Login</button>
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