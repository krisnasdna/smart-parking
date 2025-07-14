<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Slot Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container-xl mt-5 text-center">
        <h3>Informasi Slot Parkir</h3>
        <div class="row mt-5">
            @foreach ($slots as $slot)  
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title">Slot : {{ $slot->slot_id }}</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Status:</strong> 
                                @if($slot->status == '0')
                                    <span class="badge bg-success">Kosong</span>
                                @else
                                    <span class="badge bg-danger">Terisi</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
