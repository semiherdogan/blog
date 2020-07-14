---
extends: _layouts.post
section: content
title: Php "Match Expression" kabul edildi
date: 2020-07-12
description: PHP RFC Match expression
featured: true
---

Php "Match Expression" kabul edildi.
8 versiyonu ile gelecek olan bu özellik sayesinde switch / case ile uzun uzun yazdığımız  kod bloğunu çok daha kısa bir hale getirerek daha kolay bir şekilde yazabileceğiz.

Şu an bu şekilde yazıyor olduğumuz kod bloğunu:
```php
switch (1) {
    case 0:
        $result = 'Foo';
        break;
    case 1:
        $result = 'Bar';
        break;
    case 2:
        $result = 'Baz';
        break;
}
 
echo $result;
//> Bar
```

Artık bu şekilde yazabileceğiz:

```php
echo match (1) {
    0 => 'Foo',
    1 => 'Bar',
    2 => 'Baz',
};
//> Bar
```

Match 'in Rust, F#, Scala gibi dillerdeki benzer implemantasyonlarını aşağıda görebilirsiniz.

```
// Rust
let binary = match boolean {
    false => 0,
    true => 1,
};

// Scala
val monthName = i match {
    case 1  => "January"
    case 2  => "February"
    case 3  => "March"
    ...
    case _  => "Invalid month"
}

// F#
let x = 
    match 1 with 
    | 1 -> "a"
    | 2 -> "b"  
    | _ -> "z" 
```

Aralık ayında çıkacak olan php8 versiyonunu heyecanla beklemekteyiz.

Rfc'yi incelemek için bu sayfayı ziyaret edebilirsiniz: [rfc/match_expression](https://wiki.php.net/rfc/match_expression_v2)
