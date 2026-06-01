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
-- Fichier : insert_llx_entity.sql

-- Requêtes INSERT
INSERT IGNORE INTO llx_entity (rowid, label, description, datec, fk_user_creat, options, visible, active, rang) VALUES
(2, 'Economat diocésain', 'Faire une demande relativement aux différents services offerts en ligne par l''Economat diocésain', CURRENT_TIMESTAMP, 1, '{"sharings":{"thirdparty":null,"product":null,"category":["1"]},"addtoallother":{"thirdparty":"1","product":"1","category":"1"}}', 1, 1, 0),
(3, 'Chancellerie diocésaine', 'Faire une demande relativement aux différents services offerts en ligne par la Chancellerie diocésaine', CURRENT_TIMESTAMP, 1, '{"sharings":{"thirdparty":null,"product":null,"category":["1"]},"addtoallother":{"thirdparty":"1","product":"1","category":"1"}}', 1, 1, 0);