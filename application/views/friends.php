<div class="cbody">
<h3 class="text-center">Friends</h3>
<? foreach ($friends as $friend) {
?>	

<div class="row frow">
	<div class="col-xs-1"></div>
	<div class="col-xs-3">
		<img style="width:100px" src="<?if(isset($friend->image)){echo $friend->image;} else{echo '//placehold.it/100';}?>" alt="" class="img-thumbnail">
	</div>
	<div class="col-xs-7">
		<div class="row">
			<div style="margin-top:40px" class="col-xs-12"><a href="<?echo site_url('user/profile/'.$friend->id)?>"><?echo $friend->fname.' '.$friend->lname?></a></div>
		</div>

	</div>
</div>

<?
}
?>
</div>