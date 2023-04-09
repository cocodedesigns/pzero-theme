<?php
/**
 * Registers options with the Theme Customizer
 *
 * @param      object    $wp_customize    The WordPress Theme Customizer
 * @package    Dosth
 */

function nd_dosth_customize_register( $wp_customize ) {
  //Settings
  $wp_customize->add_setting( 'copyright_text', array(
    'default' => '' 
  ) );
  $wp_customize->add_setting( 'theme_color', array(
    'capability'        => 'edit_theme_options',
    'default'           => '',
  ) );
  $wp_customize->add_setting( 'custom_logo', array(
    'capability'        => 'edit_theme_options',
    'default'           => ''
  ) );

  //Sections
  $wp_customize->add_section(
      'mytheme_themeopts',
      array(
          'title' => __( 'Theme Options', '_s' ),
          'priority' => 100,
          'description' => __( 'Options for the Project Zero theme', '_s' )
      )
  );

  //Controls
  //Twitter
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize, 'copyright_text',
          array(
              'label' => __( 'Copyright Text', '_s' ),
              'section' => 'mytheme_themeopts',
              'settings' => 'copyright_text'
          )
      )
  );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_color',
      array(
          'label'    => __( 'Button Color', 'text-domain' ),
          'section'  => 'mytheme_themeopts',
          'settings' => 'theme_color',
      )
  ));

  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'custom_logo',
      array(
          'label'    => __( 'Logo', 'text-domain' ),
          'section'  => 'mytheme_themeopts',
          'settings' => 'custom_logo',
      )
  ) );
  
}
add_action( 'customize_register', 'nd_dosth_customize_register' );