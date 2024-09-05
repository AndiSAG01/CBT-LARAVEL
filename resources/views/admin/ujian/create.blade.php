<x-admin>
    <x-pages.container>
        <x-pages.card>
            <div class="card" style="width: 300px">
                <div class="card-body bg-primary rounded">
                    <h5 class="font-serif font-semibold">Form Kelola Peserta Ujian</h5>
                </div>
            </div>
            <form action="{{ route('ujian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="user_id" id="" value="{{ $user }}" hidden>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="my-input">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas" class="form-control">
                                <option value="">===Pilih Kelas===</option>
                                <option value="TNI">TNI</option>
                                <option value="Polri">Polri</option>
                            </select>
                            @error('kelas')
                                <span class="text-danger">*Field Tidak Boleh Kosong</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Tanggal Ujian <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_ujian" id="" class="form-control"
                                placeholder="" aria-describedby="helpId" />
                            @error('tanggal_ujian')
                                <span class="text-danger">*Field Tidak Boleh Kosong</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Jam Ujian <span class="text-danger">*</span></label>
                            <input type="time" name="jam_ujian" id="" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                            @error('jam_ujian')
                                <span class="text-danger">*Field Tidak Boleh Kosong</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label">Durasi <span class="text-danger">*</span></label>
                            <input type="number" name="durasi" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                            @error('durasi')
                                <span class="text-danger">*Field Tidak Boleh Kosong</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Jenis Ujian <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control">
                                <option value="">===Pilih Jenis Ujian===</option>
                                @foreach ($jenis_ujian as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">*Field Tidak Boleh Kosong</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori_id" class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                            <select name="kategori_id" class="form-control">
                                <option value="">===Pilih Jenis Ujian===</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <span class="text-danger">*Field Tidak Boleh Kosong</span>
                            @enderror
                        </div>                        
                    </div>
                </div>
               
                <x-Tables.tabel>
                    <thead>
                        <tr>
                            <x-Tables.th>
                                Member
                            </x-Tables.th>
                            <x-Tables.th>
                                Kelas
                            </x-Tables.th>
                            <x-Tables.th>
                                Nomor Handphone
                            </x-Tables.th>
                            <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $sw)
                            <tr>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ Storage::url($sw->image) }}" alt="Guru Image"
                                            class="relative inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                        <div class="flex flex-col">
                                            <p
                                                class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                                {{ $sw->name }}
                                            </p>
                                            <p
                                                class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
                                                {{ $sw->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <x-Tables.td>
                                    {{ $sw->class }}
                                </x-Tables.td>
                                <x-Tables.td>
                                    {{ $sw->number_phone }}
                                </x-Tables.td>
                                <td class="p-4 border-b border-blue-gray-50">
                                    <input type="checkbox" class="pilihSiswa" name="siswa_id[]"
                                        value="{{ $sw->id }}">
                                </td>
                            </tr>
                        @endforeach
                        @error('siswa_id')
                        <span class="text-danger font-semibold">*Pilih Salah Satu Siswa</span>
                    @enderror
                    </tbody>
                </x-Tables.tabel>
                <div class="row mt-4">
                    <div class="col-sm-12 text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </x-pages.card>
    </x-pages.container>
</x-admin>
