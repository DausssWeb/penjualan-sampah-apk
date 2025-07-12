@extends('layouts.mantis')

@section('content')
<div class="container mt-4">
    <div class="card-header">
        <h3 class="mb-1">Form Jual Sampah</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data" class="card shadow p-4">
            @csrf

            <!-- Error umum -->
            @if($errors->has('error'))
                <div class="alert alert-danger">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="jenis_sampah" class="form-label">Jenis Sampah</label>
                <select name="jenis_sampah" id="jenis_sampah" class="form-control @error('jenis_sampah') is-invalid @enderror">
                    <option value="">Pilih jenis sampah</option>
                    <option value="Plastik Botol" {{ old('jenis_sampah') == 'Plastik Botol' ? 'selected' : '' }}>Plastik Botol</option>
                    <option value="Kaleng" {{ old('jenis_sampah') == 'Kaleng' ? 'selected' : '' }}>Kaleng</option>
                    <option value="Kertas" {{ old('jenis_sampah') == 'Kertas' ? 'selected' : '' }}>Kertas</option>
                    <option value="Botol Kaca" {{ old('jenis_sampah') == 'Botol Kaca' ? 'selected' : '' }}>Botol Kaca</option>
                    <option value="Kardus" {{ old('jenis_sampah') == 'Kardus' ? 'selected' : '' }}>Kardus</option>
                    <option value="Logam" {{ old('jenis_sampah') == 'Logam' ? 'selected' : '' }}>Logam</option>
                </select>
                @error('jenis_sampah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>

            <div class="mb-3">
                <label for="berat" class="form-label">Berat (kg)</label>
                <input type="number" step="0.01" name="berat" id="berat" class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat') }}" placeholder="Masukkan berat sampah (kg)">
                @error('berat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto_sampah" class="form-label">Foto Sampah <span class="text-danger">*</span></label>
                
                <!-- Hidden input untuk menyimpan info file yang sudah dipilih -->
                <input type="hidden" name="foto_info" id="foto_info" value="{{ old('foto_info') }}">
                
                <!-- Custom file input wrapper -->
                <div class="file-input-wrapper">
                    <input type="file" name="foto_sampah" id="foto_sampah" class="form-control @error('foto_sampah') is-invalid @enderror" accept="image/*" required>
                    
                    <!-- Status file yang sudah dipilih sebelumnya -->
                    @if(old('foto_info'))
                        <div class="selected-file-info mt-2 p-2 bg-light border rounded">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-image text-success me-2"></i>
                                <span class="text-success">File sebelumnya: <strong>{{ old('foto_info') }}</strong></span>
                                <small class="text-muted ms-2">(Pilih file baru atau biarkan kosong untuk tetap menggunakan file ini)</small>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Status file yang baru dipilih -->
                    <div id="new-file-info" class="mt-2" style="display: none;">
                        <div class="d-flex align-items-center p-2 bg-success bg-opacity-10 border border-success rounded">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span class="text-success">File baru dipilih: <strong id="new-file-name"></strong></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-text">Format yang diizinkan: JPEG, PNG, JPG, GIF. Maksimal 5 MB.</div>
                
                <!-- Preview foto yang dipilih -->
                <div id="foto-preview" class="mt-2" style="display: none;">
                    <img id="preview-image" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                </div>
                
                @error('foto_sampah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukan Alamat Lengkap" maxlength="500">{{ old('alamat') }}</textarea>
                <div class="form-text">Maksimal 500 karakter</div>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="waktu_penjemputan" class="form-label">Waktu Penjemputan</label>
                <input type="datetime-local" name="waktu_penjemputan" id="waktu_penjemputan" class="form-control @error('waktu_penjemputan') is-invalid @enderror" value="{{ old('waktu_penjemputan') }}" min="{{ now()->format('Y-m-d\TH:i') }}" max="{{ now()->addYear()->format('Y-m-d\TH:i') }}">
                <div class="form-text">Pilih waktu penjemputan minimal 1 jam dari sekarang</div>
                @error('waktu_penjemputan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Ajukan</button>
        </form>
    </div>
</div>

<script>
// Set minimum datetime to current time + 1 hour
document.addEventListener('DOMContentLoaded', function() {
    const waktuInput = document.getElementById('waktu_penjemputan');
    const now = new Date();
    now.setHours(now.getHours() + 1); // Minimal 1 jam dari sekarang
    
    const formatted = now.toISOString().slice(0, 16);
    waktuInput.setAttribute('min', formatted);
});

// Handle foto selection dan preview
document.getElementById('foto_sampah').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('foto-preview');
    const previewImage = document.getElementById('preview-image');
    const newFileInfo = document.getElementById('new-file-info');
    const newFileName = document.getElementById('new-file-name');
    const fotoInfo = document.getElementById('foto_info');
    
    if (file) {
        // Update info file yang dipilih
        newFileName.textContent = file.name;
        newFileInfo.style.display = 'block';
        fotoInfo.value = file.name; // Simpan nama file untuk next request
        
        // Cek ukuran file
        if (file.size > 5 * 1024 * 1024) { // 5MB
            alert('Ukuran file terlalu besar! Maksimal 5MB.');
            e.target.value = '';
            newFileInfo.style.display = 'none';
            preview.style.display = 'none';
            fotoInfo.value = '';
            return;
        }
        
        // Cek tipe file
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung! Gunakan JPEG, PNG, JPG, atau GIF.');
            e.target.value = '';
            newFileInfo.style.display = 'none';
            preview.style.display = 'none';
            fotoInfo.value = '';
            return;
        }
        
        // Tampilkan preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        newFileInfo.style.display = 'none';
        preview.style.display = 'none';
        // Jangan kosongkan fotoInfo jika user cancel file selection
    }
});

// Client-side validation dengan visual feedback
function validateForm() {
    const jenisInput = document.getElementById('jenis_sampah');
    const beratInput = document.getElementById('berat');
    const fotoInput = document.getElementById('foto_sampah');
    const alamatInput = document.getElementById('alamat');
    const waktuInput = document.getElementById('waktu_penjemputan');
    const fotoInfo = document.getElementById('foto_info');
    
    let isValid = true;
    
    // Reset previous validation
    document.querySelectorAll('.form-control').forEach(input => {
        input.classList.remove('is-invalid');
        const feedback = input.parentElement.querySelector('.invalid-feedback');
        if (feedback) feedback.style.display = 'none';
    });
    
    // Validate jenis sampah
    if (!jenisInput.value.trim()) {
        jenisInput.classList.add('is-invalid');
        showError(jenisInput, 'Jenis sampah harus dipilih.');
        isValid = false;
    }
    
    // Validate berat
    if (!beratInput.value || parseFloat(beratInput.value) < 0.1) {
        beratInput.classList.add('is-invalid');
        showError(beratInput, 'Berat minimal 0.1 kg.');
        isValid = false;
    }
    
    // Validate foto - cek apakah ada file baru atau file lama
    if (!fotoInput.files.length && !fotoInfo.value) {
        fotoInput.classList.add('is-invalid');
        showError(fotoInput, 'Foto sampah harus diupload.');
        isValid = false;
    }
    
    // Validate alamat
    if (!alamatInput.value.trim()) {
        alamatInput.classList.add('is-invalid');
        showError(alamatInput, 'Alamat harus diisi.');
        isValid = false;
    }
    
    // Validate waktu
    if (!waktuInput.value) {
        waktuInput.classList.add('is-invalid');
        showError(waktuInput, 'Waktu penjemputan harus dipilih.');
        isValid = false;
    }
    
    return isValid;
}

function showError(input, message) {
    const feedback = input.parentElement.querySelector('.invalid-feedback');
    if (feedback) {
        feedback.textContent = message;
        feedback.style.display = 'block';
    }
}

// Validate on form submit
document.querySelector('form').addEventListener('submit', function(e) {
    if (!validateForm()) {
        e.preventDefault();
        // Scroll ke error pertama
        const firstError = document.querySelector('.is-invalid');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
});

// Real-time validation
document.getElementById('jenis_sampah').addEventListener('change', function() {
    if (this.value) {
        this.classList.remove('is-invalid');
        const feedback = this.parentElement.querySelector('.invalid-feedback');
        if (feedback) feedback.style.display = 'none';
    }
});

document.getElementById('berat').addEventListener('input', function() {
    if (this.value && parseFloat(this.value) >= 0.1) {
        this.classList.remove('is-invalid');
        const feedback = this.parentElement.querySelector('.invalid-feedback');
        if (feedback) feedback.style.display = 'none';
    }
});

document.getElementById('alamat').addEventListener('input', function() {
    if (this.value.trim()) {
        this.classList.remove('is-invalid');
        const feedback = this.parentElement.querySelector('.invalid-feedback');
        if (feedback) feedback.style.display = 'none';
    }
});

document.getElementById('waktu_penjemputan').addEventListener('change', function() {
    if (this.value) {
        this.classList.remove('is-invalid');
        const feedback = this.parentElement.querySelector('.invalid-feedback');
        if (feedback) feedback.style.display = 'none';
    }
});
</script>
@endsection