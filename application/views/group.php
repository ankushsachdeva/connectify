<div class="container cbody">
  <div class="row">
    <div class="col-xs-12"><h3>Whats new in <? echo $name ?>(<a href="" data-toggle='modal' data-target='#addStoryModal'>Add new story</a>)</h3></div>
  </div>
 
  
<?php
foreach ($stories as $story) {
  echo $story;
}
?>
</div>

<div id="addStoryModal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Add new story</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" action="<? echo site_url('story/add') ?>" method="POST">
          	<div class="form-group">
				<input type="hidden" name="groupid" value="<?echo $groupid?>">
            </div>
            <div class="form-group">
            	<textarea name="content" id="" cols="55" rows="10"></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block">Add story</button>
            </div>
          </form>
      </div>
      <div class="modal-footer">
         
      </div>  
      </div>
  </div>
  </div>