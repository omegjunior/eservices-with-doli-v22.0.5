<?php
/* Copyright (C) 2004-2018  Laurent Destailleur     <eldy@users.sourceforge.net>
 * Copyright (C) 2018-2019  Nicolas ZABOURI         <info@inovea-conseil.com>
 * Copyright (C) 2019-2020  Frédéric France         <frederic.france@netlogic.fr>
 * Copyright (C) 2024 Junior Omega
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *//**
 * 	\defgroup   eservices     Module Eservices
 *  \brief      Eservices module descriptor.
 *
 *  \file       htdocs/eservices/core/modules/modEservices.class.php
 *  \ingroup    eservices
 *  \brief      Description and activation file for module Eservices
 */
include_once DOL_DOCUMENT_ROOT.'/core/modules/DolibarrModules.class.php';/**
 *  Description and activation class for module Eservices
 */
class modEservices extends DolibarrModules
{
	/**
	 * @var string rowid charte modèle 'accountancy'
	 */
	public $chartofaccounts_model;	/**
	 * Constructor. Define names, constants, directories, boxes, permissions
	 *
	 * @param DoliDB $db Database handler
	 */
	public function __construct($db)
	{
		global $langs, $conf;
		$this->db = $db;		
		$this->chartofaccounts_model = ''; // TODO: Replace 'xxx' with the actual chart of accounts model
		// Id for module (must be unique).
		// Use here a free id (See in Home -> System information -> Dolibarr for list of used modules id).
		$this->numero = 500001; // TODO Go on page https://wiki.dolibarr.org/index.php/List_of_modules_id to reserve an id number for your module		// Key text used to identify module (for permissions, menus, etc...)
		$this->rights_class = 'eservices';		
		// Family can be 'base' (core modules),'crm','financial','hr','projects','products','ecm','technic' (transverse modules),'interface' (link with external tools),'other','...'
		// It is used to group modules by family in module setup page
		$this->family = "Fred Omega Junior";		
		// Module position in the family on 2 digits ('01', '10', '20', ...)
		$this->module_position = '90';		
		// Gives the possibility for the module, to provide his own family info and position of this family (Overwrite $this->family and $this->module_position. Avoid this)
		//$this->familyinfo = array('myownfamily' => array('position' => '01', 'label' => $langs->trans("MyOwnFamily")));
		// Module label (no space allowed), used if translation string 'ModuleEservicesName' not found (Eservices is name of module).
		$this->name = preg_replace('/^mod/i', '', get_class($this));		
		// Module description, used if translation string 'ModuleEservicesDesc' not found (Eservices is name of module).
		$this->description = "EservicesDescription";
		// Used only if file README.md and README-LL.md not found.
		$this->descriptionlong = "EservicesDescription";		
		// Author
		$this->editor_name = 'Omega Junior';
		$this->editor_url = '';		// Possible values for version are: 'development', 'experimental', 'dolibarr', 'dolibarr_deprecated', 'experimental_deprecated' or a version string like 'x.y.z'
		$this->version = '1.0';
		// Url to the file with your last numberversion of this module
		//$this->url_last_version = 'http://www.example.com/versionmodule.txt';		
		// Key used in llx_const table to save module status enabled/disabled (where ESERVICES is value of property name of module in uppercase)
		$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);		
		// Name of image file used for this module.
		// If file is in theme/yourtheme/img directory under name object_pictovalue.png, use this->picto='pictovalue'
		// If file is in module/img directory under name object_pictovalue.png, use this->picto='pictovalue@module'
		// To use a supported fa-xxx css style of font awesome, use this->picto='xxx'
		$this->picto = 'fa-cogs';		// Define some features supported by module (triggers, login, substitutions, menus, css, etc...)
		$this->module_parts = array(
			// Set this to 1 if module has its own trigger directory (core/triggers)
			'triggers' => 1,
			// Set this to 1 if module has its own login method file (core/login)
			'login' => 0,
			// Set this to 1 if module has its own substitution function file (core/substitutions)
			'substitutions' => 0,
			// Set this to 1 if module has its own menus handler directory (core/menus)
			'menus' => 0,
			// Set this to 1 if module overwrite template dir (core/tpl)
			'tpl' => 0,
			// Set this to 1 if module has its own barcode directory (core/modules/barcode)
			'barcode' => 0,
			// Set this to 1 if module has its own models directory (core/modules/xxx)
			'models' => 1,
			// Set this to 1 if module has its own printing directory (core/modules/printing)
			'printing' => 0,
			// Set this to 1 if module has its own theme directory (theme)
			'theme' => 0,
			// Set this to relative path of css file if module has its own css file
			'css' => array(
			    '/eservices/css/eservices.css.php',
			),
			// Set this to relative path of js file if module must load a js on all pages
			'js' => array(
				'/eservices/js/eservices.js.php',
			),
			// Set here all hooks context managed by module. To find available hook context, make a "grep -r '>initHooks(' *" on source code. You can also set hook context to 'all'
			'hooks' => array(
				   'data' => array(
				       'ticketsindex',
				       'publicnewticketcard',
					   'ticketcard',
					   'categoryindex',
					   'categorycard',
					   'ticketlist',
					   'thirdpartyticket',
					   'projectticket',
					   'actioncard',
					   'agendalist',
					   'ticketmessaging',
					   'documentticketcard',
					   'contactticketcard',
					   'ticketagenda',
					   'index',
					   'adminmodules',
					   'ticketstat',
					   'leftblock',
					   'ticketpubliclist',
					   'ticketpublicview',
					   'formfile',
					   'odtgeneration',
					   'fileslib',
					   //'main',
				   ),
				   'entity' => '0',
			),
			// Set this to 1 if features of module are opened to external users
			'moduleforexternal' => 0,
		);		
		// Data directories to create when module is enabled.
		// Example: this->dirs = array("/eservices/temp","/eservices/subdir");
		$this->dirs = array("/eservices/temp", '/eservices/doctemplates/demandes');
		// faire cela s'il s'agit de l'entité maître 
		if ((int) $conf->entity == 1){
			$this->dirs[] = "/eservices/churchdata/etl/data";
			$this->dirs[] = "/eservices/churchdata/etl/input";
		} /* else {
			//ajouter particule numero entité pour les autres
			$this->dirs[] = "/eservices/churchdata/etl/data/".$conf->entity;
			$this->dirs[] = "/eservices/churchdata/etl/input/".$conf->entity;
		} */
		// Config pages. Put here list of php page, stored into eservices/admin directory, to use to setup module.
		$this->config_page_url = array("setup.php@eservices");		// Dependencies
		// A condition to hide module
		$this->hidden = false;
		// List of module class names that must be enabled if this module is enabled. Example: array('always'=>array('modModuleToEnable1','modModuleToEnable2'), 'FR'=>array('modModuleToEnableFR')...)
		$this->depends = array(
			'always1'=>'modSociete','always2'=>'modAccounting', 'always3'=>'modCron','always4'=>'modMultiCompany','always5'=>'modMemcached',
			'always6'=>'modImport','always7'=>'modSyslog','always8'=>'modExport','always9'=>'modBlockedLog','always10'=>'modAbricot','always11'=>'modListInCSV',
			'always12'=>'modmulticlone','always13'=>'modBanque','always14'=>'modFacture','always15'=>'modTicket','always16'=>'modECM',
			'always17'=>'modCategorie','always18'=>'modAgenda','always19'=>'modAgenda','always20'=>'modBookmark',
		);
		// List of module class names to disable if this one is disabled. Example: array('modModuleToDisable1', ...)
		$this->requiredby = array();
		// List of module class names this module is in conflict with. Example: array('modModuleToDisable1', ...)
		$this->conflictwith = array();		// The language file dedicated to your module
		$this->langfiles = array("eservices@eservices");		// Prerequisites
		$this->phpmin = array(7, 0); // Minimum version of PHP required by module
		$this->need_dolibarr_version = array(11, -3); // Minimum version of Dolibarr required by module
		$this->need_javascript_ajax = 0;		// Messages at activation
		$this->warnings_activation = array(); // Warning to show when we activate module. array('always'='text') or array('FR'='textfr','MX'='textmx'...)
		$this->warnings_activation_ext = array(); // Warning to show when we activate an external module. array('always'='text') or array('FR'='textfr','MX'='textmx'...)
		$this->automatic_activation = array('BJ'=>'EservicesWasAutomaticallyActivatedBecauseOfYourCountryChoice');
		//$this->always_enabled = true;								// If true, can't be disabled		// Constants
		// List of particular constants to add when module is enabled (key, 'chaine', value, desc, visible, 'current' or 'allentities', deleteonunactive)
		// Example: $this->const=array(1 => array('ESERVICES_MYNEWCONST1', 'chaine', 'myvalue', 'This is a constant to add', 1),
		//                             2 => array('ESERVICES_MYNEWCONST2', 'chaine', 'myvalue', 'This is another constant to add', 0, 'current', 1)
		// );
		$num_entity = $conf->entity == 1? '' : $conf->entity.'/';
		$this->const = array();		
		$constants[] = array('FACTURE_DEPOSITS_ARE_JUST_PAYMENTS', 'chaine', '1', 'Acompte comme paiement', 1, 'allentities', 1);
		$constants[] = array('MAIN_DISABLE_FREE_LINES', 'chaine', '1', 'Désactiver lignes libres', 1, 'allentities', 1);
		$constants[] = array('MAIN_FEATURES_LEVEL', 'chaine', '2', 'Modules level', 1, 'allentities', 1);
		$constants[] = array('MAIN_SERVER_TZ', 'chaine', 'Africa/Porto-Novo', 'Time Zone Bénin', 0, 'allentities', 1);
		$constants[] = array('MAIN_PDF_DONOTREPEAT_HEAD', 'chaine', '1', 'Ne pas répéter les entêtes après la 1ere page sur les documents', 0, 'allentities', 1);		
		$constants[] = array('MAIN_LIMIT_FOR_MASS_ACTIONS', 'chaine', '1000', 'Limiter à 1000 le nombre de lignes dans mass action', 1, 'allentities', 1);
		$constants[] = array('MAIN_ENABLE_DEFAULT_VALUES', 'chaine', '1', 'Activer les valeurs par défauts dans les url', 1, 'allentities', 1);
		$constants[] = array('SOCIETE_DISABLE_PROSPECTS', 'chaine', '1', 'Désactiver prospects dans les tiers', 0, 'allentities', 1);
		$constants[] = array('BOOKMARKS_SHOW_IN_MENU', 'chaine', '5', 'Nombre de bookmark à afficher', 1, 'allentities', 1);
		$constants[] = array('BANK_COLORIZE_MOVEMENT', 'chaine', '1', 'Colorer les mouvements bancaires', 1, 'allentities', 1);
		$constants[] = array('BANK_COLORIZE_MOVEMENT_COLOR1', 'chaine', 'ffd4aa', 'Colorer les mouvements bancaires', 1, 'allentities', 1);
		$constants[] = array('BANK_COLORIZE_MOVEMENT_COLOR2', 'chaine', '56ffaa', 'Colorer les mouvements bancaires', 1, 'allentities', 1);
		$constants[] = array('MAIN_MAX_DECIMALS_UNIT', 'chaine', '0', 'Nombre de décimales maximum pour les prix unitaires', 0, 'allentities', 1);
		$constants[] = array('MAIN_MAX_DECIMALS_TOT', 'chaine', '0', 'Nombre de décimales maximum pour les prix totaux', 0, 'allentities', 1);
		$constants[] = array('MAIN_MAX_DECIMALS_SHOWN', 'chaine', '2', "Nombre de décimales maximum pour les montants affichés à l'écran", 0, 'allentities', 1);
		$constants[] = array('THEME_ELDY_TOPMENU_BACK1', 'chaine', '57,79,102', "Couleur de fond pour le menu Haut", 0, 'allentities', 1);
		$constants[] = array('THEME_ELDY_VERMENU_BACK1', 'chaine', '232,244,244', "Couleur de fond pour le menu Gauche", 0, 'allentities', 1);
		$constants[] = array('THEME_ELDY_BACKTITLE1', 'chaine', '233,234,237', "Couleur de fond pour la ligne de titres des listes/tableaux", 0, 'allentities', 1);
		$constants[] = array('THEME_ELDY_TEXTTITLE', 'chaine', '40,40,60', "Couleur du texte pour la ligne de titre des tableaux", 0, 'allentities', 1);
		$constants[] = array('THEME_ELDY_BTNACTION', 'chaine', '26,26,28', "Couleur du bouton d'action", 0, 'allentities', 1);
		$constants[] = array('THEME_ELDY_TEXTBTNACTION', 'chaine', '255,255,255', "Couleur du bouton d'action", 0, 'allentities', 1);		
		$constants[] = array('MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_HELP_DISABLELINK', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_MENU_HIDE_UNAUTHORIZED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_BUTTON_HIDE_UNAUTHORIZED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('THEME_ELDY_USEBORDERONTABLE', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_MOTD', 'chaine', '__USER_FULLNAME__<br> Agréable journée de travail dans le Saint Nom du Seigneur', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_HOME', 'chaine', 'Bienvenue sur Support-Public - le portail des services support au public du diocèse de Cotonou', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_HELPCENTER_DISABLELINK', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USER_CREATE', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USER_MODIFY', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USER_NEW_PASSWORD', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USER_ENABLEDISABLE', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USERGROUP_DELETE', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USER_LOGIN', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USER_LOGIN_FAILED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USER_LOGOUT', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USERGROUP_CREATE', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USERGROUP_MODIFY', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_LOGEVENTS_USER_DELETE', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_HIDE_LOGIN_COMBOBOX', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_NO_TOP_MENU_ENTITY_LABEL', 'chaine', '0', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_ACTIVE_BY_DEFAULT', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_VISIBLE_BY_DEFAULT', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_TRANSVERSE_MODE', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_SHARINGS_ENABLED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_SHARING_BYELEMENT_ENABLED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_THIRDPARTY_SHARING_ENABLED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_CATEGORY_SHARING_ENABLED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_ACCOUNTING_JOURNAL_CUSTOM_ENABLED', 'chaine', '1', "", 0, 'allentities', 1);		
		$constants[] = array('MULTICOMPANY_CATEGORY_SHARE_ALL_BY_DEFAULT', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_CATEGORY_SHARING_BYELEMENT_ENABLED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('MULTICOMPANY_MEMCACHED_ENABLED', 'chaine', '1', "", 0, 'allentities', 1);
		$constants[] = array('BLOCKEDLOG_DISABLE_NOT_ALLOWED_FOR_COUNTRY', 'chaine', 'BJ', "", 0, 'allentities', 1);
		$constants[] = array('SYSLOG_LEVEL', 'chaine', '7', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_SECURITY_DISABLEFORGETPASSLINK', 'chaine', '0', "", 0, 'allentities', 1);
		$constants[] = array('MAIN_APPLICATION_TITLE', 'chaine', 'Archidiocèse de Cotonou - Support Public', "Titre application", 0, 'allentities', 1);
		$constants[] = array('MAIN_INFO_SOCIETE_COUNTRY', 'chaine', '49:BJ:Bénin', "Pays", 0, 'current', 1);
		$constants[] = array('TICKET_PUBLIC_TEXT_HELP_MESSAGE', 'chaine', '', "Message d'aide", 0, 'current', 1);
		$constants[] = array('MAIN_CHECKBOX_LEFT_COLUMN', 'chaine', '0', "Afficher à gauche multiSelectArrayWithCheckbox ", 0, 'allentities', 1);
		$constants[] = array('ESERVICES_TITLE_PUBLIC', 'chaine', 'service-support', "Préfix par défaut du titre de la page interface publique", 0, 'allentities', 1);
		$constants[] = array('TICKET_PUBLIC_INTERFACE_TOPIC', 'chaine', '0', "Ne pas afficher un topic en substitution du logo", 0, 'current', 1);
		$constants[] = array('MAIN_FAVICON_URL', 'chaine', '', "", 0, 'current', 1);
		$constants[] = array('MAIN_HIDE_POWERED_BY', 'chaine', '1', "Cacher le powered by dolibarr", 0, 'current', 1);
		$constants[] = array('TICKET_SHOW_COMPANY_LOGO', 'chaine', '0', "ne pas afficher logo - inacessible en interface publique", 0, 'current', 1);
		$constants[] = array('TICKET_IMAGE_PUBLIC_INTERFACE', 'chaine', '/documents/'.$num_entity.'mycompany/logos/'.getDolGlobalString('MAIN_INFO_SOCIETE_LOGO'), "image interface publique - lien relatif par rapport au sous domaine", 0, 'current', 1);
		$constants[] = array('TICKET_SHOW_COMPANY_FOOTER', 'chaine', '0', "Ne pas afficher le pied de page sur l'interface publique", 0, 'allentities', 1);
		$constants[] = array('FACTURE_TVAOPTION', 'chaine', '0', "Le taux de TVA proposé par défaut est 0", 0, 'current', 1);
		$constants[] = array('MAIN_SECURITY_ENABLECAPTCHA_TICKET', 'chaine', '1', "Captcha antispam", 0, 'current', 1);		
		$constants[] = array('TICKET_ENABLE_PUBLIC_INTERFACE', 'chaine', '1', "Interface publique activée", 0, 'current', 1);	
		$constants[] = array('MAIN_SECURITY_MAX_ATTACHMENT_ON_FORMS', 'chaine', '3', "Nombre de fichiers qu'on peut joindre", 1, 'current', 1);	
		$constants[] = array('TICKET_ADDON_PDF_ODT_PATH', 'chaine', 'DOL_DATA_ROOT/eservices/doctemplates/demandes', 'Demande templates ODT/ODS directory for templates', 0, 'current', 1);	
		$constants[] = array('TICKET_ADDON_PDF', 'chaine', 'generic_ticket_odt', 'fixer les odt comme doctemplate par défaut', 0, 'current', 1);	
		$constants[] = array('TICKET_DELAY_BEFORE_FIRST_RESPONSE', 'chaine', '1', 'Délai avant la première réponse (en heures)', 0, 'current', 1);	
		//ajout des constantes pour les fichiers de rapportage
		$constants[] = array('ESERVICES_KPI_FILE', 'chaine', 'FicheCollecteKPI.xlsx', 'Nom du fichier de collecte des KPI', 0, 'allentities', 1);
		$constants[] = array('ESERVICES_PTA_FILE', 'chaine', 'Suivi_PTA_PSAP2_SR_02.xlsx', 'Nom du fichier de suivi des PTA', 0, 'allentities', 1);
		$constants[] = array('ESERVICES_INDIC_MESURE_FILE', 'chaine', 'ListeKpiIndicateursMesures.xlsx', "Nom du fichier des indicateurs et mesures d'activités", 0, 'allentities', 1);

		//fixation des valeurs de l'IP Memcach
		if(empty(getDolGlobalString('MEMCACHED_SERVER'))) $constants[] = array('MEMCACHED_SERVER', 'chaine', '35.85.218.29:11211', "", 0, 'allentities', 1);
		if(empty(getDolGlobalString('MULTICOMPANY_MEMCACHED_SERVER'))) $constants[] = array('MULTICOMPANY_MEMCACHED_SERVER', 'chaine', '35.85.218.29:11211', "", 0, 'allentities', 1);			
		$this->chartofaccounts_model = getDolGlobalInt('CHARTOFACCOUNTS',0);
		//récupérer le rowid de sycebnl et initialiser le SYCEBNL-BJ comme CHARTOFACCOUNTS par défaut des entités
		if(empty($this->chartofaccounts_model)){
			$sql  = "SELECT rowid ";
			$sql .= "FROM ".MAIN_DB_PREFIX."accounting_system ";
			$sql .= "WHERE fk_country = 49 AND pcg_version = 'SYCEBNL-BJ'";
			$resql2 = $db->query($sql);
			if ($resql2) {
				$chartofaccount_obj = $db->fetch_object($resql2);
				$this->chartofaccounts_model = $chartofaccount_obj->rowid;
				$constants[] = array('CHARTOFACCOUNTS', 'chaine', $this->$chartofaccounts_model, 'Chartofaccount des entities', 0, 'current', 1);
			}		
		}
		
		// Assignez le tableau de constantes à $this->const
		$this->const = $constants;		
		// Some keys to add into the overwriting translation tables
		$this->overwrite_translation = array(
			'en_US:ParentCompany'=>'Parent company or reseller',
			'fr_FR:ParentCompany'=>'Maison mère ou revendeur',
		);		
		if (!isset($conf->eservices) || !isset($conf->eservices->enabled)) {
			$conf->eservices = new stdClass();
			$conf->eservices->enabled = 0;
		}		// Array to add new pages in new tabs
		$this->tabs = array();
		// Example:
		// $this->tabs[] = array('data'=>'objecttype:+tabname1:Title1:mylangfile@eservices:$user->rights->eservices->read:/eservices/mynewtab1.php?id=__ID__');  					// To add a new tab identified by code tabname1
		// $this->tabs[] = array('data'=>'objecttype:+tabname2:SUBSTITUTION_Title2:mylangfile@eservices:$user->rights->othermodule->read:/eservices/mynewtab2.php?id=__ID__',  	// To add another new tab identified by code tabname2. Label will be result of calling all substitution functions on 'Title2' key.
		// $this->tabs[] = array('data'=>'objecttype:-tabname:NU:conditiontoremove');                                                     										// To remove an existing tab identified by code tabname
		//
		// Where objecttype can be
		// 'categories_x'	  to add a tab in category view (replace 'x' by type of category (0=product, 1=supplier, 2=customer, 3=member)
		// 'contact'          to add a tab in contact view
		// 'contract'         to add a tab in contract view
		// 'group'            to add a tab in group view
		// 'intervention'     to add a tab in intervention view
		// 'invoice'          to add a tab in customer invoice view
		// 'invoice_supplier' to add a tab in supplier invoice view
		// 'member'           to add a tab in fundation member view
		// 'opensurveypoll'	  to add a tab in opensurvey poll view
		// 'order'            to add a tab in sale order view
		// 'order_supplier'   to add a tab in supplier order view
		// 'payment'		  to add a tab in payment view
		// 'payment_supplier' to add a tab in supplier payment view
		// 'product'          to add a tab in product view
		// 'propal'           to add a tab in propal view
		// 'project'          to add a tab in project view
		// 'stock'            to add a tab in stock view
		// 'thirdparty'       to add a tab in third party view
		// 'user'             to add a tab in user view		// Dictionaries
		$this->dictionaries = array();
		/* Example:*/
		$this->dictionaries=array(
			// List of tables we want to see into dictonnary editor
			'tabname'=>array("eservices_list_actes",
							 "eservices_form_elements",
							 "eservices_motifs_voyage",
							 "eservices_situation_professionnelle",
							 "eservices_etat_vie",
							 "eservices_diocese_congregation",
							),
			// Label of tables
			'tablib'=>array("list_actes",
							"form_elements",
							"eservices_motifs_voyage",
							"eservices_situation_professionnelle",
							"eservices_etat_vie",
							"eservices_diocese_congregation",
							),
			// Request to select fields
			'tabsql'=>array('SELECT f.rowid as rowid, f.label, f.status FROM '.MAIN_DB_PREFIX.'eservices_list_actes as f WHERE entity ='.((int) $conf->entity),
							'SELECT f.rowid as rowid, f.label, f.fk_acte, f.status FROM '.MAIN_DB_PREFIX.'eservices_form_elements as f WHERE entity ='.((int) $conf->entity),
							'SELECT f.rowid as rowid, f.label, f.active FROM '.MAIN_DB_PREFIX.'eservices_motifs_voyage as f',
							'SELECT f.rowid as rowid, f.label, f.active FROM '.MAIN_DB_PREFIX.'eservices_situation_professionnelle as f',
							'SELECT f.rowid as rowid, f.label, f.active FROM '.MAIN_DB_PREFIX.'eservices_etat_vie as f',
							'SELECT f.rowid as rowid, f.label, f.active FROM '.MAIN_DB_PREFIX.'eservices_diocese_congregation as f',
							),
			// Sort order
			'tabsqlsort'=>array("rowid ASC","rowid ASC","label ASC","label ASC","label ASC","label ASC"),
			// List of fields (result of select to show dictionary)
			'tabfield'=>array("label,status","label,fk_acte,status","label","label","label","label"),
			// List of fields (list of fields to edit a record)
			'tabfieldvalue'=>array("label,status","label,fk_acte,status","label","label","label","label"),
			// List of fields (list of fields for insert)
			'tabfieldinsert'=>array("label,status,entity","label,fk_acte,status,entity","label","label","label","label"),
			// Name of columns with primary key (try to always name it 'rowid')
			'tabrowid'=>array("","","","","",""),
			// Condition to show each dictionary
			'tabcond'=>array(isModEnabled('eservices'), isModEnabled('eservices'), isModEnabled('eservices'), isModEnabled('eservices'), isModEnabled('eservices'), isModEnabled('eservices')),
			// Tooltip for every fields of dictionaries: DO NOT PUT AN EMPTY ARRAY
			'tabhelp'=>array(array('label'=>$langs->trans('labelTooltipHelp'), 'status'=>$langs->trans('StatusTooltipHelp')),
							array('label'=>$langs->trans('labelTooltipHelp'), 'fk_acte'=>$langs->trans('fk_acteTooltipHelp'), 'status'=>$langs->trans('StatusTooltipHelp')),
							array('label'=>$langs->trans('labelmotifTooltipHelp')),
							array('label'=>$langs->trans('labelsituationproTooltipHelp')),
							array('label'=>$langs->trans('labeletatdevieTooltipHelp')),
							array('label'=>$langs->trans('labeldioceseinstitutTooltipHelp')),
			)
		);
				// Boxes/Widgets
		// Add here list of php file(s) stored in eservices/core/boxes that contains a class to show a widget.
		$this->boxes = array(
			//  0 => array(
			//      'file' => 'eserviceswidget1.php@eservices',
			//      'note' => 'Widget provided by Eservices',
			//      'enabledbydefaulton' => 'Home',
			//  ),
			//  ...
		);		// Cronjobs (List of cron jobs entries to add when module is enabled)
		// unit_frequency must be 60 for minute, 3600 for hour, 86400 for day, 604800 for week
		$this->cronjobs = array(
			//  0 => array(
			//      'label' => 'MyJob label',
			//      'jobtype' => 'method',
			//      'class' => '/eservices/class/formulaire.class.php',
			//      'objectname' => 'Formulaire',
			//      'method' => 'doScheduledJob',
			//      'parameters' => '',
			//      'comment' => 'Comment',
			//      'frequency' => 2,
			//      'unitfrequency' => 3600,
			//      'status' => 0,
			//      'test' => 'isModEnabled("eservices")',
			//      'priority' => 50,
			//  ),
		);
		// Example: $this->cronjobs=array(
		//    0=>array('label'=>'My label', 'jobtype'=>'method', 'class'=>'/dir/class/file.class.php', 'objectname'=>'MyClass', 'method'=>'myMethod', 'parameters'=>'param1, param2', 'comment'=>'Comment', 'frequency'=>2, 'unitfrequency'=>3600, 'status'=>0, 'test'=>'isModEnabled("eservices")', 'priority'=>50),
		//    1=>array('label'=>'My label', 'jobtype'=>'command', 'command'=>'', 'parameters'=>'param1, param2', 'comment'=>'Comment', 'frequency'=>1, 'unitfrequency'=>3600*24, 'status'=>0, 'test'=>'isModEnabled("eservices")', 'priority'=>50)
		// );		// Permissions provided by this module
		$this->rights = array();
		$r = 0;
		// Add here entries to declare new permissions
		/* BEGIN MODULEBUILDER PERMISSIONS */
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (0 * 10) + 0 + 1);
		$this->rights[$r][1] = 'Lire les e-services disponibles';
		$this->rights[$r][4] = 'formulaire';
		$this->rights[$r][5] = 'read';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (0 * 10) + 1 + 1);
		$this->rights[$r][1] = 'Créer/Mettre à jour un e-service';
		$this->rights[$r][4] = 'formulaire';
		$this->rights[$r][5] = 'write';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (0 * 10) + 2 + 1);
		$this->rights[$r][1] = 'Supprimer un e-service';
		$this->rights[$r][4] = 'formulaire';
		$this->rights[$r][5] = 'delete';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (1 * 10) + 0 + 1);
		$this->rights[$r][1] = 'Lire un service digital';
		$this->rights[$r][4] = 'digitalservice';
		$this->rights[$r][5] = 'read';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (1 * 10) + 1 + 1);
		$this->rights[$r][1] = 'Créer/Modifier un service digital';
		$this->rights[$r][4] = 'digitalservice';
		$this->rights[$r][5] = 'write';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (1 * 10) + 2 + 1);
		$this->rights[$r][1] = 'Supprimer un service digital';
		$this->rights[$r][4] = 'digitalservice';
		$this->rights[$r][5] = 'delete';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (1 * 10) + 3 + 1);
		$this->rights[$r][1] = 'Charger des templates de document à générer';
		$this->rights[$r][4] = 'doctemplate';
		$this->rights[$r][5] = 'read';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (2 * 10) + 0 + 1);
		$this->rights[$r][1] = 'Lire les demandes';
		$this->rights[$r][4] = 'demande';
		$this->rights[$r][5] = 'read';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (2 * 10) + 1 + 1);
		$this->rights[$r][1] = 'Créer des demandes';
		$this->rights[$r][4] = 'demande';
		$this->rights[$r][5] = 'write';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf('%02d', (2 * 10) + 2 + 1);
		$this->rights[$r][1] = 'Supprimer des demandes';
		$this->rights[$r][4] = 'demande';
		$this->rights[$r][5] = 'delete';
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf("%02d", (3 * 10) + 0 + 1); // Permission id (must not be already used)
		$this->rights[$r][1] = 'Administrer OPcache'; // Permission label
		$this->rights[$r][4] = 'opcacheadmin';
		$this->rights[$r][5] = 'read'; // In php code, permission will be checked by test if ($user->rights->eservices->myobject->delete)
		$r++;

		/* END MODULEBUILDER PERMISSIONS */		// Main menu entries to add
		$this->menu = array();
		$r = 0;
		// Add here entries to declare new menus
		/* BEGIN MODULEBUILDER TOPMENU */
		$this->menu[$r++] = array(
			'fk_menu'=>'', // '' if this is a top menu. For left menu, use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy' where xxx is mainmenucode and yyy is a leftmenucode
			'type'=>'top', // This is a Top menu entry
			'titre'=>'ModuleEservicesName',
			'prefix' => img_picto('', $this->picto, 'class="paddingright pictofixedwidth valignmiddle"'),
			'mainmenu'=>'eservices',
			'leftmenu'=>'',
			'url'=>'/eservices/eservicesindex.php',
			'langs'=>'eservices@eservices', // Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
			'position'=>1000 + $r,
			'enabled'=>'isModEnabled("eservices")', // Define condition to show or hide menu entry. Use 'isModEnabled("eservices")' if entry must be visible if module is enabled.
			'perms'=>'1', // Use 'perms'=>'$user->hasRight("eservices", "formulaire", "read")' if you want your menu with a permission rules
			'target'=>'',
			'user'=>0, // 0=Menu for internal users, 1=external users, 2=both
		);
		/* END MODULEBUILDER TOPMENU */

		/*LEFTMENU DIGITALSERVICE*/
		$this->menu[$r++]=array(
			'fk_menu'=>'fk_mainmenu=eservices',
			'type'=>'left',
			'titre'=>'Digitalservice',
			'prefix' => img_picto('', $this->picto, 'class="paddingright pictofixedwidth valignmiddle"'),
			'mainmenu'=>'eservices',
			'leftmenu'=>'digitalservice_digitalservice',
			'url'=>'/eservices/eservicesindex.php',
			'langs'=>'eservices@eservices',
			'position'=>1000+$r,
			'enabled'=>'$conf->eservices->enabled',
			'perms'=>'1',
			'target'=>'',
			'user'=>0,
		);
		$this->menu[$r++]=array(
            'fk_menu'=>'fk_mainmenu=eservices,fk_leftmenu=digitalservice_digitalservice',
            'type'=>'left',
            'titre'=>'New_Digitalservice',
            'mainmenu'=>'eservices',
            'leftmenu'=>'eservices_digitalservice_new',
            'url'=>'/eservices/digitalservice_card.php?action=create',
            'langs'=>'eservices@eservices',
            'position'=>1000+$r,
            'enabled'=>'$conf->eservices->enabled',
            'perms'=>'1',
            'target'=>'',
            'user'=>0
        );
		/* LEFTMENU FORMULAIRE_CHAMP_NEW */
		$this->menu[$r++]=array(
			'fk_menu' =>'fk_mainmenu=eservices,fk_leftmenu=digitalservice_digitalservice',
			'type' =>'left',
			'titre' =>'Formulaire_Champ_New',
			'mainmenu' =>'eservices',
			'leftmenu' =>'eservices_new_formulaire_champ',
			'url' =>'/eservices/champformulaire_card.php?action=create',
			'langs' =>'eservices@eservices',
			'position' =>1000 + $r,
			'enabled' =>'$conf->eservices->enabled',
			'perms' =>'1',
			'target' =>'',
			'user' =>0,
		);
        $this->menu[$r++]=array(
            'fk_menu'=>'fk_mainmenu=eservices,fk_leftmenu=digitalservice_digitalservice',
            'type'=>'left',
            'titre'=>'List_Digitalservice',
            'mainmenu'=>'eservices',
            'leftmenu'=>'eservices_digitalservice_list',
            'url'=>'/eservices/digitalservice_list.php',
            'langs'=>'eservices@eservices',
            'position'=>1000+$r,
            'enabled'=>'$conf->eservices->enabled',
            'perms'=>'1',
            'target'=>'',
            'user'=>0,
        );
		/* LEFTMENU FORMULAIRE_CHAMP_LIST */
		$this->menu[$r++]=array(
			'fk_menu' =>'fk_mainmenu=eservices,fk_leftmenu=digitalservice_digitalservice',
			'type' =>'left',
			'titre' =>'Formulaire_Champ_List',
			'mainmenu' =>'eservices',
			'leftmenu' =>'eservices_list_champ_formulaire',
			'url' =>'/eservices/champformulaire_list.php',
			'langs' =>'eservices@eservices',
			'position' =>1000 + $r,
			'enabled' =>'$conf->eservices->enabled',
			'perms' =>'1',
			'target' =>'',
			'user' =>0,
		);
		$this->menu[$r++]=array(
			'fk_menu' =>'fk_mainmenu=eservices,fk_leftmenu=digitalservice_digitalservice',
			'type' =>'left',
			'titre' =>'Doctemplate',
			'mainmenu' =>'eservices',
			'leftmenu' =>'eservices_doctemplate',
			'url' =>'/eservices/doctemplate.php',
			'langs' =>'eservices@eservices',
			'position' =>1000 + $r,
			'enabled' =>'$conf->eservices->enabled',
			'perms' =>'$user->hasRight("eservices", "doctemplate", "read")',
			'target' =>'',
			'user' =>0,
		);

		/*END LEFTMENU DIGITALSERVICE*/
		/* END MODULEBUILDER LEFTMENU MYOBJECT */
		// Exports profiles provided by this module
		$r = 1;
		/* BEGIN MODULEBUILDER EXPORT MYOBJECT */
		/*
		$langs->load("eservices@eservices");
		$this->export_code[$r]=$this->rights_class.'_'.$r;
		$this->export_label[$r]='FormulaireLines';	// Translation key (used only if key ExportDataset_xxx_z not found)
		$this->export_icon[$r]='formulaire@eservices';
		// Define $this->export_fields_array, $this->export_TypeFields_array and $this->export_entities_array
		$keyforclass = 'Formulaire'; $keyforclassfile='/eservices/class/formulaire.class.php'; $keyforelement='formulaire@eservices';
		include DOL_DOCUMENT_ROOT.'/core/commonfieldsinexport.inc.php';
		//$this->export_fields_array[$r]['t.fieldtoadd']='FieldToAdd'; $this->export_TypeFields_array[$r]['t.fieldtoadd']='Text';
		//unset($this->export_fields_array[$r]['t.fieldtoremove']);
		//$keyforclass = 'FormulaireLine'; $keyforclassfile='/eservices/class/formulaire.class.php'; $keyforelement='formulaireline@eservices'; $keyforalias='tl';
		//include DOL_DOCUMENT_ROOT.'/core/commonfieldsinexport.inc.php';
		$keyforselect='formulaire'; $keyforaliasextra='extra'; $keyforelement='formulaire@eservices';
		include DOL_DOCUMENT_ROOT.'/core/extrafieldsinexport.inc.php';
		//$keyforselect='formulaireline'; $keyforaliasextra='extraline'; $keyforelement='formulaireline@eservices';
		//include DOL_DOCUMENT_ROOT.'/core/extrafieldsinexport.inc.php';
		//$this->export_dependencies_array[$r] = array('formulaireline'=>array('tl.rowid','tl.ref')); // To force to activate one or several fields if we select some fields that need same (like to select a unique key if we ask a field of a child to avoid the DISTINCT to discard them, or for computed field than need several other fields)
		//$this->export_special_array[$r] = array('t.field'=>'...');
		//$this->export_examplevalues_array[$r] = array('t.field'=>'Example');
		//$this->export_help_array[$r] = array('t.field'=>'FieldDescHelp');
		$this->export_sql_start[$r]='SELECT DISTINCT ';
		$this->export_sql_end[$r]  =' FROM '.MAIN_DB_PREFIX.'formulaire as t';
		//$this->export_sql_end[$r]  =' LEFT JOIN '.MAIN_DB_PREFIX.'formulaire_line as tl ON tl.fk_formulaire = t.rowid';
		$this->export_sql_end[$r] .=' WHERE 1 = 1';
		$this->export_sql_end[$r] .=' AND t.entity IN ('.getEntity('formulaire').')';
		$r++; */
		/* END MODULEBUILDER EXPORT MYOBJECT */		// Imports profiles provided by this module
		$r = 1;
		/* BEGIN MODULEBUILDER IMPORT MYOBJECT */
		/*
		$langs->load("eservices@eservices");
		$this->import_code[$r]=$this->rights_class.'_'.$r;
		$this->import_label[$r]='FormulaireLines';	// Translation key (used only if key ExportDataset_xxx_z not found)
		$this->import_icon[$r]='formulaire@eservices';
		$this->import_tables_array[$r] = array('t' => MAIN_DB_PREFIX.'eservices_formulaire', 'extra' => MAIN_DB_PREFIX.'eservices_formulaire_extrafields');
		$this->import_tables_creator_array[$r] = array('t' => 'fk_user_author'); // Fields to store import user id
		$import_sample = array();
		$keyforclass = 'Formulaire'; $keyforclassfile='/eservices/class/formulaire.class.php'; $keyforelement='formulaire@eservices';
		include DOL_DOCUMENT_ROOT.'/core/commonfieldsinimport.inc.php';
		$import_extrafield_sample = array();
		$keyforselect='formulaire'; $keyforaliasextra='extra'; $keyforelement='formulaire@eservices';
		include DOL_DOCUMENT_ROOT.'/core/extrafieldsinimport.inc.php';
		$this->import_fieldshidden_array[$r] = array('extra.fk_object' => 'lastrowid-'.MAIN_DB_PREFIX.'eservices_formulaire');
		$this->import_regex_array[$r] = array();
		$this->import_examplevalues_array[$r] = array_merge($import_sample, $import_extrafield_sample);
		$this->import_updatekeys_array[$r] = array('t.ref' => 'Ref');
		$this->import_convertvalue_array[$r] = array(
			't.ref' => array(
				'rule'=>'getrefifauto',
				'class'=>(!getDolGlobalString('ESERVICES_MYOBJECT_ADDON') ? 'mod_formulaire_standard' : getDolGlobalString('ESERVICES_MYOBJECT_ADDON')),
				'path'=>"/core/modules/commande/".(!getDolGlobalString('ESERVICES_MYOBJECT_ADDON') ? 'mod_formulaire_standard' : getDolGlobalString('ESERVICES_MYOBJECT_ADDON')).'.php'
				'classobject'=>'Formulaire',
				'pathobject'=>'/eservices/class/formulaire.class.php',
			),
			't.fk_soc' => array('rule' => 'fetchidfromref', 'file' => '/societe/class/societe.class.php', 'class' => 'Societe', 'method' => 'fetch', 'element' => 'ThirdParty'),
			't.fk_user_valid' => array('rule' => 'fetchidfromref', 'file' => '/user/class/user.class.php', 'class' => 'User', 'method' => 'fetch', 'element' => 'user'),
			't.fk_mode_reglement' => array('rule' => 'fetchidfromcodeorlabel', 'file' => '/compta/paiement/class/cpaiement.class.php', 'class' => 'Cpaiement', 'method' => 'fetch', 'element' => 'cpayment'),
		);
		$this->import_run_sql_after_array[$r] = array();
		$r++; */
		/* END MODULEBUILDER IMPORT MYOBJECT */
	}	/**
	 *  Function called when module is enabled.
	 *  The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
	 *  It also creates data directories
	 *
	 *  @param      string  $options    Options when enabling module ('', 'noboxes')
	 *  @return     int             	1 if OK, 0 if KO
	 */
	public function init($options = '')
	{
		global $conf, $langs;		//$result = $this->_load_tables('/install/mysql/', 'eservices');
		$result = $this->_load_tables('/eservices/sql/');
		if ($result < 0) {
			return -1; // Do not activate module if error 'not allowed' returned when loading module SQL queries (the _load_table run sql with run_sql with the error allowed parameter set to 'default')
		}
		// créer un répertoire particulier dans le répertoire /public/ticket/ pour les fichiers nécessaires interface publique
		require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
		//1- copie des fichiers core include etc
		$dir_eservices = DOL_DOCUMENT_ROOT . '/public/ticket/'.DOL_URL_ROOT;
		//faire les copies du contenu du répertoire public-eservices
		$dir_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/ticket-dol-url-root/';
		if(dolCopyDir($dir_src, $dir_eservices, '644', 1)){
			//message de confirmation
			dol_syslog("copie répertoire avec succès dans $dir_eservices");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du répertoire dans $dir_eservices");		
		}	
		//2- copie img css
		$dir_eservices = DOL_DOCUMENT_ROOT . '/public/ticket/';
		//faire les copies du contenu du répertoire public-eservices
		$dir_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/ticket-racine/';
		if(dolCopyDir($dir_src, $dir_eservices, '644', 1)){
			//message de confirmation
			dol_syslog("copie répertoire avec succès dans $dir_eservices");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du répertoire dans $dir_eservices");		
		}	
		//3-copie des images logo
		$num_entity = $conf->entity == 1? '' : $conf->entity.'/';
		$dir_eservices = DOL_DOCUMENT_ROOT . '/public/ticket/documents/'.$num_entity.'mycompany/logos/';
		//faire les copies du contenu du répertoire des logos
		$dir_src = DOL_DATA_ROOT . '/'.$num_entity.'mycompany/logos/';
		if(dolCopyDir($dir_src, $dir_eservices, '644', 1)){
			//message de confirmation
			dol_syslog("copie répertoire avec succès dans $dir_eservices");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du répertoire dans $dir_eservices");		
		}
		//4- copie du fichier modifié de html.formticket.class.php
		$formticket_file = DOL_DOCUMENT_ROOT . '/core/class/html.formticket.class.php';
		//faire les copies du contenu du répertoire public-eservices
		$file_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/core-class/html.formticket.class.php';
		if(dol_copy($file_src, $formticket_file, '644', 1)){
			//message de confirmation
			dol_syslog("copie avec succès du fichier $formticket_file");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du fichier $formticket_file");		
		}
		//5- copie du website pour l'interface première de liste des services support au public
		$website = DOL_DATA_ROOT . '/website/service-support/';
		//faire les copies du contenu du répertoire public-eservices
		$folder_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/website/service-support/';
		if(dolCopyDir($folder_src, $website, '644', 1)){
			//message de confirmation
			dol_syslog("copie avec succès du répertoire $website");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du répertoire $website");		
		}
		//6- copie du folder image du website pour l'interface première de liste des services support au public
		$website_img = DOL_DATA_ROOT . '/medias/image/service-support/';
		//faire les copies du contenu du répertoire public-eservices
		$folder_img_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/website/media-images/';
		if(dolCopyDir($folder_img_src, $website_img, '644', 1)){
			//message de confirmation
			dol_syslog("copie avec succès du répertoire $website_img");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du répertoire $website_img");		
		}
		//7- copie du fichier modifié de core/lib/ticket.lib
		$icketlib_file = DOL_DOCUMENT_ROOT . '/core/lib/ticket.lib.php';
		//faire les copies du contenu du répertoire public-eservices
		$file_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/core-class/ticket.lib.php';
		if(dol_copy($file_src, $icketlib_file, '644', 1)){
			//message de confirmation
			dol_syslog("copie avec succès du fichier $icketlib_file");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du fichier $icketlib_file");		
		}
		//8- copie des doc template dans le répertoire de destination
		$doctemplate = DOL_DATA_ROOT . '/eservices/doctemplates/demandes/';
		//faire les copies du contenu du répertoire public-eservices
		$folder_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/doctemplates/';
		if(dolCopyDir($folder_src, $doctemplate, '644', 1)){
			//message de confirmation
			dol_syslog("copie avec succès du répertoire $folder_src");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du répertoire $folder_src");		
		}
		//9- copie du fichier modifié de html.formfile.class.php
		$formfile_file = DOL_DOCUMENT_ROOT . '/core/class/html.formfile.class.php';
		//faire les copies du contenu du répertoire public-eservices
		$file_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/core-class/html.formfile.class.php';
		if(dol_copy($file_src, $formfile_file, '644', 1)){
			//message de confirmation
			dol_syslog("copie avec succès du fichier $formfile_file");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du fichier $formfile_file");		
		}
		//10- copie du fichier modifié files.lib.php pour ajouter le hook de transfert des fichiers de rapportage
		$fileslib_file = DOL_DOCUMENT_ROOT . '/core/lib/files.lib.php';
		//faire les copies du contenu du répertoire public-eservices
		$file_src = DOL_DOCUMENT_ROOT . '/custom/eservices/public-eservices/core-class/files.lib.php';
		if(dol_copy($file_src, $fileslib_file, '644', 1)){
			//message de confirmation
			dol_syslog("copie avec succès du fichier $fileslib_file");
		} else {
			// création échoue, ajouter une erreur
			dol_syslog("Erreur lors de la copie du fichier $fileslib_file");		
		}
		// Create extrafields during init
		include_once DOL_DOCUMENT_ROOT.'/core/class/extrafields.class.php';
		$extrafields = new ExtraFields($this->db);
		//$result1=$extrafields->addExtraField('eservices_myattr1', "New Attr 1 label", 'boolean', 1,  3, 'thirdparty',   0, 0, '', '', 1, '', 0, 0, '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		//$result2=$extrafields->addExtraField('eservices_myattr2', "New Attr 2 label", 'varchar', 1, 10, 'project',      0, 0, '', '', 1, '', 0, 0, '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		//$result3=$extrafields->addExtraField('eservices_myattr3', "New Attr 3 label", 'varchar', 1, 10, 'bank_account', 0, 0, '', '', 1, '', 0, 0, '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		//$result4=$extrafields->addExtraField('eservices_myattr4', "New Attr 4 label", 'select',  1,  3, 'thirdparty',   0, 1, '', array('options'=>array('code1'=>'Val1','code2'=>'Val2','code3'=>'Val3')), 1,'', 0, 0, '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		//$result5=$extrafields->addExtraField('eservices_myattr5', "New Attr 5 label", 'text',    1, 10, 'user',         0, 0, '', '', 1, '', 0, 0, '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result1=$extrafields->addExtraField('identifiant_structure', "Identifiant structure par défaut", 'varchar', 5, '12', 'entity', 0, 0, '', array('options' => array('' => null)), 1, '', '1', 'Identifiant de la structure par défaut', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result2=$extrafields->addExtraField('eservicelie', "E-Service sollicité", 'sellist', 10, '', 'ticket', 0, 1, '', array('options' => array('eservices_digitalservice:label:rowid' => null)), 0, '', '1', 'Sélectionner un e-service', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result3=$extrafields->addExtraField('1informationssurlauteurdelademande', "1. Informations sur l’auteur de la demande :", 'separate', 20, '', 'ticket', 0, 0, '', array('options' => array('1' => '/custom')), 0, '', '3', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result4=$extrafields->addExtraField('statuts', "Statut / état du demandeur", 'select', 30, '', 'ticket', 0, 0, '', array('options' => array('1'=>'Père','2'=>'Sœur','3'=>'Frère','4'=>'Mlle','5'=>'M.','6'=>'Mme')), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result5=$extrafields->addExtraField('nomprenomdemandeur', "Nom et Prénom du demandeur", 'varchar', 40, '50', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result44=$extrafields->addExtraField('1_2informationssurlebnficiaire', "2. Informations sur le bénéficiaire :", 'separate', 100, '', 'ticket', 0, 0, '', array('options' => array('2' => null)), 0, '', '3', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result6=$extrafields->addExtraField('1_nometprnom', "Nom et prénom", 'varchar', 110, '50', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result7=$extrafields->addExtraField('1_datedenaissance', "Date de naissance", 'date', 120, '', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result8=$extrafields->addExtraField('1_lieudenaissance', "Lieu de naissance", 'varchar', 130, '30', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result9=$extrafields->addExtraField('1_nationalit', "Nationalité", 'varchar', 140, '15', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result10=$extrafields->addExtraField('1_datedordination', "Date d'ordination", 'date', 150, '', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result43=$extrafields->addExtraField('2_2informationssurlebnficiaire', "2. Informations sur le bénéficiaire :", 'separate', 200, '', 'ticket', 0, 0, '', array('options' => array('2' => null)), 0, '', '3', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result41=$extrafields->addExtraField('2_titrecivilit', "Titre / Civilité", 'sellist', 210, '', 'ticket', 0, 1, '', array('options' => array('c_civility:code:label' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result14=$extrafields->addExtraField('2_nometprnom', "Nom et prénom", 'varchar', 220, '50', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result42=$extrafields->addExtraField('2_statutetatdevie', "Statut / état de vie", 'sellist', 230, '', 'ticket', 0, 1, '', array('options' => array('eservices_situation_professionnelle:label:label' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result11=$extrafields->addExtraField('2_fonctiondelapersonne', "Fonction de la personne", 'varchar', 240, '100', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result12=$extrafields->addExtraField('2_diocsedemission', "Diocèse de mission", 'varchar', 250, '50', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result13=$extrafields->addExtraField('2_adressedersidence', "Adresse de résidence", 'varchar', 260, '50', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result47=$extrafields->addExtraField('3_2informationssurlebnficiaire', "2. Informations sur le bénéficiaire :", 'separate', 300, '', 'ticket', 0, 0, '', array('options' => array('2' => null)), 0, '', '3', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result15=$extrafields->addExtraField('3_titrecivilit', "Titre / Civilité", 'sellist', 310, '', 'ticket', 0, 1, '', array('options' => array('c_civility:code:label' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result16=$extrafields->addExtraField('3_nometprnom', "Nom et prénom", 'varchar', 320, '50', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result17=$extrafields->addExtraField('3_statutetatdevie', "Statut / état de vie", 'sellist', 330, '', 'ticket', 0, 1, '', array('options' => array('eservices_situation_professionnelle:label:label' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result29=$extrafields->addExtraField('3_sexe', "Sexe", 'radio', 340, '', 'ticket', 0, 1, '', array('options' => array('0' => 'Homme', '1' => 'Femme')), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result18=$extrafields->addExtraField('3_rattachement', "Rattachement", 'radio', 350, '', 'ticket', 0, 1, '', array('options' => array('0' => 'Diocèse', '1' => 'Institut - Congrégation - Ordre - Société - Communauté')), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result19=$extrafields->addExtraField('3_diocseinstitutcongrgation', "Diocèse / Institut / Congrégation", 'sellist', 360, '', 'ticket', 0, 1, '', array('options' => array('eservices_diocese_congregation:label:label' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result30=$extrafields->addExtraField('3_autrediocseinstitutcongrgation', "Autre diocèse ou Institut", 'varchar', 370, '30', 'ticket', 0, 0, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result20=$extrafields->addExtraField('3_missionautreprcision', "Mission / Autre précision", 'varchar', 380, '100', 'ticket', 0, 0, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result48=$extrafields->addExtraField('3_3informationssurlesjour', "3. Informations sur le séjour :", 'separate', 390, '', 'ticket', 0, 0, '', array('options' => array('2' => null)), 0, '', '3', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result31=$extrafields->addExtraField('3_villededestination', "Ville de destination", 'varchar', 400, '15', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result32=$extrafields->addExtraField('3_paysdedestination', "Pays de destination", 'sellist', 410, '', 'ticket', 0, 1, '', array('options' => array('c_country:label:label' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result33=$extrafields->addExtraField('3_datededpart', "Date de départ", 'date', 420, '', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result34=$extrafields->addExtraField('3_datederetour', "Date de retour", 'date', 430, '', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result35=$extrafields->addExtraField('3_motifduvoyage', "Motif du voyage", 'sellist', 440, '', 'ticket', 0, 1, '', array('options' => array('eservices_motifs_voyage:label:label::active=1' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result36=$extrafields->addExtraField('3_autremotif', "Autre motif", 'varchar', 450, '100', 'ticket', 0, 0, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result39=$extrafields->addExtraField('3_identitetfonctiondelhte', "Identité et Fonction de l'hôte", 'varchar', 460, '150', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result40=$extrafields->addExtraField('3_adressedesjour', "Adresse de séjour", 'varchar', 470, '100', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result45=$extrafields->addExtraField('4_2informationssurlebnficiaire', "2. Informations sur le bénéficiaire :", 'separate', 500, '', 'ticket', 0, 0, '', array('options' => array('2' => null)), 0, '', '3', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result21=$extrafields->addExtraField('4_nometprnom', "Nom et prénom", 'varchar', 510, '50', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result22=$extrafields->addExtraField('4_diocseinstitutcongrgation', "Diocèse / Institut / Congrégation", 'sellist', 520, '', 'ticket', 0, 1, '', array('options' => array('eservices_diocese_congregation:label:label' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result23=$extrafields->addExtraField('4_autrediocseinstitutcongrgation', "Autre diocèse ou Institut", 'varchar', 530, '30', 'ticket', 0, 0, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result24=$extrafields->addExtraField('4_missionautreprcision', "Mission / Autre précision", 'varchar', 540, '100', 'ticket', 0, 0, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result46=$extrafields->addExtraField('4_3informationssurleprojetderemplacement', "3. Informations sur le projet de remplacement :", 'separate', 550, '', 'ticket', 0, 0, '', array('options' => array('2' => '/custom')), 0, '', '3', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result25=$extrafields->addExtraField('4_diocsededestination', "Diocèse visé", 'varchar', 560, '15', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result26=$extrafields->addExtraField('4_paysdedestination', "Pays", 'sellist', 570, '', 'ticket', 0, 1, '', array('options' => array('c_country:label:label' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result27=$extrafields->addExtraField('4_datededpart', "Date de départ", 'date', 580, '', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result28=$extrafields->addExtraField('4_datederetour', "Date de retour", 'date', 590, '', 'ticket', 0, 1, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result37=$extrafields->addExtraField('4_motifduvoyage', "Motif du voyage", 'sellist', 600, '', 'ticket', 0, 1, '', array('options' => array('eservices_motifs_voyage:label:label::active=1' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		$result38=$extrafields->addExtraField('4_autremotif', "Autre motif", 'varchar', 610, '100', 'ticket', 0, 0, '', array('options' => array('' => null)), 0, '', '1', '', '', '', 'eservices@eservices', 'isModEnabled("eservices")');
		
		$this->remove($options);		

		$sql = array();		// Document templates

		$moduledir = dol_sanitizeFileName('eservices');
		$myTmpObjects = array();
		$myTmpObjects['Formulaire'] = array('includerefgeneration'=>0, 'includedocgeneration'=>0);		
		foreach ($myTmpObjects as $myTmpObjectKey => $myTmpObjectArray) {
			if ($myTmpObjectKey == 'Formulaire') {
				continue;
			}
			if ($myTmpObjectArray['includerefgeneration']) {
				$src = DOL_DOCUMENT_ROOT.'/install/doctemplates/'.$moduledir.'/template_formulaires.odt';
				$dirodt = DOL_DATA_ROOT.'/doctemplates/'.$moduledir;
				$dest = $dirodt.'/template_formulaires.odt';				
				if (file_exists($src) && !file_exists($dest)) {
					require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
					dol_mkdir($dirodt);
					$result = dol_copy($src, $dest, 0, 0);
					if ($result < 0) {
						$langs->load("errors");
						$this->error = $langs->trans('ErrorFailToCopyFile', $src, $dest);
						return 0;
					}
				}				
				$sql = array_merge($sql, array(
					"DELETE FROM ".MAIN_DB_PREFIX."document_model WHERE nom = 'standard_".strtolower($myTmpObjectKey)."' AND type = '".$this->db->escape(strtolower($myTmpObjectKey))."' AND entity = ".((int) $conf->entity),
					"INSERT INTO ".MAIN_DB_PREFIX."document_model (nom, type, entity) VALUES('standard_".strtolower($myTmpObjectKey)."', '".$this->db->escape(strtolower($myTmpObjectKey))."', ".((int) $conf->entity).")",
					"DELETE FROM ".MAIN_DB_PREFIX."document_model WHERE nom = 'generic_".strtolower($myTmpObjectKey)."_odt' AND type = '".$this->db->escape(strtolower($myTmpObjectKey))."' AND entity = ".((int) $conf->entity),
					"INSERT INTO ".MAIN_DB_PREFIX."document_model (nom, type, entity) VALUES('generic_".strtolower($myTmpObjectKey)."_odt', '".$this->db->escape(strtolower($myTmpObjectKey))."', ".((int) $conf->entity).")"
				));
			}
		}		
		return $this->_init($sql, $options);
	}	/**
	 *  Function called when module is disabled.
	 *  Remove from database constants, boxes and permissions from Dolibarr database.
	 *  Data directories are not deleted
	 *
	 *  @param      string	$options    Options when enabling module ('', 'noboxes')
	 *  @return     int                 1 if OK, 0 if KO
	 */
	public function remove($options = '')
	{
		$sql = array();
		return $this->_remove($sql, $options);
	}
}
