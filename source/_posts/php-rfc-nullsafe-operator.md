---
extends: _layouts.post
section: content
title: Php Rfc Nullsafe operator
date: 2020-06-03
description: PHP RFC Nullsafe operator
featured: true
---

Bugün [Php Rfc](https://wiki.php.net/rfc) sayfasını yeni neler gelecek acaba? niyetiyle 
gezindiğim sırada rastladığım ve bir çok programlama dilinde var olan _Nullsafe operator_'un 
eklenmesi konusu ile karşılaştım.

_Nullsafe operator_ sayesinde bir değişkenin `null` olup olmadığını, o değişkeni kullanmadan önce 
kontrol etmemize gerek kalmayacak.

Örnek olarak aşağıdaki gibi yazmaya çalıştığımız ve her satırında ayrı bir `null` kontrolu olan kodu

```php
$country =  null;
 
if ($session !== null) {
    $user = $session->user;
 
    if ($user !== null) {
        $address = $user->getAddress();
 
        if ($address !== null) {
            $country = $address->country;
        }
    }
}
```

Nullsafe operator ile artık şöyle yazabileceğiz:

```php
$country = $session?->user?->getAddress()?->country;
```

Php 8 versiyonu için eklenme durumu henüz tartışma aşamasında olan bu özellik umuyorum ki kabul edilir.

Rfc'yi incelemek için bu sayfayı ziyaret edebilirsiniz: [rfc/nullsafe_operator](https://wiki.php.net/rfc/nullsafe_operator)
