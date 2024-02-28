<?php
include 'db.php'; // Sertakan koneksi database

if(isset($_POST['idsfr'])) {
    $idsfr = $_POST['idsfr'];

    // Query untuk menghapus data
    $sql = "DELETE FROM penertiban_sfr WHERE idsfr = $idsfr";

    if ($conn->query($sql) === TRUE) {
        echo "Record berhasil dihapus";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
}
?>