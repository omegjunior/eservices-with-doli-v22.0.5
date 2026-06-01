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

CREATE TABLE IF NOT EXISTS llx_eservices_entity(
	-- BEGIN MODULEBUILDER FIELDS
	rowid integer AUTO_INCREMENT PRIMARY KEY NOT NULL,  
	name varchar(128) NOT NULL, 
	label varchar(255), 
    address varchar(255), 
    town varchar(128), 
	description text,  
	visible integer DEFAULT 1, 
    active integer DEFAULT 1, 
	--options text, 
	date_creation datetime DEFAULT NOW(), 
	tms timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    template integer DEFAULT 0, 
    usetemplate integer DEFAULT 2, 
	fk_user_creat integer DEFAULT 1 NOT NULL, 
    --statut indique si l'entité a déjà été créée ou pas 1= créé et 0 = non
    status integer DEFAULT 0,
	default_values int(1) DEFAULT 0 
	-- END MODULEBUILDER FIELDS
) ENGINE=innodb;
