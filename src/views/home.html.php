<h1>Welcome to <?php echo $this->hotel->getName() ?></h1>
<div id="room_form">
    <form role="form" method="post">
        <div class="form-group<?php echo isset($this->alert['checkin']) ? ' has-error' : '' ?>">
            <label for="checkin">Check-in</label>
            <input id="checkin" name="checkin" class="form-control" type="date" value="<?php echo $this->checkin ?>"/>
            <?php if(isset($this->alert['checkin'])) { ?>
            <span class="help-block"><?php echo $this->alert['checkin'] ?></span>
            <?php } ?>
        </div>
        <div class="form-group<?php echo isset($this->alert['checkout']) ? ' has-error' : '' ?>">
            <label for="checkout">Check-out</label>
            <input id="checkout" name="checkout" class="form-control" type="date" value="<?php echo $this->checkout ?>"/>
            <?php if(isset($this->alert['checkout'])) { ?>
                <span class="help-block"><?php echo $this->alert['checkout'] ?></span>
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="num_rooms"># of rooms</label>
            <select id="num_rooms" name="num_rooms" class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="num_adults"># of adults</label>
                <select id="num_adults" name="num_adults" class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="num_kids"># of children</label>
                <select id="num_kids" name="num_kids" class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="room_form">Submit</button>
    </form>
</div>

<address>
    <strong><?php echo $this->hotel->getName() ?></strong><br/>
    <?php echo $this->hotel->getAddress() ?><br/>
    <?php echo $this->hotel->getCity() ?>, <?php echo $this->hotel->getState() ?> <?php echo $this->hotel->getZip() ?><br/>
    <?php echo $this->hotel->getPhone() ?><br/>
    <?php echo $this->hotel->getEmail() ?>
</address>