---
extends: _layouts.post
section: content
title: Yazılımcılar için scratchpad "Boop"
date: 2020-07-16
description: Yazılımcılar için scratchpad, boop.
featured: true
cover_image: /assets/img/content/boop.png
---

Geçenlerde GitHub'da gezinirken denk geldiğim ve sonrasında **text işlemleri** için günlük olarak kullanmaya başladığım bir uygulamayı anlatacağım.

Not: Bu uygulama sadece macOS üzerinde çalışmaktadır.

### Boop nedir?

Boop günlük text işlemlerini (json formatlama, base64 encode/decode vs.) yapabilmek için elinizin altında bulundurabileceğiniz basit ama bir o kadar da güçlü bir text tool'dur. (Code editor değildir!)

### Boop ile neler yapılabilir?

Boop'un güncel sürümü ile aşağıdaki işlemler yapılabiliyor:

```
AddSlashes
Base64Decode
Base64Encode
CSVtoJSON
CountCharacters
CountLines
DateToTimestamp
DateToUTC
Downcase
FormatJSON
FormatXML
HTMLDecode
HTMLEncode
JSONtoCSV
JWTDecode
JsonToQuery
MD5
MarkdownQuote
QueryToJson
RemoveDuplicates
RemoveSlashes
ReverseLines
ReverseString
ShuffleLines
URLDecode
URLEncode
Upcase
```

Bunların yanı sıra "_custom_" olarak script yazıp dahil edebilmek de mümkün. Özellikle bu custom script konusu benim için Boop'u kullanılabilir kıldı. (Custom script için **javascript** dili kullanılıyor.)

### Neden başka bir araç?

Bu işlemler için eskiden [Red](https://www.red-lang.org/) dilini kullanarak, repl üzerinde daha önceden yazdığım script'leri çalıştırarak, text işlerini rahat bir şekilde yapabiliyordum.

Örnek olarak dublicate satır sayılarını aldığım script:
```red
frequency: function [
    "Returns count of dublicated values in block"
    data [block!]
][
    result: copy #()

    foreach value data [
        result/:value: either result/:value [result/:value + 1][1]
    ]

    result
]
```

Kullanımı şöyle:

```red
frequency [12 22 22 "selam" "dünyalı"]
// > 12 1
     22 2
     "selam" 1
     "dünyalı" 1
```

Fakat **red**'in 32 bit olması ve macOS'un yeni versiyonlarında sadece 64 bit uygulama çalıştırması beni bu işlemleri yapabilecek yeni bir tool arayışına soktu. (Bir süre Docker ile çalıştırdım, fakat yavaş çalıştığından dolayı ondan da vazgeçtim.)

Bir dönem de **Ruby** yi denedim. (user.rb dosyasını repl'a yükleyerek çalıştırıyordum.)

Örnek olarak en çok kullandığım 3 method:
```ruby
def read_clipboard
    return `pbpaste`.strip
end

def write_clipboard(arg)
    IO.popen('pbcopy', 'w') { |io| io.puts arg }
end

def parse_clipboard
    return read_clipboard.split("\n").reject { |c|c.empty? }
end
```

Tabi Ruby yerine elimdeki işi genelde Python ile çözmeye çalıştığım söylentileri doğrudur. :)

Python'da random string generate etmek için kullandığım script:
```python
import string
import random
import pyperclip as clip

def randomGenerator(size=6):
    allowed_chars=string.ascii_letters + string.digits + '!#*-+'
    return ''.join(random.choice(allowed_chars) for _ in range(size))

def askInput():
    global size
    size = input('Length(10): ')
    if size is '':
        size = 10
    
    try:
        size = int(size)
    except:
        size = False

size=0
askInput()

p = randomGenerator(size)
clip.copy(p)
print(p)
```

### Peki Boop nasıl kullanılıyor?

Boop'u açtıktan sonra, text yazabildiğiniz bir ekran karşılıyor sizi, bu ekrana textinizi ekledikten sonra `CMD + b` yaparak veya menüden `Scripts > Open Picker` tıklayarak işlem seçme ekranını açıyoruz, yapmak istediğimiz işlemi seçtiğimizde boop bizim için ilgili script'i çalıştırıp sonucunu ekrana getiriyor.

### Neden kullanmalıyım?

Boop'un kendi sitesindeki sloganı bunu gayet güzel anlatıyor aslında "_Stop pasting company secrets into random websites!_".

"Şirket sırlarını rastgele sitelere yapıştırmayı bırakın!"
Örneğin api'den gelen bir json'ı formatlamak için, jwt, base64 decode için bu datayı alıp Google'da json beautifier aratıp bulup orada formatlama işlemini yapıyoruz. Boop içerisinde bunların hepsini yapabilirsiniz. Bu sayede rastgele websitelerine elinizdeki datayı vermeyi bırakabilirsiniz.

### Custom script nasıl eklenir?

Öncelikle dosyanızın en üstünde açıklama satırları içerisinde script'in ad, ikon gibi özellikleri json formatında tanımlamanız gerekiyor.
Örnek olarak:
```javascript
/**
    {
        "api":1,
        "name":"My new script",
        "description":"Just a test script for my blog post",
        "author":"Semih",
        "icon":"collapse",
        "tags":"script, test"
    }
**/
```

Sonrasında main fonkisoyunu oluşturmaniz gerekiyor ve `main` fonksiyonu sayesinde ekranınıza yazığınız yazılar üzerinde istediğiniz değişikliği yapabiliyorsunuz. `main` fonksiyonu 1 parametre alıyor. Örnek olarak bu parametre adına `state` diyelim.
`state` objesinin 3 property'si var.

* fullText

`state.fullText` ekrana yapıştırmış olduğunuz tüm text'i verir.

* selection

`state.selection` text içerisinde seçmiş olduğunuz alanı verir ve yapacağınız text işlemleri sadece bu alana yansır.

* text

`state.text` benim favorim. Property seçili alan varsa onu döner, yoksa `fullText` olarak çalışır.

**Mesaj olarak iki farklı seçenek mevcut:**

 * Info

    `state.postInfo` fonksiyonu ile arkaplanı mavi olan bir mesaj verebilirsiniz.
 
 * Error

    `state.postError` fonksiyonu ile arkaplanı kırmızı olan bir mesaj verebilirsiniz.

Örnek olarak:
```javascript
function main(state) {
  state.fullText = state.fullText + '\n' + randomString(10);

  state.postInfo('Random string generated');
}

function randomString(length) {
  const Characters       = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz123456789';
  const CharactersLength = characters.length;

  let result = '';

  for (let i = 0; i < length; i++) {
    result += Characters.charAt(Math.floor(Math.random() * CharactersLength));
  }

  return result;
}
```

Custom script'in son haline [buradan](https://gist.github.com/semiherdogan/89f77553f4c57c84c4f0aa15b32bbe73) ulaşabilirsiniz.

Bu script'i oluşturup kaydettikten sonra, Boop'da **Preferences**' e girerek *custom script klasörü*nü dosyanızın bulunduğu klasör olarak seçmeniz gerekiyor.

Script'inizde herhangi bir değişiklik yaptığınızda menüden `Scripts > Reload Scripts` 'e tıklamanız gerekiyor.

### Son Söz

Bu uygulama ile ilgili daha ayrıntılı bilgiye [github](https://github.com/IvanMathy/Boop) sayfasından ulaşabilir, takıldığınız ya da eklemek istediğiniz bir şey olursa da aşağıya yorum olarak yazabilirsiniz.


### İlgili linkler

[Boop Github Repo](https://github.com/IvanMathy/Boop)

[Github Döküman](https://github.com/IvanMathy/Boop/blob/main/Boop/Documentation/Readme.md)

[Uygulama Websitesi](https://boop.okat.best/)

[App Store](https://apps.apple.com/us/app/boop/id1518425043)
