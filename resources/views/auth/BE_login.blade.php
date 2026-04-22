@extends('frontend.layout.app')
@section('title', 'Login | Layanan Pengaduan SMKN Taruna Bhakti')
@section('content')
<section class="w-full h-screen px-8  py-20 bg-gray-100 xl:px-8">
    <div class="max-w-5xl mt-20  mx-auto">
        <div class="flex flex-col items-center md:flex-row">
            <div class="w-full space-y-5 md:w-3/5 md:pr-16">
                <h3
                    class="text-2xl text-center md:text-left  font-extrabold leading-none text-black sm:text-3xl md:text-5xl">
                    Tanggapan Anda adalah langkah awal kita untuk Maju
                </h3>
                <p class="text-md text-gray-600 text-center md:text-left md:pr-16">Laporkan kepada kami jika ada
                    Pengaduan atau pun Aspirasi yang dapat menjadi langkah awal untuk kita menjadi lebih baik lagi</p>
            </div>
            <div class="w-full mt-10 md:mt-0 md:w-2/5">
                <div
                    class="relative z-10 h-auto p-8 py-10 overflow-hidden bg-white border-b-2 border-gray-300 rounded-lg shadow-2xl px-7">
                    <h3 class="mb-6 text-2xl font-medium text-center">Login Pengaduan <br> <strong>SMK 
                        Taruna Bhakti </strong>
                    </h3>
                    <form action="{{ route('proses.login') }}" method="post">
                        @csrf
                        @if (session('error'))
                        <div class="container mx-auto">
                            <div class="w-full my-4 rounded-md bg-red-500 text-white">
                                <div class="flex justify-between items-center container mx-auto py-4 px-6">
                                    <div class="flex">
                                        <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                                            <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"></path>
                                        </svg>

                                        <p class="mx-3">{{ session('error') }}</</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (session('status'))     
                        <div class="w-full my-4 rounded-md bg-green-500 text-white">
                            <div class="flex justify-between items-center container mx-auto py-4 px-6">
                                <div class="flex">
                                    <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"></path>
                                    </svg>
                    
                                    <p class="mx-3">{{ session('status') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <input type="text" name="email" id="email"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                placeholder="Masukkan Email Anda">
                        </div>
                        <div class="block mb-4 border border-gray-200 rounded-lg">
                            <input type="password" name="password" id="password"
                                class="block w-full px-4 py-3 border-2 border-transparent rounded-lg focus:border-blue-500 focus:outline-none"
                                placeholder="Masukkan Password Anda">
                        </div>
                        <div class="block">
                            <button
                                class="w-full px-3 py-4 font-medium font-semibold font-medium text-white bg-blue-600 rounded-lg">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

