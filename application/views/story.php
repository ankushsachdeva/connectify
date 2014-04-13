
<div class="row">    
  <br>
  <div class="col-md-2 col-sm-3 text-center">
    <a class="story-img img-thumbnail" href="<?echo site_url('user/profile/'.$authorid)?>"><img src="<?if(isset($image)){echo $image;} else{echo '//placehold.it/100';}?>" style="width:100px;" ></a>
  </div>
  <div class="col-md-10 col-sm-9">
    <h3><? echo $fname." ".$lname?></h3><?if($session['userid'] == $authorid){?><div class="pull-right"><form method ="post" action="<?echo site_url('story/delete')?>"><input type="hidden" name="storyid" value="<?echo $storyid?>"> <button type="submit">Delete</button></form></div><?}?>
    <div class="row">
      <div class="col-xs-9">
        <p><? echo $content?></p>
         <!-- <p class="lead"><button class="btn btn-default">Read More</button></p> -->
          <ul class="list-inline">
            <li><? echo $time?></li>
            <li class="hand-crs" data-toggle='modal' data-target='#likesModal<? if($numLikes>0){echo $storyid;}?>'><i class="glyphicon glyphicon-thumbs-up"></i> <?echo $numLikes?> Likes</li>
            <li class="hand-crs" <? if(isset($numComments)){?>onclick="showComments(<?echo $storyid;?>)"<?}?> > <? if(isset($numComments)){?> <?}?><i class="glyphicon glyphicon-comment"></i> <? echo $numComments?> Comments
            </li>
          </ul>
        </div>
        <div class="col-xs-3"></div>
      </div>
      <br><br>
    </div>
  </div>
  <div class="row comments comments<? echo $storyid?>">
    <div class="col-xs-2"></div>
    <div class="col-xs-9 well well-sm">
      <?
        foreach ($comments as $comment) { ?>
          <div class="row">
            <div class="col-xs-6"><h4><?echo $comment['fname'].' '.$comment['lname'] ?></h4>  </div>
            <?if($session['userid'] == $comment['authorid']){?><div class="col-xs-4"><form method ="post" action="<?echo site_url('story/deletecomment')?>"><input type="hidden" name="commentid" value="<?echo $comment['commentid']?>"> <button type="submit">Delete</button></form></div><?}?>

            <div class="col-xs-2"><?echo $comment['time']?></div>
          </div>
          <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-11"><? echo $comment['content'] ?></div>
          </div>
        <?
        }
      ?>
        <div class="row">
          <div class="col-xs-12"><h4>Write a comment</h4>  </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
          <form action="<? echo site_url('story/addComment')?>" method="POST">
            <input type="hidden" name="storyid" value=<?echo $storyid?> >
            <textarea name="content" class="form-control" id="" cols="30" rows="5"></textarea>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
          </div>
        </div>
    </div>
  </div>
  <hr>
  <div id="likesModal<? echo $storyid?>" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">People who liked this</h1>
      </div>
      <div class="modal-body">
         <?foreach ($likes as $like) { ?>
           <div class="row">
             <div class="col-xs-3"><img class="comment-img img-thumbnail" src="<?if(isset($like['image'])){echo $like['image'];} else {echo '//placehold.it/100';}?>" alt=""></div>
             <div style="margin-top:30px" class="col-xs-9"><a href="<?echo site_url('user/profile/'.$like['userid'])?>"><?echo $like['fname'].' '.$like['lname']?></a></div>
           </div>
           <?
         }?>
      </div>
      
      </div>
  </div>
  </div>
