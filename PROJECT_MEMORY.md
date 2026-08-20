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
- **File**: `widgets/class-wss-buyer-vip-widget.php`
- **Purpose**: Private Off-Market Access & VIP Concierge application intake card.

### 8. `WSS_Buyer_Guide_Widget` (`wss_buyer_guide`)
- **File**: `widgets/class-wss-buyer-guide-widget.php`
- **Purpose**: Downloadable Central Florida Luxury Buyer Dossier capture section with AJAX PDF delivery.

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
| `973ab28` | **AJAX Resilience & Button Swipe Hover** | Added `wp_localize_script` for `admin-ajax.php`, safe JSON/text response parsing, caching fallback for nonces, and unified the signature swipe pseudo-element hover effect across all buttons. |
| *Current* | **Admin Recipient Email Dispatch Fix** | Fixed `From:` header for SMTP authentication, added multi-recipient comma-separated parsing, and hooked into Elementor Pro Submissions logging. |

---

## 🔮 5. Planned & Upcoming Widgets

- **`WSS_Seller_Hero_Widget` (`wss_seller_hero`)**: Luxury Seller landing hero section with live equity stats and consultation trigger.
- **`WSS_Seller_Roadmap_Widget` (`wss_seller_roadmap`)**: Complete 6-phase luxury selling journey (Valuation, Curation, Private Network, Global Exposure, Negotiation, Closing).
