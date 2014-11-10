<?php

$booking = $this->cart->getBooking();
$length = $this->cart->getStayLength();
$rate = $booking->getRoom()->getNightlyRate();
$numRooms = $this->cart->getNumRooms();
$cost = number_format($length * $rate * $numRooms, 2);

?>

<h1>Confirmation</h1>

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

<?php if(isset($this->alert['message'])) { ?>
    <div class="alert <?php echo $this->alert['type'] ?>" role="alert">
        <?php echo $this->alert['message'] ?>
    </div>
<?php } ?>

<?php if(!isset($this->alert['message']) || $this->alert['type'] != 'alert-success') { ?>
<form id="customer_form" role="form" method="post" onsubmit="return validate(this);" novalidate>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" class="form-control" required/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" name="city" id="city" class="form-control" required/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" name="state" id="state" class="form-control" required/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="zip">Zip:</label>
                <input type="text" name="zip" id="zip" class="form-control" required/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" class="form-control" required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary">Submit</button>
    </div>

</form>
<?php } ?>