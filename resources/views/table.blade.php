@extends('layouts.app')

@section('title', 'Tableau')

@section('styles')

@endsection

@section('content')

    <style>
        /* Variables */
        :root {
            --primary-color: #3490dc;
            --secondary-color: #38c172;
            --dark-color: #1a202c;
            --light-color: #f8fafc;
            --gray-color: #edf2f7;
            --border-color: #e2e8f0;
            --hover-color: #f7fafc;
            --action-color: #4299e1;
            --delete-color: #e53e3e;
            --edit-color: #f6ad55;
            --success-color: #48bb78;
        }

        /* Base styles */
        body {
            font-family: 'Nunito', sans-serif;
            color: var(--dark-color);
            background-color: var(--light-color);
        }

        /* Page header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            border-radius: 0 0 2rem 2rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/api/placeholder/1200/300');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            z-index: 0;
            border-radius: 0 0 2rem 2rem;
        }

        .page-header > * {
            position: relative;
            z-index: 1;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .page-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Table container */
        .table-container {
            max-width: 1200px;
            margin: 0 auto 3rem;
            padding: 0 1rem;
        }

        /* Card style for tables */
        .card {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header {
            background-color: white;
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--dark-color);
            position: relative;
            padding-left: 1rem;
        }

        .card-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-footer {
            background-color: white;
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Search and filter bar */
        .table-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .search-box {
            position: relative;
            flex-grow: 1;
            min-width: 200px;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 144, 220, 0.25);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
        }

        /* Filter dropdown */
        .filter-dropdown {
            position: relative;
        }

        .filter-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-button:hover {
            border-color: var(--primary-color);
        }

        /* Add button */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2779bd, #2d995b);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        /* Table styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
            color: var(--dark-color);
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
            text-align: left;
        }

        .table thead th {
            background-color: #f8fafc;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
            color: #64748b;
            padding: 0.75rem 1rem;
            border-bottom: 2px solid var(--border-color);
            position: relative;
            cursor: pointer;
        }

        .table thead th:hover {
            background-color: #edf2f7;
        }
        
        .table thead th::after {
            content: '↕';
            position: absolute;
            right: 0.5rem;
            opacity: 0.3;
        }

        .table thead th.sorted-asc::after {
            content: '↓';
            opacity: 1;
            color: var(--primary-color);
        }

        .table thead th.sorted-desc::after {
            content: '↑';
            opacity: 1;
            color: var(--primary-color);
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: var(--hover-color);
        }

        .table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .table tbody tr:nth-child(even):hover {
            background-color: #f5f5f5;
        }

        /* Status indicators */
        .status-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1;
            border-radius: 9999px;
        }

        .status-active {
            background-color: rgba(72, 187, 120, 0.1);
            color: #2f855a;
        }

        .status-inactive {
            background-color: rgba(160, 174, 192, 0.1);
            color: #4a5568;
        }

        .status-pending {
            background-color: rgba(246, 173, 85, 0.1);
            color: #c05621;
        }

        /* User avatar */
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Actions column */
        .table-actions-cell {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            color: white;
        }

        .action-button-view {
            background-color: var(--action-color);
        }

        .action-button-edit {
            background-color: var(--edit-color);
        }

        .action-button-delete {
            background-color: var(--delete-color);
        }

        .action-button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Table footer / pagination */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.25rem;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.75rem;
            min-width: 36px;
            height: 36px;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: var(--dark-color);
            text-decoration: none;
            background-color: white;
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-item.disabled .page-link {
            color: #a0aec0;
            pointer-events: none;
            cursor: not-allowed;
        }

        .page-link:hover:not(.disabled) {
            background-color: #f7fafc;
            border-color: var(--primary-color);
            z-index: 2;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state-icon {
            margin-bottom: 1.5rem;
            color: #a0aec0;
        }

        .empty-state-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .empty-state-description {
            color: #718096;
            max-width: 400px;
            margin: 0 auto 1.5rem;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .table-container {
                padding: 0;
            }

            .card {
                border-radius: 0;
                box-shadow: none;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .table-width-mobile-helper {
                min-width: 680px;
            }

            .page-subtitle, .card-subtitle {
                display: none;
            }
        }

        /* Data cells styling */
        .text-primary {
            color: var(--primary-color);
        }

        .text-success {
            color: var(--success-color);
        }
        
        .text-danger {
            color: var(--delete-color);
        }

        .table .progress-bar-cell {
            width: 150px;
        }

        .progress-bar {
            height: 8px;
            background-color: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 4px;
        }

        /* Switch/toggle styles */
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e0;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--success-color);
        }

        input:focus + .slider {
            box-shadow: 0 0 1px var(--success-color);
        }

        input:checked + .slider:before {
            transform: translateX(24px);
        }

        /* Table layout with responsive design */
        @media (max-width: 640px) {
            .table-hide-mobile {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .table-hide-tablet {
                display: none;
            }
        }

        /* Table row highlight on selected */
        .table-row-selected {
            background-color: rgba(66, 153, 225, 0.1) !important;
        }
        
        /* Tab navigation for multiple tables */
        .tab-navigation {
            display: flex;
            overflow-x: auto;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .tab-button {
            padding: 0.875rem 1.25rem;
            font-weight: 600;
            color: #718096;
            background-color: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            white-space: nowrap;
        }
        
        .tab-button:hover {
            color: var(--primary-color);
        }
        
        .tab-button.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }
    </style>
    <!-- En-tête de la page -->
    <div class="page-header">
        <h1 class="page-title">Gestion des Données</h1>
        <p class="page-subtitle">Consultez et gérez vos données efficacement grâce à nos tableaux interactifs</p>
    </div>

    <!-- Conteneur principal -->
    <div class="table-container">
        <!-- Navigation des onglets -->
        <div class="tab-navigation">
            <button class="tab-button active">Clients</button>
            <button class="tab-button">Produits</button>
            <button class="tab-button">Commandes</button>
            <button class="tab-button">Fournisseurs</button>
        </div>
        
        <!-- Tableau Clients -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Liste des Clients</h2>
                
                <div class="table-actions">
                    <div class="search-box">
                        <span class="search-icon">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" class="search-input" placeholder="Rechercher un client...">
                    </div>
                    
                    <div class="filter-dropdown">
                        <button class="filter-button">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtrer
                        </button>
                    </div>
                    
                    <a href="#" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajouter un client
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-checkbox">
                                </th>
                                <th class="sorted-asc">ID</th>
                                <th>Client</th>
                                <th class="table-hide-mobile">Email</th>
                                <th class="table-hide-tablet">Téléphone</th>
                                <th class="table-hide-tablet">Date d'inscription</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-checkbox">
                                </td>
                                <td>001</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <img src="/api/placeholder/100/100" alt="Jean Dupont" class="user-avatar">
                                        <div>
                                            <div style="font-weight: 600;">Jean Dupont</div>
                                            <div style="font-size: 0.75rem; color: #718096;">Paris, France</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-hide-mobile">jean@example.com</td>
                                <td class="table-hide-tablet">06 12 34 56 78</td>
                                <td class="table-hide-tablet">12/03/2025</td>
                                <td>
                                    <span class="status-indicator status-active">Actif</span>
                                </td>
                                <td>
                                    <div class="table-actions-cell">
                                        <button class="action-button action-button-view">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-edit">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-delete">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-checkbox">
                                </td>
                                <td>002</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <img src="/api/placeholder/100/100" alt="Marie Claire" class="user-avatar">
                                        <div>
                                            <div style="font-weight: 600;">Marie Claire</div>
                                            <div style="font-size: 0.75rem; color: #718096;">Lyon, France</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-hide-mobile">marie@example.com</td>
                                <td class="table-hide-tablet">06 98 76 54 32</td>
                                <td class="table-hide-tablet">27/01/2025</td>
                                <td>
                                    <span class="status-indicator status-active">Actif</span>
                                </td>
                                <td>
                                    <div class="table-actions-cell">
                                        <button class="action-button action-button-view">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-edit">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-delete">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-checkbox">
                                </td>
                                <td>003</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <img src="/api/placeholder/100/100" alt="Pierre Martin" class="user-avatar">
                                        <div>
                                            <div style="font-weight: 600;">Pierre Martin</div>
                                            <div style="font-size: 0.75rem; color: #718096;">Marseille, France</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-hide-mobile">pierre@example.com</td>
                                <td class="table-hide-tablet">06 45 67 89 01</td>
                                <td class="table-hide-tablet">15/02/2025</td>
                                <td>
                                    <span class="status-indicator status-inactive">Inactif</span>
                                </td>
                                <td>
                                    <div class="table-actions-cell">
                                        <button class="action-button action-button-view">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-edit">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-delete">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-checkbox">
                                </td>
                                <td>004</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <img src="/api/placeholder/100/100" alt="Sophie Dubois" class="user-avatar">
                                        <div>
                                            <div style="font-weight: 600;">Sophie Dubois</div>
                                            <div style="font-size: 0.75rem; color: #718096;">Bordeaux, France</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-hide-mobile">sophie@example.com</td>
                                <td class="table-hide-tablet">06 23 45 67 89</td>
                                <td class="table-hide-tablet">05/04/2025</td>
                                <td>
                                    <span class="status-indicator status-pending">En attente</span>
                                </td>
                                <td>
                                    <div class="table-actions-cell">
                                        <button class="action-button action-button-view">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-edit">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-delete">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-checkbox">
                                </td>
                                <td>005</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <img src="/api/placeholder/100/100" alt="Lucas Bernard" class="user-avatar">
                                        <div>
                                            <div style="font-weight: 600;">Lucas Bernard</div>
                                            <div style="font-size: 0.75rem; color: #718096;">Lille, France</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-hide-mobile">lucas@example.com</td>
                                <td class="table-hide-tablet">06 78 90 12 34</td>
                                <td class="table-hide-tablet">19/03/2025</td>
                                <td>
                                    <span class="status-indicator status-active">Actif</span>
                                </td>
                                <td>
                                    <div class="table-actions-cell">
                                        <button class="action-button action-button-view">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-edit">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-delete">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer">
                <div>Affichage de 1 à 5 sur 25 entrées</div>
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <!-- Tableau Produits -->
        <div class="card" style="display: none;">
            <div class="card-header">
                <h2 class="card-title">Liste des Produits</h2>
                
                <div class="table-actions">
                    <div class="search-box">
                        <span class="search-icon">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" class="search-input" placeholder="Rechercher un produit...">
                    </div>
                    
                    <div class="filter-dropdown">
                        <button class="filter-button">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtrer
                        </button>
                    </div>
                    
                    <a href="#" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajouter un produit
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-checkbox">
                                </th>
                                <th class="sorted-asc">Ref</th>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Disponibilité</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-checkbox">
                                </td>
                                <td>P001</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <img src="/api/placeholder/100/100" alt="Smartphone X12" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                        <div>
                                            <div style="font-weight: 600;">Smartphone X12</div>
                                            <div style="font-size: 0.75rem; color: #718096;">Pro Edition</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Électronique</td>
                                <td><span class="text-primary">899,99 €</span></td>
                                <td>
                                    <div class="progress-bar-cell">
                                        <div style="display: flex; justify-content: space-between; margin-bottom: 4px;">
                                            <span style="font-size: 0.75rem;">75 unités</span>
                                            <span style="font-size: 0.75rem;">75%</span>
                                        </div>
                                        <div class="progress-bar">
                                            <div class="progress-bar-fill" style="width: 75%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="table-actions-cell">
                                        <button class="action-button action-button-view">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-edit">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="action-button action-button-delete">
                                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Plus de produits ici -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer">
                <div>Affichage de 1 à 5 sur 32 entrées</div>
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <!-- État vide pour démonstration -->
        <div class="card" style="display: none;">
            <div class="card-header">
                <h2 class="card-title">Commandes</h2>
                
                <div class="table-actions">
                    <div class="search-box">
                        <span class="search-icon">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" class="search-input" placeholder="Rechercher une commande...">
                    </div>
                    
                    <a href="#" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Nouvelle commande
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <svg width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="empty-state-title">Aucune commande trouvée</h3>
                    <p class="empty-state-description">
                        Vous n'avez pas encore de commandes enregistrées dans le système.
                    </p>
                    <a href="#" class="btn btn-primary">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer votre première commande
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des onglets
        const tabButtons = document.querySelectorAll('.tab-button');
        const cards = document.querySelectorAll('.card');
        
        tabButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                // Désactiver tous les onglets
                tabButtons.forEach(btn => btn.classList.remove('active'));
                cards.forEach(card => card.style.display = 'none');
                
                // Activer l'onglet sélectionné
                button.classList.add('active');
                cards[index].style.display = 'block';
            });
        });
        
        // Recherche dans les tableaux
        const searchInputs = document.querySelectorAll('.search-input');
        
        searchInputs.forEach(input => {
            input.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const tableBody = this.closest('.card').querySelector('tbody');
                const rows = tableBody.querySelectorAll('tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        });
        
        // Tri des colonnes
        const tableHeaders = document.querySelectorAll('th:not(:first-child)');
        
        tableHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const table = this.closest('table');
                const index = Array.from(this.parentNode.children).indexOf(this);
                const isAsc = this.classList.contains('sorted-asc');
                
                // Réinitialiser les classes de tri
                tableHeaders.forEach(th => {
                    th.classList.remove('sorted-asc', 'sorted-desc');
                });
                
                // Définir la direction du tri
                this.classList.add(isAsc ? 'sorted-desc' : 'sorted-asc');
                
                // Trier les lignes
                const rows = Array.from(table.querySelectorAll('tbody tr'));
                const sortedRows = rows.sort((a, b) => {
                    const aValue = a.children[index].textContent.trim();
                    const bValue = b.children[index].textContent.trim();
                    
                    return isAsc 
                        ? bValue.localeCompare(aValue, undefined, {numeric: true, sensitivity: 'base'})
                        : aValue.localeCompare(bValue, undefined, {numeric: true, sensitivity: 'base'});
                });
                
                // Réorganiser le tableau
                const tbody = table.querySelector('tbody');
                sortedRows.forEach(row => tbody.appendChild(row));
            });
        });
        
        // Sélection des lignes avec checkbox
        const checkboxes = document.querySelectorAll('.form-checkbox');
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('tr');
                if (this.checked) {
                    row.classList.add('table-row-selected');
                } else {
                    row.classList.remove('table-row-selected');
                }
                
                // Si c'est le checkbox d'en-tête
                if (this.closest('thead')) {
                    const table = this.closest('table');
                    const bodyCheckboxes = table.querySelectorAll('tbody .form-checkbox');
                    
                    bodyCheckboxes.forEach(cb => {
                        cb.checked = this.checked;
                        const cbRow = cb.closest('tr');
                        if (this.checked) {
                            cbRow.classList.add('table-row-selected');
                        } else {
                            cbRow.classList.remove('table-row-selected');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection