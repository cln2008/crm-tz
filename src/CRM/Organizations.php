<?php


namespace App\CRM;


class Organizations
{

    private static $labs = [
        5 => 'Customer',
        6 => 'Hot lead',
        7 => 'Warm lead',
        8 => 'Cold lead',

    ];

    public static function getHtml($entity, $notes)
    {
        $htmlString  = "<h3>Organizations</h3>";
        $htmlString .= "<table border='1' style='border-collapse: collapse;'>";
        $htmlString .= "<tr>
                            <th>Имя</th>
                            <th>Метка</th>
                            <th>Адрес</th>
                            <th>Контакты</th>
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

            $htmlString .= "<tr>
                             <td>{$item['name']}</td>
                             <td>{$label}</td>
                             <td>{$item['address']}</td>
                             <td>{$item['people_count']}</td>
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