create table imagenes (
    	id int primary key,
    	idinmueble int,
    	ruta varchar(40),
    	CONSTRAINT FOREIGN KEY (idinmueble) REFERENCES inmueble (id) ON DELETE CASCADE ON UPDATE CASCADE
    
    )
go
ALTER TABLE `imagenes` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
go
INSERT INTO `inmocasa`.`usuario` (`login`, `clave`, `nombre`, `apellidos`, `email`, `fechaalta`, `isactivo`, `isroot`, `rol`, `fechalogin`) VALUES ('revisor', 'revisor123', 'Revisor', 'de casas', 'revisor@localhost.net', '2015-08-01', '1', '1', 'administrador', '2015-08-01 00:00:00');