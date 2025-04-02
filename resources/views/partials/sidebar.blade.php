@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    :root {
        --primary-color: #e48e1e;
        --primary-hover: #d37d0d;
        --background-color: #f5f5f5;
        --text-color: #333;
        --shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        --transition: all 0.3s ease;
    }
    
    .sidebar-container {
        background-color: var(--background-color);
        border-radius: 12px;
        box-shadow: var(--shadow);
        border: none;
        height: 100vh;
        position: fixed;
        width: 280px;
        padding: 20px 15px;
    }
    
    .sidebar-logo {
        text-align: center;
        padding: 20px 0;
        margin-bottom: 30px;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .sidebar-menu {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .menu-item {
        background-color: var(--primary-color);
        color: white;
        border-radius: 10px;
        padding: 14px 20px;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
        border: none;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }
    
    .menu-item:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .menu-item i {
        margin-right: 10px;
        font-size: 18px;
    }
    
    .logout-btn {
        background-color: #dc3545;
        color: white;
        border-radius: 10px;
        padding: 14px 20px;
        font-weight: 500;
        text-align: center;
        transition: var(--transition);
        border: none;
        margin-top: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }
    
    .logout-btn:hover {
        background-color: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .main-content {
        margin-left: 300px;
        padding: 20px;
    }
</style>

<body>
<div class="d-flex">
    <!-- Improved Sidebar -->
    <div class="sidebar-container">
        <div class="sidebar-logo">
            <h3>{{ Auth::user()->role }} Panel</h3>
            <p class="text-muted">Welcome back, {{ Auth::user()->role }}</p>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{route('admin.dashboard')}}" class="menu-item">
                <i class="fa fa-home"></i> Accueil
            </a>
            <a href="{{ route('admin.rapport.show') }}" class="menu-item">
                <i class="fa fa-chart-bar"></i> Rapports
            </a>
            {{-- <a href="#" class="menu-item">
                <i class="fa fa-archive"></i> Archive
            </a> --}}
            <a href="{{ route('admin.users.show') }}" class="menu-item">
                <i class="fa fa-users"></i> Gestion Fonctionnaire
            </a>
            <a href="{{ route('admin.statistics') }}" class="menu-item">
                <i class="fa fa-chart-pie"></i> Statistiques
            </a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn" >
                <i class="fa fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
       
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Your page content goes here -->
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>