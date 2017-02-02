-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja (
jasennumero INTEGER(8) PRIMARY KEY , 
nimi varchar(30) NOT NULL,
email varchar(30) NOT NULL,
salasana varchar(20) NOT NULL,
status STRING(10) NOT NULL;
   )

CREATE TABLE Kayttajanharjoitus(
harjoitus INTEGER References Harjoitus(harjoitusID),
ampuja INTEGER References Kayttaja(jasennumero),
)

CREATE TABLE Harjoitus(
harjoitusID SERIAL INTEGER(8) PRIMARY KEY,
pvm DATE NOT NULL;
paikka STRING(20) NOT NULL,
maxOsallistujat INTEGER(2),
omaHarjoitus BOOLEAN,
)

CREATE TABLE Rasti, (
rastiID SERIAL INTEGER(10) PRIMARY KEY,
ammunta INTEGER References Ammunta(ammuntaID) NOT NULL,
ampuja INTEGER References Kayttaja(jasennumero) NOT NULL,
harjoitus INTEGER References Harjoitus(harjoitusID) NOT NULL,
rastikuvaus STRING(160),
) 
CREATE TABLE Ammunta, (
ammuntaID SERIAL INTEGER(8) PRIMARY KEY,
asetyyppi STRING(18) NOT NULL,
laukausmaara INTEGER(4) NOT NULL,
)

CREATE TABLE Tulos (
ampuja INTEGER References Kayttaja(jasennumero) NOT NULL,
rasti INTEGER References Rasti(rastiID) NOT NULL,
aika DECIMAL(6),
pisteet INTEGER(4),
)

