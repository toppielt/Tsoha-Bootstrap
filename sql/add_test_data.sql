-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja(jasennumero, nimi, email, salasana, status) VALUES (666, 'Topi', 'topi.kotamaki@gmail.com', 'matolaatikko', 'moderator');
INSERT INTO Kayttaja(jasennumero, nimi, email, salasana, status) VALUES (555, 'Matti', 'matti@gmail.top', 'poloinen', 'jasen');

INSERT INTO Harjoitus(harjoitusid, pvm, kello, paikka, maxosallistujat, kesto, lisatiedot, omaHarjoitus ) VALUES (535,'01-01-2017', 10.00, 'Kovelo', 12, 2.0, 'ei ole', false );
INSERT INTO Harjoitus(harjoitusid, pvm, kello, paikka, maxosallistujat, kesto, lisatiedot, omaHarjoitus) VALUES (700, '02-02-2017', 10.00,'Osuva', 5, 1.5, 'saattaa olla', true);

INSERT INTO Ammunta(ammuntaID, laukausmaara, asetyyppi) VALUES (123, 50, 'Kivääri');
INSERT INTO Ammunta(ammuntaID, laukausmaara, asetyyppi) VALUES (321, 70, 'Pistooli');

INSERT INTO Rasti(rastiid, ammunta, harjoitus, rastikuvaus ) VALUES (800, 123, 535, 'Rynnäkkö');
INSERT INTO Rasti(rastiid, ammunta, harjoitus, rastikuvaus) VALUES (9000, 321, 700, 'Ylläkkö');

INSERT INTO Tulos(ampuja, rasti, aika, pisteet) VALUES (666, 800, 15.6, 85);
INSERT INTO Tulos(ampuja, rasti, aika, pisteet) VALUES (555,9000, 24.5, 125);


INSERT INTO Kayttajanharjoitus(harjoitus, ampuja) VALUES (535,666);
INSERT INTO Kayttajanharjoitus(harjoitus, ampuja) VALUES (700,555);

