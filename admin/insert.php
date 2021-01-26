<?php

    session_start();
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
    }
    
    require "database.php";

    $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";

    if(!empty($_POST)){
        $name = checkInput($_POST['name']);
        $description = checkInput($_POST['description']);
        $price = checkInput($_POST['price']);
        $category = checkInput($_POST['category']);
        $image = checkInput($_FILES['image']['name']);
        $imagePath = '../images/' . basename($image);
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess = true;
        $isUploadSuccess = false;

        if(empty($name)){
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($description)){
            $descriptionError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($price)){
            $priceError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($category)){
            $categoryError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)){
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }else{
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif"){
                $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)){
                $imageError = "Le fichier existe déjà";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000){
                $imageError = "Le fichier ne doit pas dépasser les 500KG";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess){
                if(!move_uploaded_file($_FILES['image']["tmp_name"], $imagePath)){
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                }
            }
        }
        if($isSuccess && $isUploadSuccess){
            $db = DataBase::connect();
            $statement = $db->prepare("INSERT INTO items (name, description, price, category, image) values(?,?,?,?,?)");
            $statement->execute(array($name, $description, $price, $category, $image));
            DataBase::disconnect();
            header("Location: index.php");
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
</head>
<body>
    <h1 class="text-logo"><span class="fas fa-utensils-alt">Burger Mode<span class="fas fa-utensils-alt"></span></h1>
    <div class="container admin">
        <div class="row">
            <h1 id="h1-insert"><strong>Ajouter un item</strong></h1>
            <br>
            <br>
            <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data" id="form-insert">
                <div class="form-group">
                    <label for="name">Nom: </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name ?>"> 
                    <span class="help-inline"><?php echo $nameError ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description: </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description ?>"> 
                    <span class="help-inline"><?php echo $descriptionError ?></span>
                </div>
                <div class="form-group">
                    <label for="price">Prix: (en €)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prx" value="<?php echo $price ?>"> 
                    <span class="help-inline"><?php echo $priceError ?></span>
                </div>
                    <div class="form-group">
                    <label for="category">Catégorie: </label>
                    <select class="form-control" id="category" name="category">
                     <?php 
                        $db = DataBase::connect();
                        foreach($db->query('SELECT * FROM categories') as $row){
                            echo'<option value="'. $row['id'] . '">' . $row['name'] . '</option>';}
                        DataBase::disconnect();
                     ?>
                    </select> 
                    <span class="help-inline"><?php echo $categoryError ?></span>
                </div>
                    <div class="form-group">
                    <label for="image">Sélectionner une image: </label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><?php echo $imageError ?></span>
                </div>
            <br>
            <div class="form-actions">
            <button type="submit" class="btn btn-success" id='btn-insert'><i class="fas fa-pencil-alt"></i> Ajouter</button>
            <a class="btn btn-primary" href="index.php"><i class="fad fa-angle-left"></i> Retour</a>
            </div>
            </form>
        </div>
    </div>
</body>
</html>

