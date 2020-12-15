<!-- content page -->
<section class="bgwhite p-t-60 p-b-25">
<div class="container">
<div class="row">
<div class="col-md-8 col-lg-9 p-b-80">
<div class="p-r-50 p-r-0-lg">
	<div class="p-b-40">
		<div class="blog-detail-img wrap-pic-w">
			<img src="<?php echo base_url('assets/upload/images/thumbs/'.$berita->gambar)?>" alt="IMG-BLOG">
		</div>

		<div class="blog-detail-txt p-t-33">
			<h4 class="p-b-11 m-text24">
				<?php echo $berita->judul_berita ?> 
			</h4>

			<div class="s-text8 flex-w flex-m p-b-21">

				<span>
					Tanggal Post : <?php echo $berita->tgl_update ?>
					<span class="m-l-3 m-r-6"></span>
				</span>
			</div>

			<p class="p-b-25">
				<?php echo $berita->jenis_berita ?> 
			</p>

			<p class="p-b-25">
				<?php echo $berita->keterangan ?> 
			</p>
		</div>
	</div>

</div>
</div>
</div>
</div>
</section>