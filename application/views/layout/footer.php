<!-- Footer -->
	<?php $nav_produk         = $this->konfigurasi_model->nav_produk();?>
	<footer class="bg6 p-t-30 p-b-43 p-l-30 p-r-30">
		<div class="flex-w p-b-80">
			<div class="w-size6 p-t-30 p-l-60 p-r-15 respon3">
				<div>
					<div class="flex-m p-t-30">
						
					</div>
				</div>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					Alamat
				</h4>

				<p class="s-text7 w-size50">
						<?php echo $site->alamat ?>
					</p>
			</div>

			<div class="w-size7 p-t-30 p-l-15 p-r-15 respon5">
				<h4 class="s-text12 p-b-30">
					Tentang
				</h4>

				<p class="s-text7 w-size27">
						Optik Surya Merupakan Aplikasi Penjualan Yang Khusus Menjual Kacamata
				</p>
			</div>

			<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Hubungi Kami
				</h4>

				<form>
					<p class="s-text7 w-size27">
						<a href="https://api.whatsapp.com/send?phone=6281235875874&text=Hai%20Produk%20Ini%20Ready%20?"><img src="<?= base_url('assets/upload/slide/wa.png') ?>"> Whatsapp</a>
					</p>
					<br>
					<p class="s-text7 w-size27">
						<img src="<?= base_url('assets/upload/slide/email.png') ?>"> <?php echo $site->email ?>
					</p>
					<br>
					 <p class="s-text7 w-size27">
						<img src="<?= base_url('assets/upload/slide/telpon.png') ?>"> <?php echo $site->telepon ?>
					</p>
				</form>
			</div>
		</div>

		<div class="t-center p-l-15 p-r-15">
			<div class="t-center s-text8 p-t-20">
				Copyright © 2020 <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Optik Surya</a>
			</div>
		</div>
	</footer>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>



<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?php echo base_url() ?>assets/template/vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script src="<?php echo base_url() ?>assets/template/js/main.js"></script>
	<script src="<?php echo base_url() ?>assets/template/js/jquery.min.js"></script>
	<!-- <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script> -->


</body>
</html>