<?php


namespace App\CRM;


class Activities
{
    public static function getHtml($entity, $relatedObjects)
    {
        $htmlString = "<h3>Activities</h3>";
        $htmlString .= "<table border='1' style='border-collapse: collapse;'>";
        $htmlString .= "<tr>
                            <th>Тема</th>
                            <th>Сделка</th>
                            <th>Контактное лицо</th>
                            <th>Эл. почта</th>
                            <th>Телефон</th>
                            <th>Организация</th>
                            <th>Срок выполнения</th>
                            <th>Продолжительность</th>
                            <th>Назначени пользователю</th>
                        </tr>";

        foreach ($entity as $item) {

            $pers = self::getContacts($item, $relatedObjects);

            $htmlString .= "<tr>
                             <td>{$item['subject']}</td>
                             <td>{$item['deal_title']}</td>
                             <td>{$pers['person']}</td>
                             <td>{$pers['email']}</td>
                             <td>{$pers['phone']}</td>
                             <td>{$item['org_name']}</td>
                             <td>{$item['due_date']}</td>
                             <td>{$item['duration']}</td>
                             <td>{$item['owner_name']}</td>
                            </tr>";

        }

        $htmlString .= "</table>";

        return $htmlString;
    }

    private static function getContacts($data, $relatedObjects)
    {
        if( $data['participants'] ) {
            $persName = "<ul>";
            foreach ($data['participants'] as $row) {
                $personId = $row['person_id'];
                $person = $relatedObjects['person'][$personId];
                $persName .= "<li>{$person['name']}</li>";

                $emailString = ($person['email'][0]['value']) ? self::getInfo($person['email']) : "";
                $phoneString = ($person['phone'][0]['value']) ? self::getInfo($person['phone']) : "";

            }
            $persName .= "</ul>";
            $ret['person'] = $persName;
            $ret['email'] = $emailString;
            $ret['phone'] = $phoneString;
        } else {
            $ret = [
                'person' => "",
                'email'  => "",
                'phone'  => "",
            ];
        }

        return $ret;
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
}