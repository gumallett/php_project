<?php

$booking = $this->cart->getBooking();
$length = $this->cart->getStayLength();
$rate = $booking->getRoom()->getNightlyRate();
$numRooms = $this->cart->getNumRooms();
$cost = number_format($length * $rate * $numRooms, 2);

?>

<h1>CONFIRMATION</h1>

<div class="well well-lg">
    <form role="form">
        <div class="form-group">
            <label for="stay_period">Stay Period:</label>
            <div class="col-sm-12">
                <p id="stay_period" class="form-control-static">
                    <?php echo $length ?> day(s)<br/>
                    <?php echo $booking->getStartDate()->format('m/d/Y') ?> -- <?php echo $booking->getEndDate()->format('m/d/Y') ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="rooms">Selected Room:</label>
            <div class="col-sm-12">
                <p id="rooms" class="form-control-static">
                    <?php echo $booking->getRoom()->getRoomType()->getValue() ?>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="cost">Estimated Cost:</label>
            <div class="col-sm-12">
                <p id="cost" class="form-control-static">
                    $<?php echo $cost ?>
                </p>
            </div>
        </div>
    </form>
</div>