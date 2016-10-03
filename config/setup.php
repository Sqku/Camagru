<?php

require(__DIR__.'/database.php');




SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema camagru
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `camagru` ;

-- -----------------------------------------------------
-- Schema camagru
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 ;
USE `camagru` ;

-- -----------------------------------------------------
-- Table `camagru`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `camagru`.`users` ;

CREATE TABLE IF NOT EXISTS `camagru`.`users` (
`id` INT NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `lvl` INT NULL,
  `mdp` VARCHAR(255) NULL,
  `date_inscription` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `actif` TINYINT(1) NULL,
  `cle` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_name_UNIQUE` (`user_name` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `camagru`.`images`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `camagru`.`images` ;

CREATE TABLE IF NOT EXISTS `camagru`.`images` (
`id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_images_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_images_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `camagru`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `camagru`.`commentaires`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `camagru`.`commentaires` ;

CREATE TABLE IF NOT EXISTS `camagru`.`commentaires` (
`id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `commentaire` LONGTEXT NULL,
  `users_id` INT NOT NULL,
  `images_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_commentaires_users1_idx` (`users_id` ASC),
  INDEX `fk_commentaires_images1_idx` (`images_id` ASC),
  CONSTRAINT `fk_commentaires_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `camagru`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentaires_images1`
    FOREIGN KEY (`images_id`)
    REFERENCES `camagru`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `camagru`.`likes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `camagru`.`likes` ;

CREATE TABLE IF NOT EXISTS `camagru`.`likes` (
`id` INT NOT NULL AUTO_INCREMENT,
  `users_id` INT NOT NULL,
  `images_id` INT NOT NULL,
  INDEX `fk_likes_users1_idx` (`users_id` ASC),
  INDEX `fk_likes_images1_idx` (`images_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_likes_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `camagru`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_likes_images1`
    FOREIGN KEY (`images_id`)
    REFERENCES `camagru`.`images` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


?>