<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['login']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}


if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es';
}

if (isset($_GET['lang']) && in_array($_GET['lang'], ['es','en'])) {
    $_SESSION['idioma'] = $_GET['lang'];
}

$idioma = $_SESSION['idioma'];


$txt = [

    'es' => [
        'titulo'    => 'Administración de Usuarios',
        'volver'    => 'Volver al inicio',
        'cerrar'    => 'Cerrar sesión',
        'eliminar'  => 'Eliminar',
        'no_borrar' => 'No puedes eliminarte',
        'fecha'     => 'Fecha de registro',
        'tabla' => [
            'id'      => 'ID',
            'usuario' => 'Usuario',
            'nombre'  => 'Nombre',
            'correo'  => 'Correo',
            'pais'    => 'País',
            'telefono'=> 'Teléfono',
            'rol'     => 'Rol'
        ]
    ],

    'en' => [
        'titulo'    => 'User Administration',
        'volver'    => 'Back to home',
        'cerrar'    => 'Logout',
        'eliminar'  => 'Delete',
        'no_borrar' => 'You cannot delete yourself',
        'fecha'     => 'Register date',
        'tabla' => [
            'id'      => 'ID',
            'usuario' => 'Username',
            'nombre'  => 'Name',
            'correo'  => 'Email',
            'pais'    => 'Country',
            'telefono'=> 'Phone',
            'rol'     => 'Role'
        ]
    ]
];

$t = $txt[$idioma];


if (isset($_GET['eliminar'])) {

    $idEliminar = (int) $_GET['eliminar'];

    if ($idEliminar !== $_SESSION['id']) {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        $stmt->execute([$idEliminar]);
    }

    header("Location: admin.php");
    exit;
}


$stmt = $pdo->query("
    SELECT 
        id_usuario,
        usuario,
        nombre,
        correo,
        pais,
        telefono,
        rol,
        fecha_registro
    FROM usuarios
    ORDER BY fecha_registro DESC
");

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['titulo'] ?></title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<header class="top-header">

    <div class="top-bar">
        <div class="top-left">
            <span class="logo">☕ A SORBOS</span>
        </div>

        <div class="top-right">
            <a href="?lang=es">ES</a>
            <a href="?lang=en">EN</a>
            <span class="divider">|</span>
            𖡌 <?= htmlspecialchars($_SESSION['usuario']) ?>
            <a href="logout.php">↪ <?= $t['cerrar'] ?></a>
        </div>
    </div>

    <nav class="main-nav">
        <ul class="menu">
            <li><a href="inicio.php"><?= $t['volver'] ?></a></li>
        </ul>
    </nav>

</header>

<section class="admin-container">

    <h1><?= $t['titulo'] ?></h1>

    <table class="tabla-admin">
        <thead>
            <tr>
                <th><?= $t['tabla']['id'] ?></th>
                <th><?= $t['tabla']['usuario'] ?></th>
                <th><?= $t['tabla']['nombre'] ?></th>
                <th><?= $t['tabla']['correo'] ?></th>
                <th><?= $t['tabla']['pais'] ?></th>
                <th><?= $t['tabla']['telefono'] ?></th>
                <th><?= $t['tabla']['rol'] ?></th>
                <th><?= $t['fecha'] ?></th>
                <th><?= $t['eliminar'] ?></th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id_usuario'] ?></td>
                <td><?= htmlspecialchars($u['usuario']) ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['correo']) ?></td>
                <td><?= htmlspecialchars($u['pais'] ?? '-') ?></td>
                <td><?= htmlspecialchars($u['telefono'] ?? '-') ?></td>
                <td><?= htmlspecialchars($u['rol']) ?></td>
                <td><?= $u['fecha_registro'] ?></td>

                <td class="acciones">
                    <?php if ($u['id_usuario'] != $_SESSION['id']): ?>
                        <a href="?eliminar=<?= $u['id_usuario'] ?>"
                           onclick="return confirm('¿Eliminar este usuario?')"
                           class="btn-eliminar">
                            <?= $t['eliminar'] ?>
                        </a>
                    <?php else: ?>
                        <span class="no-eliminar"><?= $t['no_borrar'] ?></span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

</section>

</body>
</html>

