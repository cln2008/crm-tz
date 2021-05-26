<?php
require_once "../vendor/autoload.php";

use App\CRM\CRMClient;
use App\CRM\Persons;
use App\CRM\Notes;
use App\CRM\Organizations;
use App\CRM\Deals;
use App\CRM\Activities;


$client = new CRMClient();
$notes  = new Notes();

$notesData = $client
    ->setEntity("notes")
    ->setRequestUrl()
    ->get();

if (intval($notesData['success']) === 1) {
    $notes->setNotes($notesData['data']);
}

$persons = $client
    ->setEntity("persons")
    ->setRequestUrl()
    ->get();

$orgs = $client
    ->setEntity("organizations")
    ->setRequestUrl()
    ->get();

$deals = $client
    ->setEntity("deals")
    ->setRequestUrl()
    ->get();

$tasks = $client
    ->setEntity("activities")
    ->setRequestUrl()
    ->get();

if ($orgs['success']) {
    $htmlOrgs = Organizations::getHtml($orgs['data'], $notes->orgNotes);
}

if ($persons['success']) {
    $htmlPers = Persons::getHtml($persons['data'], $notes->personNotes);
}

if ($deals['success']) {
    $htmlDeals = Deals::getHtml($deals['data'], $notes->dealNotes);
}

if ($tasks['success']) {
    $htmlTasks = Activities::getHtml($tasks['data'], $tasks['related_objects']);
}

echo $htmlOrgs . "<hr>" . $htmlPers . "<hr>" . $htmlDeals . "<hr>" . $htmlTasks;
