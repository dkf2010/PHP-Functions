<?php
function email_protect() {
	/*
	Autor: Dennis Kruemmel
	Mail: dennis@kruemmel.it
	
	Lizenz: CC-BY-SA
	http://creativecommons.org/licenses/by-sa/3.0/deed.de
	
	Usage:
	
	email_protect()
	returns a protected dummy email address
	
	email_protect('myemail@address.com')
	returns the protected email address 'myemail@address.com' and the protected link description of 'myemail@address.com'
	
	email_protect('myemail@address.com', 'My Link Text')
	returns the protected email address 'myemail@address.com' and the link description 'My Link Text'
	
	*/
	
	$email = func_num_args()>0 ? func_get_arg(0) : "mail@example.com";
	$text  = func_num_args()>1 ? func_get_arg(1) : "";

	$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
	
	$key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999);
	
	for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])];
	
	$script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
	$script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
	$script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">';
		if(empty($text)) {
			$script.='"+d+"';
		} else {
			$script.=$text;
		}
	$script.= '</a>"';
	$script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; 
	$script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';
	
	return '<span id="'.$id.'">[javascript protected email address]</span>'.$script;
}
?>
