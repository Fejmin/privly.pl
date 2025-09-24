<?php
http_response_code(404);
$meta = [
  'title'       => 'Błąd 404 – Strona nie została znaleziona | Privly.pl',
  'description' => 'Nie znaleziono strony, której szukasz. Sprawdź nasze bezpieczne notatki online – Privly.pl.',
  'keywords'    => 'błąd 404, strona nie istnieje, privly',
  'canonical'   => 'https://privly.pl/404',
  'robots'      => 'noindex, follow',
  'og:image'    => 'https://privly.pl/assets/img/privly-og.jpg'
];
require __DIR__ . '/partials/header.php';
?>

<main class="flex-grow flex items-center justify-center px-6 bg-gradient-to-br from-indigo-50 via-white to-indigo-100 pt-28 pb-28">
  <div class="text-center max-w-2xl">
    <!-- Ikona -->
    <div class="flex justify-center mb-6">
      <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center">
        <i data-lucide="alert-triangle" class="w-10 h-10 text-red-500"></i>
      </div>
    </div>

    <!-- Nagłówek -->
    <h1 class="text-7xl font-extrabold text-gray-900 mb-4">404</h1>
    <p class="text-xl text-gray-700 mb-6">
      Ups! Strona, której szukasz, <strong>nie istnieje</strong> lub została przeniesiona.
    </p>

    <!-- CTA -->
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="/" class="px-6 py-3 rounded-lg font-semibold bg-[#fd6927] text-white shadow hover:bg-[#e05c1f] transition inline-flex items-center gap-2">
        <i data-lucide="home" class="w-5 h-5"></i> Strona główna
      </a>
      <a href="/#create-note" class="px-6 py-3 rounded-lg font-semibold bg-white border border-gray-300 shadow hover:bg-gray-50 transition inline-flex items-center gap-2">
        <i data-lucide="plus" class="w-5 h-5"></i> Utwórz notatkę
      </a>
    </div>

    <!-- Dodatkowe linki -->
    <div class="mt-8 text-gray-600 text-sm">
      <p class="mb-2">Możesz też odwiedzić:</p>
      <div class="flex flex-wrap justify-center gap-4">
        <a href="/docs" class="text-blue-700 hover:underline">📖 Dokumentacja API</a>
        <a href="/privacy-policy" class="text-blue-700 hover:underline">🔐 Polityka prywatności</a>
        <a href="/#features" class="text-blue-700 hover:underline">✨ Funkcje Privly.pl</a>
      </div>
    </div>
  </div>
</main>

<!-- SEO-tekst -->
<section class="bg-white py-16 border-t border-gray-200">
  <div class="max-w-4xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold text-gray-900 mb-4">Privly.pl – Bezpieczne notatki online</h2>
    <p class="text-lg text-gray-700 leading-relaxed mb-4">
      Nasza aplikacja umożliwia tworzenie <strong>jednorazowych notatek</strong>, 
      które automatycznie <u>znikają po odczytaniu</u>. 
      To prosty i bezpieczny sposób udostępniania haseł, kodów lub poufnych wiadomości.
    </p>
    <p class="text-lg text-gray-700 leading-relaxed">
      Zaszyfruj wiadomość algorytmem <strong>AES-256-GCM</strong>, dodaj hasło, 
      limit otwarć lub czas ważności i udostępnij unikalny link tylko wybranej osobie.  
      🔒 Nikt poza Tobą i odbiorcą nie pozna treści.
    </p>
    <a href="/" class="inline-block mt-6 px-8 py-4 bg-[#fd6927] hover:bg-[#e05c1f] text-white font-semibold rounded-xl shadow-md transition">
      Utwórz swoją bezpieczną notatkę
    </a>
  </div>
</section>

<script>lucide.createIcons();</script>

<?php require __DIR__ . '/partials/footer.php'; ?>
