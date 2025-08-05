<?php
$file = 'files/lebenslauf-s.riewoldt.pdf';

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: applications/pdf');
    header('Content-Disposition: attachment; filename="lebenslauf-s.riewoldt.pdf"');
    header('Content-Lenght: ' . filesize($file));
    readfile($file);
    exit;
}

else {
    echo "Datei nicht gefunden.";
}
?>