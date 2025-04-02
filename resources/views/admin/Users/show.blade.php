<!DOCTYPE html>
<html lang="fr">
<x-master>
    @section('main')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <style>
            :root {
                --primary: #4f46e5;
                --primary-hover: #4338ca;
                --secondary: #6b7280;
                --success: #059669;
                --warning: #f59e0b;
                --danger: #dc2626;
                --light: #f3f4f6;
                --dark: #1f2937;
                --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
            
            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                background-color: #f9fafb;
                color: #1f2937;
            }
            
            .page-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 2rem;
            }
            
            .card {
                background-color: white;
                border-radius: 0.5rem;
                box-shadow: var(--shadow);
                border: none;
                overflow: hidden;
            }
            
            .page-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid #e5e7eb;
            }
            
            .page-title {
                font-size: 1.875rem;
                font-weight: 700;
                color: var(--dark);
                margin: 0;
            }
            
            .search-container {
                position: relative;
                width: 100%;
                max-width: 400px;
                margin-bottom: 1.5rem;
            }
            
            .search-input {
                width: 100%;
                padding: 0.75rem 1rem 0.75rem 2.5rem;
                border: 1px solid #d1d5db;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                transition: all 0.2s;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            }
            
            .search-input:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            }
            
            .search-icon {
                position: absolute;
                left: 0.75rem;
                top: 50%;
                transform: translateY(-50%);
                color: var(--secondary);
            }
            
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: 500;
                border-radius: 0.375rem;
                padding: 0.5rem 1rem;
                transition: all 0.2s;
                border: none;
                cursor: pointer;
            }
            
            .btn-icon {
                margin-right: 0.5rem;
            }
            
            .btn-primary {
                background-color: var(--primary);
                color: white;
            }
            
            .btn-primary:hover {
                background-color: var(--primary-hover);
            }
            
            .btn-warning {
                background-color: var(--warning);
                color: white;
            }
            
            .btn-warning:hover {
                background-color: #d97706;
            }
            
            .btn-danger {
                background-color: var(--danger);
                color: white;
            }
            
            .btn-danger:hover {
                background-color: #b91c1c;
            }
            
            .table-container {
                overflow-x: auto;
                margin-top: 1rem;
            }
            
            .table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }
            
            .table th {
                background-color: #f9fafb;
                padding: 0.75rem 1.5rem;
                font-weight: 600;
                text-align: left;
                color: var(--secondary);
                font-size: 0.875rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                border-bottom: 1px solid #e5e7eb;
            }
            
            .table td {
                padding: 1rem 1.5rem;
                border-bottom: 1px solid #e5e7eb;
                vertical-align: middle;
            }
            
            .table tr:last-child td {
                border-bottom: none;
            }
            
            .table tr:hover {
                background-color: #f9fafb;
            }
            
            .action-btns {
                display: flex;
                gap: 0.5rem;
            }
            
            .add-btn {
                display: inline-flex;
                align-items: center;
                padding: 0.75rem 1.5rem;
                background-color: var(--primary);
                color: white;
                border-radius: 0.375rem;
                font-weight: 500;
                transition: all 0.2s;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            }
            
            .add-btn:hover {
                background-color: var(--primary-hover);
            }
            
            /* Status badge styling */
            .status-badge {
                display: inline-block;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 500;
            }

            .status-pending {
                background-color: #fef3c7;
                color: #92400e;
            }

            .status-complete {
                background-color: #dcfce7;
                color: #166534;
            }

            /* Additional Animation */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .table tbody tr {
                animation: fadeIn 0.3s ease-out forwards;
                animation-delay: calc(var(--row-index, 0) * 0.05s);
                opacity: 0;
            }
        </style>
    </head>
    <body>
        <div class="page-container">
            <div class="page-header">
                <h1 class="page-title">User Management</h1>
                <a href="{{ route('admin.users.create') }}" class="add-btn">
                    <i class="bi bi-plus-circle me-2"></i> Add New User
                </a>
            </div>
            
            <div class="card">
                <div class="p-4">
                    <div class="search-container">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search users...">
                    </div>
                    
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom et Prenom</th>
                                    <th>Email</th>
                                    <th>role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr style="--row-index: {{ $loop->index }}">
                                    <td class="font-medium">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="{{ route('admin.users.showResetForm', $user->id) }}" class="btn btn-warning">Reset Password</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="bi bi-trash me-1"></i> 
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            // Add some interactivity
            document.addEventListener('DOMContentLoaded', function() {
                // Animation for table rows
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach((row, index) => {
                    row.style.setProperty('--row-index', index);
                });
                
                // Search functionality
                const searchInput = document.querySelector('.search-input');
                searchInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        const name = row.querySelector('td:first-child').textContent.toLowerCase();
                        const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        
                        if (name.includes(query) || email.includes(query)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        </script>
    </body>
    @endsection
</x-master>
</html>