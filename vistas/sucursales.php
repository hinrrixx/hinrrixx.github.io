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

        'titulo' => 'Nuestras Sucursales',

        'sucursales' => [
            [
                'nombre' => 'Casco Antiguo',
                'direccion' => '📍 Calle 8va, Casco Antiguo, Ciudad de Panamá',
                'descripcion' => 'Cafetería con estilo colonial y ambiente cultural.',
                'horarios' => [
                    'Lunes a Viernes: 07:00H - 19:00H',
                    'Sábados y Domingos: 08:00H - 21:00H'
                ]
            ],
            [
                'nombre' => 'Obarrio',
                'direccion' => '📍 Calle 54 Este, Obarrio, Ciudad de Panamá',
                'descripcion' => 'Ideal para reuniones de trabajo y café ejecutivo.',
                'horarios' => [
                    'Lunes a Viernes: 06:30H - 20:00H',
                    'Sábados: 07:00H - 18:00H'
                ]
            ],
            [
                'nombre' => 'El Cangrejo',
                'direccion' => '📍 Vía Argentina, El Cangrejo',
                'descripcion' => 'Ambiente juvenil, ideal para estudiar y trabajar.',
                'horarios' => [
                    'Todos los días: 07:00H - 22:00H'
                ]
            ],
            [
                'nombre' => 'San Francisco',
                'direccion' => '📍 Calle 74 Este, San Francisco',
                'descripcion' => 'Café artesanal con terraza al aire libre.',
                'horarios' => [
                    'Lunes a Viernes: 07:00H - 20:00H',
                    'Fines de semana: 08:00H - 21:00H'
                ]
            ],
            [
                'nombre' => 'Albrook Mall',
                'direccion' => '📍 Albrook Mall, Pasillo del Delfín',
                'descripcion' => 'Perfecto para una pausa rápida de compras.',
                'horarios' => [
                    'Todos los días: 10:00H - 21:00H'
                ]
            ],
            [
                'nombre' => 'Costa del Este',
                'direccion' => '📍 Ave. Centenario, Costa del Este',
                'descripcion' => 'Cafetería moderna con vista urbana.',
                'horarios' => [
                    'Lunes a Viernes: 06:30H - 20:00H',
                    'Sábados: 07:00H - 18:00H'
                ]
            ],
            [
                'nombre' => 'Brisas del Golf',
                'direccion' => '📍 Plaza Brisas Capital, Brisas del Golf',
                'descripcion' => 'Ambiente familiar y tranquilo.',
                'horarios' => [
                    'Todos los días: 07:00H - 20:00H'
                ]
            ],
            [
                'nombre' => 'Clayton',
                'direccion' => '📍 Ciudad del Saber, Clayton',
                'descripcion' => 'Café ecológico rodeado de naturaleza.',
                'horarios' => [
                    'Lunes a Viernes: 07:00H - 18:00H'
                ]
            ]
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

        'titulo' => 'Our Locations',

        'sucursales' => [
            [
                'nombre' => 'Casco Antiguo',
                'direccion' => '📍 8th Street, Casco Antiguo, Panama City',
                'descripcion' => 'Colonial-style café with a cultural atmosphere.',
                'horarios' => [
                    'Monday to Friday: 07:00H - 19:00H',
                    'Weekends: 08:00H - 21:00H'
                ]
            ],
            [
                'nombre' => 'Obarrio',
                'direccion' => '📍 54th Street East, Obarrio, Panama City',
                'descripcion' => 'Ideal for business meetings and executive coffee.',
                'horarios' => [
                    'Monday to Friday: 06:30H - 20:00H',
                    'Saturdays: 07:00H - 18:00H'
                ]
            ],
            [
                'nombre' => 'El Cangrejo',
                'direccion' => '📍 Vía Argentina, El Cangrejo',
                'descripcion' => 'Youthful atmosphere, perfect for studying and working.',
                'horarios' => [
                    'Every day: 07:00H - 22:00H'
                ]
            ],
            [
                'nombre' => 'San Francisco',
                'direccion' => '📍 74th Street East, San Francisco',
                'descripcion' => 'Artisan coffee with outdoor terrace.',
                'horarios' => [
                    'Monday to Friday: 07:00H - 20:00H',
                    'Weekends: 08:00H - 21:00H'
                ]
            ],
            [
                'nombre' => 'Albrook Mall',
                'direccion' => '📍 Albrook Mall, Dolphin Hall',
                'descripcion' => 'Perfect for a quick shopping break.',
                'horarios' => [
                    'Every day: 10:00H - 21:00H'
                ]
            ],
            [
                'nombre' => 'Costa del Este',
                'direccion' => '📍 Centenario Ave., Costa del Este',
                'descripcion' => 'Modern café with an urban view.',
                'horarios' => [
                    'Monday to Friday: 06:30H - 20:00H',
                    'Saturdays: 07:00H - 18:00H'
                ]
            ],
            [
                'nombre' => 'Brisas del Golf',
                'direccion' => '📍 Brisas Capital Plaza, Brisas del Golf',
                'descripcion' => 'Family-friendly and calm atmosphere.',
                'horarios' => [
                    'Every day: 07:00H - 20:00H'
                ]
            ],
            [
                'nombre' => 'Clayton',
                'direccion' => '📍 City of Knowledge, Clayton',
                'descripcion' => 'Eco-friendly café surrounded by nature.',
                'horarios' => [
                    'Monday to Friday: 07:00H - 18:00H'
                ]
            ]
        ]
    ]
];

$t = $txt[$idioma];
?>
<!DOCTYPE html>
<html lang="<?= $idioma ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['titulo'] ?></title>
    <link rel="stylesheet" href="../css/sucursales.css">
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

<?php
$imagenes = [
    '../img/casco.png',
    '../img/obarrio.png',
    '../img/el_cangrejo.png',
    '../img/san_francisco.png',
    '../img/albrook.png',
    '../img/costa_del_este.png',
    '../img/brisas.png',
    '../img/clayton.png'
];

foreach ($t['sucursales'] as $index => $sucursal):
?>
<section class="sucursal <?= $index % 2 ? 'reverse' : '' ?>">
    <div class="sucursal-image">
        <img src="<?= $imagenes[$index] ?>" alt="<?= htmlspecialchars($sucursal['nombre']) ?>">
    </div>

    <div class="sucursal-info">
        <h2><?= $sucursal['nombre'] ?></h2>
        <p class="direccion"><?= $sucursal['direccion'] ?></p>
        <p><?= $sucursal['descripcion'] ?></p>

        <div class="horarios">
            <?php foreach ($sucursal['horarios'] as $horario): ?>
                <p><?= $horario ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

</body>
</html>
