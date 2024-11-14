<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Penjualan</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Data Penjualan</h1>

    <form id="penjualan-form">
        <input type="text" id="produk" placeholder="Produk" required>
        <input type="number" id="jumlah" placeholder="Jumlah" required>
        <input type="number" id="harga" placeholder="Harga" required>
        <button type="submit">Tambah Penjualan</button>
    </form>

    <table id="penjualan-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        $(document).ready(function () {
            // Fungsi untuk load data penjualan
            function loadPenjualan() {
                $.get('/penjualan', function (data) {
                    console.log(data);  // Periksa struktur data yang diterima
                    if (Array.isArray(data)) {
                        $('#penjualan-table tbody').empty();
                        data.forEach(function (penjualan) {
                            const harga = parseFloat(penjualan.harga);  // Mengonversi harga ke angka
                            const total = parseFloat(penjualan.total);  // Mengonversi total ke angka
                            $('#penjualan-table tbody').append(`
                                <tr data-id="${penjualan.id}">
                                    <td>${penjualan.produk}</td>
                                    <td>${penjualan.jumlah}</td>
                                    <td>${harga.toLocaleString()}</td> <!-- Format harga dengan ribuan separator -->
                                    <td>${total.toLocaleString()}</td> <!-- Format total dengan ribuan separator -->
                                    <td>
                                        <button class="edit-btn">Edit</button>
                                        <button class="delete-btn">Hapus</button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        console.error('Data yang diterima bukan array:', data);
                    }
                });
            }

            // Load data penjualan saat halaman pertama kali dibuka
            loadPenjualan();

            // Fungsi untuk tambah data penjualan
            $('#penjualan-form').submit(function (e) {
                e.preventDefault();

                const data = {
                    produk: $('#produk').val(),
                    jumlah: $('#jumlah').val(),
                    harga: $('#harga').val(),
                    total: $('#jumlah').val() * $('#harga').val(),
                };

                $.post('/penjualan', data, function () {
                    loadPenjualan(); // Memuat ulang data penjualan
                    $('#produk').val(''); // Mengosongkan input
                    $('#jumlah').val('');
                    $('#harga').val('');
                });
            });

            // Fungsi untuk hapus data penjualan
            $(document).on('click', '.delete-btn', function () {
                const id = $(this).closest('tr').data('id');
                $.ajax({
                    url: `/penjualan/${id}`,
                    type: 'DELETE',
                    success: function () {
                        loadPenjualan(); // Memuat ulang data setelah penghapusan
                    }
                });
            });
        });
    </script>
</body>
</html>
