<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
<div class="container">
<?php if($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
?>
	<!-- Cart item -->
	<div class="container-table-cart pos-relative">
		<div class="wrap-table-shopping-cart bgwhite">
		<h2><?php echo $title ?></h2><hr>
		
		<br>
			<table class="table-shopping-cart">
				<tr class="table-head">
					<th class="column-1">GAMBAR</th>
					<th class="column-2">PRODUK</th>
					<th class="column-3">HARGA</th>
					<th class="column-4 p-l-70">Quantity</th>
					<th class="column-5">SUBTOTAL</th>
					<th class="column-6" width="20%">AKSI</th>
				</tr>

				<?php 

				foreach ($keranjang as $keranjang) { 
					//ambil data produk
            	$id_produk 	= $keranjang['id'];
            	$produk 	= $this->produk_model->detail($id_produk);
                 //form update
                echo form_open(base_url('belanja/update_cart/'.$keranjang['rowid']));

				?>
				<tr class="table-row">
					<td class="column-1">
						<div class="cart-img-product b-rad-4 o-f-hidden">
							<img src="<?php echo base_url('assets/upload/images/thumbs/'.$produk->gambar)?>" alt="IMG-PRODUCT">
						</div>
					</td>
					<td class="column-2"><?php echo $keranjang['name'] ?></td>
					<td class="column-3">Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?></td>
					<td class="column-4">
						<div class="flex-w bo5 of-hidden w-size17">
							<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
								<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
							</button>

							<input class="size8 m-text18 t-center num-product" type="number" name="qty" value="<?php echo $keranjang['qty'] ?>">

							<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
								<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
							</button>
						</div>
					</td>
					<td class="column-5">Rp.
                    	<?php
                    	$subtotal= $keranjang['price'] * $keranjang['qty'];
                    	echo number_format($subtotal,'0',',','.' );
                    	?>		
                    </td>
                    <td>
                     <button type="submit" name="update" class="btn btn-warning"><i class="fa fa-edit"> Update</i></button>   
                    <a href="<?php echo base_url('belanja/hapus/'.$keranjang['rowid']) ?>" name="hapus" class="btn btn-secondary"><i class="fa fa-trash-o"> Hapus</i></a>   
                    </td>
					<td><input type="hidden" name="berat" value="<?php echo $produk->berat ?>"></td>	
				</tr>
				<?php 
				//form close
                echo form_close();
                 // end looping keranjang belanja
           		 }
				 ?>
				 <tr class="table-row alert alert-info">
				 	<td colspan="4" class="column-1">Sub Total</td>
				 	<input type="hidden" id="subtotal" value="<?= $this->cart->total() ?>" name="">
				 	<td colspan= "2" class="column-2" id="total">Rp. <?php echo number_format($this->cart->total(),'0',',','.') ?></td>
				 </tr>
			</table>
		</div>
	</div>

	<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
	<div class="flex-w flex-m w-full-sm">
	</div>
		<div class="size11 trans-0-4 m-t-10 m-b-10">
			<!-- Button -->
			 <a href="<?php echo base_url('belanja/hapus') ?>" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4"><i class="fa fa-trash-o"></i>  Hapus Keranjang Belanja</a>
		</div>
	</div>
	<div class="row">
	<div class="size11 trans-0-4 m-t-10 m-b-10">
     	  <div class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
            <a href="<?php echo base_url('home') ?>" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4"><i class="fa fa-shopping-cart"></i>  Belanja Lagi</a>
        </div>
        </div>
	</div>
	<!-- Total -->
	<div class="bo9 w-size30 p-l-30 p-r-30 p-t-30 p-b-30 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
		<h5 class="m-text20 p-b-24">
			Total Belanja
		</h5>
		<!--  -->
		<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
			<span class="s-text18 w-size19 w-full-sm">
				Pengiriman
			</span>

			<div class="w-size20 w-full-sm">
				<p class="s-text8 p-b-23">
					Pilih Kota Pengiriman Anda
				</p>

				<span class="s-text19">
					Kalkulasi Pengiriman
				</span>
				<div class="row">
					<form action="checkout_submit" method="post" accept-charset="utf-8">
		                    <div class="row">
		                    <div class="col-md-3">
		                    	<div class="form-group">
		                    		<label>Provinsi</label>
		                    		<select class="form-control" name="nama_provinsi" required>
		                    			
		                    		</select>
		                    	</div>
		                    </div>  
		                    <div class="col-md-3">
		                    	<div class="form-group">
		                    		<label>Kota</label>
		                    		<select class="form-control" name="nama_kota" required>
		               
		                    		</select>
		                    	</div>
		                    </div>  
		                    <div class="col-md-3">
		                    	<div class="form-group">
		                    		<label>Ekspedisi</label>
		                    		<select class="form-control" name="nama_ekspedisi" required>
		               
		                    		</select>
		                    	</div>
		                    </div>
		                     <div class="col-md-3">
		                    	<div class="form-group">
		                    		<label>Tarif</label>
		                    		<select class="form-control" name="nama_paket" required>
		               
		                    		</select>
		                    	</div>
		                    </div> 	
		                    </div>
		               	                     
		                     <input type="hidden" name="provinsi">	
		                     <input type="hidden" name="kota">
		                     <input type="hidden" name="tipekota">
		                     <input type="hidden" name="kodepos">
		                     <input type="hidden" name="ekspedisi">
		                     <input type="hidden" name="paket">	
		                     <input type="hidden" name="ongkir">	
		                     <input type="hidden" name="estimasi">
		                     <input type="hidden" name="totalbelanja">
		                     <input type="hidden" name="totalongkir">		  
		                    </form>
				</div>
			</div>
		</div>

		<!--  -->
		<div class="flex-w flex-sb-m p-t-26 p-b-30" >
			<span class="m-text22 w-size19 w-full-sm" >
				Total:
			</span>
			
			<input type="hidden" name="total_harga" id="totalpembelian" value="">	
			<input type="hidden" name="tarif" id="ongkir" value="">	
			<span class="m-text21 w-size20 w-full-sm" id="belanjatotal">	
				Rp. <?php echo number_format($this->cart->total(),'0',',','.')  ?>
			</span>
		</div>

		<div class="size14 trans-0-4 m-b-10">
			<!-- Button -->
			<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" name="update" id="update" type="">
				 Checkout 
			</button>
		</div>
	</div>
</div>
<script src="<?php echo base_url() ?>assets/template/js/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$.ajax({
			type : 'post',
			url: '<?php echo base_url('belanja/provinsi') ?>',

			success : function(hasil_provinsi)
			{
				$("select[name=nama_provinsi]").html(hasil_provinsi);
			}
	});

	$("select[name=nama_provinsi]").on("change",function(){
		//ambil id provinsi yang dipilih dari atribut pribasi
		var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
		$.ajax({
			type:'post',
			url: '<?php echo base_url('belanja/kota') ?>',
			data: 'id_provinsi='+id_provinsi_terpilih,
			success:function(hasil_kota)
			{
				$("select[name=nama_kota]").html(hasil_kota);
				console.log(hasil_kota)
			}
		});
	});

	$.ajax({
		type:'post',
		url: '<?php echo base_url('belanja/ekspedisi') ?>',
		success:function(hasil_ekspedisi)
		{
			$("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
			console.log(hasil_ekspedisi)
		}
	});

	$("select[name=nama_ekspedisi]").on("change",function(){
		//mendapatkan data ongkos kirim
		//mendapatkan ekspedisi yang dipilih
		var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
		console.log(ekspedisi_terpilih)
		//mendapatkan id distrik  yang terpilih pengguna
		var kota_terpilih = $("option:selected","select[name=nama_kota]").attr("id_kota");

		//mendapatkan total berat dari inputan
		var berat = $("input[name=berat]").val();
		$.ajax({
			type:'post',
			url:'<?php echo base_url('belanja/paket') ?>',
			data:'ekspedisi='+ekspedisi_terpilih+'&kota='+kota_terpilih+'&berat='+berat,
			success:function(hasil_paket)
			{
				$("select[name=nama_paket]").html(hasil_paket);
				console.log(hasil_paket)
				//letakan nama ekspedisi terpilih di inputan ekspedisi
				$("input[name=ekspedisi]").val(ekspedisi_terpilih);
				console.log(ekspedisi_terpilih)
			}
		})
	});

	$("select[name=nama_kota]").on("change", function(){
		var prov = $("option:selected",this).attr("nama_provinsi");
		var kota = $("option:selected",this).attr("nama_kota");
		var tipe = $("option:selected",this).attr("tipe_distrik");
		var kodepos = $("option:selected",this).attr("kodepos");
		
		$("input[name=provinsi]").val(prov);
		$("input[name=kota]").val(kota);
		$("input[name=tipekota]").val(tipe);
		$("input[name=kodepos]").val(kodepos);

	});
	$("select[name=nama_paket]").on("change", function(){
		var paket = $("option:selected",this).attr("paket");
		var ongkir = $("option:selected",this).attr("ongkir");
		var etd = $("option:selected",this).attr("etd");
		
		$("input[name=paket]").val(paket);
		$("input[name=tarif]").val(ongkir);
		var ongkir = $("#ongkir").val();
		var subtotal = $("#subtotal").val();
		var total = (parseInt(ongkir) + parseInt(subtotal));
		$("#totalpembelian").val(total);
		console.log(total);
		$("#ongkir").val(ongkir);
		console.log(ongkir);
		$("#belanjatotal").text(total);
		
	});
	$("#update").click(function(){	
		var tarif = $("#ongkir").val();
		var subtotal = $("#subtotal").val();
		var total = (parseInt(tarif) + parseInt(subtotal));
		$("#totalpembelian").val(total);
		console.log(total);
		$("#ongkir").val(tarif);
		console.log(tarif);
		$("#belanjatotal").text(total);
	$.ajax({
			type:'post',
			url:window.location='<?= base_url('belanja/checkout/') ?>'+tarif+"/"+total,
			data:'ongkir='+tarif+'&totalpembelian='+total,
			// url: "/belanja/checkout.php",
			// method: "POST",
			// data :{
			// 	tarif:tarif, totalpemal_harga,
			// }
			success:function(ongkir)
			{
				$("input[name=tarif]").val(tarif);
				console.log(tarif)
				//letakan nama total beli di inputan 
				$("input[name=total_harga]").val(total);
				console.log(total)
			}
		})
	});
	// var total = '<?php //echo $this->cart->total() ?>'; 
	// $("input[name=totalongkir]").val(total);
	
	//  $(document).ready(function(){
 //        $('.add').click(function(){
 //            var belanja  	  = $(this).find('total').val();
 //            var ongkir 		  = $(this).find('option:selected').val("ongkir");
 //            var belanjatotal  = (ongkir+total);
 //            sum+=belanjatotal;
 //            $.ajax({
 //                url : "<?php //echo base_url();?>shipping/paket",
 //                method : "POST",
 //                //data : {belanja:total, ongkir:ongkir},
 //                success: function(hasil){
 //                   $('#hasil').html(hasil);
 //                   $("input[name=totalbelanja]").val(belanjatotal);
 //                }
 //            });
 //        });
 //    });
	});
</script>
</section>
