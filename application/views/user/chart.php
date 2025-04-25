<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(<?=base_url()?>assets/images/img_bg_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>Cart</h1>
							<h2>Daftar Keranjang Anda</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<div id="fh5co-about">
		<div class="container">
			<table class="table table-bordered">
			<thead>
				<tr>
				<th scope="col">Nama Barang</th>
				<th scope="col">Harga</th>
				<th scope="col">Estimasi</th>
				<th scope="col">Handle</th>
				</tr>
			</thead>
			<tbody>
			<form method="POST" action="<?= base_url()?>user/chart/cart" enctype="multipart/form-data">
				<?php foreach($query->result() as $row):?>
				<tr>
				<td><?= $row->nama?></td>
				<td><?= rupiah($row->harga)?></td>
				<td><?= $row->estimasi?> Minggu</td>
				<td> <a class="badge" href="<?= base_url('user/chart/delete/' . $row->id) ?>" onclick="return confirm('Apakah anda yakin ingin mengapus?')"><i class="material-icons"></i>Batalkan Pemesanan</a></td>
				</tr>
				<input type="hidden" name="id" value="<?=$row->id?>"/>
				<input type="hidden" name="idp" value="<?=$row->id_produk?>"/>  
				<?php endforeach?>
			</tbody>
			</table>
			<div class="text-right"> 
				<div class="row mb-40">				
						<div class="form-group">
						<label class="control-label col-sm-6"for="username"></label>
						<div class="col-sm-6">
						<select class="form-control" name="jenis_pembayaran" aria-label="Default select example">
							<option selected>Pilih Jenis Pembayaran</option>
							<option value="Transfer">Transfer</option>
							<option value="Pihak Ketiga">Pihak Ketiga</option>
					
							<!--
							<option value="Photography">Photography</option>
							<option value="Education">Education</option>
							-->
							</select>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-7 col-sm-4 text-center">
						
					</div>
					<div class="col-md-5 col-sm-4 text-center">
					<textarea
					class="form-control"
					id="exampleFormControlTextarea1" name="keterangan"
					placeholder="Keterangan (Opsional)"></textarea>
					</div>
				</div>
			
				<div class="row"> 
					<input type="hidden" name="status" value="Pesan"/> 
					<input type="hidden" name="id_transaksi" id="id_transaksi"/>                             
				</div>
				<button type="submit"  onclick="getDate()" class="btn btn-primary sizess">Checkout</button>
				</div>
				</form>
       		 </div> 
			
		</div>
	</div>

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

<script type="text/javascript">
        function getDate() {
            var curday = function(sp){
                today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //As January is 0.
                var yyyy = today.getFullYear();
                var hh = today.getHours();
                var mn = today.getMinutes();
                var ss = today.getSeconds();

                if(dd<10) dd='0'+dd;
                if(mm<10) mm='0'+mm;
                return (dd+sp+mm+sp+yyyy+sp+hh+sp+mn+sp+ss);
            };
            var user_id = "BRG";
            document.getElementById("id_transaksi").value = user_id+"-"+curday('');
        }
        
    </script>
	<style>
		.sizess{
			margin-top: 25px;
		}
		/* Menambahkan margin-bottom pada elemen tertentu */
		.mb-10 {
			margin-bottom: 10px;
		}

		.mb-20 {
			margin-bottom: 20px;
		}

		.mb-30 {
			margin-bottom: 30px;
		}

		.mb-40 {
			margin-bottom: 40px;
		}

		.mb-50 {
			margin-bottom: 50px;
		}

		/* Menambahkan margin-bottom pada elemen tertentu dengan class mb-auto */
		.mb-auto {
			margin-bottom: auto;
		}

		/* Atau untuk pengaturan margin-bottom secara umum */
		[class*="mb-"] {
			margin-bottom: 15px; /* Atur nilai sesuai kebutuhan */
		}
	</style>