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
    <link href="css/style.css" rel="stylesheet">
    <link href="css/styleQuery.css" rel="stylesheet">
</head>
<body>
    <div class="glowing-animation"></div>
    <div class="container site">
        <h1 class="text-logo"><span class="fas fa-utensils-alt">Burger Mode<span class="fas fa-utensils-alt"></span></h1>
            <div></div>
        <?php 
                require "admin/database.php";
                echo '<nav>
                <ul class="nav nav-pills" id="pills-tab" role="tablist">';
                $db = DataBase::connect();
                $statement = $db->query('SELECT * FROM categories');
                $categories = $statement->fetchAll();
                foreach($categories as $category){
                    if($category['id'] == '1'){
                        echo '<li class="nav-item"><a class="nav-link active" id="nav-' . $category['id'] . '-tab" data-toggle="pill" href="#nav-'. $category['id'] . '" role="tab" aria-controls="' . $category['id'] . '" aria-selected="true">' . $category['name'] . '</a></li>';
                    }else{
                        echo '<li class="nav-item"><a class="nav-link" id="nav-' . $category['id'] . '-tab" data-toggle="pill" href="#nav-'. $category['id'] . '" role="tab" aria-controls="' . $category['id'] . '" aria-selected="false">' . $category['name'] . '</a></li>';
                    }
                }
                echo '</ul>
                </nav>';
                echo '<div class="tab-content" id="pills-tabContent">';
                foreach($categories as $category){
                    if($category['id'] == '1'){
                        echo '<div class="tab-pane fade show active" id="nav-' . $category['id'] . '" role="tabpanel" aria-labelledby="nav-' . $category['id'] . '-tab">';
                    }else{
                        echo '<div class="tab-pane fade" id="nav-' . $category['id'] . '" role="tabpanel" aria-labelledby="nav-' . $category['id'] . '-tab">';
                    }
                    echo '<div class="row">';

                    $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
                    $statement->execute(array($category['id']));

                    while($item = $statement->fetch()){
                        echo ' <div class="col-sm-6 col-md-4">
                        <div class="img-thumbnail thumbnail-xs ">
                            <img class="card-img-top" src="images/' . $item['image'] . '" alt="'. $item['name'] .'">
                            <div class="price">' . number_format($item['price'], 2,'.',''). ' €</div>
                            <div class="caption">
                                <h4>' . $item['name'] . '</h4
                                <p>' . $item['description'] . '</p>
                                <a id="btn-index" href="users/pageCommande.php" class="btn btn-order" role="button"><span class="far fa-shopping-cart"></span> Commander</a>
                            </div>
                        </div>
                    </div>';
                    }
                    echo '</div>
                    </div>';
                }
                DataBase::disconnect();
                echo '</div>';
        ?>
    </div>
<footer class="page-footer font-small mdb-color pt-4" id="footer">

<!-- Footer Links -->
<div class="container text-center text-md-left">

  <!-- Footer links -->
  <div class="row text-center text-md-left mt-3 pb-3">

    <!-- Grid column -->
    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
      <h6 class="text-uppercase mb-4 font-weight-bold">Company name</h6>
      <p>Restauration Rapide.
         Beaucoup de menus au choix, ainsi qu'un assortiment complet.
         Venez selectionner ce dont vous avez envies.
      </p>
    </div>
    <!-- Grid column -->

    <hr class="w-100 clearfix d-md-none">

    <!-- Grid column -->
    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
      <h6 class="text-uppercase mb-4 font-weight-bold">Acceuil</h6>
      <p>
        <a href="index.php">Acceuil</a>
    </div>
    <!-- Grid column -->

    <hr class="w-100 clearfix d-md-none">

    <!-- Grid column -->
    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
      <h6 class="text-uppercase mb-4 font-weight-bold">Administrateur</h6>
      <?php
     echo '<button class="btn-footer" type="button">';
      echo "<a class='lien' href='admin/login.php'>Se connecter</a>";
     echo '</button>';
      ?>
    </div>

    <!-- Grid column -->
    <hr class="w-100 clearfix d-md-none">

    <!-- Grid column -->
    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
      <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
      <p>
        <i class="fas fa-home mr-3"></i> Créteil, 94 400 , FR</p>
      <p>
        <i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
      <p>
        <i class="fas fa-phone mr-3"></i> + 01 00 00 00 00</p>
      <p>
        <i class="fas fa-print mr-3"></i> + 01 00 00 00 00</p>
    </div>
    <!-- Grid column -->

  </div>
  <!-- Footer links -->

  <hr>

  <!-- Grid row -->
  <div class="row d-flex align-items-center">

    <!-- Grid column -->
    <div class="col-md-7 col-lg-8">

      <!--Copyright-->
      <p class="text-center text-md-left">© 2020 Copyright:
        <a href="https://google.com/">
          <strong> BurgerMode.com</strong>
        </a>
      </p>

    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-md-5 col-lg-4 ml-lg-0">

      <!-- Social buttons -->
      <div class="text-center text-md-right">
        <ul class="list-unstyled list-inline">
          <li class="list-inline-item">
            <a href="https://www.facebook.com/" class="btn-floating btn-sm rgba-white-slight mx-1">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://twitter.com/explore" class="btn-floating btn-sm rgba-white-slight mx-1">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://www.google.fr/webhp?source=search_app" class="btn-floating btn-sm rgba-white-slight mx-1">
              <i class="fab fa-google-plus-g"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://fr.linkedin.com/" class="btn-floating btn-sm rgba-white-slight mx-1">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </li>
        </ul>
      </div>

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</div>
<!-- Footer Links -->

</footer>
<!-- Footer -->
</body>
</html>