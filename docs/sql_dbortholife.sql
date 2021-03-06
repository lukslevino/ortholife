-- MySQL Script generated by MySQL Workbench
-- Fri Nov 17 23:58:30 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema DBORTHOLIFE
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DBORTHOLIFE
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DBORTHOLIFE` DEFAULT CHARACTER SET utf8 ;
USE `DBORTHOLIFE` ;

-- -----------------------------------------------------
-- Table `DBORTHOLIFE`.`TB_OL_USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBORTHOLIFE`.`TB_OL_USUARIO` (
  `CO_USUARIO` INT NOT NULL AUTO_INCREMENT COMMENT 'Código do usuário',
  `NU_CPF` VARCHAR(11) NOT NULL COMMENT 'Numero do CPF do Usuario',
  `NO_USUARIO` VARCHAR(200) NOT NULL,
  `DS_EMAIL` VARCHAR(255) NOT NULL,
  `DT_ULTIMO_ACESSO` DATE NOT NULL,
  `DT_ALTERACAO` DATE NOT NULL,
  `DT_INCLUSAO` DATE NOT NULL,
  `CO_USUARIO_ULTIMA_OPERACAO` INT NOT NULL,
  `DS_SENHA` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`CO_USUARIO`),
  UNIQUE INDEX `CO_USUARIO_UNIQUE` (`CO_USUARIO` ASC),
  UNIQUE INDEX `NU_CPF_UNIQUE` (`NU_CPF` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBORTHOLIFE`.`TB_OL_FUNCAO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBORTHOLIFE`.`TB_OL_FUNCAO` (
  `CO_FUNCAO` INT NOT NULL AUTO_INCREMENT,
  `NO_FUNCAO` VARCHAR(50) NOT NULL COMMENT 'Nome da funcao',
  `DS_FUNCAO` VARCHAR(100) NOT NULL COMMENT 'Descricao da funcao',
  PRIMARY KEY (`CO_FUNCAO`),
  UNIQUE INDEX `CO_FUNCAO_UNIQUE` (`CO_FUNCAO` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBORTHOLIFE`.`TB_OL_SITUACAO_USU_FUNCAO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBORTHOLIFE`.`TB_OL_SITUACAO_USU_FUNCAO` (
  `CO_SITUACAO_USU_FUNCAO` INT NOT NULL AUTO_INCREMENT COMMENT 'codigo da situacao de um usuario funcao',
  `NO_SITUACAO_USU_FUNCAO` VARCHAR(50) NOT NULL COMMENT 'Nome da situcao de um usuario funcao',
  `DS_SITUACAO_USU_FUNCAO` VARCHAR(255) NOT NULL COMMENT 'Descricao da situacao de um usuario funcao',
  PRIMARY KEY (`CO_SITUACAO_USU_FUNCAO`),
  UNIQUE INDEX `CO_SITUACAO_USU_FUNCAO_UNIQUE` (`CO_SITUACAO_USU_FUNCAO` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBORTHOLIFE`.`TB_OL_USUARIO_FUNCAO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBORTHOLIFE`.`TB_OL_USUARIO_FUNCAO` (
  `CO_USUARIO_FUNCAO` INT NOT NULL AUTO_INCREMENT COMMENT 'Codigo do usuario funcao',
  `ST_AUTORIZACAO` CHAR(1) NOT NULL DEFAULT 'P' COMMENT 'Situacao da autorizacao dada ao usuario a determinada funcao',
  `DT_INCLUSAO` DATE NOT NULL COMMENT 'Data de inclusao do usuario funcao',
  `CO_USUARIO` INT NOT NULL,
  `CO_FUNCAO` INT NOT NULL,
  `CO_SITUACAO_USU_FUNCAO` INT NOT NULL,
  PRIMARY KEY (`CO_USUARIO_FUNCAO`),
  UNIQUE INDEX `CO_USUARIO_FUNCAO_UNIQUE` (`CO_USUARIO_FUNCAO` ASC),
  INDEX `fk_TB_OL_USUARIO_FUNCAO_TB_OL_USUARIO_idx` (`CO_USUARIO` ASC),
  INDEX `fk_TB_OL_USUARIO_FUNCAO_TB_OL_FUNCAO1_idx` (`CO_FUNCAO` ASC),
  INDEX `fk_TB_OL_USUARIO_FUNCAO_TB_OL_SITUACAO_USU_FUNCAO1_idx` (`CO_SITUACAO_USU_FUNCAO` ASC),
  CONSTRAINT `fk_TB_OL_USUARIO_FUNCAO_TB_OL_USUARIO`
    FOREIGN KEY (`CO_USUARIO`)
    REFERENCES `DBORTHOLIFE`.`TB_OL_USUARIO` (`CO_USUARIO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_OL_USUARIO_FUNCAO_TB_OL_FUNCAO1`
    FOREIGN KEY (`CO_FUNCAO`)
    REFERENCES `DBORTHOLIFE`.`TB_OL_FUNCAO` (`CO_FUNCAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_OL_USUARIO_FUNCAO_TB_OL_SITUACAO_USU_FUNCAO1`
    FOREIGN KEY (`CO_SITUACAO_USU_FUNCAO`)
    REFERENCES `DBORTHOLIFE`.`TB_OL_SITUACAO_USU_FUNCAO` (`CO_SITUACAO_USU_FUNCAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBORTHOLIFE`.`TB_OL_USUARIO_CONTATO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBORTHOLIFE`.`TB_OL_USUARIO_CONTATO` (
  `CO_USUARIO_CONTATO` INT UNSIGNED NOT NULL,
  `CO_USUARIO_FUNCAO` INT NOT NULL,
  `DS_CONTATO` VARCHAR(255) NOT NULL COMMENT 'Conteudo do contato',
  `TP_CONTATO` VARCHAR(45) NOT NULL COMMENT 'Tipo de contato: Telefone, Fax, Email. etc.. ',
  `DT_INCLUSAO` DATE NOT NULL,
  PRIMARY KEY (`CO_USUARIO_CONTATO`),
  INDEX `fk_TB_USUARIO_CONTATO_TB_OL_USUARIO_FUNCAO1_idx` (`CO_USUARIO_FUNCAO` ASC),
  CONSTRAINT `fk_TB_USUARIO_CONTATO_TB_OL_USUARIO_FUNCAO1`
    FOREIGN KEY (`CO_USUARIO_FUNCAO`)
    REFERENCES `DBORTHOLIFE`.`TB_OL_USUARIO_FUNCAO` (`CO_USUARIO_FUNCAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBORTHOLIFE`.`TB_OL_UNIDADE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBORTHOLIFE`.`TB_OL_UNIDADE` (
  `CO_UNIDADE` INT UNSIGNED NOT NULL,
  `NO_UNIDADE` VARCHAR(200) NOT NULL,
  `DT_INCLUSAO` DATE NOT NULL,
  PRIMARY KEY (`CO_UNIDADE`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBORTHOLIFE`.`TB_OL_PARCEIRO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBORTHOLIFE`.`TB_OL_PARCEIRO` (
  `CO_PARCEIRO` INT NOT NULL,
  `CO_USUARIO_FUNCAO` INT NOT NULL,
  `CO_MUNICIPO` INT NOT NULL,
  `DT_NASCIMENTO` DATE NOT NULL COMMENT 'Data de nascimento',
  `DS_LOGRADOURO` VARCHAR(255) NOT NULL COMMENT 'Endereço do parceiro',
  `NU_CEP` CHAR(8) NOT NULL,
  `TP_SEXO` CHAR(1) NOT NULL COMMENT 'Genero sexual: M- Masculino / F - Feminino / O - Outros',
  `DT_INCLUSAO` DATE NOT NULL COMMENT 'data de inclusao do registro',
  `NU_ENDERECO` VARCHAR(10) NOT NULL,
  `DS_COMPLEMENTO_ENDERECO` VARCHAR(100) NOT NULL,
  `NO_BAIRRO` VARCHAR(50) NULL,
  `TIPO_LOGRADOURO` VARCHAR(50) NULL,
  `CO_UNIDADE` INT UNSIGNED NOT NULL,
  UNIQUE INDEX `CO_PARCEIRO_UNIQUE` (`CO_PARCEIRO` ASC),
  PRIMARY KEY (`CO_PARCEIRO`),
  INDEX `fk_TB_OL_PARCEIRO_TB_OL_USUARIO_FUNCAO1_idx` (`CO_USUARIO_FUNCAO` ASC),
  INDEX `fk_TB_OL_PARCEIRO_TB_OL_UNIDADE1_idx` (`CO_UNIDADE` ASC),
  CONSTRAINT `fk_TB_OL_PARCEIRO_TB_OL_USUARIO_FUNCAO1`
    FOREIGN KEY (`CO_USUARIO_FUNCAO`)
    REFERENCES `DBORTHOLIFE`.`TB_OL_USUARIO_FUNCAO` (`CO_USUARIO_FUNCAO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_OL_PARCEIRO_TB_OL_UNIDADE1`
    FOREIGN KEY (`CO_UNIDADE`)
    REFERENCES `DBORTHOLIFE`.`TB_OL_UNIDADE` (`CO_UNIDADE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
