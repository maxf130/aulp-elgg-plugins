<!--*
 To change this license header, choose License Headers in Project Properties.
 To change this template file, choose Tools | Templates
 and open the template in the editor.
 -->
<!--Get the existing homepage (if it exists) and prefill values in the form-->
 <?php 
 $homes = elgg_get_entities(array(
     'type' => 'object',
     'subtype' => 'aulphome'
 ));
 
 $body ="";
 $title ="";
 
 if (!empty($homes)){
     $body = $homes[0]['description'];
     $title = $homes[0]['title'];
 }
 ?>
 
<div>
    <label><?php echo elgg_echo("title"); ?></label><br />
    <?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>

 <div>
     <label><?php echo elgg_echo("body"); ?></label><br />
     <?php echo elgg_view('input/longtext', array('name' => 'body', 'value' => $body)); ?>
 </div>
 
 <div>
     <?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
 </div>

