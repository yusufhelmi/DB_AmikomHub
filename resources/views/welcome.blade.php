@extends('layouts.app')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
    <div class="flex-1 space-y-8">
        <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1 Event Platform</span>
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
        </h1>
        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan Midtrans.
        </p>
        <div class="flex gap-4">
            <a href="#events" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                Mulai Jelajah
            </a>
            <a href="#" class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                Cara Pesan
            </a>
        </div>
    </div>
    <div class="flex-1 relative">
        <div class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <img src="assets/concert.png" alt="Concert" class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

        <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                    <p class="font-bold">Pembayaran Aman via Midtrans</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-sm font-black tracking-widest text-indigo-600 uppercase mb-3">Didukung Oleh</h2>
            <p class="text-3xl font-extrabold text-slate-900 sm:text-4xl">Partner Terbaik Kami</p>
            <p class="mt-4 text-lg text-slate-500 max-w-2xl mx-auto">
                Berkolaborasi dengan institusi dan perusahaan terkemuka untuk menyajikan pengalaman event yang tak terlupakan.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-4 justify-center items-center">
            @forelse($partners as $partner)
            <div class="col-span-1 flex justify-center items-center h-32 p-6 bg-white rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:border-indigo-100 hover:-translate-y-2 transition-all duration-300 group cursor-pointer">
                <img src="{{ $partner->logo_url }}" alt="Logo {{ $partner->name }}" class="max-h-full max-w-full object-contain filter grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-105">
            </div>
            @empty
            <div class="col-span-full flex justify-center py-8">
                <p class="text-slate-500 font-medium bg-white px-8 py-4 rounded-2xl shadow-sm border border-slate-100">Belum ada data partner yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<section id="events" class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
            <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="/" class="px-5 py-3 {{ !request()->has('category') ? 'bg-indigo-600 text-white shadow-md' : 'border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 hover:shadow-sm' }} rounded-xl transition font-bold text-sm">
                Semua Kategori
            </a>
            @foreach($categories as $cat)
            <a href="/?category={{ $cat->slug }}" class="px-5 py-3 {{ request('category') == $cat->slug ? 'bg-indigo-600 text-white shadow-md' : 'bg-indigo-50 text-indigo-700 hover:bg-indigo-100' }} rounded-xl font-bold text-sm transition">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="relative overflow-hidden aspect-[3/4]">
                <img src="{{ $event->poster_path ? asset('storage/' . $event->poster_path) : 'https://placehold.co/400x500?text=No+Image' }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600 shadow-sm">
                    {{ $event->category->name ?? 'Umum' }}
                </div>
            </div>

            <div class="p-6 flex flex-col flex-1">
                <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition line-clamp-2">{{ $event->title }}</h3>
                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}</span>
                </div>

                <div class="mt-auto pt-4 border-t border-slate-100 flex justify-between items-center">
                    <span class="text-2xl font-black text-indigo-600">
                        {{ $event->price == 0 ? 'Gratis' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                    </span>
                    <a href="{{ url('event/' . $event->id) }}" class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Event</h3>
            <p class="text-slate-500">Tidak ada acara yang ditemukan untuk kategori ini.</p>
        </div>
        @endforelse
    </div>
</section>

@endsection