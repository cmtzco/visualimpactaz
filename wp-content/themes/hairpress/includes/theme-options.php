<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General'
      ),
      array(
        'id'          => 'contact_page_section',
        'title'       => 'Contact page'
      ),
      array(
        'id'          => 'layout_section',
        'title'       => 'Layout'
      ),
      array(
        'id'          => 'front_page_section',
        'title'       => 'Front page'
      ),
      array(
        'id'          => 'social_icons',
        'title'       => 'Social icons'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'appointment_button',
        'label'       => 'Featured page in the main menu',
        'desc'        => 'The selected page will be displayed next to the main menu at the top of the page in the button',
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'blog_page_title',
        'label'       => 'Title of the blog page',
        'desc'        => 'Select the name of the title for page where the blog posts will be displayed. If left empty, the blog title will be used',
        'std'         => 'Latest News',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'services_page_title',
        'label'       => 'Title of the services page',
        'desc'        => 'The title for the page where services are displayed',
        'std'         => 'Our Services',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'services_url_slug',
        'label'       => 'URL of The Services page',
        'desc'        => 'Only lowercase letters, numbers and dash (-) allowed! This will be the URL of the page where all the services will appear, for example <code>http://www.yoursite.com/<b>our-services</b></code>. Add only what comes after your WP installation URL, for example <b>\'our-services\'</b>. <br />
Make sure you save again the settings in <b>Setting → Permalinks</b> after editing and saving this in order for changes to take effect!!!',
        'std'         => 'services',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'gallery_page_title',
        'label'       => 'Title of the gallery page',
        'desc'        => 'The title for the page where galleries are displayed',
        'std'         => 'Gallery',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'gallery_url_slug',
        'label'       => 'URL of the Gallery page',
        'desc'        => 'Only lowercase letters, numbers and dash (-) allowed! This will be the URL of the page where all the galleries will appear, for example <code>http://www.yoursite.com/<b>our-fine-galleries</b></code>. Add only what comes after your WP installation URL, for example <b>\'our-fine-galleries\'</b>. <br />
Make sure you save again the settings in <b>Setting → Permalinks</b> after editing and saving this in order for changes to take effect!!!',
        'std'         => 'gallery',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'team_page_title',
        'label'       => 'Title of the team page',
        'desc'        => 'The title for the page where team members are displayed',
        'std'         => 'Meet the team',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'the_team_url_slug',
        'label'       => 'URL of the Meet the Team page',
        'desc'        => 'Only lowercase letters, numbers and dash (-) allowed! This will be the URL of the page where all the team members will appear, for example <code>http://www.yoursite.com/<b>our-team-and-more</b></code>. Add only what comes after your WP installation URL, for example <b>\'our-team-and-more\'</b>. <br />
Make sure you save again the settings in <b>Setting → Permalinks</b> after editing and saving this in order for changes to take effect!!!',
        'std'         => 'the-team',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'user_custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'Custom CSS styles to change the layout and appearance of your website',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_scripts',
        'label'       => 'Footer Scripts',
        'desc'        => 'Custom scripts for the footer, like Google Analytics tracking script',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '10',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'js_date_format',
        'label'       => 'Date Format for Date&amp;Time picker',
        'desc'        => 'This is used for the jQuery UI datetime picker, for the appointment page.',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'mm/dd/yy',
            'label'       => '01/31/2013',
            'src'         => ''
          ),
          array(
            'value'       => 'dd/mm/yy',
            'label'       => '31/01/2013',
            'src'         => ''
          ),
          array(
            'value'       => 'yy-mm-dd',
            'label'       => '2013-01-31',
            'src'         => ''
          ),
          array(
            'value'       => 'dd. mm. yy',
            'label'       => '31. 01. 2013',
            'src'         => ''
          ),
          array(
            'value'       => 'd MM, yy',
            'label'       => '31 January, 2013',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'gm_infowindow_title',
        'label'       => 'Title of infowindow',
        'desc'        => 'The text to display as a title in the Google Maps Infowindow',
        'std'         => 'My business name',
        'type'        => 'text',
        'section'     => 'contact_page_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'gm_infowindow_desc',
        'label'       => 'Description of infowindow',
        'desc'        => 'The text to display as a description in the Google Maps Infowindow',
        'std'         => 'Description of my business',
        'type'        => 'text',
        'section'     => 'contact_page_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'gm_lat_lng',
        'label'       => 'Longitude and latitue',
        'desc'        => 'Get this from <a href="https://maps.google.com/">Google Maps</a>',
        'std'         => '46.051322,14.506189',
        'type'        => 'text',
        'section'     => 'contact_page_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_divider',
        'label'       => 'Default content divider',
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'scissors',
            'label'       => 'Scissors',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_01.jpg'
          ),
          array(
            'value'       => 'divider-1',
            'label'       => 'Divider 1',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_02.jpg'
          ),
          array(
            'value'       => 'divider-2',
            'label'       => 'Divider 2',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_03.jpg'
          ),
          array(
            'value'       => 'divider-3',
            'label'       => 'Divider 3',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_04.jpg'
          ),
          array(
            'value'       => 'divider-4',
            'label'       => 'Divider 4',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_05.jpg'
          ),
          array(
            'value'       => 'divider-5',
            'label'       => 'Divider 5',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_06.jpg'
          ),
          array(
            'value'       => 'divider-6',
            'label'       => 'Divider 6',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_07.jpg'
          ),
          array(
            'value'       => 'divider-7',
            'label'       => 'Divider 7',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_08.jpg'
          ),
          array(
            'value'       => 'divider-8',
            'label'       => 'Divider 8',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_09.jpg'
          ),
          array(
            'value'       => 'divider-9',
            'label'       => 'Divider 9',
            'src'         => 'http://i1198.photobucket.com/albums/aa449/rob153dave/dividers_10.jpg'
          )
        ),
      ),
      array(
        'id'          => 'hair_bg_img',
        'label'       => 'Background image of hair',
        'desc'        => 'In the large resolution screens (1680px wide and larger) the image of the hair is displayed on right: <a href="http://i1198.photobucket.com/albums/aa449/rob153dave/hairpress-bg-img.jpeg?t=1363484246" target="_blank">Click here for example if your resolution is smaller than 1680px in width</a>.

Set this to off if you would like to hide this image for your website.',
        'std'         => 'on',
        'type'        => 'select',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'on',
            'label'       => 'On',
            'src'         => ''
          ),
          array(
            'value'       => 'off',
            'label'       => 'Off',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'services_layout',
        'label'       => 'Services Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'no',
            'label'       => 'No sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Right sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'services_bg',
        'label'       => 'Services Title Background',
        'desc'        => 'The background setting for the list of the services.',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'blog_layout',
        'label'       => 'Blog Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'no',
            'label'       => 'No sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Right sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'gallery_layout',
        'label'       => 'Gallery Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'no',
            'label'       => 'No sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Right sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'gallery_bg',
        'label'       => 'Gallery Title Background',
        'desc'        => 'The background setting for the list of the galleries.',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'team_bg',
        'label'       => 'Meet the Team Title Background',
        'desc'        => 'The background setting for the list of the team members.',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_left',
        'label'       => 'Footer left',
        'desc'        => 'Text for the footer on the left',
        'std'         => '© Copyright 2013',
        'type'        => 'text',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_right',
        'label'       => 'Footer right',
        'desc'        => 'Text for the footer on the right',
        'std'         => 'Hairpress Theme by <a href="http://www.proteusthemes.com">ProteusThemes</a>',
        'type'        => 'text',
        'section'     => 'layout_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'team_front_page',
        'label'       => 'Display Meet the Team on front page',
        'desc'        => '',
        'std'         => 'yes',
        'type'        => 'select',
        'section'     => 'front_page_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'theme_slider_delay',
        'label'       => 'Theme Slider Delay',
        'desc'        => 'The number of seconds between the slides when using Front Page with Theme Slider.',
        'std'         => '8',
        'type'        => 'text',
        'section'     => 'front_page_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'theme_slider_transition',
        'label'       => 'Theme Slider Transition',
        'desc'        => 'The appearance transition of this slide.',
        'std'         => 'random',
        'type'        => 'select',
        'section'     => 'front_page_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'random',
            'label'       => 'Random',
            'src'         => ''
          ),
          array(
            'value'       => 'fade',
            'label'       => 'Fade',
            'src'         => ''
          ),
          array(
            'value'       => 'slidehorizontal',
            'label'       => 'Slide Horizontal',
            'src'         => ''
          ),
          array(
            'value'       => 'slidevertical',
            'label'       => 'Slide Vertical',
            'src'         => ''
          ),
          array(
            'value'       => 'boxslide',
            'label'       => 'Box Slide',
            'src'         => ''
          ),
          array(
            'value'       => 'boxfade',
            'label'       => 'Box Fade',
            'src'         => ''
          ),
          array(
            'value'       => 'slotzoom-horizontal',
            'label'       => 'SlotZoom Horizontal',
            'src'         => ''
          ),
          array(
            'value'       => 'slotslide-horizontal',
            'label'       => 'SlotSlide Horizontal',
            'src'         => ''
          ),
          array(
            'value'       => 'slotfade-horizontal',
            'label'       => 'SlotFade Horizontal',
            'src'         => ''
          ),
          array(
            'value'       => 'slotzoom-vertical',
            'label'       => 'SlotZoom Vertical',
            'src'         => ''
          ),
          array(
            'value'       => 'slotslide-vertical',
            'label'       => 'SlotSlide Vertical',
            'src'         => ''
          ),
          array(
            'value'       => 'slotfade-vertical',
            'label'       => 'SlotFade Vertical',
            'src'         => ''
          ),
          array(
            'value'       => 'curtain-1',
            'label'       => 'Curtain 1',
            'src'         => ''
          ),
          array(
            'value'       => 'curtain-2',
            'label'       => 'Curtain 2',
            'src'         => ''
          ),
          array(
            'value'       => 'curtain-3',
            'label'       => 'Curtain 3',
            'src'         => ''
          ),
          array(
            'value'       => 'slideleft',
            'label'       => 'Slide Left',
            'src'         => ''
          ),
          array(
            'value'       => 'slideright',
            'label'       => 'Slide Right',
            'src'         => ''
          ),
          array(
            'value'       => 'slideup',
            'label'       => 'Slide Up',
            'src'         => ''
          ),
          array(
            'value'       => 'slidedown',
            'label'       => 'Slide Down',
            'src'         => ''
          ),
          array(
            'value'       => 'papercut',
            'label'       => 'Premium - Paper Cut',
            'src'         => ''
          ),
          array(
            'value'       => '3dcurtain-horizontal',
            'label'       => 'Premium - 3D Curtain Horizontal',
            'src'         => ''
          ),
          array(
            'value'       => '3dcurtain-vertical',
            'label'       => 'Premium - 3D Curtain Vertical',
            'src'         => ''
          ),
          array(
            'value'       => 'flyin',
            'label'       => 'Premium - Fly In',
            'src'         => ''
          ),
          array(
            'value'       => 'turnoff',
            'label'       => 'Premium - Turn Off',
            'src'         => ''
          ),
          array(
            'value'       => 'cubic',
            'label'       => 'Premium - Cubic',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'soc_icons_infotext',
        'label'       => 'Social Icons',
        'desc'        => 'This settings will apply for the front page using Front Template with Theme Slider only! <br />

For inserting the social icons in the content of your site, use [shortcodes]. <br />

Delete the contents and save if you don\'t want the icons to show up.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'rss_icon',
        'label'       => 'RSS feed link',
        'desc'        => 'Usually you get the RSS feed of your site by adding the /feed to the end of your URL, for example: http://www.your-domain.com/feed/',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'mail_icon',
        'label'       => 'Contact page icon',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter_icon',
        'label'       => 'Twitter',
        'desc'        => 'Link to your Twitter profile. This is used for social icons in the header of the template',
        'std'         => 'https://twitter.com/proteusnetcom',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'facebook_icon',
        'label'       => 'Facebook',
        'desc'        => 'Link to your Facebook page/profile. This is used for social icons in the header of the template',
        'std'         => 'http://www.facebook.com/ProteusNet',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'youtube_icon',
        'label'       => 'Youtube',
        'desc'        => 'Link to your YouTube profile. This is used for social icons in the header of the template',
        'std'         => 'http://www.youtube.com/user/ProteusNetCompany',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'google_icon',
        'label'       => 'Google+',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pinterest_icon',
        'label'       => 'Pinterest',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'skype_icon',
        'label'       => 'Skype call',
        'desc'        => 'Type here in just your Skype username and the users will be able to call you if they click the Skype icon.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'stumble_icon',
        'label'       => 'StumbleUpon',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'thumblr_icon',
        'label'       => 'Tumblr',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'linkedin_icon',
        'label'       => 'LinkedIn',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'vimeo_icon',
        'label'       => 'Vimeo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'flickr_icon',
        'label'       => 'Flickr',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'instagram_icon',
        'label'       => 'Instagram',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_icons',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}