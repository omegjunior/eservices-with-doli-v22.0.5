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
-- désactiver le plan syschohada bj pour ne pas embêter au chargement sycebnl
UPDATE llx_accounting_system
SET active = 0
WHERE fk_country = 49 AND pcg_version = "SYSCOHADA-BJ";
-- modele of accounting accounts plan sycebnl.
INSERT INTO llx_accounting_system (fk_country, pcg_version, label, active) VALUES (49, 'SYCEBNL-BJ', 'Système comptable des entités à but non lucratif', 1);
