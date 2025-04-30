@extends('layouts.app')

@section('title', 'Formulaire')

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
            --error-color: #e3342f;
            --success-color: #38c172;
        }

        /* Base styles */
        body {
            font-family: 'Nunito', sans-serif;
            color: var(--dark-color);
            background-color: var(--light-color);
        }

        /* Form container */
        .form-container {
            max-width: 800px;
            margin: 2rem auto 4rem;
            padding: 2rem;
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Page header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            border-radius: 0 0 2rem 2rem;
            margin-bottom: 3rem;
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

        /* Form title */
        .form-title {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            color: var(--dark-color);
        }

        .form-title::after {
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

        /* Form fields */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--gray-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 144, 220, 0.25);
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: var(--error-color);
        }

        /* TextArea */
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Select */
        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%231a202c' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
            padding-right: 2.5rem;
        }

        /* Checkbox and Radio */
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.5rem;
            border: 2px solid var(--gray-color);
            border-radius: 0.25rem;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: white;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' viewBox='0 0 16 16'%3E%3Cpath d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 16px 16px;
        }

        .form-check-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 144, 220, 0.25);
        }

        .form-check-input[type="radio"] {
            border-radius: 50%;
        }

        .form-check-input[type="radio"]:checked {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' viewBox='0 0 16 16'%3E%3Ccircle cx='8' cy='8' r='4'/%3E%3C/svg%3E");
        }

        .form-check-label {
            font-size: 0.875rem;
            user-select: none;
        }

        /* Form extras */
        .form-text {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #718096;
        }

        .form-divider {
            margin: 2rem 0;
            border: 0;
            border-top: 1px solid var(--gray-color);
            position: relative;
        }

        .form-divider-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 0 1rem;
            font-size: 0.875rem;
            color: #718096;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
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

        .btn-secondary {
            background-color: #718096;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4a5568;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        /* Form buttons container */
        .form-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }

        @media (min-width: 640px) {
            .form-buttons {
                flex-direction: row;
                justify-content: space-between;
            }
        }

        /* 2-column layout for form */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.5rem;
            margin-left: -0.5rem;
        }

        .form-col {
            flex: 0 0 100%;
            max-width: 100%;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }

        @media (min-width: 768px) {
            .form-col-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Form validation styles */
        .was-validated .form-control:valid {
            border-color: var(--success-color);
        }

        .was-validated .form-control:invalid {
            border-color: var(--error-color);
        }

        /* Form icon */
        .form-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .form-icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        /* Footer for form */
        .form-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--gray-color);
            font-size: 0.875rem;
            color: #718096;
        }

        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
    
    <!-- En-tête de la page -->
    <div class="page-header">
        <h1 class="page-title">Formulaire de Contact</h1>
        <p class="page-subtitle">Nous serions ravis de recevoir votre message. Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
    </div>

    <!-- Conteneur du formulaire -->
    <div class="form-container">
        <!-- Icône du formulaire -->
        <div class="form-icon">
            <div class="form-icon-circle">
                <svg width="40" height="40" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6ZM20 6L12 11L4 6H20ZM20 18H4V8L12 13L20 8V18Z"/>
                </svg>
            </div>
        </div>

        <h2 class="form-title">Contactez-nous</h2>

        <!-- Formulaire -->
        <form method="POST" action="#" class="needs-validation" novalidate>
            @csrf

            <!-- Rangée pour nom et prénom -->
            <div class="form-row">
                <div class="form-col form-col-6">
                    <div class="form-group">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                        <div class="invalid-feedback">Veuillez entrer votre prénom.</div>
                    </div>
                </div>
                <div class="form-col form-col-6">
                    <div class="form-group">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                        <div class="invalid-feedback">Veuillez entrer votre nom.</div>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                <small class="form-text">Nous ne partagerons jamais votre email avec des tiers.</small>
            </div>

            <!-- Téléphone -->
            <div class="form-group">
                <label for="telephone" class="form-label">Téléphone (optionnel)</label>
                <input type="tel" class="form-control" id="telephone" name="telephone">
            </div>

            <!-- Sujet -->
            <div class="form-group">
                <label for="sujet" class="form-label">Sujet</label>
                <select class="form-control" id="sujet" name="sujet" required>
                    <option value="" selected disabled>Sélectionnez un sujet</option>
                    <option value="demande_information">Demande d'information</option>
                    <option value="support_technique">Support technique</option>
                    <option value="reclamation">Réclamation</option>
                    <option value="autre">Autre</option>
                </select>
                <div class="invalid-feedback">Veuillez sélectionner un sujet.</div>
            </div>

            <!-- Message -->
            <div class="form-group">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                <div class="invalid-feedback">Veuillez entrer votre message.</div>
            </div>

            <!-- Checkbox pour newsletter -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                    <label class="form-check-label" for="newsletter">
                        Je souhaite m'abonner à la newsletter pour recevoir les dernières offres et nouveautés.
                    </label>
                </div>
            </div>

            <!-- Checkbox pour les termes et conditions -->
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="conditions" name="conditions" required>
                    <label class="form-check-label" for="conditions">
                        J'accepte les termes et conditions d'utilisation.
                    </label>
                    <div class="invalid-feedback">Vous devez accepter les termes et conditions pour continuer.</div>
                </div>
            </div>

            <!-- Boutons du formulaire -->
            <div class="form-buttons">
                <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>

        <!-- Pied de formulaire -->
        <div class="form-footer">
            <p>Vous préférez nous contacter directement ? <a href="mailto:contact@example.com">contact@example.com</a></p>
        </div>
    </div>

    <!-- Script pour la validation du formulaire -->
    <script>
        // Fonction pour activer la validation Bootstrap
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Récupérer tous les formulaires auxquels nous voulons appliquer des styles de validation Bootstrap personnalisés
                var forms = document.getElementsByClassName('needs-validation');
                // Boucle pour empêcher la soumission et appliquer la validation
                Array.prototype.filter.call(forms, function(form) {
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
@endsection