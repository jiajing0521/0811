<?php
/**
 * Created by PhpStorm.
 * User: tusm
 * Date: 2016/11/7
 * Time: 17:20
 */
    $ages = array(12, 34, 21, 89, 55, 90, 22, 44, 66, 32);
    $temp = 0;
    $flag = 0;
    echo $flag;
    for ($i = 0; $i < count($ages); $i++)
    {
        $flag = 0;
        for ($j = 0; $j < count($ages) - $i - 1; $j++)
        {
            if ($ages[$j] > $ages[$j + 1])
            {
                $temp = $ages[$j];
                $ages[$j] = $ages[$j + 1];
                $ages[$j + 1] = $temp;
                $flag = 1;
            }
        }
        if ($flag == 0)
        {
            break;
        }
    }
    print_r($ages);