   Diş hekimleri için yapılmış açık kaynak kodlu bir web sitesidir. Yapım süreci devam etmektedir. Yapım süreci bittiğinde https://gazidentist.site adresinden
 ulaşılabilir olacaktır.
 
 Üzerinde (ok) yazılanlar tamamlanmış demektir. Diğerleri ya yapım aşamasındadır ya da yapılacaktır.
 Yapılacaklar: 
        ->Sitenin içerisine kayıt olan her kişi için friends veri tabanına da bir takım veriler girilecek.(ok)
        ->Arkadaşlık isteği ayarlamalarına başlandı.(ok)
        ->Arkadaşlık isteği gönderiliyor artık isteğin görüntülenmesi(bildirimler kısmında) ve kabul edilmesi ile ilgili kısımlar kaldı.(ok)
        ->Sonrasında ise mesaj odasında bu kişileri kendi odalarımıza ekleyebilmek ve takip ettiğimiz arkadaşların postlarını görüntüleyebilmek var diyebilirim.
        ->Kişinin yazı yazma hakkını elinden alma yetkisi.
        ->Yayında olan bir yazıyı eğer admin yazmamışsa kaldırma yetkisi.
        ->Yazdıkları yazıları hiçbir suale tabi olmadan yayınlama yetkisi.(ok)
        ->Postlar ve içerikler için like sistemi getirilecek.
        ->Sitedeki mesajlaşmalar şifrelenerek saklanacak.(ok)
        ->Gizlilik sözleşmesi birazcık daha düzenlenecek. 
        ->Sitede çerezleri kabul ediyor musun etc... gibi şeyler için izin istenecek özellikle ilk login olduğunda.(ok)
        
    Projenin açıklanması:
      Proje içersinde mysql veri tabanı kullanılmaktadır. gazident_blog.sql kullanılarak veriabanı kolayca import edilebilir.
      İncludes/db.php içerisinde veritabanı bağlantısıyla ilgili bilgiler bulunmaktadır. Örnek username, password...
      Admin klasörü içerisinde admin kontrol panel ve author klasörünün içerisinde yazar kontrol paneli bulunmaktadır.
      Eğer php ve mariadb veya mysql veritabanını indirmişseniz projeyi php -t <PROJECT_PATH> -S localhost:<PORT_NUMBER> diyerek başlatabilirsiniz.
      
