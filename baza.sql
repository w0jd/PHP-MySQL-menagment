drop database if EXISTS baza;
CREATE database baza;
use baza;

CREATE TABLE producent_procesor(
    id_producent_procesor INT AUTO_INCREMENT PRIMARY KEY,
    nazwa_producent_procesor VARCHAR (45)
);
CREATE TABLE procesor( 
    id_procesor INT AUTO_INCREMENT PRIMARY KEY,
    model_procesor VARCHAR (45),
    cena_procesor DECIMAL (20,2),
    id_producent_procesor INT ,
    FOREIGN KEY (id_producent_procesor) REFERENCES producent_procesor(id_producent_procesor)

);
INSERT INTO producent_procesor values ("","intel");
INSERT INTO producent_procesor values ("","amd");
INSERT INTO procesor values ("","celeron","120,21",1);
INSERT INTO procesor values("","pentium","222,22",1);
INSERT INTO procesor values("","dual-core","12,50",1);
INSERT INTO procesor values("","fx","33,22",2);
INSERT INTO procesor values("","athlon","90,99",2);
INSERT INTO procesor values("","ryzen","23,12",2); 