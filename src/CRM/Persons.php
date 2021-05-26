<?php
namespace App\CRM;


class Persons
{
    private static $labs = [
        1 => 'Customer',
        2 => 'Hot lead',
        3 => 'Warm lead',
        4 => 'Cold lead',

    ];

    public static function getHtml($entity, $notes)
    {
        $htmlString  = "<h3>Persons</h3>";
        $htmlString .= "<table border='1' style='border-collapse: collapse;'>";
        $htmlString .= "<tr>
                            <th>Имя</th>
                            <th>Метка</th>
                            <th>Организация</th>
                            <th>Эл. почта</th>
                            <th>Телефон</th>
                            <th>Закрытые сделки</th>
                            <th>Открытые сделки</th>
                            <th>Дата следующей задачи</th>
                            <th>Владелец</th>
                            <th>Notes</th>
                        </tr>";

        foreach ($entity as $item) {

            $label = self::$labs[ intval($item['label']) ] ?? "";

            $notesHtml = ($item['notes_count'])
                ? self::getNotes($notes[$item['id']])
                : "";

            $emailString = ($item['email'][0]['value']) ? self::getInfo($item['email']) : "";
            $phoneString = ($item['phone'][0]['value']) ? self::getInfo($item['phone']) : "";
            $orgName     = ($item['org_id']) ? $item['org_id']['name'] : "";


            $htmlString .= "<tr>
                             <td>{$item['name']}</td>
                             <td>{$label}</td>
                             <td>{$orgName}</td>
                             <td>{$emailString}</td>
                             <td>{$phoneString}</td>
                             <td>{$item['closed_deals_count']}</td>
                             <td>{$item['open_deals_count']}</td>
                             <td>{$item['next_activity_date']}</td>
                             <td>{$item['owner_name']}</td>
                             <td>{$notesHtml}</td>
                            </tr>";

        }

        $htmlString .= "</table>";

        return $htmlString;
    }

    private static function getInfo($data)
    {
        $string = "<ul>";
        foreach ($data as $e) {
            $string .= "<li>{$e['value']}</li>";
        }
        $string .= "</ul>";

        return $string;
    }

    private static function getNotes($notes)
    {
        $htmlString = "<ol>";
        foreach ($notes as $note) {
            $htmlString .= "<li>{$note}</li>";
        }
        $htmlString .= "</ol>";

        return $htmlString;
    }
}