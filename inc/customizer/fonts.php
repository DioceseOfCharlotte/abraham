<?php

/**
 * Theme Customizer Fonts.
 *
 * @author      The Theme Foundry
 */
if (!function_exists('customizer_library_get_font_choices')) :
/**
 * Packages the font choices into value/label pairs for use with the customizer.
 *
 * @since  1.0.0.
 *
 * @return array    The fonts in value/label pairs.
 */
function customizer_library_get_all_fonts() {
    $heading1       = array(1 => array('label' => sprintf('--- %s ---', __('Standard Fonts', 'customizer-library'))));
    $standard_fonts = customizer_library_get_standard_fonts();
    $heading2       = array(2 => array('label' => sprintf('--- %s ---', __('Google Fonts', 'customizer-library'))));
    $google_fonts   = customizer_library_get_google_fonts();

    /*
     * Allow for developers to modify the full list of fonts.
     *
     * @since 1.3.0.
     *
     * @param array    $fonts    The list of all fonts.
     */
    return apply_filters('customizer_library_all_fonts', array_merge($heading1, $standard_fonts, $heading2, $google_fonts));
}
endif;

if (!function_exists('customizer_library_get_font_choices')) :
/**
 * Packages the font choices into value/label pairs for use with the customizer.
 *
 * @since  1.0.0.
 *
 * @return array    The fonts in value/label pairs.
 */
function customizer_library_get_font_choices() {
    $fonts   = customizer_library_get_all_fonts();
    $choices = array();

    // Repackage the fonts into value/label pairs
    foreach ($fonts as $key => $font) {
        $choices[ $key ] = $font['label'];
    }

    return $choices;
}
endif;

if (!function_exists('customizer_library_get_google_font_uri')) :
/**
 * Build the HTTP request URL for Google Fonts.
 *
 * @since  1.0.0.
 *
 * @return string    The URL for including Google Fonts.
 */
function customizer_library_get_google_font_uri($fonts) {

    // De-dupe the fonts
    $fonts         = array_unique($fonts);
    $allowed_fonts = customizer_library_get_google_fonts();
    $family        = array();

    // Validate each font and convert to URL format
    foreach ($fonts as $font) {
        $font = trim($font);

        // Verify that the font exists
        if (array_key_exists($font, $allowed_fonts)) {
            // Build the family name and variant string (e.g., "Open+Sans:regular,italic,700")
            $family[] = urlencode($font.':'.implode(',', customizer_library_choose_google_font_variants($font, $allowed_fonts[ $font ]['variants'])));
        }
    }

    // Convert from array to string
    if (empty($family)) {
        return '';
    } else {
        $request = '//fonts.googleapis.com/css?family='.implode('|', $family);
    }

    // Load the font subset
    $subset = get_theme_mod('font-subset', 'default');

    if ('all' === $subset) {
        $subsets_available = customizer_library_get_google_font_subsets();

        // Remove the all set
        unset($subsets_available['all']);

        // Build the array
        $subsets = array_keys($subsets_available);
    } else {
        $subsets = array(
            'latin',
            $subset,
        );
    }

    // Append the subset string
    if (!empty($subsets)) {
        $request .= urlencode('&subset='.implode(',', $subsets));
    }

    return esc_url($request);
}
endif;

if (!function_exists('customizer_library_get_google_font_subsets')) :
/**
 * Retrieve the list of available Google font subsets.
 *
 * @since  1.0.0.
 *
 * @return array    The available subsets.
 */
function customizer_library_get_google_font_subsets() {
    return array(
        'all'          => __('All', 'textdomain'),
        'cyrillic'     => __('Cyrillic', 'textdomain'),
        'cyrillic-ext' => __('Cyrillic Extended', 'textdomain'),
        'devanagari'   => __('Devanagari', 'textdomain'),
        'greek'        => __('Greek', 'textdomain'),
        'greek-ext'    => __('Greek Extended', 'textdomain'),
        'khmer'        => __('Khmer', 'textdomain'),
        'latin'        => __('Latin', 'textdomain'),
        'latin-ext'    => __('Latin Extended', 'textdomain'),
        'vietnamese'   => __('Vietnamese', 'textdomain'),
    );
}
endif;

if (!function_exists('customizer_library_choose_google_font_variants')) :
/**
 * Given a font, chose the variants to load for the theme.
 *
 * Attempts to load regular, italic, and 700. If regular is not found, the first variant in the family is chosen. italic
 * and 700 are only loaded if found. No fallbacks are loaded for those fonts.
 *
 * @since  1.0.0.
 *
 * @param  string    $font        The font to load variants for.
 * @param  array     $variants    The variants for the font.
 *
 * @return array                  The chosen variants.
 */
function customizer_library_choose_google_font_variants($font, $variants = array()) {
    $chosen_variants = array();
    if (empty($variants)) {
        $fonts = customizer_library_get_google_fonts();

        if (array_key_exists($font, $fonts)) {
            $variants = $fonts[ $font ]['variants'];
        }
    }

    // If a "regular" variant is not found, get the first variant
    if (!in_array('regular', $variants)) {
        $chosen_variants[] = $variants[0];
    } else {
        $chosen_variants[] = 'regular';
    }

    // Only add "italic" if it exists
    if (in_array('italic', $variants)) {
        $chosen_variants[] = 'italic';
    }

    // Only add "300" if it exists
    if (in_array('300', $variants)) {
        $chosen_variants[] = '300';
    }

    // Only add "400" if it exists
    if (in_array('400', $variants)) {
        $chosen_variants[] = '400';
    }

    // Only add "500" if it exists
    if (in_array('500', $variants)) {
        $chosen_variants[] = '500';
    }

    // Only add "700" if it exists
    if (in_array('700', $variants)) {
        $chosen_variants[] = '700';
    }

    return apply_filters('customizer_library_font_variants', array_unique($chosen_variants), $font, $variants);
}
endif;

if (!function_exists('customizer_library_get_standard_fonts')) :
/**
 * Return an array of standard websafe fonts.
 *
 * @since  1.0.0.
 *
 * @return array    Standard websafe fonts.
 */
function customizer_library_get_standard_fonts() {
    return array(
        'serif' => array(
            'label' => _x('Serif', 'font style', 'textdomain'),
            'stack' => 'Georgia,Times,"Times New Roman",serif',
        ),
        'sans-serif' => array(
            'label' => _x('Sans Serif', 'font style', 'textdomain'),
            'stack' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
        ),
        'monospace' => array(
            'label' => _x('Monospaced', 'font style', 'textdomain'),
            'stack' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
        ),
    );
}
endif;

if (!function_exists('customizer_library_get_font_stack')) :
/**
 * Validate the font choice and get a font stack for it.
 *
 * @since  1.0.0.
 *
 * @param  string    $font    The 1st font in the stack.
 *
 * @return string             The full font stack.
 */
function customizer_library_get_font_stack($font) {
    $all_fonts = customizer_library_get_all_fonts();

    // Sanitize font choice
    $font = customizer_library_sanitize_font_choice($font);

    $sans  = '"Helvetica Neue",sans-serif';
    $serif = 'Georgia, serif';

    // Use stack if one is identified
    if (isset($all_fonts[ $font ]['stack']) && !empty($all_fonts[ $font ]['stack'])) {
        $stack = $all_fonts[ $font ]['stack'];
    } else {
        $stack = '"'.$font.'",'.$sans;
    }

    return $stack;
}
endif;

if (!function_exists('customizer_library_sanitize_font_choice')) :
/**
 * Sanitize a font choice.
 *
 * @since  1.0.0.
 *
 * @param  string    $value    The font choice.
 *
 * @return string              The sanitized font choice.
 */
function customizer_library_sanitize_font_choice($value) {
    if (is_int($value)) {
        // The array key is an integer, so the chosen option is a heading, not a real choice
        return '';
    } elseif (array_key_exists($value, customizer_library_get_font_choices())) {
        return $value;
    } else {
        return '';
    }
}
endif;

if (!function_exists('customizer_library_get_google_fonts')) :
/**
 * Return an array of all available Google Fonts.
 *
 * @since  1.0.0.
 *
 * @return array    All Google Fonts.
 */
function customizer_library_get_google_fonts() {
    return apply_filters('customizer_library_get_google_fonts', array(
        'Arimo' => array(
            'label'    => 'Arimo',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Arvo' => array(
            'label'    => 'Arvo',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Cabin' => array(
            'label'    => 'Cabin',
            'variants' => array(
                'regular',
                'italic',
                '500',
                '500italic',
                '600',
                '600italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Cabin Condensed' => array(
            'label'    => 'Cabin Condensed',
            'variants' => array(
                'regular',
                '500',
                '600',
                '700',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Cabin Sketch' => array(
            'label'    => 'Cabin Sketch',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Cinzel' => array(
            'label'    => 'Cinzel',
            'variants' => array(
                'regular',
                '700',
                '900',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Cinzel Decorative' => array(
            'label'    => 'Cinzel Decorative',
            'variants' => array(
                'regular',
                '700',
                '900',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Crimson Text' => array(
            'label'    => 'Crimson Text',
            'variants' => array(
                'regular',
                'italic',
                '600',
                '600italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Droid Sans' => array(
            'label'    => 'Droid Sans',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Droid Sans Mono' => array(
            'label'    => 'Droid Sans Mono',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Droid Serif' => array(
            'label'    => 'Droid Serif',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'EB Garamond' => array(
            'label'    => 'EB Garamond',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'vietnamese',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Finger Paint' => array(
            'label'    => 'Finger Paint',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Fira Sans' => array(
            'label'    => 'Fira Sans',
            'variants' => array(
                '300',
                '300italic',
                '400',
                '400italic',
                '500',
                '500italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'greek',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Fira Mono' => array(
            'label'    => 'Fira Mono',
            'variants' => array(
                '400',
                '700',
            ),
            'subsets' => array(
                'latin',
                'greek',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Forum' => array(
            'label'    => 'Forum',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Gentium Basic' => array(
            'label'    => 'Gentium Basic',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Gentium Book Basic' => array(
            'label'    => 'Gentium Book Basic',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Give You Glory' => array(
            'label'    => 'Give You Glory',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Glass Antiqua' => array(
            'label'    => 'Glass Antiqua',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Glegoo' => array(
            'label'    => 'Glegoo',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Gloria Hallelujah' => array(
            'label'    => 'Gloria Hallelujah',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Goblin One' => array(
            'label'    => 'Goblin One',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Gochi Hand' => array(
            'label'    => 'Gochi Hand',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Gorditas' => array(
            'label'    => 'Gorditas',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Goudy Bookletter 1911' => array(
            'label'    => 'Goudy Bookletter 1911',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Graduate' => array(
            'label'    => 'Graduate',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Italiana' => array(
            'label'    => 'Italiana',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Italianno' => array(
            'label'    => 'Italianno',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Josefin Sans' => array(
            'label'    => 'Josefin Sans',
            'variants' => array(
                '100',
                '100italic',
                '300',
                '300italic',
                'regular',
                'italic',
                '600',
                '600italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Josefin Slab' => array(
            'label'    => 'Josefin Slab',
            'variants' => array(
                '100',
                '100italic',
                '300',
                '300italic',
                'regular',
                'italic',
                '600',
                '600italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Kotta One' => array(
            'label'    => 'Kotta One',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Lato' => array(
            'label'    => 'Lato',
            'variants' => array(
                '100',
                '100italic',
                '300',
                '300italic',
                'regular',
                'italic',
                '700',
                '700italic',
                '900',
                '900italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'League Script' => array(
            'label'    => 'League Script',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Ledger' => array(
            'label'    => 'Ledger',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
            ),
        ),
        'Libre Baskerville' => array(
            'label'    => 'Libre Baskerville',
            'variants' => array(
                'regular',
                'italic',
                '700',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Lobster' => array(
            'label'    => 'Lobster',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Lobster Two' => array(
            'label'    => 'Lobster Two',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Lora' => array(
            'label'    => 'Lora',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
            ),
        ),
        'Love Ya Like A Sister' => array(
            'label'    => 'Love Ya Like A Sister',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Loved by the King' => array(
            'label'    => 'Loved by the King',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Lustria' => array(
            'label'    => 'Lustria',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Marcellus' => array(
            'label'    => 'Marcellus',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Marcellus SC' => array(
            'label'    => 'Marcellus SC',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Marvel' => array(
            'label'    => 'Marvel',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Merriweather' => array(
            'label'    => 'Merriweather',
            'variants' => array(
                '300',
                '300italic',
                'regular',
                'italic',
                '700',
                '700italic',
                '900',
                '900italic',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Merriweather Sans' => array(
            'label'    => 'Merriweather Sans',
            'variants' => array(
                '300',
                '300italic',
                'regular',
                'italic',
                '700',
                '700italic',
                '800',
                '800italic',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Modern Antiqua' => array(
            'label'    => 'Modern Antiqua',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Noto Sans' => array(
            'label'    => 'Noto Sans',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'devanagari',
                'cyrillic-ext',
            ),
        ),
        'Noto Serif' => array(
            'label'    => 'Noto Serif',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Old Standard TT' => array(
            'label'    => 'Old Standard TT',
            'variants' => array(
                'regular',
                'italic',
                '700',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Oldenburg' => array(
            'label'    => 'Oldenburg',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Oleo Script' => array(
            'label'    => 'Oleo Script',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Oleo Script Swash Caps' => array(
            'label'    => 'Oleo Script Swash Caps',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Open Sans' => array(
            'label'    => 'Open Sans',
            'variants' => array(
                '300',
                '300italic',
                'regular',
                'italic',
                '600',
                '600italic',
                '700',
                '700italic',
                '800',
                '800italic',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'devanagari',
                'cyrillic-ext',
            ),
        ),
        'Open Sans Condensed' => array(
            'label'    => 'Open Sans Condensed',
            'variants' => array(
                '300',
                '300italic',
                '700',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Oswald' => array(
            'label'    => 'Oswald',
            'variants' => array(
                '300',
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Ovo' => array(
            'label'    => 'Ovo',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Oxygen' => array(
            'label'    => 'Oxygen',
            'variants' => array(
                '300',
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Oxygen Mono' => array(
            'label'    => 'Oxygen Mono',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'PT Mono' => array(
            'label'    => 'PT Mono',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'PT Sans' => array(
            'label'    => 'PT Sans',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'PT Sans Caption' => array(
            'label'    => 'PT Sans Caption',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'PT Sans Narrow' => array(
            'label'    => 'PT Sans Narrow',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'PT Serif' => array(
            'label'    => 'PT Serif',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'PT Serif Caption' => array(
            'label'    => 'PT Serif Caption',
            'variants' => array(
                'regular',
                'italic',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Pacifico' => array(
            'label'    => 'Pacifico',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Playfair Display' => array(
            'label'    => 'Playfair Display',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
                '900',
                '900italic',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
            ),
        ),
        'Playfair Display SC' => array(
            'label'    => 'Playfair Display SC',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
                '900',
                '900italic',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
            ),
        ),
        'Poiret One' => array(
            'label'    => 'Poiret One',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'cyrillic',
                'latin-ext',
            ),
        ),
        'Puritan' => array(
            'label'    => 'Puritan',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Purple Purse' => array(
            'label'    => 'Purple Purse',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Raleway' => array(
            'label'    => 'Raleway',
            'variants' => array(
                '100',
                '200',
                '300',
                'regular',
                '500',
                '600',
                '700',
                '800',
                '900',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Roboto' => array(
            'label'    => 'Roboto',
            'variants' => array(
                '100',
                '100italic',
                'regular',
                'italic',
                '300',
                '300italic',
                '400',
                '400italic',
                '500',
                '500italic',
                '700',
                '700italic',
                '900',
                '900italic',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Roboto Condensed' => array(
            'label'    => 'Roboto Condensed',
            'variants' => array(
                '300',
                '300italic',
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Roboto Slab' => array(
            'label'    => 'Roboto Slab',
            'variants' => array(
                '100',
                '300',
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Rokkitt' => array(
            'label'    => 'Rokkitt',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
            ),
        ),
        'Rubik One' => array(
            'label'    => 'Rubik One',
            'variants' => array(
                '400',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Rubik Mono One' => array(
            'label'    => 'Rubik Mono One',
            'variants' => array(
                '400',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Rufina' => array(
            'label'    => 'Rufina',
            'variants' => array(
                'regular',
                '700',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Source Code Pro' => array(
            'label'    => 'Source Code Pro',
            'variants' => array(
                '200',
                '300',
                'regular',
                '500',
                '600',
                '700',
                '900',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Source Sans Pro' => array(
            'label'    => 'Source Sans Pro',
            'variants' => array(
                '200',
                '200italic',
                '300',
                '300italic',
                'regular',
                'italic',
                '600',
                '600italic',
                '700',
                '700italic',
                '900',
                '900italic',
            ),
            'subsets' => array(
                'latin',
                'vietnamese',
                'latin-ext',
            ),
        ),
        'Source Serif Pro' => array(
            'label'    => 'Source Serif Pro',
            'variants' => array(
                '400',
                '600',
                '700',
            ),
            'subsets' => array(
                'latin',
                'latin-ext',
            ),
        ),
        'Tinos' => array(
            'label'    => 'Tinos',
            'variants' => array(
                'regular',
                'italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'vietnamese',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Ubuntu' => array(
            'label'    => 'Ubuntu',
            'variants' => array(
                '300',
                '300italic',
                'regular',
                'italic',
                '500',
                '500italic',
                '700',
                '700italic',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
        'Ubuntu Condensed' => array(
            'label'    => 'Ubuntu Condensed',
            'variants' => array(
                'regular',
            ),
            'subsets' => array(
                'latin',
                'greek-ext',
                'cyrillic',
                'greek',
                'latin-ext',
                'cyrillic-ext',
            ),
        ),
    ));
}
endif;
