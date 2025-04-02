@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    :root {
        --primary-color: #4f46e5;
        --sidebar-width: 270px;
        --header-height: 70px;
        --transition-speed: 0.3s;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
        margin: 0;
        font-family: 'Inter', sans-serif;
        background-color: #f9fafb;
        color: #1f2937;
    }

    header {
        width: 100%;
        height: var(--header-height);
        background-color: white;
        box-shadow: var(--shadow);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        transition: all var(--transition-speed) ease;
    }

    .main-layout {
        display: flex;
        flex-grow: 1;
    }

    .side_bar {
        position: fixed;
        top: var(--header-height);
        left: 0;
        width: var(--sidebar-width);
        height: calc(100vh - var(--header-height));
        background-color: white;
        box-shadow: var(--shadow);
        z-index: 1020;
        transition: all var(--transition-speed) ease;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .side_bar::-webkit-scrollbar {
        width: 4px;
    }

    .side_bar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .side_bar::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    main {
        margin-top: var(--header-height);
        margin-left: var(--sidebar-width);
        flex-grow: 1;
        padding: 2rem;
        background-color: #f9fafb;
        transition: all var(--transition-speed) ease;
        min-height: calc(100vh - var(--header-height));
    }

    .container {
        background-color: white;
        border-radius: 8px;
        box-shadow: var(--shadow);
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .flashbag {
        position: fixed;
        top: calc(var(--header-height) + 1rem);
        right: 1rem;
        z-index: 2000;
        max-width: 350px;
    }

    /* Media queries for responsive design */
    @media (max-width: 768px) {
        :root {
            --sidebar-width: 0px;
        }

        .side_bar {
            transform: translateX(-100%);
        }

        .side_bar.active {
            transform: translateX(0);
            width: 250px;
        }

        main {
            margin-left: 0;
            padding: 1rem;
        }

        .menu-toggle {
            display: block;
        }
    }
</style>

<header>
    @include('partials.nav')
</header>

<div class="main-layout">
    <div class="flashbag">
        @include('partials.flashbag')
    </div>

    <aside class="side_bar">
        @if (Auth::check() && Auth::user()->role == 'admin')
            @include('partials.sidebar')
        @elseif(Auth::check() && Auth::user()->role == 'fonctionnaire')
            @include('partials.sidebar-fonctionnaire')
        @elseif(Auth::check() && Auth::user()->role == 'contable')
            @include('partials.sidebar-comptable')
        @endif
    </aside>

    <main>
        <div class="container">
            @yield('main')
        </div>
    </main>
</div>

<script>
    // Add mobile toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.side_bar');

        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    });
</script>
