<?php

namespace App\CRM;


class Notes
{

    public $dealNotes   = array();
    public $personNotes = array();
    public $orgNotes    = array();

    public function setNotes($data)
    {
        foreach ($data as $item) {

            if ( $item['deal_id'] ) {
                if (!isset($this->dealNotes[$item['deal_id']])) {
                    $this->dealNotes[$item['deal_id']] = array();
                }
                array_push( $this->dealNotes[$item['deal_id']], $item['content']);
            }

            if ($item['person_id']) {
                if (!isset($this->personNotes[$item['person_id']])) {
                    $this->personNotes[$item['person_id']] = array();
                }
                array_push( $this->personNotes[$item['person_id']], $item['content']);
            }

            if ($item['org_id']) {
                if (!isset($this->orgNotes[$item['org_id']])) {
                    $this->orgNotes[$item['org_id']] = array();
                }
                array_push( $this->orgNotes[$item['org_id']], $item['content']);
            }

        }
    }
}