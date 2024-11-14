<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD Penjualan</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Data Penjualan</h1>

    <!-- Form untuk tambah penjualan -->
    <form id="penjualan-form">
        <input type="hidden" id="penjualan-id"> <!-- Untuk menyimpan ID saat edit -->
        <input type="text" id="produk" placeholder="Produk" required>
        <input type="number" id="jumlah" placeholder="Jumlah" required>
        <input type="number" id="harga" placeholder="Harga" required>
        <button type="submit" id="submit-btn">Tambah Penjualan</button>
    </form>

    <!-- Tabel untuk menampilkan data penjualan -->
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
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Fungsi untuk load data penjualan
            function loadPenjualan() {
                $.get('/penjualan', function (data) {
                    console.log(data); // Debugging
                    if (Array.isArray(data)) {
                        $('#penjualan-table tbody').empty();
                        data.forEach(function (penjualan) {
                            const harga = parseFloat(penjualan.harga);  // Konversi harga ke angka
                            const total = parseFloat(penjualan.total);  // Konversi total ke angka
                            $('#penjualan-table tbody').append(`
                                <tr data-id="${penjualan.id}">
                                    <td>${penjualan.produk}</td>
                                    <td>${penjualan.jumlah}</td>
                                    <td>${harga.toLocaleString()}</td> <!-- Format harga dengan separator ribuan -->
                                    <td>${total.toLocaleString()}</td> <!-- Format total dengan separator ribuan -->
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

            // Fungsi untuk tambah atau edit data penjualan
            $('#penjualan-form').submit(function (e) {
                e.preventDefault();

                const data = {
                    produk: $('#produk').val(),
                    jumlah: $('#jumlah').val(),
                    harga: $('#harga').val(),
                    total: $('#jumlah').val() * $('#harga').val(),
                };

                const id = $('#penjualan-id').val(); // Ambil ID jika sedang edit

                if (id) {
                    // Mengirim permintaan PUT untuk mengupdate data
                    $.ajax({
                        url: `/penjualan/${id}`,
                        type: 'PUT',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function () {
                            loadPenjualan(); // Memuat ulang data penjualan
                            $('#penjualan-id').val(''); // Kosongkan ID
                            $('#produk').val(''); // Mengosongkan input
                            $('#jumlah').val('');
                            $('#harga').val('');
                            $('#submit-btn').text('Tambah Penjualan'); // Ganti tombol kembali
                        }
                    });
                } else {
                    // Mengirim permintaan POST untuk menambah data baru
                    $.post({
                        url: '/penjualan',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function () {
                            loadPenjualan(); // Memuat ulang data penjualan
                            $('#produk').val(''); // Mengosongkan input
                            $('#jumlah').val('');
                            $('#harga').val('');
                        }
                    });
                }
            });

            // Fungsi untuk hapus data penjualan
            $(document).on('click', '.delete-btn', function () {
                const id = $(this).closest('tr').data('id');
                $.ajax({
                    url: `/penjualan/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function () {
                        loadPenjualan(); // Memuat ulang data setelah penghapusan
                    }
                });
            });

            // Fungsi untuk edit data penjualan
            $(document).on('click', '.edit-btn', function () {
                const id = $(this).closest('tr').data('id');
                $.get(`/penjualan/${id}`, function (penjualan) {
                    $('#penjualan-id').val(penjualan.id); // Set ID untuk edit
                    $('#produk').val(penjualan.produk); // Set produk
                    $('#jumlah').val(penjualan.jumlah); // Set jumlah
                    $('#harga').val(penjualan.harga); // Set harga
                    $('#submit-btn').text('Perbarui Penjualan'); // Ganti teks tombol menjadi "Perbarui"
                });
            });
        });
    </script>
</body>
</html>
