<x-master>
    @section('main')
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Your existing styles remain the same */
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #344767;
            border-bottom: 1px solid #e9ecef;
            padding: 12px 15px;
        }
        
        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-color: #e9ecef;
        }
        
        .table tr:hover {
            background-color: #f8f9fa;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .badge-pending {
            background-color: #fff7e0;
            color: #ff9800;
        }
        
        .badge-completed {
            background-color: #e8f5e9;
            color: #4caf50;
        }
        
        .badge-attend {
            background-color: #fff8e1;
            color: #ffa000;
        }
        
        .date-range {
            display: flex;
            flex-direction: column;
            font-size: 0.875rem;
        }
        
        .date-label {
            font-weight: 500;
            color: #6c757d;
        }
        
        .date-value {
            color: #344767;
        }
        
        .action-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            margin-right: 5px;
            transition: all 0.2s ease;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
        }
        
        .action-btn-view {
            background-color: #e8f4fd;
            color: #0d6efd;
            border: none;
        }
        
        .action-btn-view:hover {
            background-color: #0d6efd;
            color: white;
        }
        
        .action-btn-edit {
            background-color: #e3f2fd;
            color: #2196f3;
            border: none;
        }
        
        .action-btn-edit:hover {
            background-color: #2196f3;
            color: white;
        }
        
        .action-btn-delete {
            background-color: #ffebee;
            color: #f44336;
            border: none;
        }
        
        .action-btn-delete:hover {
            background-color: #f44336;
            color: white;
        }
        
        .search-container {
            display: flex;
            margin-bottom: 20px;
        }
        
        .search-input {
            border-radius: 30px 0 0 30px;
            border: 1px solid #ced4da;
            padding: 10px 20px;
            flex-grow: 1;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .search-button {
            border-radius: 0 30px 30px 0;
            border: none;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .new-order-btn {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }
        
        .new-order-btn:hover {
            background-color: #3d8b40;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.4;
        }

        /* Modal styles */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: none;
            z-index: 1040;
        }
        
        .modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
            z-index: 1050;
            display: none;
        }
        
        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-body {
            padding: 20px;
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #e9ecef;
            text-align: right;
        }
        
        .modal-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .close-modal {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .modal-label {
            font-weight: 600;
            color: #344767;
            margin-bottom: 5px;
        }
        
        .modal-value {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <form action="{{ route('admin.dashboard') }}" method="GET">
                    <div class="search-container">
                        <input type="text" name="search" class="form-control search-input" placeholder="Search by name, destination or subject..." value="{{ request('search') }}">
                        <button type="submit" class="search-button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-end">
                <a class="btn new-order-btn" href="{{ route('admin.order.create') }}">
                    <i class="bi bi-plus-circle me-1"></i> Nouveau Ordre de Mission
                </a>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Staff Name</th>
                            <th>Destination <i class="bi bi-geo-alt-fill text-muted"></i></th>
                            <th>Reimbursement Status</th>
                            <th>Date Period</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td class="fw-semibold">{{ $order->user->name }}</td>
                                <td>{{ $order->destination }}</td>
                                <td>
                                    @if($order->etatRemboursement == 'Completed')
                                        <span class="badge badge-completed">Completed</span>
                                    @elseif($order->etatRemboursement == 'EN ATTEND')
                                        <span class="badge badge-attend">EN ATTEND</span>
                                    @else
                                        <span class="badge badge-pending">{{ $order->etatRemboursement }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-range">
                                        <span><span class="date-label">From:</span> <span class="date-value">{{ $order->dateDebut }}</span></span>
                                        <span><span class="date-label">To:</span> <span class="date-value">{{ $order->dateFin }}</span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn action-btn action-btn-view show-details" 
                                        data-id="{{ $order->id }}" 
                                        data-name="{{ $order->user->name }}" 
                                        data-date-debut="{{ $order->dateDebut }}"
                                        data-date-ariver="{{ $order->dateAriver }}"
                                        data-date-fin="{{ $order->dateFin }}"
                                        data-transport="{{ $order->transport }}"
                                        data-destination="{{ $order->destination }}"
                                        data-objectif="{{ $order->objectif }}"
                                        data-id-fonctionnaire="{{ $order->idFonctionnaire }}"
                                        data-etat-remboursement="{{ $order->etatRemboursement }}"
                                        data-montant-remboursement="{{ $order->montantRemboursement ?? 0 }}"
                                        title="View Details">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                        <a href="{{ route('admin.order.edit', $order->id) }}" class="btn action-btn action-btn-edit" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn action-btn action-btn-delete" title="Delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <p>No orders found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(isset($orders) && method_exists($orders, 'hasPages') && $orders->hasPages())
                <div class="p-3 border-top">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Details Modal -->
<div class="modal-backdrop" id="modalBackdrop"></div>
<div class="modal" id="detailsModal">
    <div class="modal-header">
        <h5 class="modal-title">Mission Details</h5>
        <button type="button" class="close-modal" id="closeModal">&times;</button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <div class="modal-label">Staff Name</div>
            <div class="modal-value" id="modalStaffName"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">ID Fonctionnaire</div>
            <div class="modal-value" id="modalIdFonctionnaire"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">Destination</div>
            <div class="modal-value" id="modalDestination"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">Objectif</div>
            <div class="modal-value" id="modalObjectif"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">Transport</div>
            <div class="modal-value" id="modalTransport"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">Date de Début</div>
            <div class="modal-value" id="modalDateDebut"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">Date d'Arrivée</div>
            <div class="modal-value" id="modalDateAriver"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">Date de Fin</div>
            <div class="modal-value" id="modalDateFin"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">État de Remboursement</div>
            <div class="modal-value" id="modalEtatRemboursement"></div>
        </div>
        <div class="mb-3">
            <div class="modal-label">Montant Remboursé</div>
            <div class="modal-value" id="modalMontantRemboursement"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeModalBtn">Close</button>
    </div>
</div>

    <!-- JavaScript for Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('detailsModal');
            const modalBackdrop = document.getElementById('modalBackdrop');
            const closeModal = document.getElementById('closeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const showDetailsBtns = document.querySelectorAll('.show-details');
            
            // Modal elements
            const modalStaffName = document.getElementById('modalStaffName');
            const modalIdFonctionnaire = document.getElementById('modalIdFonctionnaire');
            const modalDestination = document.getElementById('modalDestination');
            const modalObjectif = document.getElementById('modalObjectif');
            const modalTransport = document.getElementById('modalTransport');
            const modalDateDebut = document.getElementById('modalDateDebut');
            const modalDateAriver = document.getElementById('modalDateAriver');
            const modalDateFin = document.getElementById('modalDateFin');
            const modalEtatRemboursement = document.getElementById('modalEtatRemboursement');
            const modalMontantRemboursement = document.getElementById('modalMontantRemboursement');
            
            function openModal() {
                modal.style.display = 'block';
                modalBackdrop.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
            
            function closeModalFn() {
                modal.style.display = 'none';
                modalBackdrop.style.display = 'none';
                document.body.style.overflow = '';
            }
            
            showDetailsBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const idFonctionnaire = this.getAttribute('data-id-fonctionnaire');
                    const destination = this.getAttribute('data-destination');
                    const objectif = this.getAttribute('data-objectif');
                    const transport = this.getAttribute('data-transport');
                    const dateDebut = this.getAttribute('data-date-debut');
                    const dateAriver = this.getAttribute('data-date-ariver');
                    const dateFin = this.getAttribute('data-date-fin');
                    const etatRemboursement = this.getAttribute('data-etat-remboursement');
                    const montantRemboursement = this.getAttribute('data-montant-remboursement') || '0';
                    
                    // Populate modal with data
                    modalStaffName.textContent = name;
                    modalIdFonctionnaire.textContent = idFonctionnaire;
                    modalDestination.textContent = destination;
                    modalObjectif.textContent = objectif;
                    modalTransport.textContent = transport;
                    modalDateDebut.textContent = dateDebut;
                    modalDateAriver.textContent = dateAriver;
                    modalDateFin.textContent = dateFin;
                    modalMontantRemboursement.textContent = `${parseFloat(montantRemboursement).toFixed(2)} MAD`;
                    
                    // Set status with badge
                    if (etatRemboursement === 'Completed') {
                        modalEtatRemboursement.innerHTML = '<span class="badge badge-completed">Completed</span>';
                    } else if (etatRemboursement === 'EN ATTEND') {
                        modalEtatRemboursement.innerHTML = '<span class="badge badge-attend">EN ATTEND</span>';
                    } else {
                        modalEtatRemboursement.innerHTML = '<span class="badge badge-pending">' + etatRemboursement + '</span>';
                    }
                    
                    openModal();
                });
            });
            
            closeModal.addEventListener('click', closeModalFn);
            closeModalBtn.addEventListener('click', closeModalFn);
            modalBackdrop.addEventListener('click', closeModalFn);
        });
    </script>
</body>

</html>
@endsection
</x-master>
