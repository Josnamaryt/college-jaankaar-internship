<?php
$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Create connection without database
    $conn = new mysqli($host, $username, $password);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS login_register DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    if (!$conn->query($sql)) {
        throw new Exception("Error creating database: " . $conn->error);
    }
    echo "Database created successfully\n";

    // Select the database
    $conn->select_db('login_register');

    // Read and execute the schema file
    $schema = file_get_contents(__DIR__ . '/schema_update.sql');
    if ($schema === false) {
        throw new Exception("Could not read schema file");
    }

    // Split the schema into individual statements
    $statements = array_filter(array_map('trim', explode(';', $schema)));
    
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            if (!$conn->query($statement)) {
                throw new Exception("Error executing statement: " . $conn->error . "\nStatement: " . $statement);
            }
        }
    }
    echo "Schema imported successfully\n";

    $conn->close();
    echo "Database setup completed successfully!\n";

} catch (Exception $e) {
    die("Setup failed: " . $e->getMessage() . "\n");
}
?>
