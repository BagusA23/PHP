<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klaim Hadiah</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-5">Pilih Hadiah Anda</h1>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Reward Card 1 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img 
                        src="./assets/img/dana.jpg" 
                        class="card-img-top" 
                        alt="Smartwatch Mewah"
                    >
                    <div class="card-body">
                        <h5 class="card-title">Saldo Dana 10.000</h5>
                        <p class="card-text text-muted">Kumpulkan Poin Dan tukarkan Poinnya Dengan Saldo Dana</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">500 Poin</span>
                            <button 
                                class="btn btn-primary" 
                                onclick="claimReward('Smartwatch Mewah', 1000)"
                            >
                                <i class="bi bi-gift me-2"></i>Klaim Hadiah
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reward Card 2 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img 
                        src="./assets/img/dana.jpg" 
                        class="card-img-top" 
                        alt="Wireless Earbuds"
                    >
                    <div class="card-body">
                        <h5 class="card-title">Saldo Dana 20.000</h5>
                        <p class="card-text text-muted">Kumpulkan Poin Dan tukarkan Poinnya Dengan Saldo Dana</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">1000 Poin</span>
                            <button 
                                class="btn btn-primary" 
                                onclick="claimReward('Wireless Earbuds', 750)"
                            >
                                <i class="bi bi-gift me-2"></i>Klaim Hadiah
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reward Card 3 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img 
                        src="./assets/img/dana.jpg" 
                        class="card-img-top" 
                        alt="Kamera Digital"
                    >
                    <div class="card-body">
                        <h5 class="card-title">Saldo Dana 50.000</h5>
                        <p class="card-text text-muted">Kumpulkan Poin Dan tukarkan Poinnya Dengan Saldo Dana</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">2500 Poin</span>
                            <button 
                                class="btn btn-primary" 
                                onclick="claimReward('Kamera Digital', 1500)"
                            >
                                <i class="bi bi-gift me-2"></i>Klaim Hadiah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Klaim -->
        <div class="modal fade" id="claimModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Klaim Hadiah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p id="claimMessage" class="mb-3"></p>
                        <form id="claimForm">
                            <div class="mb-3">
                                <label class="form-label">Nama Dana anda</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    required
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Dana Anda</label>
                                <input 
                                    type="tel" 
                                    class="form-control" 
                                    required
                                >
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button 
                            type="button" 
                            class="btn btn-secondary" 
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>
                        <button 
                            type="button" 
                            class="btn btn-primary"
                            onclick="konfirmasiKlaim()"
                        >
                            Konfirmasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Status Laporan -->
    <section class="mb-5">
            <h2 class="mb-4">Status Reward</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Reward</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#12345</td>
                            <td>2024-03-20</td>
                            <td>Jl. Contoh No. 123</td>
                            <td><span class="badge bg-warning">Dalam Proses</span></td>
                            <td><button class="btn btn-sm btn-info">Detail</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Riwayat Laporan -->
        <section class="mb-5">
            <h2 class="mb-4">Riwayat Laporan</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Laporan</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#12344</td>
                            <td>2024-03-15</td>
                            <td>Jl. Sample No. 456</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td>2024-03-18</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://kit.fontawesome.com/YOUR-KIT-ID.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inisialisasi modal Bootstrap
        const claimModal = new bootstrap.Modal(document.getElementById('claimModal'));

        function claimReward(namaHadiah, poinDibutuhkan) {
            const pesanKlaim = document.getElementById('claimMessage');
            
            pesanKlaim.innerHTML = `Anda akan mengklaim hadiah <strong>${namaHadiah}</strong> dengan ${poinDibutuhkan} poin. Silakan lengkapi detail di bawah.`;
            
            claimModal.show();
        }

        function konfirmasiKlaim() {
            // Tambahkan logika validasi dan pengiriman data di sini
            alert('Proses klaim hadiah akan dilakukan');
            claimModal.hide();
        }
    </script>
</body>
</html>