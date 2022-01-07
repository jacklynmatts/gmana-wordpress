<?php the_content(); ?>

<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.dropboxapi.com/2/files/list_folder");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CAINFO, "cacert.pem");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"path":"/gmasc minutes/website files","recursive":true}');
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Authorization: Bearer ***REMOVED***";
$headers[] = "Content-Type: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$json = json_decode($result, true);	

foreach ($json['entries'] as $data) {
    if($data['.tag'] == 'file' && $data['is_downloadable'] == 1){
	    $patharray = explode("/", $data['path_lower']);
	    $files[$patharray[3]][] = [
		    'name' => $data['name'],
		    'path' => $data['path_lower']
	    ];
    }
}

$folders = ['area forms','service literature','policy documents'];
foreach($folders as $folder){
	echo "<h3>".ucwords($folder)."</h3>";
	foreach ($files[$folder] as $file){
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, "https://api.dropboxapi.com/2/files/get_temporary_link");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CAINFO, "cacert.pem");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{"path":"'.$file['path'].'"}');
		curl_setopt($ch, CURLOPT_POST, 1);
		
		$headers = array();
		$headers[] = "Authorization: Bearer ***REMOVED***";
		$headers[] = "Content-Type: application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		$json = json_decode($result, true);
		
		
		echo "<p><a href='{$json['link']}' target=_blank>{$file['name']}</a></p>";
	}
}
?>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
