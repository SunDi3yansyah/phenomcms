<input name="posting_url" type="text" size="40" value="<?php if (!empty($multiple_record_url)) echo $multiple_record_url; else echo "http://"?>">
Target: 
<select name="posting_target">
<option value="_self" <?php if ($multiple_record_target == '_self') echo 'selected'; else echo '' ?>>Current Window</option>
<option value="_blank" <?php if ($multiple_record_target == '_blank') echo 'selected'; else echo '' ?>>New Window</option>
</select>