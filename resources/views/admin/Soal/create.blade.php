<x-admin>
    <x-pages.container>
        <x-pages.card>
            <div class="card" style="width: 200px">
                <div class="card-body bg-primary rounded">
                    <h5 class="font-serif font-semibold">Form Soal Baru</h5>
                </div>
            </div>
            <form action="{{ route('soal.store') }}" method="post" class="text-black" enctype="multipart/form-data">
                @csrf
                <input type="number" name="code" id="code" hidden>
                <input type="text" name="user_id" value="{{ $user }}" hidden>
                <div class="form-group">
                    <label for="kategori_id">Kategori Soal</label>
                    <select name="kategori_id" id="kategori_id" class="form-control">
                        <option value="">===PILIH KATEGORI SOAL===</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="soal_ujian">Soal Ujian</label>
                    <textarea name="soal_ujian" id="editor" cols="30" rows="10"></textarea>
                    @error('soal_ujian')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_A">Jawaban A</label>
                    <textarea name="kunci_A" id="A" cols="30" rows="10"></textarea>
                    @error('kunci_A')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_B">Jawaban B</label>
                    <textarea name="kunci_B" id="B" cols="30" rows="10"></textarea>
                    @error('kunci_B')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_C">Jawaban C</label>
                    <textarea name="kunci_C"" id="C" cols="30" rows="10"></textarea>
                    @error('kunci_C')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_D">Jawaban D</label>
                    <textarea name="kunci_D" id="D" cols="30" rows="10"></textarea>
                    @error('kunci_D')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_E">Jawaban E</label>
                    <textarea name="kunci_E" id="E" cols="30" rows="10"></textarea>
                    @error('kunci_E')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_jawaban">Kunci Jawaban</label>
                    <select name="kunci_jawaban" id="kunci_jawaban" class="form-control">
                        <option value="">===Pilih Kunci Jawban===</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                    @error('kunci_jawaban')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary rounded-none">Submit</button>
            </form>

        </x-pages.card>
    </x-pages.container>
    @include('admin.Soal.ckeditor')
    @include('admin.Soal.ckeditor_jawaban')
</x-admin>
