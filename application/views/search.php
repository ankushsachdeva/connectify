<div class="cbody container ">
	<div class="col-xs-4"></div>
	<div class="col-xs-4">
	<form action="<?echo site_url('user/searchuser')?>" method="POST" class="form">
		<div class="form-group">
		<input type="text" name="fname" class="form-control" placeholder="First Name">
		<input type="text" name="lname" class="form-control" placeholder="Last Name">
		<input type="text" name="email" class="form-control" placeholder="Email">
		<input type="text" name="username" class="form-control" placeholder="username">

		<input type="text" name="fromdob" class="form-control bday" placeholder="From DOB">
		<input type="text" name="todob" class="form-control bday" placeholder="To DOB">
		<select name="gender" class="form-control">
			<option value="0">Male</option>
			<option value="1">Female</option>
		</select>
	  <button type="submit" class="btn btn-theme">Search</button>
	  </div>

	</form></div>


</div>