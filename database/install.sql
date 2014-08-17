SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `onion` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `onion` ;

-- -----------------------------------------------------
-- Table `onion`.`type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onion`.`type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `onion`.`store`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onion`.`store` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `onion`.`subtype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onion`.`subType` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `typeId` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  INDEX `fk_subtype_type_idx` (`typeId` ASC),
  CONSTRAINT `fk_subtype_type`
    FOREIGN KEY (`typeId`)
    REFERENCES `onion`.`type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `onion`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onion`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `typeId` INT NOT NULL DEFAULT 0,
  `subTypeId` INT NOT NULL DEFAULT 0,
  `name` VARCHAR(45) NOT NULL DEFAULT '',
  `manufactor` VARCHAR(45) NOT NULL DEFAULT '',
  `year` INT NOT NULL DEFAULT 0,
  `alc` FLOAT NOT NULL DEFAULT 0,
  `origin` VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  INDEX `fk_product_type_idx` (`typeId` ASC),
  INDEX `fk_product_subtype_idx` (`subTypeId` ASC),
  CONSTRAINT `fk_product_type`
    FOREIGN KEY (`typeId`)
    REFERENCES `onion`.`type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_subtype`
    FOREIGN KEY (`subTypeId`)
    REFERENCES `onion`.`subType` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `onion`.`productStore`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onion`.`productStore` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `productId` INT NOT NULL DEFAULT 0,
  `storeId` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_product_store_product_idx` (`productId` ASC),
  INDEX `fk_product_store_store_idx` (`storeId` ASC),
  CONSTRAINT `fk_product_store_product`
    FOREIGN KEY (`productId`)
    REFERENCES `onion`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_store_store`
    FOREIGN KEY (`storeId`)
    REFERENCES `onion`.`store` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `onion`.`review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `onion`.`review` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `productId` INT NOT NULL,
  `color` VARCHAR(1000) NOT NULL DEFAULT '',
  `smell` VARCHAR(1000) NOT NULL DEFAULT '',
  `taste` VARCHAR(1000) NOT NULL DEFAULT '',
  `description` VARCHAR(1000) NOT NULL DEFAULT '',
  `rating` INT NOT NULL DEFAULT 0,
  `user` VARCHAR(45) NOT NULL DEFAULT 'anonymous',
  PRIMARY KEY (`id`),
  INDEX `fk_review_product_idx` (`productId` ASC),
  CONSTRAINT `fk_review_product`
    FOREIGN KEY (`productId`)
    REFERENCES `onion`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `onion`.`type` (id, name)  VALUES (null, 'beer');
INSERT INTO `onion`.`type` (id, name)  VALUES (null, 'wine');

INSERT INTO `onion`.`subType` (id, typeId, name)  VALUES (null, 1, 'lager');
INSERT INTO `onion`.`subType` (id, typeId, name)  VALUES (null, 1, 'porter');
INSERT INTO `onion`.`subType` (id, typeId, name)  VALUES (null, 2, 'red');
INSERT INTO `onion`.`subType` (id, typeId, name)  VALUES (null, 2, 'white');
INSERT INTO `onion`.`subType` (id, typeId, name)  VALUES (null, 2, 'rose');
INSERT INTO `onion`.`subType` (id, typeId, name)  VALUES (null, 1, 'ale');
INSERT INTO `onion`.`subType` (id, typeId, name)  VALUES (null, 1, 'stout');