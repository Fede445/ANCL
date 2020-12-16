CREATE TABLE SETTORI (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    nomeSettore VARCHAR(128) NOT NULL UNIQUE
);

CREATE TABLE STIPULE (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    vigente DATE NOT NULL,
    deccorenza DATE NOT NULL,
    scadenza DATE NOT NULL,
    partiStipulanti TINYTEXT NOT NULL,
    settore SMALLINT,
    tipologia char(2) NOT NULL,
    FOREIGN KEY(settore) REFERENCES SETTORI(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE INDEX settori_stipule ON STIPULE(settore);

CREATE TABLE RETRIBUZIONI (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    livello VARCHAR(3) NOT NULL,
    nomeColonne VARCHAR(32) NOT NULL,
    stipula SMALLINT,
    importo DOUBLE NOT NULL,
    commento TEXT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE INDEX stipule_retributive ON RETRIBUZIONI(stipula);

CREATE TABLE APRENDISTATI (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    livello VARCHAR(3) NOT NULL,
    inizio TINYINT NOT NULL,
    fine TINYINT NOT NULL,
    condizione DATE,
    livello_target VARCHAR(3) NOT NULL,
    stipula SMALLINT,
    commento TEXT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE APRENDISTATI_PERC (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    livello VARCHAR(3) NOT NULL,
    inizio TINYINT NOT NULL,
    fine TINYINT NOT NULL,
    condizione DATE,
    percentuale TINYINT NOT NULL,
    stipula SMALLINT,
    commento TEXT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE RE_MINIMI_CONTRATTUALI (
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE RE_PREMIO_RISULTATO(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE RE_ALTRE_VOCI(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE APP_PROFESSIONALIZANTE(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE APP_ALTRE_TIPOLOGIE(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE WELF_PREVIDENZA_COMPLEMENTARE(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE WELF_ASSISTENZA_INTEGRATIVA(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE WELF_ENTI_BILATERALI(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE WELF_POLIZZE_ASSICURATIVE(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE NOTE(
    ID SMALLINT AUTO_INCREMENT PRIMARY KEY,
    testo TEXT,
    stipula SMALLINT,
    FOREIGN KEY(stipula) REFERENCES STIPULE(ID) ON DELETE CASCADE ON UPDATE CASCADE
);