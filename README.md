# README #

 VOTER - Szavazó alkalmazás   

LEGFONTOSABB FUNKCIÓK:

A) Szavazás készítése
- egy kérdés,
- tetszőleges számú válasz,
- időzített indítás és lezárás (cron),
- egy időben több szavazás párhuzamás futtatása,
- szavazásonként tetszőleges admin e-mail cím hozzáadása automatikus értesítések igénylése esetén (választható opció).

B) Név szerinti szavazatok leadása
- Szavazók szerveroldali szűrése név és IP cím szerint a többszöri szavazás megakadályozása céljából,
- SPAM robotok elleni védelem (egyéni CAPTCHA).

C) Szavazások kezelése
- időzített indítás és lezárás (cron),
- kézi indítás és lezárás,
- módosítás,
- archiválás,
- törlés,
- szavazatok összesítésének megtekintése,
- admin részére automatikus összesített e-mail értesítés küldése az adott szavazás(ok) indításáról vagy lezárásról és az utóbbi(ak) esetén az összesített eredményekről (cron, választható opció).

ALKALMAZOTT TECHNOLÓGIÁK:

A) Frontend:

- HTML, CSS, JavaScript, Bootstrap, JQuery

B) Backend:

- natív PHP (OOP, MVC)
- MySQL