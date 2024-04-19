<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/bikestores/app/scripts/css/style.css">
    <style>
        .modal-header,
        .close {
            background-color: #5cb85c;
            color: white !important;
            text-align: center;
            font-size: 30px;
        }

        .modal-footer {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/bikestores">BikeStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/bikestores">
                            <h4>Home</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <h4>Products</h4>
                        </a>
                    </li>
                </ul>
                <?php
                // Fonction pour récupérer tous les cookies
                function getCookies() {
                    $cookies = isset($_COOKIE) ? $_COOKIE : [];
                    $cookiesObject = [];
                    foreach ($cookies as $name => $value) {
                        $cookiesObject[$name] = $value;
                    }
                    return $cookiesObject;
                }

                // Vérifier si le cookie user_role est défini
                if (isset(getCookies()['user_role'])) {
                    $user_role = getCookies()['user_role'];

                    // Afficher différents éléments de menu en fonction du rôle de l'utilisateur
                    echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
                    switch ($user_role) {
                        case 'employee':
                            echo '<li class="nav-item">
                                    <a class="nav-link" href="/bikestores/app/src/View/Menu.php">
                                        <h4>Add/Modify/Delete</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <h4>Edit Profile</h4>
                                    </a>
                                </li>';
                            break;
                        case 'chief':
                            echo '<li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <h4>View Employees</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <h4>Add Employee</h4>
                                    </a>
                                </li>';
                            break;
                        case 'it':
                            echo '<li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <h4>View Employees</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <h4>Add Employee</h4>
                                    </a>
                                </li>';
                            break;
                        default:
                            // Si le rôle de l'utilisateur n'est pas reconnu, afficher un message d'erreur
                            echo '<li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <h4>Error: Unknown role</h4>
                                    </a>
                                </li>';
                    }
                    echo '</ul>';
                ?>
            </div>
            <?php
                    // Bouton de déconnexion
                    echo '<form method="POST" action="/bikestores/logout">
                            <button type="submit" class="btn btn-default btn-lg">Logout</button>
                        </form>';
                } else {
                    // Si le cookie user_role n'est pas défini, afficher le bouton de connexion
                    echo '<button type="button" class="btn btn-default btn-lg" id="myBtn">Login</button>';
                }
            ?>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" method="POST" action="/bikestores/login">
                                <div class="form-group">
                                    <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label>
                                    <input type="text" class="form-control" id="usrname" name="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                                    <input type="text" class="form-control" id="psw" name="password" placeholder="Enter password">
                                </div>
                                <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <script>
        $(document).ready(function() {
            $("#myBtn").click(function() {
                $("#myModal").modal();
            });
        });
    </script>

</html>
