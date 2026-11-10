<?php
/**
 * Portfolio2k26 footer.
 * Run original page interactions after all portfolio markup has been rendered,
 * so profile "SEE MORE" pages and both modal systems can find their DOM elements.
 */
if (function_exists('portfolio2k26_print_interactions')) {
    portfolio2k26_print_interactions();
}
wp_footer();
?>
