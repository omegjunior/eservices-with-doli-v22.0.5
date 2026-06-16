--
-- Update des extrafields de tickets pour leur ajouter une position
--

UPDATE llx_extrafields SET pos = 5
WHERE name = 'identifiant_structure'
  AND elementtype = 'entity';

UPDATE llx_extrafields SET pos = 10
WHERE name = 'eservicelie'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 20
WHERE name = '1informationssurlauteurdelademande'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 30
WHERE name = 'statuts'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 40
WHERE name = 'nomprenomdemandeur'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 100
WHERE name = '1_2informationssurlebnficiaire'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 110
WHERE name = '1_nometprnom'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 120
WHERE name = '1_datedenaissance'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 130
WHERE name = '1_lieudenaissance'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 140
WHERE name = '1_nationalit'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 150
WHERE name = '1_datedordination'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 200
WHERE name = '2_2informationssurlebnficiaire'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 210
WHERE name = '2_titrecivilit'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 220
WHERE name = '2_nometprnom'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 230
WHERE name = '2_statutetatdevie'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 240
WHERE name = '2_fonctiondelapersonne'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 250
WHERE name = '2_diocsedemission'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 260
WHERE name = '2_adressedersidence'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 300
WHERE name = '3_2informationssurlebnficiaire'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 310
WHERE name = '3_titrecivilit'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 320
WHERE name = '3_nometprnom'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 330
WHERE name = '3_statutetatdevie'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 340
WHERE name = '3_sexe'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 350
WHERE name = '3_rattachement'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 360
WHERE name = '3_diocseinstitutcongrgation'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 370
WHERE name = '3_autrediocseinstitutcongrgation'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 380
WHERE name = '3_missionautreprcision'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 390
WHERE name = '3_3informationssurlesjour'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 400
WHERE name = '3_villededestination'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 410
WHERE name = '3_paysdedestination'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 420
WHERE name = '3_datededpart'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 430
WHERE name = '3_datederetour'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 440
WHERE name = '3_motifduvoyage'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 450
WHERE name = '3_autremotif'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 460
WHERE name = '3_identitetfonctiondelhte'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 470
WHERE name = '3_adressedesjour'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 500
WHERE name = '4_2informationssurlebnficiaire'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 510
WHERE name = '4_nometprnom'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 520
WHERE name = '4_diocseinstitutcongrgation'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 530
WHERE name = '4_autrediocseinstitutcongrgation'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 540
WHERE name = '4_missionautreprcision'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 550
WHERE name = '4_3informationssurleprojetderemplacement'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 560
WHERE name = '4_diocsededestination'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 570
WHERE name = '4_paysdedestination'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 580
WHERE name = '4_datededpart'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 590
WHERE name = '4_datederetour'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 600
WHERE name = '4_motifduvoyage'
  AND elementtype = 'ticket';

UPDATE llx_extrafields SET pos = 610
WHERE name = '4_autremotif'
  AND elementtype = 'ticket';

UPDATE llx_extrafields
SET param = 'a:1:{s:7:"options";a:2:{i:1;s:5:"Homme";i:2;s:5:"Femme";}}'
WHERE elementtype = 'ticket'
  AND name = '3_sexe';

UPDATE llx_extrafields
SET param = 'a:1:{s:7:"options";a:2:{i:1;s:8:"Diocèse";i:2;s:58:"Institut - Congrégation - Ordre - Société - Communauté";}}'
WHERE elementtype = 'ticket'
  AND name = '3_rattachement';