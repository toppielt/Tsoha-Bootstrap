-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja(jasennumero, nimi, email, salasana, status) VALUES (666, 'Topi', 'topi.kotamaki@gmail.com', 'matolaatikko', 'moderator');
INSERT INTO Kayttaja(jasennumero, nimi, email, salasana, status) VALUES (555, 'Matti', 'matti@gmail.top', 'poloinen', 'jasen');

INSERT INTO Harjoitus(harjoitusID,pvm, paikka, maxOsallistujat, omaHarjoitus) VALUES (535,'01.01.2017', 'Kovelo', 12, false );
INSERT INTO Harjoitus(harjoitusID, pvmm, paikka, maxOsallistujat, omaHarjoitus) VALUES (700, '02.02.2017', 'Osuva', 5, true);

INSERT INTO Rasti(rastiID, ammunta, harjoitus, rastikuvaus ) VALUES (800, 200, 535, 'Rynnäkkö');
INSERT INTO Rasti(rastiID, ammunta, harjoitus, rastikuvaus) VALUES (9000, 100, 700, 'Ylläkkö');

INSERT INTO Tulos(ampuja, rasti, aika, pisteet) VALUES (666, 800, 15,6, 85);
INSERT INTO Tulos(ampuja, rasti, aika, pisteet) VALUES (555,9000, 24,5, 125);

INSERT INTO Ammunta(ammuntaID, laukausmaara, asetyyppi) VALUES (123, 50, 'Kivääri');
INSERT INTO Ammunta(ammuntaID, laukausmaara, asetyyppi) VALUES (321, 70, 'Pistooli');

