<?php

    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Burger Mode</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link href="http://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-logo"><span class="fas fa-utensils-alt">Burger Mode<span class="fas fa-utensils-alt"></span></h1>
    <div class="container admin">
        <div class="row">
            <h1><strong>Liste des items   </strong><a href="insert.php" class="btn btn-success btn-lg"><i class="fas fa-plus"></i>Ajouter</a>
                                               <a href="../index.php" class="btn btn-warning btn-lg"><i class="far fa-sign-out-alt"></i>Se deconnecter</a></h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php  
                        require 'database.php';
                        $db = DataBase::connect();
                        $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category 
                        from items INNER JOIN categories ON items.category = categories.id
                        ORDER BY items.id DESC');
                        while($item = $statement->fetch()){
                            echo '<tr>';
                                echo '<td>'. $item['name'] .'</td>';
                                echo '<td>'. $item['description'] .'</td>';
                                echo '<td>'. number_format((float)$item['price'],2,'.','') .'</td>';
                                echo '<td>'. $item['category'] .'</td>';
                                echo '<td id="actions">';
                                    echo '<a class="btn btn-outline-dark" href="view.php?id='.$item['id'].'"><i class="far fa-eye"></i>Voir</a>' ;
                                    echo '<a class="btn btn-primary" href="update.php?id='.$item['id'].'"><i class="fas fa-pencil-alt"></i>Modifier</a>' ;
                                    echo '<a class="btn btn-danger" href="delete.php?id='.$item['id'].'"><i class="fas fa-trash-alt"></i>Supprimer</a>' ;
                                echo '</td>';
                            echo'</tr>';
                        }
                        DataBase::disconnect();
                        ?>
                   

                </tbody>
            </table>

        </div>
    </div>
</body>
</html>