@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <!-- Card untuk Form Registrasi -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <div class="card mt-5">
            <div class="card-header bg-primary text-white">
                <h3>Register Card</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.store_card') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nim">NIM:</label>
                        <input type="text" id="nim" name="nim" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="prodi">Program Studi:</label>
                        <input type="text" id="prodi" name="prodi" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tgl_lahir">Tanggal Lahir:</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" required>
                    </div>

                    <!-- Card ID dengan tombol Scan Card di sampingnya -->
                    <div class="container align-middle">
                        <div class="row align-items-end">
                            <div class="col-sm-8"> 
                                <label for="card_id">Card ID:</label>
                                <input type="text" id="card_id" name="card_id" class="form-control" readonly>
                            </div>
                            <div class="col-sm-4"><button type="button" id="scanCardButton" class="btn btn-primary">Scan Card</button></div>
                          </div>  
                    </div>                    

                    <br><br>
                    <button type="submit" class="btn btn-success">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ketika tombol Scan Card diklik
        $('#scanCardButton').on('click', function () {
            // Tampilkan pesan loading
            alert('Changing to registration mode...');

            // Kirim permintaan untuk mengubah mode menjadi registrasi
            $.post('http://192.168.0.106/set_mode', { mode: 'registration' }, function (response) {
                if (response.status === 'success') {
                    alert('Registration mode activated. Scanning card...');

                    // Setelah mode berhasil diubah, kirim permintaan untuk memindai kartu
                    $.get('http://192.168.0.106/get_card_id', function (data) {  // Ganti dengan IP ESP32 kamu
                        if (data.card_id) {
                            $('#card_id').val(data.card_id); // Isi form dengan ID kartu
                            alert('Card scanned successfully!');
                        } else {
                            alert('Failed to scan card.');
                        }
                    }).fail(function () {
                        alert('Failed to communicate with the scanner.');
                    });
                } else {
                    alert('Failed to change mode to registration');
                }
            }).fail(function () {
                alert('Failed to change mode');
            });
        });
    </script>
@endsection
