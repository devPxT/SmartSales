<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require "geral/links.php" ?>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center mt-5" style="flex: 1" id="login">
        <div class="card">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item text-center">   
                    <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Login</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> 
                    <div class="form px-4 pt-5">
                        <input type="text" name="login" class="form-control" placeholder="Login">
                        <input type="password" name="senha" class="form-control" placeholder="Senha">
                        <button class="btn btn-dark btn-block">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "geral/footer.php" ?>
</body>
</html>
