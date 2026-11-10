PORTFOLIO2K26 — WORDPRESS THEME
================================

WHAT IS INCLUDED
- The original supplied portfolio HTML layout and sections.
- Original CSS files: main, homepage, about, education, extra-sections, contact and theme styles.
- Original inline CSS from index.html.
- Original JavaScript interactions, including theme toggle, animated intro, profile pages, team profile navigation, project details modal, image gallery, scroll effects, particle background, tilt/magnetic effects and button behavior.
- All 20 image files supplied in the ZIP.
- Additional fallback gallery image files for referenced filenames that were missing from the supplied ZIP. These are copies of the matching category thumbnail so the project gallery does not show broken-image icons.

INSTALLATION
1. In WordPress Dashboard, open Appearance > Themes > Add New > Upload Theme.
2. Upload Portfolio2k26-WordPress-Theme.zip.
3. Install and activate the theme.
4. Open the site's homepage. The front-page.php template loads the portfolio automatically.

EDIT TEXT AND INTERACTIVE CONTENT
1. Open the WordPress Dashboard.
2. Select Portfolio2k26 from the left menu.
3. The original HTML is preloaded in "Portfolio HTML / Text". Edit the text between tags.
4. The original profile data and inline modal behavior are preloaded in "Interactive scripts and profile/modal data (JSON array)".
5. The main interactions are preloaded in "Main interaction JavaScript".
6. Click Save Changes.

IMPORTANT: Preserve IDs and CSS class names such as team-card, project-card, skillsModal, projectModal, themeToggle, and section IDs. The original JavaScript uses these selectors to open modals, navigate profile views, toggle themes, and animate elements. Editing or deleting these hooks can disable the corresponding behavior. The editor intentionally exposes the original source so the layout and interactions remain intact.

CHANGE IMAGES
1. Open Appearance > Customize > Portfolio Images.
2. The original images are already bundled and displayed by default.
3. Choose a replacement image for any listed file and click Publish.
4. Profile modal images and project gallery images also use these replacement controls.

EDIT CONTACT DETAILS
Appearance > Customize > Portfolio Details. The email, phone number and address fields are connected to the corresponding text in the portfolio.

NOTES ABOUT THE PROVIDED SOURCE ZIP
- The supplied ZIP contains 20 image files. The HTML references 16 additional project-gallery filenames (html1-4, java1-4, python1-4, react1-4) that are not present in the archive. Matching category thumbnails were copied as fallbacks for those missing filenames. Replace them in Portfolio Images when you have the intended screenshots.
- The source HTML references local files "Design Folder/journey.css", "assets/Css/bootstrap.min.css" and "css/style.css", but these files were not included in the supplied ZIP. The theme includes all supplied CSS and uses the original Bootstrap CDN reference equivalent for grid compatibility. If you have those missing local files, they can be added to further match the source environment.
- External Google Fonts, Font Awesome, AOS and Bootstrap are loaded from CDNs, so the WordPress server needs internet access for those external resources.
- Exact rendering may vary with the WordPress host, installed plugins, browser and external CDN availability.

This theme avoids runtime str_replace() and preg_replace_callback() for image path handling. Image replacement uses WordPress Media Library attachment IDs and a shortcode for bundled images.


LATEST UPDATE
-------------
- Fixed the homepage hero text reveal. After the intro loader completes, the title,
  subtitle, quotation, and About/Contact buttons receive their visible animation state.
- The team foreground image is also revealed after the intro loader.
- The navigation is forced to remain fixed at the top with a solid #000 black background,
  no transparency, no backdrop blur, and a high stacking order.
- The WordPress admin bar is accounted for when an administrator is logged in.


VISUAL CLICK-TO-EDIT MODE (NEW)
-------------------------------
This theme now includes an on-page visual editor for logged-in WordPress administrators.

1. Log in to WordPress with an Administrator account.
2. Visit the public homepage while logged in.
3. A small "Portfolio editor" toolbar appears near the top-right.
4. Click "Edit page".
5. Click a text element (headings, paragraphs, labels, links, buttons, navigation text) and type directly.
6. Click an image/photo to open the WordPress Media Library and choose a replacement.
7. Click "Save changes". The edited page HTML and selected image URLs are saved to WordPress.

Only administrators see the editor toolbar. Visitors see the portfolio normally.
For best results, edit text without deleting important section elements or changing links/classes.
Background textures are managed under Appearance > Customize > Portfolio Images; foreground photos can be changed by clicking them in visual edit mode.


LATEST FIX — INTRO + FRONT-END EDITOR (v1.0.1)
---------------------------------------------
- Restored the original WELCOME / Loading experience intro overlay if an older saved
  portfolio HTML version no longer contains it.
- Made the intro animation initialize safely after the page markup is ready, with a
  failsafe to prevent the page from remaining covered.
- The Portfolio Editor toolbar is now loaded on the public frontend for logged-in
  WordPress administrators, without needing to open Appearance > Customize.
- Added the visual editor wrapper to the fallback template as well.
- Visitors and logged-out users do not see the editor toolbar. Log in as an
  Administrator, then visit the public website directly.


ADDITIONAL FIX — LIVE SITE TOOLBAR (v1.0.2)
-------------------------------------------
The Portfolio Editor is not tied to the WordPress Customizer preview.
For a logged-in Administrator, its script and toolbar are loaded on normal
front-end pages as well. Open the public website in the same browser session
where the WordPress Administrator is logged in. The toolbar is not shown to
logged-out visitors or non-administrator accounts.


FINAL DISPLAY BEHAVIOR — CUSTOMIZER-ONLY EDITOR (v1.0.3)
-------------------------------------------------------
- The public/live portfolio does NOT load or display the Portfolio Editor toolbar.
- The Portfolio Editor toolbar is loaded only in the WordPress Appearance > Customize
  preview, for logged-in Administrator users.
- Open Appearance > Customize to click-edit text and replace images in the preview.
- Publish changes from the Customizer as usual. Visitors see only the clean portfolio.


FUNCTIONALITY RESTORATION — MODALS & SEE MORE (v1.0.4)
-----------------------------------------------------
Root cause fixed: the original inline JavaScript interactions were previously
printed from header.php before the portfolio HTML had been rendered. That meant
the JavaScript queried for profile cards, modal elements, sliders and close
buttons before those elements existed in the DOM.

The interactions are now printed from footer.php after the full portfolio
markup and immediately before wp_footer(). This restores initialization for:
- Team member Skills modal (click each team photo).
- Full team member profile / SEE MORE page (including Back to Team).
- Project detail modal (project external-link icon).
- Project image slider, previous/next controls, dots and close actions.
- Escape-key and overlay-click modal closing.
- Existing counters, scroll effects and other original inline interactions.

The Customizer-only editor behavior is preserved.


FUNCTIONAL RESTORATION HARDENING — v1.0.5
-----------------------------------------
The previous 1.0.4 package moved interaction scripts to the footer but did not
account for older JavaScript and HTML saved in the WordPress database. Those
database values can override the newly packaged scripts and omit modal/profile
markup, which explains why the earlier fix may not appear on an existing site.

This version addresses both persistence cases:
- Bundled current interaction scripts are used when the database contains an
  older interaction-code version.
- Current bundled markup for intro-loader, skillsModal, projectModal and
  profile-page is restored when an older saved page is missing those elements.
- Interaction scripts remain printed after the page markup in footer.php.
- Admin editor saves mark the interaction code as current, so deliberate
  custom interaction edits can continue to be used after saving.

After installing this update, refresh the front page and test team photos,
SEE MORE, project detail icons, modal close buttons and the image slider.


CRITICAL INTERACTION EXECUTION FIX — v1.0.6
-------------------------------------------
The v1.0.4/v1.0.5 footer move exposed a timing bug: the interaction scripts
registered DOMContentLoaded listeners only after DOMContentLoaded had already
fired. As a result, showProfile(), openSkillsModal(), project modal listeners
and animation initialization never ran. That could make SEE MORE appear to
navigate to a missing URL or make modal controls do nothing.

Fixed by running the bundled inline interactions and main animation bundle
immediately when printed at the end of the page, after all required markup
exists. This preserves the original event handlers and makes the profile
overlay and modal functions initialize on the live WordPress page.


WORDPRESS CLICK-NAVIGATION / MODAL FIX — v1.0.7
-----------------------------------------------
Further comparison against the original Porfolio2k26.zip found that SEE MORE
and team/project interactions were originally implemented as in-page UI
actions, not separate WordPress pages. The original profile logic is
window.showProfile(member), and the project details are rendered by the
project modal slider.

Older saved HTML in WordPress can retain legacy anchor URLs or inline
handlers. In this build, a delegated capture-phase click handler intercepts
SEE MORE, Back to Team, team-photo and project clicks before any stale anchor
or inline handler can navigate to a missing Apache URL. It calls the original
profile and modal functions instead.

The interaction version is bumped to 1.0.7 so the bundled corrected
interaction scripts are selected over older database-saved JavaScript.
No separate profile PHP pages or rewrite rules are required: profiles and
project details are intended to open within the homepage.
