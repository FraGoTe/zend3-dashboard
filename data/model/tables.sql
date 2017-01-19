-- MySQL Script generated by MySQL Workbench
-- 01/19/17 15:25:48
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `role` ;

CREATE TABLE IF NOT EXISTS `role` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(300) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(40) NULL,
  `password` VARCHAR(40) NULL,
  `full_name` VARCHAR(300) NULL,
  `email` VARCHAR(300) NULL,
  `active` INT(1) NULL,
  `role_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_user_role_idx` (`role_id` ASC),
  CONSTRAINT `fk_user_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `menu` ;

CREATE TABLE IF NOT EXISTS `menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `module` VARCHAR(100) NULL,
  `controller` VARCHAR(100) NULL,
  `action` VARCHAR(100) NULL,
  `label` VARCHAR(150) NULL,
  `parent` INT(11) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idmenu_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `privilege`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `privilege` ;

CREATE TABLE IF NOT EXISTS `privilege` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role_id` INT NOT NULL,
  `menu_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_privilege_role1_idx` (`role_id` ASC),
  INDEX `fk_privilege_menu1_idx` (`menu_id` ASC),
  CONSTRAINT `fk_privilege_role1`
    FOREIGN KEY (`role_id`)
    REFERENCES `role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_privilege_menu1`
    FOREIGN KEY (`menu_id`)
    REFERENCES `menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `colegio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `colegio` ;

CREATE TABLE IF NOT EXISTS `colegio` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `pagina_web` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `telefono_2` VARCHAR(45) NULL,
  `contacto` VARCHAR(45) NULL,
  `telefono_contacto` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `categoria` ;

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pasajero`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pasajero` ;

CREATE TABLE IF NOT EXISTS `pasajero` (
  `tipo_documento` VARCHAR(3) NOT NULL,
  `numero_documento` VARCHAR(12) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `apellidos` VARCHAR(200) NULL,
  `correo` VARCHAR(100) NULL,
  `telefono` VARCHAR(45) NULL,
  `celular` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `nacionalidad` VARCHAR(45) NULL,
  `fecha_nacimiento` DATE NULL,
  `user_id` INT NOT NULL,
  `categoria_id` INT NOT NULL,
  PRIMARY KEY (`tipo_documento`, `numero_documento`),
  UNIQUE INDEX `tipo_documento_UNIQUE` (`tipo_documento` ASC),
  UNIQUE INDEX `numero_documento_UNIQUE` (`numero_documento` ASC),
  INDEX `fk_pasajero_user1_idx` (`user_id` ASC),
  INDEX `fk_pasajero_categoria1_idx` (`categoria_id` ASC),
  CONSTRAINT `fk_pasajero_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pasajero_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `salon`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `salon` ;

CREATE TABLE IF NOT EXISTS `salon` (
  `id` INT NOT NULL,
  `nivel` VARCHAR(1) NULL,
  `grado` VARCHAR(1) NULL,
  `seccion` VARCHAR(1) NULL,
  `descripcion` VARCHAR(45) NULL,
  `colegio_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Salon_colegio1_idx` (`colegio_id` ASC),
  CONSTRAINT `fk_Salon_colegio1`
    FOREIGN KEY (`colegio_id`)
    REFERENCES `colegio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `banco` ;

CREATE TABLE IF NOT EXISTS `banco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cta_bancaria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cta_bancaria` ;

CREATE TABLE IF NOT EXISTS `cta_bancaria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nro_cta` VARCHAR(100) NULL,
  `banco_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cta_bancaria_banco1_idx` (`banco_id` ASC),
  CONSTRAINT `fk_cta_bancaria_banco1`
    FOREIGN KEY (`banco_id`)
    REFERENCES `banco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `moneda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moneda` ;

CREATE TABLE IF NOT EXISTS `moneda` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL,
  `simbolo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `paquete_turistico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `paquete_turistico` ;

CREATE TABLE IF NOT EXISTS `paquete_turistico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(200) NULL,
  `fecha_viaje` DATE NULL,
  `destino` VARCHAR(100) NULL,
  `precio_viaje` DECIMAL(10,0) NULL,
  `salon_id` INT NOT NULL,
  `documento_adicional` VARCHAR(1) NULL,
  `cta_bancaria_id` INT NOT NULL,
  `moneda_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_paquete_turistico_salon1_idx` (`salon_id` ASC),
  INDEX `fk_paquete_turistico_cta_bancaria1_idx` (`cta_bancaria_id` ASC),
  INDEX `fk_paquete_turistico_moneda1_idx` (`moneda_id` ASC),
  CONSTRAINT `fk_paquete_turistico_salon1`
    FOREIGN KEY (`salon_id`)
    REFERENCES `salon` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_paquete_turistico_cta_bancaria1`
    FOREIGN KEY (`cta_bancaria_id`)
    REFERENCES `cta_bancaria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_paquete_turistico_moneda1`
    FOREIGN KEY (`moneda_id`)
    REFERENCES `moneda` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cobro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cobro` ;

CREATE TABLE IF NOT EXISTS `cobro` (
  `id` INT NOT NULL,
  `monto_pendiente` DECIMAL(10,0) NOT NULL,
  `paquete_turistico_id` INT NOT NULL,
  `descuento` DECIMAL(10,0) NULL,
  `pasajero_tipo_documento` VARCHAR(3) NOT NULL,
  `pasajero_numero_documento` VARCHAR(12) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cobro_paquete_turistico1_idx` (`paquete_turistico_id` ASC),
  INDEX `fk_cobro_pasajero1_idx` (`pasajero_tipo_documento` ASC, `pasajero_numero_documento` ASC),
  CONSTRAINT `fk_cobro_paquete_turistico1`
    FOREIGN KEY (`paquete_turistico_id`)
    REFERENCES `paquete_turistico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cobro_pasajero1`
    FOREIGN KEY (`pasajero_tipo_documento` , `pasajero_numero_documento`)
    REFERENCES `pasajero` (`tipo_documento` , `numero_documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pago`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pago` ;

CREATE TABLE IF NOT EXISTS `pago` (
  `id` INT NOT NULL,
  `pasajero_tipo_documento` VARCHAR(3) NOT NULL,
  `pasajero_numero_documento` VARCHAR(12) NOT NULL,
  `cobro_id` INT NOT NULL,
  `fecha_pago` DATE NULL,
  `forma_pago` VARCHAR(1) NULL COMMENT '1: Pago Caja Efectivo\n2: Pago Caja POS\n3: Deposito Bancario',
  `tipo_tarjeta` VARCHAR(45) NULL,
  `nombre_banco` VARCHAR(45) NULL,
  `fecha_transaccion` VARCHAR(45) NULL,
  `codigo_banco` VARCHAR(3) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pago_pasajero1_idx` (`pasajero_tipo_documento` ASC, `pasajero_numero_documento` ASC),
  INDEX `fk_pago_cobro1_idx` (`cobro_id` ASC),
  CONSTRAINT `fk_pago_pasajero1`
    FOREIGN KEY (`pasajero_tipo_documento` , `pasajero_numero_documento`)
    REFERENCES `pasajero` (`tipo_documento` , `numero_documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pago_cobro1`
    FOREIGN KEY (`cobro_id`)
    REFERENCES `cobro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `voucher`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `voucher` ;

CREATE TABLE IF NOT EXISTS `voucher` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo_operacion` VARCHAR(45) NULL,
  `fecha_pago` DATE NULL,
  `fecha_transaccion` DATE NULL,
  `codigo_banco` VARCHAR(3) NULL,
  `monto` DECIMAL(10,0) NULL,
  `estado` VARCHAR(1) NULL COMMENT '0 = pendiente\n1= procesado\n2 = anulado',
  `img` BLOB NULL,
  `usuario_aud` VARCHAR(45) NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_voucher_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_voucher_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
