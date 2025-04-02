<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Mission</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --secondary: #6b7280;
            --success: #059669;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f3f4f6;
            --dark: #1f2937;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f9fafb;
            color: #374151;
            line-height: 1.5;
        }
        
        .page-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .alert {
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            animation: slideDown 0.3s ease-out;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            border-left: 4px solid var(--danger);
            color: #991b1b;
        }
        
        .form-card {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .form-card:hover {
            transform: translateY(-5px);
        }
        
        .form-header {
            background: linear-gradient(135deg, var(--primary), #818cf8);
            color: white;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .form-title {
            margin: 0;
            font-weight: 600;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }
        
        .form-title i {
            margin-right: 0.75rem;
        }
        
        .form-body {
            padding: 2rem;
        }
        
        .form-section {
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            font-size: 1.125rem;
        }
        
        .section-title i {
            margin-right: 0.5rem;
            color: var(--primary);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
            font-size: 0.875rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.95rem;
            transition: all 0.2s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            background-color: #f9fafb;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            background-color: white;
        }
        
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-footer {
            padding: 1.5rem 2rem;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn i {
            margin-right: 0.5rem;
        }
        
        .file-input-container {
            position: relative;
            margin-top: 0.5rem;
        }
        
        .file-input-label {
            display: flex;
            align-items: center;
            background-color: #f3f4f6;
            border: 1px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 1rem;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
        }
        
        .file-input-label:hover {
            border-color: var(--primary);
            background-color: rgba(79, 70, 229, 0.05);
        }
        
        .file-input-label i {
            font-size: 1.5rem;
            margin-right: 0.75rem;
            color: var(--primary);
        }
        
        .file-input {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
        
        .file-name {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--secondary);
        }
        
        .date-group {
            position: relative;
        }
        
        .date-group i {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary);
            pointer-events: none;
        }
        
        /* Animations */
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .form-group {
            animation: fadeIn 0.3s ease-out forwards;
            animation-delay: calc(var(--item-index, 0) * 0.05s);
            opacity: 0;
        }
        
        @media (max-width: 768px) {
            .form-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="page-container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <strong>Attention :</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.order.update' , $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-card">
                <div class="form-header">
                    <h4 class="form-title">
                        <i class="fas fa-clipboard-list"></i>
                        Ordre de Mission
                    </h4>
                </div>
                
                <div class="form-body">
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-user"></i>
                            Informations Personnelles
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="--item-index: 1">
                                    <label for="name" class="form-label">Nom</label>
                                    <input value="{{ old('nom' , $order->user->name) }}" type="text" class="form-control" id="name" name="name" disabled>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-calendar-alt"></i>
                            Dates de la Mission
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="--item-index: 3">
                                    <label for="dateDebut" class="form-label">Date de Début</label>
                                    <div class="date-group">
                                        <input value="{{ old('dateDebut' , $order->dateDebut) }}" type="date" class="form-control" id="dateDebut" name="dateDebut" required>
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="--item-index: 4">
                                    <label for="dateAriver" class="form-label">Date d'Arrivée</label>
                                    <div class="date-group">
                                        <input value="{{ old('dateAriver' , $order->dateAriver) }}" type="date" class="form-control" id="dateAriver" name="dateAriver" required>
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="--item-index: 5">
                                    <label for="dateFin" class="form-label">Date de Fin</label>
                                    <div class="date-group">
                                        <input value="{{ old('dateFin' , $order->dateFin) }}" type="date" class="form-control" id="dateFin" name="dateFin" required>
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Détails du Déplacement
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="--item-index: 6">
                                    <label for="transport" class="form-label">Moyen de Transport</label>
                                    <input type="text" name="transport" class="form-control" id="transport" value="{{ old('transport', $order->transport)}}" placeholder="Ex: Voiture, Train, Avion...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="--item-index: 7">
                                    <label for="destination" class="form-label">Destination</label>
                                    <input value="{{ old('destination' , $order->destination) }}" type="text" class="form-control" id="destination" name="destination" required placeholder="Ville, Pays">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="--item-index: 8">
                            <label for="objectif" class="form-label">Sujet de la Mission</label>
                            <textarea class="form-control" id="objectif" rows="3" name="objectif" required placeholder="Décrivez l'objectif de votre mission...">{{ old('objectif' , $order->objectif) }}</textarea>
                        </div>
                        
                        <div class="form-group" style="--item-index: 9">
                            <label for="file_path" class="form-label">Document de Mission</label>
                            <div class="file-input-container">
                                <label for="file_path" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Glissez et déposez votre fichier ici ou cliquez pour parcourir</span>
                                </label>
                                <input type="file" class="file-input" id="file_path" name="file_path" required>
                                <div id="file-name" class="file-name"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Soumettre la Mission
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File input preview
            const fileInput = document.getElementById('file_path');
            const fileNameDisplay = document.getElementById('file-name');
            
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileNameDisplay.textContent = 'Fichier sélectionné: ' + this.files[0].name;
                } else {
                    fileNameDisplay.textContent = '';
                }
            });
            
            // Form validation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const dateDebut = new Date(document.getElementById('dateDebut').value);
                const dateAriver = new Date(document.getElementById('dateAriver').value);
                const dateFin = new Date(document.getElementById('dateFin').value);
                
                if (dateAriver < dateDebut) {
                    alert('La date d\'arrivée ne peut pas être antérieure à la date de début.');
                    event.preventDefault();
                }
                
                if (dateFin < dateAriver) {
                    alert('La date de fin ne peut pas être antérieure à la date d\'arrivée.');
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>