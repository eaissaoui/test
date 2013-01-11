CREATE TABLE categorie
   (
    id serial PRIMARY KEY,
    libelle varchar(255) NOT NULL UNIQUE
   );

CREATE TABLE produit
   (
    ref serial PRIMARY KEY,
    idCategorie int4 NOT NULL,
    nom varchar(255) NOT NULL UNIQUE,
    prix float8 NOT NULL
   );

ALTER TABLE produit ADD 
     CONSTRAINT FK_CATEGORIE_PRODUIT
          FOREIGN KEY (idCategorie)
               REFERENCES categorie (id);

CREATE TABLE promotion
   (
    remise float8 NOT NULL 
   )INHERITS (produit);


CREATE TABLE commande
   (
    id serial PRIMARY KEY,
    dateCommande timestamp default CURRENT_DATE 
   );

CREATE TABLE ligne
   (
    numero serial PRIMARY KEY,
    idCommande int4 NOT NULL  ,
    refProduit int4 NOT NULL  ,
    quantite int4 NULL 
   );

ALTER TABLE ligne ADD 
     CONSTRAINT FK_LIGNE_COMMANDE
          FOREIGN KEY (idCommande)
               REFERENCES commande (id);

ALTER TABLE ligne ADD 
     CONSTRAINT FK_LIGNE_PRODUIT
          FOREIGN KEY (refProduit)
               REFERENCES produit (ref);


insert into Categorie values(1,'épicerie');
insert into Categorie values(2,'surgelé');
insert into Categorie values(3,'volaille');
insert into Categorie values(4,'apéritif');
insert into Categorie values(5,'infantile');
insert into Categorie values(6,'beauté');

insert into produit values(50,2,'3 fromages',3.09);
insert into produit values(51,5,'7 légumes',2.25);
insert into produit values(52,1,'Anchois marines a l',1.99);
insert into produit values(53,6,'Bandes de cire froi',9.12);
insert into produit values(54,4,'Bitter',17.13);
insert into produit values(55,4,'Black',14.29);
insert into produit values(56,1,'Blanc de dinde cuit',1.80);
insert into produit values(58,5,'Brocolis, carottes',2.08);
insert into produit values(59,5,'Brocolis, pomme de',1.63);
insert into produit values(60,5,'Carottes',1.27);
insert into produit values(61,5,'Carottes veau',1.63);
insert into produit values(62,1,'Carottes râpées',1.40);
insert into produit values(63,5,'Carottes, riz, broc',2.21);
insert into produit values(64,4,'Cassis',4.58);
insert into produit values(65,3,'Citron & thym',1.10);
insert into produit values(66,4,'Cognac',16.52);
insert into produit values(67,4,'Cognac 40°',5.16);
insert into produit values(68,3,'Cuisse de canard',10.80);
insert into produit values(69,3,'Cuisse poulet 2 x 2',5.57);
insert into produit values(70,4,'Cusenier rouge',9.98);
insert into produit values(71,1,'Emincés de poulet à',3.31);
insert into produit values(72,3,'Emincés de poulet g',3.26);
insert into produit values(73,1,'Epinard',1.84);
insert into produit values(74,3,'Escalope de dinde x',3.81);
insert into produit values(75,3,'Escalope de poulet',3.81);
insert into produit values(76,3,'Escalopes de dinde',8.99);
insert into produit values(77,1,'Fettuccini',1.53);
insert into produit values(78,1,'Filet de bacon tran',1.91);
insert into produit values(79,3,'Filet de dinde enti',10.80);
insert into produit values(80,3,'Filet de poulet rôt',4.27);
insert into produit values(81,3,'Foie de volaille',4.80);
insert into produit values(83,2,'Frutti di Mare',2.30);
insert into produit values(84,1,'Fumé',1.55);
insert into produit values(85,3,'Gésier de volaille',4.80);
insert into produit values(86,4,'Gin 37,5° + livret',11.63);
insert into produit values(87,4,'Gin 40°',18.44);
insert into produit values(89,6,'Golden Protect',13.96);
insert into produit values(90,5,'Gratin de courgette',2.16);
insert into produit values(91,5,'Haricots verts',1.27);
insert into produit values(92,5,'Haricots verts, pom',1.63);
insert into produit values(94,6,'Huile sèche sublima',6.58);
insert into produit values(96,6,'Invisible',17.98);
insert into produit values(97,4,'Irish cream 17°',15.17);
insert into produit values(98,1,'Jambon de Paris déc',1.99);
insert into produit values(99,2,'Jambon fromage',2.95);
insert into produit values(100,5,'Jardinière de légum',2.40);
insert into produit values(101,3,'Label Rouge',8.90);
insert into produit values(102,6,'Lait corps karité 7',4.83);
insert into produit values(103,6,'Lait corps réparate',4.69);
insert into produit values(104,6,'Lait hydratant aprè',8.65);
insert into produit values(105,6,'Lait protecteur pea',15.97);
insert into produit values(106,6,'Lait réparateur int',10.69);
insert into produit values(107,1,'Laitue Iceberg',1.59);
insert into produit values(108,5,'Légumes méditéranée',2.39);
insert into produit values(109,5,'Légumes verts',2.40);
insert into produit values(110,5,'Les idées de maman',3.09);
insert into produit values(111,4,'Liqueur aux extrait',19.79);
insert into produit values(112,4,'Luxardo',5.70);
insert into produit values(113,1,'Mélange Gourmet',1.75);
insert into produit values(114,1,'Méli Mélo',1.55);
insert into produit values(115,3,'Merguez de volaille',1.99);
insert into produit values(116,1,'Miche au poivre tra',1.70);
insert into produit values(117,1,'Mini blinis',1.05);
insert into produit values(118,1,'Mini blinis cocktai',1.30);
insert into produit values(119,2,'Mini quiches lorrai',4.36);
insert into produit values(120,2,'Mini tarte aux poir',4.19);
insert into produit values(121,4,'Mojito classic 14.9',14.92);
insert into produit values(122,5,'Mon 1er Petit Pot',2.72);
insert into produit values(123,5,'Petit Pot miel',1.40);
insert into produit values(124,5,'Mousseline de pomme',1.91);
insert into produit values(125,2,'Mozzarella, emmenta',1.98);
insert into produit values(126,5,'Naturnes',1.36);
insert into produit values(127,3,'Nuggets de poulet',1.70);
insert into produit values(129,5,'Panais',2.30);
insert into produit values(130,4,'Pastis de Marseille',14.83);
insert into produit values(131,1,'Pâte à pizza roulée',1.28);
insert into produit values(132,1,'Pâte brisée',0.96);
insert into produit values(133,1,'Pâte brisée pur beu',1.25);
insert into produit values(134,1,'Pâte feuilletée',0.85);
insert into produit values(135,1,'Pâte feuilletée pur',1.25);
insert into produit values(136,1,'Paté nature',1.13);
insert into produit values(137,1,'Paté sans sel',1.58);
insert into produit values(138,2,'Pelle à tarte',4.34);
insert into produit values(139,5,'Petit pot ratatouil',2.05);
insert into produit values(140,5,'Petits pots jardini',1.93);
insert into produit values(141,2,'Piccolinis original',2.86);
insert into produit values(142,3,'Pilons de poulet',3.20);
insert into produit values(143,4,'Pina Colada 14,9°',13.07);
insert into produit values(144,2,'Pizza 3 fromages cu',3.07);
insert into produit values(145,2,'Pizza bolognaise cu',2.20);
insert into produit values(146,2,'Pizza Chorizo cuite',2.37);
insert into produit values(147,2,'Pizza Kebab cuite s',2.40);
insert into produit values(148,2,'Pizza poulet moutar',2.71);
insert into produit values(149,2,'Pizza royale cuite',2.84);
insert into produit values(150,2,'Pizza tomate mozzar',2.28);
insert into produit values(152,4,'Porto blanc',8.03);
insert into produit values(153,3,'Poulet entier cuit',5.50);
insert into produit values(154,1,'Pousses de mesclun',1.55);
insert into produit values(155,5,'Printanière légumes',1.10);
insert into produit values(156,6,'Protect and Bronze',13.57);
insert into produit values(157,6,'Lait bronzant',15.97);
insert into produit values(158,5,'Provençale',2.33);
insert into produit values(159,6,'Pure & Sensitive',13.75);
insert into produit values(160,6,'Pure&Sensitive',13.47);
insert into produit values(161,2,'Quiche Lorraine',1.79);
insert into produit values(162,1,'Raviolis au boeuf',1.78);
insert into produit values(163,4,'Rhum à 37.5°',17.85);
insert into produit values(164,4,'Rhum bacardi strawb',12.90);
insert into produit values(167,1,'Rillette du Mans à',1.53);
insert into produit values(168,1,'Rognons de veau et',4.19);
insert into produit values(169,4,'Rosso',8.37);
insert into produit values(170,3,'Rôti de dinde filet',11.80);
insert into produit values(171,2,'Royale',1.96);
insert into produit values(173,3,'Sauce au roquefort',1.99);
insert into produit values(174,3,'Saucisses de volail',2.60);
insert into produit values(175,2,'Saumon et crevettes',2.86);
insert into produit values(176,4,'Sirop de sucre de c',1.76);
insert into produit values(177,6,'Soin nourrissant pi',4.24);
insert into produit values(178,3,'Special foie gras',1.53);
insert into produit values(179,4,'Spécial réserve',10.84);
insert into produit values(180,6,'Spray clear protect',12.17);
insert into produit values(181,6,'Spray solaire',12.97);
insert into produit values(182,1,'St Jacques sauce et',3.31);
insert into produit values(184,6,'Summer Beauty',5.40);
insert into produit values(185,6,'SUN kids',15.40);
insert into produit values(186,2,'Tarte au fromage de',2.37);
insert into produit values(187,2,'Tarte aux fromages',2.27);
insert into produit values(188,2,'Tarte aux oignons',2.12);
insert into produit values(190,2,'Tarte poireaux',1.79);
insert into produit values(191,2,'Tarte poulet',2.76);
insert into produit values(192,2,'Tarte provençale',2.59);
insert into produit values(193,2,'Tarte saumon et poi',2.58);
insert into produit values(194,4,'Tawny',7.97);
insert into produit values(195,4,'Vodka 40°',16.54);

insert into promotion values(57,3,'Blancs de poulet en',10.80,2.10);
insert into promotion values(82,6,'FPS 30',12.63,3.28);
insert into promotion values(88,4,'Gold',14.28,3.17);
insert into promotion values(93,2,'Huile pour Pizza',2.01,0.15);
insert into promotion values(95,5,'Idées de maman',3.16,0.27);
insert into promotion values(128,4,'Original',11.91,1.68);
insert into promotion values(151,5,'Poireaux pommes de',1.40,0.32);
insert into promotion values(165,4,'Rhum blanc 37,5°',15.95,3.99);
insert into promotion values(166,4,'Rhum blanc Guadelou',24.60,4.27);
insert into promotion values(172,4,'Sac à glaçons',0.99,0.15);
insert into promotion values(183,3,'Steack haché de vol',2.15,0.22);
insert into promotion values(189,2,'Tarte flambée "flam',2.18,0.18);

ALTER SEQUENCE categorie_id_seq RESTART WITH 10;
ALTER SEQUENCE produit_ref_seq RESTART WITH 200;
