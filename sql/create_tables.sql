-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja (
jasennumero int, 
nimi varchar(30) NOT NULL,
email varchar(30) NOT NULL,
salasana varchar(20) NOT NULL,
status varchar(10) NOT NULL,
PRIMARY KEY (jasennumero)
   );

CREATE TABLE Harjoitus(
harjoitusid SERIAL PRIMARY KEY,
pvm DATE NOT NULL,
kello decimal,
paikka varchar(20) NOT NULL,
maxosallistujat int,
kesto DECIMAL,
lisatiedot varchar(160),
omaharjoitus BOOLEAN default TRUE
);

CREATE TABLE Rasti (
rastiid SERIAL PRIMARY KEY,
harjoitus int REFERENCES Harjoitus(harjoitusid) ON DELETE CASCADE NOT NULL,
rastikuvaus varchar(160)

);

CREATE TABLE Ammunta (
ammuntaid SERIAL PRIMARY KEY,
asetyyppi varchar(18) NOT NULL,
laukausmaara int NOT NULL,
rasti int REFERENCES Rasti(rastiid) ON DELETE CASCADE NOT NULL
);

CREATE TABLE Tulos (
ampuja int REFERENCES Kayttaja(jasennumero) ON DELETE CASCADE NOT NULL,
rasti int REFERENCES Rasti(rastiid) ON DELETE CASCADE NOT NULL,
aika DECIMAL,
pisteet int
);

CREATE TABLE Kayttajanharjoitus(
harjoitus int REFERENCES Harjoitus(harjoitusid) ON DELETE CASCADE NOT NULL,
ampuja int REFERENCES Kayttaja(jasennumero) ON DELETE CASCADE NOT NULL

);