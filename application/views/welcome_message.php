
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					
					<form class="form signup " role="form" method="post" action="<? echo site_url('user/signup')?>">
					  <div class="form-group ">
					    <input type="email" class="form-control"  placeholder="Enter your email address" name="email">
					    <input type="text" class="form-control"  placeholder="Enter your username" name="username">
					    <input type="password" class="form-control"  placeholder="Enter your password" name="password">
					    <input type="text" class="form-control"  placeholder="Enter your first name" name="fname">
					    <input type="text" class="form-control"  placeholder="Enter your last name" name="lname">
					    <select name="gender" id=""><option value="0">Male</option><option value="1">Female</option></select>
					    <input type="text" class="form-control bday"  placeholder="Enter your birthday" name="dob">
					  </div>
					  <button type="submit" class="btn btn-theme">Sign Up</button>
					</form>					
				</div>
				
				
			</div>
		</div>
	</div>
	