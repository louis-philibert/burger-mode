<?php


    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
    }


require 'database.php';

    if(!empty($_GET['id'])){ 
        $id = checkInput($_GET['id']);
    }

    $db = DataBase::connect();
    $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category 
    from items INNER JOIN categories ON items.category = categories.id
    WHERE items.id=?');
    $statement->execute(array($id));
    $item = $statement->fetch();
    DataBase::disconnect();

    function checkInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
            <div class="col-sm-6">
                 <h1><strong>Voir un item</strong></h1>
                 <br>
                 <form>
                     <div class="form-group">
                         <label>Nom: </label> <?php echo''. $item['name']; ?>
                     </div>
                     <div class="form-group">
                         <label>Description: </label> <?php echo''. $item['description']; ?>
                     </div>
                     <div class="form-group">
                         <label>Prix: </label> <?php echo''. number_format((float)$item['price'],2,'.','') . " €"; ?>
                     </div>
                     <div class="form-group">
                         <label>Catégorie: </label> <?php echo''. $item['category']; ?>
                     </div>
                     <div class="form-group">
                         <label>Image: </label> <?php echo''. $item['image']; ?>
                     </div>
                 </form>
                 <br>
                 <div class="form-actions">
                 <a class="btn btn-primary" href="index.php"><i class="fad fa-angle-left"></i> Retour</a>
                 </div>
            </div>
            <div class="col-sm-6 site">
                        <div class="img-thumbnail thumbnail-xs ">
                            <img class="card-img-top" src="<?='../images/'. $item['image'];  ?>" alt="photo">
                            <div class="price"><?= number_format((float)$item['price'],2,'.','') . " €"; ?></div>
                            <div class="caption">
                                <h4><?= $item['name']; ?></h4>
                                <p><?= $item['description']; ?></p>
                                <a href="#" class="btn btn-order" role="button"><span class="far fa-shopping-cart"></span> Commander</a>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</body>
</html>