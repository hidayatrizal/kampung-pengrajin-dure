@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="text-sm text-stone-400 hover:text-terracotta-600 transition-colors inline-flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Produk
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-100 p-6 md:p-10">
        <h2 class="font-serif text-2xl text-stone-900 mb-8">Tambah Produk Baru</h2>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="craftsman_id" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Toko/UMKM</label>
                    <select name="craftsman_id" id="craftsman_id"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('craftsman_id') border-red-400 @enderror">
                        <option value="">-- Pilih Toko/UMKM --</option>
                        @foreach($craftsmen as $c)
                        <option value="{{ $c->id }}" {{ old('craftsman_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                    @error('craftsman_id')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="name" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('name') border-red-400 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="price" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Harga</label>
                    <input type="text" name="price" id="price" value="{{ old('price') }}" placeholder="Rp 450.000" required
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('price') border-red-400 @enderror">
                    @error('price')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="category" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Kategori</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}" placeholder="Dekorasi"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('category') border-red-400 @enderror">
                    @error('category')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="wa" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">No. WhatsApp</label>
                    <input type="text" name="wa" id="wa" value="{{ old('wa', '6281234567890') }}"
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('wa') border-red-400 @enderror">
                    @error('wa')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="image" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Gambar Utama Produk</label>
                    <div class="relative">
                        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" required
                            class="hidden" onchange="previewImage(this, 'preview-product')">
                        <label for="image" id="preview-product" class="block border-2 border-dashed border-stone-200 rounded-xl p-8 text-center cursor-pointer hover:border-terracotta-400 hover:bg-terracotta-50/30 transition-all">
                            <svg class="w-10 h-10 text-stone-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-sm text-stone-400">Klik untuk memilih gambar utama</p>
                            <p class="text-xs text-stone-300 mt-1">JPG, PNG, WebP (max 2MB)</p>
                        </label>
                    </div>
                    @error('image')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Gambar Tambahan</label>
                    <div class="relative">
                        <input type="file" name="additional_images[]" id="additional-images" accept="image/jpeg,image/png,image/webp" multiple
                            class="hidden" onchange="previewMultipleImages(this, 'preview-additional')">
                        <label for="additional-images" id="preview-additional" class="block border-2 border-dashed border-stone-200 rounded-xl p-6 text-center cursor-pointer hover:border-terracotta-400 hover:bg-terracotta-50/30 transition-all">
                            <svg class="w-8 h-8 text-stone-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-sm text-stone-400">Klik untuk menambahkan gambar lain</p>
                            <p class="text-xs text-stone-300 mt-1">Bisa pilih beberapa file sekaligus</p>
                        </label>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="5" required
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="submit" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-8 py-3.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 13 17 13"/></svg>
                    Simpan Produk
                </button>
                <a href="{{ route('admin.products.index') }}" class="border border-stone-200 text-stone-600 px-8 py-3.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] hover:bg-stone-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input, previewId) {
    var preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = '<img src="' + e.target.result + '" class="w-full max-h-64 object-contain rounded-xl">' +
                '<div class="mt-3 text-sm text-stone-500">' + input.files[0].name + '</div>' +
                '<button type="button" onclick="resetImage(\'' + input.id + '\', \'' + previewId + '\')" class="mt-2 text-xs text-red-500 hover:text-red-700">Hapus gambar</button>';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function previewMultipleImages(input, previewId) {
    var preview = document.getElementById(previewId);
    if (input.files && input.files.length > 0) {
        var html = '<div class="grid grid-cols-3 gap-3">';
        for (var i = 0; i < input.files.length; i++) {
            html += '<img src="" class="w-full h-24 object-cover rounded-lg border border-stone-200 additional-preview-img" data-index="' + i + '">';
        }
        html += '</div><p class="text-sm text-stone-500 mt-3">' + input.files.length + ' gambar dipilih</p>';
        preview.innerHTML = html;
        for (var i = 0; i < input.files.length; i++) {
            (function(index) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgs = preview.querySelectorAll('.additional-preview-img');
                    if (imgs[index]) imgs[index].src = e.target.result;
                };
                reader.readAsDataURL(input.files[index]);
            })(i);
        }
    }
}
function resetImage(inputId, previewId) {
    document.getElementById(inputId).value = '';
    var preview = document.getElementById(previewId);
    preview.innerHTML = '<svg class="w-10 h-10 text-stone-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>' +
        '<p class="text-sm text-stone-400">Klik untuk memilih gambar utama</p>' +
        '<p class="text-xs text-stone-300 mt-1">JPG, PNG, WebP (max 2MB)</p>';
}
</script>
@endpush