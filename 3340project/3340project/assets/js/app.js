document.addEventListener('DOMContentLoaded', () => {
  const baseUrl = document.documentElement.dataset.baseUrl || '';

  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.main-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', String(open));
    });
  }

  const priceOutput = document.querySelector('#quote-total');
  const quoteForm = document.querySelector('#quote-form');
  if (quoteForm && priceOutput) {
    const updateQuote = () => {
      let total = 0;
      quoteForm.querySelectorAll('[data-price]:checked, select[data-price]').forEach((field) => {
        if (field.tagName === 'SELECT') {
          total += Number(field.selectedOptions[0]?.dataset.add || 0);
        } else {
          total += Number(field.dataset.price || 0);
        }
      });
      priceOutput.textContent = total.toFixed(2);
    };
    quoteForm.addEventListener('change', updateQuote);
    updateQuote();
  }

  const chart = document.querySelector('#salesChart');
  if (chart && chart.dataset.values) {
    const values = JSON.parse(chart.dataset.values);
    const labels = JSON.parse(chart.dataset.labels);
    const ctx = chart.getContext('2d');
    chart.width = chart.clientWidth * devicePixelRatio;
    chart.height = 300 * devicePixelRatio;
    ctx.scale(devicePixelRatio, devicePixelRatio);
    const width = chart.clientWidth;
    const height = 300;
    const max = Math.max(...values, 1);
    ctx.font = '12px sans-serif';
    ctx.strokeStyle = getComputedStyle(document.documentElement).getPropertyValue('--primary').trim();
    ctx.fillStyle = ctx.strokeStyle;
    ctx.lineWidth = 3;
    ctx.beginPath();
    values.forEach((value, index) => {
      const x = 35 + (index * (width - 70) / Math.max(values.length - 1, 1));
      const y = height - 35 - ((value / max) * (height - 75));
      if (index === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
      ctx.fillText(labels[index], x - 10, height - 10);
      ctx.fillText(String(value), x - 6, y - 10);
    });
    ctx.stroke();
  }

  const liveSearch = document.querySelector('#live-search');
  const searchResults = document.querySelector('#search-results');
  let searchTimer;
  if (liveSearch && searchResults) {
    liveSearch.addEventListener('input', () => {
      clearTimeout(searchTimer);
      const query = liveSearch.value.trim();
      if (query.length < 2) {
        searchResults.hidden = true;
        searchResults.innerHTML = '';
        return;
      }
      searchTimer = setTimeout(async () => {
        try {
          const response = await fetch(`${baseUrl}/api/search.php?q=${encodeURIComponent(query)}`);
          const products = await response.json();
          searchResults.innerHTML = products.length
            ? products.map(product => `
              <a class="search-item" href="${baseUrl}/product.php?id=${product.id}">
                <img src="${baseUrl}/${product.image}" alt="">
                <span><strong>${product.name}</strong><small>${product.category} · $${Number(product.price).toFixed(2)}</small></span>
              </a>`).join('')
            : '<div class="search-empty">No matching products</div>';
          searchResults.hidden = false;
        } catch {
          searchResults.hidden = true;
        }
      }, 220);
    });
    document.addEventListener('click', event => {
      if (!event.target.closest('.search-shell')) searchResults.hidden = true;
    });
  }
});
