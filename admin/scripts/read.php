<?php 
function getAll($tbl){
    $pdo = Database::getInstance()->getconnection();
    $queryAll = 'SELECT * FROM '.$tbl;
    $results = $pdo->query($queryAll);

    if($results){
        return $results;
    }else{
        return 'There was an error.';
    }
}

function getSingleMovie($tbl, $col, $id){
    //getAll function but only take the clicked id
    $pdo = Database::getInstance()->getconnection();
    //$querySingle = 'SELECT * FROM '.$tbl.' WHERE id='.$col;
    $querySingle = 'SELECT * FROM '.$tbl.' WHERE '.$col.'='.$id;
    $results = $pdo->query($querySingle);

    if($results){
        return $results;
    }else{
        return 'There was an error.';
    }
}

function getMoviesByFilter($args){
    $pdo = Database::getInstance()->getConnection();
    $filterQuery = 'SELECT * FROM '.$args['tbl1'].' AS t, '.$args['tbl2'].' AS t2, '.$args['tbl3'].' AS t3';
    $filterQuery .= ' WHERE t.'.$args['col1'].' = t3.'.$args['col1'];
    $filterQuery .= ' AND t2.'.$args['col2'].' = t3.'.$args['col2'];
    $filterQuery .= ' AND t2.'.$args['col3'].' = "'.$args['filter'].'"';


    $results = $pdo->query($filterQuery);
    if($results){
        return $results;
    }else{
        return 'There was an error.';
    }
}