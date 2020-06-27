<?php

$name = $_GET['name'];
$theme = $_GET['theme'];

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Vivero</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.5/examples/album.css" rel="stylesheet">
  </head>

  <body>

    <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong><?php echo $name ?></strong>
          </a>
        </div>
      </div>
    </header>

    <main role="main">
      <div class="album py-5 bg-light" <?php if ($theme == "dark"): ?> style="background: #777777 !important" <?php endif; ?>>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 box-shadow" <?php if ($theme == "dark"): ?> style="border: none" <?php endif; ?>>
                <img class="card-img-top" src="https://portaleltoro.com/wp-content/uploads/2018/09/plantas-1200x762_c.jpg" alt="Card image cap">
                <div class="card-body" <?php if ($theme == "dark"): ?> style="background: #5E6D7B" <?php endif; ?>>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow" <?php if ($theme == "dark"): ?> style="border: none" <?php endif; ?>>
                <img class="card-img-top" src="https://portaleltoro.com/wp-content/uploads/2018/09/plantas-1200x762_c.jpg" alt="Card image cap">
                <div class="card-body" <?php if ($theme == "dark"): ?> style="background: #5E6D7B" <?php endif; ?>>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow" <?php if ($theme == "dark"): ?> style="border: none" <?php endif; ?>>
                <img class="card-img-top" src="https://portaleltoro.com/wp-content/uploads/2018/09/plantas-1200x762_c.jpg" alt="Card image cap">
                <div class="card-body" <?php if ($theme == "dark"): ?> style="background: #5E6D7B" <?php endif; ?>>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow" <?php if ($theme == "dark"): ?> style="border: none" <?php endif; ?>>
                <img class="card-img-top" src="https://portaleltoro.com/wp-content/uploads/2018/09/plantas-1200x762_c.jpg" alt="Card image cap">
                <div class="card-body" <?php if ($theme == "dark"): ?> style="background: #5E6D7B" <?php endif; ?>>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow" <?php if ($theme == "dark"): ?> style="border: none" <?php endif; ?>>
                <img class="card-img-top" src="https://portaleltoro.com/wp-content/uploads/2018/09/plantas-1200x762_c.jpg" alt="Card image cap">
                <div class="card-body" <?php if ($theme == "dark"): ?> style="background: #5E6D7B" <?php endif; ?>>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow" <?php if ($theme == "dark"): ?> style="border: none" <?php endif; ?>>
                <img class="card-img-top" src="https://portaleltoro.com/wp-content/uploads/2018/09/plantas-1200x762_c.jpg" alt="Card image cap">
                <div class="card-body" <?php if ($theme == "dark"): ?> style="background: #5E6D7B" <?php endif; ?>>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </main>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
  </body>
</html>
