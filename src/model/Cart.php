<?php

namespace model;

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


}
 