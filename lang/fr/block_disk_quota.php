<?php
/**
 * Strings for component 'block_disk_quota', language 'fr'
 *
 * @package   block_recent_activity
 * @copyright 2015 Liip AG {@link http://liip.ch}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = 'Quota de disque';
$string['disk_quota:addinstance'] = 'Ajouter un nouveau bloc Quota de disque';
$string['disk_quota:myaddinstance'] = 'Ajouter un nouveau bloc Quota de disque à ma Dashboard';
$string['disk_quota:viewblock'] = 'un bloc Quota de disque';
$string['disk_quota:viewusage'] = 'Voir les détails de l\'utilisation du quota';
$string['err_cannot_uninstall_plugin'] = 'Ce plugin ne peut pas être désinstallé';
$string['quota_used'] = '{$a->used} de {$a->quota} GB utilisés';
$string['gigabytes_used'] = 'GB utilisés';

// Settings strings
$string['quota_gb'] = 'Quota de disque';
$string['quota_gb_desc'] = 'Quota de disque en gigabytes';
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

// Email strings
$string['mail_nearing_quota_subject'] = 'Le site Moodle approche son quota limite';
$string['mail_nearing_quota_body'] =
'Votre instance Moodle {$a->url} utilise actuellement {$a->used} GB des {$a->quota} alloués pour ses données.

Si vous avez besoin de plus d\'espace, veuillez en commander. Autrement il vous faudra réduire l\'espace disque utilisé en supprimant du contenu.

Si l\'espace disque utilisé par votre instance Moodle dépasse la limite contractuelle, elle va être mise automatiquement en maintenance et ne sera plus disponible pour les utilisateurs.
{$a->signature}
';

$string['mail_over_quota_subject'] = 'Le site Moodle a dépassé son quota limite';
$string['mail_over_quota_body'] =
'Votre instance Moodle {$a->url} utilise actuellement {$a->used} GB des {$a->quota} alloués pour ses données.

Veuillez s\'il vous plaît prendre des mesures immédiates pour résoudre cette situation. Vous pouvez soit commander plus d\'espace disque, soit réduire l\'espace disque utilisé en supprimant des données.

Si votre instance Moodle dépasse le quota limite d\'une trop grande marge, elle sera automatiquement mise en maintenance et ne sera plus disponible pour les utilisateurs.

{$a->signature}
';

$string['mail_site_blocked_subject'] = 'Important: le site Moodle a été mis en maintenance';
$string['mail_site_blocked_body'] =
'Votre instance Moodle {$a->url} utilise actuellement {$a->used} GB des {$a->quota} alloués pour ses données.

Pour éviter que ce dépassement n\'aie un impact sur la qualité des services aux autres clients, nous avons été forcés de désactiver votre instance Moodle.
Ceci est une mesure automatique, qui a normalement été activée après que vous ayez reçu des emails d\'avertissements sur la situation.

Veuillez nous contacter immédiatement pour que nous trouvions ensemble une solution.

{$a->signature}
';

$string['mail_signature'] = 'Avec nos cordiales salutations,
La Team Elearning de Liip

Contact:
  email: {$a->supportemail}
  Telephone: {$a->supporttelephone}';
