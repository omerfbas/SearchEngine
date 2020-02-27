<?php 

set_time_limit(0);
	function kelimeRankAra($url,$kelime){
			$aramaSonuclari  = kelimeAra($url,$kelime);
		//	print_r($aramaSonuclari);
			$urlListesi = array();
			$temp = null;
			$prRank = 0;
			$esitRank 	= array();
			$listRank 	= array();
			$urlList 	= array();
			$prKelimeFrekans = array();
			foreach ($aramaSonuclari as $key => $value) {
				$temp = null;
				foreach ($value["kelime"] as $key1 => $value1) {
					if($temp == null && $value["frekans"][$key1]!=0){
						$temp = $value["frekans"][$key1];
					}else if($temp>$value["frekans"][$key1] && $value["frekans"][$key1]!=0){
						$temp = $value["frekans"][$key1];
					}
				}
				$urlList[] = $value["url"];
				$prKelimeFrekans[] =$temp;
			}

		$urlListEslesmeSayisi = array();
		foreach ($aramaSonuclari as $key => $value) {
			$eslesmeSayisi = 0;
			foreach ($value["frekans"] as $key1 => $value1) {
				if($value1>0){
					$eslesmeSayisi++;
				}
			}
			$urlListEslesmeSayisi[] = $eslesmeSayisi;
		}

		arsort($urlListEslesmeSayisi); // daha fazla eşleşen url bulup burada büyükten küçüğe doğru sıraladık
		arsort($prKelimeFrekans); // daha fazla eşleşen kelimeleri bulup burada büyükten küçüğe doğru sıraladık

		$uniqList = array_unique($urlListEslesmeSayisi);
		$yeniList = array();
		$temp = null;
		foreach ($uniqList as $key => $value) { // 2 - 1
			foreach ($urlListEslesmeSayisi as $key1 => $value1) {
				if($value == $value1){
					if(!isset($yeniList[$value]))
						$yeniList[$value] = array(); 
						$yeniList[$value][$key1] = $prKelimeFrekans[$key1];
				}
			}
		}


/* buradan son dönüşü alabilirsin */
$sonListe = array();
		foreach ($yeniList as $key => $value) {
			//print_r($value);
			//echo "<hr>";
			arsort($value);
			//print_r($value);
			//echo "<hr>";
			foreach ($value as $key1 => $value1) {
				 $sonListe[] = $urlList[$key1];
			}
		}
		return $sonListe;
	}
function esAnlamUrl($url,$kelime){
	require_once "db_connect.php";
	$kelimeArr = urlWordsSplice($url,$kelime);
	foreach ($kelimeArr["txt"] as $key => $value) {
		$esanlamKontrol = $db->query("SELECT * FROM kelimeler WHERE kelime1='".$value."'")->fetchAll();
			foreach ($esanlamKontrol as $key1 => $value1) {
				$kelime .= ",".$value1["kelime2"];
			}
			$esanlamKontrol = $db->query("SELECT * FROM kelimeler WHERE kelime2='".$value."'")->fetchAll();
			foreach ($esanlamKontrol as $key2 => $value2) {
				$kelime .= ",".$value2["kelime1"];
			}
	}
	return kelimeRankAra($url,$kelime);
}
	function kelimeAra($url,$kelime){
		$parcaliHali = urlWordsSplice($url,$kelime);
		print_r($parcaliHali);
		echo "<hr>";
		$rankList = array();
		foreach ($parcaliHali["url"] as $key => $value) {
		$rankList[$key] = array("url"=>$value,"kelime"=>array(),"frekans"=>array());

			$pageData = strip_tags(urlOku($value));
			foreach ($parcaliHali["txt"] as $key1 => $value1) {
				if(strlen($value1) > 1){ // 1 karakterden büyükse eğer kelime oluyor bunu yapmamızdaki sebeb kelime Özel karakter boşluk olduğu zaman iki tane boşluk olmasına neden oluyor bunu önlemek için böyle bir yol tercih ettik
					preg_match_all("#".$value1."\b#",$pageData,$kelimeler);
					//echo "<br><br>".$value1." -> Kelimesi İçin toplam = > "; // kelime
					if(count($kelimeler[0])>0){ // Kelimenin Frekansı
						$rankList[$key]["kelime"][] = $value1;
						$rankList[$key]["frekans"][] = count($kelimeler[0]);
					}
					//print_r($kelimeler); /// Burada düzenleme yapılabilir. count ile kelimenin frekansı  rahatlıkla bulunur
				}
			}
		}
		return $rankList;
	}
	function urlWordsSplice($url,$words){
		$kelime = trKarakterReplace($words); 
		$txt = preg_replace("@[^A-Za-zÇŞĞÜÖİçşğüöı0-9\-_\.\+]@mis", '-', trim($kelime)); // kelime kelime ayırmak için aradaki boşluk özel karakter vs temizliyoruz
		$txt = explode("-",trim($txt));
		$txt = array_unique($txt); // Aynı değerleri temizliyoruz	
		$url = explode(",", $url);
		$url = array_unique($url); // Aynı değerleri temizliyoruz	
		array_filter($txt); // sıfır boş ve false degerler silindi
		array_filter($url);
		return array("url"=>$url,"txt"=>$txt);
	}
	function trKarakterReplace($txt){
		$find 	 = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö','I');
		$replace = array('ç', 'ş', 'ğ', 'ü', 'i', 'ö',"ı");
		$txt 	 = mb_strtolower(str_replace($find, $replace, $txt),"UTF-8"); // Türkçe karakter ve tüm karakterleri küçük hale çeviriyoruz
		$txt 	 = trim($txt);

		return $txt;
	}

function dephUrl($url,$kelime,$deph=3){
		$varUriList = recursiveUrl($url); // Birinci Derinlik
		for($i=1;$i<$deph;$i++){ // Max derinliğe kadar devam edecek
			foreach ($varUriList as $key => $value) {
				$dephUri = recursiveUrl($url);
				foreach ($dephUri as $key => $value) {
					if(!in_array($value, $varUriList)){
						$varUriList[] = $value; // url listeye ekleniyor
					}
				}
			}
		}
		//print_r($sonuc);
}

function recursiveUrl($url,$listUri=array()){

		$html = urlOku($url);
		preg_match_all("#<a(.*?)</a>#mis", $html, $sonuc);
		$sonuc = preg_replace('#"#is', "'", $sonuc[1]); // Çift tırnakları tek tırnak yapıyoruz
		$lastListArr = array();
		foreach ($sonuc as $key => $value) {
			preg_match("#href='(.*?)'#mis", $value, $ic);
			if($ic[1]=="#" || $ic[1] == "javascript:;"){
				continue;
			}
			if(preg_match("/\bhttp\b/i", $ic[1]) || preg_match("/\bhttps\b/i", $ic[1])){ /// Link dogrudan url ise
	   			$lastListArr[] = $ic[1];
	   		}else{ // Link url degilse yani /test.php gibi
				if(substr($ic[1], -1) == "/" || substr($ic[1],0,1) == "/"){ // URL sonunda veya yeni url başında bir dizin simgesi yok ise ekliyoruz
	   				$lastListArr[] = $url.$ic[1];
				}else{
	   				$lastListArr[] = $url."/".$ic[1];
				}
	   		}
		}
			$links = array_unique($lastListArr); // URL leri uniq yaptık
			return $links;
}

	function urlOku($url){
		$ct = curl_init();
   		$user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6';
   		$options = array(CURLOPT_URL => $url,
		                 CURLOPT_HEADER => false,
		                 CURLOPT_RETURNTRANSFER => 1,
		                 CURLOPT_USERAGENT => $user_agent,
		                 CURLOPT_FOLLOWLOCATION => true,
		                 CURLOPT_RETURNTRANSFER => true,
		            );
   		if(preg_match("/\bhttps\b/i", $url)){
   			$options[CURLOPT_SSL_VERIFYPEER] = 0;
   		}
		curl_setopt_array($ct, $options);
		$contentURL = curl_exec($ct);
		curl_close($ct);
		preg_match("#</head>(.*)</body>#mis", $contentURL,$newcontent);
		$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $newcontent[1]);
		$html = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $html);
		$html = trKarakterReplace($html);
		return $html;
	}

?>