
<?php

    $a = 1;
    $i = 1;

    $date=date_create($leave->start_date);

    $date->modify('-1 day');

    $date_array = array();

    foreach ($publicholidays as $value) 
    {
        array_push($date_array, $value);
    }
   
    while ($a <= $leave->days) 
     {
        $date->modify('+1 day');

       if($date->format('D') != 'Sat' && $date->format('D') != 'Sun')
        {  
            if(!in_array(date_format($date,"Y-m-d"), $date_array))
            {
                $a++;
            }    
        } 
     } 

    echo date_format($date,"Y-m-d");

?>