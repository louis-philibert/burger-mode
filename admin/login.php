<?php
    require "database.php";
    session_start();

    $email = $password = $error = "";

    if(!empty($_POST)){
        $email = checkInput($_POST['email']);
        $password = checkInput($_POST['password']);

        $db = DataBase::connect();
        $statement = $db->prepare("SELECT * FROM users WHERE email = ? and password = ?");
        $statement->execute(array($email, $password));
        DataBase::disconnect();

        if($statement->fetch()){
            $_SESSION['email'] = $email;
            header("Location: index.php");
        }else{
            $error = "Votre email ou mot de passe sont incorrects";
        }
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
    <link href="../css/styleQuery.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-logo" id="logo-login"><span class="fas fa-utensils-alt">Burger Mode<span class="fas fa-utensils-alt"></span></h1>
    <div class="container adminis">
        <div class="row">
            <h1 id="h1-insert"><strong>Login</strong></h1>
            <br>
            <br>
            <form class="form" role="form" action="login.php" method="post" id="login">
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email ?>"> 
                </div>
                <div class="form-group">
                    <label for="password">Mot-de-passe: </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de Passe" value="<?php echo $password ?>"> 
                </div>
            <span class="help-inline"><?php echo $error ?></span>
            <div class="form-actions">
            <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>

