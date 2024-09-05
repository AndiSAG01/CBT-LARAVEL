<x-admin>
    <div class="container-fluid mt-3">
        
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white font-serif">Pengajar <i class="fas fa-user-tie"></i> </h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">Jumlah : {{ $guru }}</h2>
                        </div>
                        <span class="float-right display-5 "><i class="fas fa-user-tie"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white font-serif">Siswa/Siswi <i class="fas fa-user-graduate"></i></h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">Jumlah : {{ $siswa }}</h2>
                        </div>
                        <span class="float-right display-5 "><i class="fas fa-user-graduate"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-8">
                <div class="container">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="flex items-center gap-4">
                            <label for="year">Pilih Tahun:</label>
                            <select name="year" id="year" class="form-control" style="width: 40%">
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                    <div>
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
</x-admin>
