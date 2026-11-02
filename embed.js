/*! InterestRateDecision.com widgets. No cookies; views are counted as daily totals only.
 * Paste where the widget goes:
 *   <div class="ird-widget" data-widget="odds" data-bank="fed"><a href="https://interestratedecision.com/">InterestRateDecision.com</a></div>
 *   <script async src="https://interestratedecision.com/embed.js"></script>
 * Widgets: next, countdown, odds, rates, differential, calculator.
 * Every other data-* attribute is passed to the widget (bank, n, pair, banks,
 * theme=light|dark|auto, accent=hex, odds=1, spark=0). The frame sets its own height.
 */
(function () {
  var me = document.currentScript;
  var origin = me && me.src ? new URL(me.src).origin : 'https://interestratedecision.com';
  var WIDGETS = { next: 380, countdown: 330, odds: 320, rates: 560, differential: 300, calculator: 640 };
  var count = 0;
  var frames = {};

  function mount(el) {
    if (el.getAttribute('data-ird-ready')) return;
    var name = el.getAttribute('data-widget');
    if (!WIDGETS[name]) name = 'next';
    el.setAttribute('data-ird-ready', '1');
    var id = 'ird' + ++count;
    var q = [];
    for (var i = 0; i < el.attributes.length; i++) {
      var a = el.attributes[i];
      if (a.name.indexOf('data-') !== 0 || a.name === 'data-widget' || a.name === 'data-ird-ready' || a.name === 'data-border') continue;
      q.push(encodeURIComponent(a.name.slice(5)) + '=' + encodeURIComponent(a.value));
    }
    q.push('id=' + id);
    var f = document.createElement('iframe');
    f.src = origin + '/embed/' + name + '/?' + q.join('&');
    f.title = el.getAttribute('data-title') || 'Central bank rate decisions';
    f.loading = 'lazy';
    f.setAttribute('scrolling', 'no');
    f.style.cssText = 'display:block;width:100%;height:' + WIDGETS[name] + 'px;border:' + (el.getAttribute('data-border') === '0' ? '0' : '1px solid rgba(128,140,160,.28)') + ';border-radius:14px;overflow:hidden;color-scheme:normal;transition:height .15s ease';
    frames[id] = f;
    el.insertBefore(f, el.firstChild);
    var link = el.querySelector('a');
    if (link) link.style.cssText = 'display:block;margin-top:6px;font-size:12px;opacity:.75';
  }

  function scan() {
    var els = document.querySelectorAll('.ird-widget');
    for (var i = 0; i < els.length; i++) mount(els[i]);
  }

  window.addEventListener('message', function (e) {
    if (e.origin !== origin || !e.data || e.data.ird !== 'size') return;
    var f = frames[e.data.id];
    var h = +e.data.height;
    if (f && h > 40 && h < 4000) f.style.height = h + 'px';
  });

  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', scan);
  else scan();
  window.IRDWidgets = { scan: scan };
})();
