<?php

include "../koneksi.php";
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L", "cm", "A4");

$pdf->SetMargins(2, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 11);
// $pdf->Image('../assets/gambar/...',1,1,2,2);
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'PT Visi Teliti (visiteliti.com)', 0, 'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Telpon : 02178889892', 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Jl. TB Simatupang No.96', 0, 'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Email : visiteliti@gmail.com', 0, 'L');
$pdf->Line(1, 3.1, 28.5, 3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(1, 3.2, 28.5, 3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 0.7, 'Laporan Data Jabatan', 0, 0, 'C');
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(5, 0.7, "Di cetak pada : " . date("D-d/m/Y"), 0, 0, 'C');
$pdf->ln(1);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Jabatan', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Gaji', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Uang Trasnport', 1, 1, 'C');

$no = 1;
$query = mysql_query("select * from jabatan order by id_jabatan asc");
while ($lihat = mysql_fetch_array($query)) {
	$pdf->Cell(1, 0.8, $no, 1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['nama_jabatan'], 1, 0, 'C');
	$pdf->Cell(5, 0.8, "Rp. " . number_format($lihat['gaji_pokok']) . " ,-", 1, 0, 'C');
	$pdf->Cell(4, 0.8, "Rp. " . number_format($lihat['uang_transport']) . " ,-", 1, 1, 'C');

	$no++;
}
/* $q=mysql_query("select sum(gaji_pokok) as total from jabatan where id_jabatan");
// select sum(total_harga) as total from barang_laku where tanggal='$tanggal'
while($total=mysql_fetch_array($q)){
	$pdf->Cell(6, 0.8, "Total Pengeluaran", 1, 0,'C');		
	$pdf->Cell(5, 0.8, "Rp. ".number_format($total['total'])." ,-", 1, 0,'C');
	$pdf->Cell(5, 0.8, "Rp. ".number_format($total['total'])." ,-", 1, 0,'C');	
}
$qu=mysql_query("select sum(gaji_pokok) as total_laba from jabatan where nama_jabatan");
*/

$pdf->Output("laporan_buku.pdf", "I");
