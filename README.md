# SearchEngine

 
 <hr>
 
 <h3>Anahtar kelime saydırma</h3> 
 
 Projenin içeriği ve adımları aşağıda gösterilmiştir:
 Verilen bir anahtar kelimenin ve bir URL için:
 Anahtar kelimenin URL içeriğinde (URL'in gösterdiği sayfa içeriğinde) kaç defa yer
 aldığını bulur.
 
 ( Örnek anahtar kelime: “güvenlik" , örnek URL:https://www.btk.gov.tr/tr-TR/Sayfalar/SG-SIBER-GUVENLIK-KURULU)

 <hr>

 <h3>Sayfa (URL) Sıralama</h3>
 
 Verilen bir anahtar kelime kümesi ve bir URL kümesi için,
 - Anahtar kelimelerin içeriklerde yer alma sayısına dayalı bir skor formülü tanımlandı.
 Örneğin, direkt kelimelerin URL'de geçme sayısını toplayarak bir skorlama yapalım. Bu durumda 1. kelimenin 100 defa, 2. ve 3. Kelimenin 3'er defa geçtiği bir URL, her bir kelimenin 10'ar defa geçtiği bir URL'den daha fazla skor alacaktır.Yani, bu skorlama formülü iyi sonuçlar vermeyecektir.

 - URL'ler skoruna göre sıralanır.
 - Her bir URL için (bir web sayfası), sıralamasını, puanını ve her bir anahtar kelimenin kaç kez yer aldığının sayımını gösterir.

 Örnek anahtar kelime kümesi: “ulusal, siber, güvenlik", örnek URL kümesi:
 https://www.btk.gov.tr/tr-TR/Sayfalar/SG-SIBER-GUVENLIK-KURULU,
 http://www.udhb.gov.tr/h-12-siber-guvenlik.html,
 http://sibertehdit.com/ulusal-siber-guvenlik-stratejisi-ve-eylem-plani/

 
 <hr>
 
 <h3>Site Sıralama</h3>
 
 Verilen bir web sitesi kümesi ve bir anahtar kelime kümesi için,

 - URL'de ve tüm alt URL'lerinde anahtar kelime yer alma sayılarına dayalı bir skor
 formülü tanımlandı (derinlik 3, ana sayfa=1, ana sayfadan linklenmiş bir sayfa:2, ana
 sayfadan linklenmiş bir sayfadan linklenmiş bir sayfa:3).

 -	Web sitelerini anahtar kelimelerin yer alma sayılarına göre sıralanıyor (tüm alt URL'leri dahil)
 -	Her URL için (bir web sitesi), sırasını, skorunu, alt URL'lerin ağaç yapısını ve her düğümdeki her bir anahtar kelimenin yer alma sayısı ile birlikte ekrana yazdırır.
 
( Örnek anahtar kelime kümesi: “ulusal, siber, güvenlik" , örnek web sitesi kümesi: https://www.btk.gov.tr/, http://www.udhb.gov.tr/, http://sibertehdit.com/)

 
 <hr>
 
 <h3>Semantik Analiz</h3>
 
 - Verilen web siteleri içerisinde anahtar kelimelerle semantik olarak alakalı kelimeler olabilir. Örneğin, “ulusal" yerine “milli" kelimesi yer alabilir. Bu kelimelere “alakalı anahtar kelimeler" diyelim.
 
 - Alakalı anahtar kelimeleri bulur ve yazdırır.
 
 - Yinelemeli olarak 3. aşamadaki analizi yapar.
 
 `esanlamli.xlsx` dosyası 14226 kelimenin eş anlamlılarını içermektedir.Semantik analiz için bu dosya `kelimeEkle.php` içerisinde görüldüğü gibi veritabanına kaydedilerek aramalarda kullanılması sağlanır.
 
 <hr>
 
 
