# Central bank widgets for any website

Free, live widgets from [InterestRateDecision.com](https://interestratedecision.com/): they update themselves, size themselves, match light or dark sites, and set no cookies.

| Widget | `data-widget` | What it shows |
| --- | --- | --- |
| Rate odds | `odds` | One bank's chance of a cut, hold or hike at each meeting ahead |
| Countdown | `countdown` | The next decision in big figures, to the second |
| Calendar | `next` | The next decisions with countdowns and what economists expect |
| Rates table | `rates` | Every central bank's rate, last move, 3-year line and next date |
| Rate differential | `differential` | Two currencies' policy rates and the gap since 2015 |
| Rate cut calculator | `calculator` | What a cut or hike does to a loan payment and savings |

Build one visually, with a live preview: **[interestratedecision.com/widget/](https://interestratedecision.com/widget/)**

## Use

```html
<div class="ird-widget" data-widget="odds" data-bank="fed"><a href="https://interestratedecision.com/">InterestRateDecision.com</a></div>
<script async src="https://interestratedecision.com/embed.js"></script>
```

Options, as `data-*` attributes:

| Attribute | Values |
| --- | --- |
| `data-bank` | `fed`, `ecb`, `boe`, `boj`, `boc`, `rba`, `rbnz`, `snb`, `norges`, `riksbank` |
| `data-banks` | for `rates`: a list, `fed,ecb,boe` |
| `data-n` | rows or meetings, 1–8 |
| `data-pair` | for `differential`: `EURUSD`, `USDJPY`, `AUDNZD`… |
| `data-theme` | `light`, `dark` or `auto` (the reader's setting) |
| `data-accent` | a hex colour without `#`: `0e9f7e` |
| `data-odds="1"` | for `next`: a thin odds bar on each decision |
| `data-spark="0"` | for `rates`: no lines |
| `data-border="0"` | no border |

Where scripts are not allowed, frame the widget directly:

```html
<iframe src="https://interestratedecision.com/embed/odds/?bank=fed" width="100%" height="320" style="border:0" loading="lazy"></iframe>
```

## WordPress

The plugin in [`wordpress/`](wordpress/) adds a shortcode and a sidebar widget:

```
[ird_widget type="odds" bank="fed"]
[ird_widget type="calculator" theme="dark"]
```

## In this repository

- [`embed.js`](embed.js): the loader, as served at `https://interestratedecision.com/embed.js`
- [`wordpress/`](wordpress/): the WordPress plugin

The widgets are free for any site, commercial or not. Please keep the plain link to InterestRateDecision.com under each one. Code: MIT.
