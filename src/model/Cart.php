<?php

namespace model;

use Exception;

class Cart {

    private $stayLength;
    private $booking;
    private $numRooms;
    private $adults;
    private $children;

    /**
     * @return mixed
     */
    public function getAdults() {
        return $this->adults;
    }

    /**
     * @param mixed $adults
     */
    public function setAdults($adults) {
        $this->adults = $adults;
    }

    /**
     * @return Booking
     */
    public function getBooking() {
        return $this->booking;
    }

    /**
     * @param Booking $booking
     */
    public function setBooking(Booking $booking) {
        $this->booking = $booking;
    }

    /**
     * @return mixed
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children) {
        $this->children = $children;
    }

    /**
     * @return mixed
     */
    public function getNumRooms() {
        return $this->numRooms;
    }

    /**
     * @param mixed $numRooms
     */
    public function setNumRooms($numRooms) {
        $this->numRooms = $numRooms;
    }

    /**
     * @return mixed
     */
    public function getStayLength() {
        return $this->stayLength;
    }

    /**
     * @param mixed $stayLength
     */
    public function setStayLength($stayLength) {
        $this->stayLength = $stayLength;
    }

    public function saveCart() {
        $alert = array();

        try {
            $booking = $this->getBooking();
            $booking->save_();
        }
        catch(Exception $e) {
            $alert['message'] = $e->getMessage();
            $alert['type'] = 'alert-danger';
            return $alert;
        }

        $alert['message'] = 'Your order has been processed. Customer id: ' . $booking->getCustomer()->getId();
        $alert['type'] = 'alert-success';

        return $alert;
    }

}
 