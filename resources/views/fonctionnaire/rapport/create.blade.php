<x-master>
    @section('main')
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Création de Rapport</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            .form-container {
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 30px;
            }
            
            .form-title {
                font-size: 24px;
                font-weight: 700;
                color: #344767;
                margin-bottom: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #e9ecef;
            }
            
            .mission-info {
                background-color: #f8f9fa;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 30px;
            }
            
            .mission-destination {
                font-weight: 600;
                font-size: 18px;
                margin-bottom: 10px;
                color: #344767;
            }
            
            .mission-dates {
                display: flex;
                color: #6c757d;
                margin-bottom: 10px;
                gap: 20px;
            }
            
            .form-label {
                font-weight: 600;
                color: #344767;
                margin-bottom: 8px;
            }
            
            .form-control {
                border-radius: 8px;
                padding: 12px;
                border: 1px solid #ced4da;
                box-shadow: none;
                transition: all 0.3s;
            }
            
            .form-control:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            }
            
            textarea.form-control {
                min-height: 200px;
                resize: vertical;
            }
            
            .action-buttons {
                display: flex;
                justify-content: space-between;
                margin-top: 30px;
            }
            
            .btn-cancel {
                background-color: #6c757d;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
                border: none;
                display: flex;
                align-items: center;
                transition: all 0.3s;
            }
            
            .btn-cancel i {
                margin-right: 10px;
            }
            
            .btn-cancel:hover {
                background-color: #5a6268;
                transform: translateY(-2px);
                color: white;
            }
            
            .btn-submit {
                background-color: #0d6efd;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
                border: none;
                display: flex;
                align-items: center;
                transition: all 0.3s;
            }
            
            .btn-submit i {
                margin-right: 10px;
            }
            
            .btn-submit:hover {
                background-color: #0b5ed7;
                transform: translateY(-2px);
                color: white;
            }
            
            .alert {
                border-radius: 8px;
                padding: 15px;
                margin-bottom: 20px;
            }
            
            .alert-danger {
                background-color: #f8d7da;
                border-color: #f5c2c7;
                color: #842029;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <div class="form-container">
                <h2 class="form-title">Créer un Rapport de Mission</h2>
                
                <div class="mission-info">
                    <div class="mission-destination">
                        <i class="bi bi-geo-alt-fill text-primary"></i> Mission: {{ $mission->destination }}
                    </div>
                    <div class="mission-dates">
                        <div><i class="bi bi-calendar-event"></i> Début: {{ \Carbon\Carbon::parse($mission->dateDebut)->format('d/m/Y') }}</div>
                        <div><i class="bi bi-calendar-check"></i> Fin: {{ \Carbon\Carbon::parse($mission->dateFin)->format('d/m/Y') }}</div>
                    </div>
                    <div>
                        <i class="bi bi-info-circle text-primary"></i> Veuillez remplir le rapport détaillant les activités réalisées durant cette mission.
                    </div>
                </div>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('fonctionnaire.rapport.store', $mission->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="sujet" class="form-label">Sujet du Rapport</label>
                        <input type="text" class="form-control" id="sujet" name="sujet" value="{{ old('sujet') }}" placeholder="Entrez le sujet principal du rapport" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="contenu" class="form-label">Contenu du Rapport</label>
                        <textarea class="form-control" id="contenu" name="contenu" placeholder="Décrivez en détail les activités réalisées, les résultats obtenus et toute information pertinente concernant cette mission..." required>{{ old('contenu') }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="file_path" class="form-label">Document du Rapport (PDF, DOC, etc.)</label>
                        <div class="input-group mb-1">
                            <input type="file" class="form-control" id="file_path" name="file_path">
                        </div>
                        <small class="text-muted">Facultatif. Ajoutez un document détaillé de votre rapport (max: 5MB)</small>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('fonctionnaire.mission.show', $mission->id) }}" class="btn-cancel">
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>
                        
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-circle"></i> Soumettre le Rapport
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    </html>
    @endsection
</x-master>