@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    .navbar {
        padding: 10px 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        background-color: white !important;
        border-bottom: none;
    }
    
    .navbar-brand img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #3b82f6;
        padding: 2px;
        background-color: white;
        transition: transform 0.3s ease;
    }
    
    .navbar-brand img:hover {
        transform: scale(1.05);
    }
    
    .page-title {
        font-size: 18px;
        font-weight: 600;
        padding: 8px 25px;
        border-radius: 30px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
        color: #3b82f6 !important;
        border: none !important;
        letter-spacing: 0.5px;
        transition: all 0.2s ease;
    }
    
    .page-title:hover {
        background-color: #eef2ff;
        transform: translateY(-1px);
    }
    
    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 6px 10px;
        border-radius: 50px;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
    }
    
    .user-profile:hover {
        background-color: #eef2ff;
    }
    
    .user-info {
        display: flex;
        flex-direction: column;
        text-align: right;
    }
    
    .user-name {
        font-weight: 600;
        color: #1f2937;
        font-size: 14px;
        line-height: 1.2;
    }
    
    .user-id {
        color: #6b7280;
        font-size: 12px;
        line-height: 1.2;
        position: relative;
        padding-top: 2px;
    }
    
    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #3b82f6;
        background-color: white;
    }
    
    @media (max-width: 768px) {
        .page-title {
            font-size: 16px;
            padding: 6px 15px;
        }
        
        .user-info {
            display: none;
        }
    }
</style>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="d-inline-block align-text-top">
        </a>

        <div class="mx-auto page-title">
            <i class="bi bi-house-door me-2"></i>Accueil
        </div>

        <div class="user-profile">
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name}} </span>
                <span class="user-id">{{ Auth::user()->id }}</span>
            </div>
            <img src="{{ asset('storage/images/profil.png') }}" alt="User" class="user-avatar">
        </div>
    </div>
</nav>