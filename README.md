# 📘 Guide Complet Laravel - Projet d'examen

Ce document est un **guide complet** pour t'aider à ne rien oublier lors de ton projet Laravel. Il contient toutes les **commandes**, les **notions clés**, les **exemples de code**, les **routes CRUD**, les **relations entre modèles**, les **factories**, **seeders**, **vues**, et bien plus encore.

---

## ✅ Sommaire
1. [Installation du projet](#installation-du-projet)
2. [Création des modèles et migrations](#cr%C3%A9ation-des-mod%C3%A8les-et-migrations)
3. [Relations entre tables](#relations-entre-tables)
4. [Seeders & Factories](#seeders--factories)
5. [Commandes Artisan utiles](#commandes-artisan-utiles)
6. [CRUD complet (contrôleurs, routes, vues)](#crud-complet-contr%C3%B4leurs-routes-vues)
7. [Méthodes Eloquent importantes](#m%C3%A9thodes-eloquent-importantes)
8. [Utilisation de Blade (vues)](#utilisation-de-blade-vues)
9. [Travailler avec les données dans les vues](#travailler-avec-les-donn%C3%A9es-dans-les-vues)
10. [Compilation avec Vite (CSS/JS)](#compilation-avec-vite-cssjs)
11. [Utilisation avancée des Factories](#utilisation-avanc%C3%A9e-des-factories)

---

## 📦 Installation du projet
```bash
composer create-project laravel/laravel nom_projet
cd nom_projet
cp .env.example .env
php artisan key:generate
```
Configurer `.env` avec la base de données.

---

## 🏗️ Création des modèles et migrations
```bash
php artisan make:model NomModel -m
```
Exemple :
```bash
php artisan make:model Product -m
```
Cela crée :
- `app/Models/Product.php`
- `database/migrations/xxxx_xx_xx_create_products_table.php`

### Exemple de migration avec relation :
```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

---

## 🔗 Relations entre tables

### 1 à N :
```php
// Product.php
public function category() {
    return $this->belongsTo(Category::class);
}

// Category.php
public function products() {
    return $this->hasMany(Product::class);
}
```

### N à N (pivot) :
```php
// Product.php
public function tags() {
    return $this->belongsToMany(Tag::class);
}

// Tag.php
public function products() {
    return $this->belongsToMany(Product::class);
}
```

### N à 1 : (inverse du 1 à N)
```php
public function user() {
    return $this->belongsTo(User::class);
}
```

---

## 🌱 Seeders & Factories

### Créer une factory
```bash
php artisan make:factory ProductFactory --model=Product
```
```php
// database/factories/ProductFactory.php
public function definition(): array
{
    return [
        'name' => $this->faker->word,
        'category_id' => Category::factory(),
    ];
}
```

### Créer un seeder
```bash
php artisan make:seeder ProductSeeder
```

### Lancer les seeders
```bash
php artisan db:seed
php artisan migrate:fresh --seed  // recommence à zéro avec données
```

---

## 🔧 Commandes Artisan utiles
```bash
php artisan route:list         # Voir les routes
php artisan make:model Nom -m  # Modèle + migration
php artisan make:controller NomController --resource
php artisan make:seeder NomSeeder
php artisan make:factory NomFactory
php artisan migrate:fresh --seed
```

---

## 🧩 CRUD Complet (Contrôleurs, Routes, Vues)

### Contrôleur CRUD :
```bash
php artisan make:controller ProductController --resource
```

### Routes CRUD :
```php
Route::resource('products', ProductController::class);
```

### Méthodes du contrôleur :
- `index()` : afficher tous
- `create()` : formulaire création
- `store(Request $request)` : enregistrer
- `edit($id)` : formulaire édition
- `update(Request $request, $id)` : mise à jour
- `destroy($id)` : suppression
- `show($id)` : afficher un élément

---

## ⚙️ Méthodes Eloquent importantes
```php
Model::all();              // Tous les enregistrements
Model::find($id);          // Trouver par ID
Model::create([...]);      // Créer
$model->update([...]);     // Modifier
$model->delete();          // Supprimer
Model::where(...)->get(); // Filtrer
```

---

## 🖼️ Utilisation de Blade (vues)

Dans `resources/views/products/index.blade.php` :
```blade
@foreach($products as $product)
  <tr>
    <td>{{ $product->name }}</td>
    <td>
      <a href="{{ route('products.edit', $product->id) }}">Modifier</a>
      <form action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button>Supprimer</button>
      </form>
    </td>
  </tr>
@endforeach
```

---

## 🔄 Travailler avec les données dans les vues

### Afficher une donnée dans la vue :
```blade
{{ $product->name }}
```

### Formulaire de création :
```blade
<form action="{{ route('products.store') }}" method="POST">
  @csrf
  <input type="text" name="name">
  <button type="submit">Créer</button>
</form>
```

### Formulaire de mise à jour :
```blade
<form action="{{ route('products.update', $product->id) }}" method="POST">
  @csrf
  @method('PUT')
  <input type="text" name="name" value="{{ old('name', $product->name) }}">
  <button type="submit">Mettre à jour</button>
</form>
```

### Récupérer et envoyer les données dans le contrôleur :
```php
public function store(Request $request)
{
    Product::create($request->validate([
        'name' => 'required|string|max:255'
    ]));
    return redirect()->route('products.index');
}

public function update(Request $request, Product $product)
{
    $product->update($request->validate([
        'name' => 'required|string|max:255'
    ]));
    return redirect()->route('products.index');
}
```

### Supprimer une donnée :
```php
public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index');
}
```

---

## 🛠️ Compilation avec Vite (CSS/JS)

### Installer les dépendances :
```bash
npm install
```

### Compiler :
```bash
npm run dev     # en développement
npm run build   # version optimisée
```

Inclure dans Blade :
```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

---

## 🧪 Utilisation avancée des Factories

### `sequence()` : pour générer des valeurs cycliques
```php
use Illuminate\Database\Eloquent\Factories\Sequence;

$factory->count(3)->state(new Sequence(
    ['status' => 'draft'],
    ['status' => 'published'],
    ['status' => 'archived'],
))->create();
```

### `name` ou autres champs dynamiques
```php
'name' => $this->faker->name,
'email' => $this->faker->unique()->safeEmail,
```

### Lier à un autre modèle (relation automatique)
```php
'user_id' => User::factory(),
```

### Ajouter des valeurs spécifiques ou conditionnelles
```php
return [
    'title' => $this->faker->sentence,
    'content' => $this->faker->paragraph,
    'status' => $this->faker->randomElement(['draft', 'published']),
];
```

---

🔐 Connexion, Authentification et Sessions (avec Laravel Breeze)
1. Installation de Laravel Breeze
Laravel Breeze fournit une authentification simple avec Blade :

bash
Copier
Modifier
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
Cela ajoute :

Un système d’authentification complet (register, login, logout, etc.)

Des vues Blade pour l’inscription et la connexion

La gestion des sessions

2. Middleware d’authentification
Pour restreindre l'accès à certaines routes aux utilisateurs connectés :

php
Copier
Modifier
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});
Cela signifie que seuls les utilisateurs authentifiés peuvent accéder aux routes products.

3. Utilisateur connecté dans les vues
Tu peux accéder à l'utilisateur connecté dans Blade :

blade
Copier
Modifier
@auth
    <p>Bienvenue, {{ Auth::user()->name }}</p>
@endauth

@guest
    <a href="{{ route('login') }}">Se connecter</a>
@endguest
4. Vérifier l’utilisateur dans les contrôleurs
Dans un contrôleur, pour accéder à l’utilisateur connecté :

php
Copier
Modifier
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
5. Forcer la connexion, déconnexion
php
Copier
Modifier
Auth::login($user);    // Connecter manuellement un utilisateur
Auth::logout();        // Déconnecter
6. Protection CSRF et gestion des sessions
Laravel protège automatiquement les formulaires avec des jetons CSRF :

blade
Copier
Modifier
<form method="POST">
    @csrf
</form>
Les données de session (comme l’état de l’utilisateur connecté) sont stockées automatiquement, soit dans le fichier, soit dans la base de données si tu actives cette option dans config/session.php

Ce README est un **rappel complet** pour ton projet Laravel. Tu peux le mettre dans ton dépôt Git ou dossier de projet pour toujours l’avoir sous la main !

