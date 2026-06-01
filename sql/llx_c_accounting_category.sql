-- Copyright (C) 2024	Frédéric Hounkponou	<omegajunior.apps@gmail.com>
-- This program is free software; you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation; either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program. If not, see <https://www.gnu.org/licenses/>.
--
--

-- vider la table et ensuite recharger
--TRUNCATE TABLE  llx_c_accounting_category;

-- fiche trimestrielle
-- Group of accounting accounts for report at the parish of Cotonou diocese - RECETTES
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  1, 'RECPRIN',   'I) RECETTES PRINCIPALES',               '4xxxxx et 7xxxxx', 0, 0, '',                 '10', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  2, 'RECPROPAR',  'II) RECETTES PROPRES PAROISSIALES',             '4xxxxx et 7xxxxx', 0, 0, '',                 '20', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  3, "RECTRAECO",  "III) RECETTES A TRANSFERER A L'ECONOMAT",             '4xxxxx et 7xxxxx', 0, 0, '',                 '30', 49, 1);

INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  4, 'TOTRECFON',    'TOTAL DES RECETTES DE FONCTIONNEMENT A = (II+III)',                                   '',                0, 1, 'RECPROPAR+RECTRAECO', '40', 49, 1);

-- Group of accounting accounts for report at the parish of Cotonou diocese - DEPENSES
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  5, 'DEPPRES',   'a) DEPENSES PRESBYTERE',               '4xxxxx et 6xxxxx', 1, 0, '',                 '50', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  6, 'FOUREN',  'b) DEPENSES FOURNITURES ENERGIES',             '4xxxxx et 6xxxxx', 1, 0, '',                 '60', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  7, "SECRE",  "c) DEPENSES SECRETARIAT",             '4xxxxx et 6xxxxx', 1, 0, '',                 '70', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  8, "TRANDEP",  "d) DEPENSES TRANSPORTS DEPLACEMENT",             '4xxxxx et 6xxxxx', 1, 0, '',                 '80', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  9, "MOYEVAN",  "e) DEPENSES MOYENS EVANGELISATION",             '4xxxxx et 6xxxxx', 1, 0, '',                 '90', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  10, "CULTE",  "f) DEPENSES CULTE",             '4xxxxx et 6xxxxx', 1, 0, '',                 '100', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  11, "AUTDEP",  "g) AUTRES DEPENSES",             '4xxxxx et 6xxxxx', 1, 0, '',                 '110', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  12, "IMPTAX",  "h) IMPOTS TAXES",             '4xxxxx et 6xxxxx', 1, 0, '',                 '120', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  13, "CHARPERS",  "i) CHARGES PERSONNEL",             '4xxxxx et 6xxxxx', 1, 0, '',                 '130', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  14, "RECTRANS",  "j) DEPENSES QUI SONT RECETTES POUR ECONOMAT (TRANSFEREES)",             '4xxxxx et 6xxxxx', 0, 0, '',                 '140', 49, 1);

INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  15, 'TOTDEPFON',    'TOTAL DES DEPENSES DE FONCTIONNEMENT C = (a+b+c+d+e+f+g+h+i+j)',                                   '',                1, 1, 'DEPPRES+FOUREN+SECRE+TRANDEP+MOYEVAN+CULTE+AUTDEP+IMPTAX+CHARPERS+RECTRANS', '150', 49, 1);


INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  16, "RESINT",  "a1) RESSOURCES D'INVESTISSEMENTS INTERNES",             '2xxxxx', 0, 0, '',                 '160', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  17, "RESEXT",  "a2) RESSOURCES D'INVESTISSEMENTS EXTERNES",             '2xxxxx ', 0, 0, '',                 '170', 49, 1);

INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  18, 'TOTRESINV',    "TOTAL DES RESSOURCES D'INVESTISSEMENT D = (a1+a2)",                                   '',                0, 1, 'RESINT+RESEXT', '180', 49, 1);

INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  19, "CONS",  "b1) DEPENSES DE CONSTRUCTIONS",             '2xxxxx', 1, 0, '',                 '190', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  20, "AUTIMMO",  "b2) DEPENSES AUTRES IMMOBILISATIONS",             '2xxxxx ', 1, 0, '',                 '200', 49, 1);

INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  21, 'TOTDEPINV',    "TOTAL DES DEPENSES D'INVESTISSEMENT E = (b1+b2)",                                   '',                1, 1, 'CONS+AUTIMMO', '210', 49, 1);

-- fiche offrande de messe
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  22, 'MNTOFM',   '(1) MONTANT TOTAL DES OFFRANDES DE MESSE',               '4747051+704404', 0, 0, '',                 '220', 49, 1);
-- INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  23, 'NBROFM',    '(2) NOMBRE TOTAL DES OFFRANDES DE MESSE (1)/2000',                                   '',                0, 1, 'round(abs(MNTOFM)/2000)', '230', 49, 1);
-- modif 24-10-24: il faut tenir compte du cas où il y a une seule demande de messe et de montant inférieur à 2000. Dans ce cas nbr de messe = 1
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  23, 'NBROFM',    '(2) NOMBRE TOTAL DES OFFRANDES DE MESSE (1)/2000',                                   '',                0, 1, 'round(((abs(MNTOFM)/2000)>=1)?(abs(MNTOFM)/2000):((abs(MNTOFM)/2000)!=0)?1:0)', '230', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  24, 'MNTTAXE',    '(3) MONTANT TOTAL DES TAXES SUR OFFRANDES DE MESSE (2)*200',                                   '',                0, 1, 'NBROFM*200', '240', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  25, 'MNTOFMNOTAXE',    '(4) MONTANT TOTAL DES OFFRANDES DE MESSE SANS TAXES (1)-(3)',                                   '',                0, 1, 'MNTOFM-MNTTAXE', '250', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  26, 'MNTCONF',   '(5) MONTANT TOTAL DES FRAIS DE DEPLACEMENT PAYES AUX CONFRERES',               '4747052', 0, 0, '',                 '260', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  27, 'RESTEMNTOFM',    '(6) MONTANT RESTANT DES OFFRANDES DE MESSE (4)-(5)',                                   '',                0, 1, 'MNTOFMNOTAXE-abs(MNTCONF)', '265', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  28, 'MNTOFMPAR',    '(7) MONTANT TOTAL DES OFFRANDES DE MESSE A REVERSER A LA PAROISSE (6)*25%',                                   '',                0, 1, 'round(RESTEMNTOFM*0.25)', '270', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  29, 'MNTOFMCAISSE',    '(8) MONTANT TOTAL DES OFFRANDES DE MESSE A VERSER DANS LA CAISSE DES MESSES (6)*75%',                                   '',                0, 1, 'RESTEMNTOFM-MNTOFMPAR', '280', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  30, 'MNTQUETE2FUN',   '(9) MONTANT DES 2e QUETES DE FUNERAILLES',               '474704', 0, 0, '',                 '290', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  31, 'PENALITE',    '(10) PENALITE DE RETARD SI APPLIQUEE (8)*10%',                                   '',                0, 1, 'round(MNTOFMCAISSE*10/100)', '300', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  32, 'MNTECONOMAT',    "(11) MONTANT TOTAL SANS PENALITE A VERSER A L'ECONOMAT (3)+(8)+(9)+(10)",                                   '',                0, 1, 'MNTTAXE+MNTOFMCAISSE+MNTQUETE2FUN', '310', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  33, 'MNTECONOMATPEN',    "(11) MONTANT TOTAL AVEC PENALITE A VERSER A L'ECONOMAT (3)+(8)+(9)+(10)",                                   '',                0, 1, 'MNTTAXE+MNTOFMCAISSE+MNTQUETE2FUN+PENALITE', '320', 49, 1);                                                                                                                                                                                                                                                                                                                                                                

-- bordereau de versement
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  34, 'QIMPEREES',   'a) QUÊTES IMPEREES',               '4712QXXX', 0, 0, '',                 '330', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  35, 'AURECETTES',  'b) AUTRES RECETTES',             '4xxxxx et 7xxxxx', 0, 0, '',                 '340', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  36, 'PENALITETRIM',    'PENALITE DE RETARD SI APPLIQUEE (3) = (2)*10%',                                   '',                0, 1, 'AURECETTES*10/100', '350', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  37, 'TOTRECAVERS',    'TOTAL DES RECETTES A VERSER (4) = (1)+(2)+(3)',                                   '',                0, 1, 'QIMPEREES+AURECETTES+PENALITETRIM', '360', 49, 1);

INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  38, "RESECONOMAT",  "II) RESSOURCES A RECEVOIR DE L'ECONOMAT",             '4xxxxx et 7xxxxx', 0, 0, '',                 '370', 49, 1);

-- Situation de trésorerie
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  39, 'TRESDEBTRIM',   '1) TRESORERIE DEBUT TRIMESTRE',               '4xxxxx et 7xxxxx', 1, 0, '',                 '380', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  40, 'MOUVNT',  '2) MOUVEMENTS SUR LA PERIODE',             '4xxxxx et 7xxxxx', 0, 0, '',                 '390', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  41, "TRESFINTRIM",  "3) TRESORERIE FIN TRIMESTRE",             '4xxxxx et 7xxxxx', 1, 0, '',                 '400', 49, 1);
INSERT INTO llx_c_accounting_category (rowid, code, label, range_account, sens, category_type, formula, position, fk_country, active) VALUES (  42, 'VERIF',    "TOTAL DES VERIFICATIONS",                                   '',                0, 1, 'TRESDEBTRIM+MOUVNT', '410', 49, 1);                                                                                                                                                                                                                                                                                                                                                              