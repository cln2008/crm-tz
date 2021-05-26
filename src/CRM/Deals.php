<?php


namespace App\CRM;


class Deals
{
    public static function getHtml($entity, $notes)
    {
        $htmlString  = "<h3>Deals</h3>";
        $htmlString .= "<table border='1' style='border-collapse: collapse;'>";
        $htmlString .= "<tr>
                            <th>Заголовок</th>
                            <th>Стоимость</th>
                            <th>Организация</th>
                            <th>Контактное лицо</th>
                            <th>Ожидаемая дата закрытия</th>
                            <th>Дата следующей задачи</th>
                            <th>Владелец</th>
                            <th>Notes</th>
                        </tr>";

        foreach ($entity as $item) {

            $notesHtml = ($item['notes_count'])
                ? self::getNotes($notes[$item['id']])
                : "";

            $orgName  = ($item['org_id']) ? $item['org_id']['name'] : "";
            $persName = ($item['person_id']) ? $item['person_id']['name'] : "";

            $htmlString .= "<tr>
                             <td>{$item['title']}</td>
                             <td>{$item['formatted_value']}</td>
                             <td>{$orgName}</td>
                             <td>{$persName}</td>
                             <td>{$item['expected_close_date']}</td>
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