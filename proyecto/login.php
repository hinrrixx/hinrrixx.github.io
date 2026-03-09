<?php
session_start();
require "conexion.php";


if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es';
}

if (isset($_GET['lang']) && in_array($_GET['lang'], ['es','en'])) {
    $_SESSION['idioma'] = $_GET['lang'];
}

$idioma = $_SESSION['idioma'];


$txt = [
    'es' => [
        'titulo'     => 'Iniciar Sesión',
        'bienvenido' => 'Bienvenido de nuevo',
        'mensaje'    => 'El buen café no se toma, se saborea; no se bebe, se vive.',
        'usuario'    => 'Usuario',
        'clave'      => 'Contraseña',
        'entrar'     => 'Entrar',
        'error'      => 'Usuario o contraseña incorrectos'
    ],
    'en' => [
        'titulo'     => 'Login',
        'bienvenido' => 'Welcome back',
        'mensaje'    => 'Good coffee is not taken, it is savored; it is not drunk, it is experienced.',
        'usuario'    => 'Username',
        'clave'      => 'Password',
        'entrar'     => 'Login',
        'error'      => 'Invalid username or password'
    ]
];

$t = $txt[$idioma];
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['titulo'] ?></title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="login-page">

    <div class="login-card">

        <div class="login-ui">

            <div class="top-bar">
                <div class="lang">
                    <a href="?lang=es" class="<?= $idioma=='es'?'active-lang':'' ?>">ES</a> |
                    <a href="?lang=en" class="<?= $idioma=='en'?'active-lang':'' ?>">EN</a>
                </div>
                <div class="nav">
                    <a class="active">Login</a>
                    <a href="registro.php">Registro</a>
                </div>
            </div>

            <h2><?= $t['bienvenido'] ?></h2>
            <p><?= $t['mensaje'] ?></p>

            <form method="POST">
                <div class="input-group">
                    <input type="text" name="usuario" placeholder="<?= $t['usuario'] ?>" required>
                </div>

                <div class="input-group">
                    <input type="password" name="clave" placeholder="<?= $t['clave'] ?>" required>
                </div>

                <button name="login"><?= $t['entrar'] ?></button>
            </form>

            <?php
        
            if (isset($_POST['login'])) {

                $usuario = trim($_POST['usuario']);
                $clave   = trim($_POST['clave']);

                $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
                $stmt->execute([$usuario]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && hash('sha256', $clave) === $user['password']) {

                    $_SESSION['login']   = true;
                    $_SESSION['id']      = $user['id_usuario'];
                    $_SESSION['usuario'] = $user['usuario'];
                    $_SESSION['rol']     = $user['rol'];
                    $_SESSION['idioma']  = $user['idioma'];

                    header("Location: vistas/inicio.php");
                    exit;
                } else {
                    echo "<p class='error'>{$t['error']}</p>";
                }
            }
            ?>
        </div>

   
        <div class="login-visual">
            <img src="img/logo_secundario.jpeg" alt="Logo Cafetería">
        </div>

    </div>
</div>

</body>
</html>
