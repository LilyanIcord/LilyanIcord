(function () {
  'use strict';

  var THEME_STORAGE_KEY = 'portfolio-theme';
  var themeToggle = document.getElementById('theme-toggle');
  var menuToggle = document.getElementById('menu-toggle');
  var navLinks = document.querySelectorAll('.sidebar-nav .nav-link');
  var sectionRefs = [];

  function applyTheme(isLight) {
    document.body.classList.toggle('theme-light', isLight);
  }

  function buildSectionRefs() {
    sectionRefs = [];
    navLinks.forEach(function (link) {
      var href = link.getAttribute('href') || '';
      var id = href.indexOf('#') === 0 ? href.slice(1) : '';
      if (!id) return;
      var target = document.getElementById(id);
      if (!target) return;
      sectionRefs.push({ id: id, el: target });
    });
  }

  /* Lien actif selon la section visible au scroll */
  function setActiveNavLink() {
    if (!sectionRefs.length) return;
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    var triggerY = scrollTop + 140;
    var maxScroll = Math.max(0, document.documentElement.scrollHeight - (window.innerHeight || 0));
    var currentId = sectionRefs[0].id;

    sectionRefs.forEach(function (ref) {
      var rect = ref.el.getBoundingClientRect();
      var sectionTop = rect.top + scrollTop;
      if (sectionTop <= triggerY) currentId = ref.id;
    });

    if (scrollTop >= (maxScroll - 2)) currentId = sectionRefs[sectionRefs.length - 1].id;

    navLinks.forEach(function (link) {
      var href = link.getAttribute('href') || '';
      var id = href.indexOf('#') === 0 ? href.slice(1) : '';
      link.classList.toggle('active', id === currentId);
    });
  }

  function refreshScrollSpy() {
    buildSectionRefs();
    setActiveNavLink();
  }

  refreshScrollSpy();
  window.addEventListener('scroll', setActiveNavLink, { passive: true });
  window.addEventListener('resize', refreshScrollSpy);
  window.addEventListener('load', refreshScrollSpy);

  /* Persistance du thème (localStorage) */
  if (themeToggle) {
    try {
      if (window.localStorage) {
        themeToggle.checked = localStorage.getItem(THEME_STORAGE_KEY) === 'light';
      }
      applyTheme(themeToggle.checked);
      themeToggle.addEventListener('change', function () {
        applyTheme(themeToggle.checked);
        try {
          if (window.localStorage) {
            localStorage.setItem(THEME_STORAGE_KEY, themeToggle.checked ? 'light' : 'dark');
          }
        } catch (e) {
          // Si l'accès au localStorage est bloqué, on ignore simplement.
        }
      });
    } catch (e) {
      // Si localStorage est désactivé (mode navigation ou politique de sécurité),
      // on n'utilise simplement pas la persistance du thème.
    }
  }

  /* Fermer le menu mobile au clic sur un lien (optionnel) */
  if (menuToggle && navLinks.length) {
    navLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        if (window.matchMedia('(max-width: 900px)').matches) {
          menuToggle.checked = false;
        }
      });
    });
  }

  /* Effet d'apparition au scroll pour les éléments .reveal */
  var revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length) {
    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(
        function (entries, obs) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('reveal-visible');
              obs.unobserve(entry.target);
            }
          });
        },
        {
          threshold: 0.15
        }
      );

      revealEls.forEach(function (el, index) {
        el.style.transitionDelay = (index * 0.08) + 's';
        observer.observe(el);
      });
    } else {
      revealEls.forEach(function (el) {
        el.classList.add('reveal-visible');
      });
    }
  }
})();
