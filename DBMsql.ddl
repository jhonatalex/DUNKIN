-- Generado por Oracle SQL Developer Data Modeler 20.2.0.167.1538
--   en:        2020-11-29 00:26:58 CLST
--   sitio:      Oracle Database 11g
--   tipo:      Oracle Database 11g



-- predefined type, no DDL - MDSYS.SDO_GEOMETRY

-- predefined type, no DDL - XMLTYPE

CREATE TABLE destinatario (
    id_destinatario  INTEGER NOT NULL,
    email            VARCHAR2(100),
    nombre           VARCHAR2(100),
    dedicatoria      CLOB,
    usuario_email    VARCHAR2(100) NOT NULL
);

ALTER TABLE destinatario ADD CONSTRAINT destinatario_pk PRIMARY KEY ( id_destinatario );

CREATE TABLE producto (
    id           INTEGER NOT NULL,
    precio       VARCHAR2(100),
    descripcion  VARCHAR2(100),
    imagen       VARCHAR2(100),
    estado       SMALLINT
);

ALTER TABLE producto ADD CONSTRAINT producto_pk PRIMARY KEY ( id );

CREATE TABLE usuario (
    email     VARCHAR2(100) NOT NULL,
    nombre    VARCHAR2(100),
    telefono  VARCHAR2(100)
);

ALTER TABLE usuario ADD CONSTRAINT usuario_pk PRIMARY KEY ( email );

CREATE TABLE venta (
    nro_transaccion     INTEGER NOT NULL,
    orden_de_compra     VARCHAR2(50),
    fecha               DATE,
    monto               INTEGER,
    cantidad            INTEGER,
    codigo_respuesta    INTEGER,
    token               VARCHAR2(100),
    estado_transaccion  SMALLINT,
    producto_id         INTEGER NOT NULL,
    usuario_email       VARCHAR2(100) NOT NULL,
    id                  INTEGER NOT NULL
);

ALTER TABLE venta ADD CONSTRAINT venta_pk PRIMARY KEY ( nro_transaccion );

ALTER TABLE destinatario
    ADD CONSTRAINT destinatario_usuario_fk FOREIGN KEY ( usuario_email )
        REFERENCES usuario ( email );

ALTER TABLE venta
    ADD CONSTRAINT venta_producto_fk FOREIGN KEY ( producto_id )
        REFERENCES producto ( id );

ALTER TABLE venta
    ADD CONSTRAINT venta_usuario_fk FOREIGN KEY ( usuario_email )
        REFERENCES usuario ( email );



-- Informe de Resumen de Oracle SQL Developer Data Modeler: 
-- 
-- CREATE TABLE                             4
-- CREATE INDEX                             0
-- ALTER TABLE                              7
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE MATERIALIZED VIEW LOG             0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0
