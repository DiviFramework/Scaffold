<?php
namespace {{namespace}};

/**
 * Class Options is used to create options pages.
 */
class Options
{
    protected $tabs;
    protected $optionsDefinition;
    protected $defaultOptions;
    protected $container;


    protected $title = "Options Title";
    protected $saveButtonText = "Save Changes";
    protected $nonceFieldName;
    protected $optionsKey;

    public function __construct($container, $optionsKey, $tabs, $optionsDefinition, $defaultOptions)
    {
        $this->container = $container;
        $this->optionsKey = $optionsKey;
        $this->tabs = $tabs;
        $this->optionsDefinition = $optionsDefinition;
        $this->nonceFieldName = $optionsKey;
        $this->defaultOptions = $defaultOptions;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setButtonText($saveButtonText)
    {
        $this->saveButtonText = $saveButtonText;
    }

    public function setNonceFieldName($fieldName)
    {
        $this->nonceFieldName = $fieldName;
    }


    /**
     * Render the options page.
     */
    public function renderOptions()
    {
        $container = $this->container;
        $is_settings_updated = false;
        $is_settings_updated_success = $this->container['plugin_name'];
        $plugin_id = $this->optionsKey;

        // check nonce and save options.
        if (!empty($_POST) && isset($_POST[$this->nonceFieldName])) {
            if (wp_verify_nonce($_POST[$this->nonceFieldName], $this->container['plugin_slug'])) {
                update_option($this->optionsKey, $_POST);
                $is_settings_updated_message = __('Your setting has been updated.');
            } else {
                $is_settings_updated_message = __('Error updating your settings. Nonce failed.');
            }
            $is_settings_updated = true;
        }

        $this->saved_values  =  $this->getSettings();

        wp_enqueue_style($this->optionsKey . '-epanel-css', $this->container['plugin_url'] . '/resources/css/epanel.css', array(), '0.0.1');

        wp_enqueue_script($this->optionsKey . '-epanel-scripts', $this->container['plugin_url'] . '/resources/js/epanel.js', array( 'jquery', 'iris' ), '0.0.1', true);
        include $this->container['plugin_dir'] .'/resources/views/options/default.php';
    }


    /**
     * Get Settings
     */
    public function getSettings()
    {
        $options = get_option($this->optionsKey, array());
        return wp_parse_args(
            $options,
            $this->defaultOptions
        );
    }


    /**
     * Get setting value.
     */
    public function getValue($key, $default = '')
    {

        if (isset($this->saved_values[ $key ])) {
            return $this->saved_values[ $key ];
        }

            return $default;
    }
}
