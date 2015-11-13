<?php

include("../../../library/api.inc");
//use the suggested header
formHeader("contrib/forms/example form");
?>

<--REM note that every input method has the same name as a valid column, this will make things easier in save.php -->
<form method=post action="./save.php" name='cardiology'>
<span class=title>Cardiology Form</span>
<br>

<span class=text>Form data:</span><br>
<textarea name=data cols=40 rows=6 wrap=virtual></textarea>

<--REM note our nifty jscript submit
<a href="javascript:top.restoreSession();document.cardiology.submit();" class="link_submit">[Save]</a>
<br>
</form>

<br><br>
<hr>

<?php
formFooter();
?>
