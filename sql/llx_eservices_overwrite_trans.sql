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

-- insertion des traduction
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'CashControl', 'Contrôle de caisse : Caisse');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TotalLT1', 'Total AIB');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TotalLT2', 'Total Taxe autre');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'AmountLT1', 'Montant AIB');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'LT1ReportByCustomers', 'Rapport AIB par Tiers');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'PointOfSaleShort', 'Caisse');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'Commercial', 'Achat');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'SupplierProposalsShort', "Demande d'achat");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'SupplierProposalNew', "Nouvelle demande d'achat");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'CommercialArea', 'Espace Achat|Vente');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'Customer', 'Fidèle');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TicketPublicPleaseBeAccuratelyDescribe', ' ');

--INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'CreateTicket', 'Créer une demande');

INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'ViewMyTicketList', 'Voir la liste de mes demandes');
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'ShowTicketWithTrackId', "Afficher la demande à partir de l'ID de suivi");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TicketPublicMsgViewLogIn', "Merci d'entrer le code de suivi de la demande");

--INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TicketList', "Liste des demandes");
--INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'Tickets', "Demandes");

INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'MesgInfosPublicTicketCreatedWithTrackId', "Une nouvelle demande a été créée avec l'ID %s et la référence %s");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'PleaseRememberThisId', "Merci de conserver le code de suivi de la demande, il vous sera peut-être nécessaire ultérieurement");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'ViewTicket', "Voir la demande");

--INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'NewTicket', "Nouvelle demande");

INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TicketPublicInterfaceTextHome', "Vous pouvez créer une demande ou consulter une demande à partir d'un ID existant.");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TicketPublicDesc', "Vous pouvez créer une demande ou consulter une demande à partir d'un ID existant.");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'LatestNewTickets', "Les %s dernières demandes (non lus)");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TicketLogMesgReadBy', "Demande %s lue par %s");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TICKET_MODIFYInDolibarr', "Demande %s modifiée");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TICKET_ASSIGNEDInDolibarr', "Demande %s assignée");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TICKET_DELETEInDolibarr', "Demande %s supprimée");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TICKET_CLOSEInDolibarr', "Demande %s fermée");
INSERT INTO llx_overwrite_trans (entity, lang, transkey, transvalue) VALUES (__ENTITY__, 'fr_FR', 'TICKET_CREATEInDolibarr', "Demande %s créée");