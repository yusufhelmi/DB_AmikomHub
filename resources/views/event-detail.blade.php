@extends('layouts.app')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="mb-8">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-indigo-600 font-bold hover:text-indigo-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Beranda
        </button>
    </div>

    <div class="flex flex-col lg:flex-row gap-12 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
        
        <div class="flex-1 max-w-md mx-auto lg:mx-0 w-full">
            <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                ? asset('storage/' . $event->poster_path)
                : 'https://placehold.co/400x500?text=No+Image' }}" 
                alt="{{ $event->title }}" 
                class="w-full rounded-[2rem] shadow-2xl object-cover aspect-[3/4] border-4 border-slate-50">
        </div>

        <div class="flex-1 flex flex-col justify-between space-y-6">
            <div class="space-y-4">
                <span class="inline-block px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-black uppercase tracking-wider">
                    {{ $event->category->name ?? 'Umum' }}
                </span>
                
                <h1 class="text-3xl md:text-4xl font-black text-slate-800 leading-tight">
                    {{ $event->title }}
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-5 rounded-2xl border border-slate-100/50">
                    <div class="flex items-center gap-3 text-slate-600">
                        <div class="p-2 bg-white rounded-xl shadow-sm text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="text-sm">
                            <p class="text-xs text-slate-400 font-bold uppercase">Tanggal & Waktu</p>
                            <p class="font-bold">{{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 text-slate-600">
                        <div class="p-2 bg-white rounded-xl shadow-sm text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="text-sm">
                            <p class="text-xs text-slate-400 font-bold uppercase">Lokasi Tempat</p>
                            <p class="font-bold line-clamp-1">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <h3 class="text-sm font-bold uppercase text-slate-400 tracking-wide mb-2">Deskripsi Acara</h3>
                    <p class="text-slate-600 leading-relaxed font-medium bg-slate-50/50 p-5 rounded-2xl border border-slate-100 whitespace-pre-line">
                        {{ $event->description ?? 'Tidak ada deskripsi untuk acara ini.' }}
                    </p>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <p class="text-xs text-slate-400 font-bold uppercase mb-1">Harga Tiket</p>
                    <p class="text-3xl font-black text-indigo-600">
                        {{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-rose-500 font-bold mt-1 bg-rose-50 px-2 py-0.5 rounded-md inline-block">
                        Sisa Stok: {{ $event->stock }} Tiket lagi!
                    </p>
                </div>
                
                <a href="{{ url('checkout/' . $event->id) }}" class="w-full sm:w-auto text-center px-8 py-4 bg-indigo-600 text-white font-black text-lg rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition whitespace-nowrap">
                    Pesan Sekarang
                </a>
            </div>
        </div>

    </div>
</main>
@endsection