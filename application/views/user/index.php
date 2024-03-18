	
	
	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
			<?php foreach($slider->result() as $row):?>
		   	<li style="background-image: url(<?php echo base_url().'assets/img/produk/'.$row->file_name1;?>">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<div class="desc">
		   						<span class="price"><?= rupiah($row->harga)?></span>
		   						<h2><?=$row->nama?></h2>
		   						<p><?=$row->deskripsi?></p>
			   					<p><a href="javascript:void(0);" data-toggle="modal" data-target="#add<?= $row->id_produk?>" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p>
		   					</div>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
			<?php endforeach ?>
		  	</ul>
	  	</div>
	</aside>

	<div id="fh5co-services" class="fh5co-bg-section">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 text-center">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="icon-credit-card"></i>
						</span>
						<h3>Pilih Produk</h3>
						<p>Pilih salah satu produk yang anda inginkan</p>
						<!--
						<p><a href="#" class="btn btn-primary btn-outline">Learn More</a></p>
						-->
					</div>
				</div>
				<div class="col-md-4 col-sm-4 text-center">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="icon-wallet"></i>
						</span>
						<h3>Bayar dan Tunggu</h3>
						<p>Masukkan Piloihan Produk anda ke keranjang serta lakukan pembayaran</p>
						
					</div>
				</div>
				<div class="col-md-4 col-sm-4 text-center">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="icon-paper-plane"></i>
						</span>
						<h3>Dikirim</h3>
						<p>Produk yang sudah selesai diproduksi akan segera dikirim</p>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="fh5co-product">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Cool Stuff</span>
					<h2>Products.</h2>
					<p>Prouduk funitur pilihan, Kualitas terjamin!</p>
				</div>
			</div>
			<div class="row">
			<?php foreach($produk->result() as $row):?>
				<div class="col-md-4 text-center animate-box">
					<div class="product">
						<div class="product-grid" style="background-image:url(<?php echo base_url().'assets/img/produk/'.$row->file_name1;?>">
							<div class="inner">
								<p>
									<a href="javascript:void(0);" class="icon" data-toggle="modal" data-target="#add<?= $row->id_produk?>"><i class="icon-shopping-cart"></i></a>
								</p>
							</div>
						</div>
						<div class="desc">
							<h3><a href="<?= base_url('home/detail/' . $row->id_produk) ?>"><?=$row->nama?></a></h3>
							<span class="price"><?= rupiah($row->harga)?></span>
						</div>
					</div>
				</div>
				<?php endforeach?>
			</div>
		</div>
	</div>

	<?php foreach($produk->result() as $row):?>
	<div class="modal fade" id="add<?= $row->id_produk?>" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">			
			<div class="modal-body">
			<form method="POST" action="<?= base_url()?>home/cart" enctype="multipart/form-data">
			<h5>Masukkan produk ke keranjang?</h5>
			<div class="row">
				<input type="hidden" name="id" value="<?=$row->id_produk?>"/>   
				<input type="hidden" name="status" value="Waiting"/> 
				<input type="hidden" name="id_transaksi" value="2"/>                                
			</div>
	
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
				Close
			</button>
			<button type="submit" class="btn btn-primary btn-m">Masukkan</button>
			</div>
			</form>
		</div>
		</div>
	
	</div>
	</div>
	<?php endforeach?>
		
	<?php
	function rupiah($angka){
		if ($angka === "0"){
		  $hasil_rupiah = "-";
		} else {
		  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		}
		  return $hasil_rupiah;
	   
	  }
	?>


	

