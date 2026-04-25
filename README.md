# Boğaziçi Teması

Boğaziçi'nin Tarih Atlası kitabı için hazırlanmış uydu site teması.  
**[bogazi.ci](https://bogazi.ci)** sitesinde kullanılır.

## Hakkında

Bu tema, Sedat Bornovalı'nın dijital ekosisteminin bir parçasıdır:

- **Hub Site:** [sedat.bornova.li](https://www.sedat.bornova.li/) — Yazarın ana sitesi
- **Bu Uydu Site:** [bogazi.ci](https://bogazi.ci) — Boğaziçi kitabına özel
- **Diğer Uydular:** ayasofya.org.tr, hagia.sophia.istanbul, beyog.lu

## Tasarım Felsefesi

Hub sitedeki `sedat-tema` ile aynı görsel dili paylaşır:

- **Renk paleti:** Lacivert (#003366), altın (#d1ad60), mermer krem (#f5f1e8)
- **Tipografi:** Cardo (başlık) + Lato (gövde)
- **Bileşen mantığı:** Aynı CSS değişkenleri, aynı buton stilleri, aynı tonlar

Farkı: Bu tema **tek bir kitap** odaklıdır. Hub portfolyo iken, uydu vitrindir.

## Teknik Özellikler

- 3 dilli yapıya hazır (TR / EN / IT)
- Polylang ve WPML destekli
- Custom Post Type: `medya` (basın haberleri için)
- Hub'a dönüş şeridi (üstte) ve butonu (altta)
- Akordeon ana sayfa (4 panel)
- Mobil uyumlu (responsive)
- Hiçbir sayfa oluşturucu (Elementor vb.) gerektirmez
- Saf PHP/CSS/JS ile yazılmış

## Dosya Yapısı

```
bogazi-ci/
├── style.css           # Tüm stiller + tema metadata
├── functions.php       # Tema fonksiyonları
├── header.php          # Sayfa başlığı + yazar şeridi
├── footer.php          # Sayfa altlığı + hub butonu
├── front-page.php      # Ana sayfa (akordeon)
├── index.php           # Yedek şablon
├── theme.js            # Hafif JavaScript
└── README.md           # Bu dosya
```

## Kurulum

Bu tema **WP Pusher** üzerinden otomatik olarak deploy edilir.  
Manuel kurulum için:

1. Tüm dosyaları `wp-content/themes/bogazi-ci/` klasörüne yükleyin
2. WordPress admin → Görünüm → Temalar → "Boğaziçi Teması" → Etkinleştir

## Sürüm Notları

### 1.0.0 — İlk sürüm
- Akordeon ana sayfa (4 panel)
- Çoklu dil altyapısı
- Hub return strip
- Medya CPT
- Temel tipografi ve renk sistemi

## Geliştirme Notları

İleride eklenecekler:
- `page-kitap.php` — Kitap detay sayfası (3 dilin tüm baskıları)
- `single-medya.php` — Tek medya yazısı
- `archive-medya.php` — Medya arşivi
- `home.php` — Blog listesi
- `single.php` — Tek blog yazısı
- Hero bölümü
- Mobil menü düğmesi
- SEO/Schema.org meta etiketleri
