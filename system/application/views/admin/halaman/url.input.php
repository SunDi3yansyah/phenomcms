<input name="page_url" type="text" size="40" value="<?php if (!empty($single_record_url)) echo $single_record_url; else echo "http://"?>">
Target: 
<select name="page_target">
<option value="_self" <?php if ($single_record_target == '_self') echo 'selected'; else echo '' ?>>Current Window</option>
<option value="_blank" <?php if ($single_record_target == '_blank') echo 'selected'; else echo '' ?>>New Window</option>
</select>