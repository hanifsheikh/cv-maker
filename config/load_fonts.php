<?php
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$fontDirectory = __DIR__ . '/../storage/fonts';
$options = new Options();
$options->setChroot($fontDirectory);

$dompdf = new Dompdf($options);

$raleway = [
    'weights' => [
        'Light' => 300,
        'Regular' => 400,
        'Medium' => 500,
        'SemiBold' => 600,
        'Bold' => 700,
        'ExtraBold' => 800,
        'Black' => 900
    ]
];
foreach ($raleway['weights'] as $key => $weight) {
    $dompdf->getFontMetrics()->registerFont(
        ['family' => 'Raleway', 'style' => 'normal', 'weight' => $weight],
        $fontDirectory . '/Raleway-' . $key . '.ttf'
    );
}
$dompdf->getFontMetrics()->registerFont(
    ['family' => 'Raleway', 'style' => 'italic', 'weight' => 500],
    $fontDirectory . '/Raleway-MediumItalic.ttf'
);
