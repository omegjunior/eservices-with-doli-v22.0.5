-- ========================================================================
-- Copyright (C) 2024	Frédéric Hounkponou	<omegajunior.apps@gmail.com>
--
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
-- ========================================================================
-- configurer automatiquement les paramètres de la société
-- insertion régions
INSERT IGNORE INTO llx_c_regions (fk_pays, code_region, nom, active) 
VALUES 
(49, '5','Sud Bénin',1),
(49, '7','Est Bénin',1);
-- insertion département
INSERT IGNORE INTO llx_c_departements (fk_region, code_departement, nom, active) 
VALUES 
('5','ATL','Atlantique',1),
('5','LIT','Littoral',1);

INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(1, "MAIN_INFO_SOCIETE_NOM", 'Secrétariat Mgr', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(1, "MAIN_INFO_SOCIETE_ADDRESS", '01BP491 Cotonou Bénin', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(1, "MAIN_INFO_SOCIETE_TOWN", 'Cotonou', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(1, "MAIN_INFO_SOCIETE_ZIP", '229', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "MAIN_INFO_SOCIETE_REGION", '5', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "MAIN_INFO_SOCIETE_STATE", 'LIT', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "MAIN_MONNAIE", 'XOF', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "MAIN_INFO_SOCIETE_TEL", '21308343', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "MAIN_INFO_SIREN", '1234567894561', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "MAIN_INFO_TVAINTRA", 'A', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "FACTURE_TVAOPTION", '0', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "FACTURE_LOCAL_TAX1_OPTION", '0', 'chaine', 0, '');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "MAIN_LANG_DEFAULT", 'fr_FR', 'chaine', 0, '');