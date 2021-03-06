<?php
ini_set('display_errors', 1);
require_once 'config/database.php';
require_once 'admin/scripts/read.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $tbl = 'tbl_movies';
    $col = 'movies_id';
    $getMovie = getSingleMovie($tbl, $col, $id);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details</title>
</head>
<body>

<?php include_once 'templates/header.php'; ?>
    <?php if(!is_string($getMovie)):?>
        <?php while($row = $getMovie->fetch(PDO::FETCH_ASSOC)):?>
            <img src="images/<?php echo $row['movies_cover'];?>" alt="<?php echo $row['movies_title'];?>">
            
            <h2>Name: <?php echo $row['movies_title'];?></h2>
            <h4>Year: <?php echo $row['movies_year'];?></h4>
            <p>Story: <?php echo $row['movies_storyline'];?></p>
            <a href="index.php">Go back...</a>
        <?php endwhile; ?>
    <?php endif; ?>


    <?php include_once 'templates/footer.php'; ?>
</body>
</html>