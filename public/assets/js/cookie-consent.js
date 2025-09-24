(function () {
  const storageKey = "cb_consent";
  const GA_ID = "G-WEDPHQ431Z"; // <<< TUTAJ podmień na swój GA4 ID
  const privacyPolicyUrl = "https://privly.pl/privacy-policy";
  const consentValidityDays = 180; // ponowne pytanie po 6 miesiącach

  /** ====== Consent Mode v2 – domyślna odmowa ====== */
  window.dataLayer = window.dataLayer || [];
  function gtag(){ dataLayer.push(arguments); }

  gtag('consent', 'default', {
    ad_storage:            'denied',
    ad_user_data:          'denied',
    ad_personalization:    'denied',
    analytics_storage:     'denied',
    functionality_storage: 'granted',
    security_storage:      'granted',
    wait_for_update:       500
  });

  // Ładujemy gtag.js
  const gaScript = document.createElement("script");
  gaScript.async = true;
  gaScript.src   = "https://www.googletagmanager.com/gtag/js?id=" + GA_ID;
  document.head.appendChild(gaScript);

  gtag('js', new Date());
  gtag('config', GA_ID);

  /** ====== HTML bannera ====== */
  const bannerHTML = `
  <div id="cb-overlay" class="fixed inset-0 bg-black/50 flex items-center justify-center z-[9999] px-4" role="dialog" aria-modal="true" aria-labelledby="cb-title" aria-describedby="cb-desc">
    <div class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-lg p-6 animate-fade-in" tabindex="-1">
      <div class="mb-4">
        <h2 id="cb-title" class="text-xl font-bold text-gray-800">Ustawienia cookies</h2>
      </div>
      <p id="cb-desc" class="text-gray-700 mb-4">
        Używamy plików cookie w celu prawidłowego działania strony, analityki i marketingu.
        Szczegóły znajdziesz w naszej
        <a href="${privacyPolicyUrl}" target="_blank" rel="noopener noreferrer" class="underline text-indigo-600">Polityce prywatności</a>.
      </p>

      <details class="mb-4 text-sm text-gray-600">
        <summary class="cursor-pointer text-indigo-600">Więcej informacji</summary>
        <p class="mt-2">
          Dostawcą części usług jest Google Ireland Limited / Google LLC.
          Google może wykorzystywać dane zgodnie ze swoją
          <a href="https://policies.google.com/privacy" target="_blank" class="underline">Polityką prywatności</a>
          oraz zasadami opisanymi w
          <a href="https://policies.google.com/technologies/partner-sites" target="_blank" class="underline">Jak Google wykorzystuje dane</a>.
        </p>
      </details>

      <div class="space-y-5">
        <label class="flex items-center justify-between">
          <span class="font-semibold text-gray-800">Niezbędne (zawsze aktywne)</span>
          <span class="relative inline-flex items-center">
            <input type="checkbox" checked disabled class="sr-only peer">
            <span class="w-11 h-6 bg-indigo-300 rounded-full peer-disabled:cursor-not-allowed"></span>
            <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300" style="--tw-translate-x: 1.25rem; transform: translate(var(--tw-translate-x), var(--tw-translate-y));"></span>
          </span>
        </label>

        <label class="flex items-center justify-between">
          <span class="font-semibold text-gray-800">Analityczne</span>
          <span class="relative inline-flex items-center">
            <input id="cb-analytics" type="checkbox" class="sr-only peer">
            <span class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-indigo-600 transition-colors duration-300"></span>
            <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300 peer-checked:translate-x-5"></span>
          </span>
        </label>

        <label class="flex items-center justify-between">
          <span class="font-semibold text-gray-800">Marketingowe</span>
          <span class="relative inline-flex items-center">
            <input id="cb-marketing" type="checkbox" class="sr-only peer">
            <span class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-indigo-600 transition-colors duration-300"></span>
            <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300 peer-checked:translate-x-5"></span>
          </span>
        </label>
      </div>

      <div class="mt-8 flex flex-wrap gap-3 justify-end">
        <button id="cb-accept" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Akceptuję wszystkie</button>
        <button id="cb-decline" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition">Odrzucam</button>
        <button id="cb-save" class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 transition">Zapisz wybór</button>
      </div>
    </div>
  </div>`;

  /** ====== Pływający przycisk ====== */
  const floatingBtnHTML = `
    <button id="cb-manage"
            class="fixed bottom-6 left-6 flex items-center justify-center
                   w-12 h-12 rounded-full
                   bg-indigo-500/90 text-white shadow-lg backdrop-blur
                   hover:bg-indigo-600 transition-colors duration-300 z-[9998]"
            aria-label="Zarządzaj ustawieniami cookies">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
           class="lucide lucide-settings">
        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06
                 a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09
                 a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83
                 l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09
                 a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83
                 l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09
                 a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83
                 l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09
                 a1.65 1.65 0 0 0-1.51 1z"/>
      </svg>
    </button>`;

  /** ====== Helpers ====== */
  function parseConsent(raw) {
    try { return JSON.parse(raw); }
    catch { return { analytics:false, marketing:false, timestamp:0 }; }
  }

  function applySavedConsent() {
    const raw = localStorage.getItem(storageKey);
    if (!raw) return;
    const consent = parseConsent(raw);
    gtag('consent', 'update', {
      analytics_storage:    consent.analytics ? 'granted' : 'denied',
      ad_storage:           consent.marketing ? 'granted' : 'denied',
      ad_user_data:         consent.marketing ? 'granted' : 'denied',
      ad_personalization:   consent.marketing ? 'granted' : 'denied',
      functionality_storage:'granted',
      security_storage:     'granted'
    });
  }

  /** Focus trap w obrębie bannera */
  function trapFocus(modalEl) {
    const focusableSelectors = [
      'a[href]','area[href]','input:not([disabled])',
      'button:not([disabled])','textarea:not([disabled])',
      'select:not([disabled])','[tabindex]:not([tabindex="-1"])'
    ];
    const focusable = Array.from(modalEl.querySelectorAll(focusableSelectors.join(',')));
    if (focusable.length === 0) return;
    const firstEl = focusable[0];
    const lastEl = focusable[focusable.length - 1];

    function keyListener(e) {
      if (e.key === 'Tab') {
        if (e.shiftKey && document.activeElement === firstEl) {
          e.preventDefault(); lastEl.focus();
        } else if (!e.shiftKey && document.activeElement === lastEl) {
          e.preventDefault(); firstEl.focus();
        }
      }
      if (e.key === 'Escape') closeBanner();
    }

    modalEl.addEventListener('keydown', keyListener);
    firstEl.focus();
    return () => modalEl.removeEventListener('keydown', keyListener);
  }

  function closeBanner() {
    const overlay = document.getElementById("cb-overlay");
    if (overlay) overlay.remove();
    showFloatingButton();
  }

  function renderBanner(initialState = {}) {
    document.getElementById("cb-overlay")?.remove();
    const wrap = document.createElement("div");
    wrap.innerHTML = bannerHTML.trim();
    document.body.appendChild(wrap.firstChild);

    const overlay   = document.getElementById("cb-overlay");
    const analytics = document.getElementById("cb-analytics");
    const marketing = document.getElementById("cb-marketing");
    const modalDiv  = overlay.querySelector('div');

    analytics.checked = !!initialState.analytics;
    marketing.checked = !!initialState.marketing;

    function saveConsent(consent, reload = false) {
      consent.timestamp = Date.now();
      localStorage.setItem(storageKey, JSON.stringify(consent));
      document.dispatchEvent(new CustomEvent("consentUpdated", { detail: consent }));
      overlay.remove();
      applySavedConsent();
      showFloatingButton();
      if (reload) location.reload();
    }

    document.getElementById("cb-accept").onclick  = () => saveConsent({analytics:true,  marketing:true}, true);
    document.getElementById("cb-decline").onclick = () => saveConsent({analytics:false, marketing:false}, true);
    document.getElementById("cb-save").onclick    = () => saveConsent({analytics: analytics.checked, marketing: marketing.checked}, false);

    // kliknięcie w tło
    overlay.addEventListener('click', (e) => { if (e.target === overlay) closeBanner(); });

    const removeTrap = trapFocus(modalDiv);
    overlay.addEventListener('remove', () => { if (removeTrap) removeTrap(); });
  }

  function showFloatingButton() {
    if (document.getElementById("cb-manage")) return;
    const btnWrap = document.createElement("div");
    btnWrap.innerHTML = floatingBtnHTML.trim();
    document.body.appendChild(btnWrap.firstChild);
    document.getElementById("cb-manage").onclick = () => {
      const saved = parseConsent(localStorage.getItem(storageKey) || "{}");
      renderBanner(saved);
    };
  }

  /** ====== Init ====== */
  document.addEventListener("DOMContentLoaded", () => {
    const savedConsentRaw = localStorage.getItem(storageKey);
    let needConsent = true;
    if (savedConsentRaw) {
      const saved = parseConsent(savedConsentRaw);
      if (saved.timestamp) {
        const ageDays = (Date.now() - saved.timestamp) / (1000*60*60*24);
        if (ageDays < consentValidityDays) {
          needConsent = false;
          applySavedConsent();
          showFloatingButton();
        }
      }
    }
    if (needConsent) renderBanner();
  });
})();
