-- Copyright (C) 2024 Omega Fred Junior
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

-- configPointDeVente
-- 1 - créer le tiers fidèle pour insertion du tiers fidèle dans la table société
INSERT IGNORE INTO llx_societe (entity, nom, name_alias, code_client, ref_ext, fk_pays, tva_assuj, client, fournisseur) 
VALUES 
(__ENTITY__,'Tiers Fidèle','Tiers Fidèle','CU2404-00001',__ENTITY__,49,0,1,0);
-- insertion entrepôt par défauts services and products
INSERT IGNORE INTO llx_entrepot (entity, ref, description) 
VALUES 
(__ENTITY__, 'Entrepôt Service', 'Magasin-Stock du service');

-- Sélectionner le rowid du tiers client inséré
SELECT rowid INTO @tiers_rowid FROM llx_societe WHERE nom = 'Tiers Fidèle' AND entity = __ENTITY__;
-- Sélectionner le rowid de la caisse insérée
SELECT rowid INTO @caisse_rowid FROM llx_bank_account WHERE ref = 'CAISSE' AND entity = __ENTITY__;
-- Sélectionner le rowid de la banque
SELECT rowid INTO @banque_rowid FROM llx_bank_account WHERE ref = 'BANQUE' AND entity = __ENTITY__;
-- Sélectionner le rowid de l'entrepôt
SELECT rowid INTO @entrepot_rowid FROM llx_entrepot WHERE ref = 'Entrepôt Service' AND entity = __ENTITY__;
-- Sélectionner le rowid de la banque MOMO
SELECT rowid INTO @momo_rowid FROM llx_bank_account WHERE ref = 'MOMO' AND entity = __ENTITY__;
-- Sélectionner le rowid de la banque MOOV
SELECT rowid INTO @moov_rowid FROM llx_bank_account WHERE ref = 'MOOV' AND entity = __ENTITY__;

-- 2 - Config ON emploie IGNORE pour assurer des insertions ultérieurs en acceptant de perdre un peu de temps computer
INSERT IGNORE INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, 'TAKEPOS_TERMINAL_NAME_1', 'Caisse 1', 'chaine', 0, 'Tiers par défaut créé à la création'),
(__ENTITY__, 'CASHDESK_ID_THIRDPARTY1', @tiers_rowid, 'chaine', 0, 'Rowid du Tiers par défaut'),
(__ENTITY__, 'TAKEPOS_SORTPRODUCTFIELD', 'rowid', 'chaine', 0, 'tri catégorie par rowid'),
(__ENTITY__, 'CASHDESK_ID_BANKACCOUNT_CASH1', @caisse_rowid, 'chaine', 0, 'Caisse pour les espèces'),
(__ENTITY__, 'CASHDESK_ID_WAREHOUSE1', @entrepot_rowid, 'chaine', 0, 'Rowid du magasin-stock du service'),
(__ENTITY__, 'TAKEPOS_RECEIPT_NAME', 'Ticket-Fidele', 'chaine', 0, 'Nom du fichier ticket'),
(__ENTITY__, 'CASHDESK_ID_BANKACCOUNT_CHEQUE1', @banque_rowid, 'chaine', 0, 'Banque pour les chèques'),
(__ENTITY__, 'CASHDESK_ID_BANKACCOUNT_MOMO1', @momo_rowid, 'chaine', 0, 'Compte MOMO MONEY'),
(__ENTITY__, 'CASHDESK_ID_BANKACCOUNT_MOOV1', @moov_rowid, 'chaine', 0, 'Compte MOOV MONEY');

-- configDefaultaccounts
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_LENGTH_GACCOUNT", '8', 'chaine', 0, 'Longueur zéro');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_LENGTH_AACCOUNT", '8', 'chaine', 0, 'Longueur zéro');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_MANAGE_ZERO", '0', 'yesno', 0, 'utiliser Longueur zéro');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__,  "ACCOUNTING_ACCOUNT_CUSTOMER", '412', 'chaine', 0, 'Compte comptable par défaut pour les tiers "clients"');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_ACCOUNT_SUPPLIER", '4011', 'chaine', 0, 'Compte comptable par défaut pour les tiers "fournisseurs"');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "SALARIES_ACCOUNTING_ACCOUNT_PAYMENT", '42', 'chaine', 0, 'Compte comptable par défaut pour les tiers "salariés"');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_PRODUCT_SOLD_ACCOUNT", '7053', 'chaine', 0, 'Compte comptable par défaut pour les produits vendus');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_PRODUCT_BUY_ACCOUNT", '60', 'chaine', 0, 'Compte comptable par défaut pour les produits achetés');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_SERVICE_SOLD_ACCOUNT", '7045', 'chaine', 0, 'Compte comptable par défaut pour les services vendus');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_SERVICE_BUY_ACCOUNT", '601', 'chaine', 0, 'Compte comptable par défaut pour les services achetés dans le pays');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_VAT_SOLD_ACCOUNT", '443', 'chaine', 0, 'Compte comptable par défaut pour la TVA sur les ventes');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_VAT_BUY_ACCOUNT", '445', 'chaine', 0, 'Compte comptable par défaut pour la TVA sur les ventes');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_VAT_PAY_ACCOUNT", '444', 'chaine', 0, 'Compte comptable par défaut pour le paiement de la TVA');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_ACCOUNT_TRANSFER_CASH", '58', 'chaine', 0, 'Compte comptable par défaut pour les virements internes');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "DONATION_ACCOUNTINGACCOUNT", '704101', 'chaine', 0, 'Compte comptable pour la comptabilisation des dons');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "LOAN_ACCOUNTING_ACCOUNT_CAPITAL", '164', 'chaine', 0, 'Compte comptable à utiliser par défaut pour le capital');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "LOAN_ACCOUNTING_ACCOUNT_INTEREST", '6611', 'chaine', 0, 'Compte comptable à utiliser par défaut pour les intérêts');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_ACCOUNT_SUSPENSE", '471', 'chaine', 0, 'Compte comptable par défaut pour les opérations en attente');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_ACCOUNT_CUSTOMER_DEPOSIT", '4192', 'chaine', 0, 'Compte comptable par défaut pour enregistrer les acomptes client');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_ACCOUNT_SUPPLIER_DEPOSIT", '4091', 'chaine', 0, "Compte comptable par défaut pour enregistrer l'acompte fournisseur");
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_ACCOUNT_CUSTOMER_USE_AUXILIARY_ON_DEPOSIT", '1', 'chaine', 0, 'Enregistrer le compte client comme compte individuel');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ACCOUNTING_ACCOUNT_SUPPLIER_USE_AUXILIARY_ON_DEPOSIT", '1', 'chaine', 0, 'Utiliser le compte comptable auxiliaire fournisseur');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ESERVICES_COMPTE_JOURNAL_CAI", '571', 'chaine', 0, 'Compte associé au journal Banque');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ESERVICES_COMPTE_JOURNAL_BQ", '5211', 'chaine', 0, 'Compte associé au journal Caisse');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ESERVICES_COMPTE_JOURNAL_ECO", '5215', 'chaine', 0, 'Compte associé au journal Banque Economat');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ESERVICES_COMPTE_JOURNAL_MOMO", '5521', 'chaine', 0, 'Compte associé au journal Mobile Money');
INSERT INTO llx_const (entity, name, value, type, visible, note) 
VALUES 
(__ENTITY__, "ESERVICES_COMPTE_JOURNAL_MOOV", '5522', 'chaine', 0, 'Compte associé au journal Moov Money');

