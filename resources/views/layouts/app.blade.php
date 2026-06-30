<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    @include('sweetalert::alert')
    <div class="wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Igreja Gestão</h2>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="{{route('dashboard')}}" class="nav-link active"><i class="fas fa-chart-line"></i> Dashboard</a>
                    </li>

                    <li class="dropdown-item">
                        <button class="dropdown-btn"><i class="fas fa-users"></i> Membros <i class="fas fa-caret-down arrow"></i></button>
                        <ul class="dropdown-container">
                            <li><a href="#"><i class="fas fa-user-plus"></i> Registar Membro</a></li>
                            <li><a href="{{route('membro.index')}}"><i class="fas fa-search"></i> Consultar / Listar</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-item">
                        <button class="dropdown-btn"><i class="fas fa-hand-holding-usd"></i> Finanças <i class="fas fa-caret-down arrow"></i></button>
                        <ul class="dropdown-container">
                            <li><a href="#"><i class="fas fa-coins"></i> Dízimos</a></li>
                            <li><a href="#"><i class="fas fa-heart"></i> Ofertas</a></li>
                            <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> Relatórios</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-item">
                        <button class="dropdown-btn"><i class="fas fa-calendar-alt"></i> Eventos <i class="fas fa-caret-down arrow"></i></button>
                        <ul class="dropdown-container">
                            <li><a href="#"><i class="fas fa-church"></i> Cultos</a></li>
                            <li><a href="#"><i class="fas fa-key"></i> Aluguer de Salas</a></li>
                            <li><a href="#"><i class="fas fa-book-open"></i> Estudos Bíblicos</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-item">
                        <button class="dropdown-btn"><i class="fas fa-user-shield"></i> Utilizadores <i class="fas fa-caret-down arrow"></i></button>
                        <ul class="dropdown-container">
                            <li><a href="{{route('usuario.index')}}"><i class="fas fa-user-cog"></i> Gerir Perfis</a></li>
                            <li><a href="#"><i class="fas fa-history"></i> Logs do Sistema</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div class="toggle-btn"><i class="fas fa-bars"></i></div>
                <div class="user-profile">
                    <span>Olá,</span>
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                               
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Definição') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Sair') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <i class="fas fa-user-circle user-icon"></i>
                </div>
            </header>

            <section class="content-body">

                <div class="page-header-actions">
                    @yield('header')
                </div>

                @yield('contente')
                <!-- Page Content   livewire('navigation-menu') -->

                {{ $slot }}

            </section>


        </main>

    </div>

    @stack('modals')

    @livewireScripts
    <script src="{{asset('assets/js/style.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>