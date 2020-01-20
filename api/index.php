test file
<?php
include_once '../config/database.php';
include_once '../config/database_old.php';


$start = microtime(true);
#new way of connecting
$i = 0;
while($i<100){
    $database = Database::getInstance()->getConnection();
    $i++;
}
$new_time = microtime(true) - $start;


#old
$start = microtime(true);
$i = 0;
while($i<100){
    $old_database = new Database_old();
    $old_database_connection = $old_database->getConnection();
    $i++;
}
$old_time = microtime(true) - $start;

printf('new connection takes==> %s ms'.PHP_EOL, $new_time * 1000);
printf('old connection takes==> %s ms'.PHP_EOL, $old_time * 1000);

printf('you saved %s ms'.PHP_EOL, ($old_time - $new_time) * 1000);
printf('new connection takes %s%% ms of old connection'.PHP_EOL, ($new_time/$old_time) * 100);