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

-- on fait cette modification de la table ici vu que les AddExtraFields du fichier définition du module
-- sont exécutés après les insertions dans les tables avec les fichiers sql. En cas de reload du module,
-- on ne craint rien car mysql va rejeter la requête étant entendu que la colonne existe déjà
ALTER TABLE llx_entity_extrafields ADD identifiant_structure varchar(12) NULL;
-- créer un index unique pour entity et identifiant structure pour éviter les doublons
ALTER TABLE llx_entity_extrafields ADD UNIQUE INDEX uk_eservices_entity_identifiant(fk_object, identifiant_structure);
-- faire l'insertion
INSERT IGNORE INTO llx_entity_extrafields (fk_object, identifiant_structure) VALUES 
(2, "Economat"),
(3, "Chancellerie");
