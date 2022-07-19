<?php

include "../koneksi.php";
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P", "cm", "A4");

$pdf->SetMargins(2, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 11);
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Sistem Penggajian - PT Visi Teliti', 0, 'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Telpon : 02178889337', 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Jl. TB Simatupang No.69A', 0, 'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Email : visiteliti@gmail.com', 0, 'L');
$pdf->Line(1, 3.1, 28.5, 3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(1, 3.2, 28.5, 3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 0.7, 'Laporan Data Penggajian', 0, 0, 'C');
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(5, 0.7, "Di cetak pada : " . date("D-d/m/Y"), 0, 0, 'C');
$pdf->ln(1);
//$no=1;
$id_gaji = $_GET['id_gaji'];
$query = mysql_query("SELECT gaji.id_gaji, gaji.bulan, gaji.tahun, gaji.tanggal_transfer, karyawan.nama_karyawan, jabatan.nama_jabatan, karyawan.gaji_pokok, karyawan.uang_transport, gaji.hari_kerja, gaji.kehadiran, gaji.bonus, gaji.jumlah_lembur, gaji.telat1, gaji.telat2, gaji.telat3, gaji.total_gaji 
				from ((penggajian.gaji 
				inner join penggajian.karyawan on karyawan.id_karyawan = gaji.id_karyawan) 
				inner join penggajian.jabatan on jabatan.id_jabatan = gaji.id_jabatan) where id_gaji=$id_gaji ORDER BY id_gaji asc");
while ($lihat = mysql_fetch_array($query)) {
	//$pdf->Cell(5, 0.8, 'NO', 1, 0, 'C');
	//$pdf->Cell(5, 0.8, $no , 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Nama Karyawan', 1, 0, 'L');
	$pdf->Cell(5, 0.8, $lihat['nama_karyawan'], 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Nama Jabatan', 1, 0, 'L');
	$pdf->Cell(5, 0.8, $lihat['nama_jabatan'], 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Gaji Pokok', 1, 0, 'L');
	$pdf->Cell(5, 0.8, ('Rp.   ' . number_format('' . $lihat['gaji_pokok'] . '') . ''), 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Uang Transport', 1, 0, 'L');
	$pdf->Cell(5, 0.8, ('Rp.   ' . number_format('' . $lihat['uang_transport'] . '') . ''), 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Jumlah Hari Kerja', 1, 0, 'L');
	$pdf->Cell(5, 0.8, $lihat['hari_kerja'], 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Kehadiran', 1, 0, 'L');
	$pdf->Cell(5, 0.8, $lihat['kehadiran'], 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Bonus', 1, 0, 'L');
	$pdf->Cell(5, 0.8, ('Rp.   ' . number_format('' . $lihat['bonus'] . '') . ''), 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Jumlah Lembur', 1, 0, 'L');
	$pdf->Cell(5, 0.8, ('Rp.   ' . number_format('' . $lihat['jumlah_lembur'] . '') . ''), 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Telat > 15 Menit', 1, 0, 'L');
	$pdf->Cell(5, 0.8, ('( ' . 'Rp.   ' . number_format($lihat['telat1'] * 15000) . '' . ' )'), 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Telat > 60 Menit', 1, 0, 'L');
	$pdf->Cell(5, 0.8, ('( ' . 'Rp.   ' . number_format($lihat['telat2'] * 25000) . '' . ' )'), 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Telat > 120 Menit', 1, 0, 'L');
	$pdf->Cell(5, 0.8, ('( ' . 'Rp.   ' . number_format($lihat['telat3'] * 45000) . '' . ' )'), 1, 1, 'C');
	$pdf->ln(1);
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->Cell(5, 0.8, 'Total Gaji', 1, 0, 'C');
	$pdf->Cell(5, 0.8, ('Rp.   ' . number_format('' . $lihat['total_gaji'] . '') . ''), 1, 1, 'C');
	$pdf->Cell(3.5, 0.8, '', 0, 0);
	$pdf->ln(1);
	//$no++;
}
$pdf->ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(17, 0.7, "Manager, PT Visi Teliti", 0, 0, 'R');
$pdf->ln(3);
$pdf->Cell(17, 0.7, ".........................................", 0, 0, 'R');
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
