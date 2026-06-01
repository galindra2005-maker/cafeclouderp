<?php

session_start();

include 'config/koneksi.php';

// PANGGIL DOMPDF

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

// HTML PDF

$html = '

<h2 style="text-align:center;">
Laporan ERP AI
</h2>

<table border="1" width="100%" cellspacing="0" cellpadding="8">

<tr>

    <th>No</th>
    <th>No Transaksi</th>
    <th>Metode</th>
    <th>Total</th>
    <th>Status</th>

</tr>

';

$query = mysqli_query($conn, "
SELECT * FROM transaksi_kasir
");

$no = 1;

while($data = mysqli_fetch_array($query)){

$html .= '

<tr>

    <td>'.$no++.'</td>

    <td>'.$data['no_transaksi'].'</td>

    <td>'.$data['metode'].'</td>

    <td>Rp '.number_format($data['total']).'</td>

    <td>'.$data['status'].'</td>

</tr>

';

}

$html .= '

</table>

';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream("laporan_erp.pdf", array(
    "Attachment" => false
));

?>