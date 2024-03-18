<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(<?=base_url()?>assets/images/img_bg_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc text-center animate-box" data-animate-effect="fadeIn">
							<h1>Pesanan</h1>
							<h2>Daftar Pesanan Anda</a></h2>
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
				<th scope="col">Tanggal Pesan</th>				
				<th scope="col">ID Transaksi</th>
				<th scope="col">Link Pembayaran</th>
				<th scope="col">Pembayaran</th>
                <th scope="col">Status</th>
				<th scope="col" width="2%">Konfirmasi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($query->result() as $row):
					$status = $row->status;
					if($status == 'Waiting' || $status == 'Pesan'){
					$pesan = 'badge exampleone';
					} else if($status == 'Diproses') {
					$pesan = 'badge exampletwo';
					} else {
					$pesan = 'badge examplethree';
					}
				?>
				<tr>
				<td><?= tgl_indonesia($row->tgl_pesan)?></td>
                <td><?php if($row->id_transaksi == 2){
					echo "ID Transaksi Belum Ada";
					} else { 
					echo	$row->id_transaksi;}?></td>
					 <td><?php if(empty($row->link)){
					echo "Menunggu";
					} else { 
					echo	$row->link;}?></td>
				<td><span class="<?php if(empty($row->bukti)){echo "badge examplefour";} else {echo "badge examplethree";}?>"><?php if(empty($row->bukti)){echo "Belum Lunas";} else {echo "Lunas";}?></span></td>
				<td><span class="<?php echo $pesan;?>"><?=$row->status?></span></td>

				<form method="POST" action="<?= base_url()?>user/service/checkout" enctype="multipart/form-data">
				<input type="hidden" name="id_transaksi" value="<?=$row->id_transaksi?>">
				<td>
					<input type="file" class="custom-file-input" id="validatedCustomFile" name="bukti" required>									
				</td> 
				<td><button type="submit" class="badge" 
				<?php if(empty($row->link) || !empty($row->bukti)){ echo "disabled";}?>><i class="material-icons"></i>Konfiramsi</button></td>
				</form>               
				</tr>
				<?php endforeach?>
			</tbody>
			</table>
			<div class="text-right"> 
			</div>
       		 </div> 
			
		</div>
	</div>

	<?php
	function tgl_indonesia($date){
		$Bulan = array("Januari","Februari","Maret","April",
						"Mei","Juni","Juli","Agustus","September",
						"Oktober","November","Desember");
		$Hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl = substr($date, 8, 2);
		$hari = date("w", strtotime($date));
		return $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ";
	}

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
		.exampleone {
		background-color: #9FA6B2;
		}

		.exampletwo {
		background-color: #E4A11B;
		}

		.examplethree {
		background-color: #14A44D;
		}

		.examplefour{
		background-color:#DC4C64;
		}

		input[type=file]::file-selector-button {
		margin-right: 20px;
		border: none;
		background: #084cdf;
		padding: 5px 10px;
		border-radius: 10px;
		color: #fff;
		font-size: 10px;
		cursor: pointer;
		transition: background .2s ease-in-out;
		}
		input[type=file]::file-selector-button:hover {
		background: #0d45a5;
		}
	</style>