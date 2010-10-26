<?php
function email_syntax_check($email) {
	if (eregi("^([a-z0-9_]|\-|\.)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,4}\$",$email)==1) {
		return true;
	} else {
		return false;
	}
}  
?>
