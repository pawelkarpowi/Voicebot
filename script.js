document.addEventListener('DOMContentLoaded', function () {
  const year = document.getElementById('year');
  if (year) {
    year.textContent = new Date().getFullYear();
  }

  // FAQ toggle
  const faqQuestions = document.querySelectorAll('.faq-q');
  faqQuestions.forEach((q) => {
    q.addEventListener('click', () => toggleFaq(q));
    q.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleFaq(q);
      }
    });
  });

  function toggleFaq(qEl) {
    const item = qEl.closest('.faq-item');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach((openItem) => {
      openItem.classList.remove('open');
      const qq = openItem.querySelector('.faq-q');
      if (qq) qq.setAttribute('aria-expanded', 'false');
    });
    if (!isOpen) {
      item.classList.add('open');
      qEl.setAttribute('aria-expanded', 'true');
    }
  }

  // Simple contact form handler (no backend)
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const success = document.getElementById('contactSuccess');
      if (success) {
        success.classList.add('show');
      }
      contactForm.reset();
    });
  }
});
