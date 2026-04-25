<!DOCTYPE html>
<html lang="en" id="#home">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="sistem pengaduan SMKN 2 Karanganyar adalah sistem yang digununakan untuk menyampaikan aspirasi atau pengaduan kepada pihak sekolah secara online">
    <meta author="SakaDev">
    <title>@yield('title')</title>
<meta name="subject" content="Website Layanan Pengaduan SMK TARUNA BHAKTI">
    <meta name="google-site-verification" content="eA5vWNqCfogT0bO_jGCuJrUwkt1bzfvbYUGlRguZWY" />
    <meta name="language" content="Indonesia">
    <meta name="robots" content="index,follow" />
    <meta name="Classification" content="Layanan">
    <meta name="author" content="Sabil Eka Muhmmad">
    <meta name="developer" content="Sabil Eka Muhmmad">
    <meta name="owner" content="SMK TARUNA BHAKTI">
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <meta name='copyright' content='SMK TARUNA BHAKTI | XII RPL 3 | 2026' />
    <link rel="stylesheet" href="{{asset('assets/app.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/fontawesome/all.min.css') }}">
</head>

<body>
    <div id="app">
        <!-- header -->
        <section class="w-full px-6 z-50 fixed antialiased bg-white select-none">
            <div class="mx-auto max-w-7xl">
                <nav class="relative z-50 h-24 " x-data="{ showMenu: false }">
                    <div
                        class="container  relative flex flex-wrap items-center justify-between h-24 mx-auto font-medium border-b border-gray-200 lg:justify-center sm:px-4 md:px-2">
                        <a href="{{url('/')}}" class="inline-block py-2 pr-4 md:py-0">
                            <span class="text-xl font-black leading-none text-gray-900 select-none logo">
                                <img src="{{asset('assets/index.png')}}" alt="Logo" class="w-10 md:w-12 h-auto">
                            </span>
                        </a>
                        <div class="top-0 left-0 items-start hidden w-full h-full p-4 text-sm bg-gray-900 bg-opacity-50 md:w-3/4 md:absolute lg:text-base md:h-auto md:bg-transparent md:p-0 md:relative md:flex"
                            :class="{'flex fixed': showMenu, 'hidden': !showMenu }">
                            <div
                                class="flex-col w-full h-auto overflow-hidden bg-white rounded-lg select-none md:bg-transparent md:rounded-none md:relative md:flex md:flex-row md:overflow-auto">
                                <a href="{{url('/')}}"
                                    class="inline-flex items-center block w-auto h-16 px-6 text-xl font-black leading-none text-gray-900 select-none md:hidden">SMK 
                                    TARUNA BHAKTI<span class="text-indigo-600">.</span></a>
                                <div
                                    class="flex flex-col items-start justify-center w-full text-center md:w-2/3 md:mt-0 md:flex-row md:items-center">
                                    <a href="{{url('/')}}"
                                        class="inline-block w-full px-6 py-2 mx-0 font-medium text-left text-indigo-600 md:w-auto md:px-0 md:mx-2 lg:mx-3 md:text-center">Beranda</a>
                                    <a href="{{url('/'. '#about')}}"
                                        class="inline-block w-full px-6 py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-indigo-600 lg:mx-3 md:text-center">Tentang</a>
                                    <a href="{{url('/'. '#flow')}}"
                                        class="inline-block w-full px-6 py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-indigo-600 lg:mx-3 md:text-center">Alur
                                        Pengaduan</a>
                                    <a href="{{url('/' . '#faq')}}"
                                        class="inline-block w-full px-6 py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-indigo-600 lg:mx-3 md:text-center">FAQ</a>
                                    @auth
                                    <a href="{{route('pengaduan.check')}}"
                                        class="inline-block w-full px-6 py-2 mx-0 font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-indigo-600 lg:mx-3 md:text-center">Cari
                                        Pengaduan</a>
                                    @endauth
                                </div>
                                <div
                                    class="flex flex-col items-start justify-end w-full pt-4 md:items-center md:w-1/3 md:flex-row md:py-0">
                                    <span class="inline-flex w-full shadow-sm md:rounded-full md:w-auto">
                                        @guest
                                        <a href="{{url('/login')}}"
                                            class="inline-flex items-center w-full mx-2 px-6 py-3 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out bg-transparent bg-indigo-600 border border-transparent md:px-3 md:w-auto md:rounded-md lg:px-5 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">Login</a>
                                        @endguest
                                        @auth
                                        <a href="{{url('site/buat-pengaduan')}}"
                                            class="inline-flex items-center w-full px-6 py-3 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out bg-transparent bg-indigo-600 border border-transparent md:px-3 md:w-auto md:rounded-md lg:px-5 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">Buat
                                            Pengaduan</a>
                                        <form action="{{url('/logout')}}" method="post">
                                            @csrf
                                            <button type="sumbit"
                                                class="inline-flex items-center w-full px-6 py-3 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out bg-transparent bg-indigo-600 border border-transparent md:px-3 md:w-auto md:rounded-md lg:px-5 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 mx-2">
                                                Logout</button>
                                        </form>
                                        @endauth
                                        @guest
                                        <a href="{{url('site/cek-pengaduan')}}"
                                            class="inline-flex items-center w-full px-6 py-3 text-sm font-medium leading-4 text-white transition duration-150 ease-in-out bg-transparent bg-indigo-600 border border-transparent md:px-3 md:w-auto md:rounded-md lg:px-5 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">
                                            Cek Pengaduan</a>
                                        @endguest
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div @click="showMenu = !showMenu"
                            class="absolute right-0 flex flex-col items-center items-end justify-center w-10 h-10 rounded-full cursor-pointer md:hidden hover:bg-gray-100">
                            <svg class="w-6 h-6 text-gray-700" x-show="!showMenu" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"
                                x-cloak>
                                <path d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg class="w-6 h-6 text-gray-700" x-show="showMenu" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" x-cloak>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </nav>
            </div>
        </section>

        <!-- end header -->
        @yield('content')
        <!-- footer -->
        <footer class="bg-white">
            <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
                <p class="mt-8 text-base leading-6 text-center text-gray-400">
                    &copy; <?= date('Y') ?> Copyright
                    - Develop by SAKADEV
                </p>
            </div>
        </footer>
        <!-- end footer -->
    </div>
<!DOCTYPE html>
<html lang="en" id="home">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('assets/app.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/vendors/fontawesome/all.min.css') }}">
</head>

<body>
<div id="app">

    <!-- HEADER -->
    <section class="w-full px-6 z-50 fixed bg-white">
        <div class="mx-auto max-w-7xl">
            <nav class="relative h-24" x-data="{ showMenu: false }">
                <div class="flex items-center justify-between h-24 border-b">

                    <a href="{{url('/')}}">
                        <img src="{{asset('assets/index.png')}}" class="w-10">
                    </a>

                    <div class="hidden md:flex space-x-4">
                        <a href="/">Beranda</a>
                        <a href="/#about">Tentang</a>
                        <a href="/#faq">FAQ</a>
                    </div>

                    <div>
                        @guest
                            <a href="/login" class="bg-indigo-600 text-white px-4 py-2">Login</a>
                        @endguest

                        @auth
                            <a href="/site/buat-pengaduan" class="bg-indigo-600 text-white px-4 py-2">
                                Buat Pengaduan
                            </a>
                        @endauth
                    </div>

                </div>
            </nav>
        </div>
    </section>

 <!-- 🔥 CHAT BUTTON -->
<div onclick="toggleChat()" style="
    position:fixed;
    bottom:20px;
    right:20px;
    background:#4f46e5;
    color:white;
    padding:14px;
    border-radius:50%;
    cursor:pointer;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
    z-index:999;
">
    💬
</div>

<!-- 🔥 CHAT BOX -->
<div id="chatBox" style="
    display:none;
    position:fixed;
    bottom:80px;
    right:20px;
    width:300px;
    background:white;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    overflow:hidden;
    font-family:sans-serif;
    z-index:999;
">

    <!-- HEADER -->
    <div style="
        background:#4f46e5;
        color:white;
        padding:10px;
        font-weight:bold;
    ">
        AI CUSTOMER SERVICE
    </div>

    <!-- CHAT -->
    <div id="messages" style="
        height:250px;
        overflow-y:auto;
        padding:10px;
        background:#f9fafb;
    "></div>

    <!-- INPUT -->
    <div style="display:flex; border-top:1px solid #eee;">
        <input id="msg" placeholder="Tulis pesan..."
            style="flex:1; border:none; padding:10px; outline:none;"
        >
        <button onclick="sendMsg()" style="
            background:#4f46e5;
            color:white;
            border:none;
            padding:0 15px;
            cursor:pointer;
        ">
            ➤
        </button>
    </div>

</div>

<script>
let firstOpen = true;

// toggle chat
function toggleChat(){
    let box = document.getElementById('chatBox');
    let isHidden = box.style.display === 'none';

    box.style.display = isHidden ? 'block' : 'none';

    // greeting pertama
    if (isHidden && firstOpen) {
        addMsg('Well well well. AI ini mau bantu apa untuk pengaduan anda?', 'bot');
        firstOpen = false;
    }
}

// tambah pesan
function addMsg(text, type){
    let wrap = document.getElementById('messages');
    let el = document.createElement('div');

    el.style.display = 'flex';
    el.style.margin = '8px 0';
    el.style.justifyContent = type === 'user' ? 'flex-end' : 'flex-start';

    el.innerHTML = `
        <div style="
            max-width:70%;
            padding:8px 10px;
            border-radius:10px;
            font-size:13px;
            background:${type==='user' ? '#4f46e5' : '#e5e7eb'};
            color:${type==='user' ? 'white' : 'black'};
            white-space:pre-line;
        ">
            ${text}
        </div>
    `;

    wrap.appendChild(el);
    wrap.scrollTop = wrap.scrollHeight;
}

// kirim pesan
function sendMsg(){
    let input = document.getElementById('msg');
    let text = input.value.trim();

    if(!text) return;

    addMsg(text,'user');
    input.value='';

    // loading
    let wrap = document.getElementById('messages');
    let loading = document.createElement('div');
    loading.id = 'loading';
    loading.style.margin = '8px 0';
    loading.innerHTML = `<span style="background:#e5e7eb;padding:8px;border-radius:8px;">...</span>`;
    wrap.appendChild(loading);

    fetch('/site/chat/send',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
        },
        body:JSON.stringify({message:text})
    })
    .then(async res=>{
        let data = await res.json();

        document.getElementById('loading')?.remove();

        if(!res.ok){
            addMsg('Error: ' + data.response, 'bot');
            return;
        }

        addMsg(data.response,'bot');
    })
    .catch(()=>{
        document.getElementById('loading')?.remove();
        addMsg('Server error ⚠️', 'bot');
    });
}

// enter kirim
document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("msg").addEventListener("keypress", function(e){
        if(e.key === "Enter"){
            sendMsg();
        }
    });
});
</script>
<!-- END CHAT BOT -->


    <!-- CONTENT -->
    <div style="margin-top:100px;">
        @yield('content')
    </div>
    <!-- FOOTER -->
    <footer class="bg-white text-center py-10">
        &copy; <?= date('Y') ?> - SAKADEV
    </footer>

</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.0/alpine.js"></script>
</body>

</html>
