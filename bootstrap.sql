SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `gregmallettdatabase`;
USE `gregmallettdatabase` ;

-- GRANT SELECT, INSERT, DELETE, UPDATE ON gregmallettdatabase.* TO gregmallett@localhost IDENTIFIED BY 'gregmallettpass';

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `hotels`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `hotels` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `address` VARCHAR(45) NULL ,
  `city` VARCHAR(45) NULL ,
  `state` VARCHAR(45) NULL ,
  `zip` VARCHAR(45) NULL ,
  `phone` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `room_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `room_type` (
  `id` INT NOT NULL ,
  `value` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `type_UNIQUE` (`value` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rooms`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `rooms` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nightly_rate` DECIMAL(10,2) NOT NULL ,
  `hotel_id` INT NOT NULL ,
  `room_type_id` INT NOT NULL ,
  `capacity` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `room_hotel_fk_idx` (`hotel_id` ASC) ,
  INDEX `room_type_fk_idx` (`room_type_id` ASC) ,
  CONSTRAINT `room_hotel_fk`
    FOREIGN KEY (`hotel_id` )
    REFERENCES `hotels` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `room_type_fk`
    FOREIGN KEY (`room_type_id` )
    REFERENCES `room_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `customers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `customers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `address` VARCHAR(45) NULL ,
  `city` VARCHAR(45) NULL ,
  `state` VARCHAR(45) NULL ,
  `zip` VARCHAR(45) NULL ,
  `phone` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookings`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bookings` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `room_id` INT NOT NULL ,
  `start_date` DATETIME NOT NULL ,
  `end_date` DATETIME NOT NULL ,
  `customer_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `booking_room_fk_idx` (`room_id` ASC) ,
  INDEX `booking_cust_fk_idx` (`customer_id` ASC) ,
  CONSTRAINT `booking_room_fk`
    FOREIGN KEY (`room_id` )
    REFERENCES `rooms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `booking_cust_fk`
    FOREIGN KEY (`customer_id` )
    REFERENCES `customers` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `hotels`
-- -----------------------------------------------------
START TRANSACTION;
USE `gregmallettdatabase`;
INSERT INTO `hotels` (`id`, `name`, `address`, `city`, `state`, `zip`, `phone`, `email`) VALUES (1, 'gregmalletthotel', '5 hotel way', 'bloomfield', 'nj', '07003', '(555) 555-5555', 'gregmalletthotel@gmail.com');

COMMIT;

-- -----------------------------------------------------
-- Data for table `room_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `gregmallettdatabase`;
INSERT INTO `room_type` (`id`, `value`) VALUES (1, 'double');
INSERT INTO `room_type` (`id`, `value`) VALUES (2, 'king');
INSERT INTO `room_type` (`id`, `value`) VALUES (3, 'suite');
INSERT INTO `room_type` (`id`, `value`) VALUES (4, 'penthouse');

COMMIT;

-- -----------------------------------------------------
-- Data for table `rooms`
-- -----------------------------------------------------
START TRANSACTION;
USE `gregmallettdatabase`;
INSERT INTO `rooms` (`id`, `nightly_rate`, `hotel_id`, `room_type_id`, `capacity`) VALUES (1, 99, 1, 1, 5);
INSERT INTO `rooms` (`id`, `nightly_rate`, `hotel_id`, `room_type_id`, `capacity`) VALUES (2, 109, 1, 2, 5);
INSERT INTO `rooms` (`id`, `nightly_rate`, `hotel_id`, `room_type_id`, `capacity`) VALUES (3, 199, 1, 3, 2);
INSERT INTO `rooms` (`id`, `nightly_rate`, `hotel_id`, `room_type_id`, `capacity`) VALUES (4, 399, 1, 4, 1);

COMMIT;
