
<h1>Customer Info</h1>

<?php if(isset($this->alert['message'])) { ?>
    <div class="alert alert-danger">
        <?php echo $this->alert['message'] ?>
    </div>
<?php } ?>

<?php if($this->customer != null) { ?>
<div class="well well-lg">
    <div class="row">
        <label class="col-sm-2">Name: </label><div class="col-sm-10"><?php echo $this->customer->getName() ?></div>
    </div>
    <div class="row">
        <label class="col-sm-2">Email: </label><div class="col-sm-10"><?php echo $this->customer->getEmail() ?></div>
    </div>

    <br/>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Order Information</strong></div>

                <?php foreach($this->bookings as $booking) { ?>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Order Number:</strong></td>
                                <td><?php echo $booking->getId() ?></td>
                            </tr>
                            <tr>
                                <td><strong>Check In:</strong></td>
                                <td><?php echo $booking->getStartDate()->format('m/d/Y') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Check Out:</strong></td>
                                <td><?php echo $booking->getEndDate()->format('m/d/Y') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Cost:</strong></td>
                                <td>$<?php echo $booking->getCost() ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<?php } ?>
