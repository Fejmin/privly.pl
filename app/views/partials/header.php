<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?= htmlspecialchars($meta['title'] ?? 'Privly.pl – Bezpieczne notatki online') ?></title>
  <link rel="icon" href="https://privly.pl/assets/img/favicon.svg" type="image/svg+xml">

  <!-- Meta SEO -->
  <meta name="description" content="<?= htmlspecialchars($meta['description'] ?? 'Twórz bezpieczne notatki online z hasłem, limitami otwarć i czasem wygasania.') ?>">
  <meta name="robots" content="<?= htmlspecialchars($meta['robots'] ?? 'index, follow') ?>">
  <link rel="canonical" href="<?= htmlspecialchars($meta['canonical'] ?? 'https://privly.pl/') ?>">

  <!-- Open Graph / Social -->
  <meta property="og:title" content="<?= htmlspecialchars($meta['og:title'] ?? $meta['title'] ?? 'Privly.pl – Bezpieczne notatki online') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($meta['og:description'] ?? $meta['description'] ?? '') ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= htmlspecialchars($meta['og:url'] ?? $meta['canonical'] ?? 'https://privly.pl/') ?>">
  <meta property="og:image" content="<?= htmlspecialchars($meta['og:image'] ?? 'https://privly.pl/assets/img/privly.svg') ?>">
  <meta property="og:site_name" content="Privly.pl">

  <!-- Keywords -->
  <meta name="keywords" content="<?= htmlspecialchars($meta['keywords'] ?? 'bezpieczne notatki, szyfrowanie, privly') ?>">

  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($meta['twitter:title'] ?? $meta['title'] ?? '') ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($meta['twitter:description'] ?? $meta['description'] ?? '') ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($meta['twitter:image'] ?? 'https://privly.pl/assets/img/privly.svg') ?>">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-5P6G67ZQ');</script>

  <!-- 🔥 Preload krytycznych fontów -->
  <!-- Inter -->
  <link rel="preload" href="/assets/fonts/inter-v20-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/inter-v20-latin-600.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/inter-v20-latin-700.woff2" as="font" type="font/woff2" crossorigin>

  <!-- Poppins -->
  <link rel="preload" href="/assets/fonts/inter-v20-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/poppins-v24-latin-600.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/poppins-v24-latin-700.woff2" as="font" type="font/woff2" crossorigin>


  <!-- Fonts CSS – async load (nie blokuje renderu) -->
  <link rel="stylesheet" href="/assets/css/fonts.css" media="print" onload="this.media='all'">

  <!-- Tailwind JS – defer (ładuje się po HTML) -->
  <script src="/assets/js/tailwind.js"></script>

  <!-- reCAPTCHA -->
  <script src="https://www.google.com/recaptcha/api.js?render=6LfBR8wrAAAAAPuSDO99pX5QyY-WxmB6ZlGYlkym" defer></script>

  <!-- JSON-LD -->
  <script type="application/ld+json">{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Privly.pl",
    "url": "https://privly.pl",
    "logo": "https://privly.pl/assets/img/privly.svg"
  }</script>
  <script type="application/ld+json">{
    "@context": "https://schema.org",
    "@type": "WebApplication",
    "name": "Privly.pl",
    "url": "https://privly.pl",
    "description": "Twórz bezpieczne jednorazowe notatki online z hasłem, limitami otwarć i czasem wygasania.",
    "applicationCategory": "Utility"
  }</script>
</head>
<body class="bg-gray-50">
  <!-- GTM noscript -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5P6G67ZQ"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <header class="bg-white shadow fixed w-full z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8 h-16">
      <a href="https://privly.pl" aria-label="Privly.pl - generator haseł">
        <img src="https://privly.pl/assets/img/privly.svg" alt="Privly.pl Logo" class="w-28 h-10 object-contain flex-shrink-0">
      </a>
      <nav class="flex gap-6 text-gray-700 font-medium">
        <a href="#contact" class="hover:text-[#fd6927]" title="Skontaktuj się z nami">Kontakt</a>
      </nav>
    </div>
  </header>