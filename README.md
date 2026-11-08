# My Portfolio — Classic WordPress Theme

A classic PHP theme based on the supplied `Porfolio2k26.zip` portfolio site. The homepage keeps the supplied section markup, class names, image assets, animations, modals, and original CSS files. It is a single-page portfolio landing page with anchor navigation; the individual `page-*.php` files are optional WordPress page templates for separate content pages.

## Install

1. In WordPress, open **Appearance → Themes → Add New → Upload Theme**.
2. Upload `my-portfolio-theme.zip`, install, and activate.
3. Open **Appearance → Menus**, create a menu with the section links (`#home`, `#about`, `#education`, `#projects`, `#services`, `#achievements`, `#testimonials`, `#blog`), and assign it to **Primary Menu**. If no menu is assigned, the homepage displays the built-in anchor navigation.
4. Set the site homepage to **Your latest posts**. WordPress will use `front-page.php` automatically.
5. Visit **Settings → Permalinks** and click **Save Changes** once.

## Included

- Classic theme files: `style.css`, `functions.php`, `header.php`, `footer.php`, `index.php`, `front-page.php`, `page.php`, `single.php`, `404.php`, `searchform.php`, `sidebar.php`.
- Individual page templates for About, Education, Projects, Services, Achievements, Testimonials, Blog, and Contact.
- Original CSS copied into `assets/css/` (homepage, main, about, education, extra-sections, contact, theme) and original image assets copied into `assets/images/`.
- Google Fonts, AOS, Font Awesome, and Bootstrap are enqueued in the theme.
- Native WordPress meta boxes are used for editable CPT fields; Advanced Custom Fields is not required.
- CPTs: Projects, Testimonials, Services, Achievement Stats.
- Contact form submits securely through `admin-post.php`, validates a nonce, sanitizes fields, and sends with `wp_mail()` to the WordPress admin email.

## Editing content

- Edit the homepage's static text and team profiles by editing the relevant section markup in `front-page.php`.
- Edit project records in **Projects**. Set the project language/icon class, description, features (one per line), and slider image attachment IDs (comma-separated). Use the seeded project titles/slugs for the four homepage modal triggers.
- Add services, testimonials, and achievement stats from their respective admin menus. Their editable fields are stored as native post meta.
- Upload project slider images to Media Library and paste their attachment IDs into the Project details field.
- Set your notification email under **Settings → General → Administration Email Address**.

## One-time starter content migration

After activating the theme, run this from the WordPress installation root:

```bash
wp eval-file wp-content/themes/my-portfolio-theme/inc/migrate.php
```

It seeds 4 projects, 4 services, 4 achievement stats, and 3 testimonials. Existing records with the same title are skipped. Team cards and the four Facebook/contact images remain in the supplied homepage markup and use the supplied image files.

## Notes / verification

- The supplied project modal JavaScript includes a local fallback dataset. WordPress project records override it when records exist.
- The theme preserves the source page's visual markup and supplied styles. Exact pixel parity still depends on the same browser, viewport, fonts/network access, and content; this package has not been activated inside your WordPress hosting environment.
- The supplied archive contains seven CSS files, so all seven are enqueued in sequence. Bootstrap is loaded from the official jsDelivr CDN because no Bootstrap CSS file was present in the archive.
- ACF field groups are not used because native meta boxes are implemented. If you prefer ACF, the meta fields are documented in `functions.php` and can be recreated as ACF field groups.


## Modal interaction fixes (v1.0.1)
- Skills & Expertise modal opens from both team photos and the Skills & Expertise labels.
- Project detail modals resolve the four portfolio card IDs to their matching project data.
- Project slider arrows and dots update the active slide; close button, backdrop click, and Escape close the modal.
- Theme JavaScript checks for optional elements before attaching listeners, preventing missing elements on other WordPress pages from stopping the script.
- Modal/team image URLs use the active theme asset URL rather than relative paths.

After replacing an older theme ZIP, clear any WordPress/cache plugin/CDN cache and hard-refresh the browser (Ctrl+F5).


## Modal styling restoration (v1.0.2)
The original inline CSS for the Skills & Expertise modal, Project Details modal, education logo hover link, and theme toggle is now loaded as `assets/css/modal-overrides.css`. This restores the intended hidden/active overlay states, blurred dark backdrop, modal sizing, skill bars, tags, project slider layout, and close-button appearance. The stylesheet is enqueued after the main theme styles to preserve its intended overrides.


## Homepage background and theme appearance (v1.0.2)
- Fixed the hero background image URL: stylesheets now load `assets/images/background.png` from the correct relative path (`../images/background.png`).
- Adjusted the hero section to fit the viewport and contain the transparent team photo on the right without cropping it off-screen.
- Removed the dark/light mode toggle button and its JavaScript. The site now keeps its original dark appearance.
- Clear WordPress, browser, and CDN caches after updating the theme.


## Full Portfolio Editing (v1.0.3)

After activating the theme, open **WordPress Dashboard → Portfolio Editor**.

The Portfolio Editor lets you update:
- Homepage hero headings, subtitle, description, marquee, button labels, background image, and foreground/team image.
- Navigation logo text.
- About section heading, subtitle, team member names, roles, descriptions, profile photos, skills (JSON), skill percentages, and skill tags.
- Education heading, school, degree, period, location, school and department logos, descriptions, highlights, and statistics.
- Project card titles, descriptions, images, and language labels.
- Service titles, descriptions, and technology tags.
- Achievement counts and labels.
- Testimonial quotes, author names, roles, and avatar image fields.
- Blog titles, descriptions, images, categories, and dates.
- Social gallery heading and handle, contact details, contact gallery images, social profile URLs, and footer text.

For project detail modal content and slider images, use **Dashboard → Projects**. Add or edit a Project, set its Featured Image, and complete the Portfolio details fields. For slider images, enter the Media Library attachment IDs as comma-separated values in the Slider image IDs field (the media picker can be used to find each image and its attachment ID).

For navigation links, use **Appearance → Menus**.

The theme preserves the custom front-end layout and JavaScript modal interactions. This editor does not turn the site into a block/page-builder theme; it provides dashboard fields while retaining the original design.

After saving changes, clear any caching plugin/CDN cache and hard-refresh the site.
