<?php


namespace App\CSV;


class CSV
{
    private $_csvFile    = null;
    private $_newCsvFile = null;


    public function __construct($csvFile) {
        if (file_exists($csvFile)) {
            $this->_csvFile = $csvFile;
        }
        else {
            throw new Exception("Файл {$csvFile} не найден");
        }
    }


    public function setNewCsvFile($name)
    {
        $this->_newCsvFile = $name;
        return $this;
    }

    public function get()
    {
        $fp = fopen($this->_csvFile, "r");

        $arrayFile = array();
        while (($line = fgetcsv($fp, 0, ",")) !== FALSE) {
            $arrayFile[] = $line;
        }

        fclose($fp);
        return $arrayFile;
    }

    public function set($data)
    {
        $fp = fopen($this->_newCsvFile, "w");
        foreach ($data as $row) {
            fputcsv($fp, $row);
        }

        fclose($fp);
    }
}