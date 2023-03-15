<?php

class WP_Turbo_My_Plugin_Settings {

private $capability = 'manage_options';

private $fields = [
  [
    'id' => 'text',
    'label' => 'Text Field',
    'description' => 'Description',
    'type' => 'text',
  ],
  [
    'id' => 'textarea',
    'label' => 'Textarea',
    'description' => 'Textarea description',
    'type' => 'textarea',
  ],
  [
    'id' => 'checkbox',
    'label' => 'CHeckbox',
    'description' => 'Checkbox description',
    'type' => 'checkbox',
  ],
  [
    'id' => 'select',
    'label' => 'Select',
    'description' => 'Select description',
    'type' => 'select',
    'options' => [
      'Option One' => 'Option One',
      'Option Two' => 'Option Two',
      'Option Three' => 'Option Three',
    ],
  ],
  [
    'id' => 'password',
    'label' => 'Password',
    'description' => 'Password description',
    'type' => 'password',
  ],
  [
    'id' => 'wysiwyg',
    'label' => 'WYSIWYG',
    'description' => 'WYSIWYG Description',
    'type' => 'wysiwyg',
  ],
  [
    'id' => 'email',
    'label' => 'Email',
    'description' => 'email description',
    'type' => 'email',
  ],
  [
    'id' => 'url',
    'label' => 'URL',
    'description' => 'URL description',
    'type' => 'url',
  ],
  [
    'id' => 'color',
    'label' => 'Colour',
    'description' => 'Colour field',
    'type' => 'color',
  ],
  [
    'id' => 'date',
    'label' => 'Date field',
    'description' => 'Date field descripion',
    'type' => 'date',
  ],
];

function __construct() {
  add_action( 'admin_init', [$this, 'settings_init'] );
  add_action( 'admin_menu', [$this, 'options_page'] );
}

function settings_init(): void {

  // Register a new setting this page.
  register_setting( 'my-plugin-settings', 'wporg_options' );


  // Register a new section.
  add_settings_section(
    'my-plugin-settings-section',
    __( 'SECTION DESCRIPTION', 'my-plugin-settings' ),
    [$this, 'render_section'],
    'my-plugin-settings'
  );


  /* Register All The Fields. */
  foreach( $this->fields as $field ) {
    // Register a new field in the main section.
    add_settings_field(
      $field['id'], /* ID for the field. Only used internally. To set the HTML ID attribute, use $args['label_for']. */
      __( $field['label'], 'my-plugin-settings' ), /* Label for the field. */
      [$this, 'render_field'], /* The name of the callback function. */
      'my-plugin-settings', /* The menu page on which to display this field. */
      'my-plugin-settings-section', /* The section of the settings page in which to show the box. */
      [
        'label_for' => $field['id'], /* The ID of the field. */
        'class' => 'wporg_row', /* The class of the field. */
        'field' => $field, /* Custom data for the field. */
      ]
    );
  }
}

function options_page(): void {
  add_submenu_page(
    'options-general.php', /* Parent Menu Slug */
    'Settings', /* Page Title */
    'My Plugin\'s Settings Page', /* Menu Title */
    $this->capability, /* Capability */
    'my-plugin-settings', /* Menu Slug */
    [$this, 'render_options_page'], /* Callback */
  );
}

function render_options_page(): void {

  // check user capabilities
  if ( ! current_user_can( $this->capability ) ) {
    return;
  }

  // add error/update messages

  // check if the user have submitted the settings
  // WordPress will add the "settings-updated" $_GET parameter to the url
  if ( isset( $_GET['settings-updated'] ) ) {
    // add settings saved message with the class of "updated"
    add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'my-plugin-settings' ), 'updated' );
  }

  // show error/update messages
  settings_errors( 'wporg_messages' );
  ?>
  <div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <h2 class="description">PAGE DESCRIPTION</h2>
    <form action="options.php" method="post">
      <?php
      /* output security fields for the registered setting "wporg" */
      settings_fields( 'my-plugin-settings' );
      /* output setting sections and their fields */
      /* (sections are registered for "wporg", each field is registered to a specific section) */
      do_settings_sections( 'my-plugin-settings' );
      /* output save settings button */
      submit_button( 'Save Settings' );
      ?>
    </form>
  </div>
  <?php
}

function render_field( array $args ): void {

  $field = $args['field'];

  // Get the value of the setting we've registered with register_setting()
  $options = get_option( 'wporg_options' );

  switch ( $field['type'] ) {

    case "text": {
      ?>
      <input
        type="text"
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
        value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
      >
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

    case "checkbox": {
      ?>
      <input
        type="checkbox"
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
        value="1"
        <?php echo isset( $options[ $field['id'] ] ) ? ( checked( $options[ $field['id'] ], 1, false ) ) : ( '' ); ?>
      >
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

    case "textarea": {
      ?>
      <textarea
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
      ><?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?></textarea>
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

    case "select": {
      ?>
      <select
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
      >
        <?php foreach( $field['options'] as $key => $option ) { ?>
          <option value="<?php echo $key; ?>" 
            <?php echo isset( $options[ $field['id'] ] ) ? ( selected( $options[ $field['id'] ], $key, false ) ) : ( '' ); ?>
          >
            <?php echo $option; ?>
          </option>
        <?php } ?>
      </select>
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

    case "password": {
      ?>
      <input
        type="password"
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
        value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
      >
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

    case "wysiwyg": {
      wp_editor(
        isset( $options[ $field['id'] ] ) ? $options[ $field['id'] ] : '',
        $field['id'],
        array(
          'textarea_name' => 'wporg_options[' . $field['id'] . ']',
          'textarea_rows' => 5,
        )
      );
      break;
    }

    case "email": {
      ?>
      <input
        type="email"
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
        value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
      >
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

    case "url": {
      ?>
      <input
        type="url"
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
        value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
      >
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

    case "color": {
      ?>
      <input
        type="color"
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
        value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
      >
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

    case "date": {
      ?>
      <input
        type="date"
        id="<?php echo esc_attr( $field['id'] ); ?>"
        name="wporg_options[<?php echo esc_attr( $field['id'] ); ?>]"
        value="<?php echo isset( $options[ $field['id'] ] ) ? esc_attr( $options[ $field['id'] ] ) : ''; ?>"
      >
      <p class="description">
        <?php esc_html_e( $field['description'], 'my-plugin-settings' ); ?>
      </p>
      <?php
      break;
    }

  }
}


function render_section( array $args ): void {
  ?>
  <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'SECTION TITLE', 'my-plugin-settings' ); ?></p>
  <?php
}

}

new WP_Turbo_My_Plugin_Settings();

