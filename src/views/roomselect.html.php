<h1>Select a room</h1>

<form role="form" id="room_type_form">
    <?php foreach($this->rooms as $room) { ?>
    <div class="radio">
        <label>
            <input type="radio" name="room_type" value="<?php echo $room->getRoomType()->getValue() ?>"/>
            <?php echo $room->getRoomType()->getValue() ?> -- $<?php echo $room->getNightlyRate() ?>
        </label>
    </div>
    <?php } ?>
    <button type="submit" class="btn btn-primary" name="room_type_form">Submit</button>
</form>