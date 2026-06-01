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

-- insérer caisse dans l'entité maître
INSERT INTO llx_accounting_journal (entity, code, label, nature, active) VALUES (1, 'CAI', 'Journal caisse principale', 4, 1);
-- insérer Banque economat dans l'entité maître
INSERT INTO llx_accounting_journal (entity, code, label, nature, active) VALUES (1, 'ECO', 'Journal Economat', 4, 1);
-- insérer Banque monnaie électronique MOMO MOOV dans l'entité maître
INSERT INTO llx_accounting_journal (entity, code, label, nature, active) VALUES (1, 'MOMO', 'Journal Mobile Money', 4, 1);
-- insérer Banque monnaie électronique MOOV dans l'entité maître
INSERT INTO llx_accounting_journal (entity, code, label, nature, active) VALUES (1, 'MOOV', 'Journal Moov Money', 4, 1);
-- Copier les journaux de l'entité maître avec vérification de l'existence
INSERT INTO llx_accounting_journal (entity, code, label, nature, active)
SELECT 
    __ENTITY__,
    aj.code,
    aj.label,
    aj.nature,
    aj.active
FROM 
    llx_accounting_journal aj
WHERE 
    aj.entity = 1
    AND NOT EXISTS (
        SELECT 1
        FROM llx_accounting_journal aj2
        WHERE aj2.entity = __ENTITY__
          AND aj2.code = aj.code
    );

