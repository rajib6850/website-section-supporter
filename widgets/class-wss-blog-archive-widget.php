<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

class WSS_Blog_Archive_Widget extends Widget_Base {

	public function get_name() {
		return 'wss_blog_archive';
	}

	public function get_title() {
		return __( 'WSS — Luxury Blog Archive & Journal', 'website-section-supporter' );
	}

	public function get_icon() {
		return 'eicon-archive-posts';
	}

	public function get_categories() {
		return array( 'website-section-supporter' );
	}

	public function get_keywords() {
		return array( 'blog', 'archive', 'journal', 'editorial', 'news', 'posts', 'magazine', 'category', 'pagination', 'luxury', 'wss' );
	}

	private function get_post_categories() {
		$categories = get_categories( array( 'hide_empty' => false ) );
		$options = array();
		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			foreach ( $categories as $cat ) {
				$options[ $cat->term_id ] = $cat->name;
			}
		}
		return $options;
	}

	protected function register_controls() {

		/* ================= CONTENT: SECTION HEADER ================= */
		$this->start_controls_section(
			'section_header_content',
			array( 'label' => __( 'Section Header & Archive Title', 'website-section-supporter' ) )
		);
		$this->add_control(
			'show_header',
			array(
				'label'        => __( 'Show Header', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'use_archive_title',
			array(
				'label'        => __( 'Dynamic Archive Title (On Category / Archive Pages)', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array( 'show_header' => 'yes' ),
			)
		);
		$this->add_control(
			'eyebrow',
			array(
				'label'       => __( 'Eyebrow Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'THE JOURNAL & ARCHIVE', 'website-section-supporter' ),
				'condition'   => array( 'show_header' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'heading_line1',
			array(
				'label'       => __( 'Heading Line 1', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'ARCHITECTURAL', 'website-section-supporter' ),
				'condition'   => array( 'show_header' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'heading_line2',
			array(
				'label'       => __( 'Heading Line 2', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'PERSPECTIVES', 'website-section-supporter' ),
				'condition'   => array( 'show_header' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'heading_html_tag',
			array(
				'label'     => __( 'Heading HTML Tag', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'options'   => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'condition' => array( 'show_header' => 'yes' ),
			)
		);
		$this->add_control(
			'description',
			array(
				'label'       => __( 'Description / Subtitle', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Curated essays, market intelligence, and timeless architectural stories from around the globe.', 'website-section-supporter' ),
				'condition'   => array( 'show_header' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'show_top_btn',
			array(
				'label'        => __( 'Show Top-Right Action Link', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
				'condition'    => array( 'show_header' => 'yes' ),
			)
		);
		$this->add_control(
			'top_btn_text',
			array(
				'label'       => __( 'Top-Right Link Text', 'website-section-supporter' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'VIEW ALL CATEGORIES', 'website-section-supporter' ),
				'condition'   => array( 'show_header' => 'yes', 'show_top_btn' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->add_control(
			'top_btn_link',
			array(
				'label'       => __( 'Top-Right Link URL', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'website-section-supporter' ),
				'default'     => array( 'url' => '#' ),
				'condition'   => array( 'show_header' => 'yes', 'show_top_btn' => 'yes' ),
				'dynamic'     => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: QUERY & ARCHIVE SOURCE ================= */
		$this->start_controls_section(
			'section_query',
			array( 'label' => __( 'Query & Archive Source', 'website-section-supporter' ) )
		);
		$this->add_control(
			'source_type',
			array(
				'label'   => __( 'Source Type', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'posts',
				'options' => array(
					'posts'   => __( 'WordPress Posts (Dynamic Query with Pagination)', 'website-section-supporter' ),
					'archive' => __( 'Current Archive Query (Auto-detects Category/Tag/Date Archive)', 'website-section-supporter' ),
					'custom'  => __( 'Custom Curated Stories (Repeater)', 'website-section-supporter' ),
				),
			)
		);
		$this->add_control(
			'posts_per_page',
			array(
				'label'     => __( 'Posts Per Page', 'website-section-supporter' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 6,
				'min'       => 1,
				'max'       => 48,
				'condition' => array( 'source_type!' => 'custom' ),
			)
		);
		$this->add_control(
			'categories',
			array(
				'label'       => __( 'Filter by Category', 'website-section-supporter' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->get_post_categories(),
				'condition'   => array( 'source_type' => 'posts' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'order_by',
			array(
				'label'     => __( 'Order By', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => array(
					'date'          => __( 'Date', 'website-section-supporter' ),
					'title'         => __( 'Title', 'website-section-supporter' ),
					'rand'          => __( 'Random', 'website-section-supporter' ),
					'comment_count' => __( 'Popularity (Comments)', 'website-section-supporter' ),
				),
				'condition' => array( 'source_type' => 'posts' ),
			)
		);
		$this->add_control(
			'order',
			array(
				'label'     => __( 'Order', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'DESC',
				'options'   => array(
					'DESC' => __( 'Descending (Newest First)', 'website-section-supporter' ),
					'ASC'  => __( 'Ascending (Oldest First)', 'website-section-supporter' ),
				),
				'condition' => array( 'source_type' => 'posts' ),
			)
		);

		/* Custom Repeater Items */
		$repeater = new Repeater();
		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Featured Image', 'website-section-supporter' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80' ),
			)
		);
		$repeater->add_control(
			'category',
			array(
				'label'   => __( 'Category Badge', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'ARCHITECTURE', 'website-section-supporter' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'date',
			array(
				'label'   => __( 'Publish Date', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'OCTOBER 2026', 'website-section-supporter' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'read_time',
			array(
				'label'   => __( 'Reading Time', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '5 MIN READ', 'website-section-supporter' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'title',
			array(
				'label'   => __( 'Article Title', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'The Revival of Organic Modernism in Coastal California', 'website-section-supporter' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'excerpt',
			array(
				'label'   => __( 'Excerpt', 'website-section-supporter' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Exploring how leading architectural visionaries are blending raw stone, blackened steel, and seamless ocean horizons into sculptural residential sanctuaries.', 'website-section-supporter' ),
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_control(
			'link',
			array(
				'label'       => __( 'Article Link', 'website-section-supporter' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'website-section-supporter' ),
				'default'     => array( 'url' => '#' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'custom_posts',
			array(
				'label'       => __( 'Curated Stories', 'website-section-supporter' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'image'     => array( 'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80' ),
						'category'  => 'ARCHITECTURE',
						'date'      => 'OCTOBER 2026',
						'read_time' => '5 MIN READ',
						'title'     => 'The Revival of Organic Modernism in Coastal Estates',
						'excerpt'   => 'Exploring how leading architectural visionaries blend raw stone, blackened steel, and seamless glass horizons into sculptural sanctuaries.',
					),
					array(
						'image'     => array( 'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80' ),
						'category'  => 'MARKET INTEL',
						'date'      => 'SEPTEMBER 2026',
						'read_time' => '7 MIN READ',
						'title'     => 'Global Trophy Real Estate Market: Trends & Valuations',
						'excerpt'   => 'An executive analysis on capital migration, ultra-prime demand in signature enclaves, and long-term tangible wealth preservation.',
					),
					array(
						'image'     => array( 'url' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=800&q=80' ),
						'category'  => 'LIFESTYLE',
						'date'      => 'AUGUST 2026',
						'read_time' => '4 MIN READ',
						'title'     => 'Curating Invisible Luxury: The Art of Private Retreats',
						'excerpt'   => 'Why the modern luxury collector is prioritizing acoustic privacy, subterranean art galleries, and biophilic wellness gardens.',
					),
					array(
						'image'     => array( 'url' => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=800&q=80' ),
						'category'  => 'DESIGN',
						'date'      => 'JULY 2026',
						'read_time' => '6 MIN READ',
						'title'     => 'Architectural Monoliths: Redefining Penthouse Living',
						'excerpt'   => 'How cantilevered terraces, bespoke material palettes, and expansive ceiling volumes create floating sanctuaries high above the city skyline.',
					),
					array(
						'image'     => array( 'url' => 'https://images.unsplash.com/photo-1600585152220-90363fe7e115?auto=format&fit=crop&w=800&q=80' ),
						'category'  => 'INSIGHTS',
						'date'      => 'JUNE 2026',
						'read_time' => '8 MIN READ',
						'title'     => 'The Sustainable Luxury Shift: Net-Zero Trophy Mansions',
						'excerpt'   => 'Merging geothermal micro-grids, reclaimed heritage timber, and architectural glass for carbon-neutral ultra-luxury residences.',
					),
					array(
						'image'     => array( 'url' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=800&q=80' ),
						'category'  => 'ESTATES',
						'date'      => 'MAY 2026',
						'read_time' => '5 MIN READ',
						'title'     => 'Equestrian & Vineyard Sanctuaries: The New Frontier',
						'excerpt'   => 'A look inside expansive multi-acre countryside compounds offering private helipads, award-winning cellars, and world-class stables.',
					),
				),
				'title_field' => '{{{ title }}}',
				'condition'   => array( 'source_type' => 'custom' ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: CATEGORY FILTER TABS ================= */
		$this->start_controls_section(
			'section_filter_bar',
			array( 'label' => __( 'Category Filter Bar', 'website-section-supporter' ) )
		);
		$this->add_control(
			'show_filter_bar',
			array(
				'label'        => __( 'Show Category Filter Tabs', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'all_filter_label',
			array(
				'label'     => __( '"All Stories" Label', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'ALL ESSAYS', 'website-section-supporter' ),
				'condition' => array( 'show_filter_bar' => 'yes' ),
				'dynamic'   => array( 'active' => true ),
			)
		);
		$this->end_controls_section();

		/* ================= CONTENT: LAYOUT & VISIBILITY ================= */
		$this->start_controls_section(
			'section_layout_settings',
			array( 'label' => __( 'Layout & Card Visibility', 'website-section-supporter' ) )
		);
		$this->add_control(
			'layout_preset',
			array(
				'label'   => __( 'Layout Preset', 'website-section-supporter' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'     => __( 'Architectural Grid', 'website-section-supporter' ),
					'magazine' => __( 'Editorial Magazine (1 Featured + Stacked List)', 'website-section-supporter' ),
					'list'     => __( 'Horizontal Editorial Rows', 'website-section-supporter' ),
				),
			)
		);
		$this->add_responsive_control(
			'grid_columns',
			array(
				'label'          => __( 'Grid Columns', 'website-section-supporter' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'condition'      => array( 'layout_preset' => 'grid' ),
				'selectors'      => array(
					'{{WRAPPER}} .wss-blog-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr) !important;',
				),
			)
		);
		$this->add_control(
			'aspect_ratio',
			array(
				'label'     => __( 'Image Aspect Ratio', 'website-section-supporter' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '16/10.5',
				'options'   => array(
					'16/10.5' => '16:10.5 (Luxury Wide)',
					'16/9'    => '16:9 (Widescreen)',
					'4/3'     => '4:3 (Classic)',
					'3/2'     => '3:2 (Editorial)',
					'1/1'     => '1:1 (Square)',
					'custom'  => 'Custom Ratio',
				),
				'condition' => array( 'layout_preset!' => 'list' ),
			)
		);
		$this->add_control(
			'custom_aspect_ratio',
			array(
				'label'     => __( 'Custom Ratio (e.g. 16/11)', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '16/11',
				'condition' => array( 'aspect_ratio' => 'custom', 'layout_preset!' => 'list' ),
			)
		);

		$this->add_control( 'card_elements_heading', array( 'label' => __( 'Card Elements', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_control( 'show_image', array( 'label' => __( 'Show Featured Image', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' ) );
		$this->add_control( 'show_badge', array( 'label' => __( 'Show Category Badge', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' ) );
		$this->add_control( 'show_date', array( 'label' => __( 'Show Date', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' ) );
		$this->add_control( 'show_read_time', array( 'label' => __( 'Show Reading Time', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' ) );
		$this->add_control( 'show_excerpt', array( 'label' => __( 'Show Excerpt', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' ) );
		$this->add_control( 'show_read_more', array( 'label' => __( 'Show "Read Article" Link', 'website-section-supporter' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'return_value' => 'yes' ) );
		$this->add_control( 'read_more_text', array( 'label' => __( 'Link Text', 'website-section-supporter' ), 'type' => Controls_Manager::TEXT, 'default' => __( 'READ ESSAY', 'website-section-supporter' ), 'condition' => array( 'show_read_more' => 'yes' ) ) );
		$this->end_controls_section();

		/* ================= CONTENT: PAGINATION ================= */
		$this->start_controls_section(
			'section_pagination',
			array( 'label' => __( 'Pagination', 'website-section-supporter' ) )
		);
		$this->add_control(
			'enable_pagination',
			array(
				'label'        => __( 'Enable Pagination', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'prev_text',
			array(
				'label'     => __( 'Previous Page Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'PREV', 'website-section-supporter' ),
				'condition' => array( 'enable_pagination' => 'yes' ),
			)
		);
		$this->add_control(
			'next_text',
			array(
				'label'     => __( 'Next Page Text', 'website-section-supporter' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'NEXT', 'website-section-supporter' ),
				'condition' => array( 'enable_pagination' => 'yes' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: SECTION ================= */
		$this->start_controls_section(
			'style_section',
			array( 'label' => __( 'Section & Background', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array( 'name' => 'section_bg', 'types' => array( 'classic', 'gradient' ), 'selector' => '{{WRAPPER}} .wss-blog-section' )
		);
		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => __( 'Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'vw' ),
				'selectors'  => array( '{{WRAPPER}} .wss-blog-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: HEADER ================= */
		$this->start_controls_section(
			'style_header',
			array( 'label' => __( 'Header Styling', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_header' => 'yes' ) )
		);
		$this->add_control( 'eyebrow_color', array( 'label' => __( 'Eyebrow Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-head .wss-eyebrow' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'eyebrow_typography', 'selector' => '{{WRAPPER}} .wss-blog-head .wss-eyebrow' ) );

		$this->add_control( 'heading_color', array( 'label' => __( 'Heading Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => array( '{{WRAPPER}} .wss-blog-head h1, {{WRAPPER}} .wss-blog-head h2, {{WRAPPER}} .wss-blog-head h3, {{WRAPPER}} .wss-blog-head h4, {{WRAPPER}} .wss-blog-head h5, {{WRAPPER}} .wss-blog-head h6, {{WRAPPER}} .wss-blog-heading' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'heading_typography', 'selector' => '{{WRAPPER}} .wss-blog-head h1, {{WRAPPER}} .wss-blog-head h2, {{WRAPPER}} .wss-blog-head h3, {{WRAPPER}} .wss-blog-head h4, {{WRAPPER}} .wss-blog-head h5, {{WRAPPER}} .wss-blog-head h6, {{WRAPPER}} .wss-blog-heading' ) );

		$this->add_control( 'desc_color', array( 'label' => __( 'Description Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => array( '{{WRAPPER}} .wss-blog-head-desc' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_group_control( Group_Control_Typography::get_type(), array( 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .wss-blog-head-desc' ) );

		$this->add_control( 'top_link_heading', array( 'label' => __( 'Top-Right Link', 'website-section-supporter' ), 'type' => Controls_Manager::HEADING, 'separator' => 'before' ) );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'top_link_typography', 'selector' => '{{WRAPPER}} .wss-blog-head .wss-btn-line' )
		);
		$this->start_controls_tabs( 'tabs_top_link_style' );
		$this->start_controls_tab( 'tab_top_link_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'top_link_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-head .wss-btn-line' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'top_link_icon_color',
			array(
				'label'     => __( 'Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-head .wss-btn-line svg' => 'stroke: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_top_link_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'top_link_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-head .wss-btn-line:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'top_link_hover_icon_color',
			array(
				'label'     => __( 'Hover Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-head .wss-btn-line:hover svg' => 'stroke: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: FILTER BAR ================= */
		$this->start_controls_section(
			'style_filter_bar',
			array( 'label' => __( 'Category Filter Tabs', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'show_filter_bar' => 'yes' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'filter_typography', 'selector' => '{{WRAPPER}} .wss-blog-filter-btn' )
		);
		$this->add_responsive_control(
			'filter_gap',
			array(
				'label'     => __( 'Gap Between Tabs', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'   => array( 'size' => 12 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-filter-bar' => 'gap: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->add_control(
			'filter_border_radius',
			array(
				'label'     => __( 'Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'   => array( 'size' => 30 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-filter-btn' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);

		$this->start_controls_tabs( 'tabs_filter_style' );
		$this->start_controls_tab( 'tab_filter_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'filter_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-filter-btn, {{WRAPPER}} .wss-blog-filter-btn span' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'filter_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-filter-btn' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'filter_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-filter-btn' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_filter_hover', array( 'label' => __( 'Hover / Active', 'website-section-supporter' ) ) );
		$this->add_control(
			'filter_hover_color',
			array(
				'label'     => __( 'Active Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-filter-btn:hover, {{WRAPPER}} .wss-blog-filter-btn:hover span, {{WRAPPER}} .wss-blog-filter-btn.is-active, {{WRAPPER}} .wss-blog-filter-btn.is-active span' => 'color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'filter_hover_bg',
			array(
				'label'     => __( 'Active Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-filter-btn:hover, {{WRAPPER}} .wss-blog-filter-btn.is-active' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;',
				),
			)
		);
		$this->add_control(
			'filter_hover_border_color',
			array(
				'label'     => __( 'Active Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wss-blog-filter-btn:hover, {{WRAPPER}} .wss-blog-filter-btn.is-active' => 'border-color: {{VALUE}} !important;',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: CARDS & GRID ================= */
		$this->start_controls_section(
			'style_cards',
			array( 'label' => __( 'Post Cards & Grid', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_responsive_control(
			'col_gap',
			array(
				'label'     => __( 'Column Gap', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'default'   => array( 'size' => 32 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-grid' => 'column-gap: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->add_responsive_control(
			'row_gap',
			array(
				'label'     => __( 'Row Gap', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
				'default'   => array( 'size' => 48 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-grid' => 'row-gap: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => __( 'Card Padding', 'website-section-supporter' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array( '{{WRAPPER}} .wss-blog-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;' ),
			)
		);
		$this->add_control(
			'card_border_radius',
			array(
				'label'     => __( 'Card Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-card' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array( 'name' => 'card_border', 'selector' => '{{WRAPPER}} .wss-blog-card' )
		);

		$this->start_controls_tabs( 'tabs_card_style' );
		$this->start_controls_tab( 'tab_card_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'card_bg',
			array(
				'label'     => __( 'Card Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'card_shadow', 'selector' => '{{WRAPPER}} .wss-blog-card' )
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_card_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'card_hover_bg',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'card_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array( 'name' => 'card_hover_shadow', 'selector' => '{{WRAPPER}} .wss-blog-card:hover' )
		);
		$this->add_control(
			'card_hover_lift',
			array(
				'label'     => __( 'Hover Lift (px)', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 30 ) ),
				'default'   => array( 'size' => 6 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover' => 'transform: translateY(-{{SIZE}}px) !important;' ),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: IMAGES ================= */
		$this->start_controls_section(
			'style_images',
			array( 'label' => __( 'Featured Image', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'img_border_radius',
			array(
				'label'     => __( 'Image Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'   => array( 'size' => 8 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-media' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->add_control(
			'img_hover_zoom',
			array(
				'label'        => __( 'Enable Luxury Hover Zoom (1.4s ease)', 'website-section-supporter' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: BADGE ================= */
		$this->start_controls_section(
			'style_badge',
			array( 'label' => __( 'Category Badge', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'badge_typography', 'selector' => '{{WRAPPER}} .wss-blog-badge' )
		);
		$this->add_control(
			'badge_border_radius',
			array(
				'label'     => __( 'Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'   => array( 'size' => 30 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-badge' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->start_controls_tabs( 'tabs_badge_style' );
		$this->start_controls_tab( 'tab_badge_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'badge_color',
			array(
				'label'     => __( 'Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-badge' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'badge_bg',
			array(
				'label'     => __( 'Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-badge' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'badge_border_color',
			array(
				'label'     => __( 'Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-badge' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_badge_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'badge_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover .wss-blog-badge' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'badge_hover_bg',
			array(
				'label'     => __( 'Hover Background Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover .wss-blog-badge' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'badge_hover_border_color',
			array(
				'label'     => __( 'Hover Border Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover .wss-blog-badge' => 'border-color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: META ================= */
		$this->start_controls_section(
			'style_meta',
			array( 'label' => __( 'Date & Reading Time Meta', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'meta_color',
			array(
				'label'     => __( 'Meta Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-meta' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'meta_typography', 'selector' => '{{WRAPPER}} .wss-blog-meta' )
		);
		$this->add_responsive_control(
			'meta_spacing',
			array(
				'label'     => __( 'Bottom Spacing', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'   => array( 'size' => 12 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-meta' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: POST TITLE ================= */
		$this->start_controls_section(
			'style_title',
			array( 'label' => __( 'Article Title', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .wss-blog-title' )
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab( 'tab_title_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-title' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_title_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Hover Title Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover .wss-blog-title' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'title_spacing',
			array(
				'label'     => __( 'Bottom Spacing', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 40 ) ),
				'default'   => array( 'size' => 12 ),
				'separator' => 'before',
				'selectors' => array( '{{WRAPPER}} .wss-blog-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->end_controls_section();

		/* ================= STYLE: EXCERPT ================= */
		$this->start_controls_section(
			'style_excerpt',
			array( 'label' => __( 'Excerpt', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_control(
			'excerpt_color',
			array(
				'label'     => __( 'Excerpt Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-excerpt' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'excerpt_typography', 'selector' => '{{WRAPPER}} .wss-blog-excerpt' )
		);
		$this->end_controls_section();

		/* ================= STYLE: READ MORE ================= */
		$this->start_controls_section(
			'style_more_link',
			array( 'label' => __( 'Read More Link', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'more_typography', 'selector' => '{{WRAPPER}} .wss-blog-more' )
		);
		$this->start_controls_tabs( 'tabs_more_style' );
		$this->start_controls_tab( 'tab_more_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control(
			'more_color',
			array(
				'label'     => __( 'Link Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-more' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'more_icon_color',
			array(
				'label'     => __( 'Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-more svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_more_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control(
			'more_hover_color',
			array(
				'label'     => __( 'Hover Text Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover .wss-blog-more' => 'color: {{VALUE}} !important;' ),
			)
		);
		$this->add_control(
			'more_hover_icon_color',
			array(
				'label'     => __( 'Hover Icon Color', 'website-section-supporter' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .wss-blog-card:hover .wss-blog-more svg' => 'stroke: {{VALUE}} !important; color: {{VALUE}} !important;' ),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		/* ================= STYLE: PAGINATION ================= */
		$this->start_controls_section(
			'style_pagination',
			array( 'label' => __( 'Pagination Styling', 'website-section-supporter' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array( 'enable_pagination' => 'yes' ) )
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array( 'name' => 'pagination_typography', 'selector' => '{{WRAPPER}} .wss-blog-pagination a, {{WRAPPER}} .wss-blog-pagination span' )
		);
		$this->add_responsive_control(
			'pagination_align',
			array(
				'label'     => __( 'Alignment', 'website-section-supporter' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array( 'title' => __( 'Left', 'website-section-supporter' ), 'icon' => 'eicon-text-align-left' ),
					'center'     => array( 'title' => __( 'Center', 'website-section-supporter' ), 'icon' => 'eicon-text-align-center' ),
					'flex-end'   => array( 'title' => __( 'Right', 'website-section-supporter' ), 'icon' => 'eicon-text-align-right' ),
				),
				'default'   => 'center',
				'selectors' => array( '{{WRAPPER}} .wss-blog-pagination' => 'justify-content: {{VALUE}} !important;' ),
			)
		);
		$this->add_responsive_control(
			'pagination_margin_top',
			array(
				'label'     => __( 'Top Margin', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 120 ) ),
				'default'   => array( 'size' => 60 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-pagination' => 'margin-top: {{SIZE}}{{UNIT}} !important;' ),
			)
		);
		$this->add_control(
			'pagination_border_radius',
			array(
				'label'     => __( 'Item Border Radius', 'website-section-supporter' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 0, 'max' => 50 ) ),
				'default'   => array( 'size' => 4 ),
				'selectors' => array( '{{WRAPPER}} .wss-blog-pagination a, {{WRAPPER}} .wss-blog-pagination span' => 'border-radius: {{SIZE}}{{UNIT}} !important;' ),
			)
		);

		$this->start_controls_tabs( 'tabs_pagination_style' );
		$this->start_controls_tab( 'tab_pagination_normal', array( 'label' => __( 'Normal', 'website-section-supporter' ) ) );
		$this->add_control( 'pagination_color', array( 'label' => __( 'Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination a, {{WRAPPER}} .wss-blog-pagination span' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'pagination_bg', array( 'label' => __( 'Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination a, {{WRAPPER}} .wss-blog-pagination span' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'pagination_border_color', array( 'label' => __( 'Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination a, {{WRAPPER}} .wss-blog-pagination span' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_pagination_hover', array( 'label' => __( 'Hover', 'website-section-supporter' ) ) );
		$this->add_control( 'pagination_hover_color', array( 'label' => __( 'Hover Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination a:hover' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'pagination_hover_bg', array( 'label' => __( 'Hover Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination a:hover' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'pagination_hover_border_color', array( 'label' => __( 'Hover Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination a:hover' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_pagination_active', array( 'label' => __( 'Active Page', 'website-section-supporter' ) ) );
		$this->add_control( 'pagination_active_color', array( 'label' => __( 'Active Text Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination .current, {{WRAPPER}} .wss-blog-pagination span.current' => 'color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'pagination_active_bg', array( 'label' => __( 'Active Background Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination .current, {{WRAPPER}} .wss-blog-pagination span.current' => 'background: {{VALUE}} !important; background-color: {{VALUE}} !important;' ) ) );
		$this->add_control( 'pagination_active_border_color', array( 'label' => __( 'Active Border Color', 'website-section-supporter' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .wss-blog-pagination .current, {{WRAPPER}} .wss-blog-pagination span.current' => 'border-color: {{VALUE}} !important;' ) ) );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function get_stories_data( $settings ) {
		$stories = array();
		$max_pages = 1;
		$paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );

		if ( 'custom' === $settings['source_type'] ) {
			$stories = ! empty( $settings['custom_posts'] ) ? $settings['custom_posts'] : array();
			return array(
				'stories'   => $stories,
				'max_pages' => 1,
				'paged'     => 1,
			);
		}

		if ( 'archive' === $settings['source_type'] ) {
			global $wp_query;
			if ( $wp_query && $wp_query->have_posts() ) {
				$max_pages = $wp_query->max_num_pages;
				while ( $wp_query->have_posts() ) {
					$wp_query->the_post();
					$post_id   = get_the_ID();
					$cat_terms = get_the_category( $post_id );
					$cat_name  = ! empty( $cat_terms ) ? $cat_terms[0]->name : 'EDITORIAL';
					$img_url   = get_the_post_thumbnail_url( $post_id, 'large' );
					if ( ! $img_url ) {
						$img_url = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80';
					}

					$content_words = str_word_count( strip_tags( get_the_content() ) );
					$read_mins     = max( 1, ceil( $content_words / 200 ) );

					$stories[] = array(
						'id'        => $post_id,
						'image'     => array( 'url' => $img_url ),
						'category'  => $cat_name,
						'cat_slug'  => ! empty( $cat_terms ) ? $cat_terms[0]->slug : 'editorial',
						'date'      => get_the_date( 'F Y' ),
						'read_time' => $read_mins . ' MIN READ',
						'title'     => get_the_title(),
						'excerpt'   => wp_trim_words( get_the_excerpt(), 22, '...' ),
						'link'      => array( 'url' => get_permalink() ),
					);
				}
				wp_reset_postdata();

				return array(
					'stories'   => $stories,
					'max_pages' => $max_pages,
					'paged'     => $paged,
				);
			}
		}

		// 'posts' standard dynamic query
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => ! empty( $settings['posts_per_page'] ) ? (int) $settings['posts_per_page'] : 6,
			'paged'          => $paged,
			'orderby'        => $settings['order_by'] ?? 'date',
			'order'          => $settings['order'] ?? 'DESC',
			'post_status'    => 'publish',
		);
		if ( ! empty( $settings['categories'] ) ) {
			$args['category__in'] = $settings['categories'];
		}

		$query = new \WP_Query( $args );
		if ( $query->have_posts() ) {
			$max_pages = $query->max_num_pages;
			while ( $query->have_posts() ) {
				$query->the_post();
				$post_id   = get_the_ID();
				$cat_terms = get_the_category( $post_id );
				$cat_name  = ! empty( $cat_terms ) ? $cat_terms[0]->name : 'EDITORIAL';
				$img_url   = get_the_post_thumbnail_url( $post_id, 'large' );
				if ( ! $img_url ) {
					$img_url = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80';
				}

				// Estimate reading time
				$content_words = str_word_count( strip_tags( get_the_content() ) );
				$read_mins     = max( 1, ceil( $content_words / 200 ) );

				$stories[] = array(
					'id'        => $post_id,
					'image'     => array( 'url' => $img_url ),
					'category'  => $cat_name,
					'cat_slug'  => ! empty( $cat_terms ) ? $cat_terms[0]->slug : 'editorial',
					'date'      => get_the_date( 'F Y' ),
					'read_time' => $read_mins . ' MIN READ',
					'title'     => get_the_title(),
					'excerpt'   => wp_trim_words( get_the_excerpt(), 22, '...' ),
					'link'      => array( 'url' => get_permalink() ),
				);
			}
			wp_reset_postdata();
		}

		return array(
			'stories'   => $stories,
			'max_pages' => $max_pages,
			'paged'     => $paged,
		);
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$query_result = $this->get_stories_data( $s );
		$stories      = $query_result['stories'];
		$max_pages    = $query_result['max_pages'];
		$paged        = $query_result['paged'];

		if ( empty( $stories ) ) {
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo '<div class="wss-scope" style="padding:40px;text-align:center;background:#eceae4;border:1px dashed #786f60;font-family:sans-serif;letter-spacing:1px;">';
				echo '<strong>' . esc_html__( 'WSS — Blog Archive Widget', 'website-section-supporter' ) . '</strong><br>';
				echo '<small>' . esc_html__( 'No posts found matching the query. Switch Source Type to "Custom Curated Stories" or publish posts.', 'website-section-supporter' ) . '</small>';
				echo '</div>';
			}
			return;
		}

		$layout_class = 'wss-blog-layout-' . ( $s['layout_preset'] ?? 'grid' );
		$ratio = ! empty( $s['aspect_ratio'] ) ? $s['aspect_ratio'] : '16/10.5';
		if ( 'custom' === $ratio && ! empty( $s['custom_aspect_ratio'] ) ) {
			$ratio = $s['custom_aspect_ratio'];
		}
		$ratio_style = ( 'list' !== ( $s['layout_preset'] ?? 'grid' ) ) ? 'aspect-ratio: ' . esc_attr( $ratio ) . ';' : '';
		$zoom_class  = ( 'yes' !== ( $s['img_hover_zoom'] ?? 'yes' ) ) ? ' wss-no-zoom' : '';

		// Dynamic Archive Heading
		$eyebrow_text = $s['eyebrow'] ?? '';
		$heading_l1   = $s['heading_line1'] ?? '';
		$heading_l2   = $s['heading_line2'] ?? '';
		$desc_text    = $s['description'] ?? '';

		if ( 'yes' === ( $s['use_archive_title'] ?? 'yes' ) && ( is_archive() || is_category() || is_tag() || is_author() || is_search() ) ) {
			if ( is_category() ) {
				$eyebrow_text = __( 'CATEGORY ARCHIVE', 'website-section-supporter' );
				$heading_l1   = single_cat_title( '', false );
				$heading_l2   = '';
				$cat_desc     = category_description();
				if ( ! empty( $cat_desc ) ) {
					$desc_text = wp_strip_all_tags( $cat_desc );
				}
			} elseif ( is_tag() ) {
				$eyebrow_text = __( 'TAG ARCHIVE', 'website-section-supporter' );
				$heading_l1   = single_tag_title( '', false );
				$heading_l2   = '';
			} elseif ( is_author() ) {
				$eyebrow_text = __( 'AUTHOR ARCHIVE', 'website-section-supporter' );
				$heading_l1   = get_the_author();
				$heading_l2   = '';
			} elseif ( is_search() ) {
				$eyebrow_text = __( 'SEARCH RESULTS', 'website-section-supporter' );
				$heading_l1   = sprintf( __( 'RESULTS FOR "%s"', 'website-section-supporter' ), get_search_query() );
				$heading_l2   = '';
			} elseif ( is_archive() ) {
				$heading_l1   = get_the_archive_title();
				$heading_l2   = '';
			}
		}

		// Filter bar categories collection
		$filter_categories = array();
		if ( 'yes' === ( $s['show_filter_bar'] ?? 'yes' ) ) {
			if ( 'custom' === $s['source_type'] ) {
				$unique_cats = array();
				foreach ( $stories as $st ) {
					if ( ! empty( $st['category'] ) && ! in_array( $st['category'], $unique_cats, true ) ) {
						$unique_cats[] = $st['category'];
						$filter_categories[] = array(
							'name' => $st['category'],
							'slug' => sanitize_title( $st['category'] ),
							'url'  => '#',
						);
					}
				}
			} else {
				$cat_args = array( 'hide_empty' => true );
				if ( ! empty( $s['categories'] ) && 'posts' === $s['source_type'] ) {
					$cat_args['include'] = $s['categories'];
				}
				$all_cats = get_categories( $cat_args );
				if ( ! empty( $all_cats ) && ! is_wp_error( $all_cats ) ) {
					foreach ( $all_cats as $c ) {
						$filter_categories[] = array(
							'name' => $c->name,
							'slug' => $c->slug,
							'url'  => get_category_link( $c->term_id ),
						);
					}
				}
			}
		}
		?>
		<div class="wss-scope">
			<section class="wss-blog-section wss-blog-archive-section wss-pad">
				<div class="wss-container">
					<?php if ( 'yes' === ( $s['show_header'] ?? 'yes' ) ) : ?>
						<div class="wss-blog-head wss-reveal">
							<div>
								<?php if ( ! empty( $eyebrow_text ) ) : ?>
									<span class="wss-eyebrow"><?php echo esc_html( $eyebrow_text ); ?></span>
								<?php endif; ?>
								<?php if ( ! empty( $heading_l1 ) || ! empty( $heading_l2 ) ) : ?>
									<?php $tag = ! empty( $s['heading_html_tag'] ) ? $s['heading_html_tag'] : 'h2'; ?>
									<<?php echo esc_attr( $tag ); ?> class="wss-blog-heading">
										<?php if ( ! empty( $heading_l1 ) ) : ?>
											<span class="wss-mask"><span><?php echo esc_html( $heading_l1 ); ?></span></span>
										<?php endif; ?>
										<?php if ( ! empty( $heading_l2 ) ) : ?>
											<span class="wss-mask wss-r2"><span><?php echo esc_html( $heading_l2 ); ?></span></span>
										<?php endif; ?>
									</<?php echo esc_attr( $tag ); ?>>
								<?php endif; ?>
								<?php if ( ! empty( $desc_text ) ) : ?>
									<p class="wss-blog-head-desc"><?php echo esc_html( $desc_text ); ?></p>
								<?php endif; ?>
							</div>

							<?php if ( 'yes' === ( $s['show_top_btn'] ?? 'no' ) && ! empty( $s['top_btn_text'] ) ) : ?>
								<a class="wss-btn-line" href="<?php echo esc_url( $s['top_btn_link']['url'] ?? '#' ); ?>"<?php echo ! empty( $s['top_btn_link']['is_external'] ) ? ' target="_blank"' : ''; ?>>
									<span><?php echo esc_html( $s['top_btn_text'] ); ?></span>
									<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( 'yes' === ( $s['show_filter_bar'] ?? 'yes' ) && ! empty( $filter_categories ) ) : ?>
						<div class="wss-blog-filter-bar wss-reveal">
							<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ) ); ?>" class="wss-blog-filter-btn <?php echo ( ! is_category() ) ? 'is-active' : ''; ?>">
								<span><?php echo esc_html( $s['all_filter_label'] ?: __( 'ALL ESSAYS', 'website-section-supporter' ) ); ?></span>
							</a>
							<?php foreach ( $filter_categories as $fcat ) :
								$is_current = is_category( $fcat['slug'] );
								?>
								<a href="<?php echo esc_url( $fcat['url'] ); ?>" class="wss-blog-filter-btn <?php echo $is_current ? 'is-active' : ''; ?>">
									<span><?php echo esc_html( $fcat['name'] ); ?></span>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<div class="wss-blog-grid <?php echo esc_attr( $layout_class . $zoom_class ); ?>">
						<?php foreach ( $stories as $index => $story ) :
							$url = ! empty( $story['link']['url'] ) ? esc_url( $story['link']['url'] ) : '#';
							$target = ! empty( $story['link']['is_external'] ) ? ' target="_blank"' : '';
							$stagger_delay = ' wss-r' . ( ( $index % 3 ) + 1 );
							?>
							<a class="wss-blog-card wss-reveal<?php echo esc_attr( $stagger_delay ); ?>" href="<?php echo $url; ?>"<?php echo $target; ?>>
								<?php if ( 'yes' === ( $s['show_image'] ?? 'yes' ) && ! empty( $story['image']['url'] ) ) : ?>
									<div class="wss-blog-media wss-img-reveal" style="<?php echo esc_attr( $ratio_style ); ?>">
										<img src="<?php echo esc_url( $story['image']['url'] ); ?>" alt="<?php echo esc_attr( $story['title'] ); ?>">
										<div class="wss-blog-media-overlay"></div>
										<?php if ( 'yes' === ( $s['show_badge'] ?? 'yes' ) && ! empty( $story['category'] ) ) : ?>
											<span class="wss-blog-badge"><?php echo esc_html( $story['category'] ); ?></span>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<?php if ( 'yes' === ( $s['show_date'] ?? 'yes' ) || 'yes' === ( $s['show_read_time'] ?? 'yes' ) ) : ?>
									<div class="wss-blog-meta">
										<?php if ( 'yes' === ( $s['show_date'] ?? 'yes' ) && ! empty( $story['date'] ) ) : ?>
											<span><?php echo esc_html( $story['date'] ); ?></span>
										<?php endif; ?>
										<?php if ( 'yes' === ( $s['show_date'] ?? 'yes' ) && 'yes' === ( $s['show_read_time'] ?? 'yes' ) && ! empty( $story['date'] ) && ! empty( $story['read_time'] ) ) : ?>
											<span class="wss-blog-meta-dot"></span>
										<?php endif; ?>
										<?php if ( 'yes' === ( $s['show_read_time'] ?? 'yes' ) && ! empty( $story['read_time'] ) ) : ?>
											<span><?php echo esc_html( $story['read_time'] ); ?></span>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<h3 class="wss-blog-title"><?php echo esc_html( $story['title'] ); ?></h3>

								<?php if ( 'yes' === ( $s['show_excerpt'] ?? 'yes' ) && ! empty( $story['excerpt'] ) ) : ?>
									<p class="wss-blog-excerpt"><?php echo esc_html( $story['excerpt'] ); ?></p>
								<?php endif; ?>

								<?php if ( 'yes' === ( $s['show_read_more'] ?? 'yes' ) ) : ?>
									<span class="wss-blog-more">
										<span><?php echo esc_html( $s['read_more_text'] ?: __( 'READ ESSAY', 'website-section-supporter' ) ); ?></span>
										<svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
									</span>
								<?php endif; ?>
							</a>
						<?php endforeach; ?>
					</div>

					<?php if ( 'yes' === ( $s['enable_pagination'] ?? 'yes' ) && $max_pages > 1 ) : ?>
						<div class="wss-blog-pagination wss-reveal">
							<?php
							$big = 999999999;
							echo paginate_links( array(
								'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format'    => '?paged=%#%',
								'current'   => max( 1, $paged ),
								'total'     => $max_pages,
								'prev_text' => '<svg viewBox="0 0 24 24" style="width:12px;height:12px;transform:rotate(180deg);"><path d="M5 12h14M12 5l7 7-7 7"/></svg> ' . esc_html( $s['prev_text'] ?: __( 'PREV', 'website-section-supporter' ) ),
								'next_text' => esc_html( $s['next_text'] ?: __( 'NEXT', 'website-section-supporter' ) ) . ' <svg viewBox="0 0 24 24" style="width:12px;height:12px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>',
								'type'      => 'plain',
								'mid_size'  => 2,
								'end_size'  => 1,
							) );
							?>
						</div>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}
}
