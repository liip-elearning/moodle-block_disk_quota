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
$string['disk_quota:myaddinstance'] = 'Ajouter un nouveau bloc Quota de disque à mon Dashboard';
$string['disk_quota:viewblock'] = 'Voir un bloc Quota de disque';
$string['disk_quota:viewusage'] = 'Voir les détails de l\'utilisation du quota';
$string['err_cannot_uninstall_plugin'] = 'Ce plugin ne peut pas être désinstallé';
$string['quota_used'] = '{$a->used} de {$a->quota} GB utilisés';
$string['gigabytes_used'] = 'GB utilisés';

// Tasks.
$string['task_get_disk_usage'] = 'Obtenir l\'utilisation de l\'espace disque';

// Settings strings.
$string['enabled'] = 'Actif';
$string['enabled_desc'] = 'Si la vérification du quota de l\'espace disque est appliquée';

//P.T. 29-09-2022: additional strings for 'block_site_enabled' and 'block_site_enabled_desc'
$string['block_site_enabled'] = 'Désactivation automatique du site';
$string['block_site_enabled_desc'] = 'Activation du blocage automatique du site après dépassement de la limite de l\'espace disque au dela de la limite autorisée.';

$string['quota_gb'] = 'Quota de disque';
$string['quota_gb_desc'] = 'Quota de disque en gigabytes';
$string['quota_activeusers'] = 'Quota d\'utilisateurs·rices actif·ves';
$string['quota_activeusers_desc'] = 'Quota d\'utilisateur·trices actif·ves (connectés dans les 12 derniers mois)';
$string['warn_when_within_gb_of_limit'] = 'Prévenir quand le quota s\'approche de cette limit';
$string['warn_when_within_gb_of_limit_desc'] = 'Envoie un avertissement aux utilisateur·trices prédefinis lorsque l\'utilisation de \'espace disque se situe dans les X GB de la limite';
$string['overage_limit_gb'] = 'Autoriser un dépassement de la limite de';
$string['overage_limit_gb_desc'] = 'Dépassement d\'espace disque toléré avant que le site soit automatiquement désactivé';
$string['do_email_admins'] = 'Prévenir les administrateur·trices?';
$string['do_email_admins_desc'] = 'Est-ce que les tous·tes les administrateur·trices doivent recevoir les notifications?';
$string['email_others'] = 'Emails additionnels';
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
$string['mail_nearing_quota_subject'] = 'Votre instance Moodle approche de son quota limite';
$string['mail_nearing_quota_body'] =
'Votre instance Moodle {$a->url} utilise actuellement {$a->used} GB
des {$a->quota} alloués pour ses données.

Si vous avez besoin de plus d\'espace, nous vous prions de commander
une augmentation de la capacité de stockage. Nous vous suggérons
d’éventuellement réduire l\'espace disque utilisé en supprimant des
données inutiles.

Lorsque l\'espace disque utilisé par votre instance Moodle dépasse la limite
contractuelle d\'une trop grande marge, automatiquement celle-ci n’est plus
disponible pour les utilisateurs. Un message automatique de mise en maintenance
est activé.

{$a->signature}
';

//P.T. 29-09-2022 added changed lang-strings for notification messages when automatic site block disabled
$string['mail_nearing_quota_noblock_subject'] = 'Votre instance Moodle approche de son quota limite';
$string['mail_nearing_quota_noblock_body'] =
'Votre instance Moodle {$a->url} utilise actuellement {$a->used} GB
des {$a->quota} alloués pour ses données.

Si vous avez besoin de plus d\'espace, nous vous prions de commander
une augmentation de la capacité de stockage. Nous vous suggérons
d’éventuellement réduire l\'espace disque utilisé en supprimant des
données inutiles.

{$a->signature}
';

$string['mail_over_quota_subject'] = 'Le site Moodle a dépassé son quota limite';
$string['mail_over_quota_body'] =
'Votre instance Moodle {$a->url} utilise actuellement {$a->used} GB
des {$a->quota} alloués pour ses données.

Pourriez vous nous contacter au plus vite pour résoudre cette situation.
Il vous est possible, soit de commander plus d\'espace disque, soit de
réduire l\'espace disque utilisé en supprimant des données.

Lorsque l\'espace disque utilisé par votre instance Moodle dépasse la limite
contractuelle d\'une trop grande marge, automatiquement celle-ci n’est plus
disponible pour les utilisateurs. Un message automatique de mise en maintenance
est activé.

Veuillez nous contacter pour éviter cette situation, nous vous proposerons volontiers
une mise à jour.

{$a->signature}
';

//P.T. 29-09-2022 added changed lang-strings for notification messages when automatic site block disabled
$string['mail_over_quota_noblock_subject'] = 'Important: Le site Moodle a dépassé son quota limite';
$string['mail_over_quota_noblock_body'] =
'Votre instance Moodle {$a->url} utilise actuellement {$a->used} GB
des {$a->quota} alloués pour ses données.

Pourriez vous nous contacter au plus vite pour résoudre cette situation.
Il vous est possible, soit de commander plus d\'espace disque, soit de
réduire l\'espace disque utilisé en supprimant des données.

{$a->signature}
';

$string['mail_site_blocked_subject'] = 'Important: Votre instance Moodle est désactivée';
$string['mail_site_blocked_body'] =
'Votre instance Moodle {$a->url} utilise actuellement {$a->used} GB
des {$a->quota} alloués pour ses données.

Vous avez reçu plusieurs mails d\'avertissement vous demandant de nous
contacter pour mettre à jour la capacité de stockage des données. Sans
réponse de votre part, celle-ci a été désactivée automatiquement pour
éviter d\'impacter la qualité de notre infrastructure et des autres
projets hébergés.

Pourriez vous nous contacter immédiatement afin de nous permettre de
trouver ensemble une solution.

{$a->signature}
';

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
