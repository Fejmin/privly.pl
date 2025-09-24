<?php
  $meta = [
    'title'       => 'Polityka prywatności – Privly.pl',
    'description' => 'Polityka prywatności Privly.pl – dowiedz się, jak chronimy Twoje dane i jak działają nasze bezpieczne notatki jednorazowe.',
    'keywords'    => 'bezpieczne notatki, jednorazowe wiadomości, prywatne linki, szyfrowanie, notatki online, privly',
    'canonical'   => 'https://privly.pl/privacy-policy',
    'og:image'    => 'https://privly.pl/assets/img/privly.svg'
  ];
  require __DIR__ . '/partials/header.php';
?>
  <!-- MAIN -->
  <main class="max-w-4xl mx-auto px-4 pt-28 pb-16 leading-relaxed space-y-8">

    <section class="text-center">
      <h1 class="text-3xl md:text-4xl font-bold text-indigo-700 mb-2">
        Polityka prywatności i cookies
      </h1>
      <p class="text-gray-600">
        Data ostatniej aktualizacji: <strong>21 września 2025</strong>
      </p>
    </section>

    <!-- 1 -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="user" class="w-7 h-7 text-[#fd6927]"></i>
        <h2 class="text-2xl font-semibold text-indigo-700">1. Administrator danych</h2>
      </div>
      <p>
        Administratorem danych osobowych jest właściciel serwisu <strong>Privly.pl</strong>,
        e-mail: <a href="mailto:kontakt@privly.pl" class="text-indigo-600 hover:underline">kontakt@privly.pl</a>.
        Dane przetwarzane są zgodnie z Rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679
        (<strong>RODO</strong>) oraz ustawą o ochronie danych osobowych.
      </p>
    </section>

    <!-- 1a -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ml-6">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="server" class="w-6 h-6 text-[#fd6927]"></i>
        <h3 class="text-xl font-semibold text-indigo-700">1a. Podstawa prawna przetwarzania logów serwera</h3>
      </div>
      <p>
        Logi serwera (np. adres IP, znacznik czasu, dane przeglądarki) są przetwarzane na podstawie
        art. 6 ust. 1 lit. f RODO w celu zapewnienia bezpieczeństwa, zapobiegania nadużyciom,
        diagnostyki błędów i utrzymania ciągłości działania serwisu.
      </p>
    </section>

    <!-- 2 -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="info" class="w-7 h-7 text-[#fd6927]"></i>
        <h2 class="text-2xl font-semibold text-indigo-700">2. Informacje ogólne</h2>
      </div>
      <p>
        <strong>Privly.pl</strong> umożliwia tworzenie jednorazowych, szyfrowanych notatek,
        które automatycznie usuwają się:
      </p>
      <ul class="list-disc list-inside mt-2 space-y-1">
        <li>po pierwszym otwarciu,</li>
        <li>po upływie ustalonego czasu ważności,</li>
        <li>po osiągnięciu określonej liczby wyświetleń.</li>
      </ul>
      <p class="mt-2">
        Serwis nie wymaga rejestracji kont ani logowania i nie gromadzi danych osobowych w celu tworzenia profili.
      </p>
    </section>

    <!-- 3 -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="lock" class="w-7 h-7 text-[#fd6927]"></i>
        <h2 class="text-2xl font-semibold text-indigo-700">3. Przetwarzanie danych</h2>
      </div>
      <p>
        Treści notatek są <strong>szyfrowane end-to-end (E2EE) po stronie klienta</strong> 
        i <strong>trwale usuwane</strong> po spełnieniu warunków (otwarcie, czas, liczba wyświetleń).
        Wprowadzenie danych w treści notatki jest dobrowolne i w pełni zależy od użytkownika.
      </p>
    </section>

    <!-- 3a -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ml-6">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="shield-check" class="w-6 h-6 text-[#fd6927]"></i>
        <h3 class="text-xl font-semibold text-indigo-700">3a. Szyfrowanie end-to-end (E2EE)</h3>
      </div>
      <p>
        Notatki tworzone w serwisie <strong>Privly.pl</strong> są zabezpieczane mechanizmem 
        <strong>end-to-end encryption (E2EE)</strong>, co oznacza, że ich zawartość jest szyfrowana 
        bezpośrednio w przeglądarce użytkownika przy użyciu algorytmu <strong>AES-256-GCM</strong>. 
        Serwer otrzymuje i przechowuje wyłącznie zaszyfrowane dane, 
        a klucz szyfrujący nigdy nie jest do niego przesyłany. 
      </p>
      <p class="mt-3">
        Dzięki temu <u>tylko nadawca i odbiorca posiadający odpowiedni klucz</u> mogą odszyfrować i przeczytać treść notatki. 
        Serwis nie ma technicznej możliwości zapoznania się z treściami notatek.
      </p>
    </section>
    <!-- 3b -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ml-6">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="mail" class="w-6 h-6 text-[#fd6927]"></i>
        <h3 class="text-xl font-semibold text-indigo-700">3b. Przetwarzanie adresów e-mail odbiorców</h3>
      </div>
      <p>
        Podanie adresu e-mail odbiorcy w formularzu notatki jest <strong>opcjonalne</strong>.
        Adres ten wykorzystywany jest wyłącznie w celu przesłania powiadomienia o utworzonej notatce
        i <strong>nie jest używany do innych celów marketingowych</strong>.
      </p>
      <p class="mt-3">
        Adres e-mail przechowywany jest w bazie danych do momentu wygaśnięcia lub otwarcia notatki,
        po czym jest automatycznie <strong>usuwany bez możliwości odzyskania</strong>.
      </p>
      <p class="mt-3">
        Podstawą prawną przetwarzania jest art. 6 ust. 1 lit. f RODO – prawnie uzasadniony interes administratora,
        polegający na umożliwieniu dostarczenia bezpiecznej notatki do wskazanego odbiorcy.
      </p>
    </section>
        <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ml-6">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="trash-2" class="w-6 h-6 text-[#fd6927]"></i>
        <h3 class="text-xl font-semibold text-indigo-700">3c. Automatyczne usuwanie notatek po 14 dniach</h3>
      </div>
      <p>
        Niezależnie od ustawionego czasu wygaśnięcia notatki, 
        wszystkie dane przechowywane w serwisie <strong>Privly.pl</strong> 
        są automatycznie <strong>usuwane z serwera po upływie 14 dni</strong> 
        od momentu ich utworzenia, jeśli wcześniej nie zostały otwarte ani wygasłe.
      </p>
      <p class="mt-3">
        Dzięki temu żadne dane nie są przechowywane dłużej niż 14 dni, 
        co dodatkowo zwiększa bezpieczeństwo i prywatność użytkowników.
      </p>
    </section>
    <!-- 4 -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="alert-triangle" class="w-7 h-7 text-[#fd6927]"></i>
        <h2 class="text-2xl font-semibold text-indigo-700">4. Brak odpowiedzialności za treści notatek</h2>
      </div>
      <p>
        Serwis <strong>Privly.pl</strong> udostępnia wyłącznie narzędzie techniczne do tworzenia i jednorazowego
        udostępniania zaszyfrowanych wiadomości.
        <strong>Nie ponosimy odpowiedzialności</strong> za treści wprowadzane przez użytkowników ani skutki ich ujawnienia.
      </p>
      <p class="mt-2">
        Zgodnie z art. 14 ust. 1–2 ustawy z dnia 18 lipca 2002 r. o świadczeniu usług drogą elektroniczną oraz
        art. 6 ust. 1 dyrektywy 2000/31/WE, usługodawca hostingu nie ma obowiązku stałego monitorowania
        przechowywanych danych i nie odpowiada za ich treść, o ile nie posiada wiedzy o ich bezprawnym charakterze
        i po uzyskaniu takiej wiedzy niezwłocznie uniemożliwi dostęp do tych danych.
      </p>
    </section>

    <!-- 4a -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ml-6">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="shield" class="w-6 h-6 text-[#fd6927]"></i>
        <h3 class="text-xl font-semibold text-indigo-700">4a. Informacja o polityce bezpieczeństwa</h3>
      </div>
      <p>
        W celu ochrony danych wdrożyliśmy środki techniczne i organizacyjne, w tym szyfrowanie transmisji (SSL/TLS),
        kontrolę dostępu do infrastruktury serwerowej oraz regularne aktualizacje systemów.
      </p>
    </section>

    <!-- 4b -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ml-6">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="bell" class="w-6 h-6 text-[#fd6927]"></i>
        <h3 class="text-xl font-semibold text-indigo-700">4b. Procedura zgłaszania naruszeń</h3>
      </div>
      <p>
        W przypadku podejrzenia naruszenia ochrony danych osobowych prosimy o niezwłoczny kontakt
        na adres <a href="mailto:kontakt@privly.pl" class="text-indigo-600 hover:underline">kontakt@privly.pl</a>.
        Zgłoszenia są analizowane, a w razie potwierdzenia incydentu podejmujemy wymagane działania, w tym
        powiadomienie organu nadzorczego.
      </p>
    </section>

    <!-- 5 -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="cookie" class="w-7 h-7 text-[#fd6927]"></i>
        <h2 class="text-2xl font-semibold text-indigo-700">5. Pliki cookies i technologie zewnętrzne</h2>
      </div>
      <p>
        Serwis wykorzystuje pliki cookies w celach:
      </p>
      <ul class="list-disc list-inside mt-2 space-y-1">
        <li><strong>Niezbędnych</strong> – dla prawidłowego działania strony.</li>
        <li><strong>Analitycznych</strong> – statystyki odwiedzin (Google Analytics).</li>
        <li><strong>Marketingowych</strong> – personalizacja reklam (Google Ads).</li>
      </ul>
    </section>

    <!-- 5a -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ml-6">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="settings" class="w-6 h-6 text-[#fd6927]"></i>
        <h3 class="text-xl font-semibold text-indigo-700">5a. Zgoda na cookies i podmioty przetwarzające</h3>
      </div>
      <p>
        Podczas pierwszej wizyty na stronie wyświetlany jest baner zgody,
        który pozwala wybrać kategorie cookies:
      </p>
      <ul class="list-disc list-inside mt-2 space-y-1">
        <li><strong>Niezbędne</strong> – zawsze włączone.</li>
        <li><strong>Analityczne</strong> – Google Analytics, aktywowane po wyrażeniu zgody.</li>
        <li><strong>Marketingowe</strong> – Google Ads, aktywowane po wyrażeniu zgody.</li>
      </ul>
    </section>

    <!-- 6 -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="pie-chart" class="w-7 h-7 text-[#fd6927]"></i>
        <h2 class="text-2xl font-semibold text-indigo-700">6. Google Analytics, Ads i reCAPTCHA</h2>
      </div>
      <p>
        Serwis korzysta z Google Analytics, Google Ads i Google reCAPTCHA w celu analityki, reklam i ochrony przed nadużyciami.
      </p>
    </section>

    <!-- 6a -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm ml-6">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="share-2" class="w-6 h-6 text-[#fd6927]"></i>
        <h3 class="text-xl font-semibold text-indigo-700">6a. Informacja o łączeniu z mediami społecznościowymi</h3>
      </div>
      <p>
        Jeśli w przyszłości pojawią się przyciski do mediów społecznościowych,
        zostanie to wyraźnie oznaczone i opisane w niniejszej polityce.
      </p>
    </section>

    <!-- 7 -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="mail" class="w-7 h-7 text-[#fd6927]"></i>
        <h2 class="text-2xl font-semibold text-indigo-700">7. Kontakt i administrator danych</h2>
      </div>
      <p>
        Administratorem danych jest właściciel serwisu <strong>Privly.pl</strong>.
        W sprawach dotyczących danych osobowych możesz pisać na adres:
        <a href="mailto:kontakt@privly.pl" class="text-indigo-600 hover:underline">kontakt@privly.pl</a>.
      </p>
    </section>

    <!-- 8 -->
    <section class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
      <div class="flex items-center gap-3 mb-3">
        <i data-lucide="refresh-ccw" class="w-7 h-7 text-[#fd6927]"></i>
        <h2 class="text-2xl font-semibold text-indigo-700">8. Zmiany w polityce prywatności</h2>
      </div>
      <p>
        Polityka prywatności może być aktualizowana w celu dostosowania do zmian w przepisach lub funkcjonalności serwisu.
        Aktualna wersja zawsze dostępna jest na tej stronie.
      </p>
    </section>

  </main>

  <!-- FOOTER -->
<?php
  require __DIR__ . '/partials/footer.php';
?>

