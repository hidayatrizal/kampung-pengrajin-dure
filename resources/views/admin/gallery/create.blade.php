@extends('admin.layouts.app')

@section('title', 'Tambah Foto Galeri')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.gallery.index') }}" class="text-sm text-stone-400 hover:text-terracotta-600 transition-colors inline-flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Galeri
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-100 p-6 md:p-10">
        <h2 class="font-serif text-2xl text-stone-900 mb-8">Tambah Foto Galeri Baru</h2>

        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Judul Foto</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('title') border-red-400 @enderror">
                    @error('title')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="category" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Kategori</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}" required
                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3.5 text-sm text-stone-900 placeholder:text-stone-400 outline-none focus:border-terracotta-500 focus:ring-2 focus:ring-terracotta-500/10 transition-all @error('category') border-red-400 @enderror">
                    @error('category')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="url" class="text-[11px] uppercase tracking-[0.2em] text-stone-500 font-semibold block mb-2">Gambar</label>
                    <div class="relative">
                        <input type="file" name="url" id="url" accept="image/jpeg,image/png,image/webp" required
                            class="hidden" onchange="previewImage(this, 'preview-gallery')">
                        <label for="url" id="preview-gallery" class="block border-2 border-dashed border-stone-200 rounded-xl p-8 text-center cursor-pointer hover:border-terracotta-400 hover:bg-terracotta-50/30 transition-all">
                            <svg class="w-10 h-10 text-stone-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            <p class="text-sm text-stone-400">Klik untuk memilih gambar</p>
                            <p class="text-xs text-stone-300 mt-1">JPG, PNG, WebP (max 2MB)</p>
                        </label>
                    </div>
                    @error('url')<p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="submit" class="bg-terracotta-500 hover:bg-terracotta-600 text-white px-8 py-3.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 13 17 13"/></svg>
                    Simpan Foto
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="border border-stone-200 text-stone-600 px-8 py-3.5 rounded-xl text-[11px] font-semibold uppercase tracking-[0.15em] hover:bg-stone-50 transition-all">
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
function resetImage(inputId, previewId) {
    document.getElementById(inputId).value = '';
    var preview = document.getElementById(previewId);
    preview.innerHTML = '<svg class="w-10 h-10 text-stone-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>' +
        '<p class="text-sm text-stone-400">Klik untuk memilih gambar</p>' +
        '<p class="text-xs text-stone-300 mt-1">JPG, PNG, WebP (max 2MB)</p>';
}
</script>
@endpush