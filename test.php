<?php

//2019-05-08     2019-06-27     2019-07-27    true
$today_day = date('Y-m-d' );

$order_day = date('Y-m-d', strtotime( '2019-06-27' ));

$seven_day = date('Y-m-d', strtotime('2019-06-27' . ' + 7 days')); //2019-07-04

if ( $today_day <= $seven_day ){

    echo "true";

}

?>