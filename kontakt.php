<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




// --- PHP-Verarbeitungscode beginnt hier ---

// Konfigurationsdaten für die Datenbankverbindung
// BITTE PASSE DIESE WERTE UNBEDINGT AN DEINE DATENBANK AN!
$servername = "localhost";
$username = "db-user-1"; // Z.B. "root" oder der von deinem Hoster vergebene Name
$password = "iQcDIHMjlVnqauNDZ6gW";     // Das Passwort für den Datenbankbenutzer
$dbname = "db-1";           // Der Name deiner Datenbank, z.B. "kontaktformular"

// Initialisiere leere Variablen für die Statusnachricht und Formularfelder
$statusMessage = "";
$messageClass = ""; // Für CSS-Styling (z.B. "success" oder "error")

// Variablen, um Benutzereingaben zu speichern, damit sie bei Fehlern im Formular bleiben
$full_name = "";
$email = "";
$phone_number = "";
$subject = "";
$message_content = "";

// --- E-Mail Konfiguration (neu aus send_email.php) ---
$email_from_default = "noreply@stefanie-riewoldt.dev"; // Absender falls keiner angegeben wurde
$sendermail_antwort = true;                  // E-Mail Adresse des Besuchers als Absender. false=Nein; true=Ja
$name_von_emailfeld = "email";               // Name des Feldes in der die Absenderadresse steht (hier 'email' vom Formular)
$empfaenger = "s.riewoldt@yahoo.de";        // Empfänger-Adresse (Deine E-Mail)
$mail_cc = "";                               // CC-Adresse, diese E-Mail-Adresse bekommt eine weitere Kopie
$betreff_email = "Neue Kontaktanfrage (über Formular)"; // Betreff der E-Mail

// --- URLs für Weiterleitung nach E-Mail-Versand (werden hier nicht direkt genutzt, da alles in einer Datei ist) ---
// $url_ok = "http://www.domain.de/ok.php"; // War in send_email.php, hier nicht benötigt
// $url_fehler = "http://www.domain.de/fehler.php"; // War in send_email.php, hier nicht benötigt

// --- Felder, die nicht in der E-Mail stehen sollen (wenn du sie nicht in der Nachricht haben willst) ---
// In diesem Fall fügen wir alle Formularfelder manuell in die Nachricht ein,
// daher wird $ignore_fields hier nicht benötigt, oder nur wenn du bestimmte Werte verarbeiten, aber nicht mailen willst.
// $ignore_fields = array('submit');


// Überprüfen, ob das Formular per POST abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Verbindung zur MySQL-Datenbank herstellen
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verbindung prüfen
    if ($conn->connect_error) {
        $statusMessage = "Fehler: Verbindung zur Datenbank fehlgeschlagen. Bitte versuche es später noch einmal.";
        $messageClass = "error";
    } else {
        // 2. Formulardaten sicher abrufen und bereinigen
        $full_name = trim(htmlspecialchars($_POST['full_name'] ?? ''));
        $email = trim(htmlspecialchars($_POST['email'] ?? ''));
        $phone_number = trim(htmlspecialchars($_POST['phone_number'] ?? ''));
        $subject = trim(htmlspecialchars($_POST['subject'] ?? ''));
        $message_content = trim(htmlspecialchars($_POST['message_content'] ?? ''));

        // 3. Grundlegende serverseitige Validierung der Eingaben
        if (empty($full_name) || empty($email) || empty($message_content)) {
            $statusMessage = "Fehler: Bitte fülle alle Pflichtfelder (Vollständiger Name, E-Mail, Nachricht) aus.";
            $messageClass = "error";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $statusMessage = "Fehler: Bitte gib eine gültige E-Mail-Adresse ein.";
            $messageClass = "error";
        } else {
            // 4. Daten sicher in die Datenbank einfügen (Prepared Statements!)
            $stmt = $conn->prepare("INSERT INTO kontakt (full_name, email, phone_number, subject, message_content) VALUES (?, ?, ?, ?, ?)");

            if ($stmt === false) {
                $statusMessage = "Fehler: Datenbankabfrage konnte nicht vorbereitet werden. " . $conn->error;
                $messageClass = "error";
            } else {
                $stmt->bind_param("sssss", $full_name, $email, $phone_number, $subject, $message_content);

                if ($stmt->execute()) {
                    // --- DATENBANK SPEICHERUNG ERFOLGREICH! JETZT E-MAIL VERSENDEN ---

                    // Datum und Uhrzeit für die E-Mail
                    $name_tag = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
                    $num_tag = date("w");
                    $tag = $name_tag[$num_tag];
                    $jahr = date("Y");
                    $n = date("d");
                    $monat = date("m");
                    $time = date("H:i");

                    // Inhalt der E-Mail Nachricht
                    $msg_email = ":: Gesendet am $tag, den $n.$monat.$jahr - $time Uhr ::\n\n";
                    $msg_email .= "Vollständiger Name: " . $full_name . "\n";
                    $msg_email .= "E-Mail: " . $email . "\n";
                    if (!empty($phone_number)) { // Telefonnummer nur hinzufügen, wenn vorhanden
                        $msg_email .= "Telefonnummer: " . $phone_number . "\n";
                    }
                    if (!empty($subject)) { // Betreff nur hinzufügen, wenn vorhanden
                        $msg_email .= "Betreff: " . $subject . "\n";
                    }
                    $msg_email .= "Nachricht:\n" . $message_content . "\n\n";


                    // E-Mail Adresse des Besuchers als Absender
                    $absender_email = $email_from_default;
                    if ($sendermail_antwort && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $absender_email = $email; // Wenn Option aktiviert und E-Mail gültig, Besucheradresse als Absender
                    }

                    // E-Mail Header zusammenstellen
                    $header_email = "From: " . $absender_email; // Verwende den ermittelten Absender
                    if (!empty($mail_cc)) {
                        $header_email .= "\r\n"; // RFC-konformer Zeilenumbruch für E-Mail-Header
                        $header_email .= "Cc: " . $mail_cc;
                    }
                    $header_email .= "\r\nContent-type: text/plain; charset=utf-8"; // UTF-8 für Sonderzeichen

                    // E-Mail senden
                    $mail_senden = mail($empfaenger, $betreff_email, $msg_email, $header_email);

                    if ($mail_senden) {
                        $statusMessage = "Vielen Dank! Deine Nachricht wurde erfolgreich gesendet.";
                        $messageClass = "success";
                        // Felder nach erfolgreichem Senden leeren
                        $full_name = "";
                        $email = "";
                        $phone_number = "";
                        $subject = "";
                        $message_content = "";
                    } else {
                        // E-Mail-Versand fehlgeschlagen, aber DB-Speicherung war erfolgreich
                        $statusMessage = "Deine Nachricht wurde in der Datenbank gespeichert, aber der E-Mail-Versand ist fehlgeschlagen. Bitte versuche es später noch einmal oder kontaktiere mich direkt.";
                        $messageClass = "error";
                        // Formularfelder bleiben gefüllt, da nur E-Mail nicht ging
                    }

                    $stmt->close(); // Statement schließen nach DB-Operation
                } else {
                    // Fehler beim Ausführen des Statements (DB-Speicherung fehlgeschlagen)
                    $statusMessage = "Fehler beim Speichern deiner Nachricht in der Datenbank: " . $stmt->error;
                    $messageClass = "error";
                }
            }
        }
        $conn->close(); // Datenbankverbindung schließen
    }
}
// --- PHP-Verarbeitungscode endet hier ---
?>





<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Stefanie Riewoldt</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    

    <!--Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>


<body>

    

    <?php include('header.php'); ?>

    <main>
        <section class="contactme">
                <div class="contactbox">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <h2 class="heading">Kontakt</h2>

                        <?php if (!empty($statusMessage)): ?>
                            <div class="message <?php echo htmlspecialchars($messageClass); ?>">
                                <?php echo htmlspecialchars($statusMessage); ?>
                            </div>
                        <?php endif; ?>

                        <div class="fieldbox">
                            <input type="text" id="full_name" name="full_name" placeholder="Vollständiger Name" value="<?php echo htmlspecialchars($full_name); ?>" required>
                            <input type="email" id="email" name="email" placeholder="E-Mail" value="<?php echo htmlspecialchars($email); ?>" required>
                            <input type="text" id="phone_number" name="phone_number" placeholder="Telefonnummer" value="<?php echo htmlspecialchars($phone_number); ?>">
                            <input type="text" id="subject" name="subject" placeholder="Betreff" value="<?php echo htmlspecialchars($subject); ?>" required>
                            <textarea id="message_content" name="message_content" placeholder="Nachricht" required><?php echo htmlspecialchars($message_content); ?></textarea>
                        </div>

                        <button type="submit" class="buttons">Senden</button>

                    </form>
                </div>
        </section>
    </main>

    <script src="js/script.js"></script>

</body>


</html>