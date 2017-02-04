-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja (
jasennumero int, 
nimi varchar(30) NOT NULL,
email varchar(30) NOT NULL,
salasana varchar(20) NOT NULL,
status varchar(10) NOT NULL,
PRIMARY KEY (jasennumero)
   );
CREATE TABLE Ammunta (
ammuntaID SERIAL PRIMARY KEY,
asetyyppi varchar(18) NOT NULL,
laukausmaara int NOT NULL
);

CREATE TABLE Harjoitus(
harjoitusid SERIAL PRIMARY KEY,
pvm DATE NOT NULL,
kello decimal,
paikka varchar(20) NOT NULL,
maxosallistujat int,
kesto DECIMAL,
lisatiedot varchar(160),
omaHarjoitus BOOLEAN default TRUE
);

CREATE TABLE Rasti (
rastiid SERIAL PRIMARY KEY,
ammunta int References Ammunta(ammuntaID) NOT NULL,
harjoitus int References Harjoitus(harjoitusID) NOT NULL,
rastikuvaus varchar(160)
);


CREATE TABLE Tulos (
ampuja int References Kayttaja(jasennumero) NOT NULL,
rasti int References Rasti(rastiID) NOT NULL,
aika DECIMAL,
pisteet int
);
CREATE TABLE Kayttajanharjoitus(
harjoitus int References Harjoitus(harjoitusID) NOT NULL,
ampuja int References Kayttaja(jasennumero) NOT NULL
);

