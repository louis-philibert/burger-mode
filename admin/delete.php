<?php

    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
    }


    require "database.php";

    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)){
        $id = checkInput($_POST['id']);
        DataBase::connect();
        $statement = $db->prepare("DELETE FROM items  WHERE id = ?");
        $statement->execute(array($id));
        DataBase::disconnect();
        header("Location: index.php");
    }

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
            <h1 id="h1-insert"><strong>Supprimer un item</strong></h1>
            <br>
            <form class="form" role="form" action="delete.php" method="post">
             <input type="hidden" name="id" value="<?php echo $id; ?>">
             <p class="alert alert-wrning">Etes-vous sur de vouloir supprimer ?</p>
            <br>
            <div class="form-actions">
            <button type="submit" class="btn btn-warning" id='btn-delete2'>Oui</button>
            <a class="btn btn-primary" href="index.php" id='btn-delete1'></i>Non</a>
            </div>
            </form>
        </div>
    </div>
</body>
</html>

