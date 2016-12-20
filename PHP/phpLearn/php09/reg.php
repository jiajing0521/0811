<?php

//$str = '/\d{3}/';
//$result = preg_match($str, '123');
//echo $result;

$str = checkdnsrr('.com');
if ($str) {
    echo '合法';
}
else
{
    echo '非法';
}
