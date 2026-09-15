<?php
/**
 * Plugin Name:     OCanel Livechat
 * Plugin URI:      https://ocanel.com/
 * Description:     OCanel Plugin for WordPress. This plugin helps you to quickly integrate OCanel live-chat widget on Wordpress websites.
 * Author:          heerrr
 * Author URI:      ocanel.com
 * Text Domain:     ocanel-plugin
 * Version:         0.1
 *
 * @package         ocanel-plugin
 */

add_action('admin_enqueue_scripts', 'admin_styles');
/**
 * Load OCanel Admin CSS.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function admin_styles()
{
    wp_enqueue_style('admin-styles', plugin_dir_url(__FILE__) . '/admin.css');
}

 add_action('wp_enqueue_scripts', 'ocanel_assets');
/**
 * Load OCanel Assets.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function ocanel_assets()
{
    wp_enqueue_script('ocanel-client', plugins_url('/js/ocanel.js', __FILE__));
}

add_action('wp_enqueue_scripts', 'ocanel_load');
/**
 * Initialize embed code options.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function ocanel_load()
{

  // Get our site options for site url and token.
    $ocanel_url = get_option('ocanelSiteURL');
    $ocanel_token = get_option('ocanelSiteToken');
    $ocanel_widget_locale = get_option('ocanelWidgetLocale');
    $ocanel_widget_type = get_option('ocanelWidgetType');
    $ocanel_widget_position = get_option('ocanelWidgetPosition');
    $ocanel_launcher_text = get_option('ocanelLauncherText');

    // Localize our variables for the Javascript embed code.
    wp_localize_script('ocanel-client', 'ocanel_token', $ocanel_token);
    wp_localize_script('ocanel-client', 'ocanel_url', $ocanel_url);
    wp_localize_script('ocanel-client', 'ocanel_widget_locale', $ocanel_widget_locale);
    wp_localize_script('ocanel-client', 'ocanel_widget_type', $ocanel_widget_type);
    wp_localize_script('ocanel-client', 'ocanel_launcher_text', $ocanel_launcher_text);
    wp_localize_script('ocanel-client', 'ocanel_widget_position', $ocanel_widget_position);
}

add_action('admin_menu', 'ocanel_setup_menu');
/**
 * Set up Settings options page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function ocanel_setup_menu()
{
    add_options_page('Option', 'OCanel Settings', 'manage_options', 'ocanel-plugin-options', 'ocanel_options_page');
}

add_action('admin_init', 'ocanel_register_settings');
/**
 * Register Settings.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function ocanel_register_settings()
{
    add_option('ocanelSiteToken', '');
    add_option('ocanelSiteURL', '');
    add_option('ocanelWidgetLocale', 'en');
    add_option('ocanelWidgetType', 'standard');
    add_option('ocanelWidgetPosition', 'right');
    add_option('ocanelLauncherText', '');

    register_setting('ocanel-plugin-options', 'ocanelSiteToken');
    register_setting('ocanel-plugin-options', 'ocanelSiteURL');
    register_setting('ocanel-plugin-options', 'ocanelWidgetLocale');
    register_setting('ocanel-plugin-options', 'ocanelWidgetType');
    register_setting('ocanel-plugin-options', 'ocanelWidgetPosition');
    register_setting('ocanel-plugin-options', 'ocanelLauncherText');
}

/**
 * Render page.
 *
 * @since 0.1.0
 *
 * @return {void}.
 */
function ocanel_options_page()
{
    ?>
  <div>
    <h2>OCanel Settings</h2>
    <form method="post" action="options.php" class="ocanel--form">
      <?php settings_fields('ocanel-plugin-options'); ?>
      <div class="form--input">
        <label for="ocanelSiteURL">OCanel Site URL</label>
        <input
          type="text"
          name="ocanelSiteURL"
          value="<?php echo get_option('ocanelSiteURL'); ?>"
        />
      </div>
      <div class="form--input">
        <label for="ocanelSiteToken">OCanel Website Token</label>
        <input
          type="text"
          name="ocanelSiteToken"
          value="<?php echo get_option('ocanelSiteToken'); ?>"
        />
      </div>
      <hr />
      <div class="form--input">
        <label for="ocanelWidgetType">Widget Design</label>
        <select name="ocanelWidgetType">
          <option value="standard" <?php selected(get_option('ocanelWidgetType'), 'standard'); ?>>Standard</option>
          <option value="expanded_bubble" <?php selected(get_option('ocanelWidgetType'), 'expanded_bubble'); ?>>Expanded Bubble</option>
        </select>
      </div>
      <div class="form--input">
        <label for="ocanelWidgetPosition">Widget Position</label>
        <select name="ocanelWidgetPosition">
          <option value="left" <?php selected(get_option('ocanelWidgetPosition'), 'left'); ?>>Left</option>
          <option value="right" <?php selected(get_option('ocanelWidgetPosition'), 'right'); ?>>Right</option>
        </select>
      </div>
      <div class="form--input">
        <label for="ocanelWidgetLocale">Language</label>
        <select name="ocanelWidgetLocale">
          <option <?php selected(get_option('ocanelWidgetLocale'), 'ar'); ?> value="ar">العربية (ar)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'ca'); ?> value="ca">Català (ca)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'cs'); ?> value="cs">čeština (cs)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'da'); ?> value="da">dansk (da)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'de'); ?> value="de">Deutsch (de)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'el'); ?> value="el">ελληνικά (el)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'en'); ?> value="en">English (en)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'es'); ?> value="es">Español (es)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'fa'); ?> value="fa">فارسی (fa)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'fi'); ?> value="fi">suomi, suomen kieli (fi)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'fr'); ?> value="fr">Français (fr)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'hi'); ?> value="hi'">हिन्दी (hi)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'hu'); ?> value="hu">magyar nyelv (hu)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'id'); ?> value="id">Bahasa Indonesia (id)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'it'); ?> value="it">Italiano (it)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'ja'); ?> value="ja">日本語 (ja)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'ko'); ?> value="ko">한국어 (ko)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'ml'); ?> value="ml">മലയാളം (ml)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'nl'); ?> value="nl">Nederlands (nl) </option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'no'); ?> value="no">norsk (no)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'pl'); ?> value="pl">język polski (pl)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'pt_BR'); ?> value="pt_BR">Português Brasileiro (pt-BR)
          <option <?php selected(get_option('ocanelWidgetLocale'), 'pt'); ?> value="pt">Português (pt)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'ro'); ?> value="ro">Română (ro)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'ru'); ?> value="ru">русский (ru)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'sv'); ?> value="sv">Svenska (sv)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'ta'); ?> value="ta">தமிழ் (ta)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'tr'); ?> value="tr">Türkçe (tr)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'vi'); ?> value="vi">Tiếng Việt (vi)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'zh_CN'); ?> value="zh_CN">中文 (zh-CN)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'zh_TW'); ?> value="zh_TW">中文 (台湾) (zh-TW)</option>
          <option <?php selected(get_option('ocanelWidgetLocale'), 'zh'); ?> value="zh'">中文 (zh)</option>
        </select>
      </div>
      <?php if (get_option('ocanelWidgetType') == 'expanded_bubble') : ?>
        <div class="form--input">
          <label for="ocanelLauncherText">Launcher Text (Optional)</label>
          <input
            type="text"
            name="ocanelLauncherText"
            value="<?php echo get_option('ocanelLauncherText'); ?>"
          />
        </div>
      <?php endif; ?>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
}
