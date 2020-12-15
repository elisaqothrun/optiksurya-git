<!-- Blog -->
<section class="blog bgwhite p-t-94 p-b-65">
<div class="container">
	<div class="sec-title p-b-52">
		<h3 class="m-text5 t-center">
			Artikel Terbaru
		</h3>
	</div>

	<div class="row">
	<?php foreach ($berita as $berita) { ?>
		<div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
			<!-- Block3 -->
			<div class="block3">
				<a href="<?php echo base_url('berita/detail/'.$berita->slug_berita) ?>" class="block3-img dis-block hov-img-zoom">
					<img src="<?php echo base_url('assets/upload/images/thumbs/'.$berita->gambar)?>" alt="IMG-BLOG">
				</a>

				<div class="block3-txt p-t-14">
					<h4 class="p-b-7">
						<a href="<?php echo base_url('berita/detail/'.$berita->slug_berita) ?>" class="m-text11">
							<?php echo $berita->judul_berita ?>
						</a>
					</h4>
					<span class="s-text6">on</span> <span class="s-text7"><?php echo $berita->tgl_update ?></span>

					<p class="s-text8 p-t-16">
						<?php echo $berita->jenis_berita ?>
					</p>
				</div>
			</div>
		</div>
	 <?php } ?>
	</div>
</div>
</section>