<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'ordre de mission</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --secondary: #f59e0b;
            --dark: #1e293b;
            --light: #f8fafc;
            --border: #e2e8f0;
            --shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }
        
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-container {
            max-width: 900px;
            margin: 40px auto;
        }
        
        .form-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .form-card .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            padding: 20px 30px;
            border: none;
        }
        
        .form-card .card-body {
            padding: 30px;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background-color: var(--light);
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border: none;
            padding: 12px 24px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .input-group-text {
            background-color: var(--light);
            border: 1px solid var(--border);
            color: var(--dark);
        }
        
        .alert {
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }
        
        .form-section {
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }
        
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .section-icon {
            margin-left: 10px;
            color: var(--secondary);
        }
        
        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        
        .file-upload .form-control {
            padding-right: 100px;
        }
        
        .file-label {
            color: var(--primary);
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>

<body>
    <div class="page-container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Attention! Veuillez corriger les erreurs suivantes:</strong>
            </div>
            <ul class="mb-0 ps-4">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="card form-card">
            <div class="card-header text-white">
                <h4 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Formulaire d'Ordre de Mission</h4>
                <p class="mb-0 mt-2 opacity-75">Veuillez remplir tous les champs obligatoires</p>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.order.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    





                    
                    <div class="form-section">
                        <h5 class="section-title"><i class="fas fa-user section-icon"></i>Informations Personnelles</h5>
                        <div class="mb-4">
                            <label for="idFonctionnaire" class="form-label">Utilisateur <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="utilisateurInput" placeholder="Commencez à taper le nom..." autocomplete="off">
                                <input type="hidden" id="idFonctionnaire" name="idFonctionnaire" required>
                            </div>
                            <div id="utilisateurSuggestions" class="suggestion-dropdown" style="display: none; position: absolute; z-index: 1000; width: calc(100% - 24px); max-height: 200px; overflow-y: auto; background: white; border: 1px solid #ced4da; border-radius: 0 0 8px 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"></div>
                        </div>
                    </div>
                    
                    <script>
                    // Add this to your JavaScript section
                    document.addEventListener('DOMContentLoaded', function() {
                        const utilisateurInput = document.getElementById('utilisateurInput');
                        const utilisateurIdInput = document.getElementById('idFonctionnaire');
                        const suggestionBox = document.getElementById('utilisateurSuggestions');
                        
                        // Users data from your backend
                        const users = [
                            @foreach($user as $utilisateur)
                                { id: "{{ $utilisateur->id }}", name: "{{ $utilisateur->name }}" },
                            @endforeach
                        ];
                        
                        utilisateurInput.addEventListener('input', function() {
                            const inputValue = this.value.toLowerCase();
                            
                            // Clear previous suggestions
                            suggestionBox.innerHTML = '';
                            
                            if (inputValue.length < 2) {
                                suggestionBox.style.display = 'none';
                                return;
                            }
                            
                            // Filter users based on input
                            const filteredUsers = users.filter(user => 
                                user.name.toLowerCase().includes(inputValue)
                            );
                            
                            if (filteredUsers.length > 0) {
                                filteredUsers.forEach(user => {
                                    const div = document.createElement('div');
                                    div.className = 'p-2 border-bottom suggestion-item';
                                    div.style.cursor = 'pointer';
                                    div.innerHTML = user.name;
                                    div.onclick = function() {
                                        utilisateurInput.value = user.name;
                                        utilisateurIdInput.value = user.id;
                                        suggestionBox.style.display = 'none';
                                    };
                                    div.onmouseover = function() {
                                        this.style.backgroundColor = '#f0f4f8';
                                    };
                                    div.onmouseout = function() {
                                        this.style.backgroundColor = 'white';
                                    };
                                    suggestionBox.appendChild(div);
                                });
                                suggestionBox.style.display = 'block';
                            } else {
                                suggestionBox.style.display = 'none';
                            }
                        });
                        
                        // Hide suggestions when clicking outside
                        document.addEventListener('click', function(e) {
                            if (e.target !== utilisateurInput && e.target !== suggestionBox) {
                                suggestionBox.style.display = 'none';
                            }
                        });
                    });
                    </script>










                    
                    <div class="form-section">
                        <h5 class="section-title"><i class="fas fa-calendar-alt section-icon"></i>Dates de Mission</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="dateDebut" class="form-label">Date Début <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dateAriver" class="form-label">Date Arrivée <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                                    <input type="date" class="form-control" id="dateAriver" name="dateAriver" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dateFin" class="form-label">Date Fin <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                    <input type="date" class="form-control" id="dateFin" name="dateFin" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="section-title"><i class="fas fa-map-marked-alt section-icon"></i>Détails du Voyage</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="transport" class="form-label">Moyen de Transport <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-shuttle-van"></i></span>
                                    <select class="form-select" id="transport" name="transport" required>
                                        <option value="">Choisissez un moyen de transport</option>
                                        <option value="Voiture">Voiture</option>
                                        <option value="Train">Train</option>
                                        <option value="Avion">Avion</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="destination" class="form-label">Destination <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" class="form-control" id="destination" name="destination" placeholder="Ville, Pays" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="objectif" class="form-label">Sujet de la Mission <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                <textarea class="form-control" id="sujet" rows="4" name="objectif" placeholder="Décrivez brièvement l'objectif de cette mission..." required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h5 class="section-title"><i class="fas fa-file-upload section-icon"></i>Document</h5>
                        <div class="mb-4">
                            <label for="file_path" class="form-label">Joindre l'ordre de mission <span class="text-danger">*</span></label>
                            <div class="file-upload">
                                <input type="file" class="form-control" id="file_path" name="file_path" required>
                                <span class="file-label"><i class="fas fa-paperclip"></i></span>
                            </div>
                            <small class="text-muted">Formats acceptés: PDF, DOC, DOCX (Max: 5MB)</small>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-light me-2" onclick="window.history.back();">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Soumettre la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation enhancement
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByTagName('form');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>