SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `tads` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `tads` ;

-- -----------------------------------------------------
-- Table `tads`.`grupos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tads`.`grupos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tads`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tads`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `grupo_id` INT NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `idade` INT NULL,
  `descricao` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_grupos_idx` (`grupo_id` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_users_grupos`
    FOREIGN KEY (`grupo_id`)
    REFERENCES `tads`.`grupos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
