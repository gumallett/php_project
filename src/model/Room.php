<?php

namespace model;

use phporm\Record;

/**
 * {@Table(name='rooms')}
 */
class Room extends Record {

    public static $__CLASS__ = __CLASS__;

    private $id;
    private $nightly_rate;
    private $capacity;

    /**
     * {@ManyToOne}
     */
    private $room_type;

    /**
     * @return mixed
     */
    public function getCapacity() {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNightlyRate() {
        return $this->nightly_rate;
    }

    /**
     * @param mixed $nightly_rate
     */
    public function setNightlyRate($nightly_rate) {
        $this->nightly_rate = $nightly_rate;
    }

    /**
     * @return mixed
     */
    public function getRoomType() {
        return $this->room_type;
    }

    /**
     * @param mixed $room_type
     */
    public function setRoomType($room_type) {
        $this->room_type = $room_type;
    }


} 