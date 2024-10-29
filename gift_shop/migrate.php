<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$serverName = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$database = $_ENV['DB_DATABASE'];
$password = $_ENV['DB_PASSWORD'];



try {
    $conn = new PDO("mysql:host=$serverName;dbname=gift_shop", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



// Fetch executed migrations
$executedMigrations = $conn->query("SELECT * FROM migrations")->fetchAll(PDO::FETCH_ASSOC);
$alreadyExecuted = array_column($executedMigrations, 'migration');

// Scan the migration files in the directory
$migrationFiles = scandir(__DIR__ . '/migrations');
$batch = (int) $conn->query("SELECT MAX(batch) FROM migrations")->fetchColumn() + 1;

foreach ($migrationFiles as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }

    // Convert file name to class name
    $className = ConvertToClassName($file);

    // Check if the migration has already been executed
    if (!in_array($className, $alreadyExecuted)) {
        require __DIR__ . '/migrations/' . $file;
        $migration = new $className();
        $conn->exec($migration->up());
        $conn->exec("INSERT INTO migrations (migration_name, batch) VALUES ('$className', $batch)");
        echo "Migration $className has been executed successfully";
    }
}

function ConvertToClassName($file) {
    // Remove date prefix (assuming date is separated by underscores or hyphens)
    $fileNameWithoutDate = preg_replace('/^\d{4}_\d{2}_\d{2}_/', '', $file);
    $fileNameParts = explode('_', pathinfo($fileNameWithoutDate, PATHINFO_FILENAME));
    
    // Convert parts to a class name
    $className = '';
    foreach ($fileNameParts as $part) {
        $className .= ucfirst($part);
    }
    
    return $className;
}
