<?php
// Geçerli dili belirle
$allowed_langs = ['tr', 'en', 'ru', 'de'];
$lang = isset($_GET['lang']) && in_array($_GET['lang'], $allowed_langs) ? $_GET['lang'] : 'tr';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#1a0a00">
    <title>The Chef Restaurant — QR Menü</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              chef: {
                bg:    '#E8D9BA',
                card:  '#FAF5EB',
                ink:   '#2a1000',
                brown: '#7b2d00',
                gold:  '#c4622d',
                cream: '#FAF5EB',
                line:  '#D9CEBC',
                mute:  '#7b4a28',
                panel: '#F1E8D0'
              }
            },
            fontFamily: {
              display: ['"Abril Fatface"', 'serif'],
              sans:    ['Inter', 'sans-serif']
            }
          }
        }
      }
    </script>
    <style>
        .brown-divider { background: linear-gradient(90deg, transparent, #c4622d, transparent); }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background-color: #000000; overflow-x: hidden; }

        #root, #root *, #root *::before, #root *::after {
            transition: background-color 0.4s ease, border-color 0.4s ease, color 0.4s ease, box-shadow 0.4s ease, filter 0.4s ease !important;
        }
        .filled-input {
            background-color: #eaf1fd !important;
        }
        #res-form input:focus, #res-form select:focus, #res-form textarea:focus {
            outline: none !important;
            border-color: #c4622d !important;
            box-shadow: 0 0 0 4px rgba(196, 98, 45, 0.15) !important;
        }

        /* DEFAULT THEME - WARM PARCHMENT BACKGROUND, CUSTOM NAVBARS */
        /* Renk Paleti:
           Navbar BG (değişmez): #F1E8D0 — sıcak krem/parşömen
           Ana BG:               #EFE5CC — navbar ile uyumlu, biraz daha koyu
           Kart BG:              #FAF5EB — açık krem / neredeyse beyaz
           Birincil vurgu:       #7b2d00 — koyu kahve (logo rengi)
           İkincil vurgu:        #c4622d — turuncu-kahve (logo vurgu)
           Kenarlık:             #D9CEBC — sıcak ten rengi kenarlık
           Metin ana:            #2a1000 — neredeyse siyah kahve
           Metin ikincil:        #7b4a28 — orta kahve
        */
        #root { background-color: #E8D9BA !important; color: #2a1000 !important; border-color: #D9CEBC !important; box-shadow: 0 0 50px rgba(0,0,0,0.05) !important; }
        
        /* Navbars - Sabit (değiştirilmedi) */
        header, .sticky-search-bar, .footer-bar { 
            background-color: #F1E8D0 !important; 
            border-color: #D9CEBC !important; 
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
        }
        .header-logo-text { color: #7b2d00 !important; }
        .header-pill-btn { background-color: #FAF5EB !important; border-color: #D9CEBC !important; color: #2a1000 !important; box-shadow: none !important; transform: none !important; }
        .header-pill-btn:hover { border-color: #c4622d !important; color: #7b2d00 !important; }
        
        /* Search Bar */
        #search-input { background-color: #FAF5EB !important; border-color: #D9CEBC !important; color: #2a1000 !important; box-shadow: none !important; }
        #search-input::placeholder { color: #9a7055 !important; font-weight: normal !important; }
        #search-input:focus { border-color: #c4622d !important; box-shadow: none !important; }
        
        /* Footer Links */
        .footer-bar a { color: #7b2d00 !important; transform: none !important; }
        .footer-bar a:hover { color: #c4622d !important; transform: none !important; }
        header .text-chef-ink, .sticky-search-bar .text-chef-ink { color: #2a1000 !important; }

        /* Cards & Content Elements */
        .menu-item { 
            background-color: #FAF5EB !important; 
            border-color: #D9CEBC !important; 
            border-radius: 12px !important;
            box-shadow: 0 2px 8px rgba(123,45,0,0.06) !important; 
            transform: none !important;
        }
        .menu-item:hover { 
            border-color: #c4622d !important; 
            transform: none !important;
            box-shadow: 0 4px 14px rgba(196,98,45,0.12) !important; 
        }
        
        /* Typography */
        #menu-content .text-chef-ink, #menu-content h3, #menu-content h4 { color: #2a1000 !important; letter-spacing: normal !important; }
        #menu-content h3 { opacity: 1 !important; margin-bottom: 0.5rem !important; }
        #menu-content .text-chef-mute { color: #7b4a28 !important; font-weight: normal !important; }
        #reservation h3 { color: #2a1000 !important; }

        /* Reservation Form */
        #res-form { background-color: #FAF5EB !important; border-color: #D9CEBC !important; border-radius: 16px !important; box-shadow: 0 4px 20px rgba(123,45,0,0.07) !important; padding: 20px !important; }
        #res-form label { color: #7b4a28 !important; font-weight: normal !important; font-size: 0.65rem !important; letter-spacing: 0.05em; }
        #res-form input, #res-form select, #res-form textarea { background-color: #FDF8F0 !important; border-color: #D9CEBC !important; color: #2a1000 !important; border-radius: 8px !important; color-scheme: light !important; }
        #res-form input:focus, #res-form select:focus, #res-form textarea:focus { border-color: #c4622d !important; background-color: #FAF5EB !important; box-shadow: none !important; }
        select option { background-color: #FAF5EB; color: #2a1000; }
        input[type="date"]::-webkit-calendar-picker-indicator, input[type="time"]::-webkit-calendar-picker-indicator { cursor: pointer; filter: invert(0.7) brightness(0.3) sepia(1) hue-rotate(330deg) saturate(4); }
        
        /* Modals & Dropdowns */
        #lang-dropdown { background-color: #FAF5EB !important; border-radius: 8px !important; border-color: #D9CEBC !important; box-shadow: 0 8px 24px rgba(123,45,0,0.10) !important; }
        #lang-dropdown a { color: #2a1000 !important; font-weight: normal !important; }
        #lang-dropdown a:hover { background-color: #F1E8D0 !important; color: #7b2d00 !important; }
        
        /* Category Tabs */
        .tab-btn { border-radius: 9999px !important; font-weight: normal !important; border: 1px solid transparent !important; }
        .tab-btn.active-tab { background-color: #7b2d00 !important; color: #FAF5EB !important; border-color: #7b2d00 !important; box-shadow: none !important; }
        .tab-btn:not(.active-tab) { background-color: #FAF5EB !important; color: #2a1000 !important; border-color: #D9CEBC !important; box-shadow: none !important; }
        .tab-btn:not(.active-tab):hover { background-color: #F1E8D0 !important; border-color: #c4622d !important; transform: none !important; }
        body.light-mode button.bg-chef-card { background-color: #e8dcc4 !important; }

        #theme-toggle .moon-icon { display: block; }
        #theme-toggle .sun-icon  { display: none; }
        body.light-mode #theme-toggle .moon-icon { display: none; }
        body.light-mode #theme-toggle .sun-icon  { display: block; }

        #toast {
            position: fixed; bottom: 80px; left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: #c4622d; color: #fff; font-weight: 600;
            font-size: 13px; padding: 12px 24px; border-radius: 8px;
            z-index: 9999; transition: transform 0.4s ease, opacity 0.4s ease !important; opacity: 0;
        }
        #toast.show { transform: translateX(-50%) translateY(0); opacity: 1; }

        .logo-svg-text {
            font-family: 'Abril Fatface', serif;
            font-size: 22px;
            fill: #c4622d;
        }
        .logo-sub-text {
            font-family: 'Inter', sans-serif;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.25em;
            fill: #9a7055;
            text-transform: uppercase;
        }
        .cat-banner-label {
            font-family: 'Abril Fatface', serif;
            letter-spacing: 0.1em;
        }

        /* Hero gradient overlay */
        .hero-overlay {
            background: linear-gradient(to bottom, rgba(26,10,0,0.3) 0%, rgba(26,10,0,0.85) 100%);
        }
        body.light-mode .hero-overlay {
            background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.65) 100%);
        }

        /* Active tab */
        .tab-btn.active-tab {
            background-color: #7b2d00 !important;
            color: #f5e6d0 !important;
            border-color: #7b2d00 !important;
            font-weight: 700;
        }

        /* Reservation spin */
        @keyframes spin { to { transform: rotate(360deg); } }
        .spinner { animation: spin 1s linear infinite; }
    </style>
</head>
<body>

<!-- ══════════════ LOADER ══════════════ -->
<div id="chef-loader" style="
    position: fixed;
    inset: 0;
    z-index: 9999;
    background-color: #F5EDD6;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 28px;
    transition: opacity 0.5s ease, visibility 0.5s ease;
">
    <!-- Logo -->
    <div style="animation: loaderPop 0.6s cubic-bezier(0.34,1.56,0.64,1) forwards; opacity:0;">
        <img src="logo.png" alt="The Chef Restaurant" style="height: 110px; filter: drop-shadow(0 4px 16px rgba(123,45,0,0.18));">
    </div>

    <!-- Animated dots -->
    <div style="display:flex; gap: 10px; align-items:center;">
        <span class="loader-dot" style="--d:0s"></span>
        <span class="loader-dot" style="--d:0.15s"></span>
        <span class="loader-dot" style="--d:0.3s"></span>
    </div>
</div>

<style>
    @keyframes loaderPop {
        from { opacity: 0; transform: scale(0.7) translateY(20px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    @keyframes dotBounce {
        0%, 80%, 100% { transform: scale(0.6); opacity: 0.3; }
        40%            { transform: scale(1.2); opacity: 1; }
    }
    .loader-dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #7b2d00;
        animation: dotBounce 1.2s ease-in-out var(--d) infinite;
    }
    #chef-loader.hide {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
</style>

<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            document.getElementById('chef-loader').classList.add('hide');
        }, 1500);
    });
</script>

<div id="root" class="relative min-h-screen bg-chef-bg text-chef-ink flex flex-col w-full max-w-[600px] mx-auto border-x border-chef-line/30 shadow-[0_0_50px_rgba(0,0,0,0.7)]">

    <!-- ══════════════ HEADER ══════════════ -->
    <header class="sticky top-0 z-40 bg-chef-panel/95 backdrop-blur-md border-b border-chef-line/60">
        <div class="px-4 py-3 flex items-center justify-between gap-2">
            <!-- LOGO -->
            <a href="?lang=<?php echo $lang; ?>" class="shrink-0 flex items-center gap-2">
                <img src="logo.png" alt="The Chef Restaurant" style="height: 54px;">
            </a>

            <!-- NAV BUTTONS -->
            <div class="flex items-center gap-2 relative">
                <button onclick="scrollToReservation()" class="res-nav-btn flex items-center gap-1.5 rounded-full border border-chef-gold/70 bg-chef-gold/10 px-2.5 py-1.5 text-[10px] font-semibold text-chef-gold hover:bg-chef-gold hover:text-white transition whitespace-nowrap tracking-wide shrink-0">
                    <i class="fa-regular fa-calendar text-[10px]"></i>
                    <span id="nav-res-text">Rezervasyon</span>
                </button>
                <button onclick="toggleWifiModal()" class="header-pill-btn flex items-center justify-center w-8 h-8 rounded-full border border-chef-line/70 bg-chef-card hover:border-chef-gold/60 transition shrink-0">
                    <i class="fa-solid fa-wifi text-chef-gold text-sm"></i>
                </button>
                <div class="relative">
                    <button id="lang-btn" onclick="toggleLangMenu()" class="header-pill-btn flex items-center gap-1 rounded-full border border-chef-line/70 bg-chef-card px-2.5 py-1.5 text-[11px] font-medium text-chef-ink hover:border-chef-gold/60 transition shrink-0">
                        <i class="fa-solid fa-globe text-chef-gold text-[10px]"></i>
                        <span id="current-lang-text">TR</span>
                        <i class="fa-solid fa-chevron-down text-chef-mute text-[9px]"></i>
                    </button>
                    <div id="lang-dropdown" class="hidden absolute right-0 top-full mt-2 w-20 bg-chef-card border border-chef-line rounded-lg shadow-xl overflow-hidden flex flex-col z-50">
                        <button onclick="setLang('tr')" class="w-full text-left px-4 py-2 text-sm text-chef-ink hover:bg-chef-gold/20">TR</button>
                        <button onclick="setLang('en')" class="w-full text-left px-4 py-2 text-sm text-chef-ink hover:bg-chef-gold/20">EN</button>
                        <button onclick="setLang('ru')" class="w-full text-left px-4 py-2 text-sm text-chef-ink hover:bg-chef-gold/20">RU</button>
                        <button onclick="setLang('de')" class="w-full text-left px-4 py-2 text-sm text-chef-ink hover:bg-chef-gold/20">DE</button>
                    </div>
                </div>
            </div>
        </div>
    </header>



    <!-- ══════════════ STICKY SEARCH + TABS ══════════════ -->
    <div class="sticky-search-bar sticky top-[78px] z-30 bg-chef-panel/95 backdrop-blur-md border-b border-chef-line/60 mb-2">
        <div class="px-3 pt-4 pb-2">
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-chef-mute">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input id="search-input" onkeyup="handleSearch()" data-i18n-placeholder="search" placeholder="Ürün ara..." class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-chef-card border border-chef-line text-chef-ink placeholder:text-chef-mute text-sm focus:outline-none focus:border-chef-gold/60 transition" type="text">
            </div>
        </div>
        <div class="px-3 pt-2 pb-3">
            <div id="category-tabs" class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1"></div>
        </div>
    </div>

    <!-- ══════════════ MENU CONTENT ══════════════ -->
    <div id="menu-content" class="flex-1 pb-4"></div>
    <div id="no-results" class="hidden text-center py-10 text-chef-mute font-display text-lg italic" data-i18n="no_results">Sonuç bulunamadı.</div>

    <!-- ══════════════ RESERVATION FORM ══════════════ -->
    <div id="reservation" class="px-3 mt-6 mb-[30px]">
        <div class="text-center mb-4">
            <h3 class="font-display text-2xl tracking-widest uppercase text-chef-ink" data-i18n="res_title">Rezervasyon</h3>
            <div class="brown-divider h-px w-24 mx-auto mt-2"></div>
        </div>
        <form id="res-form" novalidate onsubmit="submitReservation(event)" class="bg-chef-card border border-chef-line p-5 rounded-2xl space-y-4 shadow-md shadow-chef-brown/10">
            <div>
                <label class="block text-[10px] uppercase tracking-wider text-chef-mute mb-1" data-i18n="res_name">Ad Soyad</label>
                <input type="text" id="res-name" class="w-full bg-chef-bg border border-chef-line rounded-lg px-3 py-2 text-sm text-chef-ink focus:border-chef-gold outline-none transition">
                <p id="err-name" class="hidden text-red-400 text-[10px] mt-1"></p>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-chef-mute mb-1" data-i18n="res_phone">Telefon</label>
                    <input type="tel" id="res-phone" placeholder="05XX XXX XX XX" class="w-full bg-chef-bg border border-chef-line rounded-lg px-3 py-2 text-sm text-chef-ink focus:border-chef-gold outline-none transition placeholder:text-chef-mute/50">
                    <p id="err-phone" class="hidden text-red-400 text-[10px] mt-1"></p>
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-chef-mute mb-1" data-i18n="res_guests">Kişi Sayısı</label>
                    <input type="number" id="res-guests" min="1" max="50" placeholder="2" class="w-full bg-chef-bg border border-chef-line rounded-lg px-3 py-2 text-sm text-chef-ink focus:border-chef-gold outline-none transition placeholder:text-chef-mute/50">
                    <p id="err-guests" class="hidden text-red-400 text-[10px] mt-1"></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-chef-mute mb-1" data-i18n="res_date">Tarih</label>
                    <input type="date" id="res-date" class="w-full bg-chef-bg border border-chef-line rounded-lg px-3 py-2 text-sm text-chef-ink focus:border-chef-gold outline-none transition" style="color-scheme: dark;">
                    <p id="err-date" class="hidden text-red-400 text-[10px] mt-1"></p>
                </div>
                <div>
                    <label class="block text-[10px] uppercase tracking-wider text-chef-mute mb-1" data-i18n="res_time">Saat</label>
                    <select id="res-time" class="w-full bg-chef-bg border border-chef-line rounded-lg px-3 py-2 text-sm text-chef-ink focus:border-chef-gold outline-none transition">
                        <option value="">--</option>
                        <option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option>
                        <option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option>
                        <option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option>
                        <option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option>
                        <option>22:00</option>
                    </select>
                    <p id="err-time" class="hidden text-red-400 text-[10px] mt-1"></p>
                </div>
            </div>
            <div>
                <label class="block text-[10px] uppercase tracking-wider text-chef-mute mb-1" data-i18n="res_note">Not</label>
                <textarea id="res-note" rows="2" class="w-full bg-chef-bg border border-chef-line rounded-lg px-3 py-2 text-sm text-chef-ink focus:border-chef-gold outline-none transition"></textarea>
            </div>
            <button type="submit" id="res-btn" class="w-full bg-chef-brown text-white font-display tracking-widest uppercase text-sm py-3 rounded-xl hover:bg-chef-gold transition flex items-center justify-center gap-2">
                <span data-i18n="res_btn">Rezervasyon Yap</span>
            </button>
        </form>
    </div>

    <!-- ══════════════ FOOTER ══════════════ -->
    <div class="footer-bar sticky bottom-0 z-40 bg-chef-panel/95 backdrop-blur-md border-t border-chef-line/60 px-4 py-2 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="?lang=<?php echo $lang; ?>" class="shrink-0 flex items-center">
                <img src="logo.png" alt="The Chef Restaurant" style="height: 38px;">
            </a>
        </div>
        <div class="flex items-center gap-2">
            <a href="https://www.instagram.com/thechefmahmutlar/" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full text-chef-ink/80 hover:text-chef-gold transition"><i class="fa-brands fa-instagram text-lg"></i></a>
            <a href="https://www.tripadvisor.com.tr/Restaurant_Review-g1193628-d16759338-Reviews-The_Chef_Restaurant-Mahmutlar_Turkish_Mediterranean_Coast.html" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full text-chef-ink/80 hover:text-chef-gold transition"><svg class="w-[20px] h-[20px] fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.006 4.295c-2.67 0-5.338.784-7.645 2.353H0l1.963 2.135a5.997 5.997 0 0 0 4.04 10.43 5.976 5.976 0 0 0 4.075-1.6L12 19.705l1.922-2.09a5.972 5.972 0 0 0 4.072 1.598 6 6 0 0 0 6-5.998 5.982 5.982 0 0 0-1.957-4.432L24 6.648h-4.35a13.573 13.573 0 0 0-7.644-2.353zM12 6.255c1.531 0 3.063.303 4.504.903C13.943 8.138 12 10.43 12 13.1c0-2.671-1.942-4.962-4.504-5.942A11.72 11.72 0 0 1 12 6.256zM6.002 9.157a4.059 4.059 0 1 1 0 8.118 4.059 4.059 0 0 1 0-8.118zm11.992.002a4.057 4.057 0 1 1 .003 8.115 4.057 4.057 0 0 1-.003-8.115zm-11.992 1.93a2.128 2.128 0 0 0 0 4.256 2.128 2.128 0 0 0 0-4.256zm11.992 0a2.128 2.128 0 0 0 0 4.256 2.128 2.128 0 0 0 0-4.256z"/></svg></a>
            <a href="https://wa.me/905422521982" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-full text-chef-ink/80 hover:text-chef-gold transition"><i class="fa-brands fa-whatsapp text-lg"></i></a>
        </div>
    </div>
</div>

<!-- ══════════════ WIFI MODAL ══════════════ -->
<div id="wifi-modal" class="fixed inset-0 z-[70] flex items-center justify-center pointer-events-none" style="opacity:0;transition:opacity 0.3s ease;">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeWifiModal()"></div>
    <div id="wifi-modal-card" class="rounded-3xl w-[85%] max-w-[340px] p-7 text-center shadow-2xl relative" style="background-color:#FAF5EB;transform:scale(0.85) translateY(20px);transition:transform 0.35s cubic-bezier(0.34,1.56,0.64,1),opacity 0.3s ease;opacity:0;" onclick="event.stopPropagation()">
        <button onclick="closeWifiModal()" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full transition text-lg" style="background-color:#EFE5CC;color:#9a7055;">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-5" style="background-color:#EFE5CC;">
            <i class="fa-solid fa-wifi text-3xl text-[#c4622d]"></i>
        </div>
        <h3 class="font-bold text-xl mb-5" style="color:#2a1000;" id="wifi-title">WiFi Bilgileri</h3>
        <div class="rounded-2xl overflow-hidden mb-5 text-left" style="background-color:#EFE5CC;border:1px solid #D9CEBC;">
            <div class="flex items-center justify-between px-5 py-3.5" style="border-bottom:1px solid #D9CEBC;">
                <span class="font-semibold text-sm" style="color:#7b4a28;" id="wifi-ssid-label">Ağ Adı:</span>
                <span class="font-semibold text-sm" style="color:#2a1000;">TheChef_Guest</span>
            </div>
            <div class="flex items-center justify-between px-5 py-3.5">
                <span class="font-semibold text-sm" style="color:#7b4a28;" id="wifi-pass-label">Şifre:</span>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-sm" style="color:#2a1000;">chef2024</span>
                    <button onclick="copyWifiPass()" class="text-[#c4622d] hover:text-[#9e4e22] transition">
                        <i class="fa-regular fa-copy text-base"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ══════════════ PRODUCT MODAL ══════════════ -->
<div id="item-modal" class="fixed inset-0 z-[60] bg-black/80 backdrop-blur-sm hidden flex items-end justify-center opacity-0 duration-300" style="transition: opacity 0.3s ease;">
    <div id="item-modal-content" class="w-full max-w-[600px] bg-chef-card rounded-t-[32px] overflow-hidden transform translate-y-full shadow-[0_-10px_40px_rgba(0,0,0,0.6)]" style="transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);">
        <div id="drag-handle-area" class="w-full relative cursor-grab active:cursor-grabbing">
            <div class="absolute top-4 left-1/2 -translate-x-1/2 w-12 h-1.5 bg-white/40 rounded-full z-20"></div>
            <button onclick="closeModal()" class="absolute top-4 right-4 w-8 h-8 bg-black/60 text-white rounded-full flex items-center justify-center z-20 hover:bg-black/90 transition">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
            <div class="w-full h-[35vh] min-h-[240px] relative">
                <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-black/60 to-transparent z-10 pointer-events-none"></div>
                <img id="modal-img" src="" class="w-full h-full object-cover">
            </div>
        </div>
        <div class="p-6 pb-10 bg-chef-card border-t border-chef-line/40">
            <h2 id="modal-title" class="font-display text-3xl text-chef-ink tracking-wide mb-2"></h2>
            <p id="modal-desc" class="text-[13px] text-chef-mute leading-relaxed mb-6"></p>
            <div class="flex items-center justify-between">
                <span id="modal-price" class="text-chef-gold text-2xl font-bold tracking-wider"></span>
                <span class="text-[10px] text-chef-mute/60 tracking-widest uppercase">The Chef Restaurant</span>
            </div>
        </div>
    </div>
</div>

<div id="toast"></div>

<script>
// ─── I18N ─────────────────────────────────────────────────
const I18N = {
    tr: {
        food: "Yemek", beverage: "İçecek", search: "Ürün ara...", no_results: "Sonuç bulunamadı.",
        res_title: "Rezervasyon", res_name: "Ad Soyad", res_phone: "Telefon",
        res_date: "Tarih", res_time: "Saat", res_note: "Not", res_btn: "Rezervasyon Yap",
        res_success: "Rezervasyon talebiniz alındı",
        res_guests: "Kişi Sayısı",
        err_name: "Lütfen adınızı tam giriniz.", err_phone: "Geçerli bir telefon numarası giriniz.",
        err_guests: "Kişi sayısı giriniz.", err_date: "Lütfen geçerli bir tarih seçiniz.",
        err_time: "Lütfen saat seçiniz.", copied: "Şifre kopyalandı!",
        nav_res: "Rezervasyon",
        wifi_title: "WiFi Bilgileri", wifi_ssid: "Ağ Adı:", wifi_pass: "Şifre:",
        wifi_hint: "QR kodu telefonunuzla tarayarak WiFi'ye bağlanabilirsiniz"
    },
    en: {
        food: "Food", beverage: "Beverage", search: "Search...", no_results: "No results found.",
        res_title: "Reservation", res_name: "Full Name", res_phone: "Phone",
        res_date: "Date", res_time: "Time", res_note: "Note", res_btn: "Book a Table",
        res_success: "Reservation received! We will call you shortly.",
        res_guests: "Guests",
        err_name: "Please enter your full name.", err_phone: "Please enter a valid phone number.",
        err_guests: "Please enter guest count.", err_date: "Please select a valid date.",
        err_time: "Please select a time.", copied: "Password copied!",
        nav_res: "Reservation",
        wifi_title: "WiFi Info", wifi_ssid: "Network:", wifi_pass: "Password:",
        wifi_hint: "Scan the QR code with your phone to connect to WiFi"
    },
    ru: {
        food: "Еда", beverage: "Напитки", search: "Поиск...", no_results: "Ничего не найдено.",
        res_title: "Бронирование", res_name: "Имя Фамилия", res_phone: "Телефон",
        res_date: "Дата", res_time: "Время", res_note: "Заметка", res_btn: "Забронировать",
        res_success: "Запрос на бронирование получен! Мы вам перезвоним.",
        res_guests: "Гости",
        err_name: "Введите ваше полное имя.", err_phone: "Введите действительный номер телефона.",
        err_guests: "Введите количество гостей.", err_date: "Выберите действительную дату.",
        err_time: "Выберите время.", copied: "Пароль скопирован!",
        nav_res: "Бронь",
        wifi_title: "WiFi", wifi_ssid: "Сеть:", wifi_pass: "Пароль:",
        wifi_hint: "Отсканируйте QR-код для подключения к WiFi"
    },
    de: {
        food: "Essen", beverage: "Getränke", search: "Suchen...", no_results: "Keine Ergebnisse.",
        res_title: "Reservierung", res_name: "Vollständiger Name", res_phone: "Telefon",
        res_date: "Datum", res_time: "Zeit", res_note: "Notiz", res_btn: "Tisch reservieren",
        res_success: "Reservierungsanfrage erhalten! Wir rufen Sie zurück.",
        res_guests: "Gäste",
        err_name: "Bitte geben Sie Ihren vollen Namen ein.", err_phone: "Bitte eine gültige Telefonnummer eingeben.",
        err_guests: "Bitte Gästezahl eingeben.", err_date: "Bitte ein gültiges Datum wählen.",
        err_time: "Bitte Uhrzeit auswählen.", copied: "Passwort kopiert!",
        nav_res: "Reservierung",
        wifi_title: "WLAN-Daten", wifi_ssid: "Netzwerk:", wifi_pass: "Passwort:",
        wifi_hint: "QR-Code scannen um WLAN zu verbinden"
    }
};

// ─── MENU DATA ─────────────────────────────────────────────
const MENU = [
    {
        id: "starters",
        name: { tr: "BAŞLANGIÇLAR", en: "STARTERS", ru: "ЗАКУСКИ", de: "VORSPEISEN" },
        items: [
            { name: { tr: "Çorba Günlük", en: "Soup of the Day", ru: "Суп дня", de: "Tagessuppe" },
              price: "₺180", desc: { tr: "Şefin günlük seçimi", en: "Chef's daily selection", ru: "Выбор шефа", de: "Tagesauswahl des Kochs" },
              img: "https://images.unsplash.com/photo-1547592166-23ac45744acd?w=600&h=600&fit=crop" },
            { name: { tr: "Mezze Tabağı", en: "Mezze Plate", ru: "Мезе", de: "Mezze-Teller" },
              price: "₺220", desc: { tr: "Humus, haydari, ezme, patlıcan salatası", en: "Hummus, haydari, ezme, eggplant salad", ru: "Хумус, хайдари, эзме, баклажанный салат", de: "Hummus, Haydari, Ezme, Auberginensalat" },
              img: "https://images.unsplash.com/photo-1541014741259-de529411b96a?w=600&h=600&fit=crop" },
            { name: { tr: "Sigara Böreği", en: "Cheese Rolls", ru: "Сигара бёрек", de: "Käseröllchen" },
              price: "₺160", desc: { tr: "Peynirli çıtır yufka rulo, 6 adet", en: "Crispy pastry rolls with cheese, 6 pcs", ru: "Хрустящие рулетики с сыром, 6 шт", de: "Knusprige Käserollen, 6 Stück" },
              img: "https://images.unsplash.com/photo-1601050690597-df0568f70950?w=600&h=600&fit=crop" },
            { name: { tr: "Kalamar Tava", en: "Fried Calamari", ru: "Жареный кальмар", de: "Frittierter Tintenfisch" },
              price: "₺280", desc: { tr: "Çıtır kalamar halkaları, sarımsaklı yoğurt sos ile", en: "Crispy calamari rings with garlic yogurt sauce", ru: "Хрустящие кольца кальмаров с чесночным соусом", de: "Knusprige Tintenfischringe mit Knoblauch-Joghurt-Sauce" },
              img: "https://images.unsplash.com/photo-1604909052743-94e838986d24?w=600&h=600&fit=crop" },
        ]
    },
    {
        id: "salads",
        name: { tr: "SALATALAR", en: "SALADS", ru: "САЛАТЫ", de: "SALATE" },
        items: [
            { name: { tr: "Çoban Salatası", en: "Shepherd's Salad", ru: "Чобан салатаси", de: "Hirtensalat" },
              price: "₺150", desc: { tr: "Domates, salatalık, soğan, maydanoz, limon", en: "Tomato, cucumber, onion, parsley, lemon", ru: "Помидоры, огурцы, лук, петрушка, лимон", de: "Tomaten, Gurken, Zwiebeln, Petersilie, Zitrone" },
              img: "https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&h=600&fit=crop" },
            { name: { tr: "Akdeniz Salatası", en: "Mediterranean Salad", ru: "Средиземноморский салат", de: "Mediterraner Salat" },
              price: "₺190", desc: { tr: "Karışık yeşillikler, zeytin, beyaz peynir, nar ekşisi", en: "Mixed greens, olives, white cheese, pomegranate molasses", ru: "Смешанная зелень, оливки, белый сыр, гранатовый соус", de: "Blattsalat, Oliven, Weißkäse, Granatapfelmelasse" },
              img: "https://images.unsplash.com/photo-1540420773420-3366772f4999?w=600&h=600&fit=crop" },
            { name: { tr: "Sezar Salata", en: "Caesar Salad", ru: "Салат Цезарь", de: "Caesar Salat" },
              price: "₺210", desc: { tr: "Marul, parmesan, kruton, sezar sos, tavuk seçeneği ile", en: "Romaine, parmesan, croutons, caesar dressing, optional chicken", ru: "Романо, пармезан, крутоны, соус Цезарь, куриный вариант", de: "Romanasalat, Parmesan, Croutons, Caesar-Dressing" },
              img: "https://images.unsplash.com/photo-1550304943-4f24f54ddde9?w=600&h=600&fit=crop" },
        ]
    },
    {
        id: "mains",
        name: { tr: "ANA YEMEKLER", en: "MAIN COURSES", ru: "ОСНОВНЫЕ БЛЮДА", de: "HAUPTGERICHTE" },
        items: [
            { name: { tr: "Kuzu Tandır", en: "Lamb Tandır", ru: "Ягнёнок тандыр", de: "Lamm Tandir" },
              price: "₺680", desc: { tr: "Yavaş pişirilmiş kuzu but, pilav ve ızgara sebze ile", en: "Slow-cooked lamb leg, served with rice and grilled vegetables", ru: "Медленно томлёная баранья нога с рисом и овощами", de: "Langsam gegartes Lammkeule, mit Reis und gegrilltem Gemüse" },
              img: "https://images.unsplash.com/photo-1529006557810-274b9b2fc783?w=600&h=600&fit=crop" },
            { name: { tr: "Şef'in Bifteği", en: "Chef's Steak", ru: "Стейк шефа", de: "Kochsteak" },
              price: "₺890", desc: { tr: "200g dana kontrfile, mantar sos, patates püresi ile", en: "200g sirloin, mushroom sauce, with mashed potatoes", ru: "200г говяжья вырезка, грибной соус, картофельное пюре", de: "200g Rindersirloin, Pilzsoße, mit Kartoffelpüree" },
              img: "https://images.unsplash.com/photo-1558030006-450675393462?w=600&h=600&fit=crop" },
            { name: { tr: "Tavuk Şiş", en: "Chicken Shish", ru: "Куриный шашлык", de: "Hähnchenspieß" },
              price: "₺380", desc: { tr: "Marine edilmiş tavuk şiş, pilav ve közlenmiş biber ile", en: "Marinated chicken skewers, with rice and roasted peppers", ru: "Маринованный куриный шашлык, рис и жареный перец", de: "Marinierte Hähnchenspiße, mit Reis und gerösteten Paprika" },
              img: "https://images.unsplash.com/photo-1603360946369-dc9bb6258143?w=600&h=600&fit=crop" },
            { name: { tr: "Levrek Izgara", en: "Grilled Sea Bass", ru: "Жареный лаврак", de: "Gegrillter Wolfsbarsch" },
              price: "₺520", desc: { tr: "Taze levrek, limon tereyağı sos, mevsim salata ile", en: "Fresh sea bass, lemon butter sauce, seasonal salad", ru: "Свежий лаврак, соус из лимонного масла, сезонный салат", de: "Frischer Wolfsbarsch, Zitronenbutter-Sauce, Saisonsalat" },
              img: "https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=600&h=600&fit=crop" },
            { name: { tr: "Mantı", en: "Turkish Dumplings", ru: "Манты", de: "Türkische Teigtaschen" },
              price: "₺290", desc: { tr: "El yapımı mantı, sarımsaklı yoğurt ve tereyağlı salça ile", en: "Handmade dumplings, garlic yogurt and buttered tomato sauce", ru: "Домашние манты, чесночный йогурт и томатный соус", de: "Handgemachte Teigtaschen, Knoblauch-Joghurt, Tomatensauce" },
              img: "https://images.unsplash.com/photo-1574894709920-11b28e7367e3?w=600&h=600&fit=crop" },
        ]
    },
    {
        id: "pizza-pasta",
        name: { tr: "PİZZA & MAKARNA", en: "PIZZA & PASTA", ru: "ПИЦЦА & ПАСТА", de: "PIZZA & PASTA" },
        items: [
            { name: { tr: "Margarita Pizza", en: "Margherita Pizza", ru: "Пицца Маргарита", de: "Margherita Pizza" },
              price: "₺350", desc: { tr: "Domates sosu, mozzarella, taze fesleğen", en: "Tomato sauce, mozzarella, fresh basil", ru: "Томатный соус, моцарелла, свежий базилик", de: "Tomatensoße, Mozzarella, frisches Basilikum" },
              img: "https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=600&h=600&fit=crop" },
            { name: { tr: "Karışık Pizza", en: "Mixed Pizza", ru: "Смешанная пицца", de: "Gemischte Pizza" },
              price: "₺420", desc: { tr: "Sucuk, mantar, biber, soğan, mozzarella", en: "Sausage, mushroom, pepper, onion, mozzarella", ru: "Колбаса, грибы, перец, лук, моцарелла", de: "Wurst, Pilze, Paprika, Zwiebeln, Mozzarella" },
              img: "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&h=600&fit=crop" },
            { name: { tr: "Fettuccine Alfredo", en: "Fettuccine Alfredo", ru: "Феттучини Альфредо", de: "Fettuccine Alfredo" },
              price: "₺320", desc: { tr: "Kremalı alfredo sos, parmesan, tavuk veya mantar", en: "Creamy alfredo sauce, parmesan, chicken or mushroom", ru: "Сливочный соус Альфредо, пармезан, курица или грибы", de: "Cremige Alfredo-Sauce, Parmesan, Hühnchen oder Pilze" },
              img: "https://images.unsplash.com/photo-1555949258-eb67b1ef0ceb?w=600&h=600&fit=crop" },
        ]
    },
    {
        id: "grill",
        name: { tr: "IZGARA SEÇKİLERİ", en: "GRILL", ru: "ГРИЛЬ", de: "GRILLGERICHTE" },
        items: [
            { name: { tr: "Karışık Izgara", en: "Mixed Grill", ru: "Смешанный гриль", de: "Gemischter Grill" },
              price: "₺750", desc: { tr: "Adana, urfa, tavuk, köfte, pide ve salata ile", en: "Adana, urfa, chicken, meatballs with pide and salad", ru: "Адана, урфа, курица, фрикадельки с пита и салатом", de: "Adana, Urfa, Hähnchen, Fleischbällchen mit Fladenbrot und Salat" },
              img: "https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&h=600&fit=crop" },
            { name: { tr: "Adana Kebap", en: "Adana Kebab", ru: "Адана Кебаб", de: "Adana Kebab" },
              price: "₺420", desc: { tr: "Acılı köfte şiş, pilav ve söğüş ile", en: "Spicy meatball skewer with rice and fresh vegetables", ru: "Острый мясной шашлык с рисом и свежими овощами", de: "Scharfer Fleischspieß mit Reis und frischem Gemüse" },
              img: "https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=600&h=600&fit=crop" },
            { name: { tr: "Piliç Kanat", en: "Chicken Wings", ru: "Куриные крылышки", de: "Hähnchenflügel" },
              price: "₺320", desc: { tr: "Marine edilmiş kanat, acı veya klasik sos seçeneği", en: "Marinated wings, spicy or classic sauce option", ru: "Маринованные крылышки, острый или классический соус", de: "Marinierte Flügel, scharf oder klassische Sauce" },
              img: "https://images.unsplash.com/photo-1527477396000-e27163b481c2?w=600&h=600&fit=crop" },
        ]
    },
    {
        id: "desserts",
        name: { tr: "TATLILAR", en: "DESSERTS", ru: "ДЕСЕРТЫ", de: "DESSERTS" },
        items: [
            { name: { tr: "Baklava", en: "Baklava", ru: "Пахлава", de: "Baklava" },
              price: "₺180", desc: { tr: "Fıstıklı geleneksel Türk baklavası, kaymak ile", en: "Traditional Turkish pistachio baklava with clotted cream", ru: "Традиционная турецкая пахлава с фисташками и кремом", de: "Traditionelle türkische Pistazienbaklava mit Sahne" },
              img: "https://images.unsplash.com/photo-1519915028121-7d3463d20b13?w=600&h=600&fit=crop" },
            { name: { tr: "Sütlaç", en: "Rice Pudding", ru: "Рисовый пудинг", de: "Milchreis" },
              price: "₺130", desc: { tr: "Fırın sütlaç, tarçın ile servis edilir", en: "Oven-baked rice pudding, served with cinnamon", ru: "Рисовый пудинг запечённый, подаётся с корицей", de: "Ofengebackener Milchreis mit Zimt" },
              img: "https://images.unsplash.com/photo-1551024506-0bccd828d307?w=600&h=600&fit=crop" },
            { name: { tr: "Cheesecake", en: "Cheesecake", ru: "Чизкейк", de: "Käsekuchen" },
              price: "₺200", desc: { tr: "Ev yapımı cheesecake, mevsim meyvesi ile", en: "Homemade cheesecake with seasonal fruit", ru: "Домашний чизкейк с сезонными фруктами", de: "Hausgemachter Cheesecake mit Saisonfrüchten" },
              img: "https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=600&h=600&fit=crop" },
            { name: { tr: "Profiterol", en: "Profiterole", ru: "Профитроли", de: "Profiteroles" },
              price: "₺170", desc: { tr: "Çikolata soslu profiterol, dondurma ile", en: "Chocolate sauce profiterole with ice cream", ru: "Профитроли с шоколадным соусом и мороженым", de: "Profiteroles mit Schokoladensauce und Eis" },
              img: "https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=600&h=600&fit=crop" },
        ]
    },
    {
        id: "drinks",
        name: { tr: "İÇECEKLER", en: "BEVERAGES", ru: "НАПИТКИ", de: "GETRÄNKE" },
        items: [
            { name: { tr: "Türk Çayı", en: "Turkish Tea", ru: "Турецкий чай", de: "Türkischer Tee" },
              price: "₺40", desc: { tr: "Demlik çay, şeker ve küçük kurabiye ile", en: "Brewed tea with sugar and small cookies", ru: "Заварной чай с сахаром и печеньем", de: "Aufgebrühter Tee mit Zucker und Keksen" },
              img: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=600&h=600&fit=crop" },
            { name: { tr: "Türk Kahvesi", en: "Turkish Coffee", ru: "Турецкий кофе", de: "Türkischer Kaffee" },
              price: "₺80", desc: { tr: "Geleneksel Türk kahvesi, çikolata ile", en: "Traditional Turkish coffee with chocolate", ru: "Традиционный турецкий кофе с шоколадом", de: "Traditioneller türkischer Kaffee mit Schokolade" },
              img: "https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=600&h=600&fit=crop" },
            { name: { tr: "Taze Sıkma Portakal", en: "Fresh Orange Juice", ru: "Свежевыжатый апельсин", de: "Frisch gepresster Orangensaft" },
              price: "₺120", desc: { tr: "Günlük taze sıkılmış portakal suyu", en: "Daily freshly squeezed orange juice", ru: "Ежедневно свежевыжатый апельсиновый сок", de: "Täglich frisch gepresster Orangensaft" },
              img: "https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=600&h=600&fit=crop" },
            { name: { tr: "Ayran", en: "Ayran", ru: "Айран", de: "Ayran" },
              price: "₺60", desc: { tr: "Ev yapımı soğuk ayran", en: "Homemade cold ayran", ru: "Домашний холодный айран", de: "Hausgemachter kalter Ayran" },
              img: "https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=600&h=600&fit=crop" },
            { name: { tr: "Limonata", en: "Lemonade", ru: "Лимонад", de: "Limonade" },
              price: "₺110", desc: { tr: "Taze limonata, nane veya çilek seçeneği ile", en: "Fresh lemonade, with mint or strawberry option", ru: "Свежий лимонад с мятой или клубникой", de: "Frische Limonade mit Minze oder Erdbeer" },
              img: "https://images.unsplash.com/photo-1554306274-f23873d9a26c?w=600&h=600&fit=crop" },
            { name: { tr: "Meşrubat", en: "Soft Drinks", ru: "Безалкогольные напитки", de: "Erfrischungsgetränke" },
              price: "₺80", desc: { tr: "Cola, Fanta, Sprite, Soda", en: "Cola, Fanta, Sprite, Soda", ru: "Кола, Фанта, Спрайт, Содовая", de: "Cola, Fanta, Sprite, Soda" },
              img: "https://images.unsplash.com/photo-1581636625402-29b2a704ef13?w=600&h=600&fit=crop" },
        ]
    }
];

// ─── STATE ─────────────────────────────────────────────────
let currentLang = '<?php echo $lang; ?>';
if (currentLang.startsWith('<?php')) {
    currentLang = 'tr'; // Fallback if opened without PHP server
}
let menuObserver = null;
let isClickScrolling = false;
let scrollTimeout = null;

// ─── INIT ─────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    applyLang(currentLang);
    renderMenu();
    setupObserver();
    setupModalDrag();

    const today = new Date().toISOString().split('T')[0];
    document.getElementById('res-date').setAttribute('min', today);

    // Input kısıtlamaları
    const nameInput = document.getElementById('res-name');
    const phoneInput = document.getElementById('res-phone');
    if (nameInput) {
        nameInput.addEventListener('input', function() {
            this.value = this.value.replace(/[0-9]/g, ''); // Rakamları engelle
        });
    }
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9+\s()]/g, ''); // Harfleri engelle
        });
    }

    ['name','phone','guests','date','time'].forEach(id => {
        document.getElementById(`res-${id}`).addEventListener('input', () => clearError(id));
    });

    // Dinamik input doluluk kontrolü
    const checkFilled = (el) => {
        if (el.value.trim() !== '') el.classList.add('filled-input');
        else el.classList.remove('filled-input');
    };
    document.querySelectorAll('#res-form input, #res-form select, #res-form textarea').forEach(el => {
        el.addEventListener('input', () => checkFilled(el));
        el.addEventListener('change', () => checkFilled(el));
        checkFilled(el); // Sayfa yüklendiğinde ilk kontrol
    });

    if (localStorage.getItem('chef-theme') === 'light') document.body.classList.add('light-mode');

    document.getElementById('item-modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
});

// ─── LANG ─────────────────────────────────────────────────
function setLang(lang) {
    currentLang = lang;
    applyLang(lang);
    renderMenu();
    document.getElementById('lang-dropdown').classList.add('hidden');
    
    // Sayfa yenilenmeden URL'yi güncelle
    const url = new URL(window.location);
    url.searchParams.set('lang', lang);
    window.history.pushState({}, '', url);
}

function applyLang(lang) {
    const t = I18N[lang];
    document.documentElement.lang = lang;
    document.getElementById('current-lang-text').textContent = lang.toUpperCase();
    document.getElementById('nav-res-text').textContent = t.nav_res;
    document.getElementById('search-input').placeholder = t.search;

    // Static i18n elements
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (t[key]) el.textContent = t[key];
    });
    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
        const key = el.dataset['i18nPlaceholder'];
        if (t[key]) el.placeholder = t[key];
    });

    // Wifi modal
    document.getElementById('wifi-title').textContent = t.wifi_title;
    document.getElementById('wifi-ssid-label').textContent = t.wifi_ssid;
    document.getElementById('wifi-pass-label').textContent = t.wifi_pass;

    // Form labels
    document.querySelectorAll('#res-form label[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (t[key]) el.textContent = t[key];
    });
}

// ─── RENDER MENU ──────────────────────────────────────────
function renderMenu() {
    const t = I18N[currentLang];
    const tabsEl = document.getElementById('category-tabs');
    const contentEl = document.getElementById('menu-content');
    tabsEl.innerHTML = '';
    contentEl.innerHTML = '';

    MENU.forEach((cat, i) => {
        // Tab
        const tab = document.createElement('button');
        tab.dataset.target = cat.id;
        tab.onclick = () => scrollToCat(cat.id);
        tab.className = `tab-btn flex-shrink-0 px-3 py-2 rounded-full text-[11px] tracking-[0.12em] uppercase border transition cursor-pointer whitespace-nowrap hover:border-chef-gold/60 ${i === 0 ? 'active-tab' : 'bg-chef-card text-chef-ink/80 border-chef-line'}`;
        tab.textContent = cat.name[currentLang];
        tabsEl.appendChild(tab);

        // Section
        const sec = document.createElement('div');
        sec.id = cat.id;
        sec.className = 'menu-section px-3 mt-3';
        sec.innerHTML = `
            <div class="text-center mb-4">
                <h3 class="font-display text-xl tracking-[0.18em] uppercase text-chef-ink">${cat.name[currentLang]}</h3>
                <div class="brown-divider h-px w-24 mx-auto mt-1"></div>
            </div>
            <div class="space-y-3">
                ${cat.items.map(item => {
                    const name = item.name[currentLang];
                    const desc = item.desc[currentLang];
                    const searchKey = (name + ' ' + desc).toLowerCase();
                    return `
                    <div class="menu-item group text-left w-full min-h-[96px] rounded-xl overflow-hidden bg-chef-card border border-chef-line hover:border-chef-gold transition-colors duration-300 flex"
                         data-name="${searchKey}">
                        <div class="flex-1 p-3 flex flex-col justify-between">
                            <div>
                                <h4 class="font-display text-sm text-chef-ink tracking-wide leading-tight">${name}</h4>
                                <p class="text-[11px] text-chef-mute mt-1 leading-relaxed line-clamp-2">${desc}</p>
                            </div>
                            <div class="mt-2"><span class="text-chef-gold font-semibold text-sm">${item.price}</span></div>
                        </div>
                    </div>`;
                }).join('')}
            </div>`;
        contentEl.appendChild(sec);
    });

    if (menuObserver) {
        menuObserver.disconnect();
        setupObserver();
    }
}

// ─── OBSERVER ─────────────────────────────────────────────
function setupObserver() {
    menuObserver = new IntersectionObserver(entries => {
        if (isClickScrolling) return;
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    const isActive = btn.dataset.target === entry.target.id;
                    btn.classList.toggle('active-tab', isActive);
                    btn.classList.toggle('bg-chef-card', !isActive);
                    btn.classList.toggle('text-chef-ink/80', !isActive);
                    btn.classList.toggle('border-chef-line', !isActive);
                    if (isActive) btn.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                });
            }
        });
    }, { rootMargin: '-190px 0px -50% 0px' });

    setTimeout(() => {
        document.querySelectorAll('.menu-section').forEach(s => menuObserver.observe(s));
    }, 300);
}

// ─── SEARCH ───────────────────────────────────────────────
function handleSearch() {
    const q = document.getElementById('search-input').value.toLowerCase();
    let count = 0;
    document.querySelectorAll('.menu-section').forEach(sec => {
        let visible = false;
        sec.querySelectorAll('.menu-item').forEach(item => {
            const match = item.dataset.name.includes(q);
            item.style.display = match ? 'flex' : 'none';
            if (match) { visible = true; count++; }
        });
        sec.style.display = visible ? 'block' : 'none';
    });
    document.getElementById('no-results').style.display = count === 0 ? 'block' : 'none';
}

// ─── NAVIGATION ───────────────────────────────────────────
function scrollToCat(id) {
    const el = document.getElementById(id);
    if (el) {
        isClickScrolling = true;
        clearTimeout(scrollTimeout);
        window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - 210, behavior: 'smooth' });
        // Tıklanan tab'ın anında güncellenmesini sağla (Observer'ı beklemeden)
        document.querySelectorAll('.tab-btn').forEach(btn => {
            const isActive = btn.dataset.target === id;
            btn.classList.toggle('active-tab', isActive);
            btn.classList.toggle('bg-chef-card', !isActive);
            btn.classList.toggle('text-chef-ink/80', !isActive);
            btn.classList.toggle('border-chef-line', !isActive);
            if (isActive) btn.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        });
        scrollTimeout = setTimeout(() => { isClickScrolling = false; }, 800);
    }
}
function scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); }
function scrollToReservation() {
    const el = document.getElementById('reservation');
    // Mobilde üst menü (header + tabs) yüksekliği yaklaşık 210px olduğu için offset güncellendi, böylece başlık gizlenmeyecek.
    if (el) window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - 210, behavior: 'smooth' });
}

// ─── LANG DROPDOWN ────────────────────────────────────────
function toggleLangMenu() { document.getElementById('lang-dropdown').classList.toggle('hidden'); }
document.addEventListener('click', e => {
    if (!e.target.closest('#lang-btn') && !e.target.closest('#lang-dropdown')) {
        document.getElementById('lang-dropdown').classList.add('hidden');
    }
});

// ─── THEME ────────────────────────────────────────────────
function toggleTheme() {
    document.body.classList.toggle('light-mode');
    localStorage.setItem('chef-theme', document.body.classList.contains('light-mode') ? 'light' : 'dark');
}

// ─── WIFI ─────────────────────────────────────────────────
function toggleWifiModal() {
    const modal = document.getElementById('wifi-modal');
    const card = document.getElementById('wifi-modal-card');
    const open = modal.style.opacity === '1';
    if (open) { closeWifiModal(); return; }
    modal.style.pointerEvents = 'auto';
    modal.style.opacity = '1';
    card.style.transform = 'scale(1) translateY(0)';
    card.style.opacity = '1';
}
function closeWifiModal() {
    const modal = document.getElementById('wifi-modal');
    const card = document.getElementById('wifi-modal-card');
    card.style.transform = 'scale(0.85) translateY(20px)';
    card.style.opacity = '0';
    modal.style.opacity = '0';
    setTimeout(() => modal.style.pointerEvents = 'none', 300);
}
function copyWifiPass() {
    navigator.clipboard.writeText('chef2024').then(() => showToast(I18N[currentLang].copied));
}

// ─── PRODUCT MODAL ────────────────────────────────────────
function openModal(name, desc, price, img) {
    document.getElementById('modal-img').src = img;
    document.getElementById('modal-title').textContent = name;
    document.getElementById('modal-desc').textContent = desc;
    document.getElementById('modal-price').textContent = price;
    const modal = document.getElementById('item-modal');
    const content = document.getElementById('item-modal-content');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        modal.style.opacity = '1';
        content.style.transform = 'translateY(0)';
        document.body.style.overflow = 'hidden';
    });
}
function closeModal() {
    const modal = document.getElementById('item-modal');
    const content = document.getElementById('item-modal-content');
    modal.style.opacity = '0';
    content.style.transform = 'translateY(100%)';
    document.body.style.overflow = '';
    setTimeout(() => { modal.classList.add('hidden'); content.style.transform = ''; }, 300);
}

// ─── MODAL DRAG ───────────────────────────────────────────
function setupModalDrag() {
    const handle = document.getElementById('drag-handle-area');
    const content = document.getElementById('item-modal-content');
    let startY = 0, currentY = 0, dragging = false;

    handle.addEventListener('touchstart', e => { startY = e.touches[0].clientY; dragging = true; content.style.transition = 'none'; }, { passive: true });
    handle.addEventListener('touchmove', e => { if (!dragging) return; currentY = e.touches[0].clientY; const d = currentY - startY; if (d > 0) content.style.transform = `translateY(${d}px)`; }, { passive: true });
    handle.addEventListener('touchend', () => {
        if (!dragging) return; dragging = false;
        content.style.transition = 'transform 0.3s cubic-bezier(0.4,0,0.2,1)';
        if (currentY - startY > 120) closeModal(); else content.style.transform = '';
    });
    handle.addEventListener('mousedown', e => { startY = e.clientY; dragging = true; content.style.transition = 'none'; });
    document.addEventListener('mousemove', e => { if (!dragging) return; currentY = e.clientY; const d = currentY - startY; if (d > 0) content.style.transform = `translateY(${d}px)`; });
    document.addEventListener('mouseup', () => {
        if (!dragging) return; dragging = false;
        content.style.transition = 'transform 0.3s cubic-bezier(0.4,0,0.2,1)';
        if (currentY - startY > 120) closeModal(); else content.style.transform = '';
    });
}

// ─── TOAST ────────────────────────────────────────────────
function showToast(msg) {
    const toast = document.getElementById('toast');
    toast.textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3500);
}

// ─── RESERVATION → ntfy ───────────────────────────────────
async function submitReservation(e) {
    e.preventDefault();
    const t = I18N[currentLang];
    let valid = true;

    const name   = document.getElementById('res-name').value.trim();
    const phone  = document.getElementById('res-phone').value.trim();
    const guests = document.getElementById('res-guests').value.trim();
    const date   = document.getElementById('res-date').value;
    const time   = document.getElementById('res-time').value;
    const note   = document.getElementById('res-note').value.trim();

    // Clear
    ['name','phone','guests','date','time'].forEach(clearError);

    if (name.length < 3)                    { showError('name',   t.err_name);   valid = false; }
    if (phone.replace(/\D/g,'').length < 10){ showError('phone',  t.err_phone);  valid = false; }
    if (!guests || parseInt(guests) < 1)    { showError('guests', t.err_guests); valid = false; }
    if (!date) {
        showError('date', t.err_date); valid = false;
    } else {
        const sel = new Date(date); const today = new Date(); today.setHours(0,0,0,0);
        if (sel < today) { showError('date', t.err_date); valid = false; }
    }
    if (!time) { showError('time', t.err_time); valid = false; }

    if (!valid) return;

    const btn = document.getElementById('res-btn');
    btn.disabled = true;
    btn.innerHTML = `<i class="fa-solid fa-circle-notch spinner"></i>`;

    const body = `📋 YENİ REZERVASYON\n━━━━━━━━━━━━━━━━━━\n👤 Ad Soyad: ${name}\n📞 Telefon: ${phone}\n👥 Kişi Sayısı: ${guests}\n📅 Tarih: ${date}\n🕐 Saat: ${time}${note ? `\n📝 Not: ${note}` : ''}\n━━━━━━━━━━━━━━━━━━`;

    try {
        // ntfy.sh üzerinden bildirim gönder
        // TOPIC'i kendi ntfy topic adınızla değiştirin
        const NTFY_TOPIC = 'thechef_rezervasyon'; // ← Buraya kendi topic adınızı yazın

        await fetch(`https://ntfy.sh/${NTFY_TOPIC}`, {
            method: 'POST',
            body: body
        });

        btn.disabled = false;
        btn.innerHTML = `<span data-i18n="res_btn">${t.res_btn}</span>`;
        showToast(t.res_success);
        document.getElementById('res-form').reset();
    } catch (err) {
        btn.disabled = false;
        btn.innerHTML = `<span>${t.res_btn}</span>`;
        showToast('Bağlantı hatası. Lütfen tekrar deneyin.');
    }
}

function showError(id, msg) {
    const el = document.getElementById(`err-${id}`);
    const input = document.getElementById(`res-${id}`);
    el.textContent = msg;
    el.classList.remove('hidden');
    input.classList.add('border-red-500');
    input.classList.remove('border-chef-line');
}
function clearError(id) {
    const el = document.getElementById(`err-${id}`);
    const input = document.getElementById(`res-${id}`);
    if (el) { el.classList.add('hidden'); }
    if (input) { input.classList.remove('border-red-500'); input.classList.add('border-chef-line'); }
}
</script>
</body>
</html>
