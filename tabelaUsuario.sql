-- MySQL Script generated by MySQL Workbench
-- Mon Sep  9 23:38:20 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ecopilhas
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ecopilhas
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ecopilhas` DEFAULT CHARACTER SET utf8 ;
USE `ecopilhas` ;

-- -----------------------------------------------------
-- Table `ecopilhas`.`TipoUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecopilhas`.`TipoUsuario` (
  `idTipoUsuario` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecopilhas`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecopilhas`.`Usuario` (
  `usuario` VARCHAR(50) NOT NULL,
  `nome` VARCHAR(50) NOT NULL,
  `sobrenome` VARCHAR(200) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `TipoUsuario_idTipoUsuario` INT NOT NULL,
  PRIMARY KEY (`usuario`, `TipoUsuario_idTipoUsuario`),
  INDEX `fk_Usuario_TipoUsuario_idx` (`TipoUsuario_idTipoUsuario` ASC),
  CONSTRAINT `fk_Usuario_TipoUsuario`
    FOREIGN KEY (`TipoUsuario_idTipoUsuario`)
    REFERENCES `ecopilhas`.`TipoUsuario` (`idTipoUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
