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

-- insertion groupe users par défaut
INSERT IGNORE INTO llx_usergroup (rowid, entity, nom, note, datec) 
VALUES 
(1, 1, 'Secretaires', 'Groupe des Secretaires', CURRENT_TIMESTAMP),
(2, 2, 'Economes', 'Groupes des Economes', CURRENT_TIMESTAMP),
(3, 3, 'Chanceliers', 'Groupe pour les drois des Chanceliers', CURRENT_TIMESTAMP),
(4, 0, 'Clergé', 'Groupe pour les autres membres du service ou structure', CURRENT_TIMESTAMP),
(5, 0, 'Administrateurs', 'Groupe des administrateurs par service ou structure', CURRENT_TIMESTAMP);

-- insertion Numerotation of Actes e-service 
INSERT IGNORE INTO llx_const (entity, name, value) 
VALUES 
(__ENTITY__, 'ESERVICES_DIGITALSERVICE_ADVANCED_MASK', 'DIGI-{0000}');

-- insertion setmod of Actes e-service
INSERT IGNORE INTO llx_const (entity, name, value) 
VALUES 
(__ENTITY__, 'ESERVICES_DIGITALSERVICE_ADDON', 'mod_digitalservice_advanced');

-- insertion Numerotation ofdemandes / ticket 
INSERT IGNORE INTO llx_const (entity, name, value) 
VALUES 
(__ENTITY__, 'TICKET_UNIVERSAL_MASK', 'DA{yy}{mm}{000@99}');

-- insertion setmod of Actes e-service
INSERT IGNORE INTO llx_const (entity, name, value) 
VALUES 
(__ENTITY__, 'TICKET_ADDON', 'mod_ticket_universal');

-- truncate ces tables pour vider les lignes que dolibarr ajoute et à l'activaction du module eservice les lignes
-- particulières de e-services seront ajoutée
TRUNCATE TABLE  llx_c_ticket_type;
TRUNCATE TABLE  llx_c_ticket_severity;
TRUNCATE TABLE  llx_c_ticket_category;

-- insertion type ticket 
INSERT IGNORE INTO llx_c_ticket_type (rowid, entity, code, label, pos, use_default) 
VALUES 
(1, __ENTITY__, 'ESERV', 'e-service', 5, 1);

-- insertion severite ticket 
INSERT IGNORE INTO llx_c_ticket_severity (rowid, entity, code, label, pos, use_default) 
VALUES 
(1, __ENTITY__, 'URG', 'Urgent', 5, 0),
(2, __ENTITY__, 'NORM', 'Normal', 5, 1),
(3, __ENTITY__, 'FAIB', 'Faible', 5, 0);

-- insertion categorie ticket 
INSERT IGNORE INTO llx_c_ticket_category (rowid, entity, code, label, pos, use_default, public) 
VALUES 
(1, __ENTITY__, 'GEN', 'Acte générique', 5, 1, 1),
(2, __ENTITY__, 'PRO', 'Acte personnalisé', 6, 0, 1);

-- insertion categorie/TAG  
INSERT IGNORE INTO llx_categorie (rowid, entity, label, type, description, color) 
VALUES 
(1, __ENTITY__, 'Demande Publique', 12, 'Demande Interface Publique', '007f00'),
(2, __ENTITY__, 'Demande Privée', 12, 'Demande Interface Privée', '0000bf');

-- insertion du document modèle à utiliser pour générer les documents à partir du template
INSERT IGNORE INTO llx_document_model (nom, type, entity, libelle, description) 
VALUES 
('generic_ticket_odt', 'ticket', __ENTITY__, 'ODT templates', 'TICKET_ADDON_PDF_ODT_PATH');

-- insertion du site web de l'interface d'accueil
INSERT IGNORE INTO llx_website (rowid, type_container, entity, ref, lang, description, status, fk_default_home, virtualhost) 
VALUES 
(1, 'page', __ENTITY__, 'service-support', 'fr', "Portail des Services de Support au Public", 1, 1, 'https://service-support.archidiocesedecotonou.org');

--insertion page d'accueil
INSERT IGNORE INTO llx_website_page (rowid, type_container, fk_website, pageurl, lang, description, status, title, content) 
VALUES 
(1, 'page', 1, 'service-support', 'fr', "Interface d'accueil - Portail Support Public", 1, 'Support Public - Archidiocèse de Cotonou', '');

-- insertion des url alternatives pour les interfaces création demande par entité
INSERT IGNORE INTO llx_const (entity, name, value) 
VALUES 
(1, 'TICKET_URL_PUBLIC_INTERFACE', 'https://service-support-secretariat.archidiocesedecotonou.org/'),
(2, 'TICKET_URL_PUBLIC_INTERFACE', 'https://service-support-economat.archidiocesedecotonou.org/'),
(3, 'TICKET_URL_PUBLIC_INTERFACE', 'https://service-support-chancellerie.archidiocesedecotonou.org/');

-- insertion des données dans table des motifs de voyage
INSERT IGNORE INTO llx_eservices_motifs_voyage (label)
VALUES
    ('Responsabilité de gouvernement au sein du diocèse'),
    ('Responsabilité au sein du gouvernement de l’institut'),
    ('Activité nationale de la CEF ou de la CORREF'),
    ('Rassemblement international'),
    ('Assemblée de congrégation'),
    ('Service pastoral'),
    ('Activités de l’institut'),
    ('Service dans une communauté'),
    ('Séjour linguistique avant de partir dans des pays francophones'),
    ('Formation en France avant départ pour un autre pays'),
    ('Formation interne à l’institut'),
    ('Séjour dans une communauté'),
    ('Laïc invité par institut ou diocèse'),
    ('Pèlerinage'),
    ('Visite à la famille ou à des amis'),
    ('Raisons médicales'),
    ('Congés annuels'),
    ("Service pastoral d'été"),
    ('Études'),
    ('Autre (à préciser)');

-- insertion des données dans table des situations pro
INSERT IGNORE INTO llx_eservices_situation_professionnelle (label)
VALUES
    ('Membre'),
    ('Novice'),
    ('Postulant'),
    ('Aspirant'),
    ('Laïc'),
    ('Prêtre'),
    ('Religieux'),
    ('Religieuse'),
    ('Diacre'),
    ('Vierge consacrée'),
    ('Marié'),
    ('Laïc consacré'),
    ('Laïque consacrée'),
    ('Moine'),
    ('Moniale'),
    ('Séminariste');

-- insertion des données dans table des civilités
INSERT IGNORE INTO llx_c_civility (code, label, module)
VALUES
    ('PERE', 'le Père', 'eservices'),
    ('SR', 'la Sœur', 'eservices'),
    ('MERE', 'la Mère', 'eservices'),
    ('FR', 'le Frère', 'eservices'),
    ('MGR', 'son Excellence Monseigneur', 'eservices'),
    ('ABBE', "l'Abbé", 'eservices'),
    ('CARD', 'son Eminence Cardinal', 'eservices');

-- insertion des données dans table des états de vie
INSERT IGNORE INTO llx_eservices_etat_vie (label)
VALUES
    ('Laïcs'),
    ('Prêtre'),
    ('Religieux'),
    ('Religieuse'),
    ('Diacre'),
    ('Vierge consacrée'),
    ('Marié'),
    ('Laïc consacré'),
    ('Laïque consacrée'),
    ('Veuf/Veuve'),
    ('Moine');

-- insertion des données dans table des diocèses congrégations et instituts
INSERT IGNORE INTO llx_eservices_diocese_congregation (label)
VALUES
    ('Oblates Catéchistes Petites Servantes des Pauvres (OCPSP)'),
    ('Sœurs de Saint Augustin du Bénin (SSA)'),
    ('Institut des Sœurs Franciscaines Filles de Padre Pio (ISFFPP)'),
    ('Sœurs de Notre-Dame des Apôtres (NDA)'),
    ('Institut Séculier Missionnaires de l’Amour Infini'),
    ('Sœurs de la Visitation de Sainte Marie'),
    ('Sœurs Franciscaines Missionnaires de la Mère du Divin Pasteur'),
    ('Sœurs Salesiennes de Don Bosco (Filles de Marie Auxiliatrice : FMA)'),
    ('Apôtres du Sacré-Cœur de Jésus'),
    ('Servantes de la Lumière du Christ'),
    ('Filles de Notre-Dame de l’Inculturation'),
    ('Sœurs de la Providence de la Pommeraye'),
    ('Moniales Bénédictines'),
    ('Filles de Saint Camille'),
    ('Sœurs Clarisses Capucines'),
    ('Filles de la Charité du Sacré-Cœur de Jésus'),
    ('Filles du Cœur de Marie'),
    ('Sœurs Franciscaines de l’Immaculée (FI)'),
    ('Sœurs Missionnaires de la Charité'),
    ('Petites Sœurs des Pauvres'),
    ('Sœurs de la Providence de Gap'),
    ('Sœurs Salésiennes de Don Bosco'),
    ('Filles du Sacré-Cœur de Jésus'),
    ('Sœurs du Saint Cœur de Marie et Sainte Union des Sacrés-Cœurs'),
    ('Sœurs Tertiaires Capucines de la Sainte Famille'),
    ('Sœurs Ursulines (FMI)'),
    ('Apôtres du Sacré-Cœur de Jésus'),
    ('Sœurs des Saints Cœurs de Jésus et Marie'),
    ('Sœurs Franciscaines Missionnaires de la Mère du Divin Pasteur'),
    ('Ordre des Vierges Consacrées'),
    ('Sœurs du Claire Amitié'),
    ('Frères Bénédictins'),
    ('Ordre des Serviteurs des Maladies (Religieux Camilliens)'),
    ('Missionnaires Comboniens'),
    ('Congrégation de Jésus et de Marie (Eudistes)'),
    ('Salésiens de Don Bosco (SDB)'),
    ('Frères des Ecoles Chrétiennes'),
    ('Fraternité Saint Dominique'),
    ('Frères de Jésus-Christ'),
    ('Frères Franciscains de l’Immaculée'),
    ('Ordre des Frères Mineurs Capucins (OFM CAP)'),
    ('Compagnie de Jésus (Jésuites)'),
    ('Société des Missions Africaines (SMA)'),
    ('Frères de Saint-Sulpice'),
    ('Diocèse de Cotonou'),
    ('Diocèse d’Abomey'),
    ('Diocèse de Djougou'),
    ('Diocèse de Lokossa'),
    ('Diocèse de Natitingou'),
    ('Diocèse de Parakou'),
    ('Diocèse de Porto-Novo'),
    ('Diocèse de Kandi'),
    ('Diocèse de Dassa-Zoumè'),
    ('Diocèse de N’Dali'),
    ('Autre (à préciser)');

--- insertion des données dans table des services
INSERT IGNORE INTO `llx_eservices_digitalservice` (`rowid`, `ref`, `label`, `status`, `entity`, `active`, `fk_user_creat`, `fk_user_modif`) VALUES
(1, 'DIGI-0001', 'Celebret', 1, __ENTITY__, 1, 1, NULL),
(2, 'DIGI-0002', 'Attestation de profession', 1, __ENTITY__, 1, 1, NULL),
(3, 'DIGI-0003', 'Attestation de voyage', 1, __ENTITY__, 1, 1, NULL),
(4, 'DIGI-0004', 'Attestation en vue d''une demande de remplacement', 1, __ENTITY__, 1, 1, NULL);