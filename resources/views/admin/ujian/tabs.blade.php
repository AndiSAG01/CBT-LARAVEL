<x-Pages.container>
    <div class="w-2/3" style="margin-left:15%">
        <div class="relative right-0">
            <ul class="relative flex flex-wrap p-1 list-none rounded-xl bg-blue-gray-50/60" data-tabs="tabs" role="list">
                <li class="z-30 flex-auto text-center">
                    <a href="{{ route('CategoryExam.index') }}"
                       class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer {{ Route::currentRouteName() == 'CategoryExam.index' ? 'bg-white shadow' : 'bg-inherit' }} text-slate-700"
                       data-tab-target="" role="tab" aria-selected="{{ Route::currentRouteName() == 'CategoryExam.index' ? 'true' : 'false' }}" aria-controls="app">
                        <span class="ml-1"><i class="fas fa-server"> Jenis Ujian</i></span>
                    </a>
                </li>
                <li class="z-30 flex-auto text-center">
                    <a href="{{ route('ujian.index') }}"
                       class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer {{ Route::currentRouteName() == 'ujian.index' ? 'bg-white shadow' : 'bg-inherit' }} text-slate-700"
                       data-tab-target="" role="tab" aria-selected="{{ Route::currentRouteName() == 'ujian.index' ? 'true' : 'false' }}" aria-controls="message">
                        <span class="ml-1"><i class="far fa-newspaper"> Kelola Peserta Ujian</i></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>    
</x-Pages.container>
