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
 * Strings for component 'block_disk_quota', language 'de'
 *
 * @package   block_recent_activity
 * @copyright 2015 Liip AG {@link http://liip.ch}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = 'Speicherplatz-Auslastung';
$string['disk_quota:addinstance'] = 'Neuen Speicherplatz-Auslastungs-Block hinzufügen';
$string['disk_quota:myaddinstance'] = 'Neuen Speicherplatz-Auslastungs-Block zu Meine Startseite (Dashboard) hinzufügen';
$string['disk_quota:viewblock'] = 'Speicherplatz-Auslastungs-Block ansehen';
$string['disk_quota:viewusage'] = 'Detail-Seite Speicherplatz-Auslastungs-Block ansehen';
$string['err_cannot_uninstall_plugin'] = 'Dieses Plugin kann nicht entfernt werden';
$string['quota_used'] = '{$a->used} von {$a->quota} GB benutzt';
$string['gigabytes_used'] = 'GB benutzt';

// Settings strings.
$string['enabled'] = 'Aktivieren';
$string['enabled_desc'] = 'Speicherplatz-Limite aktivieren';
$string['quota_gb'] = 'Speicherplatz-Limite';
$string['quota_gb_desc'] = 'Speicherplatz-Limite in Gigabyte';
$string['warn_when_within_gb_of_limit'] = 'Warnen wenn in der Nähe des Limits';
$string['warn_when_within_gb_of_limit_desc'] = 'Eine Warnung an die definierten Benutzer senden, wenn die Speicherplatz-Auslastung innerhalb von X GB des Limits ist';
$string['overage_limit_gb'] = 'Erlaube die Überschreitung des Limits um';
$string['overage_limit_gb_desc'] = 'Um wieviele Gigabytes das Limit der Speicherplatz-Auslastung überschritten werden darf, bevor die Seite automatisch deaktiviert wird.';
$string['do_email_admins'] = 'Email an Administratoren versenden?';
$string['do_email_admins_desc'] = 'Sollen alle Benutzer mit Administratoren-Rechten Warnungen und "Seite deaktiviert"-Benachrichtigungen erhalten?';
$string['email_others'] = 'Weitere Email-Adressen';
$string['email_others_desc'] = 'Weitere Email-Adressen, welche Benachrichtigungen erhalten. Mehrere Adressen '
    .'mit Komma separieren (user1@example.com, user2@example.org, user3@example.net)';

$string['err_invalid_email_address'] = 'Die Email-Adresse an der Stelle {$a} ist keine gültige Email-Adresse';
$string['site_blocked_maintenance_message'] = 'Die Seite ist zur Zeit nicht verfügbar, da die Speicherplatz-Limite erheblich überschritten wurde. '
    .'Administrator: bitte kontaktieren Sie den Support, um das Problem zu lösen.';
$string['support_telephone'] = 'Support Telefon';
$string['support_telephone_desc'] = 'Support Telefonnummer für dringende Fälle';
$string['support_email'] = 'Support-Email';
$string['support_email_desc'] = 'Support-Email-Adresse';
$string['nearing_quota_warn_email_frequency'] = 'Frequenz für Speicherplatz-Auslastungs-Warnungen';
$string['nearing_quota_warn_email_frequency_desc'] = 'Wie häufig Emails gesendet werden, wenn die Speicherplatz-Auslastung sich der Limite nähert';
$string['over_quota_warn_email_frequency'] = 'Frequenz für Speicherplatz-Überschreitungs-Warnungen';
$string['over_quota_warn_email_frequency_desc'] = 'Wie häufig Emails gesendet werden, wenn die Speicherplatz-Limite überschritten ist';

// Email strings.
$string['mail_nearing_quota_subject'] = 'Moodle-Instanz nähert sich dem Limit der Speicherplatz-Auslastung';
$string['mail_nearing_quota_body'] =
'Ihre Moodle-Instanz {$a->url} nutzt aktuell {$a->used} GB
des zugewiesenen Speicherplatzes von {$a->quota} GB für Dateien.

Falls Sie mehr Speicherplatz benötigen, kontaktieren Sie uns bitte
umgehend. Alternativ empfehlen wir Ihnen, benutzten Speicherplatz
freizugeben, indem Sie nicht benötigte Dateien löschen.

Jetzt wäre der richtige Zeitpunkt, um mehr Speicherplatz zu bestellen,
oder alte Dateien zu löschen.

Falls der zugewiesene Speicherplatz zu stark überschritten wird, wird
Ihre Moodle-Instanz automatisch in den Wartungs-Modus versetzt und ist
für die Benutzer nicht mehr verfügbar.

{$a->signature}
';

$string['mail_over_quota_subject'] = 'Moodle-Instanz hat die Limite der Speicherplatz-Auslastung überschritten';
$string['mail_over_quota_body'] =
'Ihre Moodle-Instanz {$a->url} nutzt aktuell {$a->used} GB
des zugewiesenen Speicherplatzes von {$a->quota} GB für Dateien.

Bitte kontaktieren Sie uns umgehend, für eine Erhöhung des
Speicherplatzes. Sie können entweder mehr Speicherplatz bestellen,
oder unbenutzte Dateien löschen.

Falls der zugewiesene Speicherplatz zu stark überschritten wird, wird
Ihre Moodle-Instanz automatisch in den Wartungs-Modus versetzt und ist
für die Benutzer nicht mehr verfügbar.

{$a->signature}
';

$string['mail_site_blocked_subject'] = 'Wichtig: Moodle-Instanz deaktiviert wegen übermässigem Speicherplatz-Verbrauch';
$string['mail_site_blocked_body'] =
'Ihre Moodle-Instanz {$a->url} nutzt aktuell {$a->used} GB
des zugewiesenen Speicherplatzes von {$a->quota} GB für Dateien.

Sie haben bereits mehrere Warnung per Email erhalten, mit der Bitte,
mehr Speicherplatz für Ihr Moodle zu bestellen. Ohne Feedback von Ihnen
wurde Ihre Moodle-Instanz automatisch deaktiviert, um negative
Auswirkungen auf unsere Infrastruktur und andere Kunden zu verhindern.

Bitte kontaktieren Sie uns schnellstmöglich, damit wir gemeinsam eine
Lösung finden können.

{$a->signature}
';

$string['mail_signature'] = 'Mit freundlichen Grüssen
Liip Elearning Team

Kontakt:
  Email: {$a->supportemail}
  Telefon: {$a->supporttelephone}';
