  <option value="" selected disabled>--Pilih Kategori--</option>
  @foreach ($category as $c)
      <option value="{{ $c->id }}">{{ $c->name }}</option>
  @endforeach
  {{-- <option value="newcategory">Tambah kategori baru</option> --}}
