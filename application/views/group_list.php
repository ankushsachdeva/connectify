<div class="cbody">
	<h3 class="text-center">Groups</h3>
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
			  					<div class="col-xs-3"><img class="comment-img img-thumbnail" src="<?if(isset($member['image'])){echo $member['image'];} else {echo '//placehold.it/100';}?>" alt=""></div>
			  					<div style="margin-top:30px" class="col-xs-9">
			  						<div class="text-center">
			  							<a href="<?echo site_url('user/profile/'.$member['userid'])?>">
			  								<?echo $member['fname'].' '.$member['lname']?>
			  							</a>
			  							<?if(!$group['iamadmin']){?>
			  							(<?if($member['role']==0) {echo "Member";} elseif($member['role']==1) {echo "Moderator";} else {echo "Admin";}?>)
			  							<?}
			  							else{?>
											<form class="form-inline" action="<?echo site_url('group/changerole')?>" method="POST">
												<select name="role" id="">
													<option value="0" <?if($member['role']==0) echo "selected"?> >Member</option>
													<option value="1" <?if($member['role']==1) echo "selected"?> >Moderator</option>
													<option value="2" <?if($member['role']==2) echo "selected"?> >Admin</option>
												</select>
												<input type="hidden" name="groupid" value="<?echo $group['groupid']?>">
												<input type="hidden" name="userid" value="<?echo $member['userid']?>">
						         				<button class="btn btn-default btn-xs" type="submit">Change privileges</button>

											</form>
			  						<?	}

			  							?>
			  						</div>
									<div class="pull-right">
										Joined on <?echo $member['time']?>
									</div>
			  					</div>
			  				</div>
			  				<?
			  			}?>
			  			<?if($group['iamadmin']){?>
			  			<div class="row">
			  				<form method="POST" action="<?echo site_url('group/addmember')?>">
								<select class="multiselect" multiple="multiple" name="memberIDs">
									<?foreach ($friends as $friend) { ?>
										<option value="<?echo $friend['userid']?>"><? echo $friend['fname'].' '.$friend['lname']?></option>
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