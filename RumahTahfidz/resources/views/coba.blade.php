<form action="/coba" method="post" enctype="multipart/form-data">
    <div>
        <input type="file" name="image" id="image">
    </div>
    <div>
        <button type="submit">Simpan</button>
    </div>
</form>

@foreach ($coba as $c)
<img src="{{ url() . '/' . $c->gambar }}" width="100">
@endforeach
