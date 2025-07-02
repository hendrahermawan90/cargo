@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-user-plus me-2"></i>Tambah Pelanggan Baru
                        </h5>
                        <a href="{{ route('customers.index') }}" class="btn btn-sm btn-light">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <h6 class="fw-bold mb-2">Terjadi kesalahan:</h6>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('customers.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 pe-md-4 border-end">
                                <h6 class="fw-bold text-primary mb-3 pb-2">
                                    <i class="fas fa-user-circle me-2"></i>Informasi Pribadi
                                </h6>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                                    <div class="invalid-feedback">Harap isi nama pelanggan</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                                    <div class="invalid-feedback">Harap isi email yang valid</div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telepon/HP</label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="Status" class="form-select" id="status">
                                        <option value="1" {{ old('Status') == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('Status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 ps-md-4">
                                <h6 class="fw-bold text-primary mb-3 pb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                </h6>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap</label>
                                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}" placeholder="Contoh: Jl. Sudirman No. 123, Jakarta">
                                </div>

                                <div class="mt-4">
                                    <label class="form-label">Peta Lokasi</label>
                                    <div class="border rounded overflow-hidden bg-light" style="height: 300px;">
                                        <iframe
                                            id="map_address"
                                            width="100%"
                                            height="100%"
                                            style="border:0; min-height: 300px;"
                                            loading="lazy"
                                            allowfullscreen
                                            referrerpolicy="no-referrer-when-downgrade"
                                            src="https://maps.google.com/maps?q=Indonesia&output=embed">
                                        </iframe>
                                    </div>
                                    <small class="text-muted">Peta akan menyesuaikan otomatis saat alamat diketik</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                    <button type="reset" class="btn btn-outline-secondary">
                                        <i class="fas fa-undo me-1"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Script untuk peta otomatis --}}
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const addressInput = document.getElementById("address");
                            const mapIframe = document.getElementById("map_address");

                            let debounceTimer;

                            addressInput.addEventListener("input", function () {
                                clearTimeout(debounceTimer);
                                debounceTimer = setTimeout(() => {
                                    const address = addressInput.value.trim();
                                    if (address.length > 3) {
                                        const encoded = encodeURIComponent(address);
                                        mapIframe.src = `https://maps.google.com/maps?q=${encoded}&output=embed`;
                                    }
                                }, 400);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
