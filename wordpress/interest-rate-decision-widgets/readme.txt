=== Interest Rate Decision Widgets ===
Contributors: interestratedecision
Tags: forex, interest rates, central bank, fed, calculator
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 7.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Central bank widgets: rate cut odds, a decision countdown, the calendar, every bank's rate, rate differentials and a rate cut calculator.

== Description ==

Six free widgets from InterestRateDecision.com, kept up to date for you:

* **Rate odds**: one central bank's chance of a cut, hold or hike at each meeting ahead.
* **Countdown**: the next decision in big figures, to the second.
* **Calendar**: the next decisions with countdowns and what economists expect.
* **Rates table**: every central bank's rate, last move and next decision.
* **Rate differential**: two currencies' policy rates and the gap since 2015.
* **Rate cut calculator**: what a cut or a hike does to a loan payment and savings.

Ten central banks: the Federal Reserve, ECB, Bank of England, Bank of Japan, Bank of Canada, RBA, RBNZ, SNB, Norges Bank and the Riksbank.

Use the shortcode in any post or page:

`[ird_widget type="odds" bank="fed"]`
`[ird_widget type="countdown"]`
`[ird_widget type="next" n="5" odds="1"]`
`[ird_widget type="rates" banks="fed,ecb,boe"]`
`[ird_widget type="differential" pair="EURUSD" theme="dark"]`
`[ird_widget type="calculator" accent="0e9f7e"]`

Or add the "Interest Rate Decision" widget to a sidebar or footer.

Options: `theme` (light, dark or auto), `accent` (a hex colour), `border="0"` for no border.

== External service ==

This plugin shows widgets served by InterestRateDecision.com. Pages with a widget load https://interestratedecision.com/embed.js and the widget frames from https://interestratedecision.com/embed/. They set no cookie. The site counts widget views as daily totals with the name of the site showing them, and nothing about the reader. Privacy: https://interestratedecision.com/privacy/

== Frequently Asked Questions ==

= Is it free? =

Yes, for any site. Please keep the small link to InterestRateDecision.com that comes with each widget.

= Where do the odds come from? =

From the record of every central bank decision since 2008, counted with fixed rules, not from futures markets. https://interestratedecision.com/rate-odds/ shows how right they have been.

== Changelog ==

= 1.0.0 =
* Six widgets, a shortcode and a sidebar widget.
