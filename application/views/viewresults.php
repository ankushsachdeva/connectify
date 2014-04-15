<div class="cbody">
<h3 class="text-center">Search Results</h3>
<? foreach ($users as $user) {
?>	

<div class="row frow">
	<div class="col-xs-1"></div>
	<div class="col-xs-3">
		<img style="width:100px" src="<?if(isset($user->image)){echo $user->image;} else{echo '//placehold.it/100';}?>" alt="" class="img-thumbnail">
	</div>
	<div class="col-xs-7">
		<div class="row">
			<div style="margin-top:40px" class="col-xs-12"><a href="<?echo site_url('user/profile/'.$user->id)?>"><?echo $user->fname.' '.$user->lname?></a></div>
		</div>

	</div>
</div>

<?
}
?>
</div>