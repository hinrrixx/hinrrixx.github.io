<?php
require "conexion.php";
session_start();

if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es';
}

if (isset($_GET['lang'])) {
    $_SESSION['idioma'] = $_GET['lang'];
}

$txt = [
    'es' => [
        'titulo' => 'Registro',
        'unete' => 'Únete a nuestra comunidad',
        'mensaje' => '¿Listo para disfrutar de más beneficios? Regístrate y saborea la experiencia completa.',
        'usuario' => 'Usuario',
        'correo' => 'Correo',
        'pais' => 'País de residencia',
        'clave' => 'Contraseña',
        'verificar' => 'Verificar contraseña',
        'registrar' => 'Registrarme'
    ],
    'en' => [
        'titulo' => 'Register',
        'unete' => 'Join our community',
        'mensaje' => 'Ready to enjoy even more benefits? Sign up and savor the full experience.',
        'usuario' => 'Username',
        'correo' => 'Email',
        'pais' => 'Country',
        'clave' => 'Password',
        'verificar' => 'Confirm password',
        'registrar' => 'Register'
    ]
];

$t = $txt[$_SESSION['idioma']];
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['idioma'] ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['titulo'] ?></title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>

<div class="login-page">
    <div class="login-card">

        
        <div class="login-ui">

            <div class="top-bar">
                <div class="lang">
                    <a href="?lang=es" class="<?= $_SESSION['idioma']=='es'?'active-lang':'' ?>">ES</a> |
                    <a href="?lang=en" class="<?= $_SESSION['idioma']=='en'?'active-lang':'' ?>">EN</a>
                </div>
                <div class="nav">
                    <a href="login.php">Login</a>
                    <a class="active"><?= 'Registro' ?></a>
                </div>
            </div>

            <h2><?= $t['unete'] ?></h2>
            <p><?= $t['mensaje'] ?></p>

            <form method="POST" onsubmit="return validar()">

                <div class="input-group">
                    <input type="text" name="usuario" placeholder="<?= $t['usuario'] ?>" required>
                </div>

                <div class="input-group">
                    <input type="email" name="correo" placeholder="<?= $t['correo'] ?>" required>
                </div>

                <div class="input-group">
                    <input type="text" name="pais" placeholder="<?= $t['pais'] ?>">
                </div>

                <div class="input-group">
                    <input type="password" id="pass" name="pass" placeholder="<?= $t['clave'] ?>" required>
                </div>

                <div class="input-group">
                    <input type="password" id="pass2" placeholder="<?= $t['verificar'] ?>" required>
                </div>

                <p id="error" class="error"></p>

                <button type="submit" name="registro"><?= $t['registrar'] ?></button>
            </form>

            <?php
            if (isset($_POST['registro'])) {

                $check = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE usuario = :usuario");
                $check->execute([":usuario" => $_POST['usuario']]);

                if ($check->rowCount() > 0) {
                    echo "<p class='error'>El usuario ya existe</p>";
                } else {

                    $stmt = $pdo->prepare(
                        "INSERT INTO usuarios (usuario, nombre, correo, password, pais, idioma)
                         VALUES (:usuario, :nombre, :correo, :password, :pais, :idioma)"
                    );

                    $stmt->execute([
                        ":usuario"  => $_POST['usuario'],
                        ":nombre"   => $_POST['usuario'],
                        ":correo"   => $_POST['correo'],
                        ":password" => hash('sha256', $_POST['pass']),
                        ":pais"     => $_POST['pais'],
                        ":idioma"   => $_SESSION['idioma']
                    ]);

                    echo "<script>alert('Registro exitoso'); window.location='login.php';</script>";
                }
            }
            ?>

        </div>

        <div class="login-visual">
            <img src="img/logo_principal.jpeg" alt="Logo Cafetería">
        </div>

    </div>
</div>

<script>
function validar() {
    let pass = document.getElementById("pass").value;
    let pass2 = document.getElementById("pass2").value;
    let error = document.getElementById("error");

    let regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    if (!regex.test(pass)) {
        error.textContent = "Debe incluir mayúscula, minúscula, número y carácter especial.";
        return false;
    }

    if (pass !== pass2) {
        error.textContent = "Las contraseñas no coinciden.";
        return false;
    }
    return true;
}
</script>

</body>
</html>



