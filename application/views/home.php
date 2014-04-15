<div class="cbody">
  <div class="row">
    <div class="col-xs-12"><h3>Welcome <? echo $session['fname'] ?>,</h3></div>
  </div>
 
  
<?php
foreach ($stories as $story) {
  echo $story;
}
?>
</div>