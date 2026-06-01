<?php
/* Copyright (C) 2024 Junior omega
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
 *
 * Library javascript to enable Browser notifications
 */

if (!defined('NOREQUIRESOC')) {
	define('NOREQUIRESOC', '1');
}
if (!defined('NOREQUIRETRAN')) {
	define('NOREQUIRETRAN', '1');
}
if (!defined('NOTOKENRENEWAL')) {
	define('NOTOKENRENEWAL', 1);
}
if (!defined('NOREQUIREMENU')) {
	define('NOREQUIREMENU', 1);
}
if (!defined('NOREQUIREHTML')) {
	define('NOREQUIREHTML', 1);
}
if (!defined('NOREQUIREAJAX')) {
	define('NOREQUIREAJAX', '1');
}


/**
 * \file    eservices/js/eservices.js.php
 * \ingroup eservices
 * \brief   JavaScript file for module Eservices.
 */

// Load Dolibarr environment
$res = 0;
// Try main.inc.php into web root known defined into CONTEXT_DOCUMENT_ROOT (not always defined)
if (!$res && !empty($_SERVER["CONTEXT_DOCUMENT_ROOT"])) {
	$res = @include $_SERVER["CONTEXT_DOCUMENT_ROOT"]."/main.inc.php";
}
// Try main.inc.php into web root detected using web root calculated from SCRIPT_FILENAME
$tmp = empty($_SERVER['SCRIPT_FILENAME']) ? '' : $_SERVER['SCRIPT_FILENAME']; $tmp2 = realpath(__FILE__); $i = strlen($tmp) - 1; $j = strlen($tmp2) - 1;
while ($i > 0 && $j > 0 && isset($tmp[$i]) && isset($tmp2[$j]) && $tmp[$i] == $tmp2[$j]) {
	$i--; $j--;
}
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1))."/main.inc.php")) {
	$res = @include substr($tmp, 0, ($i + 1))."/main.inc.php";
}
if (!$res && $i > 0 && file_exists(substr($tmp, 0, ($i + 1))."/../main.inc.php")) {
	$res = @include substr($tmp, 0, ($i + 1))."/../main.inc.php";
}
// Try main.inc.php using relative path
if (!$res && file_exists("../../main.inc.php")) {
	$res = @include "../../main.inc.php";
}
if (!$res && file_exists("../../../main.inc.php")) {
	$res = @include "../../../main.inc.php";
}
if (!$res) {
	die("Include of main fails");
}

// Define js type
header('Content-Type: application/javascript');
// Important: Following code is to cache this file to avoid page request by browser at each Dolibarr page access.
// You can use CTRL+F5 to refresh your browser cache.
if (empty($dolibarr_nocache)) {
	header('Cache-Control: max-age=3600, public, must-revalidate');
} else {
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');
}
?>

/* Javascript library of module Eservices */

(function () {
    'use strict';

    function estSurPageSpecifique() {
        return window.location.pathname.includes('/ticket/card.php');
    }

    function safeRequestSubmit(form) {
        if (!form) return;

        if (typeof form.requestSubmit === 'function') {
            form.requestSubmit();
        } else {
            form.submit();
        }
    }

    function reloadform(serviceSelect) {
        if (!serviceSelect) return;

        const form = document.querySelector("#form_create_ticket");
        if (!form) return;

        const actionInput = form.querySelector("input[name='action']");
        const idInput = form.querySelector("input[name='id']");

        if (actionInput) {
            actionInput.value = idInput && idInput.value ? "edit" : "create";
        }

        safeRequestSubmit(form);
    }

    function setDefaultValuesAndHide() {
        const fields = [
            { selector: "#selecttype_code", value: "ESERV" },
            { selector: "#selectcategory_code", value: "GEN" },
            { selector: "#selectseverity_code", value: "NORM" },
            { selector: "#subject", value: "Demande Interface privée" }
        ];

        fields.forEach(function (field) {
            const element = document.querySelector(field.selector);
            if (element) {
                element.value = field.value;
            }
        });

        const categoriesField = document.querySelector("select[name='categories[]']");
        if (categoriesField) {
            for (const option of categoriesField.options) {
                option.selected = option.value === "2";
            }

            const row = categoriesField.closest("tr");
            if (row) {
                row.style.display = "none";
            }
        }
    }

    function validateAddedFile(event) {
        const fileInput = document.getElementById('addedfile');

        if (!fileInput || !fileInput.files || !fileInput.files.length) {
            return;
        }

        const file = fileInput.files[0];

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        const allowedExtensions = [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'pdf',
            'doc',
            'docx'
        ];

        const maxFileSize = 2 * 1024 * 1024; // 2 MB

        const fileName = file.name || '';
        const extension = fileName.includes('.')
            ? fileName.split('.').pop().toLowerCase()
            : '';

        if (!allowedTypes.includes(file.type) || !allowedExtensions.includes(extension)) {
            alert('Fichier non autorisé. Veuillez sélectionner un fichier image, PDF ou Word.');
            event.preventDefault();
            return false;
        }

        if (file.size > maxFileSize) {
            alert('Fichier trop volumineux. La taille maximale est de 2 MB.');
            event.preventDefault();
            return false;
        }

        return true;
    }

    document.addEventListener("DOMContentLoaded", function () {
        if (!estSurPageSpecifique()) {
            return;
        }

        const serviceSelect = document.querySelector("#options_eservicelie");

        if (serviceSelect) {
            if (window.jQuery) {
                $(serviceSelect).on('change', function () {
                    reloadform(serviceSelect);
                });
            } else {
                serviceSelect.addEventListener('change', function () {
                    reloadform(serviceSelect);
                });
            }

            setDefaultValuesAndHide();
        }

        const addFileButton = document.getElementById("addfile");
        if (addFileButton) {
            addFileButton.addEventListener('click', validateAddedFile);
        }
    });
})();


