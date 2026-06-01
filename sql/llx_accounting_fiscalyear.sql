-- Copyright (C) 2024	Frédéric Hounkponou	<omegajunior.apps@gmail.com>
--
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

--
-- Do not put a comment at the end of the line, this file is parsed during the
-- install and all '--' symbols are removed.
--
-- Ne pas placer de commentaire en fin de ligne, ce fichier est parsé lors
-- de l'install et tous les sigles '--' sont supprimés.

-- insertion des années fiscales de l'entité mère.
INSERT INTO llx_accounting_fiscalyear (entity, label, date_start, date_end, datec, fk_user_author, fk_user_modif) VALUES (1, 'Exercice 2024', '2024-01-01', '2024-12-31', NOW(), 1, 1);
-- Copier les exercices fiscaux de l'entité maître avec vérification de l'existence
INSERT INTO llx_accounting_fiscalyear (entity, label, date_start, date_end, datec, fk_user_author, fk_user_modif)
SELECT 
    __ENTITY__,
    fy.label,
    fy.date_start,
    fy.date_end,
    NOW(),
    fy.fk_user_author,
    fy.fk_user_modif 
FROM 
    llx_accounting_fiscalyear fy 
WHERE 
    fy.entity = 1
    AND NOT EXISTS (
        SELECT 1
        FROM llx_accounting_fiscalyear fy2
        WHERE fy2.entity = __ENTITY__
          AND fy2.label = fy.label 
    ) 
ORDER BY 
    fy.datec DESC 
LIMIT 1;

-- copier aussi start month de l'année fiscal SOCIETE_FISCAL_MONTH_START
INSERT INTO llx_const (entity, name, value, type, visible, note) 
SELECT 
    __ENTITY__,
    c.name,
    c.value,
    c.type,
    c.visible,
    c.note 
FROM 
    llx_const c
WHERE 
    c.entity = 1 
    AND name = 'SOCIETE_FISCAL_MONTH_START' 
    AND NOT EXISTS (
        SELECT 1
        FROM llx_const c2
        WHERE c2.entity = __ENTITY__
          AND c2.name = c.name
    );
