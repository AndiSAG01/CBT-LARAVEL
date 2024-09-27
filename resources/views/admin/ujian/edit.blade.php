<x-admin>
    <x-pages.container>
        <x-pages.card>
            <div class="card" style="width: 300px">
                <div class="card-body bg-primary rounded">
                    <h5 class="font-serif font-semibold">Form Edit Peserta Ujian</h5>
                </div>
            </div>
            <form action="{{ route('ujian.update', [$ujian->id, $ujian->kategori_id, $ujian->jam_ujian]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" name="user_id" id="" value="{{ $user }}" hidden>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="my-input">Kelas</label>
                            <select name="kelas" class="form-control">
                                <option value="">===Pilih Kelas===</option>
                                <option value="TNI" {{ $ujian->kelas == 'TNI' ? 'selected' : '' }}>TNI</option>
                                <option value="Polri" {{ $ujian->kelas == 'Polri' ? 'selected' : '' }}>Polri</option>
                            </select>
                            @error('kelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Tanggal Ujian</label>
                            <input type="date" name="tanggal_ujian" class="form-control" value="{{ $ujian->tanggal_ujian }}" />
                            @error('tanggal_ujian')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Jam Ujian</label>
                            <input type="time" name="jam_ujian" class="form-control" value="{{ $ujian->jam_ujian }}" />
                            @error('jam_ujian')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="form-label">Durasi</label>
                            <input type="number" name="durasi" class="form-control" value="{{ $ujian->durasi }}" />
                            @error('durasi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Jenis Ujian</label>
                            <select name="category_id" class="form-control">
                                <option value="">===Pilih Jenis Ujian===</option>
                                @foreach ($jenis_ujian as $item)
                                    <option value="{{ $item->id }}" {{ $ujian->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Mata Pelajaran</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">===Pilih Mata Pelajaran===</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ $ujian->kategori_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <span class="text-danger">{{ $message }}</span>
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
                                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                                {{ $sw->name }}
                                            </p>
                                            <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
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
                                        value="{{ $sw->id }}" {{ in_array($sw->id, $ujian->siswa->pluck('id')->toArray()) ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-Tables.tabel>
                <div class="row mt-4">
                    <div class="col-sm-12 text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        
        </x-pages.card>
    </x-pages.container>
</x-admin>
