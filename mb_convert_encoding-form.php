<?php 
$available_options = mb_list_encodings();
//$available_options = array_values($available_options);
array_merge($available_options);
sort($available_options);
if($_GET && isset($_GET['str'])){
	$get_str = $_GET['str'];
}else{
	$get_str = '';
}
//$options = [];
$opt_input = '';

foreach ($available_options as $val ){
	$opt_input .= '<option value="'.$val.'"';
	if($_GET && isset($_GET['format']) && $_GET['format'] == $val){
		$opt_input .= 'selected';
	}
	$opt_input .= '>'.$val.'</option>'.PHP_EOL;
}
//var_dump($options);


$form = '<form action="'.$_SERVER['PHP_SELF'].'" method="get"> '.PHP_EOL.
		'<input name="str" type="text" style="min-width: 300px;" value="'.$get_str.'"> '.PHP_EOL.
		'<select name="format">'.PHP_EOL.
		$opt_input.
		'</select> '.PHP_EOL.
		'<input type="submit" value="submit" /> '.PHP_EOL.
		'</form>';
if($_GET){
	if(!empty($_GET['str'])){
		if(empty($_GET['format'])){
			$format = mb_detect_encoding($_GET['str']);
		}else{
			$format = $_GET['format'];
		}
		
		//$str = mb_convert_encoding('ØªÙˆØ¶ÛŒØ­Ø§Øª Ø¯Ø³ØªÙ‡ Ø¢Ù…ÙˆØ²Ø´ Ù‡Ø§','windows-1252');
		$str = mb_convert_encoding($_GET['str'],$format);
		echo '<p>'.$str.'<br></p>';
	}else{
		echo 'error on sending data, please try again';
	}
	echo $form;
}else{
	echo $form;
}