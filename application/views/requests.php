<div class="cbody">
<h3 class="text-center">Friend Requests</h3>
<? foreach ($requests as $request) {
?>	

<div class="row frow">
	<div class="col-xs-1"></div>
	<div class="col-xs-3">
		<img style="width:100px" src="<?if(isset($request['image'])){echo $request['image'];} else{echo '//placehold.it/100';}?>" alt="" class="img-thumbnail">
	</div>
	<div class="col-xs-7">
		<div class="row">
			<div style="margin-top:40px" class="col-xs-12"><a href="<?echo site_url('user/profile/'.$request['userid'])?>"><?echo $request['fname'].' '.$request['lname']?></a></div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<form action="<?echo site_url('user/acceptrequest') ?>" method = "POST"> <input type="hidden" name="userid" value="<?echo $request['userid']?>"><button type="submit" >Accept</button></form>
				<form action="<?echo site_url('user/rejectrequest') ?>" method = "POST"> <input type="hidden" name="userid" value="<?echo $request['userid']?>"><button type="submit" >Reject</button></form>

			</div>
		</div>

	</div>
</div>

<?
}
?>
</div>