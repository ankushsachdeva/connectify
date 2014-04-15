<div class="cbody">
	<div class="row">
	<div class="col-xs-4"></div>
	<h3 class="text-center col-xs-4">Groups(<a href="" data-toggle='modal' data-target='#addGroupModal'>Add new</a>)</h3>
	
	</div>
	<div class="row">
		<? foreach ($groups as $group) {
			?>	
	
			<div class="col-xs-3 well">
				<div class="col-xs-12 text-center"><a href="<?echo site_url('group/show/'.$group['groupid'])?>"><h3><?echo $group['name']?></h3></a><div class="pull-right"><i><?echo $group['time']?></i></div></div>
				<div class="col-xs-12 hand-crs" data-toggle='modal' data-target='#groupModal<? echo $group['groupid'];?>' ><a><?echo count($group['members'])?> members</a></div>
			</div>
			<div class="col-xs-1"></div>
			  <div id="groupModal<? echo $group['groupid']?>" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog">
			  		<div class="modal-content">
			  			<div class="modal-header">
			  				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			  				<h1 class="text-center">Members of <?echo $group['name']?></h1>
			  			</div>
			  			<div class="modal-body">
			  				<?foreach ($group['members'] as $member) { ?>
			  				<div class="row">
			  					<div class="col-xs-3"><img class="comment-img img-thumbnail" src="<?if(isset($member->image)){echo $member->image;} else {echo '//placehold.it/100';}?>" alt=""></div>
			  					<div style="margin-top:30px" class="col-xs-9">
			  						<div class="text-center">
			  							<a href="<?echo site_url('user/profile/'.$member->memberID)?>">
			  								<?echo $member->fname.' '.$member->lname?>
			  							</a>
			  							<?if(!$group['iamadmin']){?>
			  							(<?if($member->role==0) {echo "Member";} elseif($member->role==1) {echo "Moderator";} else {echo "Admin";}?>)
			  							<?}
			  							else{?>
											<form class="form-inline" action="<?echo site_url('group/changerole')?>" method="POST">
												<select name="role" id="">
													<option value="0" <?if($member->role==0) echo "selected"?> >Member</option>
													<option value="1" <?if($member->role==1) echo "selected"?> >Moderator</option>
													<option value="2" <?if($member->role==2) echo "selected"?> >Admin</option>
												</select>
												<input type="hidden" name="groupid" value="<?echo $group['groupid']?>">
												<input type="hidden" name="userid" value="<?echo $member->memberID?>">
						         				<button class="btn btn-default btn-xs" type="submit">Change privileges</button>

											</form>
			  						<?	}

			  							?>
			  						</div>
									<div class="pull-right">
										Joined on <?echo $member->time?>
									</div>
			  					</div>
			  				</div>
			  				<?
			  			}?>
			  			<?if($group['iamadmin']){?>
			  			<div class="row">
			  				<form method="POST" action="<?echo site_url('group/addmember')?>">
								<select class="multiselect" multiple="multiple" name="memberIDs">
									<?foreach ($friends as $friend) { 
										$friendid = $friend->id;
										$flag = false;
										foreach ($group['members'] as $member) {
											if($member->memberID == $friendid){
												$flag = true;
												break;
											}
										}
										if($flag)
											continue;
										?>
										<option value="<?echo $friend->id?>"><? echo $friend->fname.' '.$friend->lname?></option>
									<?}?>
								</select>
								<input type="hidden" name="groupid" value="<?echo $group['groupid']?>">
						         <button class="btn btn-default" type="submit">Add members</button>
			  				</form>
			  			</div>
						<?} ?>
			  		</div>

			  	</div>
			  </div>
			</div>
		<?
	}
	?>
		</div>
</div>
<div id="addGroupModal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Add new group</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" action="<? echo site_url('group/add') ?>" method="POST">
            <div class="form-group">
              <input type="text" class="form-control input-lg" placeholder="Group Name" name="name">
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Add group</button>
            </div>
          </form>
      </div>
      <div class="modal-footer">
         
      </div>  
      </div>
  </div>
  </div>