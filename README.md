 Diş hekimleri için yapılmış açık kaynak kodlu bir web sitesidir. Yapım süreci devam etmektedir. Yapım süreci bittiğinde https://gazidentist.site adresinden ulaşılabilir olacaktır.

  NOT:Üzerinde (ok) yazılanlar tamamlanmış demektir. Diğerleri ya yapım aşamasındadır ya da yapılacaktır.
  
  Yapılacaklar:   
 
      ->Sitenin içerisine kayıt olan her kişi için friends veri tabanına da bir takım veriler girilecek.(ok)
      
      ->Arkadaşlık isteği ayarlamalarına başlandı.(ok)
      
      ->Arkadaşlık isteği gönderiliyor artık isteğin görüntülenmesi(bildirimler kısmında) ve kabul edilmesi ile ilgili kısımlar kaldı.(ok)  
      
      ->Sonrasında ise mesaj odasında bu kişileri kendi odalarımıza ekleyebilmek ve takip ettiğimiz arkadaşların postlarını görüntüleyebilmek var diyebilirim(ok)  
      
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

      Projede php-memcache kullanılmaya başlanılmıştır. Bunun için memcache kurulumunu yapmalısınız.

      Toplam depolanacak mesajlaşma sayısını includes/consts.php içerisinden değiştirebilirsiniz.

      Profil resmi ve post resimlerinin maximum boyutlarını includes/consts.php içerisinden değiştirebilirsiniz.
Güncellemeler 15 Kasım 2021:
      Daha hızlı mesajlaşma olması için mesajları şifreleme kaldırıldı ve mesajlaşmalar ram üzerine alındı.
      Arkadaşları görüntüleyebileceğimiz subscribers/friends.php sayfası hazırlandı.
      Mesajlaşma sırasında daha fazla request yapılması sağlandı.
      info/aboutUs.php için giriş yapıldı ama devamı yazılacak.
      
Güncellemeler 2021 Kasım 18:
      Şifreleme daha optimize olacak şekilde geri getirildi.
      Mesajlaşma odalarına kişi eklemeye giriş yapıldı.
      
Güncellemeler 19 Kasım 2021:
      Kurduğumuz mesaj odalarına artık arakdaşımız olan kişileri görebiliyoruz.
      Arkadaşların paylaşımları kısmında arkadaş olduğumuz kişilerin paylaşımlarını görebiliyoruz.
      Bir post üzerinde gönderenin isminer bastığımız zaman kişinin profiline gidebiliyoruz.
      Herkesin ortak katılımına açık olan bir genel oda oluşturuldu.
      Yan barda resim bulunan kısım yuvarlak bir çerçeve içerisine alındı.
      Authorların kendi profillerini düzenlerken resim eklemelerine düzenleme getirildi.
      Post resmi eklemek istediğimizde artık maximum sınır 3MB ve yüklenebilecek dosya tipleri png jpg ve jpeg olarak düzenlendi

Güncellemeler 19 Kasım 2021 (release_version):
      Yan bardaki bir bug olan olan arkadaşlarımın paylaşımlarını göster dediğinde eğer arkadaşın yoksa hata veren kod düzeltildi.
      Mesajlaşma sistemine arkadaş ekle getirildi.
      Gönderilen mesajlarda 20 karakter maximum sınır konuldu.
      Kendi paylaşımlarımızı görmemiz için yan bara özellik eklendi.
      Adminlerin kişilern postlarını onayladıklarında kendileri yazmış gibi gösteren bug düzeltildi.
      Yorum sistemi çalışmıyordu onarıldı.
      Alt bardaki sosyal medya ikonlarına tıkladığımızda yeni sekmede açılması sağlandı. Hakkımızda kısmına sitenin açıklamasını yapan bir youtube videosu eklendi.
      Site kuralları kısmı siteyi fork eden Oztas-jpg tarafından eklendi(teşekkürler)
      Aynı kişiye  tekrar tekrar arkadaşlık isteği gönderilmesi engellendi
      Arkadaş olduğumuz bir kişiye tekrar arkadaşlık göndermemiz engellendi.

      Eksikler:
            Arkadaşlıktan çıkarmak
            Odadan çıkarmak
            Yan barı alt kısmı çok boş kalıyor
            


      
