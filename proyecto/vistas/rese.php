<?php
session_start();
require "../conexion.php";

if (!isset($_SESSION['login']) || !isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}


$idUsuario = $_SESSION['id'];
$usuario   = $_SESSION['usuario'];
$rol       = $_SESSION['rol'];

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
        'titulo' => 'Reseñas',
        'mensaje' => 'Tu opinión es muy importante para nosotros',
        'descripcion' => 'Comparte tu experiencia con nuestros productos y servicio.',
        'nueva' => 'Escribir reseña',
        'titulo_resena' => 'Título',
        'contenido' => 'Tu opinión',
        'publicar' => 'Publicar reseña',
        'sin_resenas' => 'Aún no hay reseñas publicadas',
        'logout' => 'Cerrar sesión',
        'menu' => [
            'inicio' => 'Inicio',
            'cafes' => 'Cafés',
            'historia' => 'Historia',
            'reseñas' => 'Reseñas',
            'sucursales' => 'Cafeterías'
        ]
    ],

    'en' => [
        'titulo' => 'Reviews',
        'mensaje' => 'Your opinion is very important to us',
        'descripcion' => 'Share your experience with our products and service.',
        'nueva' => 'Write review',
        'titulo_resena' => 'Title',
        'contenido' => 'Your opinion',
        'publicar' => 'Publish review',
        'sin_resenas' => 'There are no reviews yet',
        'logout' => 'Logout',
        'menu' => [
            'inicio' => 'Home',
            'cafes' => 'Coffee',
            'historia' => 'Story',
            'reseñas' => 'Reviews',
            'sucursales' => 'Cafés'
        ]
    ]
];

$t = $txt[$idioma];


if (isset($_POST['publicar'])) {

    $titulo    = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);

    if ($titulo !== '' && $contenido !== '') {

        $stmt = $pdo->prepare(
            "INSERT INTO resenas (id_usuario, titulo, contenido)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$idUsuario, $titulo, $contenido]);

        header("Location: rese.php");
        exit;
    }
}


$stmt = $pdo->query(
    "SELECT r.titulo, r.contenido, r.fecha_creacion, u.usuario
     FROM resenas r
     JOIN usuarios u ON r.id_usuario = u.id_usuario
     WHERE r.estado = 'activo'
     ORDER BY r.fecha_creacion DESC"
);

$resenas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['titulo'] ?></title>
    <link rel="stylesheet" href="../css/rese.css">
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


<section class="resenas-mensaje">
    <h2><?= $t['mensaje'] ?></h2>
    <p><?= $t['descripcion'] ?></p>
</section>


<section class="resena-form">
    <h3><?= $t['nueva'] ?></h3>

    <form method="POST">
        <input type="text" name="titulo"
               placeholder="<?= $t['titulo_resena'] ?>" required>

        <textarea name="contenido"
                  placeholder="<?= $t['contenido'] ?>"
                  rows="4" required></textarea>

        <button name="publicar"><?= $t['publicar'] ?></button>
    </form>
</section>


<section class="resenas-grid">

<?php if (count($resenas) === 0): ?>
    <p><?= $t['sin_resenas'] ?></p>
<?php endif; ?>

<?php foreach ($resenas as $r): ?>
    <article class="resena-card">

        <div class="resena-header">
            <div class="avatar">
                <?= strtoupper(substr($r['usuario'], 0, 1)) ?>
            </div>

            <div class="meta">
                <span class="autor"><?= htmlspecialchars($r['usuario']) ?></span>
                <span class="fecha">
                    <?= date("d/m/Y", strtotime($r['fecha_creacion'])) ?>
                </span>
            </div>
        </div>

        <h3><?= htmlspecialchars($r['titulo']) ?></h3>

        <p class="resena-texto">
            <?= nl2br(htmlspecialchars($r['contenido'])) ?>
        </p>

    </article>
<?php endforeach; ?>

</section>

</body>
</html>



