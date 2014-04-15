<div class="row cbody">
	<div class="col-xs-2"></div>
	<div class="col-xs-8 text-center" style="padding:10px">
		<div class="col-xs-12">
			<img src="<?if(isset($image)){echo $image;} else{echo '//placehold.it/200';}?>" style="height:300px" alt="" class="img-thumbnail">
		</div>
		<div class="col-xs-12">
			<form action="<?echo site_url('user/upload')?>" method="post" enctype="multipart/form-data">
				<input class="form-control" type="file" name="userfile">
				<button type="submit" >Update Photo</button>
			</form>
		</div>
	</div>
	<div class="col-xs-2"></div>
	
</div>
<div class="row">
	<div class="col-xs-2"></div>
	<div class="col-xs-8 well">
		<form action="<?echo site_url('user/updateprofile')?> " method="post">
		
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<input type="text" name="fname" class="form-control" value="<?echo $fname?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<input type="text" name="lname" class="form-control" value="<?echo $lname?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<input type="text" class="bday form-control" name="dob" value="<?echo $dob?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<input class="form-control" type="text" name="email" value="<?echo $email?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<select class="form-control" name="gender" id="">
					<option value="0" <?if($gender==0) echo"selected"?> >Male</option>
					<option value="0" <?if($gender==1) echo"selected"?> >Female</option>

				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<button class="" type="submit" > Update Details</button>
			</div>
		</div>
		</form>
		<hr>
		
	</div>
	<div class="col-xs-2"></div>
</div>