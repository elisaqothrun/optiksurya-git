<p>
	<a href="<?php echo base_url('admin/rekening/tambah')?>" class="btn btn-success btn-lg">
		<i class="fa fa-plus"></i>Tambah Data
	</a>
</p>
<!-- nptifikasi -->
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
			<th>Nama Bank</th>
			<th>No Rekening</th>
			<th>Nama Pemilik</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $no=1; foreach ($rekening as $rekening) {?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $rekening->nama_bank?></td>
			<td><?php echo $rekening->no_rekening ?></td>
			<td><?php echo $rekening->nama_pemilik ?></td>
			<td>
				<a href="<?php echo base_url('admin/rekening/edit/'.$rekening->id_rekening)?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i>Edit</a>
				<a href="<?php echo base_url('admin/rekening/delete/'.$rekening->id_rekening)?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini ?')"><i class="fa fa-trash"></i>Hapus</a>
			</td>

		</tr>
	<?php } ?>
	</tbody>
</table>