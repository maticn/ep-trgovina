SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Posta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Posta` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Posta` (
  `postnaSt` INT NOT NULL,
  `imePoste` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`postnaSt`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Uporabnik`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Uporabnik` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Uporabnik` (
  `idUporabnik` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
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
    REFERENCES `mydb`.`Posta` (`postnaSt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Narocilo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Narocilo` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Narocilo` (
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
    REFERENCES `mydb`.`Uporabnik` (`idUporabnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Narocilo_Uporabnik2`
    FOREIGN KEY (`idProdajalca`)
    REFERENCES `mydb`.`Uporabnik` (`idUporabnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Izdelek`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Izdelek` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Izdelek` (
  `idIzdelek` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(256) NOT NULL,
  `cena` DOUBLE NOT NULL,
  `aktivno` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idIzdelek`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PrijavaLog`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PrijavaLog` ;

CREATE TABLE IF NOT EXISTS `mydb`.`PrijavaLog` (
  `idPrijavaLog` INT NOT NULL AUTO_INCREMENT,
  `idUporabnik` INT(11) NOT NULL,
  `casPrijave` DATETIME NULL,
  PRIMARY KEY (`idPrijavaLog`),
  INDEX `fk_PrijavaLog_Uporabnik1_idx` (`idUporabnik` ASC),
  CONSTRAINT `fk_PrijavaLog_Uporabnik1`
    FOREIGN KEY (`idUporabnik`)
    REFERENCES `mydb`.`Uporabnik` (`idUporabnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`OcenaIzdelka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`OcenaIzdelka` ;

CREATE TABLE IF NOT EXISTS `mydb`.`OcenaIzdelka` (
  `idUporabnik` INT(11) NOT NULL,
  `idIzdelek` INT NOT NULL,
  `ocena` INT NOT NULL,
  PRIMARY KEY (`idUporabnik`, `idIzdelek`),
  INDEX `fk_OcenaIzdelka_Uporabnik1_idx` (`idUporabnik` ASC),
  INDEX `fk_OcenaIzdelka_Izdelek1_idx` (`idIzdelek` ASC),
  CONSTRAINT `fk_OcenaIzdelka_Uporabnik1`
    FOREIGN KEY (`idUporabnik`)
    REFERENCES `mydb`.`Uporabnik` (`idUporabnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_OcenaIzdelka_Izdelek1`
    FOREIGN KEY (`idIzdelek`)
    REFERENCES `mydb`.`Izdelek` (`idIzdelek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`SlikaIzdelka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SlikaIzdelka` ;

CREATE TABLE IF NOT EXISTS `mydb`.`SlikaIzdelka` (
  `idSlikaIzdelka` INT NOT NULL AUTO_INCREMENT,
  `idIzdelek` INT NOT NULL,
  `slika` VARCHAR(256) NULL,
  PRIMARY KEY (`idSlikaIzdelka`),
  INDEX `fk_SlikaIzdelka_Izdelek1_idx` (`idIzdelek` ASC),
  CONSTRAINT `fk_SlikaIzdelka_Izdelek1`
    FOREIGN KEY (`idIzdelek`)
    REFERENCES `mydb`.`Izdelek` (`idIzdelek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PostavkaNarocila`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PostavkaNarocila` ;

CREATE TABLE IF NOT EXISTS `mydb`.`PostavkaNarocila` (
  `idNarocilo` INT NOT NULL,
  `idIzdelek` INT NOT NULL,
  `kolicina` INT NULL,
  PRIMARY KEY (`idNarocilo`, `idIzdelek`),
  INDEX `fk_PostavkaNarocila_Narocilo1_idx` (`idNarocilo` ASC),
  INDEX `fk_PostavkaNarocila_Izdelek1_idx` (`idIzdelek` ASC),
  CONSTRAINT `fk_PostavkaNarocila_Narocilo1`
    FOREIGN KEY (`idNarocilo`)
    REFERENCES `mydb`.`Narocilo` (`idNarocilo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PostavkaNarocila_Izdelek1`
    FOREIGN KEY (`idIzdelek`)
    REFERENCES `mydb`.`Izdelek` (`idIzdelek`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
