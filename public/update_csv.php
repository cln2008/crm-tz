<?php
require_once "../vendor/autoload.php";

use App\CSV\CSV;

$sourceFile = "MOCK_DATA_TEST_TI.csv";
$newFile    = "MOCK_DATA_TEST_TI_new.csv";

$csv = new CSV($sourceFile);

$data = $csv->get();

foreach ($data as $k => $v) {
    if ($k > 0) {
        $data[$k][6] = preg_replace("/[^0-9]/", '', $v[6]);

        if ($data[$k][8]) {
            $data[$k][8] = (new \DateTime($v[8]))->format('d.m.Y');
        }
    }
}

$csv
    ->setNewCsvFile($newFile)
    ->set($data);




