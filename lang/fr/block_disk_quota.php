<?php
// This file is part of the blocks/disk_quota Moodle plugin
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'block_disk_quota', language 'fr'
 *
 * @package   block_recent_activity
 * @copyright 2015 Liip AG {@link http://liip.ch}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = 'Quota d\'utilisation Liip';
$string['disk_quota:addinstance'] = 'Ajouter un nouveau bloc Quota de disque';
$string['disk_quota:myaddinstance'] = 'Ajouter un nouveau bloc Quota de disque à ma Dashboard';
$string['disk_quota:viewblock'] = 'un bloc Quota de disque';
$string['disk_quota:viewusage'] = 'Voir les détails de l\'utilisation du quota';
$string['err_cannot_uninstall_plugin'] = 'Ce plugin ne peut pas être désinstallé';
$string['quota_used'] = '{$a->used} de {$a->quota} GB utilisés';
$string['gigabytes_used'] = 'GB utilisés';
$string['active_users'] = '{$a->activeusers} active users ({$a->quota} allowed)';

// Tasks.
$string['task_get_disk_usage'] = 'Enregistrer l\'utilisation d\'espace disque';

// Settings strings.
$string['quota_gb'] = 'Quota de disque';
$string['quota_gb_desc'] = 'Quota de disque en gigabytes';
$string['quota_activeusers'] = 'Quota d\'utilisateurs actifs';
$string['quota_activeusers_desc'] = 'Quota d\'utilisateurs actifs (connectés dans les 6 derniers mois)';

$string['backup_filename'] = 'Fichier';
$string['backup_course'] = 'Cours';
$string['backup_timemodified'] = 'Dernière modification';
$string['backup_size'] = 'Taille';
$string['backup_page_title'] = 'Détails des backups';
