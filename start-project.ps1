$ErrorActionPreference = "Stop"

$projectPath = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $projectPath

Write-Host "==================================================" -ForegroundColor Cyan
Write-Host "Démarrage du projet Gestion de Chantier" -ForegroundColor Cyan
Write-Host "==================================================" -ForegroundColor Cyan

if (-not (Test-Path ".env")) {
    Copy-Item ".env.example" ".env"
    Write-Host "Fichier .env créé à partir de .env.example" -ForegroundColor Yellow
}

$phpExe = "C:\xampp\php\php.exe"
$mysqlExe = "C:\xampp\mysql\bin\mysql.exe"

if (-not (Test-Path $phpExe)) {
    Write-Error "PHP introuvable à $phpExe. Installez XAMPP ou configurez le chemin de PHP."
    exit 1
}

if (-not (Test-Path $mysqlExe)) {
    Write-Error "MySQL/MariaDB introuvable à $mysqlExe. Installez XAMPP ou configurez le chemin de MySQL."
    exit 1
}

if (-not (Test-Path "vendor")) {
    Write-Host "Installation des dépendances PHP..." -ForegroundColor Yellow
    & $phpExe "composer.phar" install --no-interaction --prefer-dist
}

if (-not (Test-Path "node_modules")) {
    Write-Host "Installation des dépendances Node..." -ForegroundColor Yellow
    npm install
}

$databaseName = "suivi_personel_db"
& $mysqlExe -uroot -e "CREATE DATABASE IF NOT EXISTS $databaseName CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" | Out-Null

Write-Host "Génération de la clé Laravel..." -ForegroundColor Yellow
& $phpExe artisan key:generate --force

Write-Host "Initialisation de la base de données..." -ForegroundColor Yellow
& $phpExe artisan migrate:fresh --seed --force

Write-Host "Création du lien de stockage..." -ForegroundColor Yellow
& $phpExe artisan storage:link

Write-Host "Compilation des assets front..." -ForegroundColor Yellow
npm run build

Write-Host "Lancement du serveur Laravel..." -ForegroundColor Green
Start-Process powershell -ArgumentList "-NoExit","-Command","cd '$projectPath'; & '$phpExe' artisan serve --host=127.0.0.1 --port=8000"

Write-Host "Lancement du serveur Vite (dev)..." -ForegroundColor Green
Start-Process powershell -ArgumentList "-NoExit","-Command","cd '$projectPath'; npm run dev"

Write-Host "" 
Write-Host "Projet prêt !" -ForegroundColor Green
Write-Host "URL admin : http://127.0.0.1:8000/login" -ForegroundColor Green
Write-Host "Identifiants admin : admin@chantier.local / admin123" -ForegroundColor Green
Write-Host "" 
Write-Host "Pour arrêter les serveurs, fermez les fenêtres PowerShell qui ont été ouvertes." -ForegroundColor DarkGray
