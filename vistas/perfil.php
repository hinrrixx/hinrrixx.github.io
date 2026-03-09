<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['login']) || !isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$idUsuario = $_SESSION['id'];


if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es';
}

if (isset($_GET['lang']) && in_array($_GET['lang'], ['es','en'])) {
    $_SESSION['idioma'] = $_GET['lang'];
    header("Location: perfil.php");
    exit;
}

$idioma = $_SESSION['idioma'];


$txt = [
    'es' => [
        'perfil' => 'Perfil de Usuario',
        'datos' => 'Mis Datos',
        'usuario' => 'Usuario',
        'nombre' => 'Nombre',
        'correo' => 'Correo',
        'pais' => 'País',
        'direccion' => 'Dirección',
        'telefono' => 'Teléfono',
        'fecha' => 'Fecha de nacimiento',
        'genero' => 'Género',
        'actualizar' => 'Actualizar Datos',
        'cambiar' => 'Cambiar Contraseña',
        'actual' => 'Contraseña actual',
        'nueva' => 'Nueva contraseña',
        'confirmar' => 'Confirmar contraseña',
        'logout' => 'Cerrar sesión'
    ],
    'en' => [
        'perfil' => 'User Profile',
        'datos' => 'My Data',
        'usuario' => 'Username',
        'nombre' => 'Name',
        'correo' => 'Email',
        'pais' => 'Country',
        'direccion' => 'Address',
        'telefono' => 'Phone',
        'fecha' => 'Birth date',
        'genero' => 'Gender',
        'actualizar' => 'Update Data',
        'cambiar' => 'Change Password',
        'actual' => 'Current password',
        'nueva' => 'New password',
        'confirmar' => 'Confirm password',
        'logout' => 'Logout'
    ]
];

$t = $txt[$idioma];


if (isset($_POST['actualizar'])) {
    $stmt = $pdo->prepare(
        "UPDATE usuarios 
         SET nombre=?, correo=?, pais=?, direccion=?, telefono=?, fecha_nacimiento=?, genero=?
         WHERE id_usuario=?"
    );
    $stmt->execute([
        $_POST['nombre'],
        $_POST['correo'],
        $_POST['pais'],
        $_POST['direccion'],
        $_POST['telefono'],
        $_POST['fecha'],
        $_POST['genero'],
        $idUsuario
    ]);

    header("Location: perfil.php?ok=datos");
    exit;
}


if (isset($_POST['cambiar'])) {

    $stmt = $pdo->prepare("SELECT password FROM usuarios WHERE id_usuario=?");
    $stmt->execute([$idUsuario]);
    $passBD = $stmt->fetchColumn();

    if (hash('sha256', $_POST['actual']) !== $passBD) {
        header("Location: perfil.php?error=actual");
        exit;
    }

    if ($_POST['nueva'] !== $_POST['confirmar']) {
        header("Location: perfil.php?error=coinciden");
        exit;
    }

    if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/", $_POST['nueva'])) {
        header("Location: perfil.php?error=segura");
        exit;
    }

    $stmt = $pdo->prepare("UPDATE usuarios SET password=? WHERE id_usuario=?");
    $stmt->execute([
        hash('sha256', $_POST['nueva']),
        $idUsuario
    ]);

    header("Location: perfil.php?ok=pass");
    exit;
}


$stmt = $pdo->prepare(
    "SELECT usuario, nombre, correo, pais, direccion, telefono, fecha_nacimiento, genero
     FROM usuarios WHERE id_usuario=?"
);
$stmt->execute([$idUsuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Error de sesión");
}
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['perfil'] ?></title>
    <link rel="stylesheet" href="../css/perfil.css">
</head>
<body>

<div class="container">

<header class="perfil-header">

    <div class="header-top-right">
        <a href="?lang=es">ES</a> |
        <a href="?lang=en">EN</a>
        <a href="logout.php" class="logout"><?= $t['logout'] ?></a>
    </div>

    <h1><?= $t['perfil'] ?></h1>
    <h3><?= htmlspecialchars($_SESSION['usuario']) ?></h3>

</header>

<nav>
    <a href="inicio.php">Inicio</a>   
</nav>

<section>

<h2><?= $t['datos'] ?></h2>

<form method="POST">

<label><?= $t['usuario'] ?></label>
<input type="text" value="<?= htmlspecialchars($usuario['usuario']) ?>" disabled>

<label><?= $t['nombre'] ?></label>
<input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

<label><?= $t['correo'] ?></label>
<input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>

<label><?= $t['pais'] ?></label>
<input type="text" name="pais" value="<?= htmlspecialchars($usuario['pais']) ?>">

<label><?= $t['direccion'] ?></label>
<input type="text" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">

<label><?= $t['telefono'] ?></label>
<input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">

<label><?= $t['fecha'] ?></label>
<input type="date" name="fecha" value="<?= htmlspecialchars($usuario['fecha_nacimiento']) ?>">

<label><?= $t['genero'] ?></label>
<select name="genero">
    <option value="">---</option>
    <option value="Masculino" <?= $usuario['genero']=='Masculino'?'selected':'' ?>>Masculino</option>
    <option value="Femenino" <?= $usuario['genero']=='Femenino'?'selected':'' ?>>Femenino</option>
    <option value="Otro" <?= $usuario['genero']=='Otro'?'selected':'' ?>>Otro</option>
</select>

<button name="actualizar"><?= $t['actualizar'] ?></button>
</form>

<hr>

<h2><?= $t['cambiar'] ?></h2>

<form method="POST">
<label><?= $t['actual'] ?></label>
<input type="password" name="actual" required>

<label><?= $t['nueva'] ?></label>
<input type="password" name="nueva" required>

<label><?= $t['confirmar'] ?></label>
<input type="password" name="confirmar" required>

<button name="cambiar"><?= $t['cambiar'] ?></button>
</form>

</section>

</div>
</body>
</html>


