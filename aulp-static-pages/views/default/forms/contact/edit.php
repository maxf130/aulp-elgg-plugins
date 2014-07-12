<!--Get the existing contact (if it exists) and prefill values in the form-->
 <?php 
 
 /* 
 * Copyright (C) 2014 Maximilian Friedersdorff
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
 
 $contacts = elgg_get_entities(array(
     'type' => 'object',
     'subtype' => 'aulpcontact'
 ));
 
 $body ="";
 $title ="";
 
 if (!empty($contacts)){
     $body = $contacts[0]['description'];
     $title = $contacts[0]['title'];
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