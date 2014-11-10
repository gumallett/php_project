<?php

namespace model;
use phporm\Record;
use DateTime;

/**
 * {@Table(name='bookings')}
 */
class Booking extends Record {

    public static $__CLASS__ = __CLASS__;

    private $id;
    private $cost;

    /**
     * {@Temporal}
     */
    private $start_date;

    /**
     * {@Temporal}
     */
    private $end_date;

    /**
     * {@ManyToOne}
     */
    private $room;

    /**
     * {@ManyToOne}
     */
    private $customer;

    /**
     * @return Customer
     */
    public function getCustomer() {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer($customer) {
        $this->customer = $customer;
    }

    /**
     * @return DateTime
     */
    public function getEndDate() {
        return $this->end_date;
    }

    /**
     * @param DateTime $end_date
     */
    public function setEndDate(DateTime $end_date) {
        $this->end_date = $end_date;
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
     * @return Room
     */
    public function getRoom() {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom(Room $room) {
        $this->room = $room;
    }

    /**
     * @return DateTime
     */
    public function getStartDate() {
        return $this->start_date;
    }

    /**
     * @param DateTime $start_date
     */
    public function setStartDate(DateTime $start_date) {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getCost() {
        return $this->cost;
    }

    /**
     * @param mixed $cost
     */
    public function setCost($cost) {
        $this->cost = $cost;
    }



}
 