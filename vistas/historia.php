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

        'menu' => [
            'inicio'     => 'Inicio',
            'cafes'      => 'Cafés',
            'historia'   => 'Historia',
            'reseñas'    => 'Reseñas',
            'sucursales' => 'Cafeterías'
        ],

        'historia' => [

            'titulo' => 'Nuestra Historia',

            'ruta' => 'Tu momento, nuestro café. Descubre el lugar donde cada sorbo es una experiencia. En A Sorbos, fusionamos la artesanía del buen café con el calor de un espacio pensado para ti.',

            'intro' => 'Disfruta de productos de alta calidad y recetas tradicionales en un ambiente con servicio amable y personalizado. ¡Cada bocado es una experiencia única!',

            'quienes_titulo' => 'Quiénes Somos',
            'quienes_texto'  => 'En A Sorbos Coffee & More creemos que el mejor café es aquel que se comparte. Nuestra historia nace de una pasión sencilla: transformar la pausa del café en un momento memorable. Seleccionamos cuidadosamente cada grano, cuidando su origen y tueste, para ofrecer en cada taza aromas y sabores auténticos. Más que una cafetería, somos un espacio acogedor donde las conversaciones fluyen y los días comienzan con el mejor sabor.',

            'descubrimiento_titulo' => 'El Descubrimiento del Café',
            'descubrimiento_texto'  => 'La leyenda cuenta que un pastor etíope llamado Kaldi descubrió el café alrededor del año 850 d.C. al notar que sus cabras se llenaban de energía tras comer unas bayas rojas. Los monjes cercanos comenzaron a preparar una infusión que les permitía mantenerse despiertos durante largas horas de oración, marcando el inicio del viaje del café desde Etiopía hacia el mundo.',

            'europa_titulo' => 'El Café Llega a Europa',
            'europa_texto'  => 'En el siglo XVII el café llegó a Europa a través de Venecia. Aunque inicialmente fue cuestionado, pronto se convirtió en una bebida apreciada por intelectuales y artistas. Las cafeterías se transformaron en centros de debate y cultura, siendo Venecia la sede de la primera cafetería europea en 1645.',

            'america_titulo' => 'El Café en América',
            'america_texto'  => 'Durante el siglo XVIII el café llegó a América y encontró en Latinoamérica condiciones ideales para su cultivo. Países como Brasil, Colombia, Costa Rica y Panamá desarrollaron variedades únicas que hoy representan más del 60% de la producción mundial de café.'
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

        'historia' => [

            'titulo' => 'Our Story',

            'ruta' => 'Your moment, our coffee. Discover the place where every sip becomes an experience. At A Sorbos, we blend the craft of fine coffee with the warmth of a space designed just for you.',

            'intro' => 'Enjoy high-quality products and traditional recipes in a warm atmosphere with friendly and personalized service. Every bite is a unique experience.',


            'quienes_titulo' => 'Who We Are',
            'quienes_texto'  => 'At A Sorbos Coffee & More, we believe that the best coffee is the one that is shared. Our story was born from a simple passion: transforming the coffee break into a memorable moment. We carefully select each bean, honoring its origin and roast, to deliver authentic aromas and flavors in every cup. More than a coffee shop, we are a welcoming space where conversations flow and days begin with the best taste.',

            'descubrimiento_titulo' => 'The Discovery of Coffee',
            'descubrimiento_texto'  => 'Legend tells that an Ethiopian shepherd named Kaldi discovered coffee around 850 AD after noticing that his goats became energetic upon eating red berries from a bush. Nearby monks began preparing an infusion that helped them stay awake during long hours of prayer, marking the beginning of coffee’s journey from Ethiopia to the world.',

            'europa_titulo' => 'Coffee Reaches Europe',
            'europa_texto'  => 'In the 17th century, coffee arrived in Europe through Venice. Although initially questioned, it soon became a favored drink among intellectuals and artists. Coffeehouses evolved into centers of debate and culture, with the first European café opening in Venice in 1645.',

            'america_titulo' => 'Coffee in the Americas',
            'america_texto'  => 'During the 18th century, coffee reached the Americas and found ideal growing conditions throughout Latin America. Countries such as Brazil, Colombia, Costa Rica, and Panama developed unique varieties that today represent more than 60% of global coffee production.'
        ]
    ]
];

$t = $txt[$idioma];
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['historia']['titulo'] ?></title>
    <link rel="stylesheet" href="../css/historia.css">
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

    <section class="historia-hero">
        <div class="historia-hero-overlay">
            <div class="historia-hero-content">
                <h1><?= $t['historia']['titulo'] ?></h1>
                <p><?= $t['historia']['ruta'] ?></p>
            </div>
        </div>
    </section>

</header>

<section class="historia-intro">
    <p><?= $t['historia']['intro'] ?></p>
</section>

<section class="ven-section">

    <div class="ven-content">
        <h2><?= $t['historia']['quienes_titulo'] ?></h2>
        <p><?= $t['historia']['quienes_texto'] ?></p>
    </div>

    <div class="ven-image">
        <img src="../img/historia2.png" alt="Quiénes somos A Sorbos">
    </div>

</section>


<section class="overlay-section" style="background-image: url('../img/historia3.png');">

    <div class="overlay-box">
        <h2><?= $t['historia']['descubrimiento_titulo'] ?></h2>
        <p><?= $t['historia']['descubrimiento_texto'] ?></p>
    </div>

</section>


<section class="overlay-section left" style="background-image: url('../img/historia4.png');">

    <div class="overlay-box">
        <h2><?= $t['historia']['europa_titulo'] ?></h2>
        <p><?= $t['historia']['europa_texto'] ?></p>
    </div>

</section>


</section>

<section class="overlay-section" style="background-image: url('../img/historia5.png');">

    <div class="overlay-box">
        <h2><?= $t['historia']['america_titulo'] ?></h2>
        <p><?= $t['historia']['america_texto'] ?></p>
    </div>

</section>


</body>
</html>
