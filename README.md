# Gestion de Chantier

Application de gestion de chantier développée avec Laravel 12, PHP 8.2, MySQL/MariaDB et Vite/Tailwind.

Le projet permet de gérer :
- les employés,
- les tâches de chantier,
- les absences,
- les évaluations,
- les congés,
- les utilisateurs et leurs rôles,
- les entrées/sorties de matériel.

---

## 1. Objectif du projet

Cette application est destinée à la gestion d’une entreprise ou d’un site de chantier avec plusieurs profils d’utilisateurs :
- Administrateur
- Chef de chantier
- Chef d’équipe
- Directeur

Chaque rôle a un accès spécifique selon les permissions définies dans les middlewares et les routes.

---

## 2. Stack technique

- PHP 8.2
- Laravel 12
- MySQL / MariaDB
- Composer
- Node.js + npm
- Vite
- Tailwind CSS
- Blade templates

---

## 3. Prérequis

### Windows (recommandé avec XAMPP)

Il faut avoir installé :
- PHP 8.2
- Composer
- MySQL / MariaDB
- Node.js + npm

Exemple de configuration recommandée :
- PHP : `C:\xampp\php\php.exe`
- MySQL : `C:\xampp\mysql\bin\mysql.exe`

### Vérification rapide

Dans PowerShell :

```powershell
php -v
composer --version
node -v
npm -v
```

Si `php` et `composer` ne sont pas reconnus, ajoutez leur emplacement dans la variable PATH du système, ou utilisez directement le chemin complet vers PHP.

---

## 4. Installation depuis zéro

### 4.1. Cloner le projet

```bash
git clone <url-du-projet>
cd "Gestion de chantier"
```

### 4.2. Créer le fichier d’environnement

```powershell
Copy-Item .env.example .env
```

Ou sous Linux/macOS :

```bash
cp .env.example .env
```

### 4.3. Configurer la base de données

Ouvrez le fichier `.env` et vérifiez ces lignes :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=suivi_personel_db
DB_USERNAME=root
DB_PASSWORD=
```

Puis créez la base de données MySQL si elle n’existe pas :

```powershell
C:\xampp\mysql\bin\mysql.exe -uroot -e "CREATE DATABASE IF NOT EXISTS suivi_personel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 4.4. Installer les dépendances PHP

```powershell
C:\xampp\php\php.exe composer.phar install
```

Si Composer est installé globalement :

```powershell
composer install
```

### 4.5. Installer les dépendances JavaScript

```powershell
npm install
```

Pour construire les assets de production :

```powershell
npm run build
```

Pour lancer le mode développement Vite :

```powershell
npm run dev
```

---

## 5. Initialiser l’application

### 5.1. Générer la clé Laravel

```powershell
C:\xampp\php\php.exe artisan key:generate
```

### 5.2. Créer les tables et remplir les données de test

```powershell
C:\xampp\php\php.exe artisan migrate --seed
```

Si vous voulez repartir sur une base vide :

```powershell
C:\xampp\php\php.exe artisan migrate:fresh --seed
```

### 5.3. Créer le lien vers le stockage public

```powershell
C:\xampp\php\php.exe artisan storage:link
```

---

## 6. Lancement du projet

### Lancer le serveur Laravel

```powershell
cd "C:\Users\M.c\Desktop\ali\Gestion de chantier"
C:\xampp\php\php.exe artisan serve --host=127.0.0.1 --port=8000
```

Ensuite ouvrez :

```text
http://127.0.0.1:8000
```

### Lancer le serveur Vite (pour le développement frontend)

Dans un autre terminal :

```powershell
cd "C:\Users\M.c\Desktop\ali\Gestion de chantier"
npm run dev
```

---

## 7. Comptes de démonstration

Le seeder génère un utilisateur de test avec les informations suivantes :

- Email : `test@example.com`
- Mot de passe : `password`

Cela permet de tester rapidement l’authentification et les rôles.

---

## 8. Fonctionnement général du projet

### 8.1. Authentification

Le projet utilise le système d’authentification de Laravel avec les vues de Breeze. Les routes principales sont dans :
- `routes/web.php`
- `routes/auth.php`

Les contrôleurs d’authentification sont dans :
- `app/Http/Controllers/Auth/`

### 8.2. Gestion des rôles

Les accès sont sécurisés via des middlewares et des routes protégées :
- `admin`
- `chef_chantier`
- `chef_equipe`
- `directeurs`

Les règles de rôle sont définies dans les fichiers du dossier :
- `app/Http/Middleware/`

### 8.3. Modèle de données

Les modèles principaux sont dans :
- `app/Models/Employee.php`
- `app/Models/User.php`
- `app/Models/Task.php`
- `app/Models/Absence.php`
- `app/Models/Evaluation.php`
- `app/Models/Leave.php`
- `app/Models/Material.php`
- `app/Models/MaterialEntree.php`
- `app/Models/MaterialSortie.php`

### 8.4. Base de données et migrations

Les migrations sont dans le dossier :
- `database/migrations/`

Les données de base sont alimentées par :
- `database/seeders/DatabaseSeeder.php`

### 8.5. Vues et interface utilisateur

Les templates Blade sont dans :
- `resources/views/`

Les assets front sont dans :
- `resources/css/`
- `resources/js/`

Vite compile ensuite ces fichiers pour afficher l’interface.

### 8.6. Routes principales

Le projet contient plusieurs zones selon le profil utilisateur :
- `/admin/...` pour l’administrateur
- `/chef-chantier/...` pour le chef de chantier
- `/chef-equipe/...` pour le chef d’équipe
- `/directeur/...` pour les directeurs

La configuration est centralisée dans :
- `routes/web.php`

---

## 9. Structure du projet

```text
.
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── lang/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
├── storage/
├── tests/
├── .env
├── .env.example
├── artisan
├── composer.json
├── package.json
├── vite.config.js
├── phpunit.xml
└── README.md
```

---

## 10. Dépannage

### Erreur : base de données inconnue

```text
SQLSTATE[HY000] [1049] Unknown database 'suivi_personel_db'
```

Solution :

```powershell
C:\xampp\mysql\bin\mysql.exe -uroot -e "CREATE DATABASE IF NOT EXISTS suivi_personel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Erreur : la commande `php` n’est pas reconnue

Utilisez le chemin complet :

```powershell
C:\xampp\php\php.exe artisan --version
```

### Erreur : dépendances PHP manquantes

```powershell
composer install
```

### Erreur : dépendances Node manquantes

```powershell
npm install
```

### Erreur : `npm run build` échoue

Vérifiez que :
- Node.js est installé,
- le dossier `node_modules` est présent,
- le projet est bien à la racine du dépôt.

### Serveur Laravel non accessible

Vérifiez que le serveur est bien démarré :

```powershell
C:\xampp\php\php.exe artisan serve --host=127.0.0.1 --port=8000
```

---

## 11. Commandes utiles

### Base de données

```powershell
C:\xampp\php\php.exe artisan migrate
C:\xampp\php\php.exe artisan migrate:fresh --seed
C:\xampp\php\php.exe artisan db:seed
```

### Tests

```powershell
C:\xampp\php\php.exe artisan test
```

### Cache

```powershell
C:\xampp\php\php.exe artisan config:clear
C:\xampp\php\php.exe artisan cache:clear
```

### Frontend

```powershell
npm run dev
npm run build
```

---

## 12. Résumé rapide

Pour lancer le projet sur un PC Windows depuis zéro :

```powershell
cd "C:\Users\M.c\Desktop\ali\Gestion de chantier"
Copy-Item .env.example .env
C:\xampp\mysql\bin\mysql.exe -uroot -e "CREATE DATABASE IF NOT EXISTS suivi_personel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
composer install
npm install
C:\xampp\php\php.exe artisan key:generate
C:\xampp\php\php.exe artisan migrate --seed
C:\xampp\php\php.exe artisan serve --host=127.0.0.1 --port=8000
```

Puis ouvrir :

```text
http://127.0.0.1:8000
```

---

## 13. Licence

Ce projet est un projet Laravel d’application de gestion interne. La licence dépendra du contexte de votre organisation ou du choix du client.

---

## 14. Remarque finale

Ce README a été rédigé pour faciliter le démarrage du projet sur un poste de développement local, avec une configuration simple et reproductible. Il est conseillé de conserver ce fichier à jour lors des évolutions du projet.
