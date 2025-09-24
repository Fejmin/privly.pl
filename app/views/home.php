<?php
$meta = [
  'title'       => 'Bezpieczne notatki jednorazowe online – Privly.pl',
  'description' => 'Twórz bezpieczne jednorazowe notatki online z hasłem, limitami otwarć i czasem wygasania. Bezpieczne wiadomości jednorazowe dla firm i osób prywatnych.',
  'keywords'    => 'bezpieczne notatki, jednorazowe wiadomości, prywatne linki, szyfrowanie, notatki online, privly',
  'canonical'   => 'https://privly.pl/',
  'og:image'    => 'https://privly.pl/assets/img/privly.svg'
];
require __DIR__ . '/partials/header.php';
?>

 <style>
    body{font-family:'Inter',sans-serif;}
    .hero-title{font-family:'Poppins',sans-serif;}
    .btn-primary{background:#0e2653;color:#fff;transition:background .3s;}
    .btn-primary:hover{background:#e05c1f;}
    .pulse{animation:pulseAnim .3s ease-out;}
    @keyframes pulseAnim{
      0%{transform:scale(1);}
      50%{transform:scale(1.07);}
      100%{transform:scale(1);}
    }
    #linkContainer {
      background: linear-gradient(135deg,#f0f4ff 0%,#eaf0ff 100%);
      border: 2px solid #fd6927;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      transform: translateY(20px);
      opacity: 0;
      transition: all .5s ease;
    }
    #linkContainer.show {
      transform: translateY(0);
      opacity: 1;
    }
    .copy-anim { animation: copyGlow 1s ease; }
    @keyframes copyGlow {
      0% { box-shadow: 0 0 0 0 rgba(34,197,94,.6); }
      50% { box-shadow: 0 0 10px 4px rgba(34,197,94,.4); }
      100%{ box-shadow: 0 0 0 0 rgba(34,197,94,0);}
    }
    #create-note input[type="checkbox"] {
      appearance:none; -webkit-appearance:none; background:#fff; border:2px solid #0e2653;
      width:20px; height:20px; border-radius:4px; cursor:pointer; position:relative;
    }
    #create-note input[type="checkbox"]:checked { background:#0e2653; border-color:#0e2653; }
    #create-note input[type="checkbox"]:checked::after {
      content:''; position:absolute; left:5px; top:1px; width:5px; height:10px;
      border:solid #fff; border-width:0 2px 2px 0; transform:rotate(45deg);
    }
  </style>
<!-- HERO -->
<section class="relative pt-28 pb-20 bg-gradient-to-br from-indigo-50 via-white to-indigo-100 overflow-hidden">
  <div class="absolute inset-0 pointer-events-none">
    <svg class="absolute top-0 right-0 w-64 h-64 text-indigo-100" fill="none" stroke="currentColor">
      <circle cx="200" cy="200" r="180" stroke-width="40" />
    </svg>
  </div>
  <div class="max-w-4xl mx-auto text-center px-4 relative z-10">
    <h1 class="hero-title text-5xl md:text-6xl font-extrabold text-gray-900 mb-6">
      🔒 Bezpieczne <span class="text-[#fd6927]">notatki jednorazowe</span>
    </h1>
    <p class="text-xl text-gray-700 max-w-2xl mx-auto">
      Utwórz poufną wiadomość, którą można odczytać tylko raz i która znika po otwarciu lub upływie czasu.
    </p>
  </div>
</section>


<main>

  <!-- Formularz -->
  <section id="create-note" class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded-xl shadow-lg transition-all duration-500">
    <div id="formWrapper">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Twoja jednorazowa notatka</h2>

      <textarea id="note" class="border border-gray-300 rounded-lg p-4 w-full h-48 resize-none focus:outline-none focus:ring-2 focus:ring-[#fd6927]" placeholder="Wpisz swoją notatkę..." autofocus></textarea>

      <!-- komunikaty błędów -->
      <p id="formError" class="hidden mt-3 p-3 bg-red-50 border border-red-300 text-red-700 rounded-lg text-sm flex items-center gap-2">
        <i data-lucide="alert-circle" class="w-5 h-5"></i>
        <span id="formErrorText"></span>
      </p>


      <div class="mt-4 flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
        <p id="advancedLabel" class="text-[#fd6927] font-semibold cursor-pointer select-none flex items-center gap-2">
          <span>Opcje zaawansowane</span>
          <i id="advancedArrow" data-lucide="chevron-down" class="w-5 h-5 transition-transform duration-300"></i>
        </p>

        <div class="flex items-center space-x-3 flex-wrap">
          <div class="flex items-center space-x-2">
            <input type="checkbox" id="shortenLink" checked>
            <label for="shortenLink" class="text-gray-700">Skróć link przez</label>
          </div>
          <a href='https://hoply.pl'><img src="https://hoply.pl/assets/img/hoply.svg"
              alt="Hoply logo" 
              class="w-28 h-10 object-contain flex-shrink-0" loading="lazy"></a>
        </div>
      </div>

      <div id="advancedOptions" class="space-y-3 hidden mt-3">
        <div class="flex flex-col sm:flex-row sm:space-x-4">
          <label class="flex-1">Ilość otwarć:
            <input id="maxViews" type="number" min="1" max="10" placeholder="Domyślnie 1" class="border border-gray-300 rounded-lg p-2 w-full">
          </label>

          <label class="flex-1 mt-2 sm:mt-0">Hasło do notatki:
            <div class="relative flex rounded-lg border border-gray-300">
              <input id="notePassword" type="text" placeholder="Opcjonalne hasło"
                     class="flex-1 p-2 rounded-l-lg focus:outline-none">
              <button id="generatePasswordBtn" type="button"
                      class="px-3 bg-gray-100 hover:bg-gray-200 rounded-r-lg flex items-center justify-center"
                      title="Wygeneruj hasło">
                <svg data-lucide="dices" class="w-5 h-5 text-gray-700"></svg>
              </button>
            </div>
          </label>
        </div>

        <div class="flex flex-col sm:flex-row sm:space-x-4">
          <label class="flex-1">Czas ważności:
            <select id="expire" class="border border-gray-300 rounded-lg p-2 w-full">
              <option value="" selected hidden>— wybierz</option>
              <option value="1m">1 minuta</option>
              <option value="5m">5 minut</option>
              <option value="30m">30 minut</option>
              <option value="1h">1 godzina</option>
              <option value="4h">4 godziny</option>
              <option value="12h">12 godzin</option>
              <option value="1d">1 dzień</option>
              <option value="3d">3 dni</option>
              <option value="7d">7 dni</option>
              <option value="14d">14 dni</option>
            </select>
          </label>
          <label class="flex-1 mt-2 sm:mt-0">Email odbiorcy:
            <input id="notifyEmail" type="email" placeholder="Opcjonalny adres e-mail" class="border border-gray-300 rounded-lg p-2 w-full">
          </label>
        </div>
      </div>

      <button id="generateLink" class="mt-6 btn-primary text-white font-semibold px-6 py-3 rounded-lg w-full">
        Utwórz jednorazowy link
      </button>
    </div>

    <!-- KONTAINER LINKU PO WYGENEROWANIU -->
    <div id="linkContainer"
        class="hidden relative w-full max-w-none bg-gradient-to-br from-white to-indigo-50 border border-indigo-100
            rounded-3xl shadow-2xl p-8 text-center overflow-hidden">

      <!-- Dekoracyjna poświata w tle -->
      <div class="absolute inset-0 bg-gradient-to-r from-[#fd6927]/10 to-indigo-200/10 pointer-events-none blur-2xl"></div>

      <!-- Nagłówek -->
      <h3 class="relative z-10 text-2xl font-extrabold text-gray-900 mb-6 tracking-tight flex items-center justify-center gap-2">
        <i data-lucide="key-round" class="w-6 h-6 text-[#fd6927]"></i>
        Twój bezpieczny link
      </h3>

      <!-- Pole z linkiem i przycisk kopiowania -->
      <div class="relative z-10 flex items-center group">
        <input
          id="oneTimeLink"
          type="text"
          autofocus readonly
          class="flex-1 text-center text-gray-800 font-semibold bg-white/80 backdrop-blur-sm border border-gray-200
                rounded-l-2xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#fd6927] transition"
        >
        <button
          id="copyLink"
          class="bg-[#fd6927] text-white font-semibold px-6 py-3 rounded-r-2xl
                transition-all duration-300 active:scale-95 shadow-md hover:shadow-lg"
        >
          Kopiuj
        </button>
      </div>
      <p class="mt-3 text-sm text-gray-600 text-center">
        🔑 <strong>Pamiętaj:</strong> klucz deszyfrujący znajduje się w adresie po znaku
        <code>#</code>. <br>
        Nie udostępniaj go nikomu poza odbiorcą – nie jest zapisywany na serwerze.
      </p>

      <!-- Przycisk nowej notatki – domyślnie ukryty -->
       <Div class='flex items-center justify-center '>
          <button
            id="generateNoteBtnBottom"
            class="hidden mt-6 bg-[#fd6927] hover:bg-[#e05c1f] text-white font-semibold
                  px-6 py-3 rounded-xl shadow-md transition
                  flex items-center justify-center gap-2"
          >
            <i data-lucide="plus" class="w-5 h-5"></i>
            <span>Utwórz nową notatkę</span>
          </button>
      </div>
    </div>
  </section>
</main>

  <!-- === NOWE SEKCJE === -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Co to jest?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Privly.pl to bezpieczny sposób udostępniania poufnych informacji, który ulega samozniszczeniu po jednorazowym wyświetleniu."
      }
    },
    {
      "@type": "Question",
      "name": "Czy jest bezpieczny?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tak. Po wyświetleniu, sekret jest trwale usuwany z naszych serwerów, co zapewnia Twoją prywatność."
      }
    },
    {
      "@type": "Question",
      "name": "Co dalej?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Gdy będziesz gotowy, kliknij przycisk u góry strony, aby wyświetlić jednorazową wiadomość."
      }
    }
  ]
}
</script>
  <!-- Funkcje / Korzyści -->
  <section id="features" class="mt-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Dlaczego warto korzystać z Privly.pl?</h2>
    <div class="grid md:grid-cols-3 gap-8 text-center">
      <article class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:shadow-lg transition-shadow">
        <i data-lucide="shield-check" class="w-12 h-12 text-[#fd6927] mb-3"></i>
        <h3 class="font-semibold text-xl mb-2">Prywatność i bezpieczeństwo</h3>
        <p class="text-gray-600">Notatki chronione hasłem, limitem otwarć i czasem wygasania gwarantują poufność danych.</p>
      </article>
      <article class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:shadow-lg transition-shadow">
        <i data-lucide="link-2" class="w-12 h-12 text-[#fd6927] mb-3"></i>
        <h3 class="font-semibold text-xl mb-2">Jednorazowe linki</h3>
        <p class="text-gray-600">Każdy wygenerowany adres działa tylko raz i automatycznie znika po odczytaniu treści.</p>
      </article>
      <article class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:shadow-lg transition-shadow">
        <i data-lucide="mouse-pointer-click" class="w-12 h-12 text-[#fd6927] mb-3"></i>
        <h3 class="font-semibold text-xl mb-2">Łatwość użycia</h3>
        <p class="text-gray-600">Tworzenie notatki to zaledwie kilka kliknięć – na komputerze i urządzeniach mobilnych.</p>
      </article>
    </div>
  </section>

  <!-- Sekcja E2EE -->
<section id="e2ee" class="py-20 bg-white border-t border-b border-gray-200">
  <div class="max-w-4xl mx-auto px-6 text-center">
    <!-- Ikona i nagłówek -->
    <div class="flex justify-center mb-6">
      <div class="w-16 h-16 rounded-full bg-[#fd6927]/10 flex items-center justify-center">
        <i data-lucide="lock" class="w-8 h-8 text-[#fd6927]"></i>
      </div>
    </div>
    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
      Pełne szyfrowanie end-to-end (E2EE)
    </h2>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto leading-relaxed">
      Wszystkie notatki w <span class="font-semibold text-[#fd6927]">Privly.pl</span> 
      są szyfrowane w Twojej przeglądarce algorytmem 
      <strong>AES-256-GCM</strong>. 
      <br>Serwer przechowuje tylko zaszyfrowane dane – 
      <u>bez kluczy, bez możliwości odczytu</u>.
    </p>

    <!-- Box wyróżniony -->
    <div class="mt-10 bg-gray-50 border border-gray-200 rounded-2xl shadow-sm p-8">
      <blockquote class="text-xl italic text-gray-800 leading-relaxed">
        „End-to-end encryption (E2EE) oznacza, że tylko Ty i odbiorca macie dostęp do treści. 
        Nawet Privly.pl nie może jej odszyfrować.”
      </blockquote>
    </div>

    <!-- Mały opis pod spodem -->
    <p class="mt-6 text-sm text-gray-500">
      🔐 Standard AES-GCM jest stosowany m.in. w <strong>TLS 1.3</strong> i komunikatorze <strong>Signal</strong>.
    </p>
  </div>
</section>

<!-- Zastosowania i przykłady użycia – styl media object -->
<section id="use-cases" class="py-20 bg-gray-50">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 text-center mb-6">
      Dla kogo i w jakich sytuacjach?
    </h2>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto text-center mb-12">
      Privly.pl sprawdza się wszędzie tam, gdzie potrzebujesz
      <span class="text-[#fd6927] font-semibold">jednorazowego i poufnego</span> przekazania danych.
    </p>

    <div class="space-y-8">
      <!-- 1 -->
      <div class="flex items-start bg-white border border-gray-200 rounded-xl p-6 hover:border-[#fd6927] transition">
        <div class="flex-shrink-0 mr-5">
          <div class="w-14 h-14 rounded-full bg-[#fd6927]/10 flex items-center justify-center">
            <i data-lucide="briefcase" class="w-7 h-7 text-[#fd6927]"></i>
          </div>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-900 mb-1">Freelancerzy i agencje</h3>
          <p class="text-gray-700">
            Przekazywanie haseł FTP, kluczy API czy danych do paneli bez pozostawiania śladu w komunikatorach.
          </p>
        </div>
      </div>

      <!-- 2 -->
      <div class="flex items-start bg-white border border-gray-200 rounded-xl p-6 hover:border-[#fd6927] transition">
        <div class="flex-shrink-0 mr-5">
          <div class="w-14 h-14 rounded-full bg-[#fd6927]/10 flex items-center justify-center">
            <i data-lucide="users" class="w-7 h-7 text-[#fd6927]"></i>
          </div>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-900 mb-1">Firmy i działy HR</h3>
          <p class="text-gray-700">
            Bezpieczne przesyłanie dokumentów kandydatom i pracownikom w procesach rekrutacyjnych.
          </p>
        </div>
      </div>

      <!-- 3 -->
      <div class="flex items-start bg-white border border-gray-200 rounded-xl p-6 hover:border-[#fd6927] transition">
        <div class="flex-shrink-0 mr-5">
          <div class="w-14 h-14 rounded-full bg-[#fd6927]/10 flex items-center justify-center">
            <i data-lucide="server" class="w-7 h-7 text-[#fd6927]"></i>
          </div>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-900 mb-1">Administratorzy i IT</h3>
          <p class="text-gray-700">
            Jednorazowe tokeny, linki resetujące i klucze SSH – automatyczne usuwanie notatek po pierwszym otwarciu.
          </p>
        </div>
      </div>

      <!-- 4 -->
      <div class="flex items-start bg-white border border-gray-200 rounded-xl p-6 hover:border-[#fd6927] transition">
        <div class="flex-shrink-0 mr-5">
          <div class="w-14 h-14 rounded-full bg-[#fd6927]/10 flex items-center justify-center">
            <i data-lucide="shopping-bag" class="w-7 h-7 text-[#fd6927]"></i>
          </div>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-900 mb-1">Sklepy i sprzedawcy</h3>
          <p class="text-gray-700">
            Wysyłanie jednorazowych kodów rabatowych lub prywatnych linków do plików bez ryzyka kopiowania.
          </p>
        </div>
      </div>

      <!-- 5 -->
      <div class="flex items-start bg-white border border-gray-200 rounded-xl p-6 hover:border-[#fd6927] transition">
        <div class="flex-shrink-0 mr-5">
          <div class="w-14 h-14 rounded-full bg-[#fd6927]/10 flex items-center justify-center">
            <i data-lucide="user" class="w-7 h-7 text-[#fd6927]"></i>
          </div>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-900 mb-1">Użytkownicy prywatni</h3>
          <p class="text-gray-700">
            Szybkie przekazywanie numerów kont bankowych, danych logowania
            czy poufnych wiadomości rodzinie i znajomym.
          </p>
        </div>
      </div>

      <!-- 6 -->
      <div class="flex items-start bg-white border border-gray-200 rounded-xl p-6 hover:border-[#fd6927] transition">
        <div class="flex-shrink-0 mr-5">
          <div class="w-14 h-14 rounded-full bg-[#fd6927]/10 flex items-center justify-center">
            <i data-lucide="shield" class="w-7 h-7 text-[#fd6927]"></i>
          </div>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-900 mb-1">Każdy, kto ceni prywatność</h3>
          <p class="text-gray-700">
            Dane znikają po pierwszym otwarciu lub po określonym czasie. Bez rejestracji i zbędnych logów.
          </p>
        </div>
      </div>
    </div>

    <div class="mt-16 text-center">
      <a href="#create-note"
         class="inline-flex items-center justify-center px-8 py-4 bg-[#fd6927] hover:bg-[#e05c1f]
                text-white font-semibold rounded-2xl shadow-md transition">
        <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
        Utwórz swoją pierwszą bezpieczną notatkę
      </a>
    </div>
    <p class="text-gray-600 pt-6">
  Każdy link to <strong>zabezpieczona notatka</strong>, która może być odczytana tylko raz – 
  prawdziwa <strong>samozniszczalna wiadomość</strong> (self-destruct note).
</p>
  </div>
</section>

  <!-- SEO-tekst -->
  <!-- SEO-tekst -->
<section id="seo-text" class="bg-white py-16 border-t border-b border-gray-200">
  <div class="max-w-5xl mx-auto px-6 text-center">
    <div class="flex justify-center mb-6">
      <div class="w-16 h-16 rounded-full bg-[#fd6927]/10 flex items-center justify-center">
        <i data-lucide="file-lock" class="w-8 h-8 text-[#fd6927]"></i>
      </div>
    </div>
    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
      Bezpieczne i jednorazowe notatki online
    </h2>
    <p class="text-lg text-gray-700 max-w-3xl mx-auto leading-relaxed">
      <strong>Privly.pl</strong> to nowoczesny serwis typu 
      <em>one-time note</em> – <u>notatka samozniszczalna</u>, 
      <u>self-destruct message</u> lub <u>znikająca wiadomość</u>.  
      Twórz <strong>tajne linki</strong>, <strong>jednorazowe wiadomości</strong> i 
      <strong>szyfrowane notatki z hasłem</strong> – idealne do przesyłania poufnych danych 
      takich jak loginy, kody dostępu czy dokumenty.
    </p>
    <p class="mt-4 text-gray-600">
      Wszystkie notatki szyfrowane są <strong>end-to-end (E2EE)</strong> algorytmem 
      <strong>AES-256-GCM</strong>, a serwer przechowuje wyłącznie 
      <em>zaszyfrowane dane bez kluczy</em>. Po odczytaniu notatka znika 
      <u>bez możliwości odzyskania</u>.
    </p>
  </div>
</section>

<!-- Jak to działa -->
<section id="how-it-works" class="mt-20 max-w-6xl mx-auto px-6">
  <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12 text-center">
    Jak to działa?
  </h2>
  <div class="grid md:grid-cols-3 gap-10 text-center">
    
    <!-- Step 1 -->
    <div class="flex flex-col items-center">
      <span class="text-5xl font-extrabold text-[#fd6927] mb-4">01</span>
      <h3 class="text-xl font-semibold mb-2">Napisz notatkę</h3>
      <p class="text-gray-700">
        Wpisz treść wiadomości i ustaw opcje bezpieczeństwa: 
        hasło, limit otwarć lub datę wygaśnięcia.
      </p>
    </div>
    
    <!-- Step 2 -->
    <div class="flex flex-col items-center">
      <span class="text-5xl font-extrabold text-[#fd6927] mb-4">02</span>
      <h3 class="text-xl font-semibold mb-2">Wygeneruj link</h3>
      <p class="text-gray-700">
        Otrzymasz unikalny, jednorazowy adres URL.  
        <strong>Działa tylko raz</strong> i automatycznie się usuwa.
      </p>
    </div>
    
    <!-- Step 3 -->
    <div class="flex flex-col items-center">
      <span class="text-5xl font-extrabold text-[#fd6927] mb-4">03</span>
      <h3 class="text-xl font-semibold mb-2">Udostępnij</h3>
      <p class="text-gray-700">
        Przekaż link odbiorcy.  
        Po otwarciu treść zostanie <u>trwale usunięta</u>.
      </p>
    </div>

  </div>
  <div class="mt-12 text-center pb-6">
    <a href="#create-note"
       class="inline-flex items-center justify-center px-8 py-4 bg-[#fd6927] hover:bg-[#e05c1f]
              text-white font-semibold rounded-2xl shadow-md transition">
      <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
      Utwórz swoją pierwszą notatkę
    </a>
  </div>
</section>
  <section id="faq" class="py-20 bg-white border-t border-gray-200">
    <div class="max-w-5xl mx-auto px-6">
      <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 text-center mb-12">
        Najczęściej zadawane pytania
      </h2>
      <div class="grid md:grid-cols-2 gap-6">
        
        <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <i data-lucide="help-circle" class="w-8 h-8 text-[#fd6927] mb-3"></i>
          <h3 class="font-semibold text-xl text-gray-900 mb-2">Czym jest jednorazowa notatka?</h3>
          <p class="text-gray-700 text-sm leading-relaxed">
            To <strong>znikająca wiadomość</strong>, którą można odczytać tylko raz. 
            Po otwarciu treść znika z serwera – tzw. <em>ephemeral note</em> lub 
            <em>self-destruct message</em>.
          </p>
        </div>

        <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <i data-lucide="shield-check" class="w-8 h-8 text-[#fd6927] mb-3"></i>
          <h3 class="font-semibold text-xl text-gray-900 mb-2">Czy notatka tymczasowa jest bezpieczna?</h3>
          <p class="text-gray-700 text-sm leading-relaxed">
            Tak. Każda <strong>szyfrowana notatka</strong> w Privly.pl chroniona jest AES-256-GCM. 
            Możesz też ustawić <strong>notatkę z hasłem</strong>, aby mieć dodatkową ochronę.
          </p>
        </div>

        <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <i data-lucide="key-round" class="w-8 h-8 text-[#fd6927] mb-3"></i>
          <h3 class="font-semibold text-xl text-gray-900 mb-2">Na czym polega notatka z hasłem?</h3>
          <p class="text-gray-700 text-sm leading-relaxed">
            Odbiorca musi podać ustalone przez Ciebie hasło, aby zobaczyć treść. 
            Taki <strong>bezpieczny link</strong> jest lepszy niż tradycyjny e-mail.
          </p>
        </div>

        <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <i data-lucide="clock" class="w-8 h-8 text-[#fd6927] mb-3"></i>
          <h3 class="font-semibold text-xl text-gray-900 mb-2">Czym różni się wiadomość jednorazowa od krótkotrwałej?</h3>
          <p class="text-gray-700 text-sm leading-relaxed">
            <strong>Wiadomość jednorazowa</strong> usuwa się natychmiast po pierwszym otwarciu, 
            a <strong>notatka tymczasowa</strong> wygasa po określonym czasie (np. godzinie lub dniu).
          </p>
        </div>

        <!-- NOWE PYTANIE 1 -->
        <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <i data-lucide="link" class="w-8 h-8 text-[#fd6927] mb-3"></i>
          <h3 class="font-semibold text-xl text-gray-900 mb-2">Czy mogę udostępnić notatkę bez ustawiania hasła?</h3>
          <p class="text-gray-700 text-sm leading-relaxed">
            Tak. Możesz stworzyć <strong>bezpieczny link</strong> bez dodatkowego hasła. 
            Klucz deszyfrujący jest wtedy częścią adresu URL i widoczny tylko dla odbiorcy.
          </p>
        </div>

        <!-- NOWE PYTANIE 2 -->
        <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <i data-lucide="trash-2" class="w-8 h-8 text-[#fd6927] mb-3"></i>
          <h3 class="font-semibold text-xl text-gray-900 mb-2">Czy wiadomość znika także wtedy, gdy nie zostanie otwarta?</h3>
          <p class="text-gray-700 text-sm leading-relaxed">
            Tak. Jeśli ustawisz <strong>czas wygaśnięcia</strong>, każda wiadomość – 
            nawet nieotwarta – zostanie automatycznie usunięta po upływie wybranego terminu.
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- FAQ JSON-LD -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Czym jest jednorazowa notatka?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Jednorazowa notatka to znikająca wiadomość, którą można odczytać tylko raz. Po otwarciu treść znika z serwera – to tzw. ephemeral note lub self-destruct message."
        }
      },
      {
        "@type": "Question",
        "name": "Czy notatka tymczasowa jest bezpieczna?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Tak. Każda szyfrowana notatka w Privly.pl chroniona jest algorytmem AES-256-GCM. Możesz też ustawić notatkę z hasłem, aby mieć dodatkową ochronę."
        }
      },
      {
        "@type": "Question",
        "name": "Na czym polega notatka z hasłem?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Notatka z hasłem wymaga podania ustalonego przez nadawcę hasła, aby odczytać treść. Dzięki temu bezpieczny link zapewnia dodatkową warstwę ochrony."
        }
      },
      {
        "@type": "Question",
        "name": "Czym różni się wiadomość jednorazowa od krótkotrwałej?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Wiadomość jednorazowa usuwa się natychmiast po pierwszym otwarciu, a notatka tymczasowa wygasa po określonym czasie, np. godzinie lub dniu."
        }
      },
      {
        "@type": "Question",
        "name": "Czy mogę udostępnić notatkę bez ustawiania hasła?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Tak. Możesz stworzyć bezpieczny link bez dodatkowego hasła. W takim przypadku klucz deszyfrujący znajduje się w adresie URL i jest widoczny tylko dla odbiorcy."
        }
      },
      {
        "@type": "Question",
        "name": "Czy wiadomość znika także wtedy, gdy nie zostanie otwarta?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Tak. Jeśli ustawisz czas wygaśnięcia, każda wiadomość – nawet nieotwarta – zostanie automatycznie usunięta po upływie wskazanego terminu."
        }
      }
    ]
  }
  </script>
  <section id="my-apps" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold mb-12">Inne aplikacje</h2>
      <div class="grid md:grid-cols-3 gap-8">

        <a href="https://hoply.pl" target="_blank" rel="noopener" class="group bg-white p-6 rounded-2xl shadow hover:shadow-lg transform hover:-translate-y-2 transition-all duration-300 min-h-[250px]">
          <img style="width: 200px;" src="https://hoply.pl/assets/img/hoply.svg" alt="Hoply.pl Logo" class="mx-auto mb-4 h-16 object-contain" loading="lazy">
          <h3 class="text-xl font-semibold mb-2 text-yellow-700 group-hover:text-yellow-900 transition-colors">Hoply.pl</h3>
          <p class="text-gray-700">Skracacz linków – szybko twórz krótkie i łatwe do udostępniania adresy URL.</p>
        </a>

        <!-- Hoply.pl -->
        <a href="https://passly.pl" target="_blank" rel="noopener" class="group bg-white p-6 rounded-2xl shadow hover:shadow-lg transform hover:-translate-y-2 transition-all duration-300 min-h-[250px]">
          <img src="https://passly.pl/passly.svg" alt="Hoply.pl Logo" class="mx-auto mb-4 h-16 object-contain" loading="lazy">
          <h3 class="text-xl font-semibold mb-2 text-yellow-700 group-hover:text-yellow-900 transition-colors">Passly.pl</h3>
          <p class="text-gray-700">Generator haseł – twórz nowe, unikalne i bezpieczne hasła jednym kliknięciem.</p>
        </a>

      </div>

    </div>
  </section>
<script>
document.addEventListener('DOMContentLoaded', () => {
  if (typeof lucide !== 'undefined' && lucide.createIcons) lucide.createIcons();

  const btn               = document.getElementById('generateLink');
  const linkBox           = document.getElementById('linkContainer');
  const out               = document.getElementById('oneTimeLink');
  const copyBtn           = document.getElementById('copyLink');
  const advToggle         = document.getElementById('advancedLabel');
  const advBox            = document.getElementById('advancedOptions');
  const shortenChk        = document.getElementById('shortenLink');
  const genPassBtn        = document.getElementById('generatePasswordBtn');
  const passInput         = document.getElementById('notePassword');
  const formWrapper       = document.getElementById('formWrapper');
  const generateNoteBottom= document.getElementById('generateNoteBtnBottom');
  const maxViewsInput     = document.getElementById('maxViews');
  const formError         = document.getElementById('formError');
  const createNoteBox     = document.getElementById('create-note');

  function showError(msg) {
    formError.textContent = msg;
    formError.classList.remove('hidden');
  }
  function clearError() {
    formError.textContent = '';
    formError.classList.add('hidden');
  }

  advToggle.addEventListener('click', () => {
    advBox.classList.toggle('hidden');
    document.getElementById('advancedArrow').classList.toggle('rotate-180');
  });

  maxViewsInput.addEventListener('input', () => {
    let val = parseInt(maxViewsInput.value);
    if (isNaN(val) || val < 1) maxViewsInput.value = '';
    else if (val > 10) maxViewsInput.value = 10;
  });

  function localGenerate(length = 16) {
    const pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_=+[]{};:,.<>?';
    const arr = new Uint32Array(length);
    crypto.getRandomValues(arr);
    return Array.from(arr, n => pool[n % pool.length]).join('');
  }

  genPassBtn.addEventListener('click', async () => {
    genPassBtn.disabled = true;
    try {
      const res = await fetch('https://passly.pl/api/', {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body:JSON.stringify({length:16, uppercase:true, lowercase:true, numbers:true, special:true, multi:1})
      });
      const json = await res.json();
      passInput.value = json?.passwords?.[0] ?? localGenerate();
    } catch {
      passInput.value = localGenerate();
    } finally { genPassBtn.disabled = false; }
  });

  async function createNote() {
  clearError();
  const plain    = document.getElementById('note').value.trim();
  const password = passInput.value.trim();
  let maxViews   = parseInt(maxViewsInput.value) || 0;
  const expire   = document.getElementById('expire').value;
  const email    = document.getElementById('notifyEmail').value;

  if (!plain) { showError('Wpisz treść notatki.'); return; }

  const iv = crypto.getRandomValues(new Uint8Array(12));

  let ciphertext, ivBase64, keyBase64 = null, saltBase64 = null, passwordProtected = 0;

  if (password) {
    passwordProtected = 1;
    const salt = crypto.getRandomValues(new Uint8Array(16));
    const baseKey = await crypto.subtle.importKey(
      "raw",
      new TextEncoder().encode(password),
      "PBKDF2",
      false,
      ["deriveKey"]
    );
    const derivedKey = await crypto.subtle.deriveKey(
      { name: "PBKDF2", salt: salt, iterations: 100000, hash: "SHA-256" },
      baseKey,
      { name: "AES-GCM", length: 256 },
      false,
      ["encrypt"]
    );
    const encoded = new TextEncoder().encode(plain);
    const cipherBuffer = await crypto.subtle.encrypt({ name: "AES-GCM", iv }, derivedKey, encoded);

    ciphertext  = btoa(String.fromCharCode(...new Uint8Array(cipherBuffer)));
    ivBase64    = btoa(String.fromCharCode(...iv));
    saltBase64  = btoa(String.fromCharCode(...salt));
  } else {
    const key = crypto.getRandomValues(new Uint8Array(32));
    keyBase64 = btoa(String.fromCharCode(...key));
    const cryptoKey = await crypto.subtle.importKey("raw", key, "AES-GCM", false, ["encrypt"]);
    const encoded = new TextEncoder().encode(plain);
    const cipherBuffer = await crypto.subtle.encrypt({ name: "AES-GCM", iv }, cryptoKey, encoded);

    ciphertext = btoa(String.fromCharCode(...new Uint8Array(cipherBuffer)));
    ivBase64   = btoa(String.fromCharCode(...iv));
  }

  // przygotuj dane
  const data = new FormData();
  data.append('ciphertext', ciphertext);
  data.append('iv', ivBase64);
  data.append('max_views', maxViews);
  data.append('password_protected', passwordProtected);
  if (saltBase64) data.append('salt', saltBase64);
  if (email)  data.append('notify_email', email);
  if (expire) data.append('expire', expire);

  grecaptcha.ready(() => {
    grecaptcha.execute('6LfBR8wrAAAAAPuSDO99pX5QyY-WxmB6ZlGYlkym', {action:'create_note'}).then(async token => {
      data.append('recaptchaToken', token);
      btn.disabled = true;
      try {
        // --- 1) najpierw utwórz notatkę (backend wygeneruje note_key)
        const res = await fetch('/note/store', { method:'POST', body:data });
        const json = await res.json();
        if (!res.ok || json.error) throw new Error(json.error || 'Błąd serwera: '+res.status);

        let finalUrl = window.location.origin + json.link;
        if (keyBase64) finalUrl += '#' + keyBase64;

        // --- 2) jeśli trzeba -> skróć w Hoply i doślij short_code do backendu
        if (shortenChk.checked) {
          try {
            const form = new URLSearchParams();
            form.append('url', finalUrl);
            const shortRes = await fetch('https://hoply.pl/api/', {
              method:'POST',
              headers:{'Content-Type':'application/x-www-form-urlencoded'},
              body: form.toString()
            });
            const sjson = await shortRes.json();
            if (sjson.short_url && sjson.short_code) {
              finalUrl = sjson.short_url;

              // teraz zaktualizuj rekord notatki podając short_code
              const fd = new FormData();
              fd.append('note_key', (json.link || '').split('/').pop());
              fd.append('short_code', sjson.short_code);
              await fetch('/note/store', { method:'POST', body: fd });
            }
          } catch(e) {
            console.warn('Nie udało się skrócić linku:', e);
          }
        }

        // --- 3) UI
        out.value = finalUrl.replace(/^https?:\/\//, '');
        formWrapper.classList.add('hidden');
        linkBox.classList.remove('hidden');
        linkBox.classList.add('show');
        linkBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
        createNoteBox.classList.remove('p-6');
        createNoteBox.classList.add('p-0');
        generateNoteBottom.classList.remove('hidden');
        out.select();
      } catch(err) {
        showError('Nie udało się utworzyć notatki: ' + err.message);
      } finally {
        btn.disabled = false;
      }
    });
  });
}

  btn.addEventListener('click', createNote);

  generateNoteBottom.addEventListener('click', () => {
    formWrapper.classList.remove('hidden');
    linkBox.classList.add('hidden');
    createNoteBox.classList.remove('p-0');
    createNoteBox.classList.add('p-6');
    generateNoteBottom.classList.add('hidden');
    document.getElementById('note').value = '';
    document.getElementById('oneTimeLink').value = '';
    maxViewsInput.value = '';
    passInput.value = '';
    document.getElementById('expire').value = '';
    document.getElementById('notifyEmail').value = '';
    clearError();
  });

  copyBtn.addEventListener('click', () => {
    navigator.clipboard.writeText(out.value)
      .then(() => {
        const originalText = 'Kopiuj';
        copyBtn.textContent = 'Skopiowano';
        copyBtn.classList.add('bg-green-500', 'pulse');
        copyBtn.classList.remove('bg-[#fd6927]');
        setTimeout(() => {
          copyBtn.textContent = originalText;
          copyBtn.classList.remove('bg-green-500', 'pulse');
          copyBtn.classList.add('bg-[#fd6927]');
        }, 2000);
      })
      .catch(() => showError('Nie udało się skopiować'));
  });

});
</script>
<?php
require __DIR__ . '/partials/footer.php';
?>

