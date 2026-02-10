<div class="d-flex gap-2 mt-3">
    <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin data mau disimpan?')">
        Simpan
    </button>

    <a href="{{ $cancelRoute }}" class="btn btn-secondary" onclick="return confirm('Yakin ingin membatalkan perubahan?')">
        Batal
    </a>
</div>