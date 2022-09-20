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
$string['pluginname'] = 'Liip Nutzung Auslastung';
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
//P.T. 16.09.2022 [MDLSAAS-39]: replaced lang-strings for the notification email (subjects + body-texts)
$string['mail_nearing_quota_subject'] = 'Moodle-Instanz nähert sich dem Limit der Speicherplatz-Auslastung';
$string['mail_nearing_quota_body'] =
'Verehrte Kundin, verehrter Kunde,
mit dieser E-Mail möchten wir Sie gerne darauf hinweisen, dass Ihre Moodle-Website bald ihr Datenkontingent ausgeschöpft haben wird.

Ihre Moodle-Website {$a->url} verbraucht derzeit {$a->used} GB des zugewiesenen {$a->quota} GB Speicherplatzes für Dateien.

Wenn Sie mehr Speicherplatz benötigen, können Sie uns gerne direkt über maas@liip.ch kontaktieren. 10 GB an zusätzlichem Speicherplatz kosten CHF 30,- pro Jahr.


Alternativ empfehlen wir Ihnen, Ihren Speicherplatz zu reduzieren, indem Sie ungenutzte Dateien oder nicht mehr benötigte Kurs-Backups löschen.


{$a->signature}
';

$string['mail_over_quota_subject'] = 'Wichtig: Moodle-Instanz hat das Limit der Speicherplatz-Auslastung überschritten';
$string['mail_over_quota_body'] =
'Verehrte Kundin, verehrter Kunde,
mit dieser E-Mail möchten wir Sie gerne darauf hinweisen, dass Ihre Moodle-Website das vorgesehene Datenkontingent bereits ausgeschöpft hat und damit das Limit der Speicherplatz-Auslastung überschritten ist.

Ihre Moodle-Website {$a->url} verbraucht derzeit {$a->used} GB des zugewiesenen {$a->quota} GB Speicherplatzes für Dateien.

Bitte kontaktieren Sie uns umgehend für ein Upgrade.
Um eine automatische Wartung Ihrer Moodle-Seite zu vermeiden, können Sie entweder mehr Speicherplatz bestellen oder den Speicherplatzverbrauch reduzieren, indem Sie beispielsweise ungenutzte Dateien oder nicht mehr benötigte Kurs-Backups löschen.

Wenn Sie mehr Speicherplatz benötigen, können Sie uns gerne direkt über maas@liip.ch kontaktieren. 10 GB an zusätzlichem Speicherplatz kosten CHF 30.- pro Jahr.


{$a->signature}
';

/***P.T. 16.09.2022 [MDLSAAS-39]: removed lang-strings for the following notification email:
$string['mail_site_blocked_subject'] = 'Important: Moodle site has been disabled due to excessive disk usage';
$string['mail_site_blocked_body'] =
*/

$string['mail_signature'] = 'Mit freundlichen Grüssen
Liip Elearning Team

Kontakt:
  Email: {$a->supportemail}
  Telefon: {$a->supporttelephone}';

$string['backup_filename'] = 'Dateiname';
$string['backup_course'] = 'Kurs';
$string['backup_timemodified'] = 'Zuletzt geändert';
$string['backup_size'] = 'Größe';
$string['backup_page_title'] = 'Details zur Sicherung';
