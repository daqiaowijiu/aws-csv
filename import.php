<?php

$s3 = Aws\S3\S3Client::factory($config);
$s3->registerStreamWrapper();
$url = 's3://{$bucket}/{$key}';
// Read CSV with fopen
$file = fopen($url, 'r');
$keys = fgetcsv($file);
while (!feof($file)) {
    $row = array_combine($keys, fgetcsv($file));
    print_r($row);
}
// Read CSV with SplFileObject
$file = new \SplFileObject($url, 'r');
$keys = $file->fgetcsv();
while (!$file->eof()) {
    $row = array_combine($keys, $file->fgetcsv());
    print_r($row);
}