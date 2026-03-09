<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$rol     = $_SESSION['rol'];


$perfilLink = ($rol === 'admin') ? 'admin.php' : 'perfil.php';


if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es';
}


if (isset($_GET['lang']) && in_array($_GET['lang'], ['es','en'])) {
    $_SESSION['idioma'] = $_GET['lang'];
}

$idioma = $_SESSION['idioma'];


$txt = [

    'es' => [

        'logout' => 'Cerrar sesión',

        'menu' => [
            'inicio'     => 'Inicio',
            'cafes'      => 'Cafés',
            'historia'   => 'Historia',
            'reseñas'    => 'Reseñas',
            'sucursales' => 'Cafeterías'
        ],

        'productos' => [
            'destacados' => 'Productos Destacados',
            'titulo'     => 'Nuestros Productos',
            'precio'     => 'Precio',
            'vacio'      => 'No hay productos disponibles'
        ]
    ],

    'en' => [

        'logout' => 'Logout',

        'menu' => [
            'inicio'     => 'Home',
            'cafes'      => 'Coffee',
            'historia'   => 'Story',
            'reseñas'    => 'Reviews',
            'sucursales' => 'Cafés'
        ],

        'productos' => [
            'destacados' => 'Featured Products',
            'titulo'     => 'Our Products',
            'precio'     => 'Price',
            'vacio'      => 'No products available'
        ]
    ]
];

$t = $txt[$idioma];


$campoNombre = ($idioma === 'es') ? 'es_nombre' : 'en_nombre';
$campoDesc   = ($idioma === 'es') ? 'es_descripcion' : 'en_descripcion';

$stmt = $pdo->prepare("SELECT * FROM productos WHERE categoria = 'destacado'");
$stmt->execute();
$destacados = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM productos WHERE categoria = 'regular'");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['productos']['titulo'] ?></title>
    <link rel="stylesheet" href="../css/producto.css">
</head>
<body>

<header class="top-header">

    <div class="top-bar">
        <div class="top-left">
            <span class="logo">☕ A SORBOS</span>
        </div>

        <div class="top-right">
            <a href="?lang=en">EN</a>
            <a href="?lang=es">ES</a>
            <span class="divider">|</span>

            𖡌 <a href="<?= $perfilLink ?>"><?= htmlspecialchars($usuario) ?></a>
            <a href="logout.php">↪ <?= $t['logout'] ?></a>
        </div>
    </div>

    <nav class="main-nav">
        <ul class="menu">
            <li><a href="inicio.php"><?= $t['menu']['inicio'] ?></a></li>
            <li><a href="productos.php"><?= $t['menu']['cafes'] ?></a></li>
            <li><a href="historia.php"><?= $t['menu']['historia'] ?></a></li>
            <li><a href="rese.php"><?= $t['menu']['reseñas'] ?></a></li>
            <li><a href="sucursales.php"><?= $t['menu']['sucursales'] ?></a></li>
        </ul>
    </nav>

</header>


<div class="seccion-titulo">
    <h2><?= $t['productos']['destacados'] ?></h2>
</div>

<section class="colecciones">

<?php if (count($destacados) === 0): ?>
    <p><?= $t['productos']['vacio'] ?></p>
<?php endif; ?>

<?php foreach ($destacados as $p): ?>
    <div class="coleccion-card">
        <img src="../img/<?= htmlspecialchars($p['imagen']) ?>" alt="">
        <div class="coleccion-overlay">
            <p class="coleccion-text">
                <?= htmlspecialchars($p[$campoDesc]) ?>
            </p>
            <h3><?= htmlspecialchars($p[$campoNombre]) ?></h3>
        </div>
    </div>
<?php endforeach; ?>

</section>


<div class="seccion-titulo">
    <h2><?= $t['productos']['titulo'] ?></h2>
</div>

<section class="productos-lista">

<?php if (count($productos) === 0): ?>
    <p><?= $t['productos']['vacio'] ?></p>
<?php endif; ?>

<?php foreach ($productos as $p): ?>
    <article class="producto-card">
        <img src="../img/<?= htmlspecialchars($p['imagen']) ?>" alt="">
        <div class="producto-info">
            <h3><?= htmlspecialchars($p[$campoNombre]) ?></h3>
            <span class="precio">
                <?= $t['productos']['precio'] ?>: $<?= number_format($p['precio'],2) ?>
            </span>
            <p><?= htmlspecialchars($p[$campoDesc]) ?></p>
        </div>
    </article>
<?php endforeach; ?>

</section>

</body>
</html>





    