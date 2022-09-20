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

// Tasks.
$string['task_get_disk_usage'] = 'Enregistrer l\'utilisation d\'espace disque';

// Settings strings.
$string['enabled'] = 'Actif';
$string['enabled_desc'] = 'Activer la vérification de quota de disque';
$string['quota_gb'] = 'Quota de disque';
$string['quota_gb_desc'] = 'Quota de disque en gigabytes';
$string['quota_activeusers'] = 'Quota d\'utilisateurs actifs';
$string['quota_activeusers_desc'] = 'Quota d\'utilisateurs actifs (connectés dans les 6 derniers mois)';
$string['warn_when_within_gb_of_limit'] = 'Prévenir quand la différence entre l\'espace utilisé et le quota atteint cette limite';
$string['warn_when_within_gb_of_limit_desc'] = 'Envoie un avertissement à l\'utilisateur choisi quand l\'espace disque est compris dans la limite définie';
$string['overage_limit_gb'] = 'Allow exceeding limit by';
$string['overage_limit_gb_desc'] = 'Dépassement d\'espace disque toléré avant que le site soit automatiquement désactivé';
$string['do_email_admins'] = 'Prévenir les administrateurs?';
$string['do_email_admins_desc'] = 'Est-ce que les utilisateurs ayant des droits d\'administrateur doivent recevoir les notifications?';
$string['email_others'] = 'Utilisateurs notifiés additionnels';
$string['email_others_desc'] = 'Addresses mail additionnelles à utiliser lorsque des notifications sont envoyées. Séparez des addresses mutltiples avec une virgule (exemple : user1@exemple.com, user2@exemple.org, user3@exemple.net)';
$string['err_invalid_email_address'] = 'L\'addresse email en position {$a} n\'est pas une addresse email valide';
$string['site_blocked_maintenance_message'] = 'Le site est actuellement indisponible car le quota disque a été largement dépassé. Administrateur: Veuillez contacter le support pour aider à résoudre ce problème';
$string['support_telephone'] = 'No Téléphonique du support';
$string['support_telephone_desc'] = 'No Téléphonique pour le support urgent';
$string['support_email'] = 'Email de support';
$string['support_email_desc'] = 'Addresse email de support';
$string['nearing_quota_warn_email_frequency'] = 'Fréquence des notifications de quota presque atteint';
$string['nearing_quota_warn_email_frequency_desc'] = 'A quelle fréquence les mails de notification seront-ils envoyés lorsque l\'espace occupé par le site approche son quota';
$string['over_quota_warn_email_frequency'] = 'Fréquence des notifications de quota dépassé';
$string['over_quota_warn_email_frequency_desc'] = 'A quelle fréquence les mails de notification seront-ils envoyés lorsque l\'espace occupé par le site dépasse son quota';

// Email strings.
//P.T. 16.09.2022 [MDLSAAS-39]: replaced lang-strings for the notification email (subjects + body-texts)
$string['mail_nearing_quota_subject'] = 'Votre instance Moodle approche de sa quota limite';
$string['mail_nearing_quota_body'] =
'Cher client,
Cet email est un rappel en ce qui concerne votre instance Moodle, cette dernière est proche d’atteindre la limite de son quota.

Votre instance Moodle {$a->url} utilise actuellement {$a->used} Go d’espace, vous avez à disposition {$a->quota} GO.

Afin de pallier ce problème, nous vous proposons de supprimer les données non utilisées ou de nous contacter pour augmenter la taille de votre espace.

N’hésitez pas à nous contacter directement à maas@liip.ch, nous sommes là pour vous assister. Le coût d’un espace de stockage supplémentaire est de CHF 30.- par année, pour 10 Go supplémentaires.


{$a->signature}
';

//P.T. 16.09.2022 [MDLSAAS-39]: replaced lang-strings for the notification email (subjects + body-texts)
$string['mail_over_quota_subject'] = 'Important: Votre site Moodle a dépassé son quota limite';
$string['mail_over_quota_body'] =
'Cher client,
Cet email est un rappel en ce qui concerne votre instance Moodle, cette dernière a dépassé la limite de quota en termes de données.

Votre instance Moodle {$a->url} utilise actuellement {$a->used} Go d’espace, vous avez à disposition {$a->quota} Go.

Afin de pallier ce problème, nous vous proposons de supprimer les données non utilisées ou de nous contacter pour augmenter la taille de votre espace.

Afin d’éviter une mise en maintenance automatique du système, merci de prendre vos dispositions nécessaires pour réduire votre espace.

N’hésitez pas à nous contacter directement à maas@liip.ch, nous sommes là pour vous assister. Le coût d’un espace de stockage supplémentaire est de CHF 30.- par année, pour 10 Go supplémentaires.


{$a->signature}
';

/***P.T. 16.09.2022 [MDLSAAS-39]: removed lang-strings for the following notification email:
$string['mail_site_blocked_subject'] = 'Important: Votre instance Moodle est désactivée';
$string['mail_site_blocked_body'] =
*/

$string['mail_signature'] = 'Avec nos sincères salutations,
La Team Elearning de Liip

Contact:
  email: {$a->supportemail}
  Telephone: {$a->supporttelephone}';

$string['backup_filename'] = 'Fichier';
$string['backup_course'] = 'Cours';
$string['backup_timemodified'] = 'Dernière modification';
$string['backup_size'] = 'Taille';
$string['backup_page_title'] = 'Détails des backups';
