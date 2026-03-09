<?php
session_start();

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

       
        'hero_sub'   => 'CAFÉ',
        'hero_title' => 'A SORBOS',
        'hero_text'  => 'Un espacio donde el café, la cultura y la calma se encuentran para crear experiencias auténticas.',

        
        'menu' => [
            'inicio'     => 'Inicio',
            'cafes'      => 'Cafés',
            'historia'   => 'Historia',
            'reseñas'    => 'Reseñas',
            'sucursales' => 'Cafeterías'
        ],

        
        'values_title' => 'BREW. SIP. REMEMBER.',
        'values' => [
            'quality' => 'Nos dedicamos a seleccionar, tostar y servir cafés de la más alta calidad.',
            'origin'  => 'Exclusivamente de Origen Único, mostrando las características únicas de cada terroir.',
            'sustain' => 'Comprometidos con la calidad y la sostenibilidad.'
        ],

       
        'cards' => [
            'about_title' => 'Nosotros: Tu cafetería de especialidad',
            'about_text'  => 'Para que una taza de café sea verdaderamente especial, debe pasar por muchas manos y ser tratada con pasión y compromiso en cada paso de la cadena.',

            'panama_title' => 'Café de Panamá',
            'panama_text'  => 'Panamá produce uno de los mejores cafés del mundo, reconocido en subastas y competencias internacionales.',

            'brew_title' => 'Prepara café como en tu cafetería favorita',
            'brew_text'  => 'Elige la molienda adecuada, guarda tu café correctamente y aprende a extraer el máximo sabor.'
        ]
    ],

    'en' => [

        'logout' => 'Logout',

 
        'hero_sub'   => 'COFFEE',
        'hero_title' => 'A SORBOS',
        'hero_text'  => 'A place where coffee, culture, and calm meet to create authentic experiences.',

       
        'menu' => [
            'inicio'     => 'Home',
            'cafes'      => 'Coffee',
            'historia'   => 'Story',
            'reseñas'    => 'Reviews',
            'sucursales' => 'Cafés'
        ],

        
        'values_title' => 'BREW. SIP. REMEMBER.',
        'values' => [
            'quality' => 'We are dedicated to sourcing and serving the highest quality coffees.',
            'origin'  => 'Exclusively Single Origin, showcasing unique terroirs.',
            'sustain' => 'Committed to quality and sustainability.'
        ],

       
        'cards' => [
            'about_title' => 'About Us: Your Specialty Coffee Shop',
            'about_text'  => 'For a cup of coffee to be truly special, it must pass through many hands and be treated with passion.',

            'panama_title' => 'Panamanian Coffee',
            'panama_text'  => 'Panama produces some of the finest coffee in the world, recognized internationally.',

            'brew_title' => 'Brew Coffee Like Your Favorite Café',
            'brew_text'  => 'Choose the right grind, store your coffee properly, and learn the best brewing techniques.'
        ]
    ]
];

$t = $txt[$idioma];
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title>A SORBOS</title>
    <link rel="stylesheet" href="../css/menu.css">
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

<section class="hero">
    <div class="hero-overlay">
        <div class="hero-box">
            <span class="hero-subtitle"><?= $t['hero_sub'] ?></span>
            <h1 class="hero-title"><?= $t['hero_title'] ?></h1>
            <p class="hero-text"><?= $t['hero_text'] ?></p>
        </div>
    </div>
</section>

<section class="values-section">
    <h2 class="values-title"><?= $t['values_title'] ?></h2>

    <div class="values-container">

        <div class="value-item">
            <div class="value-icon">
                <img src="../img/circulo1.png" alt="Quality coffee">
            </div>
            <p><?= $t['values']['quality'] ?></p>
        </div>

        <div class="value-item">
            <div class="value-icon">
                <img src="../img/circulo2.png" alt="Single origin">
            </div>
            <p><?= $t['values']['origin'] ?></p>
        </div>

        <div class="value-item">
            <div class="value-icon">
                <img src="../img/circulo3.png" alt="Sustainability">
            </div>
            <p><?= $t['values']['sustain'] ?></p>
        </div>

    </div>
</section>

<section class="hover-cards">

    <div class="hover-card">
        <img src="../img/cuadro1.png" alt="Nuestra cafetería">
        <div class="hover-content">
            <h3><?= $t['cards']['about_title'] ?></h3>
            <p><?= $t['cards']['about_text'] ?></p>
        </div>
    </div>

    <div class="hover-card">
        <img src="../img/cuadro2.png" alt="Café de Panamá">
        <div class="hover-content">
            <h3><?= $t['cards']['panama_title'] ?></h3>
            <p><?= $t['cards']['panama_text'] ?></p>
        </div>
    </div>

    <div class="hover-card">
        <img src="../img/cuadro3.png" alt="Preparar café">
        <div class="hover-content">
            <h3><?= $t['cards']['brew_title'] ?></h3>
            <p><?= $t['cards']['brew_text'] ?></p>
        </div>
    </div>

</section>


</body>
</html>

