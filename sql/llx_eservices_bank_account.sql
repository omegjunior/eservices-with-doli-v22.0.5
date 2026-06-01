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

-- insertion des comptes bancaires par défaut: une banque et une caisse
-- Sélectionner le journal caisse de l'entité
SELECT rowid INTO @journal_caisse_rowid FROM llx_accounting_journal WHERE code = 'CAI' AND entity = __ENTITY__;
-- insérer la caisse
INSERT INTO llx_bank_account (entity, ref, label, fk_pays, courant, account_number, fk_accountancy_journal, currency_code, datec)
SELECT 
    __ENTITY__,
    'CAISSE',
    'Caisse Principale',
    49,
    2,
    571,
    @journal_caisse_rowid,
    'XOF',
    NOW()    
WHERE NOT EXISTS (SELECT 1 FROM llx_bank_account  WHERE ref = 'CAISSE' AND entity = __ENTITY__);

-- mettre à jour le fk_accounting_category avec 39 qui correspond à la catégorie situation trésorerie
UPDATE llx_accounting_account SET fk_accounting_category = 39 WHERE account_number = '571' AND entity = __ENTITY__;

-- insérer le solde initial à 0
-- Sélectionner le rowid du compte caisse de l'entité
SELECT rowid INTO @caisse_rowid FROM llx_bank_account WHERE ref = 'CAISSE' AND entity = __ENTITY__;               
INSERT INTO llx_bank (datec, dateo, datev, label, amount, fk_user_author, fk_account, fk_type)
SELECT 
    NOW(),
    NOW(),
    NOW(),
    '(Solde initial)',
    0,
    1,
    @caisse_rowid,
    'SOLD' 
WHERE NOT EXISTS (SELECT 1 FROM llx_bank WHERE fk_account = @caisse_rowid AND fk_type = 'SOLD');

-- Sélectionner le journal trésorerie de l'entité
SELECT rowid INTO @journal_tresorerie_rowid FROM llx_accounting_journal WHERE code = 'BQ' AND entity = __ENTITY__;
-- insérer la banque
INSERT INTO llx_bank_account (entity, ref, label, fk_pays, courant, account_number, fk_accountancy_journal, currency_code, datec)
SELECT 
    __ENTITY__,
    'BANQUE',
    'Banque Principale',
    49,
    1,
    5211,
    @journal_tresorerie_rowid,
    'XOF',
    NOW()   
WHERE NOT EXISTS (SELECT 1 FROM llx_bank_account  WHERE ref = 'BANQUE' AND entity = __ENTITY__);

-- mettre à jour le fk_accounting_category avec 39 qui correspond à la catégorie situation trésorerie
UPDATE llx_accounting_account SET fk_accounting_category = 39 WHERE account_number = '5211' AND entity = __ENTITY__;

-- insérer le solde initial à 0
-- Sélectionner le rowid du compte caisse de l'entité
SELECT rowid INTO @banque_rowid FROM llx_bank_account WHERE ref = 'BANQUE' AND entity = __ENTITY__;               
INSERT INTO llx_bank (datec, dateo, datev, label, amount, fk_user_author, fk_account, fk_type)
SELECT 
    NOW(),
    NOW(),
    NOW(),
    '(Solde initial)',
    0,
    1,
    @banque_rowid,
    'SOLD' 
WHERE NOT EXISTS (SELECT 1 FROM llx_bank WHERE fk_account = @banque_rowid AND fk_type = 'SOLD');

-- Sélectionner le journal ECO de l'entité
SELECT rowid INTO @journal_eco_rowid FROM llx_accounting_journal WHERE code = 'ECO' AND entity = __ENTITY__;
-- insérer la banque ECO
INSERT INTO llx_bank_account (entity, ref, label, fk_pays, courant, account_number, fk_accountancy_journal, currency_code, datec)
SELECT 
    __ENTITY__,
    'ECONOMAT',
    'DÉPÔT Economat',
    49,
    1,
    5212,
    @journal_eco_rowid,
    'XOF',
    NOW()   
WHERE NOT EXISTS (SELECT 1 FROM llx_bank_account  WHERE ref = 'ECONOMAT' AND entity = __ENTITY__);

-- mettre à jour le fk_accounting_category avec 39 qui correspond à la catégorie situation trésorerie
UPDATE llx_accounting_account SET fk_accounting_category = 39 WHERE account_number = '5212' AND entity = __ENTITY__;

-- insérer le solde initial à 0
-- Sélectionner le rowid du compte caisse de l'entité
SELECT rowid INTO @economat_rowid FROM llx_bank_account WHERE ref = 'ECONOMAT' AND entity = __ENTITY__;               
INSERT INTO llx_bank (datec, dateo, datev, label, amount, fk_user_author, fk_account, fk_type)
SELECT 
    NOW(),
    NOW(),
    NOW(),
    '(Solde initial)',
    0,
    1,
    @economat_rowid,
    'SOLD' 
WHERE NOT EXISTS (SELECT 1 FROM llx_bank WHERE fk_account = @banque_rowid AND fk_type = 'SOLD');

-- Sélectionner le journal MOMO de l'entité
SELECT rowid INTO @journal_momo_rowid FROM llx_accounting_journal WHERE code = 'MOMO' AND entity = __ENTITY__;
-- insérer la banque MOMO
INSERT INTO llx_bank_account (entity, ref, label, fk_pays, courant, account_number, fk_accountancy_journal, currency_code, datec)
SELECT 
    __ENTITY__,
    'MOMO',
    'Mobile Money',
    49,
    1,
    5521,
    @journal_momo_rowid,
    'XOF',
    NOW()   
WHERE NOT EXISTS (SELECT 1 FROM llx_bank_account  WHERE ref = 'MOMO' AND entity = __ENTITY__);

-- mettre à jour le fk_accounting_category avec 39 qui correspond à la catégorie situation trésorerie
UPDATE llx_accounting_account SET fk_accounting_category = 39 WHERE account_number = '5521' AND entity = __ENTITY__;

-- insérer le solde initial à 0
-- Sélectionner le rowid du compte caisse de l'entité
SELECT rowid INTO @momo_rowid FROM llx_bank_account WHERE ref = 'MOMO' AND entity = __ENTITY__;               
INSERT INTO llx_bank (datec, dateo, datev, label, amount, fk_user_author, fk_account, fk_type)
SELECT 
    NOW(),
    NOW(),
    NOW(),
    '(Solde initial)',
    0,
    1,
    @momo_rowid,
    'SOLD' 
WHERE NOT EXISTS (SELECT 1 FROM llx_bank WHERE fk_account = @banque_rowid AND fk_type = 'SOLD');

-- Sélectionner le journal MOOV de l'entité
SELECT rowid INTO @journal_moov_rowid FROM llx_accounting_journal WHERE code = 'MOOV' AND entity = __ENTITY__;
-- insérer la banque MOOV
INSERT INTO llx_bank_account (entity, ref, label, fk_pays, courant, account_number, fk_accountancy_journal, currency_code, datec)
SELECT 
    __ENTITY__,
    'MOOV',
    'Moov Money',
    49,
    1,
    5522,
    @journal_moov_rowid,
    'XOF',
    NOW()   
WHERE NOT EXISTS (SELECT 1 FROM llx_bank_account  WHERE ref = 'MOOV' AND entity = __ENTITY__);

-- mettre à jour le fk_accounting_category avec 39 qui correspond à la catégorie situation trésorerie
UPDATE llx_accounting_account SET fk_accounting_category = 39 WHERE account_number = '5522' AND entity = __ENTITY__;

-- insérer le solde initial à 0
-- Sélectionner le rowid du compte caisse de l'entité
SELECT rowid INTO @moov_rowid FROM llx_bank_account WHERE ref = 'MOOV' AND entity = __ENTITY__;               
INSERT INTO llx_bank (datec, dateo, datev, label, amount, fk_user_author, fk_account, fk_type)
SELECT 
    NOW(),
    NOW(),
    NOW(),
    '(Solde initial)',
    0,
    1,
    @moov_rowid,
    'SOLD' 
WHERE NOT EXISTS (SELECT 1 FROM llx_bank WHERE fk_account = @banque_rowid AND fk_type = 'SOLD');