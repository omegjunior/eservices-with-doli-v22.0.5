-- Copyright (C) 2024 Fred Omega Junior
--
-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see https://www.gnu.org/licenses/.

-- pour insérer les admin des paroisses à l'initialisation
INSERT IGNORE INTO llx_user (entity, admin, employee, statut, login, lastname, firstname, fk_soc, pass, datec, fk_country, rowid) VALUES 
(1, 1, 1, 1, "secretaire", "Mgr", "Secrétariat de", 0, "eservicescotonou", CURRENT_TIMESTAMP, 49, 2),
(2, 1, 1, 1, "econome", "diocésain", "Econome", 0, "eservicescotonou", CURRENT_TIMESTAMP, 49, 3),
(3, 1, 1, 1, "chancelier", "diocésain", "Chancelier", 0, "eservicescotonou", CURRENT_TIMESTAMP, 49, 4);