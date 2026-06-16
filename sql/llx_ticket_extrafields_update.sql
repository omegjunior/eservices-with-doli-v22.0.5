--
-- Module eServices - Adaptation des colonnes extrafields du ticket
--
-- Contexte métier :
-- Les formulaires de demande sont mutualisés dans l'objet Ticket et utilisent
-- plusieurs groupes d'extrafields correspondant à différents e-services
-- (préfixes 1_, 2_, 3_ et 4_).
--
-- Selon la valeur de l'extrafield "eservicelie", un hook supprime dynamiquement
-- les champs des autres services avant validation et enregistrement.
--
-- Les extrafields restent volontairement déclarés comme "required" dans
-- le descripteur du module afin que Dolibarr continue à générer les contrôles HTML
-- et les validations métier standard pour les champs réellement concernés
-- par le service sélectionné.
--
-- En revanche, au niveau SQL, les colonnes spécifiques aux services doivent
-- accepter NULL. Sans cela, en mode SQL strict (STRICT_TRANS_TABLES),
-- MariaDB refuse les INSERT lorsque les champs des services non sélectionnés
-- sont absents de la requête.
--
-- Ce script transforme donc les colonnes conditionnelles en NULLABLE tout en
-- conservant les validations fonctionnelles gérées par Dolibarr et le hook
-- de filtrage des extrafields.

-- Mise à jour des positions des extrafields pour les regrouper par service
-- et les différencier des autres extrafields de tickets.

ALTER TABLE llx_ticket_extrafields

-- Service 1
MODIFY COLUMN `1_nometprnom` varchar(50) NULL,
MODIFY COLUMN `1_datedenaissance` date NULL,
MODIFY COLUMN `1_lieudenaissance` varchar(30) NULL,
MODIFY COLUMN `1_nationalit` varchar(15) NULL,
MODIFY COLUMN `1_datedordination` date NULL,

-- Service 2
MODIFY COLUMN `2_titrecivilit` varchar(255) NULL,
MODIFY COLUMN `2_nometprnom` varchar(50) NULL,
MODIFY COLUMN `2_statutetatdevie` varchar(255) NULL,
MODIFY COLUMN `2_fonctiondelapersonne` varchar(100) NULL,
MODIFY COLUMN `2_diocsedemission` varchar(50) NULL,
MODIFY COLUMN `2_adressedersidence` varchar(50) NULL,

-- Service 3
MODIFY COLUMN `3_titrecivilit` varchar(255) NULL,
MODIFY COLUMN `3_nometprnom` varchar(50) NULL,
MODIFY COLUMN `3_statutetatdevie` varchar(255) NULL,
MODIFY COLUMN `3_sexe` varchar(255) NULL,
MODIFY COLUMN `3_rattachement` varchar(255) NULL,
MODIFY COLUMN `3_diocseinstitutcongrgation` varchar(255) NULL,
MODIFY COLUMN `3_villededestination` varchar(15) NULL,
MODIFY COLUMN `3_paysdedestination` varchar(255) NULL,
MODIFY COLUMN `3_datededpart` date NULL,
MODIFY COLUMN `3_datederetour` date NULL,
MODIFY COLUMN `3_motifduvoyage` varchar(255) NULL,
MODIFY COLUMN `3_identitetfonctiondelhte` varchar(150) NULL,
MODIFY COLUMN `3_adressedesjour` varchar(100) NULL,

-- Service 4
MODIFY COLUMN `4_nometprnom` varchar(50) NULL,
MODIFY COLUMN `4_diocseinstitutcongrgation` varchar(255) NULL,
MODIFY COLUMN `4_diocsededestination` varchar(15) NULL,
MODIFY COLUMN `4_paysdedestination` varchar(255) NULL,
MODIFY COLUMN `4_datededpart` date NULL,
MODIFY COLUMN `4_datederetour` date NULL,
MODIFY COLUMN `4_motifduvoyage` varchar(255) NULL;