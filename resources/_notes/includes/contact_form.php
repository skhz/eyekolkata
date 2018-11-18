<form name="form1" id="form1" action="hwnd_email.php" method="post">
<a name="thankyou"></a>

<?php if($_SESSION['msg'] != ''){ echo $_SESSION['msg']; $_SESSION['msg'] = '';} ?>
<input type="hidden" name="txtPageName" id="txtPageName" value="<?php //echo PAGE_NAME; ?>index.php?page_name=contact_us.jsp" />
<p>
    <label for="name"><small>Name (required)</small></label><br />
    <input type="text" name="txtName" id="txtName" value="" size="50"  />
</p>
<p>
    <label for="name"><small>Address (required)</small></label><br />
    <textarea name="txtAddress" id="txtAddress" rows="3" ></textarea>
</p>
<p>
    <label for="name"><small>Phone (required)</small></label><br />
    <input type="text" name="txtPhone" id="txtPhone" value="" size="22" />
</p>
<p>
    <label for="name"><small>Country (required)</small></label><br />
    <input type="text" name="txtCountry" id="txtCountry" value="" size="22" />
</p>
<p>
    <label for="email"><small>Mail (required)</small></label><br />
    <input type="text" name="txtEmail" id="txtEmail" value="" size="22" />
</p>
<p>
	<label for="comment"><small>Comment (required)</small></label><br />
    <textarea name="txtComment" id="txtComment" cols="100%" rows="10" class="mceEditor"></textarea>
</p>
<p>
    <input name="submit" type="submit" id="submit" value="Submit Form" />&nbsp;
    <input name="reset" type="reset" id="reset" tabindex="5" value="Reset Form" />
</p>
</form>