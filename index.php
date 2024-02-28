<!DOCTYPE html>
<html>
<head>
    <title>DataTables AJAX demo</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- FixedColumns CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>

<a href="create_data.php" class="btn btn-primary">Tambah Data Baru</a>


<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Id SFR</th>
            <th>Nama Pengguna</th>
            <th>Dinas</th>
            <th>Subservice</th>
            <th>Lokasi</th>
            <th>Nomer SPT</th>
            <th>Jenis Pelanggaran</th>
            <th>Tindakan</th>
            <th>Status</th>
            <th>Tgl Operasi</th>
            <th>No ISR Setelah Penindakan</th>
            <th>No Surat Penindakan</th>
            <th>Tanggal Tindakan</th>
            <th>Keterangan</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>

<!-- Modal untuk Update (Bootstrap) -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update Data -->
                <form id="updateForm">
                    <input type="hidden" name="idsfr" id="update-idsfr">
                    Nama Pengguna: <input type="text" name="namaPengguna" id="update-namaPengguna"><br>
                    Dinas: <input type="text" name="dinas" id="update-dinas"><br>
                    Subservice: <input type="text" name="subservice" id="update-subservice"><br>
                    Lokasi: <input type="text" name="lokasi" id="update-lokasi"><br>
                    Nomer SPT: <input type="text" name="nomerSPT" id="update-nomerSPT"><br>
                    Jenis Pelanggaran: <select name="jenisPelanggaran" id="update-jenisPelanggaran">
                        <option value="ILEGAL">ILEGAL</option>
                        <option value="LEGAL">LEGAL</option>
                    </select><br>
                    Tindakan: <input type="text" name="tindakan" id="update-tindakan"><br>
                    Status: <input type="text" name="status" id="update-status"><br>
                    Tgl Operasi: <input type="date" name="tglOperasi" id="update-tglOperasi"><br>
                    No ISR Setelah Penindakan: <input type="text" name="noISRSetelahPenindakan" id="update-noISRSetelahPenindakan"><br>
                    No Surat Penindakan: <input type="text" name="noSuratPenindakan" id="update-noSuratPenindakan"><br>
                    Tanggal Tindakan: <input type="date" name="tanggalTindakan" id="update-tanggalTindakan"><br>
                    Keterangan: <textarea name="keterangan" id="update-keterangan"></textarea><br>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<!-- FixedColumns JS -->
<script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#example').DataTable({
        "ajax": "read_data.php",
        "scrollCollapse": true,
        "scrollX": true, 
        "fixedColumns":{
            leftColumns : 2,
            rightColumns : 1
        },
        "columns": [
            { "data": "idsfr" },
            { "data": "NAMA PENGGUNA" },
            { "data": "DINAS" },
            { "data": "SUBSERVICE" },
            { "data": "LOKASI" },
            { "data": "NOMER SPT" },
            { "data": "JENIS PELANGGARAN" },
            { "data": "TINDAKAN" },
            { "data": "STATUS" },
            { "data": "TGL OPERASI" },
            { "data": "NO ISR TELAH SETELAH PENINDAKAN" },
            { "data": "NO SURAT PENINDAKAN" },
            { "data": "TANGGAL TINDAKAN" },
            { "data": "KETERANGAN" },
            {
                "data": null,
                "defaultContent": "<button class='btn btn-primary btn-sm btn-update'>Update</button> <button class='btn btn-danger btn-sm btn-delete'>Delete</button>"
            }
        ]
    });

    $('#example tbody').on('click', '.btn-delete', function() {
        var data = table.row($(this).parents('tr')).data();
        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                type: "POST",
                url: "delete_data.php",
                data: { idsfr: data.idsfr },
                success: function(response) {
                    alert("Record deleted successfully");
                    table.ajax.reload();
                }
            });
        }
    });

    $('#example tbody').on('click', '.btn-update', function() {
        var data = table.row($(this).parents('tr')).data();
        $('#update-idsfr').val(data.idsfr);
        $('#update-namaPengguna').val(data['NAMA PENGGUNA']);
        $('#update-dinas').val(data.DINAS);
        $('#update-subservice').val(data.SUBSERVICE);
        $('#update-lokasi').val(data.LOKASI);
        $('#update-nomerSPT').val(data['NOMER SPT']);
        $('#update-jenisPelanggaran').val(data['JENIS PELANGGARAN']);
        $('#update-tindakan').val(data.TINDAKAN);
        $('#update-status').val(data.STATUS);
        $('#update-tglOperasi').val(data['TGL OPERASI']);
        $('#update-noISRSetelahPenindakan').val(data['NO ISR TELAH SETELAH PENINDAKAN']);
        $('#update-noSuratPenindakan').val(data['NO SURAT PENINDAKAN']);
        $('#update-tanggalTindakan').val(data['TANGGAL TINDAKAN']);
        $('#update-keterangan').val(data.KETERANGAN);
        $('#updateModal').modal('show');
    });

    $('#addForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "create_data.php",
            data: formData,
            success: function(response) {
                alert("Record added successfully");
                $('#addForm')[0].reset();
                table.ajax.reload();
            }
        });
    });

    $('#updateForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "update_data.php",
            data: formData,
            success: function(response) {
                alert("Record updated successfully");
                $('#updateModal').modal('hide');
                table.ajax.reload();
            }
        });
    });
});
</script>
</body>
</html>
