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
									<img src="<?php echo base_url().'assets/img/produk/'.$row->file_name3;?>" alt="user">
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
								<div class="col-md-10 ">
							
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

					<?php	
					$itemRating =  $itemrating;
					$ratingNumber = 0;
					$count = 0;
					$fiveStarRating = 0;
					$fourStarRating = 0;
					$threeStarRating = 0;
					$twoStarRating = 0;
					$oneStarRating = 0;	
					foreach($itemRating as $rate){
						$ratingNumber+= $rate['ratingNumber'];
						$count += 1;
						if($rate['ratingNumber'] == 5) {
							$fiveStarRating +=1;
						} else if($rate['ratingNumber'] == 4) {
							$fourStarRating +=1;
						} else if($rate['ratingNumber'] == 3) {
							$threeStarRating +=1;
						} else if($rate['ratingNumber'] == 2) {
							$twoStarRating +=1;
						} else if($rate['ratingNumber'] == 1) {
							$oneStarRating +=1;
						}
					}
					$average = 0;
					if($ratingNumber && $count) {
						$average = $ratingNumber/$count;
					}	
					?>				
					<div class="row">			
					<div class="col-sm-5">				
						<h4>Rating and Reviews</h4>
						<h2 class="bold padding-bottom-7"><?php printf('%.1f', $average); ?> <small>/ 5</small></h2>				
						<?php
						$averageRating = round($average, 0);
						for ($i = 1; $i <= 5; $i++) {
							$ratingClass = "btn-default btn-grey";
							if($i <= $averageRating) {
								$ratingClass = "btn-warning";
							}
						?>
						<button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align">
						<span class="glyphicon glyphicon-star" aria-hidden="true"><i class="fa-solid fa-star"></i></span>
						</button>	
						<?php } ?>				
					</div>
					<div class="col-sm-4">
						<?php
						$fiveStarRatingPercent = round(($fiveStarRating/5)*100);
						$fiveStarRatingPercent = !empty($fiveStarRatingPercent)?$fiveStarRatingPercent.'%':'0%';	
						
						$fourStarRatingPercent = round(($fourStarRating/5)*100);
						$fourStarRatingPercent = !empty($fourStarRatingPercent)?$fourStarRatingPercent.'%':'0%';
						
						$threeStarRatingPercent = round(($threeStarRating/5)*100);
						$threeStarRatingPercent = !empty($threeStarRatingPercent)?$threeStarRatingPercent.'%':'0%';
						
						$twoStarRatingPercent = round(($twoStarRating/5)*100);
						$twoStarRatingPercent = !empty($twoStarRatingPercent)?$twoStarRatingPercent.'%':'0%';
						
						$oneStarRatingPercent = round(($oneStarRating/5)*100);
						$oneStarRatingPercent = !empty($oneStarRatingPercent)?$oneStarRatingPercent.'%':'0%';
						
						?>
						<div class="pull-left">
							<div class="pull-left" style="width:35px; line-height:1;">
								<div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"><i class="fa-sharp fa-solid fa-star"></i></span></div>
							</div>
							<div class="pull-left" style="width:180px;">
								<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fiveStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $fiveStarRatingPercent; ?></span>
								</div>
								</div>
							</div>
							<div class="pull-right" style="margin-left:10px;"><?php echo $fiveStarRating; ?></div>
						</div>
						
						<div class="pull-left">
							<div class="pull-left" style="width:35px; line-height:1;">
								<div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"><i class="fa-sharp fa-solid fa-star"></i></span></div>
							</div>
							<div class="pull-left" style="width:180px;">
								<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fourStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $fourStarRatingPercent; ?></span>
								</div>
								</div>
							</div>
							<div class="pull-right" style="margin-left:10px;"><?php echo $fourStarRating; ?></div>
						</div>
						<div class="pull-left">
							<div class="pull-left" style="width:35px; line-height:1;">
								<div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"><i class="fa-sharp fa-solid fa-star"></i></span></div>
							</div>
							<div class="pull-left" style="width:180px;">
								<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $threeStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $threeStarRatingPercent; ?></span>
								</div>
								</div>
							</div>
							<div class="pull-right" style="margin-left:10px;"><?php echo $threeStarRating; ?></div>
						</div>
						<div class="pull-left">
							<div class="pull-left" style="width:35px; line-height:1;">
								<div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"><i class="fa-sharp fa-solid fa-star"></i></span></div>
							</div>
							<div class="pull-left" style="width:180px;">
								<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $twoStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $twoStarRatingPercent; ?></span>
								</div>
								</div>
							</div>
							<div class="pull-right" style="margin-left:10px;"><?php echo $twoStarRating; ?></div>
						</div>
						<div class="pull-left">
							<div class="pull-left" style="width:35px; line-height:1;">
								<div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"><i class="fa-sharp fa-solid fa-star"></i></span></div>
							</div>
							<div class="pull-left" style="width:180px;">
								<div class="progress" style="height:9px; margin:8px 0;">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $oneStarRatingPercent; ?>">
									<span class="sr-only"><?php echo $oneStarRatingPercent; ?></span>
								</div>
								</div>
							</div>
							<div class="pull-right" style="margin-left:10px;"><?php echo $oneStarRating; ?></div>
						</div>
					</div>		
					<div class="col-sm-3">
						<a data-toggle="modal" data-target="#rating<?= $row->id_produk?>"  type="button" id="rateProduct" class="btn btn-info">Rate this product</a>
					</div>		
				</div>
				<div class="row">
					<div class="col-sm-12">
						<hr/>
						<div class="review-block">		
						<?php
						$itemRating = $itemrating;
						foreach($itemRating as $rating){				
							$date=date_create($rating['created']);
							$reviewDate = date_format($date,"M d, Y");						
							
						?>				
							<div class="row">
								<div class="col-sm-3">
									<div class="review-block-name">By <a href="#"><?php echo $rating['username']; ?></a></div>
									<div class="review-block-date"><?php echo $reviewDate; ?></div>
								</div>
								<div class="col-sm-9">
									<div class="review-block-rate">
										<?php
										for ($i = 1; $i <= 5; $i++) {
											$ratingClass = "btn-default btn-grey";
											if($i <= $rating['ratingNumber']) {
												$ratingClass = "btn-warning";
											}
										?>
										<button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
										<span class="glyphicon glyphicon-star" aria-hidden="true"><i class="fa-sharp fa-solid fa-star"></i></span>
										</button>								
										<?php } ?>
									</div>
									<div class="review-block-title"><?php echo $rating['title']; ?></div>
									<div class="review-block-description"><?php echo $rating['comments']; ?></div>
								</div>
							</div>
							<hr/>					
						<?php } ?>
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


				<?php foreach($detail->result() as $row):?>
				<div class="modal fade" id="rating<?= $row->id_produk?>" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">			
						<div class="modal-body">
						<form method="POST" action="<?= base_url()?>home/saverating" enctype="multipart/form-data">
						<h5>Masukkan produk ke keranjang?</h5>
						<div id="ratingSection">
							<div class="row">
								<div class="col-sm-12">						
										<div class="form-group">
											<h4>Rate this product</h4>
											<button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
											<span class="glyphicon glyphicon-star" aria-hidden="true"><i class="fa-solid fa-star"></i></span>
											</button>
											<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
											<span class="glyphicon glyphicon-star" aria-hidden="true"><i class="fa-solid fa-star"></i></span>
											</button>
											<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
											<span class="glyphicon glyphicon-star" aria-hidden="true"><i class="fa-solid fa-star"></i></span>
											</button>
											<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
											<span class="glyphicon glyphicon-star" aria-hidden="true"><i class="fa-solid fa-star"></i></span>
											</button>
											<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
											<span class="glyphicon glyphicon-star" aria-hidden="true"><i class="fa-solid fa-star"></i></span>
											</button>
											<input type="hidden" class="form-control" name="id_produk" value="<?= $row->id_produk?>">
											<input type="hidden" class="form-control" id="rating" name="rating" value="1">
											
											<input type="hidden" name="action" value="saveRating">
										</div>		
										<div class="form-group">
											<label for="usr">Title*</label>
											<input type="text" class="form-control" id="title" name="title" required>
										</div>
										<div class="form-group">
											<label for="comment">Comment*</label>
											<textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
										</div>
											
		
								</div>
							</div>		
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

	<script>
		$(function() {
	// rating form hide/show
 	$( "#rateProduct" ).click(function() {
		if(!$(this).hasClass('login')) {
			$('#loginModal').modal('show');
		} else {		
			$("#ratingDetails").hide();
			$("#ratingSection").show();
		}
	});	
	$( "#cancelReview" ).click(function() {
		$("#ratingSection").hide();
		$("#ratingDetails").show();		
	});	
	// implement start rating select/deselect
	$( ".rateButton" ).click(function() {
		if($(this).hasClass('btn-grey')) {			
			$(this).removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
			$(this).prevAll('.rateButton').removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');			
		} else {						
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');
		}
		$("#rating").val($('.star-selected').length);		
	});
	// save review using Ajax
	$('#ratingForm').on('submit', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			type : 'POST',
			dataType: "json",	
			url : 'action.php',					
			data : formData,
			success:function(response){
				if(response.success == 1) {
					$("#ratingForm")[0].reset();
					window.location.reload();
				}
			}
		});		
	});
});
	</script>

	