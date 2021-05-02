-- -----------------------------------------------------
-- Database honor_flight
-- -----------------------------------------------------
DROP DATABASE IF EXISTS `honor_flight` ;

-- -----------------------------------------------------
-- Database honor_flight
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `honor_flight`;
USE `honor_flight` ;

-- -----------------------------------------------------
-- Table `bus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bus` ;

CREATE TABLE IF NOT EXISTS `bus` (
  `bus_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mission_id` INT(10) UNSIGNED NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `leader_first` VARCHAR(255) NULL DEFAULT NULL,
  `leader_last` VARCHAR(255) NULL DEFAULT NULL,
  `leader_nametag` VARCHAR(45) NULL DEFAULT NULL,
  `leader_phone` VARCHAR(45) NULL DEFAULT NULL,
  `leader_tee` VARCHAR(45) NULL DEFAULT NULL,
  `hs_first` VARCHAR(255) NULL DEFAULT NULL,
  `hs_last` VARCHAR(255) NULL DEFAULT NULL,
  `hs_nametag` VARCHAR(45) NULL DEFAULT NULL,
  `hs_phone` VARCHAR(45) NULL DEFAULT NULL,
  `hs_tee` VARCHAR(45) NULL DEFAULT NULL,
  `gl_first` VARCHAR(255) NULL DEFAULT NULL,
  `gl_last` VARCHAR(255) NULL DEFAULT NULL,
  `gl_nametag` VARCHAR(45) NULL DEFAULT NULL,
  `gl_phone` VARCHAR(45) NULL DEFAULT NULL,
  `gl_tee` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`bus_id`),
  INDEX `mission_bus_fk` (`mission_id` ASC) VISIBLE,
  CONSTRAINT `mission_bus_fk`
    FOREIGN KEY (`mission_id`)
    REFERENCES `mission` (`mission_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `flight`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `flight` ;

CREATE TABLE IF NOT EXISTS `flight` (
  `flight_id` INT(11) NOT NULL,
  `bus_book_id` INT(11) NOT NULL,
  `arrival` DATETIME NULL DEFAULT NULL,
  `departure` DATETIME NULL DEFAULT NULL,
  `flight_number` VARCHAR(45) NULL DEFAULT NULL,
  `airline` VARCHAR(45) NULL DEFAULT NULL,
  `arrival_location` VARCHAR(45) NULL DEFAULT NULL,
  `departure_location` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`flight_id`, `bus_book_id`),
  INDEX `fk_flight_bus_book1` (`bus_book_id` ASC) VISIBLE,
  CONSTRAINT `fk_flight_bus_book1`
    FOREIGN KEY (`bus_book_id`)
    REFERENCES `bus_book` (`bus_book_id`));


-- -----------------------------------------------------
-- Table `guardian`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `guardian` ;

CREATE TABLE IF NOT EXISTS `guardian` (
  `guardian_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NULL DEFAULT NULL,
  `middle_initial` VARCHAR(45) NULL DEFAULT NULL,
  `last_name` VARCHAR(255) NULL DEFAULT NULL,
  `gender` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(255) NULL DEFAULT NULL,
  `city` VARCHAR(255) NULL DEFAULT NULL,
  `state` VARCHAR(45) NULL DEFAULT NULL,
  `zip` VARCHAR(45) NULL DEFAULT NULL,
  `nickname` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `day_phone` VARCHAR(45) NULL DEFAULT NULL,
  `cell_phone` VARCHAR(45) NULL DEFAULT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `occupation` VARCHAR(255) NULL DEFAULT NULL,
  `veteran` TINYINT(1) NULL DEFAULT NULL COMMENT 'Are you a veteran?',
  `branch` TINYTEXT NULL DEFAULT NULL COMMENT 'If a veteran, branch, when and where you served',
  `how_heard` TINYTEXT NULL DEFAULT NULL COMMENT 'How did you hear of Honor Flight?',
  `why_volunteering` TINYTEXT NULL DEFAULT NULL COMMENT 'Please state why you are volunteering',
  `prior_experience` TINYTEXT NULL DEFAULT NULL COMMENT 'Prior volunteer experience',
  `ref_name` VARCHAR(255) NULL DEFAULT NULL,
  `ref_day_phone` VARCHAR(45) NULL DEFAULT NULL,
  `ref_evening_phone` VARCHAR(45) NULL DEFAULT NULL,
  `ref_address` TINYTEXT NULL DEFAULT NULL,
  `ref_relationship` VARCHAR(255) NULL DEFAULT NULL,
  `ref_email` VARCHAR(255) NULL DEFAULT NULL,
  `emergency_name` VARCHAR(255) NULL DEFAULT NULL,
  `emergency_relationship` VARCHAR(255) NULL DEFAULT NULL,
  `emergency_address` TINYTEXT NULL DEFAULT NULL,
  `emergency_day_phone` VARCHAR(45) NULL DEFAULT NULL,
  `emergency_evening_phone` VARCHAR(45) NULL DEFAULT NULL,
  `emergency_cell_phone` VARCHAR(45) NULL DEFAULT NULL,
  `particular_veteran` TINYINT(1) NULL DEFAULT NULL COMMENT 'Are you requesting to travel with a particular veteran? ',
  `vet_name` VARCHAR(255) NULL DEFAULT NULL,
  `vet_relationship` VARCHAR(255) NULL DEFAULT NULL,
  `shirt_size` VARCHAR(45) NULL DEFAULT NULL,
  `push_veteran` TINYINT(1) NULL DEFAULT NULL,
  `med_training` TEXT NULL DEFAULT NULL COMMENT 'Medication experience or training, e.g. EMT, CPR etc',
  `med_conditions` TEXT NULL DEFAULT NULL COMMENT 'Please idfentify any physical disabilities, restrictions, and/or medical conditions that could limit your duties as a guardian',
  `app_date` DATE NULL DEFAULT NULL,
  `diet_restrictions` VARCHAR(255) NULL DEFAULT NULL,
  `administrative_comments` VARCHAR(45) NULL DEFAULT NULL,
  `last_updated` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`guardian_id`));


-- -----------------------------------------------------
-- Table `hotel_info`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `hotel_info` ;

CREATE TABLE IF NOT EXISTS `hotel_info` (
  `hotel_id` INT(11) NOT NULL AUTO_INCREMENT,
  `veteran_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `room` VARCHAR(255) NULL DEFAULT NULL,
  `check_in` DATETIME NULL DEFAULT NULL,
  `check_out` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`hotel_id`),
  INDEX `hotel_info_veteran_veteran_id_fk` (`veteran_id` ASC) VISIBLE,
  CONSTRAINT `hotel_info_veteran_veteran_id_fk`
    FOREIGN KEY (`veteran_id`)
    REFERENCES `veteran` (`veteran_id`));


-- -----------------------------------------------------
-- Table `mission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mission` ;

CREATE TABLE IF NOT EXISTS `mission` (
  `mission_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL DEFAULT NULL,
  `flight_num` VARCHAR(45) NULL DEFAULT NULL,
  `show_on_front` TINYINT(1) NULL DEFAULT 1,
  `start_date` DATE NULL DEFAULT NULL,
  `end_date` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`mission_id`))
COMMENT = 'A mission is considered one flight down the DC.';


-- -----------------------------------------------------
-- Table `team`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `team` ;

CREATE TABLE IF NOT EXISTS `team` (
  `team_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mission_id` INT(10) UNSIGNED NOT NULL,
  `bus_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `leader_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `hs_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `color` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`team_id`),
  INDEX `bus_team_fk` (`bus_id` ASC) VISIBLE,
  INDEX `leader_team_fk` (`leader_id` ASC) VISIBLE,
  INDEX `hs_team_fk` (`hs_id` ASC) VISIBLE,
  INDEX `mission_team_fk` (`mission_id` ASC) VISIBLE,
  CONSTRAINT `bus_team_fk`
    FOREIGN KEY (`bus_id`)
    REFERENCES `bus` (`bus_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `hs_team_fk`
    FOREIGN KEY (`hs_id`)
    REFERENCES `guardian` (`guardian_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `leader_team_fk`
    FOREIGN KEY (`leader_id`)
    REFERENCES `guardian` (`guardian_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `mission_team_fk`
    FOREIGN KEY (`mission_id`)
    REFERENCES `mission` (`mission_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` INT(11) NOT NULL AUTO_INCREMENT,
  `user_type` VARCHAR(45) NOT NULL,
  `user_permissions` INT(11) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `team_id` INT(11) NULL DEFAULT NULL,
  `notes` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`iduser`));


-- -----------------------------------------------------
-- Table `veteran`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `veteran` ;

CREATE TABLE IF NOT EXISTS `veteran` (
  `veteran_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `guardian_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `guardian_relation` VARCHAR(45) NULL DEFAULT NULL,
  `team_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `mission_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `bus_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `first_name` VARCHAR(255) NULL DEFAULT NULL,
  `middle_initial` VARCHAR(45) NULL DEFAULT NULL,
  `last_name` VARCHAR(255) NULL DEFAULT NULL,
  `nickname` VARCHAR(255) NULL DEFAULT NULL,
  `gender` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(255) NULL DEFAULT NULL,
  `city` VARCHAR(255) NULL DEFAULT NULL,
  `state` VARCHAR(255) NULL DEFAULT NULL,
  `zip` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `day_phone` VARCHAR(45) NULL DEFAULT NULL,
  `cell_phone` VARCHAR(45) NULL DEFAULT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `weight` INT(11) NULL DEFAULT NULL,
  `how_heard` TINYTEXT NULL DEFAULT NULL,
  `shirt_size` VARCHAR(45) NULL DEFAULT NULL,
  `alt_name` VARCHAR(255) NULL DEFAULT NULL,
  `alt_phone` VARCHAR(45) NULL DEFAULT NULL,
  `alt_email` VARCHAR(255) NULL DEFAULT NULL,
  `alt_relationship` VARCHAR(45) NULL DEFAULT NULL,
  `emergency_name` VARCHAR(255) NULL DEFAULT NULL,
  `emergency_relationship` VARCHAR(45) NULL DEFAULT NULL,
  `emergency_address` VARCHAR(255) NULL DEFAULT NULL,
  `emergency_day_phone` VARCHAR(45) NULL DEFAULT NULL,
  `emergency_cell_phone` VARCHAR(45) NULL DEFAULT NULL,
  `service_branch` VARCHAR(255) NULL DEFAULT NULL,
  `service_rank` VARCHAR(255) NULL DEFAULT NULL,
  `service_years` VARCHAR(50) NULL DEFAULT NULL,
  `service_ww2` TINYINT(1) NULL DEFAULT NULL,
  `service_korea` TINYINT(1) NULL DEFAULT NULL,
  `service_cold_war` TINYINT(1) NULL DEFAULT NULL,
  `service_vietnam` TINYINT(1) NULL DEFAULT NULL,
  `service_activity` TEXT NULL DEFAULT NULL COMMENT 'Activity During War',
  `med_cane` TINYINT(1) NULL DEFAULT NULL,
  `med_walker` TINYINT(1) NULL DEFAULT NULL,
  `med_wheelchair` TINYINT(1) NULL DEFAULT NULL,
  `med_chair_loc` VARCHAR(255) NULL DEFAULT NULL,
  `med_scooter` TINYINT(1) NULL DEFAULT NULL,
  `med_when_use` TEXT NULL DEFAULT NULL COMMENT 'Please describe when you use mobility equipment',
  `med_list` TEXT NULL DEFAULT NULL COMMENT 'Medication List  (name and how often you use each)',
  `med_emphysema` TINYINT(1) NULL DEFAULT NULL,
  `med_falls` TINYINT(1) NULL DEFAULT NULL,
  `med_heart_disease` TINYINT(1) NULL DEFAULT NULL,
  `med_pacemaker` TINYINT(1) NULL DEFAULT NULL,
  `med_joint_replacement` TINYINT(1) NULL DEFAULT NULL,
  `med_kidney` TINYINT(1) NULL DEFAULT NULL,
  `med_diabetes` TINYINT(1) NULL DEFAULT NULL,
  `med_seizures` TINYINT(1) NULL DEFAULT NULL,
  `med_urostomy` TINYINT(1) NULL DEFAULT NULL,
  `med_dementia` TINYINT(1) NULL DEFAULT NULL,
  `med_nebulizer` TINYINT(1) NULL DEFAULT NULL,
  `med_oxygen` TINYINT(1) NULL DEFAULT NULL,
  `med_football` TINYINT(1) NULL DEFAULT NULL COMMENT 'Problem walking length of football field?',
  `med_walk_bus_steps` TINYINT(1) NULL DEFAULT NULL,
  `med_stroke` TINYINT(1) NULL DEFAULT NULL,
  `med_urinary` TINYINT(1) NULL DEFAULT NULL,
  `med_cpap` TINYINT(1) NULL DEFAULT NULL,
  `med_flow_rate` TEXT NULL DEFAULT NULL,
  `med_others` TEXT NULL DEFAULT NULL,
  `med_use_mobility` TINYINT(1) NULL DEFAULT NULL,
  `add_other_vets` TINYINT(1) NULL DEFAULT NULL COMMENT 'Are there other veterans you want to travel with?',
  `add_vet_names` TINYTEXT NULL DEFAULT NULL,
  `add_specific_guardian` VARCHAR(45) NULL DEFAULT NULL,
  `guardian_phone` VARCHAR(45) NULL DEFAULT NULL,
  `add_comments` TEXT NULL DEFAULT NULL,
  `med_code` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Color representing medical condition',
  `app_date` DATE NULL DEFAULT NULL,
  `diet_restrictions` VARCHAR(255) NULL DEFAULT NULL,
  `admin_comments` TEXT NULL DEFAULT NULL,
  `last_updated` DATETIME NULL DEFAULT NULL,
  `med_stairs` TINYINT(1) NULL DEFAULT 0,
  `med_stand_30min` TINYINT(1) NULL DEFAULT 0,
  `med_hbp` TINYINT(1) NULL DEFAULT 0,
  `med_transport_airport` TINYINT(1) NULL DEFAULT 0,
  `med_transport_trip` TINYINT(1) NULL DEFAULT 0,
  `med_colostomy` TINYINT(1) NULL DEFAULT 0,
  `med_cancer` TINYINT(1) NULL DEFAULT 0,
  `med_dnr` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`veteran_id`),
  INDEX `guardian_veteran_fk` (`guardian_id` ASC) VISIBLE,
  INDEX `team_veteran_fk` (`team_id` ASC) VISIBLE,
  INDEX `mission_vet_fk` (`mission_id` ASC) VISIBLE,
  INDEX `bus_bet_fk` (`bus_id` ASC) VISIBLE,
  CONSTRAINT `bus_bet_fk`
    FOREIGN KEY (`bus_id`)
    REFERENCES `bus` (`bus_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `guardian_veteran_fk`
    FOREIGN KEY (`guardian_id`)
    REFERENCES `guardian` (`guardian_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `mission_vet_fk`
    FOREIGN KEY (`mission_id`)
    REFERENCES `mission` (`mission_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `team_veteran_fk`
    FOREIGN KEY (`team_id`)
    REFERENCES `team` (`team_id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE);