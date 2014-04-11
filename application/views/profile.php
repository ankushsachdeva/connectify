<div class="row cbody">
	<div class="col-xs-2"></div>
	<div class="col-xs-8 text-center" style="padding:10px">
		<img src="<?if(isset($img)){echo $img;} else{echo '//placehold.it/200';}?>" style="height:300px" alt="" class="img-thumbnail">
	</div>
	<div class="col-xs-2"></div>
</div>
<div class="row">
	<div class="col-xs-2"></div>
	<div class="col-xs-8 well">
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center"><h3><?echo $fname.' '.$lname?></h3></div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center"><h3><?echo $dob?></h3></div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center"><h3><?echo $email?></h3></div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center"><h3>Recent Stories</h3></div>
		</div>
		<?php 
		foreach ($stories as $story) {
		  echo $story;
		}
		?>
	</div>
	<div class="col-xs-2"></div>
</div>