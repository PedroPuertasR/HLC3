DROP TABLE USUARIOS;

CREATE TABLE USUARIOS (
 EMAIL  VARCHAR(100) NOT NULL,
 NOMBRE VARCHAR(100) NOT NULL,
 FECHA_NACIMIENTO DATE NOT NULL,
 APELLIDO VARCHAR(100),
 INTENTOS INT(4),
 FECHA_RECORD DATE,
 PRIMARY KEY (EMAIL));

INSERT INTO USUARIOS VALUES ("USU1@GMAIL.COM", "Antonio", "2000-01-30", "Garcia", NULL, NULL);

INSERT INTO USUARIOS VALUES ("USU2@GMAIL.COM", "Sara", "2000-02-20", "Moreno", NULL, NULL);