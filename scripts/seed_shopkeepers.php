<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit("Not found.\n");
}

require_once __DIR__ . '/../config/database.php';

$names = [
    'Maa Tara Enterprise',
    'New Town Store',
    'Kolkata Traders',
    'City Mart',
    'Saha Enterprise',
    'Das General Store',
    'Bengal Traders',
    'Friends Enterprise',
];

$pdo = database();
$insert = $pdo->prepare(
    'INSERT INTO shopkeepers (name)
     SELECT :name
     WHERE NOT EXISTS (
         SELECT 1 FROM shopkeepers WHERE name = :existing_name LIMIT 1
     )'
);

$inserted = 0;
$pdo->beginTransaction();

try {
    foreach ($names as $name) {
        $insert->execute([
            'name' => $name,
            'existing_name' => $name,
        ]);
        $inserted += $insert->rowCount();
    }

    $pdo->commit();
} catch (Throwable $exception) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    throw $exception;
}

fwrite(STDOUT, sprintf("Shopkeeper seeder complete. Inserted %d new records; existing names were left unchanged.\n", $inserted));
