-- Copyright (C) 2024	Frédéric Hounkponou	<omegajunior.apps@gmail.com>
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

ALTER TABLE llx_eservices_form_elements ADD UNIQUE INDEX uk_eservices_form_elements_entity(label, entity);
ALTER TABLE llx_eservices_form_elements ADD INDEX idx_eservices_status (status);
ALTER TABLE llx_eservices_form_elements ADD CONSTRAINT fk_eservices_form_elements_fk_acte FOREIGN KEY (fk_acte) REFERENCES llx_eservices_list_actes(rowid);