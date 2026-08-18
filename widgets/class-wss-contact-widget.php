<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;

class WSS_Contact_Widget extends Widget_Base {

	public function get_name() { return 'wss_contact'; }
	public function get_title() { return __( 'WSS — Contact Section', 'website-section-supporter' ); }
	public function get_icon() { return 'eicon-form-vertical'; }
	public function get_categories() { return array( 'website-section-supporter' ); }
	public function get_keywords() { return array( 'contact', 'form', 'inquiry', 'luxury', 'recaptcha', 'lead' ); }

	protected function register_controls() {

		/* ================= LEFT CONTENT: BRANDING & INFO ================= */
		$this->start_controls_section(
			'section_left_content',
			array( 'label' => __( 'Left: Contact Information', 'website-section-supporter' ) )
		);

		$this->add_control(
			'heading',
			array(
				'label'       => __( 'Main Heading', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'GET IN TOUCH', 'website-section-supporter' ),
				'placeholder' => __( 'GET IN TOUCH', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'show_watermark',
			array(
				'label'        => __( 'Show Watermark Monogram', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'watermark_text',
			array(
				'label'     => __( 'Watermark Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'NE',
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control( 'agent_heading', array( 'label' => __( 'Agent Details', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->add_control(
			'agent_name',
			array(
				'label'   => __( 'Agent / Company Name', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Ginger Martin',
			)
		);

		$this->add_control(
			'agent_license',
			array(
				'label'   => __( 'License / DRE#', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'CA DRE# 00643485',
			)
		);

		$this->add_control(
			'agent_phone',
			array(
				'label'   => __( 'Phone Number', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '415.516.3939',
			)
		);

		$this->add_control(
			'agent_phone_link',
			array(
				'label'       => __( 'Phone Link URL', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'default'     => array( 'url' => 'tel:4155163939' ),
				'placeholder' => 'tel:4155163939',
			)
		);

		$this->add_control(
			'agent_email',
			array(
				'label'   => __( 'Email Address', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ginger@gingermartin.com',
			)
		);

		$this->add_control(
			'agent_email_link',
			array(
				'label'       => __( 'Email Link URL', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'default'     => array( 'url' => 'mailto:ginger@gingermartin.com' ),
				'placeholder' => 'mailto:ginger@gingermartin.com',
			)
		);

		$this->add_control(
			'address_line_1',
			array(
				'label'   => __( 'Address Line 1', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '1229 Adams St.',
			)
		);

		$this->add_control(
			'address_line_2',
			array(
				'label'   => __( 'Address Line 2 (City, State, Zip)', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'St. Helena CA 94574',
			)
		);

		$this->add_control(
			'tagline',
			array(
				'label'   => __( 'Tagline Text', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'LEADING LUXURY REAL ESTATE AGENT FOR SONOMA AND NAPA VALLEY',
				'rows'    => 2,
			)
		);

		$this->add_control( 'cards_heading', array( 'label' => __( 'Vertical Quick Contact Cards', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->add_control(
			'show_vertical_cards',
			array(
				'label'        => __( 'Show Vertical Contact Cards', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater_cards = new Repeater();

		$repeater_cards->add_control(
			'label',
			array(
				'label'   => __( 'Card Label (Header)', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Direct Call',
			)
		);

		$repeater_cards->add_control(
			'value',
			array(
				'label'   => __( 'Card Value / Main Text', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '415.516.3939',
			)
		);

		$repeater_cards->add_control(
			'link',
			array(
				'label'       => __( 'Card Link / URL', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'tel:4155163939, mailto:..., or https://...',
				'default'     => array( 'url' => '' ),
			)
		);

		$repeater_cards->add_control(
			'icon_source',
			array(
				'label'   => __( 'Icon Source', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'predefined',
				'options' => array(
					'predefined' => __( 'Predefined Luxury Icon (SVG)', 'website-section-supporter' ),
					'custom'     => __( 'Upload Custom SVG / Icon Library', 'website-section-supporter' ),
				),
			)
		);

		$repeater_cards->add_control(
			'predefined_icon',
			array(
				'label'     => __( 'Predefined Icon', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'phone',
				'options'   => array(
					'phone'     => 'Phone / Call',
					'email'     => 'Email / Envelope',
					'whatsapp'  => 'WhatsApp',
					'location'  => 'Map Pin / Location',
					'clock'     => 'Clock / Hours',
					'chat'      => 'Message / Chat',
					'building'  => 'Office / Building',
					'globe'     => 'Website / Globe',
					'calendar'  => 'Calendar / Appointment',
					'headset'   => 'Support / Headset',
					'user'      => 'Agent / Profile',
					'star'      => 'Luxury / Star',
					'shield'    => 'Security / Confidential',
					'fax'       => 'Fax / Landline',
				),
				'condition' => array( 'icon_source' => 'predefined' ),
			)
		);

		$repeater_cards->add_control(
			'custom_icon',
			array(
				'label'     => __( 'Custom SVG / Icon', 'website-section-supporter' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-phone-alt',
					'library' => 'fa-solid',
				),
				'condition' => array( 'icon_source' => 'custom' ),
			)
		);

		$this->add_control(
			'vertical_cards_list',
			array(
				'label'       => __( 'Contact Cards List', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_cards->get_controls(),
				'default'     => array(
					array(
						'label'           => 'Direct Call',
						'value'           => '415.516.3939',
						'link'            => array( 'url' => 'tel:4155163939' ),
						'icon_source'     => 'predefined',
						'predefined_icon' => 'phone',
					),
					array(
						'label'           => 'Confidential Email',
						'value'           => 'ginger@gingermartin.com',
						'link'            => array( 'url' => 'mailto:ginger@gingermartin.com' ),
						'icon_source'     => 'predefined',
						'predefined_icon' => 'email',
					),
					array(
						'label'           => 'WhatsApp Direct',
						'value'           => 'Connect on WhatsApp',
						'link'            => array( 'url' => 'https://wa.me/14155163939' ),
						'icon_source'     => 'predefined',
						'predefined_icon' => 'whatsapp',
					),
				),
				'title_field' => '{{{ label }}}: {{{ value }}}',
				'condition'   => array( 'show_vertical_cards' => 'yes' ),
			)
		);

		$this->add_control( 'social_heading', array( 'label' => __( 'Social Icons', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->add_control(
			'show_social',
			array(
				'label'        => __( 'Show Social Icons', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater_social = new Repeater();
		$repeater_social->add_control(
			'platform',
			array(
				'label'   => __( 'Platform', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'google',
				'options' => array(
					'google'   => 'Google / Reviews',
					'fb'       => 'Facebook',
					'ig'       => 'Instagram',
					'in'       => 'LinkedIn',
					'yt'       => 'YouTube',
					'x'        => 'X (Twitter)',
					'wa'       => 'WhatsApp',
					'pin'      => 'Pinterest',
					'tt'       => 'TikTok',
					'threads'  => 'Threads',
					'yelp'     => 'Yelp',
					'telegram' => 'Telegram',
					'zillow'   => 'Zillow',
					'realtor'  => 'Realtor.com',
				),
			)
		);
		$repeater_social->add_control(
			'link',
			array(
				'label'   => __( 'Link URL', 'website-section-supporter' ),
				'type'    => Controls_Manager::URL,
				'default' => array( 'url' => '#' ),
			)
		);

		$this->add_control(
			'social_links',
			array(
				'label'       => __( 'Social Links', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_social->get_controls(),
				'default'     => array(
					array( 'platform' => 'fb', 'link' => array( 'url' => '#' ) ),
					array( 'platform' => 'ig', 'link' => array( 'url' => '#' ) ),
					array( 'platform' => 'in', 'link' => array( 'url' => '#' ) ),
					array( 'platform' => 'yt', 'link' => array( 'url' => '#' ) ),
				),
				'title_field' => '{{{ platform }}}',
				'condition'   => array( 'show_social' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= RIGHT CONTENT: FORM & BACKGROUND ================= */
		$this->start_controls_section(
			'section_right_content',
			array( 'label' => __( 'Right: Form & Background', 'website-section-supporter' ) )
		);

		$this->add_control(
			'bg_image',
			array(
				'label'   => __( 'Background Image (Right Side)', 'website-section-supporter' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80' ),
			)
		);

		$this->add_control(
			'card_title',
			array(
				'label'   => __( 'Card Title', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Direct Inquiry',
			)
		);

		$this->add_control(
			'form_type',
			array(
				'label'   => __( 'Form Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => array(
					'custom'    => __( 'Custom Luxury Form (AJAX)', 'website-section-supporter' ),
					'shortcode' => __( 'Shortcode (Elementor Pro / Form Plugin)', 'website-section-supporter' ),
				),
			)
		);

		$this->add_control(
			'form_shortcode',
			array(
				'label'       => __( 'Form Shortcode', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => '[elementor-template id="123"] or [wpforms id="1"]',
				'condition'   => array( 'form_type' => 'shortcode' ),
			)
		);

		$this->add_control( 'form_labels_heading', array( 'label' => __( 'Field Labels & Placeholders', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'condition' => array( 'form_type' => 'custom' ) ) );

		$this->add_control(
			'name_label',
			array( 'label' => __( 'Name Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Name', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'name_placeholder',
			array( 'label' => __( 'Name Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Enter your full name', 'condition' => array( 'form_type' => 'custom' ) )
		);

		$this->add_control(
			'phone_label',
			array( 'label' => __( 'Phone Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Phone', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'phone_placeholder',
			array( 'label' => __( 'Phone Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Your phone', 'condition' => array( 'form_type' => 'custom' ) )
		);

		$this->add_control(
			'email_label',
			array( 'label' => __( 'Email Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Email', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'email_placeholder',
			array( 'label' => __( 'Email Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => '@', 'condition' => array( 'form_type' => 'custom' ) )
		);

		$this->add_control(
			'interest_label',
			array( 'label' => __( 'Interest Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Interest', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'interest_placeholder',
			array( 'label' => __( 'Interest Default Option Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Select nature of interest', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'interest_options',
			array(
				'label'       => __( 'Interest Dropdown Options (One per line)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Buying / Acquisition\nSelling / Listing\nPrivate Estate Viewing\nGeneral Consultation",
				'condition'   => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'message_label',
			array( 'label' => __( 'Message Label', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Your Message', 'condition' => array( 'form_type' => 'custom' ) )
		);
		$this->add_control(
			'message_placeholder',
			array( 'label' => __( 'Message Placeholder', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => 'Type your message', 'condition' => array( 'form_type' => 'custom' ) )
		);

		$this->add_control(
			'show_consent',
			array(
				'label'        => __( 'Show Consent Checkbox', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'consent_text',
			array(
				'label'       => __( 'Consent Text (HTML allowed)', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'I agree to be contacted via call, email, and text for real estate services. To opt out, you can reply \'stop\' at any time or reply \'help\' for assistance. <a href="#">Privacy Policy</a>.', 'website-section-supporter' ),
				'condition'   => array( 'form_type' => 'custom', 'show_consent' => 'yes' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Submit Button Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'SEND MESSAGE',
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'success_message',
			array(
				'label'     => __( 'Success Notification Message', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Thank you for contacting us. We will get back to you shortly.', 'website-section-supporter' ),
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->end_controls_section();

		/* ================= RECAPTCHA SETTINGS ================= */
		$this->start_controls_section(
			'section_recaptcha',
			array(
				'label'     => __( 'reCAPTCHA & Security', 'website-section-supporter' ),
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'enable_recaptcha',
			array(
				'label'        => __( 'Enable Google reCAPTCHA', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'recaptcha_version',
			array(
				'label'     => __( 'reCAPTCHA Type', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'v2_checkbox',
				'options'   => array(
					'v2_checkbox' => __( 'reCAPTCHA v2 (Checkbox)', 'website-section-supporter' ),
					'v3'          => __( 'reCAPTCHA v3 (Invisible Score)', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->add_control(
			'recaptcha_site_key',
			array(
				'label'       => __( 'reCAPTCHA Site Key', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => '6LeIxacZAAAAA...',
				'condition'   => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->add_control(
			'recaptcha_secret_key',
			array(
				'label'       => __( 'reCAPTCHA Secret Key', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => '6LeIxacZAAAAA...',
				'condition'   => array( 'enable_recaptcha' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= EMAIL & NOTIFICATIONS ================= */
		$this->start_controls_section(
			'section_email_settings',
			array(
				'label'     => __( 'Email & Notification Settings', 'website-section-supporter' ),
				'condition' => array( 'form_type' => 'custom' ),
			)
		);

		$this->add_control(
			'form_action',
			array(
				'label'       => __( 'Webhook URL (Optional External Forwarding)', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://webhook.site/...',
			)
		);

		$this->add_control(
			'email_to',
			array(
				'label'       => __( 'To Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => get_option( 'admin_email' ),
				'placeholder' => 'admin@example.com',
				'description' => __( 'Default is WordPress site admin email.', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'email_cc',
			array(
				'label'       => __( 'CC Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'cc@example.com',
			)
		);

		$this->add_control(
			'email_bcc',
			array(
				'label'       => __( 'BCC Email', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'bcc@example.com',
			)
		);

		$this->add_control(
			'email_subject',
			array(
				'label'   => __( 'Email Subject', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'New Luxury Inquiry from {{name}} - {{interest}}', 'website-section-supporter' ),
			)
		);

		$this->add_control(
			'email_content_type',
			array(
				'label'   => __( 'Content Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'html',
				'options' => array(
					'html'  => 'HTML',
					'plain' => 'Plain Text',
				),
			)
		);

		$this->end_controls_section();

		/* ================= ANIMATION & LUXURY EFFECTS ================= */
		$this->start_controls_section(
			'section_motion',
			array( 'label' => __( 'Animation & Luxury Effects', 'website-section-supporter' ) )
		);

		$this->add_control(
			'enable_reveal',
			array(
				'label'        => __( 'Scroll-Reveal Entrance', 'website-section-supporter' ),
				'description'  => __( 'Applies smooth luxury scroll-triggered mask wipes and staggered cascade animations.', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'enable_parallax',
			array(
				'label'        => __( 'Background Parallax & Motion', 'website-section-supporter' ),
				'description'  => __( 'Enables cinematic motion on the right estate background image.', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'parallax_mode',
			array(
				'label'     => __( 'Motion Mode', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'scroll',
				'options'   => array(
					'scroll' => __( 'Scroll Parallax (Smooth Vertical/Horizontal)', 'website-section-supporter' ),
					'tilt'   => __( '3D Interactive Mouse Tilt', 'website-section-supporter' ),
					'zoom'   => __( 'Ken Burns Scroll Zoom', 'website-section-supporter' ),
					'fixed'  => __( 'Fixed Luxury Still', 'website-section-supporter' ),
				),
				'condition' => array( 'enable_parallax' => 'yes' ),
			)
		);

		$this->add_control(
			'parallax_direction',
			array(
				'label'     => __( 'Scroll Movement Direction', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'up',
				'options'   => array(
					'up'    => __( 'Up (Reverse Scroll)', 'website-section-supporter' ),
					'down'  => __( 'Down (Natural Scroll)', 'website-section-supporter' ),
					'left'  => __( 'Left', 'website-section-supporter' ),
					'right' => __( 'Right', 'website-section-supporter' ),
				),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => 'scroll',
				),
			)
		);

		$this->add_control(
			'parallax_speed',
			array(
				'label'     => __( 'Motion Intensity / Speed', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0.05,
						'max'  => 0.6,
						'step' => 0.01,
					),
				),
				'default'   => array( 'size' => 0.18 ),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode!'  => 'fixed',
				),
			)
		);

		$this->add_control(
			'tilt_max',
			array(
				'label'     => __( 'Max Tilt Angle (deg)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 3,
						'max'  => 25,
						'step' => 1,
					),
				),
				'default'   => array( 'size' => 10 ),
				'condition' => array(
					'enable_parallax' => 'yes',
					'parallax_mode'   => 'tilt',
				),
			)
		);

		$this->add_control(
			'enable_floating_tilt',
			array(
				'label'        => __( '3D Float on Form Card', 'website-section-supporter' ),
				'description'  => __( 'Subtle 3D perspective float tracking cursor hover on the Direct Inquiry card.', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'disable_parallax_mobile',
			array(
				'label'        => __( 'Disable Motion on Mobile', 'website-section-supporter' ),
				'description'  => __( 'Disables heavy scroll/tilt movement on screens <= 768px for smoother touch performance.', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'website-section-supporter' ),
				'label_off'    => __( 'No', 'website-section-supporter' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array( 'enable_parallax' => 'yes' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: LAYOUT & BACKGROUNDS ================= */
		$this->start_controls_section(
			'style_layout',
			array( 'label' => __( 'Layout & Backgrounds', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'left_bg_color',
			array(
				'label'     => __( 'Left Side Background', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f5f3ee',
				'selectors' => array( '{{WRAPPER}} .wss-contact-left' => 'background-color: {{VALUE}};' ),
			)
		);

		$this->add_responsive_control(
			'left_padding',
			array(
				'label'      => __( 'Left Side Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-contact-left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);

		$this->add_control(
			'watermark_color',
			array(
				'label'     => __( 'Watermark Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-watermark' => 'color: {{VALUE}};' ),
				'condition' => array( 'show_watermark' => 'yes' ),
			)
		);

		$this->add_control(
			'right_overlay_color',
			array(
				'label'     => __( 'Right Image Dark Overlay', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(19, 18, 16, 0.22)',
				'selectors' => array( '{{WRAPPER}} .wss-contact-right::before' => 'background: {{VALUE}};' ),
			)
		);

		$this->add_responsive_control(
			'right_padding',
			array(
				'label'      => __( 'Right Side Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-contact-right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: LEFT TYPOGRAPHY & CARDS ================= */
		$this->start_controls_section(
			'style_left_typo',
			array( 'label' => __( 'Left Content Typography & Cards', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control( 'heading_style_title', array( 'label' => __( 'Main Heading', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_control(
			'heading_color',
			array( 'label' => __( 'Heading Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-contact-left h1' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-contact-left h1' )
		);

		$this->add_control( 'agent_style_title', array( 'label' => __( 'Agent Info & Details', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'agent_text_color',
			array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-contact-col p, {{WRAPPER}} .wss-contact-col a' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'agent_typography', 'selector' => '{{WRAPPER}} .wss-contact-col' )
		);

		$this->add_control( 'tagline_style_title', array( 'label' => __( 'Tagline', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'tagline_color',
			array( 'label' => __( 'Tagline Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-tagline' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'tagline_typography', 'selector' => '{{WRAPPER}} .wss-tagline' )
		);

		$this->add_control( 'card_style_title', array( 'label' => __( 'Vertical Contact Cards', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->start_controls_tabs( 'vcard_style_tabs' );

		// Normal Tab
		$this->start_controls_tab(
			'vcard_tab_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);

		$this->add_control(
			'vcard_bg',
			array( 'label' => __( 'Card Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_border',
			array( 'label' => __( 'Card Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card' => 'border-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_label_color',
			array( 'label' => __( 'Label Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card-text span' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_text_color',
			array( 'label' => __( 'Text / Value Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card-text strong' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_icon_color',
			array( 'label' => __( 'Icon Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card-icon, {{WRAPPER}} .wss-vertical-card-icon svg, {{WRAPPER}} .wss-vertical-card-icon i' => 'color: {{VALUE}}; fill: currentColor;' ) )
		);
		$this->add_control(
			'vcard_icon_bg',
			array( 'label' => __( 'Icon Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card-icon' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'vcard_shadow', 'selector' => '{{WRAPPER}} .wss-vertical-card' )
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'vcard_tab_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);

		$this->add_control(
			'vcard_hover_bg',
			array( 'label' => __( 'Hover Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card:hover' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_hover_border',
			array( 'label' => __( 'Hover Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card:hover' => 'border-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_hover_label_color',
			array( 'label' => __( 'Hover Label Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card:hover .wss-vertical-card-text span' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_hover_text_color',
			array( 'label' => __( 'Hover Text / Value Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card:hover .wss-vertical-card-text strong' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'vcard_hover_icon_color',
			array( 'label' => __( 'Hover Icon Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card:hover .wss-vertical-card-icon, {{WRAPPER}} .wss-vertical-card:hover .wss-vertical-card-icon svg, {{WRAPPER}} .wss-vertical-card:hover .wss-vertical-card-icon i' => 'color: {{VALUE}}; fill: currentColor;' ) )
		);
		$this->add_control(
			'vcard_hover_icon_bg',
			array( 'label' => __( 'Hover Icon Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-vertical-card:hover .wss-vertical-card-icon' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'vcard_hover_shadow', 'selector' => '{{WRAPPER}} .wss-vertical-card:hover' )
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control( 'social_style_title', array( 'label' => __( 'Social Icons', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->start_controls_tabs( 'social_style_tabs' );

		// Normal Tab
		$this->start_controls_tab(
			'social_tab_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);

		$this->add_control(
			'social_color',
			array( 'label' => __( 'Social Icon Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-social-row a' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'social_bg',
			array( 'label' => __( 'Icon Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-social-row a' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'social_border_color',
			array( 'label' => __( 'Icon Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-social-row a' => 'border-color: {{VALUE}};' ) )
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'social_tab_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);

		$this->add_control(
			'social_hover_color',
			array( 'label' => __( 'Social Icon Hover Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-social-row a:hover' => 'color: {{VALUE}};' ) )
		);
		$this->add_control(
			'social_hover_bg',
			array( 'label' => __( 'Hover Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-social-row a:hover' => 'background-color: {{VALUE}};' ) )
		);
		$this->add_control(
			'social_hover_border_color',
			array( 'label' => __( 'Hover Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-social-row a:hover' => 'border-color: {{VALUE}};' ) )
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		/* ================= STYLE: FLOATING FORM CARD ================= */
		$this->start_controls_section(
			'style_form_card',
			array( 'label' => __( 'Floating Form Card', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control(
			'card_bg',
			array( 'label' => __( 'Card Background', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => array( '{{WRAPPER}} .wss-floating-card' => 'background-color: {{VALUE}};' ) )
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array( '{{WRAPPER}} .wss-floating-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
			)
		);

		$this->add_responsive_control(
			'card_border_radius',
			array(
				'label'      => __( 'Card Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'    => array( 'size' => 12, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-floating-card' => 'border-radius: {{SIZE}}{{UNIT}};' ),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'card_box_shadow', 'selector' => '{{WRAPPER}} .wss-floating-card' )
		);

		$this->add_control( 'card_title_heading', array( 'label' => __( 'Card Title (Direct Inquiry)', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'card_title_color',
			array( 'label' => __( 'Title Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-card-title, {{WRAPPER}} .wss-card-header h3' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'card_title_typography', 'selector' => '{{WRAPPER}} .wss-card-title, {{WRAPPER}} .wss-card-header h3' )
		);
		$this->add_responsive_control(
			'card_title_align',
			array(
				'label'     => __( 'Title Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center' => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'right'  => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'left',
				'selectors' => array( '{{WRAPPER}} .wss-card-header, {{WRAPPER}} .wss-card-title' => 'text-align: {{VALUE}};' ),
			)
		);

		$this->end_controls_section();

		/* ================= STYLE: FORM FIELDS ================= */
		$this->start_controls_section(
			'style_form_fields',
			array( 'label' => __( 'Form Inputs & Fields', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_control( 'field_labels_heading', array( 'label' => __( 'Field Labels', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING ) );
		$this->add_control(
			'field_label_color',
			array( 'label' => __( 'Label Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-field-label' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'field_label_typography', 'selector' => '{{WRAPPER}} .wss-field-label' )
		);

		$this->add_control( 'field_inputs_heading', array( 'label' => __( 'Input / Select / Textarea', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );

		$this->start_controls_tabs( 'input_style_tabs' );

		// Normal Tab
		$this->start_controls_tab(
			'input_tab_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);

		$this->add_control(
			'input_bg',
			array( 'label' => __( 'Input Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#eceae4', 'selectors' => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' => 'background-color: {{VALUE}} !important;' ) )
		);
		$this->add_control(
			'input_border_color',
			array( 'label' => __( 'Input Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' => 'border-color: {{VALUE}} !important;' ) )
		);
		$this->add_control(
			'input_text_color',
			array( 'label' => __( 'Input Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' => 'color: {{VALUE}} !important;' ) )
		);
		$this->add_control(
			'input_placeholder_color',
			array( 'label' => __( 'Placeholder Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-pill-input::placeholder, {{WRAPPER}} .wss-pill-textarea::placeholder' => 'color: {{VALUE}} !important;' ) )
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'input_box_shadow', 'selector' => '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' )
		);

		$this->end_controls_tab();

		// Focus Tab
		$this->start_controls_tab(
			'input_tab_focus',
			array( 'label' => __( 'Focus', 'website-section-supporter' ) )
		);

		$this->add_control(
			'input_focus_bg',
			array( 'label' => __( 'Focus Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-pill-input:focus, {{WRAPPER}} .wss-pill-select:focus, {{WRAPPER}} .wss-pill-textarea:focus' => 'background-color: {{VALUE}} !important;' ) )
		);
		$this->add_control(
			'input_focus_border_color',
			array( 'label' => __( 'Focus Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'default' => '#a8916f', 'selectors' => array( '{{WRAPPER}} .wss-pill-input:focus, {{WRAPPER}} .wss-pill-select:focus, {{WRAPPER}} .wss-pill-textarea:focus' => 'border-color: {{VALUE}} !important;' ) )
		);
		$this->add_control(
			'input_focus_text_color',
			array( 'label' => __( 'Focus Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-pill-input:focus, {{WRAPPER}} .wss-pill-select:focus, {{WRAPPER}} .wss-pill-textarea:focus' => 'color: {{VALUE}} !important;' ) )
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'input_focus_box_shadow', 'selector' => '{{WRAPPER}} .wss-pill-input:focus, {{WRAPPER}} .wss-pill-select:focus, {{WRAPPER}} .wss-pill-textarea:focus' )
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'input_border_radius',
			array(
				'label'      => __( 'Input / Select / Textarea Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 60 ) ),
				'default'    => array( 'size' => 5, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);

		$this->add_responsive_control(
			'input_padding',
			array(
				'label'      => __( 'Input Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-pill-input, {{WRAPPER}} .wss-pill-select, {{WRAPPER}} .wss-pill-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ),
			)
		);

		$this->add_control( 'consent_style_heading', array( 'label' => __( 'Consent Checkbox & Text', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control(
			'consent_color',
			array( 'label' => __( 'Consent Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-simple-consent label' => 'color: {{VALUE}};' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'consent_typography', 'selector' => '{{WRAPPER}} .wss-simple-consent label' )
		);

		$this->end_controls_section();

		/* ================= STYLE: SUBMIT BUTTON ================= */
		$this->start_controls_section(
			'style_button',
			array( 'label' => __( 'Submit Button', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .wss-contact-form button.wss-send-btn, {{WRAPPER}} .wss-contact-form button.wss-send-btn span',
			)
		);

		$this->start_controls_tabs( 'tabs_btn_style' );

		$this->start_controls_tab(
			'tab_btn_normal',
			array( 'label' => __( 'Normal', 'website-section-supporter' ) )
		);
		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-contact-form button.wss-send-btn, {{WRAPPER}} .wss-contact-form button.wss-send-btn span' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'button_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-contact-form button.wss-send-btn' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'button_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-contact-form button.wss-send-btn' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'button_shadow', 'selector' => '{{WRAPPER}} .wss-contact-form button.wss-send-btn' )
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			array( 'label' => __( 'Hover', 'website-section-supporter' ) )
		);
		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-contact-form button.wss-send-btn:hover, {{WRAPPER}} .wss-contact-form button.wss-send-btn:hover span' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'button_hover_bg',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-contact-form button.wss-send-btn::before, {{WRAPPER}} .wss-contact-form button.wss-send-btn:hover' => 'background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-contact-form button.wss-send-btn:hover' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'button_hover_shadow', 'selector' => '{{WRAPPER}} .wss-contact-form button.wss-send-btn:hover' )
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'website-section-supporter' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'    => array( 'size' => 40, 'unit' => 'px' ),
				'selectors'  => array( '{{WRAPPER}} .wss-contact-form button.wss-send-btn' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-contact-form button.wss-send-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$bg_img = ! empty( $s['bg_image']['url'] ) ? $s['bg_image']['url'] : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80';
		$widget_uid = 'wss-contact-' . $this->get_id();
		$enable_recaptcha = ! empty( $s['enable_recaptcha'] ) && 'yes' === $s['enable_recaptcha'];
		$recaptcha_site_key = ! empty( $s['recaptcha_site_key'] ) ? $s['recaptcha_site_key'] : '';
		$recaptcha_version = ! empty( $s['recaptcha_version'] ) ? $s['recaptcha_version'] : 'v2_checkbox';

		// Reveal & Parallax Settings
		$enable_reveal    = 'yes' === ( $s['enable_reveal'] ?? 'yes' );
		$enable_parallax  = 'yes' === ( $s['enable_parallax'] ?? 'yes' );
		$parallax_mode    = ! empty( $s['parallax_mode'] ) ? $s['parallax_mode'] : 'scroll';
		$parallax_speed   = ! empty( $s['parallax_speed']['size'] ) ? $s['parallax_speed']['size'] : 0.18;
		$parallax_dir     = ! empty( $s['parallax_direction'] ) ? $s['parallax_direction'] : 'up';
		$parallax_scale   = 1.15;
		$disable_mobile   = ! empty( $s['disable_parallax_mobile'] ) ? $s['disable_parallax_mobile'] : 'yes';
		$tilt_max         = ! empty( $s['tilt_max']['size'] ) ? $s['tilt_max']['size'] : 10;
		$enable_card_tilt = 'yes' === ( $s['enable_floating_tilt'] ?? 'yes' );

		// Parse interest options
		$interest_lines = ! empty( $s['interest_options'] ) ? explode( "\n", str_replace( "\r", "", $s['interest_options'] ) ) : array();

		$stagger_delays = array( 'wss-r1', 'wss-r2', 'wss-r3', 'wss-r4' );
		?>
		<div class="wss-scope">
			<section class="wss-contact-wrapper" id="<?php echo esc_attr( $widget_uid ); ?>">
				
				<!-- LEFT SIDE: Contact Information & Branding -->
				<div class="wss-contact-left">
					<?php if ( 'yes' === ( $s['show_watermark'] ?? 'yes' ) && ! empty( $s['watermark_text'] ) ) : ?>
						<div class="wss-watermark<?php echo $enable_reveal ? ' wss-reveal' : ''; ?>"><?php echo esc_html( $s['watermark_text'] ); ?></div>
					<?php endif; ?>

					<?php if ( ! empty( $s['heading'] ) ) : ?>
						<h1<?php echo $enable_reveal ? ' class="wss-reveal"' : ''; ?>>
							<span class="<?php echo $enable_reveal ? 'wss-mask' : ''; ?>">
								<span><?php echo esc_html( $s['heading'] ); ?></span>
							</span>
						</h1>
					<?php endif; ?>

					<!-- Contact Details Grid -->
					<div class="wss-contact-details-grid<?php echo $enable_reveal ? ' wss-reveal wss-r1' : ''; ?>">
						<div class="wss-contact-col">
							<?php if ( ! empty( $s['agent_name'] ) ) : ?>
								<p class="agent-name"><?php echo esc_html( $s['agent_name'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $s['agent_license'] ) ) : ?>
								<p class="dre-number"><?php echo esc_html( $s['agent_license'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $s['agent_phone'] ) ) : ?>
								<p><a href="<?php echo esc_url( $s['agent_phone_link']['url'] ?: 'tel:' . preg_replace('/[^0-9+]/', '', $s['agent_phone']) ); ?>"><?php echo esc_html( $s['agent_phone'] ); ?></a></p>
							<?php endif; ?>
							<?php if ( ! empty( $s['agent_email'] ) ) : ?>
								<p><a href="<?php echo esc_url( $s['agent_email_link']['url'] ?: 'mailto:' . $s['agent_email'] ); ?>"><?php echo esc_html( $s['agent_email'] ); ?></a></p>
							<?php endif; ?>
						</div>

						<div class="wss-contact-col">
							<?php if ( ! empty( $s['address_line_1'] ) ) : ?>
								<p><?php echo esc_html( $s['address_line_1'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $s['address_line_2'] ) ) : ?>
								<p><?php echo esc_html( $s['address_line_2'] ); ?></p>
							<?php endif; ?>
						</div>
					</div>

					<!-- Vertical Quick Contact Cards (Repeater) -->
					<?php if ( 'yes' === ( $s['show_vertical_cards'] ?? 'yes' ) && ! empty( $s['vertical_cards_list'] ) ) : ?>
						<div class="wss-left-cards">
							<?php 
							$card_idx = 0;
							foreach ( $s['vertical_cards_list'] as $card ) :
								$card_label = ! empty( $card['label'] ) ? $card['label'] : '';
								$card_val   = ! empty( $card['value'] ) ? $card['value'] : '';
								$card_link  = ! empty( $card['link']['url'] ) ? $card['link']['url'] : '';
								$is_ext     = ! empty( $card['link']['is_external'] );
								$nofollow   = ! empty( $card['link']['nofollow'] );
								$tag        = ! empty( $card_link ) ? 'a' : 'div';
								$attr       = ! empty( $card_link ) ? ' href="' . esc_url( $card_link ) . '"' : '';
								if ( $is_ext ) { $attr .= ' target="_blank"'; }
								if ( $nofollow ) { $attr .= ' rel="nofollow"'; }

								$stagger_class = $enable_reveal ? ' wss-reveal ' . $stagger_delays[ $card_idx % 4 ] : '';
								$card_idx++;
								?>
								<<?php echo $tag; ?><?php echo $attr; ?> class="wss-vertical-card<?php echo esc_attr( $stagger_class ); ?> elementor-repeater-item-<?php echo esc_attr( $card['_id'] ?? '' ); ?>">
									<div class="wss-vertical-card-icon">
										<?php
										if ( 'custom' === ( $card['icon_source'] ?? 'predefined' ) && ! empty( $card['custom_icon']['value'] ) ) {
											\Elementor\Icons_Manager::render_icon( $card['custom_icon'], array( 'aria-hidden' => 'true' ) );
										} else {
											$icon_key = ! empty( $card['predefined_icon'] ) ? $card['predefined_icon'] : 'phone';
											echo $this->get_card_svg( $icon_key ); // phpcs:ignore WordPress.Security.EscapeOutput
										}
										?>
									</div>
									<div class="wss-vertical-card-text">
										<?php if ( ! empty( $card_label ) ) : ?>
											<span><?php echo esc_html( $card_label ); ?></span>
										<?php endif; ?>
										<?php if ( ! empty( $card_val ) ) : ?>
											<strong><?php echo esc_html( $card_val ); ?></strong>
										<?php endif; ?>
									</div>
								</<?php echo $tag; ?>>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $s['tagline'] ) ) : ?>
						<p class="wss-tagline<?php echo $enable_reveal ? ' wss-reveal wss-r2' : ''; ?>"><?php echo esc_html( $s['tagline'] ); ?></p>
					<?php endif; ?>

					<!-- Social Icons Row -->
					<?php if ( 'yes' === ( $s['show_social'] ?? 'yes' ) && ! empty( $s['social_links'] ) ) : ?>
						<div class="wss-social-row<?php echo $enable_reveal ? ' wss-reveal wss-r3' : ''; ?>">
							<?php foreach ( $s['social_links'] as $social ) :
								$platform = ! empty( $social['platform'] ) ? $social['platform'] : 'fb';
								$url      = ! empty( $social['link']['url'] ) ? $social['link']['url'] : '#';
								?>
								<a href="<?php echo esc_url( $url ); ?>"<?php echo ! empty( $social['link']['is_external'] ) ? ' target="_blank" rel="noopener"' : ''; ?> aria-label="<?php echo esc_attr( $platform ); ?>">
									<?php echo $this->get_social_svg( $platform ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- RIGHT SIDE: Estate Background with Floating Card -->
				<div class="wss-contact-right <?php echo $enable_parallax ? 'wss-has-parallax' : 'wss-no-parallax'; ?>"
					<?php if ( $enable_parallax ) : ?>
						data-parallax-mode="<?php echo esc_attr( $parallax_mode ); ?>"
						data-parallax-speed="<?php echo esc_attr( $parallax_speed ); ?>"
						data-parallax-direction="<?php echo esc_attr( $parallax_dir ); ?>"
						data-parallax-scale="<?php echo esc_attr( $parallax_scale ); ?>"
						data-parallax-disable-mobile="<?php echo esc_attr( $disable_mobile ); ?>"
						data-tilt-max="<?php echo esc_attr( $tilt_max ); ?>"
					<?php endif; ?>
				>
					<div class="wss-contact-bg <?php echo ( $enable_parallax && 'fixed' === $parallax_mode ) ? 'wss-parallax-fixed-bg' : 'wss-parallax-img'; ?><?php echo $enable_reveal ? ' wss-img-reveal' : ''; ?>" style="background-image: url('<?php echo esc_url( $bg_img ); ?>');"></div>
					<div class="wss-contact-overlay"></div>

					<div class="wss-floating-card<?php echo $enable_reveal ? ' wss-reveal wss-r2' : ''; ?><?php echo $enable_card_tilt ? ' wss-card-tilt' : ''; ?>">
						<?php if ( ! empty( $s['card_title'] ) ) : ?>
							<div class="wss-card-header">
								<h3 class="wss-card-title">
									<span class="<?php echo $enable_reveal ? 'wss-mask' : ''; ?>">
										<span><?php echo esc_html( $s['card_title'] ); ?></span>
									</span>
								</h3>
							</div>
						<?php endif; ?>

						<?php if ( 'shortcode' === ( $s['form_type'] ?? 'custom' ) && ! empty( $s['form_shortcode'] ) ) : ?>
							<div class="wss-contact-shortcode-wrap">
								<?php echo do_shortcode( shortcode_unautop( $s['form_shortcode'] ) ); ?>
							</div>
						<?php else : ?>
							<?php $has_webhook = ! empty( $s['form_action']['url'] ); ?>
							<form class="wss-contact-form wss-contact-ajax-form" action="<?php echo esc_url( $has_webhook ? $s['form_action']['url'] : admin_url('admin-ajax.php') ); ?>" method="post">
								
								<input type="hidden" name="action" value="wss_contact_submit">
								<input type="hidden" name="wss_contact_nonce" value="<?php echo wp_create_nonce('wss_contact_nonce'); ?>">
								<input type="hidden" name="email_to" value="<?php echo esc_attr( $s['email_to'] ?? '' ); ?>">
								<input type="hidden" name="email_cc" value="<?php echo esc_attr( $s['email_cc'] ?? '' ); ?>">
								<input type="hidden" name="email_bcc" value="<?php echo esc_attr( $s['email_bcc'] ?? '' ); ?>">
								<input type="hidden" name="email_subject" value="<?php echo esc_attr( $s['email_subject'] ?? '' ); ?>">
								<input type="hidden" name="email_content_type" value="<?php echo esc_attr( $s['email_content_type'] ?? 'html' ); ?>">
								<input type="hidden" name="success_msg" value="<?php echo esc_attr( $s['success_message'] ?? '' ); ?>">
								<input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
								<input type="hidden" name="widget_id" value="<?php echo esc_attr($this->get_id()); ?>">
								<input type="hidden" name="recaptcha_secret" value="<?php echo esc_attr( $s['recaptcha_secret_key'] ?? '' ); ?>">

								<!-- Row 1: Name & Phone -->
								<div class="wss-form-grid-2">
									<div class="wss-field-group">
										<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-name"><?php echo esc_html( $s['name_label'] ?? 'Name' ); ?></label>
										<input type="text" id="<?php echo esc_attr( $widget_uid ); ?>-name" name="wss_name" class="wss-pill-input" placeholder="<?php echo esc_attr( $s['name_placeholder'] ?? 'Enter your full name' ); ?>" required>
									</div>
									<div class="wss-field-group">
										<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-phone"><?php echo esc_html( $s['phone_label'] ?? 'Phone' ); ?></label>
										<input type="tel" id="<?php echo esc_attr( $widget_uid ); ?>-phone" name="wss_phone" class="wss-pill-input" placeholder="<?php echo esc_attr( $s['phone_placeholder'] ?? 'Your phone' ); ?>" required>
									</div>
								</div>

								<!-- Row 2: Email -->
								<div class="wss-field-group">
									<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-email"><?php echo esc_html( $s['email_label'] ?? 'Email' ); ?></label>
									<input type="email" id="<?php echo esc_attr( $widget_uid ); ?>-email" name="wss_email" class="wss-pill-input" placeholder="<?php echo esc_attr( $s['email_placeholder'] ?? '@' ); ?>" required>
								</div>

								<!-- Row 3: Interest -->
								<div class="wss-field-group">
									<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-interest"><?php echo esc_html( $s['interest_label'] ?? 'Interest' ); ?></label>
									<select id="<?php echo esc_attr( $widget_uid ); ?>-interest" name="wss_interest" class="wss-pill-select" required>
										<option value="" disabled selected><?php echo esc_html( $s['interest_placeholder'] ?? 'Select nature of interest' ); ?></option>
										<?php foreach ( $interest_lines as $opt ) : 
											$opt_clean = trim( $opt );
											if ( empty( $opt_clean ) ) continue;
										?>
											<option value="<?php echo esc_attr( $opt_clean ); ?>"><?php echo esc_html( $opt_clean ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<!-- Row 4: Message -->
								<div class="wss-field-group">
									<label class="wss-field-label" for="<?php echo esc_attr( $widget_uid ); ?>-message"><?php echo esc_html( $s['message_label'] ?? 'Your Message' ); ?></label>
									<textarea id="<?php echo esc_attr( $widget_uid ); ?>-message" name="wss_message" class="wss-pill-textarea" placeholder="<?php echo esc_attr( $s['message_placeholder'] ?? 'Type your message' ); ?>" required></textarea>
								</div>

								<!-- Google reCAPTCHA v2 Checkbox if enabled -->
								<?php if ( $enable_recaptcha && ! empty( $recaptcha_site_key ) ) : ?>
									<div class="wss-recaptcha-wrap" style="margin-bottom: 16px;">
										<?php if ( 'v2_checkbox' === $recaptcha_version ) : ?>
											<script src="https://www.google.com/recaptcha/api.js" async defer></script>
											<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha_site_key ); ?>"></div>
										<?php elseif ( 'v3' === $recaptcha_version ) : ?>
											<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr( $recaptcha_site_key ); ?>"></script>
											<input type="hidden" name="g-recaptcha-response" id="<?php echo esc_attr( $widget_uid ); ?>-g-recaptcha-response">
											<script>
												grecaptcha.ready(function() {
													grecaptcha.execute('<?php echo esc_attr( $recaptcha_site_key ); ?>', {action: 'contact'}).then(function(token) {
														var input = document.getElementById('<?php echo esc_attr( $widget_uid ); ?>-g-recaptcha-response');
														if (input) input.value = token;
													});
												});
											</script>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<!-- Consent Checkbox -->
								<?php if ( 'yes' === ( $s['show_consent'] ?? 'yes' ) && ! empty( $s['consent_text'] ) ) : ?>
									<div class="wss-simple-consent">
										<input type="checkbox" id="<?php echo esc_attr( $widget_uid ); ?>-consent" required checked>
										<label for="<?php echo esc_attr( $widget_uid ); ?>-consent">
											<?php echo wp_kses_post( $s['consent_text'] ); ?>
										</label>
									</div>
								<?php endif; ?>

								<!-- Submit Button -->
								<button type="submit" class="wss-send-btn">
									<span><?php echo esc_html( $s['button_text'] ?? 'SEND MESSAGE' ); ?></span>
								</button>

								<!-- Form notification / message output -->
								<div class="wss-form-status-msg" style="display:none; font-size:13px; margin-top:14px; padding:10px 14px; border-radius:4px;"></div>
							</form>
						<?php endif; ?>
					</div>
				</div>

			</section>
		</div>
		<?php
	}

	private function get_social_svg( $label ) {
		$label = strtolower( trim( $label ) );
		$icons = array(
			'f'              => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
			'fb'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
			'google'         => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>',
			'g'              => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>',
			'in'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>',
			'ig'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
			'yt'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>',
			'tw'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>',
			'x'              => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4l16 16M20 4L4 20"/></svg>',
			'wa'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>',
			'pin'            => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="9" x2="12" y2="22"/><path d="M8 12c-1.5-1.5-2-3-2-5a6 6 0 1 1 12 0c0 4-3 7-6 7-1.5 0-2.5-.5-3.5-1.5"/></svg>',
			'pinterest'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="9" x2="12" y2="22"/><path d="M8 12c-1.5-1.5-2-3-2-5a6 6 0 1 1 12 0c0 4-3 7-6 7-1.5 0-2.5-.5-3.5-1.5"/></svg>',
			'tt'             => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>',
			'tiktok'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>',
			'threads'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19.25 8.505C17.96 4.417 14.15 2 9.5 2.75 4.85 3.5 2 7.75 2.75 12.5c.75 4.75 4.85 7.5 9.5 7.5 3.75 0 6.5-1.5 7.5-3.5"/><path d="M8.5 12c0-2.5 1.5-4 3.5-4s3.5 1.5 3.5 4v1.5c0 1.1-.9 2-2 2s-2-.9-2-2"/></svg>',
			'yelp'           => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2 6h6l-5 4 2 6-5-4-5 4 2-6-5-4h6z"/></svg>',
			'telegram'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>',
			'zillow'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
			'realtor'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3"/></svg>',
		);
		if ( isset( $icons[ $label ] ) ) {
			return $icons[ $label ];
		}
		return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><text x="12" y="16" text-anchor="middle" font-size="8" fill="currentColor" stroke="none">' . esc_html( strtoupper( substr( $label, 0, 2 ) ) ) . '</text></svg>';
	}

	private function get_card_svg( $icon ) {
		$icon = strtolower( trim( $icon ) );
		$card_icons = array(
			'phone'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
			'email'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
			'whatsapp'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>',
			'location'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
			'clock'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
			'chat'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
			'building'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M8 10h.01"/><path d="M16 10h.01"/><path d="M8 14h.01"/><path d="M16 14h.01"/></svg>',
			'globe'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
			'calendar'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
			'headset'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>',
			'user'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
			'star'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
			'shield'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
			'fax'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>',
		);
		if ( isset( $card_icons[ $icon ] ) ) {
			return $card_icons[ $icon ];
		}
		return $card_icons['phone'];
	}
}
