<x-admin>
    <x-pages.container>
        <x-pages.card>
            <div class="card" style="width: 200px">
                <div class="card-body bg-primary rounded">
                    <h5 class="font-serif font-semibold">Form Edit Soal</h5>
                </div>
            </div>
            <form action="{{ route('soal.update', $soal->id) }}" method="post" class="text-black"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="number" name="code" id="code" value="{{ $soal->code }}" hidden>
                <input type="text" name="user_id" id="code" value="{{ $user }}" hidden>
                <div class="form-group">
                    <label for="kategori_id">Kategori Soal</label>
                    <select name="kategori_id" id="kategori_id" class="form-control">
                        <option value="">===PILIH KATEGORI SOAL===</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" @if ($soal->kategori_id == $item->id) selected @endif>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="soal_ujian">Soal Ujian</label>
                    <textarea name="soal_ujian" id="editor" cols="30" rows="10">{{ $soal->soal_ujian }}</textarea>
                    @error('soal_ujian')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_A">Jawaban A</label>
                    <input id="kunci_A" class="form-control" type="text" name="kunci_A"
                        value="{{ $soal->kunci_A }}">
                    @error('kunci_A')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_B">Jawaban B</label>
                    <input id="kunci_B" class="form-control" type="text" name="kunci_B"
                        value="{{ $soal->kunci_B }}">
                    @error('kunci_B')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_C">Jawaban C</label>
                    <input id="kunci_C" class="form-control" type="text" name="kunci_C"
                        value="{{ $soal->kunci_C }}">
                    @error('kunci_C')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_D">Jawaban D</label>
                    <input id="kunci_D" class="form-control" type="text" name="kunci_D"
                        value="{{ $soal->kunci_D }}">
                    @error('kunci_D')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_E">Jawaban E</label>
                    <input id="kunci_E" class="form-control" type="text" name="kunci_E"
                        value="{{ $soal->kunci_E }}">
                    @error('kunci_E')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kunci_jawaban">Kunci Jawaban</label>
                    <select name="kunci_jawaban" id="kunci_jawaban" class="form-control">
                        <option value="">===Pilih Kunci Jawaban===</option>
                        <option value="A" @if ($soal->kunci_jawaban == 'A') selected @endif>A</option>
                        <option value="B" @if ($soal->kunci_jawaban == 'B') selected @endif>B</option>
                        <option value="C" @if ($soal->kunci_jawaban == 'C') selected @endif>C</option>
                        <option value="D" @if ($soal->kunci_jawaban == 'D') selected @endif>D</option>
                        <option value="E" @if ($soal->kunci_jawaban == 'E') selected @endif>E</option>
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
</x-admin>
