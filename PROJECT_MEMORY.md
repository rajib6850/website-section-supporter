# 🧠 Website Section Supporter (WSS) — Project Memory & Architecture Log

> **Purpose**: This persistent memory document tracks all architectural decisions, widget specifications, control structures, backward-compatibility layers, changelogs, and upcoming roadmaps for the **Website Section Supporter** WordPress/Elementor plugin. It is updated continuously to ensure zero loss of context, design tokens, or content.

---

## 📌 1. Project Overview & Core Architecture

- **Plugin Name**: Website Section Supporter (`website-section-supporter`)
- **Plugin Main File**: `website-section-supporter.php`
- **Target Page Builder**: Elementor & Elementor Pro
- **Design Aesthetic**: Ultra-Luxury Architectural Noir / Ivory (`#0d0d0d`, `#ffffff`, `#fcfbf9`, `#ded9d0`) with Cormorant Garamond, Syncopate, and Work Sans typography.
- **Git Repository**: `https://github.com/rajib6850/website-section-supporter.git` (Branch: `main`)

### Folder Structure
```
website-section-supporter/
├── assets/
│   ├── css/
│   │   └── wss-widgets.css       # Core design system, presets, animations, responsive rules
│   └── js/
│       └── wss-widgets.js        # Interactive multi-step forms, scroll reveal, AJAX engines
├── includes/
│   └── class-wss-widgets-loader.php # Central Elementor widget auto-loader & category registration
├── widgets/                      # Elementor widget class definitions
│   ├── class-wss-buyer-hero-widget.php
│   ├── class-wss-buyer-roadmap-widget.php
│   ├── class-wss-buyer-calculator-widget.php
│   ├── class-wss-buyer-vip-widget.php
│   ├── class-wss-buyer-guide-widget.php
│   ├── class-wss-seller-why-widget.php
│   ├── class-wss-seller-valuation-widget.php
│   ├── class-wss-home-evaluation-widget.php
│   └── ... (component & layout widgets)
├── PROJECT_MEMORY.md             # This persistent memory and documentation ledger
└── website-section-supporter.php # Plugin bootstrap, AJAX endpoints, security nonces, email dispatch
```

---

## 🏛️ 2. Comprehensive Elementor Widget Catalog

### 1. `WSS_Home_Evaluation_Widget` (`wss_home_evaluation`)
- **Title in Elementor**: `WSS — Home Evaluation`
- **File**: `widgets/class-wss-home-evaluation-widget.php`
- **Purpose**: High-converting, 3-step luxury Home Evaluation & Property Valuation form with custom Form Builder capabilities.
- **Elementor Control Sections**:
  - `Header` (Eyebrow, Heading, HTML Tag, Description, Scroll Reveal)
  - `Form Fields` (Repeater Form Builder with multi-step breaks, custom column widths)
  - `Buttons` (Next, Back, Submit labels, Privacy note)
  - `reCAPTCHA` (v2 Checkbox, v3 Invisible)
  - `Email Settings` (Admin Notification & Client Auto-Responder)
  - `Container` (Theme preset, Padding, Max Width)
  - `Typography` (Eyebrow, Heading, Description styling)
  - `Inputs & Pills` (Input background, text color, border colors)
  - `Button` (Submit/Next button background, text color, hover background, typography)

### 2. `WSS_Buyer_Roadmap_Widget` (`wss_buyer_roadmap`)
- **File**: `widgets/class-wss-buyer-roadmap-widget.php`
- **Purpose**: Interactive 6-milestone luxury home buying roadmap with phase accordions, key milestones, and downloadable buyer strategy.
- **Key Features**: TinyMCE WYSIWYG description with deliverable under `<hr>` and backward-compatibility render fallback.

### 3. `WSS_Seller_Why_Widget` (`wss_seller_why`)
- **File**: `widgets/class-wss-seller-why-widget.php`
- **Purpose**: 3-pillar seller advantage showcase (Private Client Advisory, Architectural Marketing, Targeted Capital Reach).

### 4. `WSS_Seller_Valuation_Widget` (`wss_seller_valuation`)
- **File**: `widgets/class-wss-seller-valuation-widget.php`
- **Purpose**: Home Valuation & Advisory Showcase CTA section for the Sell page.

### 5. `WSS_Buyer_Hero_Widget` (`wss_buyer_hero`)
- **File**: `widgets/class-wss-buyer-hero-widget.php`
- **Purpose**: High-impact editorial hero for luxury buyer resources with search modal triggers and statistics counter.

### 6. `WSS_Buyer_Calculator_Widget` (`wss_buyer_calculator`)
- **File**: `widgets/class-wss-buyer-calculator-widget.php`
- **Purpose**: Luxury mortgage & property equity forecasting calculator with interactive sliders and amortized schedule preview.

### 7. `WSS_Buyer_Vip_Widget` (`wss_buyer_vip`)
### 8. `WSS_Buyer_Guide_Widget` (`wss_buyer_guide`)
- **File**: `widgets/class-wss-buyer-guide-widget.php`
- **Purpose**: Downloadable Central Florida Luxury Buyer Dossier capture section with AJAX PDF delivery.

### 9. `WSS_Blog_Archive_Widget` (`wss_blog_archive`)
- **File**: `widgets/class-wss-blog-archive-widget.php`
- **Purpose**: Dedicated Luxury Blog Archive & Journal page widget with dynamic category/tag/author archive title detection, interactive category filter tabs, custom query or archive query support, and luxury styled pagination.

---

## 🎨 3. Design Standards & Strict Anti-Theme Overrides


To prevent WordPress or Elementor theme defaults (e.g. pink `#e2498a` or global accent colors) from overriding our ultra-luxury noir aesthetic:
1. **Buttons**:
   - Clean, solid architectural pill buttons with zero glass or pseudo-element glitching.
   - Normal: `background-color: #0d0d0d !important; color: #ffffff !important; border: 1px solid #0d0d0d !important; border-radius: 40px !important;`
   - Hover: `background-color: #ffffff !important; color: #0d0d0d !important; border-color: #0d0d0d !important; transform: translateY(-2px);`
   - Dark Theme: `background-color: #ffffff !important; color: #0d0d0d !important;`
2. **Inputs**:
   - Normal: `background: #faf9f7 !important; border: 1px solid #ded9d0 !important; color: #0d0d0d !important;`
   - Focus: `background: #ffffff !important; border-color: #0d0d0d !important; box-shadow: 0 0 0 1px #0d0d0d !important;`
3. **Amenity Checkbox Cards**:
   - Native checkbox inputs are hidden (`opacity: 0`).
   - Selected state uses `.is-checked` and `:has(input:checked)` for solid black/white inversion and SVG checkmark pop.

---

## 📜 4. Chronological Changelog & Decisions

| Commit / Date | Action / Milestone | Details |
| :--- | :--- | :--- |
| `0c859f5` | **Seller Widgets Committed** | Added `WSS_Seller_Why_Widget` & `WSS_Seller_Valuation_Widget`. |
| `c27e39c` | **Buyer Roadmap TinyMCE** | Converted milestone description to WYSIWYG editor. |
| `d2d1dda` | **Deliverable HTML under `<hr>`** | Moved deliverable content into editor under `<hr>`. |
| `3a7fbde` | **Backward Compatibility Fallback** | Added automatic render fallback for older saved Elementor data. |
| `73b25f4` | **Home Evaluation Form Widget** | Created standalone 3-step luxury Home Evaluation widget with AJAX & reCAPTCHA. |
| `6a69c54` | **Responsive Breakpoints Refined** | Added ultra-fine mobile styles for `<768px` and `<480px`. |
| `d9d8bc7` | **Elementor Pro Form Builder Engine** | Rebuilt Home Evaluation widget as a full Repeater-driven Form Builder with custom column widths. |
| `e134637` | **Luxury UI & Zero-Pink Overrides** | Added trust badges, step progress bar, interactive amenity cards, and strict black/white button styling. |
| `f1a2d40` | **HTML Files Moved to Backup** | Moved `buyer-resources.html`, `evaluation.html`, and `sell.html` to `backup -design` folder. |
| `b850ee0` | **Persistent Memory System** | Created `PROJECT_MEMORY.md` to continuously maintain project state. |
| `cb9d2fc` | **Popup Menu Logo Height Fix** | Removed hardcoded CSS height 28px on `#wss-menu .wss-menu-logo img` and updated Elementor selectors to directly drive live responsive height & max-height. |
| `a482fe1` | **Footer Brand Logo Link Support** | Added `logo_link` URL control with external/nofollow attributes and wrapped footer brand logo in clickable `.wss-foot-brand-link`. |
| `2e7b22c` | **Seller Valuation Button Controls & Styling** | Expanded `WSS_Seller_Valuation_Widget` with complete Elementor controls: gap, typography, padding, border radius, box shadow, normal/hover tabs, custom sweep bg, and external/nofollow attributes. |
| `2a47eee` | **Home Evaluation Form & Button Controls** | Added complete Contact Form parity to `WSS_Home_Evaluation_Widget`: Normal/Hover/Focus/Selected tabs, border radius, padding, box shadow, label styling, placeholder styling, dynamic curtain sweep hover, and back button controls. |
| `f32fb6a` | **Form Input Focus & Luxury Styling Match** | Unified Home Evaluation inputs with Contact Form: matched normal background (`#eceae4`), border radius (`5px`), focus background (`#ffffff`), focus border color (`#a8916f` / `var(--wss-taupe-deep)`), and soft luxury glow ring (`box-shadow: 0 0 0 3px rgba(168, 145, 111, 0.15)`). |
| `82ce01e` | **Luxury Button Text Color Transition Fix** | Added `0.4s` cubic-bezier transition to `.wss-btn-item`, `.wss-btn-item span`, `.wss-btn-primary`, `.wss-btn-secondary`, and inner SVG icons so text & stroke colors transition smoothly on hover. |
| `f6db737` | **Button SVG Icon Stroke & Color Transition Polish** | Added universal `stroke 0.4s` and `color 0.4s` hardware-accelerated transitions to all button presets (`.wss-btn-pill`, `.wss-btn-line`, `.wss-btn-solid`, `.wss-btn-glass`) and their nested SVG paths/polylines (`svg *`), ensuring seamless, silky icon color transitions on hover. |
| `f1c96d8` | **Luxury Blog Archive Widget** | Created `WSS_Blog_Archive_Widget` (`wss_blog_archive`) matching `WSS_Blog_Widget` with auto-detected category/archive titles, interactive category filter tabs, custom or archive pagination queries, and full luxury styling controls. |
| `890cb77` | **About / Advisory Widget Heading & Global Typography Support** | Updated `WSS_About_Widget` (`wss_about`) with dynamic `heading_html_tag` (H1-H6, div, span, p), `TEXTAREA` heading with dynamic tag support, `.wss-about-heading` class, full `!important` selector coverage for Elementor Global Typography and Global Colors across base and responsive CSS breakpoints, and added bottom spacing & max width controls. |
| `d92ca66` | **About Heading Global Font-Size & Typography Inheritance Fix** | Removed hardcoded CSS `font-size: clamp(...)` rules from `.wss-about-heading, .wss-about h2` in base stylesheet and responsive media queries (`991px`, `768px`, `480px`). Configured `--wss-size-primary: var(--e-global-typography-primary-font-size, inherit);` and `font-size: var(--wss-size-primary, inherit);` so Elementor Global Typography and Site Settings font sizes reflect directly and seamlessly. |
| `5519b44` | **Responsive Heading Auto-Scaling System (H1–H6)** | Implemented automatic mobile/tablet font-size scaling for headings (`h1` through `h6`) when only desktop font size is selected. If user explicitly defines a tablet/mobile font size in Elementor (Widget Typography or Site Settings), the explicit value takes full precedence over the auto-scaling rules. |
| `6d1b8d2` | **Buyer Roadmap & Buyer Widgets Mobile Typography Conflict Fix** | Removed leftover media query font-size/line-height/letter-spacing rules and `!important` flags on `.wss-buyer-roadmap-heading`, `.wss-buyer-guide-heading`, and `.wss-buyer-hero-heading` in `assets/css/wss-widgets.css` (1200px, 1024px, 768px, 480px) and expanded Elementor typography selectors and HTML tags in `WSS_Buyer_Roadmap_Widget`. |
| `062716d` | **Comprehensive All-Widget Heading & Typography Audit & Upgrade** | Systematically audited and upgraded all 26 Elementor widgets across the plugin. Standardized `heading_html_tag` control (`h1` through `h6`, `div`, `span`, `p`), expanded typography and color selector rules with full tag coverage, and updated dynamic render tags across all widgets. |
| `40b692b` | **Zero-Specificity `:where()` Fallback System for Responsive Headings** | Wrapped all responsive heading auto-scaling media queries (`991px`, `768px`, `480px`) in `:where(.wss-scope h1..h6)` with 0 specificity. Ensures any explicit Mobile or Tablet font-size set in **Site Settings > Theme Style > Typography** (`.elementor-kit-xxx`) or **Widget Typography** (`.elementor-element-xxx`) unconditionally wins and takes 100% priority over plugin fallback styles. |
| *Current* | **Testimonial Widget Style Heading Section Fix** | Added missing `start_controls_section( 'style_heading', ... )` in `WSS_Testimonial_Widget` and audited all 26 widgets to ensure 100% balanced section declaration parity. |


---

## 🔮 5. Planned & Upcoming Widgets

- **`WSS_Seller_Hero_Widget` (`wss_seller_hero`)**: Luxury Seller landing hero section with live equity stats and consultation trigger.
- **`WSS_Seller_Roadmap_Widget` (`wss_seller_roadmap`)**: Complete 6-phase luxury selling journey (Valuation, Curation, Private Network, Global Exposure, Negotiation, Closing).
