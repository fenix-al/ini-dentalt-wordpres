/* ini Dental — Frontend JS */
(function () {
  'use strict';

  /* -----------------------------------------------------------------------
   * Mobile menu toggle
   * -------------------------------------------------------------------- */
  var menuToggle = document.getElementById('ini-menu-toggle');
  var menu       = document.getElementById('ini-menu');

  if (menuToggle && menu) {
    menuToggle.addEventListener('click', function () {
      var isOpen = menu.classList.toggle('open');
      menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Close when clicking outside
    document.addEventListener('click', function (e) {
      if (!menu.contains(e.target) && !menuToggle.contains(e.target)) {
        menu.classList.remove('open');
        menuToggle.setAttribute('aria-expanded', 'false');
      }
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        menu.classList.remove('open');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.focus();
      }
    });
  }

  /* -----------------------------------------------------------------------
   * Video lightbox modal
   * -------------------------------------------------------------------- */
  function buildModal() {
    var modal = document.createElement('div');
    modal.id = 'ini-video-modal';
    modal.className = 'ini-video-modal';
    modal.setAttribute('role', 'dialog');
    modal.setAttribute('aria-modal', 'true');
    modal.setAttribute('aria-label', 'Video player');
    modal.innerHTML =
      '<div class="ini-video-modal-inner">' +
        '<button class="ini-video-close" aria-label="Close video">&times;</button>' +
        '<div id="ini-video-wrap"></div>' +
      '</div>';
    document.body.appendChild(modal);

    modal.querySelector('.ini-video-close').addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
      if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeModal();
    });

    return modal;
  }

  var videoModal = null;

  function openModal(url) {
    if (!videoModal) videoModal = buildModal();

    var wrap = document.getElementById('ini-video-wrap');
    wrap.innerHTML = '';

    // Detect YouTube / Vimeo or use iframe
    var src = url;
    var ytMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([A-Za-z0-9_-]+)/);
    var vmMatch = url.match(/vimeo\.com\/(\d+)/);

    if (ytMatch) {
      src = 'https://www.youtube.com/embed/' + ytMatch[1] + '?autoplay=1&rel=0';
    } else if (vmMatch) {
      src = 'https://player.vimeo.com/video/' + vmMatch[1] + '?autoplay=1';
    }

    var iframe = document.createElement('iframe');
    iframe.src = src;
    iframe.allowFullscreen = true;
    iframe.allow = 'autoplay; fullscreen; picture-in-picture';
    wrap.style.position = 'relative';
    wrap.style.paddingTop = '56.25%'; // 16:9
    iframe.style.position = 'absolute';
    iframe.style.inset = '0';
    iframe.style.width = '100%';
    iframe.style.height = '100%';
    iframe.style.border = 'none';
    iframe.style.borderRadius = '8px';
    wrap.appendChild(iframe);

    videoModal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    if (!videoModal) return;
    videoModal.classList.remove('open');
    document.getElementById('ini-video-wrap').innerHTML = '';
    document.body.style.overflow = '';
  }

  document.addEventListener('click', function (e) {
    var trigger = e.target.closest('.ini-video-trigger');
    if (!trigger) return;
    e.preventDefault();
    var url = trigger.dataset.video || trigger.getAttribute('href');
    if (url && url !== '#') {
      openModal(url);
    }
  });

  /* -----------------------------------------------------------------------
   * Smooth scroll for anchor links
   * -------------------------------------------------------------------- */
  document.querySelectorAll('a[href^="#"]').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var target = document.getElementById(this.getAttribute('href').slice(1));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        // Close mobile menu if open
        if (menu) menu.classList.remove('open');
      }
    });
  });

  /* -----------------------------------------------------------------------
   * Header sticky shadow on scroll
   * -------------------------------------------------------------------- */
  var header = document.getElementById('masthead');
  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 60) {
        header.style.boxShadow = '0 4px 20px rgba(20,60,90,.1)';
      } else {
        header.style.boxShadow = '';
      }
    }, { passive: true });
  }

})();
