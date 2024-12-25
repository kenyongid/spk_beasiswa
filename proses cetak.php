<?php

include "config.php";
require('fpdf/fpdf.php');

class PDF extends FPDF
{
	//Page footer
	function Footer()
	{
		//atur posisi 1.5 cm dari bawah
		$this->SetY(-1);
		//Arial italic 9
		$this->SetFont('Arial','I',9);
		//nomor halaman
		$this->Cell(0,0.8,'Halaman '.$this->PageNo().' dari {nb}',0,0,'C');
	}
}

$pdf = new PDF('P','cm','A4');
$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();

    // AWAL REPORT HEADER
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(19,0.5,'XXXX',0,1,'C');
    $pdf->Cell(19,0.5,'XXXX',0,1,'C');

    // REPORT DETAIL
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(1,0.8,'xxx',1,0,'L');
    $pdf->Cell(2,0.8,'xxx',1,0,'L');
    $pdf->Cell(6,0.8,'xxx',1,0,'L');

    $no=1;
    $sql = "SELECT * FROM nama_tabel";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $pdf->SetFont('Arial','',9);

        $pdf->Cell(2,0.8,$row['tgl_bayar'],1,0,'L');
        $pdf->Cell(6,0.8,$row['nama_siswa'],1,0,'L');
        $pdf->Cell(4,0.8,$row['nama_kelas'],1,0,'L');
    }

    $pdf->Output("nama_file.pdf","I");
    exit;
?>