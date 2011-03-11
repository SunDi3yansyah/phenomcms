<select name="posting_module">
<option value="gallery" <?php if ($multiple_record_module == 'gallery') echo 'selected'; else echo '' ?>>Gallery</option>
<option value="guestbook" <?php if ($multiple_record_module == 'guestbook') echo 'selected'; else echo '' ?>>Guest Book</option>
<option value="polling" <?php if ($multiple_record_module == 'polling') echo 'selected'; else echo '' ?>>Polling</option>
</select>