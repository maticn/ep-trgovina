SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `trgovinajkmn` ;
CREATE SCHEMA IF NOT EXISTS `trgovinajkmn` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `trgovinajkmn` ;

-- -----------------------------------------------------
-- Table `trgovinajkmn`.`Posta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trgovinajkmn`.`Posta` ;

CREATE TABLE IF NOT EXISTS `trgovinajkmn`.`Posta` (
  `postnaSt` INT NOT NULL,
  `imePoste` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`postnaSt`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trgovinajkmn`.`Uporabnik`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trgovinajkmn`.`Uporabnik` ;

CREATE TABLE IF NOT EXISTS `trgovinajkmn`.`Uporabnik` (
  `idUporabnik` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(255) NOT NULL,
  `idVloga` INT NOT NULL,
  `telefon` VARCHAR(45) NULL,
  `naslov` VARCHAR(45) NULL,
  `idPosta` INT NULL,
  `datumRegistracije` DATETIME NOT NULL,
  `aktivno` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idUporabnik`),
  UNIQUE INDEX `idUporabnik_UNIQUE` (`idUporabnik` ASC),
  INDEX `fk_Uporabnik_Posta_idx` (`idPosta` ASC),
  CONSTRAINT `fk_Uporabnik_Posta`
    FOREIGN KEY (`idPosta`)
    REFERENCES `trgovinajkmn`.`Posta` (`postnaSt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trgovinajkmn`.`Narocilo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trgovinajkmn`.`Narocilo` ;

CREATE TABLE IF NOT EXISTS `trgovinajkmn`.`Narocilo` (
  `idNarocilo` INT NOT NULL AUTO_INCREMENT,
  `cenaSkupaj` DOUBLE NOT NULL,
  `status` INT NOT NULL,
  `idStranke` INT(11) NOT NULL,
  `datumOddaje` DATETIME NOT NULL,
  `idProdajalca` INT(11) NULL,
  `datumPotrditve` DATETIME NULL,
  PRIMARY KEY (`idNarocilo`),
  INDEX `fk_Narocilo_Uporabnik1_idx` (`idStranke` ASC),
  INDEX `fk_Narocilo_Uporabnik2_idx` (`idProdajalca` ASC),
  CONSTRAINT `fk_Narocilo_Uporabnik1`
    FOREIGN KEY (`idStranke`)
    REFERENCES `trgovinajkmn`.`Uporabnik` (`idUporabnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Narocilo_Uporabnik2`
    FOREIGN KEY (`idProdajalca`)
    REFERENCES `trgovinajkmn`.`Uporabnik` (`idUporabnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trgovinajkmn`.`Izdelek`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trgovinajkmn`.`Izdelek` ;

CREATE TABLE IF NOT EXISTS `trgovinajkmn`.`Izdelek` (
  `idIzdelek` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(256) NOT NULL,
  `cena` DOUBLE NOT NULL,
  `aktivno` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idIzdelek`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trgovinajkmn`.`PrijavaLog`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trgovinajkmn`.`PrijavaLog` ;

CREATE TABLE IF NOT EXISTS `trgovinajkmn`.`PrijavaLog` (
  `idPrijavaLog` INT NOT NULL AUTO_INCREMENT,
  `idUporabnik` INT(11) NOT NULL,
  `casPrijave` DATETIME NULL,
  PRIMARY KEY (`idPrijavaLog`),
  INDEX `fk_PrijavaLog_Uporabnik1_idx` (`idUporabnik` ASC),
  CONSTRAINT `fk_PrijavaLog_Uporabnik1`
    FOREIGN KEY (`idUporabnik`)
    REFERENCES `trgovinajkmn`.`Uporabnik` (`idUporabnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trgovinajkmn`.`OcenaIzdelka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trgovinajkmn`.`OcenaIzdelka` ;

CREATE TABLE IF NOT EXISTS `trgovinajkmn`.`OcenaIzdelka` (
  `idUporabnik` INT(11) NOT NULL,
  `idIzdelek` INT NOT NULL,
  `ocena` INT NOT NULL,
  PRIMARY KEY (`idUporabnik`, `idIzdelek`),
  INDEX `fk_OcenaIzdelka_Uporabnik1_idx` (`idUporabnik` ASC),
  INDEX `fk_OcenaIzdelka_Izdelek1_idx` (`idIzdelek` ASC),
  CONSTRAINT `fk_OcenaIzdelka_Uporabnik1`
    FOREIGN KEY (`idUporabnik`)
    REFERENCES `trgovinajkmn`.`Uporabnik` (`idUporabnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OcenaIzdelka_Izdelek1`
    FOREIGN KEY (`idIzdelek`)
    REFERENCES `trgovinajkmn`.`Izdelek` (`idIzdelek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trgovinajkmn`.`SlikaIzdelka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trgovinajkmn`.`SlikaIzdelka` ;

CREATE TABLE IF NOT EXISTS `trgovinajkmn`.`SlikaIzdelka` (
  `idSlikaIzdelka` INT NOT NULL AUTO_INCREMENT,
  `idIzdelek` INT NOT NULL,
  `slika` VARCHAR(256) NULL,
  PRIMARY KEY (`idSlikaIzdelka`),
  INDEX `fk_SlikaIzdelka_Izdelek1_idx` (`idIzdelek` ASC),
  CONSTRAINT `fk_SlikaIzdelka_Izdelek1`
    FOREIGN KEY (`idIzdelek`)
    REFERENCES `trgovinajkmn`.`Izdelek` (`idIzdelek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trgovinajkmn`.`PostavkaNarocila`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `trgovinajkmn`.`PostavkaNarocila` ;

CREATE TABLE IF NOT EXISTS `trgovinajkmn`.`PostavkaNarocila` (
  `idNarocilo` INT NOT NULL,
  `idIzdelek` INT NOT NULL,
  `kolicina` INT NULL,
  PRIMARY KEY (`idNarocilo`, `idIzdelek`),
  INDEX `fk_PostavkaNarocila_Narocilo1_idx` (`idNarocilo` ASC),
  INDEX `fk_PostavkaNarocila_Izdelek1_idx` (`idIzdelek` ASC),
  CONSTRAINT `fk_PostavkaNarocila_Narocilo1`
    FOREIGN KEY (`idNarocilo`)
    REFERENCES `trgovinajkmn`.`Narocilo` (`idNarocilo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PostavkaNarocila_Izdelek1`
    FOREIGN KEY (`idIzdelek`)
    REFERENCES `trgovinajkmn`.`Izdelek` (`idIzdelek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
