<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


ini_set('max_execution_time', 600);
ini_set('memory_limit', '1024M');
$date = date("Y_m_d_H_i_s");

require '../../Config/database.php';
$d=new DATABASE_CONFIG();
$base = $d->default['database'];
$user = $d->default['login'];
$pass = $d->default['password'];
$nom_project = $_GET["nom"];


$nom_file = "$nom_project"."_"."$date.zip";
$mail = "f.taouaf25@gmail.com";
$from = "backup@icoz.ma";


get_data_base($base, $user, $pass);

zipData('../../', $nom_file);

send_mail($from, $mail, "$nom_project _ $date", $nom_file,$nom_project);

unlink('dump.sql');
echo 'Error , sending mail';


function zipData($source, $destination) {
    if (extension_loaded('zip')) {
        if (file_exists($source)) {
            $zip = new ZipArchive();
            if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                $source = realpath($source);
                if (is_dir($source)) {
                    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
                    foreach ($files as $file) {
                        if (strpos($file, 'Controller') === false &&
                                strpos($file, 'View') === false && strpos($file, 'Model') === false)
                            continue;

                        $file = realpath($file);
                        if (is_dir($file)) {
                            $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                        } else if (is_file($file)) {
                            $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                        }
                    }
                } else if (is_file($source)) {
                    $zip->addFromString(basename($source), file_get_contents($source));
                }
            }
            $source = 'dump.sql';
            if (is_file($source))
                $zip->addFromString("base.sql", file_get_contents($source));
            $zip->close();
        }
    }
    return false;
}

function get_data_base($base, $user, $pass) {
    include_once('Mysqldump.php');
    $dump = new Ifsnop\Mysqldump\Mysqldump("mysql:host=127.0.0.1;dbname=$base",$user, $pass);
    $dump->start('dump.sql');
}

function send_mail($from, $to, $subject, $gzfile,$nom_project) {
    $random_hash = md5(date('r', time()));
    $content = file_get_contents($gzfile);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    //$mailto="godsneek@hotmail.com";
    // header
    $header = "From: Backup $nom_project <$from>\r\n";
    $header .= "Reply-To: $to\r\n";
    $header .= "MIME-Version: 1.0\r\n"; 
    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";

    // message & attachment
    $nmessage = "--" . $uid . "\r\n";
    $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $nmessage .= "$subject\r\n\r\n";
    $nmessage .= "--" . $uid . "\r\n";
    $nmessage .= "Content-Type: application/octet-stream; name=\"$gzfile\"\r\n";
    $nmessage .= "Content-Transfer-Encoding: base64\r\n";
    $nmessage .= "Content-Disposition: attachment; filename=\"$gzfile\"\r\n\r\n";
    $nmessage .= $content . "\r\n\r\n";
    $nmessage .= "--" . $uid . "--";
    mail($to, $subject, $nmessage, $header);
    
}


function sendtobuckup($gzfile)
{	
	$newDirectoryName = date("Y_m_d");
	
	$apiUrl = 'https://wirezo.ma/get.php';
	
	$gzfile=str_replace(" ","_",$gzfile);
	
	$lien=explode("?nom=",$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$lien = rtrim($lien[0], '/');
	$lien="http://$lien/$gzfile";
	

	$data = array('lien' => $lien,"dossier"=>$newDirectoryName);

	// Initialise cURL
	$ch = curl_init();

	// Configure cURL pour l'envoi POST
	curl_setopt($ch, CURLOPT_URL, $apiUrl);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Exécute la requête cURL et récupère la réponse
	$response = curl_exec($ch);

	// Vérifie s'il y a des erreurs
	if(curl_errno($ch)){
		echo 'Erreur cURL : ' . curl_error($ch);
	}

	// Ferme la session cURL
	curl_close($ch);

	// Affiche la réponse de l'API
	echo "Réponse de l'API : " . $response;

}

sendtobuckup($nom_file);

?>