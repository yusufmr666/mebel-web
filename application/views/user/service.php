<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(<?= base_url()?>assets/images/img_bg_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1><?= $id?></h1>
							<?php foreach($detail->result() as $row):?>
							<h2><?= $row->nama?></h2>
							<?php endforeach?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<div id="fh5co-product">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 animate-box">
				<?php foreach($detail->result() as $row):?>
					<div class="owl-carousel owl-carousel-fullwidth product-carousel">
						<div class="item">
							<div class="active text-center">
								<figure>
									<img src="<?php echo base_url().'assets/img/produk/'.$row->file_name1;?>" alt="user">
								</figure>
							</div>
						</div>
						<div class="item">
							<div class="active text-center">
								<figure>
									<img src="<?php echo base_url().'assets/img/produk/'.$row->file_name2;?>" alt="user">
								</figure>
							</div>
						</div>
						<div class="item">
							<div class="active text-center">
								<figure>
									<img src="<?php echo base_url().'assets/img/produk/'.$row->file_name1;?>" alt="user">
								</figure>
							</div>
						</div>
					</div>				
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="fh5co-tabs animate-box">
						<!-- Tabs -->
						<div class="fh5co-tab-content-wrap">
							<div class="fh5co-tab-content tab-content active" data-tab-content="1">
								<div class="col-md-10 col-md-offset-1">
							
									<p>
										<span class="price"><?= rupiah($row->harga)?></span>
										<a href="#" data-toggle="modal" data-target="#add<?= $row->id_produk?>" class="btn btn-primary btn-outline">Add to Cart</a>
										
									</p>						
									<h2><?= $row->nama?></h2>
									<p>Jenis Kayu : <?= $row->jenis?></p>
									<p>Estimasi Pengerjaan : <?= $row->estimasi?> Minggu</p>
									<p><?= $row->deskripsi?></p>

								</div>
							</div>
						</div>

					</div>
					<?php endforeach?>
				</div>
				<?php foreach($detail->result() as $row):?>
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
						<button type="submit"  onclick="getDate()" class="btn btn-primary btn-m">Masukkan</button>
						</div>
						</form>
					</div>
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
			</div>
		</div>
	</div>

	

	