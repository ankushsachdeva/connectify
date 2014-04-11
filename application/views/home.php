<div class="container cbody">
  <div class="row">
    <div class="col-xs-12"><h3>Welcome <? echo $fname ?>,</h3></div>
  </div>
 
  
<?php
foreach ($stories as $story) {
  echo $story;
}
?>
</div>