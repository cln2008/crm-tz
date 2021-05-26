<?php
namespace App\CRM;

interface CRMInterface
{
    public function get(CRMClient $client);
}