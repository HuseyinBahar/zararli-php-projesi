# XSS Zafiyeti Örneği - Mesaj Panosu Uygulaması

Bu proje, bir web uygulama güvenliği ödevinin parçası olarak XSS (Cross-Site Scripting) zafiyetini göstermek için hazırlanmıştır.

## Zafiyet Açıklaması

Bu uygulamada, kullanıcıların mesaj bırakabileceği basit bir mesaj panosu bulunmaktadır. Zafiyetli versiyonda, kullanıcı girdileri herhangi bir filtreleme yapılmadan doğrudan HTML içine yerleştirilmekte ve bu da XSS saldırılarına olanak tanımaktadır.

## Zafiyet Bilgileri

- **OWASP Kategorisi**: [A7:2021 - Cross-Site Scripting (XSS)](https://owasp.org/Top10/A07_2021-Cross-Site_Scripting/)
- **CVSS Skoru**: 6.1 (Orta)
- **CVSS Vector String**: CVSS:3.1/AV:N/AC:L/PR:N/UI:R/S:C/C:L/I:L/A:N

