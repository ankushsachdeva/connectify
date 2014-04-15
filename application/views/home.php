<div class="cbody">
  <div class="row">
    <div class="col-xs-12"><h3>Welcome <? echo $session['fname'] ?>,</h3></div>
  </div>
 
  <div class="row">
  	<div class="col-xs-8">
<?php
foreach ($stories as $story) {
  echo $story;
}
?>
</div>
</div>
</div>