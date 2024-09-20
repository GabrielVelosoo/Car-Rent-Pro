Start-Sleep -Seconds 10

$mysqlReady = $false
while (-not $mysqlReady) {
    try {
        $connection = New-Object System.Data.SqlClient.SqlConnection("Server=mysql;Database=car_rent_pro;User Id=user;Password=password;")
        $connection.Open()
        $mysqlReady = $true
        $connection.Close()
    } catch {
        Write-Host "Aguardando o MySQL estar disponível..."
        Start-Sleep -Seconds 2
    }
}

php artisan storage:link
php-fpm