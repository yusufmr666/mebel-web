<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(<?=base_url()?>assets/images/img_bg_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>Chart</h1>
							<h2>Free html5 templates by <a href="https://themewagon.com/theme_tag/free/" target="_blank">Themewagon</a></h2>
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
                <th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
			<form method="POST" action="<?= base_url()?>user/chart/cart" enctype="multipart/form-data">
				<?php foreach($query->result() as $row):?>
				<tr>
				<td><?= $row->tgl_pesan?></td>
                <td><?= $row->id_transaksi?></td>
				<td><?= $row->status?></td>
                
				</tr>
				<?php endforeach?>
			</tbody>
			</table>
			<div class="text-right"> 
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