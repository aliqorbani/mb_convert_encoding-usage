<?php
$available_options = mb_list_encodings();
array_merge($available_options); // just for reduce duplicates
sort($available_options); // we sort our array as alphabet
if ($_GET && isset($_GET['str'])) {
    $get_str = $_GET['str'];
} else {
    $get_str = '';
}
$opt_input = '';
foreach ($available_options as $val) {
    $opt_input .= '<option value="' . $val . '"';
    if ($_GET && isset($_GET['format']) && $_GET['format'] == $val) {
        $opt_input .= 'selected'; // set selected value for format if it is posted before
    }
    $opt_input .= '>' . $val . '</option>' . PHP_EOL;
}
//create a simple form for check our codes.
$form = '<form action="' . $_SERVER['PHP_SELF'] . '" method="get"> ' . PHP_EOL .
    '<input name="str" type="text" style="min-width: 300px;" value="' . $get_str . '"> ' . PHP_EOL .
    '<select name="format">' . PHP_EOL .
    $opt_input .
    '</select> ' . PHP_EOL .
    '<input type="submit" value="submit" /> ' . PHP_EOL .
    '</form>';
if ($_GET) {
    if (!empty($_GET['str'])) {
        if (empty($_GET['format'])) {
            $format = mb_detect_encoding($_GET['str']);
        } else {
            $format = $_GET['format'];
        }
        /*
         * just for checking before post form.
         * $str = mb_convert_encoding('ØªÙˆØ¶ÛŒØ­Ø§Øª Ø¯Ø³ØªÙ‡ Ø¢Ù…ÙˆØ²Ø´ Ù‡Ø§','windows-1252');
        */
        $str = mb_convert_encoding($_GET['str'], $format);
        echo '<p>' . $str . '<br></p>';//if you're use bootstrap simply you can add class 'alert alert-success` to get result in alert view
    } else {
        echo '<p>error on sending data, please try again</p>';//if you're use bootstrap simply you can add class 'alert alert-danger` to get error in alert view
    }
    echo $form;
} else {
    echo $form;
}