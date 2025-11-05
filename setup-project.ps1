# setup-project.ps1
Write-Host "🔧 STU Key Management Project Setup" -ForegroundColor Green

# Check if composer.json exists
if (-not (Test-Path "composer.json")) {
    Write-Host "❌ Not a Laravel project directory" -ForegroundColor Red
    exit 1
}

# Install PHP dependencies
Write-Host "📦 Installing Composer dependencies..." -ForegroundColor Yellow
composer install

# Generate application key
Write-Host "🔑 Generating application key..." -ForegroundColor Yellow
php artisan key:generate

# Create storage link
Write-Host "📁 Creating storage link..." -ForegroundColor Yellow
php artisan storage:link

# Publish vendor files
Write-Host "📄 Publishing vendor configurations..." -ForegroundColor Yellow
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"

Write-Host "✅ Project setup complete!" -ForegroundColor Green
Write-Host "➡️ Next steps:" -ForegroundColor Cyan
Write-Host "  1. Configure your .env file with database credentials" -ForegroundColor Cyan
Write-Host "  2. Run: php artisan migrate --seed" -ForegroundColor Cyan
Write-Host "  3. Run: php artisan serve" -ForegroundColor Cyan
