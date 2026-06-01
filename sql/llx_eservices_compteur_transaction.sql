-- ========================================================================
-- Copyright (C) 2023	Frédéric Hounkponou	<omegajunior.apps@gmail.com>
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
-- Supprimez la table si elle existe déjà
-- DROP TABLE IF EXISTS llx_eservices_compteur_transaction;

-- Création de la table llx_eservices_services
CREATE TABLE IF NOT EXISTS llx_eservices_compteur_transaction
(
    rowid         integer AUTO_INCREMENT NOT NULL PRIMARY KEY,
    compteur      integer NOT NULL,
    mois          varchar(2) NOT NULL,
    annee         varchar(2) NOT NULL,
    journal       varchar(7) NOT NULL,
    num_transa_precedent integer,
    status        integer DEFAULT 1,
    entity        int(11),
    active        tinyint(4) DEFAULT 1,
    fk_user_creat integer,
    fk_user_modif integer,
    date_creation datetime,
    tms           timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=innodb;