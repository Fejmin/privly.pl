<?php
$meta = [
  'title'       => 'Bezpieczne notatki jednorazowe online – Privly.pl',
  'description' => 'Twórz bezpieczne jednorazowe notatki online z hasłem, limitami otwarć i czasem wygasania. Bezpieczne wiadomości jednorazowe dla firm i osób prywatnych.',
  'keywords'    => 'bezpieczne notatki, jednorazowe wiadomości, prywatne linki, szyfrowanie, notatki online, privly',
  'canonical'   => 'https://privly.pl/',
  'og:image'    => 'https://privly.pl/assets/img/privly.svg'
];
require __DIR__ . '/partials/header.php';

/** @var array|null  $noteMeta */
/** @var string|null $plainText */
/** @var string|null $errorMessage */
$noteLines = isset($plainText) ? (substr_count($plainText, "\n") + 1) : 0;
$rows = max(5, min(20, $noteLines));
?>
<main class="max-w-3xl mx-auto px-4 py-12 space-y-10 pt-28">
<?php if (!empty($errorMessage)): ?>

<div class="bg-white border border-gray-200 rounded-xl shadow p-8 text-center relative">
  <div class="flex justify-center mb-4">
    <i data-lucide="alert-triangle" class="w-12 h-12 text-red-500"></i>
  </div>
  <h1 class="text-2xl font-semibold mb-2 text-red-600">Błąd</h1>
  <p class="text-gray-700 mb-6"><?= htmlspecialchars($errorMessage) ?></p>
  <div class="text-center">
    <a href="/" class="btn-primary inline-flex px-6 py-3 rounded-xl font-semibold items-center gap-2">
      <i data-lucide="plus"></i> Utwórz nową notatkę
    </a>
  </div>
</div>

<?php else: ?>

  <!-- Step 1 -->
  <section id="step1" class="relative text-center bg-white p-8 rounded-xl shadow">
    <button id="helpBtn" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" title="Pomoc">
      <i data-lucide="circle-question-mark" class="w-6 h-6"></i>
    </button>
    <p class="text-lg mb-6">Twoja bezpieczna wiadomość jest gotowa.</p>
    <button id="previewBtn" class="btn-primary px-6 py-3 rounded-xl font-semibold text-lg shadow flex items-center gap-2 mx-auto">
      <i data-lucide="search"></i> Wyświetl notatkę
    </button>
  </section>

  <!-- Pomoc -->
  <div id="helpOverlay">
    <div class="bg-white rounded-xl max-w-lg w-full p-8 overflow-y-auto max-h-[90vh] shadow-2xl m-2">
      <h2 class="text-2xl font-bold mb-4 text-center flex items-center justify-center gap-2">
        <i data-lucide="circle-question-mark" class="w-6 h-6 text-[#fd6927]"></i>
        Sekcja pomocy
      </h2>
      <div class="space-y-4 text-gray-700">
        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
          <p class="font-semibold mb-1">Co to jest?</p>
          <p>Privly.pl to bezpieczny sposób udostępniania poufnych informacji, który ulega samozniszczeniu po jednorazowym wyświetleniu.</p>
        </div>
        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
          <p class="font-semibold mb-1">Czy jest bezpieczny?</p>
          <p>Tak. Po wyświetleniu, sekret jest trwale usuwany z naszych serwerów, co zapewnia Twoją prywatność.</p>
        </div>
        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
          <p class="font-semibold mb-1">Co dalej?</p>
          <p>Gdy będziesz gotowy, kliknij przycisk u góry strony, aby wyświetlić jednorazową wiadomość.</p>
        </div>
      </div>
      <div class="text-center mt-6">
        <button id="closeHelp" class="btn-primary px-6 py-2 rounded-lg">Zamknij</button>
      </div>
    </div>
  </div>

  <!-- Hasło -->
  <section id="passwordBox" class="hidden">
    <div class="bg-white p-6 rounded-xl shadow">
      <p class="text-lg mb-4 text-center">Ta notatka jest <span class="font-semibold">zabezpieczona hasłem.</span></p>
      <input id="notePassword" type="password"
             class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-[#fd6927]"
             placeholder="Wpisz hasło">
      <div class="flex gap-3 justify-center mt-4">
        <button id="unlockBtn" class="btn-primary px-6 py-2 rounded-lg font-semibold">Odszyfruj</button>
        <button id="cancelPreview" class="px-4 py-2 rounded-lg border hover:bg-gray-100">Anuluj</button>
      </div>
      <p id="passError" class="text-red-600 text-sm mt-3 text-center"></p>
    </div>
  </section>

  <!-- Treść notatki -->
  <section id="noteContent" class="hidden">
    <div class="bg-white p-6 rounded-xl shadow">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl">Treść notatki</h2>
        <div class="relative">
          <button id="copyNote" class="btn-primary px-4 py-1.5 text-sm rounded-lg flex items-center gap-1">
            <i data-lucide="copy" class="w-4 h-4 copy-note-icon"></i>
            <span class="copy-note-text">Kopiuj</span>
          </button>
          <span id="copyTooltip" class="absolute -top-6 left-1/2 -translate-x-1/2 text-xs bg-black text-white rounded px-2 py-1">Skopiowano!</span>
        </div>
      </div>

      <textarea id="noteText" readonly rows="<?= $rows ?>"
        class="border border-gray-300 rounded-xl p-4 bg-gray-50 w-full resize-y max-h-[45rem] overflow-y-auto font-mono text-sm"></textarea>

      <div class="grid gap-6 md:grid-cols-2 mt-8">
        <div id="viewsBox" class="hidden progress-box">
          <div class="progress-title">
            <span>Otwarcia</span>
            <span id="viewsCount"></span>
          </div>
          <div class="progress-track"><div id="viewsProgress" class="progress-fill"></div></div>
        </div>

        <div id="expireBox" class="hidden progress-box">
          <div class="progress-title">
            <span id="expireLabel">Wygasa</span>
            <span id="expireTimerText"></span>
          </div>
          <div class="progress-track"><div id="expireProgress" class="progress-fill"></div></div>
        </div>

        <div id="sentEmailCard" class="hidden progress-box md:col-span-2">
          <h3 class="text-lg font-semibold mb-2">Wiadomość wysłano na adres</h3>
          <div class="flex items-center gap-2 relative">
            <span id="sentEmail" class="text-sm text-gray-700 font-mono"></span>
            <button id="copyEmail" class="text-gray-500 hover:text-gray-700 relative flex items-center">
              <i data-lucide="copy" class="w-5 h-5 copy-email-icon"></i>
              <span class="email-tooltip absolute -top-6 left-1/2 -translate-x-1/2 text-xs bg-black text-white rounded px-2 py-1">Skopiowano!</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>
</main>
<style>
  body{font-family:'Inter',sans-serif;background:#f8fafc;}
  .btn-primary{background:#0e2653;color:#fff;transition:background .3s,transform .2s;}
  .btn-primary:hover{background:#fd6927;transform:translateY(-1px);}
  .progress-box{background:#fff;border:1px solid #e5e7eb;border-radius:0.75rem;padding:1.5rem;box-shadow:0 1px 3px rgba(0,0,0,0.1);}
  .progress-title{display:flex;justify-content:space-between;align-items:center;margin-bottom:.5rem;font-weight:600;font-size:.95rem;color:#374151;}
  .progress-track{position:relative;height:1rem;background:#e5e7eb;border-radius:9999px;overflow:hidden;}
  .progress-fill{position:absolute;top:0;left:0;height:100%;width:0;transition:width .4s ease;}
  #viewsProgress{background:#fd6927;}
  #expireProgress{background:#16a34a;}
  .copy-success-btn{background:#16a34a!important;color:#fff!important;}
  .copy-success-icon{stroke:#fff!important;}
  #copyTooltip,
  .email-tooltip{opacity:0;transition:opacity .3s;}
  #copyTooltip.show,
  .email-tooltip.show{opacity:1;}
  .email-copied{color:#16a34a!important;animation:pulse .6s ease;}
  @keyframes pulse{0%{transform:scale(1);}50%{transform:scale(1.2);}100%{transform:scale(1);}}
  #helpOverlay{position:fixed;inset:0;background:rgba(0,0,0,.6);display:none;justify-content:center;align-items:center;z-index:50;}
  #helpOverlay.show{display:flex;}
</style>
<script>


const helpBtn=document.getElementById('helpBtn');
const helpOverlay=document.getElementById('helpOverlay');
const closeHelp=document.getElementById('closeHelp');
helpBtn?.addEventListener('click',()=>helpOverlay.classList.add('show'));
closeHelp?.addEventListener('click',()=>helpOverlay.classList.remove('show'));
helpOverlay?.addEventListener('click',e=>{if(e.target===helpOverlay)helpOverlay.classList.remove('show');});

const previewBtn=document.getElementById('previewBtn');
const passwordBox=document.getElementById('passwordBox');
const unlockBtn=document.getElementById('unlockBtn');
const cancelBtn=document.getElementById('cancelPreview');
const passInput=document.getElementById('notePassword');
const passError=document.getElementById('passError');
const noteContent=document.getElementById('noteContent');

async function post(data){
  const res=await fetch('',{
    method:'POST',
    headers:{'X-Requested-With':'XMLHttpRequest'},
    body:new URLSearchParams(data)
  });
  return res.json();
}

// 🚀 request do confirmView po poprawnym odszyfrowaniu
async function confirmView() {
  const res = await fetch(window.location.pathname + '/confirm', {
    method: 'POST',
    headers: { 'X-Requested-With':'XMLHttpRequest' }
  });
  return res.json();
}

// ✅ tylko meta na starcie
document.addEventListener('DOMContentLoaded', async () => {
  const meta = await post({ meta: 1 });
  if (meta.error) {
    showError(meta.error);
    return;
  }

  if (!meta.password_protected && !window.location.hash.substring(1)) {
    document.getElementById('step1')?.classList.add('hidden');
    showError("Notatka nie istnieje lub wygasła.");
  }
});

function showError(msg) {
  const main=document.querySelector('main');
  main.innerHTML=`
    <div class="bg-white border border-gray-200 rounded-xl shadow p-8 text-center relative">
      <div class="flex justify-center mb-4">
        <i data-lucide="alert-triangle" class="w-12 h-12 text-red-500"></i>
      </div>
      <h1 class="text-2xl font-semibold mb-2 text-red-600">Błąd</h1>
      <p class="text-gray-700 mb-6">${msg}</p>
      <div class="text-center">
        <a href="/" class="btn-primary inline-flex px-6 py-3 rounded-xl font-semibold items-center gap-2">
          <i data-lucide="plus"></i> Utwórz nową notatkę
        </a>
      </div>
    </div>`;
  lucide.createIcons();
}

previewBtn?.addEventListener('click', async () => {
  const meta = await post({ meta: 1 });
  if (meta.error) {
    window.location.reload();
    return;
  }
  document.getElementById('step1').classList.add('hidden');

  if (meta.password_protected) {
    passwordBox.classList.remove('hidden');
  } else {
    fetchNote('');
  }
});

unlockBtn?.addEventListener('click',()=>fetchNote(passInput.value));
cancelBtn?.addEventListener('click',()=>{
  passwordBox.classList.add('hidden');
  document.getElementById('step1').classList.remove('hidden');
});

async function fetchNote(password) {
  const data = await post({});
  if (data.error) { 
    passError.textContent = data.error; 
    return; 
  }

  if (data.password_protected && !password) {
    passError.textContent = "Wpisz hasło.";
    return;
  }

  try {
    const ivBytes  = Uint8Array.from(atob(data.iv), c => c.charCodeAt(0));
    const cipherBytes = Uint8Array.from(atob(data.ciphertext), c => c.charCodeAt(0));
    let cryptoKey;

    if (data.password_protected) {
      const saltBytes = Uint8Array.from(atob(data.salt), c => c.charCodeAt(0));
      const encPw = new TextEncoder().encode(password);
      const baseKey = await crypto.subtle.importKey("raw", encPw, "PBKDF2", false, ["deriveKey"]);
      cryptoKey = await crypto.subtle.deriveKey(
        {name:"PBKDF2", salt:saltBytes, iterations:100000, hash:"SHA-256"},
        baseKey,
        {name:"AES-GCM", length:256},
        false,
        ["decrypt"]
      );
    } else {
      const keyBase64 = window.location.hash.substring(1);
      if (!keyBase64) {
        passError.textContent = "Brak klucza w linku (#...).";
        return;
      }
      const keyBytes = Uint8Array.from(atob(keyBase64), c => c.charCodeAt(0));
      cryptoKey = await crypto.subtle.importKey("raw", keyBytes, "AES-GCM", false, ["decrypt"]);
    }

    // próba deszyfracji
    const plainBuffer = await crypto.subtle.decrypt({ name: "AES-GCM", iv: ivBytes }, cryptoKey, cipherBytes);
    const plainText = new TextDecoder().decode(plainBuffer);

    // ✅ dopiero po udanym odszyfrowaniu wysyłamy confirmView
    const confirm = await confirmView();
    if (confirm.error) {
      showError(confirm.error);
      return;
    }

    // ✅ chowamy box hasła i pokazujemy treść
    passwordBox.classList.add('hidden');
    noteContent.classList.remove('hidden');
    document.getElementById('noteText').value = plainText;

    // ✅ limity dopiero po confirm
    if (confirm.max_views > 0) {
      document.getElementById('viewsBox').classList.remove('hidden');
      const percent = Math.min(100, (confirm.views / confirm.max_views) * 100);
      document.getElementById('viewsCount').textContent = `${confirm.views} / ${confirm.max_views}`;
      document.getElementById('viewsProgress').style.width = percent + '%';
    }

    if (data.expire_at) {
      document.getElementById('expireBox').classList.remove('hidden');
      startExpireTimer(new Date(data.expire_at));
    }

    if (data.sent_email) {
      document.getElementById('sentEmailCard').classList.remove('hidden');
      document.getElementById('sentEmail').textContent = data.sent_email;
    }

  } catch(e) {
    passError.textContent = "Nie udało się odszyfrować notatki. Błędne hasło lub uszkodzone dane.";
    return;
  }
}

function startExpireTimer(expireDate) {
  const progress = document.getElementById('expireProgress');
  const text = document.getElementById('expireTimerText');
  const label = document.getElementById('expireLabel');

  const expireMs = expireDate.getTime();
  const totalMs = expireMs - Date.now();

  function formatTime(ms) {
    const totalSec = Math.floor(ms / 1000);
    const days = Math.floor(totalSec / 86400);
    const hours = Math.floor((totalSec % 86400) / 3600);
    const mins = Math.floor((totalSec % 3600) / 60);
    const secs = totalSec % 60;

    // zawsze pokazuj sekundy
    let str = '';
    if (days > 0) str += `${days}d `;
    if (hours > 0 || days > 0) str += `${hours}h `;
    if (mins > 0 || hours > 0 || days > 0) str += `${mins}m `;
    str += `${secs}s`;

    return str.trim();
  }

  function tick() {
    const remain = expireMs - Date.now();
    if (remain <= 0) {
      text.textContent = 'Wygasła';
      label.classList.add('text-red-600');
      progress.style.width = '0%';
      clearInterval(timer);
      return;
    }

    const pct = Math.max(0, (remain / totalMs) * 100);
    progress.style.width = pct + '%';
    text.textContent = formatTime(remain);
  }

  tick(); // od razu ustaw wartość
  const timer = setInterval(tick, 1000); // aktualizacja co sekundę
}




// Kopiowanie notatki
document.getElementById('copyNote')?.addEventListener('click',()=>{
  const btn=document.getElementById('copyNote');
  const icon=btn.querySelector('.copy-note-icon');
  const text=btn.querySelector('.copy-note-text');
  navigator.clipboard.writeText(document.getElementById('noteText').value);
  btn.classList.add('copy-success-btn');
  icon.classList.add('copy-success-icon');
  text.textContent='Skopiowano';
  const tooltip=document.getElementById('copyTooltip');
  tooltip.classList.add('show');
  setTimeout(()=>{
    tooltip.classList.remove('show');
    btn.classList.remove('copy-success-btn');
    icon.classList.remove('copy-success-icon');
    text.textContent='Kopiuj';
  },1500);
});

// Kopiowanie maila
document.getElementById('copyEmail')?.addEventListener('click',()=>{
  const emailBtn=document.getElementById('copyEmail');
  const icon=emailBtn.querySelector('.copy-email-icon');
  const tooltip=emailBtn.querySelector('.email-tooltip');
  const emailText=document.getElementById('sentEmail').textContent;
  navigator.clipboard.writeText(emailText);
  icon.classList.add('email-copied');
  tooltip.classList.add('show');
  setTimeout(()=>{
    icon.classList.remove('email-copied');
    tooltip.classList.remove('show');
  },1500);
});
</script>

<?php
  require __DIR__ . '/partials/footer.php';
?>
