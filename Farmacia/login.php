<!doctype html>
<html lang="en">
  <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Inicio de seción</title>
  </head>
  <body>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Farmacia</h5>
            <form action="conexLogin.php" method="post" >
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Remember password
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
                  in</button>
                  <a href="registro.php">Registrarme</a>
                  <a href="activar.php">Activar Cuenta</a>
              </div>

              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 
        <script src="js/bootstrap.bundle.min.js" ></script>

    
  </body>
</html>