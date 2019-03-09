<?php
echo dirname(__FILE__); // returns /var/www/html
echo "<br>" .basename(__FILE__); //returns index.php

echo "<br>" .basename(dirname(__FILE__)); //returns html
echo dirname( __DIR__ ) . '/includes/class-staff-area-access.php' ;
?>