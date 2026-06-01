<?php
/* Copyright (C) 2024 Fred Junior omega		<omegajunior.apps@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * \file    eservices/class/actions_eservices.class.php
 * \ingroup eservices
 * \brief   Example hook overload.
 *
 * Put detailed description here.
 */

/**
 * Class ActionsEservices
 */
class ActionsEservices
{
	/**
	 * @var DoliDB Database handler.
	 */
	public $db;

	/**
	 * @var string Error code (or message)
	 */
	public $error = '';

	/**
	 * @var array Errors
	 */
	public $errors = array();


	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var int		Priority of hook (50 is used if value is not defined)
	 */
	public $priority;


	/**
	 * Constructor
	 *
	 *  @param		DoliDB		$db      Database handler
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}


	/**
	 * Execute action
	 *
	 * @param	array			$parameters		Array of parameters
	 * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string			$action      	'add', 'update', 'view'
	 * @return	int         					<0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *                            				>0 if OK and we want to replace standard actions.
	 */
	public function getNomUrl($parameters, &$object, &$action)
	{
		global $db, $langs, $conf, $user;
		/* 					foreach ($parameters as $key => $item) {
			dol_syslog('fred admin getNomUrl : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */ 
		// on fera un early return si le contexte correspond à ticket mais que la clé getnomurl de parameters contient déjà document.php?modulepart=ticket alors....
		// on ne fait pas les changements car il s'agit du lien pour télécharger les documents liés au ticket et on ne veut pas que ce lien soit modifié
		// mais il faut tester l'existence de la clé getnomurl dans parameters pour éviter les erreurs de clé inexistante dans d'autres contextes
		if (isset($parameters['getnomurl']) && strpos($parameters['getnomurl'], 'document.php?modulepart=ticket') !== false) {
			return 0;
		}
		//dol_syslog('fred admin getNomUrl : '. print_r($parameters, true));
		//dol_syslog('fred admin getNomUrl act : '. $action);
		if ((in_array($parameters['currentcontext'], array('main')) 
			&& strpos($parameters['context'], 'index') !== false) 
			|| in_array($parameters['currentcontext'], array('ticketsindex', 'ticketcard',
						'thirdpartyticket', 'projectticket', 'ticketlist'))
			) {
			// Remplacer 'ticket' par 'custom/ticket' dans la chaîne principale
			$parameters['getnomurl'] = str_replace('ticket', 'custom/eservices/ticket', $parameters['getnomurl']);
		}

		$this->resprints = '';
		return 0;
	}

	/**
	 * Overloading the doActions function : replacing the parent's function with the one below
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function doActions($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter
		/* 	foreach ($parameters as $key => $item) {
			dol_syslog('fred admin doActions : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */
		//dol_syslog('fred admin doActions : attribute: ' . $parameters['attribute']);/* */
		//dol_syslog('fred admin ici doActions '.$action);
		//pour les valeurs à récupérer dans setoptionalsfromposts cas add update et update_extra
		//pour l'action view avec un update_extra également ---- pour cas de action empty voir tpl/extrafields_view
		if (in_array($parameters['currentcontext'], array('publicnewticketcard', 'ticketcard')) 
			&& ($action == 'add' || $action == 'update' || $action == 'update_extras'  || $action == 'create_ticket')) {	    // do something only for the context 'somecontext1' or 'somecontext2'
			// cas de l'initialisation après une action sur un bouton ou un lien sur les pages ticketcard et public
			//nous voulons gérer les extrafields à montrer, à supprimer pour éviter les erreurs de valeurs obligatoires absentes 
			// et pour éviter de gérer avec javascript les champs à afficher dans l'interface publique et dans card selon le e-service sélectionné
			// 1- éviter les erreurs de valeurs obligatoires à renseigner mais qui n'appartiennent pas au e-service en cours de traitement
			if($action == 'update_extras' && $parameters['attribute'] != 'eservicelie'){ // cas edit on a la valeur de l'option eservicelie présent dans array_option de l'objet
				//si eservicelie n'est pas l'extra qu'on modifie on peut utiliser l'objet pour trouver la valeur de eservicelie
				$eservicelie = $object->array_options['options_eservicelie'];
				//dol_syslog('fred admin ici doActions 1 eservice value: '.$eservicelie);
				//dol_syslog('fred eservice value: '.$eservicelie);
			} else { // cas add ou create_ticket ou update
				//si c'est autre cas ou cas où on modifie extra eservicelie, il faut récupérer le nouveau par $_POST
				$eservicelie = $_POST["options_eservicelie"] ?? null;
				//dol_syslog('fred admin ici doActions 2 eservice value: '.$eservicelie);
			}
			//$eservicelie = $_POST["options_eservicelie"] ?? null;
			//dol_syslog('fred admin eservicelie '.$eservicelie);
			//dol_syslog('fred admin eservicelie ici '.$object->array_options['options_eservicelie']);
			if(empty($eservicelie)){
				// Vérifier que 'extrafields' existe et contient un objet avec la propriété 'attributes'
				if (isset($parameters['extrafields']) && isset($parameters['extrafields']->attributes['ticket'])) {
					//dol_syslog('Début du nettoyage des extrafields ticket empty');

					// Parcourir chaque élément du tableau 'attributes["ticket"]'
					foreach ($parameters['extrafields']->attributes['ticket'] as $key => &$subArray) {
						// Vérifier que la valeur est un tableau
						if (is_array($subArray)) {
							//dol_syslog("Traitement de la clé '$key' contenant un tableau");

							// Parcourir chaque élément du tableau interne
							foreach ($subArray as $subKey => $value) {
								// Vérifier si la clé commence par un entier suivi de '_'
								if (preg_match('/^\d+_/', $subKey)) {
									//dol_syslog("Suppression de l'élément avec la clé '$subKey' car elle commence par un entier suivi de '_'");
									unset($subArray[$subKey]);
								} 
							}
						} 
					}
				} 
			} else {
				// Vérifier que 'extrafields' existe et contient un objet avec la propriété 'attributes'
				if (isset($parameters['extrafields']) && isset($parameters['extrafields']->attributes['ticket'])) {
					//dol_syslog('Début du nettoyage des extrafields ticket avec vérification du eservicelie : ' . $eservicelie);
					// S'assurer que $eservicelie est un entier
					$eservicelie = (int)($eservicelie);
					// Parcourir chaque élément du tableau 'attributes["ticket"]'
					foreach ($parameters['extrafields']->attributes['ticket'] as $key => &$subArray) {
						// Vérifier que la valeur est un tableau
						if (is_array($subArray)) {
							//dol_syslog("Traitement de la clé '$key' contenant un tableau");

							// Parcourir chaque élément du tableau interne
							foreach ($subArray as $subKey => $value) {
								// Vérifier si la clé commence par un entier différent de $eservicelie suivi de '_'
								if (preg_match('/^(\d+)_/', $subKey, $matches)) {
									$prefixInt = (int)($matches[1]); // Extraire l'entier au début de la clé
									if ($prefixInt !== $eservicelie) {
										//dol_syslog("Suppression de l'élément avec la clé '$subKey' car l'entier '$prefixInt' est différent de '$eservicelie'");
										unset($subArray[$subKey]);
									} 
								} 
							}
						} 
					}
				} 
			}
			//cas pour edit où array_option est déjà chargé avec fetch. il faut supprimer les champs non concerné par l'objet 
			// en cours de traitement.
			//dol_syslog('fred admin doActions update action:  ' . $action . ' id : '.$object->id);
			if(!empty($object->id) && ($action == 'update')){
				// S'assurer que $eservicelie est un entier
				$eservicelie = (int)($object->array_options['options_eservicelie']);
				foreach ($object->array_options as $Key => $value) {
					// Vérifier si la clé commence par un entier différent de $eservicelie suivi de '_'
					if (preg_match('/^options_(\d+)_/', $Key, $matches)) {
						$prefixInt = (int)($matches[1]); // Extraire l'entier au début de la clé
						if ($prefixInt !== $eservicelie) {
							//dol_syslog("Suppression de l'élément avec la clé '$subKey' car l'entier '$prefixInt' est différent de '$eservicelie'");
							unset($object->array_options[$Key]);
						} 
					} 
				}
			}
		}

		return 0; // or return 1 to replace standard code

	}

	/**
	 * Execute action
	 *
	 * @param	array			$parameters		Array of parameters
	 * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string			$action      	'add', 'update', 'view'
	 * @return	int         					<0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *                            				>0 if OK and we want to replace standard actions.
	 */
	public function formObjectOptions($parameters, &$object, &$action)
	{
		global $db, $langs, $conf, $user;
			/* foreach ($parameters as $key => $item) {
			dol_syslog('fred admin formObjectOptions : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */
		//dol_syslog('fred parameters formObjectOptions : '. print_r($parameters, true));
		//dol_syslog('fred admin formObjectOptions object: ' . print_r($object, true));
		//dol_syslog('fred admin ici formObjectOptions '.$action);
		// cas où on create, create_ticket et edit où c'est à partir de shoowform et showoptionals que nous construisons les champs à afficher
		if (
			in_array($parameters['currentcontext'], array('publicnewticketcard', 'ticketcard')) 
			&& 
			(in_array($parameters['mode'] ?? '', array('create', 'create_ticket', 'edit')))
			) 
		{
			// cas des créations à partir des card -- après sélection de l'eservicelie par exemple
			//nous voulons gérer les extrafields à montrer, à supprimer pour éviter les erreurs de valeurs obligatoires absentes 
			// et pour éviter de gérer avec javascript les champs à afficher dans l'interface publique et dans card selon le e-service sélectionné
			// 1- éviter les erreurs de valeurs obligatoires à renseigner mais qui n'appartiennent pas au e-service en cours de traitement
			//$eservicelie = $_POST["options_eservicelie"] ?? null;
			//dol_syslog('fred admin formObjectOptions ici');
			if($parameters['mode']=='edit'){ // cas edit on a la valeur de l'option eservicelie présent dans array_option de l'objet
				//tenir compte du changement du eservice en mode edit
				//dol_syslog('fred admin ici edit eservice value: '.GETPOSTISSET('options_eservicelie'));
				if(GETPOSTISSET('options_eservicelie')){
					$new_eservicelie = GETPOSTINT("options_eservicelie", 2);
				}
				if(!empty($new_eservicelie) && ((int) $parameters['object']->array_options['options_eservicelie'] !== $new_eservicelie)){
					$eservicelie = $new_eservicelie;	
				} else {
					$eservicelie = $parameters['object']->array_options['options_eservicelie'];
				}
				//dol_syslog('fred eservice value: '.$eservicelie);
			} else { // cas create ou create_ticket
				$eservicelie = GETPOSTINT("options_eservicelie", 2);
				//dol_syslog('fred eservice value: '.$eservicelie);
			}
			if($eservicelie == 0){ // champ vide
				// Vérifier que 'extrafields' existe et contient un objet avec la propriété 'attributes'
				if (isset($parameters['extrafields']) && isset($parameters['extrafields']->attributes['ticket'])) {
					//dol_syslog('Début du nettoyage des extrafields ticket empty');

					// Parcourir chaque élément du tableau 'attributes["ticket"]'
					foreach ($parameters['extrafields']->attributes['ticket'] as $key => &$subArray) {
						// Vérifier que la valeur est un tableau
						if (is_array($subArray)) {
							//dol_syslog("Traitement de la clé '$key' contenant un tableau");

							// Parcourir chaque élément du tableau interne
							foreach ($subArray as $subKey => $value) {
								// Vérifier si la clé commence par un entier suivi de '_'
								if (preg_match('/^\d+_/', $subKey)) {
									//dol_syslog("Suppression de l'élément avec la clé '$subKey' car elle commence par un entier suivi de '_'");
									unset($subArray[$subKey]);
								} 
							}
						} 
					}
				} 
			} else {
				// Vérifier que 'extrafields' existe et contient un objet avec la propriété 'attributes'
				if (isset($parameters['extrafields']) && isset($parameters['extrafields']->attributes['ticket'])) {
					//dol_syslog('Début du nettoyage des extrafields ticket avec vérification du eservicelie : ' . $eservicelie);
					// S'assurer que $eservicelie est un entier
					$eservicelie = (int)($eservicelie);
					// Parcourir chaque élément du tableau 'attributes["ticket"]'
					foreach ($parameters['extrafields']->attributes['ticket'] as $key => &$subArray) {
						// Vérifier que la valeur est un tableau
						if (is_array($subArray)) {
							//dol_syslog("Traitement de la clé '$key' contenant un tableau");

							// Parcourir chaque élément du tableau interne
							foreach ($subArray as $subKey => $value) {
								// Vérifier si la clé commence par un entier différent de $eservicelie suivi de '_'
								if (preg_match('/^(\d+)_/', $subKey, $matches)) {
									$prefixInt = (int)($matches[1]); // Extraire l'entier au début de la clé
									if ($prefixInt !== $eservicelie) {
										//dol_syslog("Suppression de l'élément avec la clé '$subKey' car l'entier '$prefixInt' est différent de '$eservicelie'");
										unset($subArray[$subKey]);
									} 
								} 
							}
						} 
					}
				} 
			}	
		}

		return 0;
	}

	/**
	 * Overloading the doMassActions function : replacing the parent's function with the one below
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function doMassActions($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {		// do something only for the context 'somecontext1' or 'somecontext2'
			foreach ($parameters['toselect'] as $objectid) {
				// Do action on each object id
			}
		}

		if (!$error) {
			$this->results = array('myreturn' => 999);
			$this->resprints = '';
			return 0; // or return 1 to replace standard code
		} else {
			$this->errors[] = 'Error message';
			return -1;
		}
	}


	/**
	 * Overloading the addMoreMassActions function : replacing the parent's function with the one below
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function addMoreMassActions($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter
		$disabled = 1;

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {		// do something only for the context 'somecontext1' or 'somecontext2'
			$this->resprints = '<option value="0"'.($disabled ? ' disabled="disabled"' : '').'>'.$langs->trans("EservicesMassAction").'</option>';
		}

		if (!$error) {
			return 0; // or return 1 to replace standard code
		} else {
			$this->errors[] = 'Error message';
			return -1;
		}
	}



	/**
	 * Execute action
	 *
	 * @param	array	$parameters     Array of parameters
	 * @param   Object	$object		   	Object output on PDF
	 * @param   string	$action     	'add', 'update', 'view'
	 * @return  int 		        	<0 if KO,
	 *                          		=0 if OK but we want to process standard actions too,
	 *  	                            >0 if OK and we want to replace standard actions.
	 */
	public function beforePDFCreation($parameters, &$object, &$action)
	{
		global $conf, $user, $langs;
		global $hookmanager;

		$outputlangs = $langs;

		$ret = 0; $deltemp = array();
		dol_syslog(get_class($this).'::executeHooks action='.$action);

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {		// do something only for the context 'somecontext1' or 'somecontext2'
		}

		return $ret;
	}

	/**
	 * Execute action
	 *
	 * @param	array	$parameters     Array of parameters
	 * @param   Object	$pdfhandler     PDF builder handler
	 * @param   string	$action         'add', 'update', 'view'
	 * @return  int 		            <0 if KO,
	 *                                  =0 if OK but we want to process standard actions too,
	 *                                  >0 if OK and we want to replace standard actions.
	 */
	public function afterPDFCreation($parameters, &$pdfhandler, &$action)
	{
		global $conf, $user, $langs;
		global $hookmanager;

		$outputlangs = $langs;

		$ret = 0; $deltemp = array();
		dol_syslog(get_class($this).'::executeHooks action='.$action);

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {
			// do something only for the context 'somecontext1' or 'somecontext2'
		}

		return $ret;
	}



	/**
	 * Overloading the loadDataForCustomReports function : returns data to complete the customreport tool
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function loadDataForCustomReports($parameters, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$langs->load("eservices@eservices");

		$this->results = array();

		$head = array();
		$h = 0;

		if ($parameters['tabfamily'] == 'eservices') {
			$head[$h][0] = dol_buildpath('/module/index.php', 1);
			$head[$h][1] = $langs->trans("Home");
			$head[$h][2] = 'home';
			$h++;

			$this->results['title'] = $langs->trans("Eservices");
			$this->results['picto'] = 'eservices@eservices';
		}

		$head[$h][0] = 'customreports.php?objecttype='.$parameters['objecttype'].(empty($parameters['tabfamily']) ? '' : '&tabfamily='.$parameters['tabfamily']);
		$head[$h][1] = $langs->trans("CustomReports");
		$head[$h][2] = 'customreports';

		$this->results['head'] = $head;

		return 1;
	}



	/**
	 * Overloading the restrictedArea function : check permission on an object
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int 		      			  	<0 if KO,
	 *                          				=0 if OK but we want to process standard actions too,
	 *  	                            		>0 if OK and we want to replace standard actions.
	 */
	public function restrictedArea($parameters, &$action, $hookmanager)
	{
		global $user;

		if ($parameters['features'] == 'myobject') {
			if ($user->hasRight('eservices', 'myobject', 'read')) {
				$this->results['result'] = 1;
				return 1;
			} else {
				$this->results['result'] = 0;
				return 1;
			}
		}

		return 0;
	}

	/**
	 * Execute action completeTabsHead
	 *
	 * @param   array           $parameters     Array of parameters
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         'add', 'update', 'view'
	 * @param   Hookmanager     $hookmanager    hookmanager
	 * @return  int                             <0 if KO,
	 *                                          =0 if OK but we want to process standard actions too,
	 *                                          >0 if OK and we want to replace standard actions.
	 */
	public function completeTabsHead(&$parameters, &$object, &$action, $hookmanager)
	{
		global $langs, $conf, $user;

		if (!isset($parameters['object']->element)) {
			return 0;
		}
		if ($parameters['mode'] == 'remove') {
			// used to make some tabs removed
			return 0;
		} elseif ($parameters['mode'] == 'add') {
			$langs->load('eservices@eservices');
			// used when we want to add some tabs
			$counter = count($parameters['head']);
			$element = $parameters['object']->element;
			$id = $parameters['object']->id;
			// verifier le type d'onglet comme member_stats où ça ne doit pas apparaitre
			// if (in_array($element, ['societe', 'member', 'contrat', 'fichinter', 'project', 'propal', 'commande', 'facture', 'order_supplier', 'invoice_supplier'])) {
			if (in_array($element, ['context1', 'context2'])) {
				$datacount = 0;

				$parameters['head'][$counter][0] = dol_buildpath('/eservices/eservices_tab.php', 1) . '?id=' . $id . '&amp;module='.$element;
				$parameters['head'][$counter][1] = $langs->trans('EservicesTab');
				if ($datacount > 0) {
					$parameters['head'][$counter][1] .= '<span class="badge marginleftonlyshort">' . $datacount . '</span>';
				}
				$parameters['head'][$counter][2] = 'eservicesemails';
				$counter++;
			}
			if (in_array($element, ['ticket'])) {
				foreach ($parameters['head'] as $key => $item) {
					// Vérifier si l'élément est un tableau et s'il contient au moins 1 valeur
					if (isset($item[0]) && is_string($item[0]) && (strpos($item[0], 'custom/eservices/') == false)) {
						// Remplacer 'ticket' par 'custom/eservices/ticket' dans la valeur de la clé 0
						$parameters['head'][$key][0] = str_replace('ticket', 'custom/eservices/ticket', $item[0]);
					}
				}						
			}
			if ($counter > 0 && (int) DOL_VERSION < 14) {
				$this->results = $parameters['head'];
				// return 1 to replace standard code
				return 1;
			} else {
				// en V14 et + $parameters['head'] est modifiable par référence
				return 0;
			}
		} else {
			// Bad value for $parameters['mode']
			return -1;
		}
	}

	/* Add here any other hooked methods... */
	/* Add here any other hooked methods... */
	/**
	 * hook for menuLeftMenuItems pour remplacer les liens dans les menus core du module comptabilité
	 * Overloading the menuLeftMenuItems function : replacing the parent's function with the one below
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function menuLeftMenuItems($parameters, &$hook_items)
	{
		global $conf, $user, $langs;
		$error = 0; // Error counter
		/* 						foreach ($parameters as $key => $item) {
			dol_syslog('fred admin menuLeftMenuItems : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */
		if (
			// Vérification de contextes spécifiques liés aux tickets
			(in_array($parameters['currentcontext'], array('ticketsindex', 'ticketcard', 'ticketlist', 
														 'thirdpartyticket', 'projectticket', 'ticketstat'))
														 && strpos($parameters['mainmenu'], 'ticket') !== false)
			||
			// Vérification de contextes spécifiques qui nécessitent la présence de 'ticket' dans 'mainmenu'
			(
				in_array($parameters['currentcontext'], array('categoryindex', 'categorycard', 'actioncard', 
															 'agendalist', 'ticketmessaging', 'documentticketcard', 
															 'contactticketcard', 'ticketagenda', 'adminmodules', 
															 'index', 'leftblock'))
				&& strpos($parameters['mainmenu'], 'ticket') !== false
			)
			||
			// Vérification des contextes spécifiques 'categoryindex' et 'categorycard'
			(in_array($parameters['currentcontext'], array('main'))&& (strpos($parameters['context'], 'ticketcard') !== false))
		) 
		{	    // do something only for the context 'somecontext1' or 'somecontext2'
			// Do what you want here...
			// You can for example call global vars like $fieldstosearchall to overwrite them, or update database depending on $action and $_POST values.
			//liens sur module reconstitués
			$this->results[] = array(
				'url'=>'custom/eservices/ticket/index.php',
				'titre'=> $langs->trans('Demandes'),
				'level'=> 0,
				'enabled'=> $user->hasRight("eservices", "demande", "read"),
				'target'=>'',
				'mainmenu'=>'ticket',
				'leftmenu'=>'ticket_eservices',
				'position'=> 101,
				'id' => '',
				'idsel' => '',
				'classname' => '',
				'prefix' => '<span class="fas fa-ticket-alt infobox-contrat paddingright pictofixedwidth em092" style=""></span>'
			);
			$this->results[] = array(
				'url'=>'custom/eservices/ticket/card.php?action=create&mode=init&amp;',
				'titre'=> $langs->trans('New_Demandes'),
				'level'=> 1,
				'enabled'=> $user->hasRight("eservices", "demande", "write"),
				'target'=>'',
				'mainmenu'=>'ticket',
				'leftmenu'=>'ticket_eservices_card',
				'position'=> 102,
				'id' => '',
				'idsel' => '',
				'classname' => '',
				'prefix' => ''
			);
			$this->results[] = array(
				'url'=>'custom/eservices/ticket/list.php?search_fk_status=non_closed&amp;',
				'titre'=> $langs->trans('List_Demandes'),
				'level'=> 1,
				'enabled'=> $user->hasRight("eservices", "demande", "read"),
				'target'=>'',
				'mainmenu'=>'ticket',
				'leftmenu'=>'ticket_eservices_list',
				'position'=> 103,
				'id' => '',
				'idsel' => '',
				'classname' => '',
				'prefix' => ''
			);
			$this->results[] = array(
				'url'=>'custom/eservices/ticket/list.php?mode=mine&search_fk_status=non_closed&amp;',
				'titre'=> $langs->trans('My_Demandes'),
				'level'=> 1,
				'enabled'=> $user->hasRight("eservices", "demande", "read"),
				'target'=>'',
				'mainmenu'=>'ticket',
				'leftmenu'=>'ticket_eservices_my',
				'position'=> 105,
				'id' => '',
				'idsel' => '',
				'classname' => '',
				'prefix' => ''
			);
			$this->results[] = array(
				'url'=>'custom/eservices/ticket/stats/index.php?',
				'titre'=> $langs->trans('Stat_Demandes'),
				'level'=> 1,
				'enabled'=> $user->hasRight("eservices", "demande", "read"),
				'target'=>'',
				'mainmenu'=>'ticket',
				'leftmenu'=>'ticket_eservices_stat',
				'position'=> 107,
				'id' => '',
				'idsel' => '',
				'classname' => '',
				'prefix' => ''
			);
			$this->results[] = array(
				'url'=>'/categories/index.php?type=12&amp;',
				'titre'=> 'Tags/cat&eacute;gories',
				'level'=> 1,
				'enabled'=> $user->hasRight("eservices", "demande", "read"),
				'target'=>'',
				'mainmenu'=>'ticket',
				'leftmenu'=>'ticket_eservices_cat',
				'position'=> 107,
				'id' => '',
				'idsel' => '',
				'classname' => '',
				'prefix' => ''
			);
			return 1;		
		}

		// pour insérer le lien opcache
		if ((in_array($parameters['currentcontext'], array('leftblock'))) && (in_array($parameters['context'], array('searchform:leftblock:toprightmenu:main')))) {
			// refaire la liste des liens de menu et ajouter le lien opcache-gui après le lien purge
			foreach ($hook_items as &$item) {
				//si lien purge trouvé alors faire ajout opcache-gui
				if (isset($item['url']) && (strpos($item['url'], '/admin/tools/purge.php') !== false)) {
					$this->results[] = array(
						'url'=>'/custom/eservices/opcachegui/opcachegui.php?mainmenu=home&leftmenu=admintools',
						'titre'=> $langs->trans('opcache'),
						'level'=> 1,
						'enabled'=> $user->hasRight("eservices", "opcacheadmin", "read"),
						'target'=>'',	    
						'mainmenu'=>'',
						'leftmenu'=>'',
						'position'=>0,
						'id' => '',
						'idsel' => '',
						'classname' => '',
						'prefix'=> '',
					);
				}
				$this->results[] = $item;
			}
			return 1;
		}

		return 0; // or return 1 to replace standard code
	}

	/**
	 * Overloading the addOpenElementsDashboardGroup function : replacing the parent's function with the one below
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function addOpenElementsDashboardGroup($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter
		/* 		foreach ($parameters as $key => $item) {
			dol_syslog('fred admin : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */
		if (in_array($parameters['currentcontext'], array('index', 'main')) && (strpos($parameters['context'], 'index') !== false)) {	    // do something only for the context 'somecontext1' or 'somecontext2'
			// Do what you want here...
			// You can for example call global vars like $fieldstosearchall to overwrite them, or update database depending on $action and $_POST values.
			foreach ($parameters['dashboardgroup'] as $key => $item) {			
				// Vérifier si la clé est 'ticket' et modifier la valeur de 'groupName'
				if ($key == 'ticket' && isset($item['groupName'])) {
					$parameters['dashboardgroup'][$key]['groupName'] = 'DEMANDES'; // Modifier la valeur de 'groupName'
				}
			}
		}

		if (!$error) {
			$this->results = $parameters['dashboardgroup'];
			return 0; // or return 1 to replace standard code
		} else {
			$this->errors[] = 'Error message';
			return -1;
		}
	}

	/**
	 * Overloading the addOpenElementsDashboardLine function : replacing the parent's function with the one below
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function addOpenElementsDashboardLine($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter
		$mydashboardline = array();
		/* 		 		foreach ($parameters as $key => $item) {
			dol_syslog('fred addOpenElementsDashboardLine context : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */		
		if ((in_array($parameters['currentcontext'], array('index', 'main'))) && (strpos($parameters['context'], 'index') !== false)) {	    // do something only for the context 'somecontext1' or 'somecontext2'
			// Do what you want here...
			// You can for example call global vars like $fieldstosearchall to overwrite them, or update database depending on $action and $_POST values.
			include_once DOL_DOCUMENT_ROOT.'/ticket/class/ticket.class.php';
			$board = new Ticket($this->db);
			//modifier ici l'objet $response = new WorkboardResponse();
			$objet_response = $board->load_board($user, "opened");
			$label = $langs->trans("MenuListNonClosedDemande");
			$labelShort = $langs->trans("MenuListNonClosedDemande");
			$objet_response->url = DOL_URL_ROOT.'/custom/eservices/ticket/list.php?search_fk_statut[]=openall';
			$objet_response->label = $label;
			$objet_response->labelShort = $labelShort;
			$mydashboardline[$board->element.'_opened'] = $objet_response;
		}

		if (!$error) {
			$this->results = $mydashboardline;
			return 0; // or return 1 to replace standard code
		} else {
			$this->errors[] = 'Error message';
			return -1;
		}
	}
	
	/**
	 * Overloading the addHtmlHeader function : replacing the parent's function with the one below
	 *
	 * @param   array           $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action         Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function addHtmlHeader($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter
		/* 		foreach ($parameters as $key => $item) {
			dol_syslog('fred admin addHtmlHeader: '.'key : '. $key .' valeur : '. print_r($item, true));
		}
		dol_syslog('fred admin addHtmlHeader:  '.print_r($object, true). "action: " . $action); */
		$scriptpourformulaire = '';
		if (in_array($parameters['currentcontext'], array('publicnewticketcard'))) {	    // do something only for the context 'somecontext1' or 'somecontext2'
			// Do what you want here...
			// You can for example call global vars like $fieldstosearchall to overwrite them, or update database depending on $action and $_POST values.
			$scriptpourformulaire = '<script type="text/javascript">
			document.addEventListener("DOMContentLoaded", function() {

				// Sélectionner l\'élément <select> avec id="options_eservicelie"
				const serviceSelect = document.querySelector("#options_eservicelie");
		
				// Fonction pour afficher/masquer les champs selon la valeur sélectionnée
				function reloadform() {
					// Assurez-vous que serviceSelect existe avant d\'essayer d\'y accéder
					if (!serviceSelect) return;					
					const form = document.querySelector("#form_create_ticket"); // Formulaire
					if (!form) return;
					// Ajouter ou mettre à jour le champ hidden pour l\'action
					let actionInput = form.querySelector("input[name=\'action\']");
					actionInput.value = "create"; // Définir l\'action
					// Soumettre le formulaire
					form.submit();		
				}
		
				// Écouter l\'événement change sur le <select> pour détecter la sélection
				$(serviceSelect).on(\'change\', reloadform);
		
				// Fonction pour définir les valeurs par défaut et cacher les champs
				function setDefaultValuesAndHide() {
					const fields = [
						{ selector: "#selecttype_code", value: "ESERV" },
						{ selector: "#selectcategory_code", value: "GEN" },
						{ selector: "#selectseverity_code", value: "NORM" },
						{ selector: "#subject", value: "Demande en ligne" },
						{ selector: "#message", value: "Merci de bien vouloir prendre en compte cette demande d\'acte faite en ligne" },
					];
					fields.forEach(field => {
						const element = document.querySelector(field.selector);
						if (element) element.value = field.value;
					});					
				}
			
				// Applique les modifications au chargement de la page
				setDefaultValuesAndHide();

				const addFileButton = document.getElementById("addfile");
				if (addFileButton) {
					addFileButton.addEventListener("click", function (e) {
						const fileInput = document.getElementById("addedfile");
						const file = fileInput.files[0];
						const allowedTypes = ["image/jpeg", "image/png", "image/gif", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
						const maxFileSize = 2 * 1024 * 1024; // 5 MB
				
						if (file) {
							if (!allowedTypes.includes(file.type)) {
								alert("Fichier non autorisé. Veuillez sélectionner un fichier image, PDF ou Word.");
								e.preventDefault();
							}
							if (file.size > maxFileSize) {
								alert("Fichier trop volumineux. La taille maximale est de 2 MB.");
								e.preventDefault();
							}
						}
					});
				}
			});
			</script>';
		}

		if (!$error) {
			//$this->results = array('myreturn' => 999);
			$this->resprints = $scriptpourformulaire;
			return 0; // or return 1 to replace standard code
		} else {
			$this->errors[] = 'Error message';
			return -1;
		}
	}

	/**
	 * Execute action
	 *
	 * @param	array			$parameters		Array of parameters
	 * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string			$action      	'add', 'update', 'view'
	 * @return	int         					<0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *                            				>0 if OK and we want to replace standard actions.
	 */
	public function setHtmlTitle($parameters, &$object, &$action)
	{
		global $db, $langs, $conf, $user;
		/* 	foreach ($parameters as $key => $item) {
			dol_syslog('fred admin setHtmlTitle : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */		
		//récupérer le label de l'entité 
		$sqllabel = "SELECT label FROM ".MAIN_DB_PREFIX."entity ";
		$sqllabel .= "WHERE rowid = ".$conf->entity;
		$resql = $this->db->query($sqllabel);
		$objlabel = $this->db->fetch_object($resql);
		$this->db->free($resql);
		//le title a affiché en interface publique
		$titletoshow = '';
		if (!empty($object)){
			$titletoshow = getDolGlobalString('ESERVICES_TITLE_PUBLIC', '').' '.$objlabel->label;	
		}
		
		$this->resprints = $titletoshow;
		return 1;
	}

	/**
	 * Execute action
	 *
	 * @param	array			$parameters		Array of parameters
	 * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string			$action      	'add', 'update', 'view'
	 * @return	int         					<0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *                            				>0 if OK and we want to replace standard actions.
	 */
	public function printFieldListHeader($parameters, &$object, &$action)
	{
		global $db, $langs, $conf, $user;
		/* 			foreach ($parameters as $key => $item) {
			dol_syslog('fred admin printFieldListHeader : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */		
		if (in_array($parameters['currentcontext'], array('ticketpubliclist', 'ticketlist', 'thirdpartyticket', 'projectticket'))) {
			//supprimer les champs à ne pas afficher dans la liste interface publique
			//il faut supprimer les extrafields sauf eservicelie
			foreach ($parameters['arrayfields'] as $key => $value) {
				// Suppression des clés commençant par 'ef.' sauf 'ef.eservicelie'
				if ((preg_match('/^ef\./', $key) && $key !== 'ef.eservicelie') 
					|| ($key == 'type.code') 
					|| ($key == 'category.code') 
					|| ($key == 'severity.code')) {
					//dol_syslog("Suppression de la clé : $key");
					unset($parameters['arrayfields'][$key]);
				}
			}
		}
		$this->resprints = '';
		return 1;
	}
	
	/**
	 * Execute action
	 *
	 * @param	array			$parameters		Array of parameters
	 * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string			$action      	'add', 'update', 'view'
	 * @return	int         					<0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *                            				>0 if OK and we want to replace standard actions.
	 */
	public function printFieldPreListTitle($parameters, &$object, &$action)
	{
		global $db, $langs, $conf, $user;
		/*	foreach ($parameters as $key => $item) {
			dol_syslog('fred admin printFieldPreListTitle : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */		
		if (in_array($parameters['currentcontext'], array('ticketlist', 'thirdpartyticket', 'projectticket'))) {
			//supprimer les champs à ne pas afficher dans la liste interface publique
			//il faut supprimer les extrafields sauf eservicelie
			foreach ($parameters['arrayfields'] as $key => $value) {
				// Suppression des clés commençant par 'ef.' sauf 'ef.eservicelie'
				if ((preg_match('/^ef\./', $key) && $key !== 'ef.eservicelie') 
					|| ($key == 't.import_key') 
					|| ($key == 't.rowid') 
					|| ($key == 't.extraparams')) {
					//dol_syslog("Suppression de la clé : $key");
					unset($parameters['arrayfields'][$key]);
				}
			}
		}
		$this->resprints = '';
		return 0;
	}

	/**
	 * Execute action
	 *
	 * @param	array			$parameters		Array of parameters
	 * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string			$action      	'add', 'update', 'view'
	 * @return	int         					<0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *                            				>0 if OK and we want to replace standard actions.
	 */
	public function formBuildmodellistOptions($parameters, &$object)
	{
		global $db, $langs, $conf, $user;
		/* foreach ($parameters as $key => $item) {
			dol_syslog('fred admin formBuildmodellistOptions : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */		
		if (in_array($parameters['currentcontext'], array('ticketcard'))) {
			// Récupérer la valeur à conserver, c'est-à-dire la valeur de $object->model_pdf
			$modelToKeep = $object->model_pdf;
			// Filtrer les éléments du tableau pour garder uniquement ceux correspondant à $modelToKeep
			$filteredList = array();		
			// Parcourir chaque élément du tableau 'modellist'
			foreach ($parameters['modellist'] as $key => $value) {
				// Garder l'élément uniquement si sa valeur correspond à $modelToKeep
				if ($key === $modelToKeep) {
					$filteredList[$key] = $value; // Ajouter à $filteredList en gardant les clés intactes
				}
			}		
			// Réaffecter le tableau filtré à la clé 'modellist'
			$parameters['modellist'] = $filteredList;
		}
		return 0;
	}
		/**
	 * Execute action
	 *
	 * @param	array			$parameters		Array of parameters
	 * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string			$action      	'add', 'update', 'view'
	 * @return	int         					<0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *                            				>0 if OK and we want to replace standard actions.
	 */
	public function ODTSubstitution($parameters, &$object, $action)
	{
		global $db, $langs, $conf, $user;
		/* foreach ($parameters as $key => $item) {
			dol_syslog('fred admin ODTSubstitution : '.'key : '. $key .' valeur : '. print_r($item, true));
		} */		
		if (in_array($parameters['currentcontext'], array('ticketcard'))) {
			global $extrafields;
			$array_key = 'object';
			$date = dol_now();
			$resarray = array(
				$array_key.'_id' => $parameters['object']->id,
				$array_key.'_ref' => (property_exists($parameters['object'], 'ref') ? $parameters['object']->ref : ''),
				$array_key.'_label' => (property_exists($parameters['object'], 'label') ? $parameters['object']->label : ''),
				$array_key.'_ref_ext' => (property_exists($parameters['object'], 'ref_ext') ? $parameters['object']->ref_ext : ''),
				// Dates
				$array_key.'_hour' => dol_print_date($date, 'hour'),
				$array_key.'_date' => dol_print_date($date, 'day'),
				$array_key.'_date_rfc' => dol_print_date($date, 'dayrfc'),
				$array_key.'_date_creation' => dol_print_date($parameters['object']->date_creation, 'day'),
				$array_key.'_date_modification' => (!empty($parameters['object']->date_modification) ? dol_print_date($parameters['object']->date_modification, 'day') : ''),
				$array_key.'_date_validation' => (!empty($parameters['object']->date_validation) ? dol_print_date($parameters['object']->date_validation, 'dayhour') : ''),
				$array_key.'_date_close' => (!empty($parameters['object']->date_cloture) ? dol_print_date($parameters['object']->date_cloture, 'dayhour') : ''),
			);
			// Fetch project information if there is a project assigned to this parameters['object']
			if ($parameters['object']->element != "project" && !empty($parameters['object']->fk_project) && $parameters['object']->fk_project > 0) {
				if (!is_object($parameters['object']->project)) {
					$parameters['object']->fetch_projet();
				}

				$resarray[$array_key.'_project_ref'] = $parameters['object']->project->ref;
				$resarray[$array_key.'_project_title'] = $parameters['object']->project->title;
				$resarray[$array_key.'_project_description'] = $parameters['object']->project->description;
				$resarray[$array_key.'_project_date_start'] = dol_print_date($parameters['object']->project->date_start, 'day');
				$resarray[$array_key.'_project_date_end'] = dol_print_date($parameters['object']->project->date_end, 'day');
			} else { // empty replacement
				$resarray[$array_key.'_project_ref'] = '';
				$resarray[$array_key.'_project_title'] = '';
				$resarray[$array_key.'_project_description'] = '';
				$resarray[$array_key.'_project_date_start'] = '';
				$resarray[$array_key.'_project_date_end'] = '';
			}
			// Retrieve extrafields
			if (is_array($parameters['object']->array_options) && count($parameters['object']->array_options)) {
				$parameters['object']->fetch_optionals();

				$resarray = $object->fill_substitutionarray_with_extrafields($parameters['object'], $resarray, $extrafields, $array_key, $parameters['outputlangs']);

				/*
				* Génération automatique de variables booléennes pour les extrafields radio.
				*
				* Exemple :
				* options_3_sexe = 1
				*
				* Génère :
				* {object_options_3_sexe_1} = 1
				* {object_options_3_sexe_2} = ''
				*
				* Utilisation ODT :
				* [!-- IF {object_options_3_sexe_2} --]Elle[!-- ELSE {object_options_3_sexe_2} --]Il[!-- ENDIF {object_options_3_sexe_2} --]
				*/	
				if (!empty($extrafields->attributes['ticket']['type']) && is_array($extrafields->attributes['ticket']['type'])) {
					foreach ($extrafields->attributes['ticket']['type'] as $key => $type) {
						if ($type !== 'radio') {
							continue;
						}

						$optionKey = 'options_'.$key;
						$currentValue = $parameters['object']->array_options[$optionKey] ?? '';

						if (!empty($extrafields->attributes['ticket']['param'][$key]['options'])
							&& is_array($extrafields->attributes['ticket']['param'][$key]['options'])) {
							foreach ($extrafields->attributes['ticket']['param'][$key]['options'] as $optionValue => $optionLabel) {
								$resarray[$array_key.'_options_'.$key.'_'.$optionValue] = ((string) $currentValue === (string) $optionValue) ? '1' : '';
							}
						}
					}
				}
			}

			$parameters['substitutionarray'] = array_merge($parameters['substitutionarray'], $resarray);

		}
		return 0;
	}

	/**
	 * Hook pour transférer les fichiers de rapportages vers le répertoire de traitement input du processus d'intégration de données dans churchdata
	 *
	 * @param	array			$parameters		Array of parameters
	 * @param	CommonObject    $object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string			$action      	'add', 'update', 'view'
	 * @return	int         					<0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *                            				>0 if OK and we want to replace standard actions.
	 */
	public function moveUploadedFileSuccess($parameters, &$object)
	{
		global $db, $langs, $conf, $user;
		if (in_array($parameters['currentcontext'], array('fileslib'))) {
			$nomFichierRapportage = basename($parameters['file_name']);
			//dol_syslog('fred hook : '.$nomFichierRapportage);
			$nomFichierKPI = getDolGlobalString('ESERVICES_KPI_FILE', '');
			$nomFichierPTA = getDolGlobalString('ESERVICES_PTA_FILE', '');
			$nomFichierINDIC_MESUR = getDolGlobalString('ESERVICES_INDIC_MESURE_FILE', '');
			if (($nomFichierRapportage === $nomFichierKPI) || ($nomFichierRapportage === $nomFichierPTA) || ($nomFichierRapportage === $nomFichierINDIC_MESUR)) {
				//dol_syslog('fred hook ok '.print_r($parameters, true));
				//si c'est l'un ou l'autre des fichiers attendus alors faire le transfert
				if ((int) $conf->entity != 1){
					//ajout d'une particule pour l'entité. Mais avant créer les répertoires s'ils n'existe pas
					$rapportage_folder = DOL_DATA_ROOT . '/eservices/churchdata/etl/input/'.$conf->entity;
					if(!dol_is_dir($rapportage_folder)){
						dol_mkdir($rapportage_folder, DOL_DATA_ROOT .'/eservices/churchdata/etl/input');
					}
					$rapportage_file = DOL_DATA_ROOT . '/eservices/churchdata/etl/input/'.$conf->entity.'/'.$nomFichierRapportage;
					//dol_syslog("rapportage_file: $rapportage_file");
				} else {
					$rapportage_file = DOL_DATA_ROOT . '/eservices/churchdata/etl/input/'.$nomFichierRapportage;
				}				
				//faire la copie
				$file_src = $parameters['file_name'];
				if(dol_copy($file_src, $rapportage_file, '644', 1) > 0){
					//message de confirmation
					dol_syslog("copie avec succès du fichier de rapportage $rapportage_file");
				} else {
					// copie échouée, ajouter une erreur
					dol_syslog("Erreur lors de la copie du fichier de rapportage $rapportage_file");		
				}				
			}
			
		}	
	}
		
}
