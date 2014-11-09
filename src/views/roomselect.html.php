<h1>Select a room</h1>

<form role="form" id="room_type_form" method="post">
    <input type="hidden" id="stay_length" name="stay_length" value="<?php echo $this->cart->getStayLength() ?>">
    <input type="hidden" id="num_rooms" name="num_rooms" value="<?php echo $this->cart->getNumRooms() ?>">
    <div class="form-group">
        <label for="stay_cost">Estimated Cost:</label>
        <span id="stay_cost" class="text-primary form-control-static"></span>
    </div>
    <?php foreach($this->rooms as $room) { ?>
    <div class="radio">
        <label>
            <input onclick="calcEstimatedCost();" type="radio" name="room_type" value="<?php echo $room->getRoomType()->getValue() ?>"/>
            <?php echo $room->getRoomType()->getValue() ?> -- $<span id="<?php echo $room->getRoomType()->getValue() ?>_rate" class="rate"><?php echo $room->getNightlyRate() ?></span>
        </label>
    </div>
    <?php } ?>
    <button type="submit" class="btn btn-primary" name="room_type_form">Submit</button>
</form>