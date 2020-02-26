

<?php 

	print_r(kelimeAra('http://kocaeli.edu.tr/,https://onedio.com/',"OKUL aydın Çanakkale Kocaeli FranSa İzMir,Antep ŞanlıUğrfa PArket")); /// 1. algoritma sonucu
   echo "<hr>";
  // 	print_r(kelimeRankAra('http://kocaeli.edu.tr/,https://onedio.com/,http://bilgisayar.kocaeli.edu.tr/,http://www.hurriyet.com.tr/',"KocaElİ İstanbul"));
	/*
,https://onedio.com/,http://bilgisayar.kocaeli.edu.tr/,http://www.hurriyet.com.tr/
	*/
	//dephUrl('http://kocaeli.edu.tr',"KocaeLi İstanbul"); //Deph ayarlıyoruz fakat çalışmada sıkıntı var 300*300 gibi bir url kontrolü sistemi bozuyor daha farklı bir araştırma yapılmalı
   echo "<hr>";

	//$sonuclar = esAnlamUrl('http://kocaeli.edu.tr,http://bilgisayar.kocaeli.edu.tr',"KocaeLi İstanbul Su aba");
	//print_r($sonuclar);
	//print_r(kelimeAra('http://kocaeli.edu.tr',"KocaeLi İstanbul"));
/*
Ahmet Mehmet Ali Ayşe
100     50    20  104 => 20

30    30    30   30 => 30

40  50     70    80 => 40

var a = 0.0
var b = 0.0
var c = 0.0
var e = 0.0
 
function pageRank(){
    
    var ranks:[Double] = []
    
    for i in 0...loop {
        
        let prA = (1-d) + d * (b/1 + c/2)
        let prB = (1-d) + d * (a/2)
        let prC = (1-d) + d * (a/2 + b/1)
        let prE = (1-d) + d * (c/2)
        
        b = prA
        a = prB + prC
        c = prA + prB
        e = prC
        
        if i == loop {
            ranks.append(prA)
            ranks.append(prB)
            ranks.append(prC)
            ranks.append(prE)
        }
        
    }
    
    return ranks
}
*/

?>
