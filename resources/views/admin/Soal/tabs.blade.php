<x-Pages.container>
    <div class="w-2/3" style="margin-left:15%">
        <div class="relative right-0">
            <ul class="relative flex flex-wrap p-1 list-none rounded-xl bg-blue-gray-50/60" data-tabs="tabs" role="list">
                <li class="z-30 flex-auto text-center">
                    <a href="{{ route('kategori.index') }}"
                       class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer {{ Route::currentRouteName() == 'kategori.index' ? 'bg-white shadow' : 'bg-inherit' }} text-slate-700"
                       data-tab-target="" role="tab" aria-selected="{{ Route::currentRouteName() == 'kategori.index' ? 'true' : 'false' }}" aria-controls="app">
                        <span class="ml-1"><i class="fas fa-server"> Kategori Soal</i></span>
                    </a>
                </li>
                <li class="z-30 flex-auto text-center">
                    <a href="{{ route('soal.index') }}"
                       class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer {{ Route::currentRouteName() == 'soal.index' ? 'bg-white shadow' : 'bg-inherit' }} text-slate-700"
                       data-tab-target="" role="tab" aria-selected="{{ Route::currentRouteName() == 'soal.index' ? 'true' : 'false' }}" aria-controls="message">
                        <span class="ml-1"><i class="far fa-newspaper"> Kelola Soal Ujian</i></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>    
</x-Pages.container>
