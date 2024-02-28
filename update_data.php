<?php
include 'db.php'; // Sertakan koneksi database

if(isset($_POST['idsfr'])) {
    $idsfr = $_POST['idsfr'];
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

    // Query untuk update data
    $sql = "UPDATE penertiban_sfr SET `NAMA PENGGUNA`=?, DINAS=?, SUBSERVICE=?, LOKASI=?, `NOMER SPT`=?, `JENIS PELANGGARAN`=?, TINDAKAN=?, STATUS=?, `TGL OPERASI`=?, `NO ISR TELAH SETELAH PENINDAKAN`=?, `NO SURAT PENINDAKAN`=?, `TANGGAL TINDAKAN`=?, KETERANGAN=? WHERE idsfr=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssi", $namaPengguna, $dinas, $subservice, $lokasi, $nomerSPT, $jenisPelanggaran, $tindakan, $status, $tglOperasi, $noISRTelahSetelahPenindakan, $noSuratPenindakan, $tanggalTindakan, $keterangan, $idsfr);

    if ($stmt->execute()) {
        echo "Record berhasil diupdate";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
