<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Design</title>
    <style>
        /* Variables - mêmes que votre style existant */
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
            margin: 0;
            padding: 0;
        }

        /* Navbar styles */
        .navbar {
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--dark-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-logo img {
            height: 40px;
        }

        .navbar-brand-text {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .navbar-menu {
            display: flex;
            gap: 2rem;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-item {
            position: relative;
        }

        .navbar-link {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s;
        }

        .navbar-link:hover, .navbar-link.active {
            color: var(--primary-color);
        }

        .navbar-link.active::after {
            content: '';
            position: absolute;
            bottom: -9px;
            left: 0;
            height: 3px;
            width: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .navbar-button {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .navbar-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }

        .navbar-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gray-color);
        }

        .navbar-user-info {
            display: none;
        }

        .navbar-mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--dark-color);
        }
        
        /* Active state for menu items */
        .navbar-item.active .navbar-link {
            color: var(--primary-color);
        }
        
        /* Dropdown styles */
        .navbar-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 0;
            min-width: 200px;
            display: none;
            z-index: 1000;
            margin-top: 0.75rem;
        }
        
        .navbar-item:hover .navbar-dropdown {
            display: block;
        }
        
        .navbar-dropdown::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 1rem;
            width: 16px;
            height: 16px;
            background-color: white;
            transform: rotate(45deg);
            border-top: 1px solid var(--border-color);
            border-left: 1px solid var(--border-color);
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            text-decoration: none;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: background-color 0.3s;
        }
        
        .dropdown-item:hover {
            background-color: var(--hover-color);
            color: var(--primary-color);
        }
        
        .dropdown-item.active {
            background-color: rgba(52, 144, 220, 0.1);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        /* Custom highlight for MonExamen section */
        .highlight-section {
            border-left: 3px solid var(--primary-color);
            padding-left: 0.75rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .navbar-container {
                position: relative;
            }
            
            .navbar-mobile-toggle {
                display: block;
            }
            
            .navbar-menu {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: white;
                flex-direction: column;
                align-items: flex-start;
                gap: 0;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                padding: 1rem 0;
                margin-top: 1rem;
                border-radius: 0.5rem;
                display: none;
            }
            
            .navbar-menu.active {
                display: flex;
            }
            
            .navbar-item {
                width: 100%;
            }
            
            .navbar-link {
                padding: 0.75rem 2rem;
                width: 100%;
            }
            
            .navbar-link.active::after {
                display: none;
            }
            
            .navbar-dropdown {
                position: static;
                box-shadow: none;
                padding: 0;
                display: none;
                margin: 0;
            }
            
            .navbar-dropdown::before {
                display: none;
            }
            
            .dropdown-item {
                padding-left: 3.5rem;
            }
            
            .navbar-item.active .navbar-dropdown {
                display: block;
            }
            
            .navbar-user-info {
                display: block;
            }
        }

        /* Page header (comme votre code) */
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="#" class="navbar-logo">
                <img src="/api/placeholder/80/40" alt="Logo">
                <span class="navbar-brand-text">MonExamen</span>
            </a>
            
            <button class="navbar-mobile-toggle">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <ul class="navbar-menu">
                <li class="navbar-item active">
                    <a href="{{ route('home') }}" class="navbar-link">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Accueil
                    </a>
                </li>
                
                <li class="navbar-item">
                    <a href="{{ route('formulaire') }}" class="navbar-link">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Formulaire
                    </a>
                </li>
                
                <li class="navbar-item">
                    <a href="{{ route('table') }}" class="navbar-link">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Tableau
                    </a>
                </li>
                
                {{-- <li class="navbar-item">
                    <a href="#" class="navbar-link">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Calendrier
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    
                    <div class="navbar-dropdown">
                        <a href="#" class="dropdown-item">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Vue mensuelle
                        </a>
                        <a href="#" class="dropdown-item active">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Vue hebdomadaire
                        </a>
                        <a href="#" class="dropdown-item">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Vue journalière
                        </a>
                    </div>
                </li> --}}
{{--                 
                <li class="navbar-item">
                    <a href="#" class="navbar-link highlight-section">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        MonExamen
                    </a>
                </li> --}}
            </ul>
            
            {{-- <div class="navbar-right">
                <a href="#" class="navbar-button">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nouveau
                </a>
                
                <div class="navbar-user">
                    <img src="/api/placeholder/100/100" alt="Avatar" class="navbar-user-avatar">
                    <div class="navbar-user-info">
                        <div style="font-weight: 600;">Jean Dupont</div>
                        <div style="font-size: 0.75rem; color: #718096;">Administrateur</div>
                    </div>
                </div>
            </div> --}}
        </div>
    </nav>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle du menu mobile
            const mobileToggle = document.querySelector('.navbar-mobile-toggle');
            const navbarMenu = document.querySelector('.navbar-menu');
            
            mobileToggle.addEventListener('click', function() {
                navbarMenu.classList.toggle('active');
            });
            
            // Gestion des dropdowns en mobile
            const navItems = document.querySelectorAll('.navbar-item');
            
            navItems.forEach(item => {
                const link = item.querySelector('.navbar-link');
                const dropdown = item.querySelector('.navbar-dropdown');
                
                if (dropdown) {
                    link.addEventListener('click', function(e) {
                        if (window.innerWidth <= 992) {
                            e.preventDefault();
                            item.classList.toggle('active');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>