=== WP Fast Total Search - The Power of Indexed Search ===
Contributors: Epsiloncool
Tags: search pdf, fulltext search, better search, relevant search, extended search
Requires at least: 5.0
Tested up to: 7.0
Stable tag: 1.80.280
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Extends the default fulltext search with relevance, jet speed and ability to search any posts, metadata, taxonomy, shortcode content and more data.

== Description ==

**🚀 Supercharge Your WordPress Search with WP Fast Total Search (WPFTS)!**

Tired of the standard WordPress search that doesn't find what you need? Are your users struggling to find content hidden in meta fields, shortcodes, or even files?

**WP Fast Total Search (WPFTS)** is the solution that revolutionizes search on your site, making it truly **fast, accurate, and comprehensive**.

**Why WPFTS is Exactly What You Need:**

✨ **Searches EVERYWHERE:**

Unlike standard search, WPFTS indexes and finds information not only in post **titles and content**, but also within:

*   **Meta fields** (Custom Fields)
*   **Custom Post Types**
*   Text **inside shortcodes**
*   Content of **attached files** (PDF, DOCX, etc. in the Pro version)
*   Dynamically **generated content**

⚙️ **Simplicity and Compatibility:**

*   **No External Dependencies:** Doesn't require installing heavy external services (like Elasticsearch or Solr). Perfect for **standard shared hosting**!
*   **Enhances, Doesn't Replace:** WPFTS *enhances* the standard WordPress search (`WP_Query`), it doesn't break it. All your plugins and themes using standard search will **automatically work better** with WPFTS.
*   **Works Out-of-the-Box:** Just install and activate.

🎯 **Flexibility and Control:**

*   **Customizable Relevance:** Control what matters most in search results! Assign "weights" for title, content, and each meta field using an **improved TF-IDF algorithm**.
*   **Live Search (AJAX):** Let users see search results instantly as they type. Easily added via the widget or shortcode `[wpfts_widget]`.
*   **Phrase Search Support:** Find exact matches.
*   **Flexible Sorting:** Sort results by relevance, date, title, and many other parameters.

**Key Advantages of WPFTS:**

*   ✅ **True Indexed Search:** Fast and efficient.
*   ✅ **No External Libraries or Services Required:** Everything works right inside your website.
*   ✅ **HTML Cleanup:** Correctly indexes content by removing tags and comments (important for Gutenberg).
*   ✅ **Language Support:** Ready translations (English, German, Dutch, Russian, Ukrainian) and easy to add your own.
*   ✅ **API and Documentation:** Extend and customize the plugin to fit your needs.
*   ✅ **Compatibility:** Works great with PHP 5.6 up to PHP 8.2+.
*   ✅ **Extensibility:** Supports add-ons, with a large library available and the ability to create your own.

---

**💎 Get Even More with WP Fast Total Search Pro!**

The Pro version unlocks powerful features:

*   📄 **Search Inside File Content:** Indexes text within PDF, DOC, DOCX, and other formats.
*   🔍 **Filter Search by File Type** (MIME-type).
*   💡 **Smart Excerpts:** Displays PDF content snippets directly in search results.
*   ☁️ **Optional External Service** for text extraction from files (license included).
*   🤝 **Priority Technical Support:** Help with installation, configuration, and conflict resolution.
*   🔄 **Regular Auto-Updates:** Just like plugins from the WordPress repository.
*   🧩 **Premium Add-on Bundle:** Integrations with popular plugins (WordPress Download Manager, Filebase Pro, Delicious Downloads, etc.) to index their content and files. *Ability to request custom add-on development.*

**[TEST DRIVE - TRY FOR FREE](https://fulltextsearch.org/evaluation/ "WP Fast Total Search Pro Evaluation License") | [GET PRO](https://fulltextsearch.org/buy/ "Download WP Fast Total Search Pro") 💎**

---

**🌍 Translations**

We are grateful to the translators who made the plugin accessible worldwide:

*   torkeller ([@torkeller](https://profiles.wordpress.org/torkeller/)) for German and German_formal 
*   Peter Smits [@psmits1567](https://wordpress.org/support/users/psmits1567/) for Dutch
*   Lera Suhanova for Ukrainian
*   epsiloncool [@epsiloncool](https://profiles.wordpress.org/epsiloncool/) for Russian

Join us in translating the plugin into your language! Let's make it useful for everyone.

---

**📚 Documentation**

Detailed information can be found in the [Documentation](https://fulltextsearch.org/documentation/ "WP Fast Total Search Documentation").

== Installation ==

1. Unpack and upload `fulltext-search` folder with all files to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Press `Rebuild Index` button to initialize index (actually this function will run automatically on first plugin install)

== Frequently Asked Questions ==

= Where can I put some notices, comments or bugreports? =

Do not hesistate to write to us at [Contact Us](https://fulltextsearch.org/contact/ "Contact Us") page.

= Where do I report security bugs found in this plugin? =

Please report security bugs found in the source code of the WPFTS Fast Total Search plugin through the [Patchstack Vulnerability Disclosure  Program](https://patchstack.com/database/vdp/fulltext-search). The Patchstack team will assist you with verification, CVE assignment, and notify the developers of this plugin. # Security Policy ## Reporting Security Bugs Please report security bugs found in the YOUR_PLUGIN_NAME_HERE plugin's source code through the [Patchstack Vulnerability Disclosure Program](https://patchstack.com/database/vdp/fulltext-search). The Patchstack team will assist you with verification, CVE assignment, and notify the developers of this plugin.

== Security Policy ==

= Reporting Security Bugs =

Please report security bugs found in the WP Fast Total Search plugin's source code through the [Patchstack Vulnerability Disclosure Program](https://patchstack.com/database/vdp/fulltext-search). The Patchstack team will assist you with verification, CVE assignment, and notify the developers of this plugin.

== Screenshots ==

1. Main Configuration
2. Indexing Rules
3. Indexing Defaults
4. Smart Excerpts (Google-like search results) and styling settings
5. Analytics (Query Log)
6. Support & Docs
7. Data Collection Diagram
8. Search Results Example

== Changelog ==

= 1.80.280 =
* Fixed SQL injection vulnerability (IMPORTANT SECURITY FIX!)
* Improved compatibility with WP 7.0
* Numerous bugs were fixed

= 1.79.274 =
* Security fix to close non-critical breach

= 1.79.270 =
* Approved compatibility with Wordpress 6.8

= 1.79.269 =
* Made plugin description user-friendly

= 1.79.268 =
* Added a support for WP native core/post-excerpt block
* Sufficiently improved an IRules statistics calculation speed to prevent multiple runs when several admins are working on WordPress
* Fixed a security breach in AJAX request processing code

= 1.79.264 =
* Fixed a potential security breach in updateindex AJAX request

= 1.79.262 =
* Added Gutenberg WP Blocks support (WPFTS Live Search Widget is now available for block themes)
* Added request protection (nonce) for Rebuild Index AJAX Request and Try DB Update Request. Huge thanks to @Mika from PatchStack for discovering this!
* Added Stemming support for query words.
* Improved Divi Theme compatibility support.
* Fixed Notice in Smart Excerpts sorting algorithm.

= 1.78.258 =
* Added compatibility hook functionalities for themes
* Fixed a bug with "score" value preventing it from displaying

= 1.77.256 =
* Fixed a problem with memory_limit value conversion when it's given in Gigabytes (G).
* Fixed a problem with "style" and "script" tags removal from the indexing when the corresponding option is set.

= 1.76.254 =
* Fixed some issues with autocomplete (Live Search Widget functions)

= 1.75.250 =
* Increased core algorithm search speed (especially for popular words)
* Added "Relevance Finetune" Settings. Alpha version, try with care.

= 1.74.247 =
* Fixed possible loop while updating DB and error happen
* Added detailed info on DB update fail so admin can ask technical support (us) what to do
* Fixed "Check Rules" link (was wrong for websites with /subfolder/ URLs)

= 1.73.245 =
* Fixed some issues with database syncronization
* Fixed some notices appeared on PHP8.3+
* Added support for sub-index records

= 1.72.240 =
* Fixed wrong database structure syncronization while plugin updates (thanks to Rafael Fischmann / @rfischmann !)

= 1.71.238 =
* Added Smart Text Fragments functionality that allows to see clicked sentences on the full post page and highlights searched words (still in alpha)
* Added an ability to limit query log size via Analytics / Query Log / Settings

= 1.70.236 =
* Fixed CSRF Vulnerability detected by Majed Refaea (thanks a lot!)

= 1.69.234 =
* Fixed XSS Vulnerability detected by justakazh and Majed Refaea (thanks, guys!)

= 1.68.232 =
* Urgent fix for MySQL older versions: VARCHAR index size limit.

= 1.67.231 =

* Changed logo and style of the plugin
* Fixed warning in indexer (no finish_ts variable found)
* Fixed indexing on bad words found (some non-latin words incorrectly indexed by MySQL that's why inserting to the vectors table failed)
* IRules logic changed to be compatible with the wpfts_irule/filters
* Fixed plugin styling on non-english WP installations (the plugin admin interface was completely broken in NL, for example)
* Added support for non-string chunks

= 1.65.225 =

This release is a result of a lots of improvements, fixes and updates.

* The internal code structure has been improved to make it easier to read and edit
* Improved compatibility with the latest version of Wordpress
* Enormous work has been done to increase code security
* Added support for indexing rules
* Added the ability to configure post_type and post_status to create the main index
* Added check and warning if the amount of script memory is insufficient for correct operation
* Fixed errors in the operation of presets
* Fixed errors in fast search in the Wordpress control panel
* Fixed errors in logging search queries
* Added processing of special clusters __debug and __used_rules
* Script execution session time increased to 60 seconds when indexing (if allowed by your hosting provider)
* Improved plugin performance with PHP8.3.6
* The Flare service now automatically reconnects when the connection is lost, and if the connection is successful, it blocks AJAX ping to relieve the server from frequent AJAX requests.

= 1.61.215 =
* Added Flare re-connection to prevent falling back to the polling scheme after some time or when network lost
* Fixed broken "default search logic" setting
* Added experimental "Indexing Rules" tab

= 1.60.213 =
* Fixed Cross-site Scripting (XSS) Vulnerability issue in WPFTS :: Live Search widget. Thanks to [Ngô Thiên An (ancorn_ from VNPT-VCI)](https://patchstack.com/database/researcher/090515a6-9651-41fa-9465-fd542e38e526) for discovering this issue!

= 1.59.211 =
* Fixed another bug with "tp" table

= 1.59.209 =
* Fixed a bug with constantly growing "tp" table
* Improved compatibility with WP 6.3.2
* Removed extra files / Some clean up

= 1.58.207 =
* Fixed a bug with memory_limit = -1 that can be set on some hostings
* Improved compatibility with WP 6.3.1

= 1.57.205 =
* Fixed a MySQL bug with indexing some words contains specific hieroglyphic literals (Japanese, Chinese, Korean etc)
* Fixed a bug with logging

= 1.56.203 =
* Some bugs fixed

= 1.55.201 =
* Officially changed the plugin's name to "WP Fast Total Search"
* The code was reorganized to be clearer and simpler to update
* The plugin's description was improved
* Added Query Log details page
* Improved compatibility with WordPress 6.2.1 and PHP 8.2+
* Improved block-based themes support
* Added smart updater for database allowed to preserve current index while updating the plugin version
* The main search algorithm was redone to be sufficiently less RAM-consuming and faster
* Fixed 21 issues in the code

= 1.51.178 =
* Query Log analyzer added
* Index Browser added
* Fixed 9 small issues

= 1.50.175 =
* Improved support for Block-based themes (in particular, 2022) - Smart Excerpts is now shown in those themes
* Preparations for the modular structure
- Maybe added a lot of bugs, please report! (will be fixed soon)

= 1.50.168 =
* Compatibility with WP 6.0
* Fixed bugs with Live Search widget
* Fixed 5 minor bugs

= 1.49.164 =
* Localization-related fixes
* Analytics submenu added
* Text description fixed

= 1.48.162 =
* Added more flexibility for WPFTS Live Search widget and widget shortcode

= 1.48.156 =
* Added "Remove non-text HTML nodes" functionality
* Fixed 3 issues

= 1.48.150 =
* Increased compatibility with PHP8.0+
* Fixed 7 bugs with database access and deprecated code
* Added hooks to add flexibility to remove/add specific shortcodes from the indexing

= 1.47.148 =
* Improved style/js loading code (thanks to @nextendweb !)

= 1.47.146 =
* A course is taken to significantly improve the functionality of the plugin. Changed the design of the admin panel

= 1.46.140 =
* Added primary keys to temporary tables to let 3rd-party plugins (like backup tools) work better with wpftsi_* tables

= 1.45.138 =
* Added fail detection to the indexer to prevent stops because of 3rd party plugins' fails

= 1.44.134 =
* Fix: enforce indexer via AJAX in case the server is local with wrong DNS/hosts file or disabled CRON

= 1.44.132 =
* Replaced TRUNCATE with CREATE-RENAME-DROP to avoid system locking

= 1.44.130 =
* Added a checkbox to switch ON/OFF the search inside WP admin
* Improved indexer execution for hostings where DNS is configured incorrectly and/or native WP cron does not work properly
* Added a fix (optional, with the checkbox switch) for MariaDB issue with new experimental search option
* WPFTS Index Optimizer is switched OFF by default now (you can bring it back using the switch)
* Rebuild Index button from Attachment Edit page now works again
* Optimized IDLE mode for indexer
* Added wpfts_set_pause() method
* Visual issues fixed
* Fixed main_search tweaker routine

= 1.43.128 =
* Added Flare support
* Fixed a bug in autocomplete widget
* Added 'wpfts_is_force' parameter to WP_Query

= 1.42.124 =
* Fixed MySQL error (thanks Daan!)
* Clean up some code to remove extra Flare&Fire calls

= 1.42.122 =
* The indexer sequence and algorithm was completely rebuilt
* Pause mode was added to the indexer
* Improved indexer logging
* Added search index status to the Edit Post page

= 1.41.120 =
* Added shortcode [wpfts_widget] that lets you install search widget to any place of post/page or template

= 1.40.117 =
* Improved input parameter processing to remove dependency with is_main_query() and is_search() for repeated WP_Query calls
* Bugs fixed
* Improved compatibility with 3rd-party themes and plugins

= 1.39.112 =
* Fixed Live Search console error
* Fixed 5 minor bugs

= 1.39.108 =
* Fixed 8 bugs and issues
* Added shortcode content search support!
* Improved Smart Excerpt preparation (removed html entities)

= 1.38.106 =
* Fixed 10 big and small issues
* Added: extension port in free version
* Improved indexing speed

= 1.37.101 =
* Some fixes in the code
* Fixed forum and documentation links

= 1.36.98 =
* Word indexer was optimized for low-memory webservers
* Fixed some notices appeared for rare cases

= 1.35.96 =
* Fixed an issue with AND settings (now works again, [thanks to @clapierre](https://fulltextsearch.org/forum/topic/21/default-search-logic-and-or-broken-since-version-1-28-75/2))
* Fixed 2 other bugs
* The notice on the Smart Excerpt Settings page was fixed

= 1.34.94 =
* Translation-related fixes

= 1.33.92=
* Fixed an issue with index length on VARCHAR fields
* Confirmed compatibility with Wordpress 5.5
* Fixed language domain and code to be compatible with Wordpress Translate service

= 1.32.90 =
* Added support for x86 platforms (by x64 software emulation)
* Fixed notices when result is empty (thanks to Mihajlo!)
* Fixed DB collation issues (now WPFTS is using the same collation as Wordpress does)

= 1.31.88 =
* Fixed "expected to be a reference, value given" bug, thanks to @gregamer!

= 1.31.87 =
* Fixed found_posts / max_num_pages issue
* Fixed text typo

= 1.30.85 =
* Added new algorithm that supports sentences
* Deep search is now faster (no more afraid to use it)
* Character limit (3 chars) was removed
* MyISAM support was dropped
* Faster index rebuilding
* Fixed some UI/UX issues
* Fixed around 15 issues in the code

= 1.28.75 =
* Fixed some UI bugs
* Added German and German-formal translations (thanks to torkeller (@torkeller) !!!)
* Improved Russian translation

= 1.27.72 =
* Fixed UI second-level tabs bug
* Some new texts prepared for translation

= 1.27.70 =
* Changed UI logic: now tabbed
* Approved compatibility with Wordpress 5.4
* Fixed 3 small issues

= 1.26.67 =
* Fixed Smart Excerpts view issue
* Added more code for custom widgets
* Attachments caption and description are searchable now!

= 1.25.65 =
* Fixed design (now looks much better)
* Fixed text typos
* Fixed 4 small issues

= 1.24.62 =
* Fixed texts and typos
* Improved indexing speed
* Some code preparations for sentence-enabled search

= 1.23.58 =
* Fixed 3 issues
* Updated the plugin description

= 1.23.56 =
* Fixed notification windows dismiss function

= 1.23.54 =
* Fixed incompatibility with Gravity Forms and possible some other plugins

= 1.23.50 =
* Added modern design of the plugin backend. All forms and controls were rebuilt
* Fixed 5 bugs and issues

= 1.22.46 =
* Added alpha Live Search functionality

= 1.21.44 =
* Justified design
* Fixed 2 bugs

= 1.20.42 =
* Tested and approved compatibility with WP 5.3
* Fixed 3 secondary issues

= 1.19.40 =
* Fixed number to string conversion for some locales

= 1.18.35 =
* Added CSS style editor for Smart Excerpts block
* Added external parameters for WP_Query: "word_logic" and "wpfts_disable" (refer documentation)
* Fixed: Smart Excerpts now works well for content contains non-UTF-8 characters

= 1.17.33 =
* Fixed: The Smart Excerpts algorithm was completely rebuilt. Now working on any post and excerpt length. Thanks to Kathy

= 1.16.31 =
* Fixed: single UTF-8 quote issue made some "beautifyed strings" unsearchable. Fixed now. Thanks to Sophia.

= 1.16.29 =
* Fixed: make text search case insensitive not depends from MySQL config. Thanks to Sophia

= 1.16.27 =
* Fixed: search result items with zero relevance does not show anymore (BIG thanks to @bolus150 for the bugreport!)
* Added possibility to set up cluster_weights as a WP_Query parameter
* Added wpfts_cluster_weights filter
* Added Settings option to strip_tags before put post content to the index (useful for Gutenberg driven sites)

= 1.15.24 =
* Localization improved (new pot file, added __ in some places the code)

= 1.14.22 =
* Big update: lots of functions was moved from the Pro version to the Free WPFTS Version
* Interface bugs were fixed
* Relevance formula was completely rebuilt
* Reindex algorithm was sufficiently improved (now 5 times faster!)
* Word max length was increased to 255 characters

= 1.11.16 =
* Code optimizations
* Indexing speed increased

= 1.11.15 =
* Improved compatibility with Wordpress 5.2.2
* Fixed 3 small issues

= 1.10.14 =
* Fixed an issue with database locking with MYISAM
* Small interface fixes

= 1.10.13 =
* Fixed an issue with indexing
* Added compatibility with Wordpress 5.2

= 1.10.12 =
* Fixed 3 issues

= 1.10.11 =
* Improved compatibility with WP 5.1
* Fixed 7 issues

= 1.9.10 =
* Added Google-like Smart Excerpts

= 1.8.9 =
* Fixed 5 tiny bugs (thanks users for reports!)

= 1.8.7 =
* Added Multisite support

= 1.7.6 =
* Fixed 9 warnings and 21 notices while optimizing plugin for PHP 7.2
* Added support of PHP 7.2

= 1.7.5 =
* Added Main WP Search Tweaks settings

= 1.6.4 =
* Fixed a bug - it was a reason why plugin can't activate correctly on some hostings

= 1.6.3 =
* Added InnoDB support
* Added a switch of MySQL table type (InnoDB/MySQL)
* Fixed a bug with popup message

= 1.6.2 =
* Fixed MySQL queries: search speed sufficiently improved

= 1.6.1 =
* Added "Deeper Search" flag and functionality

= 1.6.0 =
* Added support for internal query filtering
* Added wpfts_search_terms filter
* Fixed some indexing speed issues

= 1.5.9 =
* Fixed Readme.txt
* Fixed queries to WP multisite support

= 1.5.8 =
* Compatibility with WP 4.8.1
* Indexing speed increased a bit (code was optimized)

= 1.4.6 =
* Added support for sites with specific DB table names

= 1.3.4 =
* Cosmetic changes

= 1.2.3 =
* Changed regexp which is splitting texts to words (non-english characters are now supported)
* Added `wpftp_split_to_words` filter which enables you to define your own "text splitting" algorithm

= 1.2.1 =
* Added complex query analyzer (support quotes)

= 1.1.7 =
* Added plugin icon
* Fixed description

= 1.1.6 =
* Lowered save_post hook priority to index metadata correctly

= 1.1.5 =
* Small bug fixes
* Debug logging removed

= 1.1.4 =
* Added cluster weights capability
* Plugin assigned to GPL license

= 1.0 =
* First Wordpress version

= 0.4 =
* Automatic indexing were added, over 30 bugs were fixed

= 0.1 =
* Initial edition. Basic functions added

== Upgrade Notice ==

= 1.1.4 =
* Upgrade immediately, because of some security issues found and fixed

= 1.0 =
* First version to be in Wordpress repository, just install it
