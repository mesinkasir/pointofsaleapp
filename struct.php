<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */

 ob_start();
 include "cetak_nota.php";
 $content = ob_get_clean();
$date=date('d-m-Y');
require __DIR__.'/vendor/autoload.php';


use Spipu\Html2Pdf\Html2Pdf;
$html2pdf = new Html2Pdf('P', 'A5', 'en');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example.pdf');

