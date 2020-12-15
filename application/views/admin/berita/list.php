<p>
	<a href="<?php echo base_url('admin/berita/tambah')?>" class="btn btn-success btn-lg">
		<i class="fa fa-plus"></i>Tambah Data
	</a>
</p>
<!-- notifikasi -->
<?php 
if ($this->session->flashdata('sukses')) 
{
	echo '<p class="alert alert-info">';
	echo $this->session->flashdata('sukses');
	echo'</div>';
}
?>
<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th>No</th>
			<th>GAMBAR</th>
			<th>JENIS BERITA</th>
			<th>JUDUL BERITA</th>
			<th>STATUS BERITA</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $no=1; foreach ($berita as $berita) {?>
		<tr>
			<td><?php echo $no ?></td>
			<td>
				<img src="<?php echo base_url('assets/upload/images/thumbs/'.$berita->gambar)?>" class="img img-responsive img-thumbnail" width="60">
			</td>
			<td><?php echo $berita->jenis_berita ?></td>
			<td><?php echo $berita->judul_berita ?></td>
			<td><?php echo $berita->status_berita ?></td>
			<td>
				<a href="<?php echo base_url('admin/berita/edit/'.$berita->id_berita) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
				
				<?php include ('delete.php') ?>
			</td>

		</tr>
		<?php $no++; } ?>
	</tbody>
</table>