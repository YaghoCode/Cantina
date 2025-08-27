<?php
include('/xampp/htdocs/cantinarepositorio/main/database.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
$query = "SELECT * from estoque";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0){

        foreach($query_run as $item){
            
           echo' <div class="divteste"> <h1>' . $item['id'] . '</h1> </div>';
            
        }
    }

?>
</body>
</html>