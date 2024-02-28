<?php
include 'db.php'; // Sertakan koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Terima data dari POST dengan filter dan validasi (opsional)
    $namaPengguna = $_POST['namaPengguna'];
    $dinas = $_POST['dinas'];
    $subservice = $_POST['subservice'];
    $lokasi = $_POST['lokasi'];
    $nomerSPT = $_POST['nomerSPT'];
    $jenisPelanggaran = $_POST['jenisPelanggaran'];
    $tindakan = $_POST['tindakan'];
    $status = $_POST['status'];
    $tglOperasi = $_POST['tglOperasi'];
    $noISRTelahSetelahPenindakan = $_POST['noISRSetelahPenindakan'];
    $noSuratPenindakan = $_POST['noSuratPenindakan'];
    $tanggalTindakan = $_POST['tanggalTindakan'];
    $keterangan = $_POST['keterangan'];

    // Query untuk memasukkan data dengan prepared statement
    $sql = "INSERT INTO penertiban_sfr (`NAMA PENGGUNA`, DINAS, SUBSERVICE, LOKASI, `NOMER SPT`, `JENIS PELANGGARAN`, TINDAKAN, STATUS, `TGL OPERASI`, `NO ISR TELAH SETELAH PENINDAKAN`, `NO SURAT PENINDAKAN`, `TANGGAL TINDAKAN`, KETERANGAN) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssss", $namaPengguna, $dinas, $subservice, $lokasi, $nomerSPT, $jenisPelanggaran, $tindakan, $status, $tglOperasi, $noISRTelahSetelahPenindakan, $noSuratPenindakan, $tanggalTindakan, $keterangan);
    
    if ($stmt->execute()) {
        echo "Record baru berhasil ditambahkan";
        // Opsi untuk redirection setelah insert berhasil
        header("Location: index.php"); // Sesuaikan jika diperlukan
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>

<h2>Tambah Data Baru</h2>

<form id="addForm" method="post" action="create_data.php">
    Nama Pengguna: <input type="text" name="namaPengguna" required><br>
    Dinas: <input type="text" name="dinas" required><br>
    Subservice: <input type="text" name="subservice" required><br>
    Lokasi: <input type="text" name="lokasi" required><br>
    Nomer SPT: <input type="text" name="nomerSPT" required><br>
    Jenis Pelanggaran: <select name="jenisPelanggaran" required>
        <option value="ILEGAL">ILEGAL</option>
        <option value="LEGAL">LEGAL</option>
    </select><br>
    Tindakan: <input type="text" name="tindakan" required><br>
    Status: <input type="text" name="status" required><br>
    Tgl Operasi: <input type="date" name="tglOperasi" required><br>
    No ISR Setelah Penindakan: <input type="text" name="noISRSetelahPenindakan" required><br>
    No Surat Penindakan: <input type="text" name="noSuratPenindakan" required><br>
    Tanggal Tindakan: <input type="date" name="tanggalTindakan" required><br>
    Keterangan: <textarea name="keterangan" required></textarea><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
