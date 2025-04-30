@extends('layouts.app')

@section('title', 'Accueil')

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
        }

        /* Base styles */
        body {
            font-family: 'Nunito', sans-serif;
            color: var(--dark-color);
            background-color: var(--light-color);
        }

        /* Header styles */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 5rem 2rem;
            text-align: center;
            border-radius: 0 0 2rem 2rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/api/placeholder/1200/600');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            z-index: 0;
        }

        .hero-section > * {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-button {
            display: inline-block;
            background-color: white;
            color: var(--primary-color);
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .cta-button:hover {
            background-color: transparent;
            color: white;
            border-color: white;
        }

        /* Featured products section */
        .featured-section {
            padding: 2rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 2rem;
        }

        @media (min-width: 640px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .product-card {
            background-color: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-name {
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .product-price {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .product-description {
            font-size: 0.875rem;
            color: #718096;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .product-button {
            display: block;
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 0.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .product-button:hover {
            background-color: var(--secondary-color);
        }

        /* Categories section */
        .categories-section {
            background-color: var(--gray-color);
            padding: 4rem 1rem;
            margin: 3rem 0;
        }

        .categories-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }

        @media (min-width: 640px) {
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .categories-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .category-card {
            position: relative;
            height: 200px;
            border-radius: 1rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5rem;
            text-align: center;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
            transition: background-color 0.3s ease;
        }

        .category-card:hover::before {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .category-name {
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Testimonials section */
        .testimonials-section {
            padding: 4rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials-container {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .testimonials-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .testimonial-card {
            background-color: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .testimonial-card::before {
            content: """;
            position: absolute;
            top: 1rem;
            left: 1.5rem;
            font-size: 4rem;
            color: var(--gray-color);
            font-family: serif;
            line-height: 1;
        }

        .testimonial-text {
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 1rem;
        }

        .author-info {
            display: flex;
            flex-direction: column;
        }

        .author-name {
            font-weight: 700;
            font-size: 1rem;
        }

        .author-role {
            font-size: 0.875rem;
            color: #718096;
        }

        /* Newsletter section */
        .newsletter-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 4rem 1rem;
            color: white;
            text-align: center;
        }

        .newsletter-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .newsletter-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .newsletter-subtitle {
            margin-bottom: 2rem;
        }

        .newsletter-form {
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 640px) {
            .newsletter-form {
                flex-direction: row;
            }
        }

        .newsletter-input {
            flex-grow: 1;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            border: none;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            margin-bottom: 1rem;
        }

        @media (min-width: 640px) {
            .newsletter-input {
                margin-bottom: 0;
                margin-right: 1rem;
                border-radius: 9999px 0 0 9999px;
            }
        }

        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .newsletter-button {
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            border: none;
            background-color: white;
            color: var(--primary-color);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        @media (min-width: 640px) {
            .newsletter-button {
                border-radius: 0 9999px 9999px 0;
            }
        }

        .newsletter-button:hover {
            background-color: var(--dark-color);
            color: white;
        }

        /* Footer styles */
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 4rem 1rem 2rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 2rem;
        }

        @media (min-width: 640px) {
            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .footer-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .footer-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 1.5px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-link {
            margin-bottom: 0.75rem;
        }

        .footer-link a {
            color: #cbd5e0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link a:hover {
            color: white;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .social-icon:hover {
            background-color: var(--primary-color);
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.875rem;
            color: #cbd5e0;
        }
    </style>
    <!-- Section Héro -->
    <section class="hero-section">
        <h1 class="hero-title">Découvrez Notre Collection Exclusive</h1>
        <p class="hero-subtitle">Des produits de qualité supérieure pour tous vos besoins, soigneusement sélectionnés pour vous.</p>
        <a href="#" class="cta-button">Voir les produits</a>
    </section>

    <!-- Section Produits Vedettes -->
    <section class="featured-section">
        <h2 class="section-title">Produits Vedettes</h2>
        <div class="products-grid">
            <!-- Produit 1 -->
            <div class="product-card">
                <img src="/api/placeholder/400/320" alt="Produit 1" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Montre Élégante</h3>
                    <p class="product-price">129,99 €</p>
                    <p class="product-description">Une montre élégante avec bracelet en cuir véritable, parfaite pour toutes les occasions.</p>
                    <a href="#" class="product-button">Ajouter au panier</a>
                </div>
            </div>
            
            <!-- Produit 2 -->
            <div class="product-card">
                <img src="/api/placeholder/400/320" alt="Produit 2" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Sac À Main Premium</h3>
                    <p class="product-price">89,99 €</p>
                    <p class="product-description">Un sac à main spacieux et élégant, fabriqué à partir de matériaux durables et de haute qualité.</p>
                    <a href="#" class="product-button">Ajouter au panier</a>
                </div>
            </div>
            
            <!-- Produit 3 -->
            <div class="product-card">
                <img src="/api/placeholder/400/320" alt="Produit 3" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Écouteurs Bluetooth</h3>
                    <p class="product-price">79,99 €</p>
                    <p class="product-description">Des écouteurs sans fil avec une qualité sonore exceptionnelle et une autonomie de batterie longue durée.</p>
                    <a href="#" class="product-button">Ajouter au panier</a>
                </div>
            </div>
            
            <!-- Produit 4 -->
            <div class="product-card">
                <img src="/api/placeholder/400/320" alt="Produit 4" class="product-image">
                <div class="product-info">
                    <h3 class="product-name">Parfum Luxueux</h3>
                    <p class="product-price">59,99 €</p>
                    <p class="product-description">Un parfum élégant aux notes délicates et raffinées, parfait pour créer une impression durable.</p>
                    <a href="#" class="product-button">Ajouter au panier</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Catégories -->
    <section class="categories-section">
        <div class="categories-container">
            <h2 class="section-title">Nos Catégories</h2>
            <div class="categories-grid">
                <!-- Catégorie 1 -->
                <a href="#" class="category-card" style="background-image: url('/api/placeholder/500/300')">
                    <span class="category-name">Mode & Accessoires</span>
                </a>
                
                <!-- Catégorie 2 -->
                <a href="#" class="category-card" style="background-image: url('/api/placeholder/500/300')">
                    <span class="category-name">Électronique</span>
                </a>
                
                <!-- Catégorie 3 -->
                <a href="#" class="category-card" style="background-image: url('/api/placeholder/500/300')">
                    <span class="category-name">Maison & Déco</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Section Témoignages -->
    <section class="testimonials-section">
        <h2 class="section-title">Ce Que Nos Clients Disent</h2>
        <div class="testimonials-container">
            <!-- Témoignage 1 -->
            <div class="testimonial-card">
                <p class="testimonial-text">J'ai commandé plusieurs produits et je suis très satisfait de la qualité et du service client. Je recommande vivement !</p>
                <div class="testimonial-author">
                    <img src="/api/placeholder/100/100" alt="Sophie Martin" class="author-avatar">
                    <div class="author-info">
                        <span class="author-name">Sophie Martin</span>
                        <span class="author-role">Cliente fidèle</span>
                    </div>
                </div>
            </div>
            
            <!-- Témoignage 2 -->
            <div class="testimonial-card">
                <p class="testimonial-text">La livraison a été rapide et les produits correspondent parfaitement aux descriptions. Je reviendrai certainement !</p>
                <div class="testimonial-author">
                    <img src="/api/placeholder/100/100" alt="Thomas Dubois" class="author-avatar">
                    <div class="author-info">
                        <span class="author-name">Thomas Dubois</span>
                        <span class="author-role">Nouveau client</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Newsletter -->
    <section class="newsletter-section">
        <div class="newsletter-container">
            <h2 class="newsletter-title">Restez Informé</h2>
            <p class="newsletter-subtitle">Abonnez-vous à notre newsletter pour recevoir les dernières offres et nouveautés.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Votre adresse email" class="newsletter-input" required>
                <button type="submit" class="newsletter-button">S'abonner</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Colonne 1 -->
            <div class="footer-column">
                <h3 class="footer-title">À Propos</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="#">Notre histoire</a></li>
                    <li class="footer-link"><a href="#">Notre équipe</a></li>
                    <li class="footer-link"><a href="#">Nos valeurs</a></li>
                    <li class="footer-link"><a href="#">Carrières</a></li>
                </ul>
            </div>
            
            <!-- Colonne 2 -->
            <div class="footer-column">
                <h3 class="footer-title">Aide</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="#">FAQ</a></li>
                    <li class="footer-link"><a href="#">Livraison</a></li>
                    <li class="footer-link"><a href="#">Retours</a></li>
                    <li class="footer-link"><a href="#">Contact</a></li>
                </ul>
            </div>
            
            <!-- Colonne 3 -->
            <div class="footer-column">
                <h3 class="footer-title">Légal</h3>
                <ul class="footer-links">
                    <li class="footer-link"><a href="#">Conditions d'utilisation</a></li>
                    <li class="footer-link"><a href="#">Politique de confidentialité</a></li>
                    <li class="footer-link"><a href="#">Cookies</a></li>
                    <li class="footer-link"><a href="#">Mentions légales</a></li>
                </ul>
            </div>
            
            <!-- Colonne 4 -->
            <div class="footer-column">
                <h3 class="footer-title">Suivez-nous</h3>
                <div class="footer-social">
                    <a href="#" class="social-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 2H15C13.6739 2 12.4021 2.52678 11.4645 3.46447C10.5268 4.40215 10 5.67392 10 7V10H7V14H10V22H14V14H17L18 10H14V7C14 6.73478 14.1054 6.48043 14.2929 6.29289C14.4804 6.10536 14.7348 6 15 6H18V2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#" class="social-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23 3.00005C22.0424 3.67552 20.9821 4.19216 19.86 4.53005C19.2577 3.83756 18.4573 3.34674 17.567 3.12397C16.6767 2.90121 15.7395 2.95724 14.8821 3.2845C14.0247 3.61176 13.2884 4.19445 12.773 4.95376C12.2575 5.71308 11.9877 6.61238 12 7.53005V8.53005C10.2426 8.57561 8.50127 8.18586 6.93101 7.39549C5.36074 6.60513 4.01032 5.43868 3 4.00005C3 4.00005 -1 13 8 17C5.94053 18.398 3.48716 19.099 1 19C10 24 21 19 21 7.50005C20.9991 7.2215 20.9723 6.94364 20.92 6.67005C21.9406 5.66354 22.6608 4.39276 23 3.00005Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#" class="social-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 8C17.5913 8 19.1174 8.63214 20.2426 9.75736C21.3679 10.8826 22 12.4087 22 14V21H18V14C18 13.4696 17.7893 12.9609 17.4142 12.5858C17.0391 12.2107 16.5304 12 16 12C15.4696 12 14.9609 12.2107 14.5858 12.5858C14.2107 12.9609 14 13.4696 14 14V21H10V14C10 12.4087 10.6321 10.8826 11.7574 9.75736C12.8826 8.63214 14.4087 8 16 8Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 9H2V21H6V9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 6C5.10457 6 6 5.10457 6 4C6 2.89543 5.10457 2 4 2C2.89543 2 2 2.89543 2 4C2 5.10457 2.89543 6 4 6Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#" class="social-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 2H7C4.23858 2 2 4.23858 2 7V17C2 19.7614 4.23858 22 7 22H17C19.7614 22 22 19.7614 22 17V7C22 4.23858 19.7614 2 17 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 11.37C16.1234 12.2022 15.9813 13.0522 15.5938 13.799C15.2063 14.5458 14.5931 15.1514 13.8416 15.5297C13.0901 15.9079 12.2384 16.0396 11.4078 15.9059C10.5771 15.7723 9.80976 15.3801 9.21484 14.7852C8.61992 14.1902 8.22773 13.4229 8.09407 12.5922C7.9604 11.7615 8.09206 10.9099 8.47033 10.1584C8.84861 9.40685 9.45419 8.79374 10.201 8.40624C10.9478 8.01874 11.7978 7.87658 12.63 8C13.4789 8.12588 14.2649 8.52146 14.8717 9.1283C15.4785 9.73515 15.8741 10.5211 16 11.37Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.5 6.5H17.51" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="copyright">
            © 2025 Votre Boutique en Ligne. Tous droits réservés.
        </div>
    </footer>
@endsection