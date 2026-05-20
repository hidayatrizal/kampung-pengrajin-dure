@extends('admin.layouts.app')

@section('title', 'Edit Toko/UMKM')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.craftsmen.index') }}" class="text-sm text-stone-400 hover:text-terracotta-600 transition-colors inline-flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Toko/UMKM
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-100 p-6 md:p-10">
        <h2 class="font-serif text-2xl text-stone-900 mb-8">Edit Toko/UMKM</h2>

        <form method="POST" action="{{ route('admin.craftsmen.update', $craftsman) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Nama Toko/UMKM</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $craftsman->name) }}" required
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('name') border-red-400 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="wa" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">No. WhatsApp</label>
                    <input type="text" name="wa" id="wa" value="{{ old('wa', $craftsman->wa) }}"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('wa') border-red-400 @enderror">
                    @error('wa')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="capacity" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Kapasitas Produksi / Bulan</label>
                    <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $craftsman->capacity) }}" min="0"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('capacity') border-red-400 @enderror">
                    @error('capacity')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="price" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Harga Satuan / Range</label>
                    <input type="text" name="price" id="price" value="{{ old('price', $craftsman->price) }}"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('price') border-red-400 @enderror">
                    @error('price')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Foto Pemilik/Pengrajin</label>
                    <div class="relative">
                        @if($craftsman->image)
                        <div id="current-image" class="mb-3">
                            <img src="{{ Storage::url($craftsman->image) }}" alt="{{ $craftsman->name }}" class="w-24 h-24 object-cover rounded-xl border border-stone-200">
                            <p class="text-xs text-stone-400 mt-1.5">Foto saat ini</p>
                        </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="previewImage(this, 'preview-craftsman')">
                        <label for="image" id="preview-craftsman" class="block border-2 border-dashed border-stone-200 rounded-xl p-6 text-center cursor-pointer hover:border-terracotta-400 hover:bg-terracotta-50/30 transition-all">
                            <svg class="w-8 h-8 text-stone-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-sm text-stone-400">Klik untuk ganti foto</p>
                            <p class="text-xs text-stone-300 mt-1">Kosongkan jika tidak ingin mengubah</p>
                        </label>
                    </div>
                    @error('image')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="address" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="2"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('address') border-red-400 @enderror">{{ old('address', $craftsman->address) }}</textarea>
                    @error('address')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="latitude" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $craftsman->latitude) }}"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('latitude') border-red-400 @enderror">
                    @error('latitude')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="longitude" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $craftsman->longitude) }}"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('longitude') border-red-400 @enderror">
                    @error('longitude')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">
                        Pilih Lokasi di Peta
                        <span class="text-stone-400 font-normal normal-case tracking-normal ml-1">(klik pada peta untuk mengisi latitude & longitude)</span>
                    </label>
                    <div id="map-picker" class="w-full h-64 md:h-80 rounded-xl border border-stone-200 z-0"></div>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Deskripsi Toko</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('description') border-red-400 @enderror">{{ old('description', $craftsman->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="submit" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-8 py-3.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 13 17 13"/></svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.craftsmen.index') }}" class="border border-stone-200 text-stone-600 px-8 py-3.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] hover:bg-stone-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
function previewImage(input, previewId) {
    var preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var currentImage = document.getElementById('current-image');
            if (currentImage) currentImage.style.display = 'none';
            preview.innerHTML = '<img src="' + e.target.result + '" class="w-full max-h-64 object-contain rounded-xl">' +
                '<div class="mt-3 text-sm text-stone-500">' + input.files[0].name + '</div>' +
                '<button type="button" onclick="resetImage(\'image\', \'' + previewId + '\')" class="mt-2 text-xs text-red-500 hover:text-red-700">Hapus gambar</button>';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function resetImage(inputId, previewId) {
    document.getElementById(inputId).value = '';
    var preview = document.getElementById(previewId);
    var currentImage = document.getElementById('current-image');
    if (currentImage) currentImage.style.display = 'block';
    preview.innerHTML = '<svg class="w-8 h-8 text-stone-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>' +
        '<p class="text-sm text-stone-400">Klik untuk ganti foto</p>' +
        '<p class="text-xs text-stone-300 mt-1">Kosongkan jika tidak ingin mengubah</p>';
}

var defaultLat = -7.5755;
var defaultLng = 110.8243;
var latInput = document.getElementById('latitude');
var lngInput = document.getElementById('longitude');

var initialLat = latInput.value ? parseFloat(latInput.value) : defaultLat;
var initialLng = lngInput.value ? parseFloat(lngInput.value) : defaultLng;

var map = L.map('map-picker').setView([initialLat, initialLng], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

var marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

if (latInput.value && lngInput.value) {
    marker.setLatLng([initialLat, initialLng]);
    map.setView([initialLat, initialLng], 15);
}

map.on('click', function(e) {
    marker.setLatLng(e.latlng);
    latInput.value = e.latlng.lat.toFixed(7);
    lngInput.value = e.latlng.lng.toFixed(7);
});

marker.on('dragend', function(e) {
    var pos = e.target.getLatLng();
    latInput.value = pos.lat.toFixed(7);
    lngInput.value = pos.lng.toFixed(7);
});

latInput.addEventListener('change', function() {
    var lat = parseFloat(this.value);
    var lng = parseFloat(lngInput.value) || defaultLng;
    if (!isNaN(lat)) {
        marker.setLatLng([lat, lng]);
        map.setView([lat, lng], 15);
    }
});
lngInput.addEventListener('change', function() {
    var lng = parseFloat(this.value);
    var lat = parseFloat(latInput.value) || defaultLat;
    if (!isNaN(lng)) {
        marker.setLatLng([lat, lng]);
        map.setView([lat, lng], 15);
    }
});
</script>
@endpush