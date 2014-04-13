<div class="row cbody">
	<div class="col-xs-2"></div>
	<div class="col-xs-8 text-center" style="padding:10px">
		<img src="<?if(isset($img)){echo $img;} else{echo '//placehold.it/200';}?>" style="height:300px" alt="" class="img-thumbnail">
	</div>
	<div class="col-xs-2"></div>
	<div class="col-xs-12 text-center"><form action="<?echo site_url('user/addfriend')?>"><input type="hidden" name="userid" value="<?echo $userid?>"><button type="submit">Add Friend</button></form></div>
</div>
<div class="row">
	<div class="col-xs-2"></div>
	<div class="col-xs-8 well">
		<form action="<?echo site_url('user/updateprofile')?>"></form>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<input type="text" name="fname" value="<?echo $fname?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<input type="text" name="lname" value="<?echo $lname?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<input type="text" class="dob" name="dob" value="<?echo $dob?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<input type="text" name="email" value="<?echo $email?>">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<select name="gender" id="">
					<option value="0" <?if($gender==0) echo"selected"?> >Male</option>
					<option value="0" <?if($gender==1) echo"selected"?> >Female</option>

				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10 text-center">
				<button type="submit" > Update Details</button>
			</div>
		</div>
		<hr>
		
	</div>
	<div class="col-xs-2"></div>
</div>