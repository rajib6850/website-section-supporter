( function () {
	"use strict";

	/* ─── helpers ──────────────────────────────────────────── */
	function ready( fn ) {
		if ( document.readyState !== "loading" ) { fn(); } else { document.addEventListener( "DOMContentLoaded", fn ); }
	}

	/* ─── 1. Header & Menu Logic ───────────────────────────── */
	document.addEventListener( "click", function ( e ) {
		var burger = e.target.closest( "#wss-menuBtn" );
		var closer = e.target.closest( "#wss-closeBtn" );
		
		if ( burger || closer ) {
			document.body.classList.toggle( "wss-menu-open" );
		}

		/* Submenu toggle logic (for WP Menu in Popup) — multi-level nested accordion */
		var menuItem = e.target.closest( "#wss-menu .menu-item-has-children > a" );
		if ( menuItem ) {
			e.preventDefault();
			var parentLi = menuItem.parentElement;
			var subMenu  = menuItem.nextElementSibling;
			var isOpen   = parentLi.classList.contains( "wss-sub-open" );
			var parentList = parentLi.parentElement;

			/* Close sibling items at the same level and their children */
			if ( parentList ) {
				var siblings = parentList.querySelectorAll( ":scope > .menu-item-has-children.wss-sub-open" );
				siblings.forEach( function( sib ) {
					if ( sib !== parentLi ) {
						sib.classList.remove( "wss-sub-open" );
						sib.querySelectorAll( ".wss-sub-open" ).forEach( function( child ) {
							child.classList.remove( "wss-sub-open" );
						} );
					}
				} );
			}

			/* Toggle clicked item & collapse children if closing */
			if ( isOpen ) {
				parentLi.classList.remove( "wss-sub-open" );
				parentLi.querySelectorAll( ".wss-sub-open" ).forEach( function( child ) {
					child.classList.remove( "wss-sub-open" );
				} );
			} else {
				parentLi.classList.add( "wss-sub-open" );
				if ( subMenu && subMenu.classList.contains( "sub-menu" ) ) {
					subMenu.classList.add( "wss-sub-open" );
				}
			}
		}

		/* Close menu on standard link click */
		var link = e.target.closest( ".wss-menu-links a" );
		if ( link && !e.target.closest(".menu-item-has-children > a") ) {
			document.body.classList.remove( "wss-menu-open" );
		}

		/* Sales carousel nav buttons */
		var next = e.target.closest( ".wss-sales-next" );
		var prev = e.target.closest( ".wss-sales-prev" );
		if ( next || prev ) {
			var wrap  = ( next || prev ).closest( ".wss-sales-wrap" );
			var track = wrap ? wrap.querySelector( ".wss-sales-track" ) : null;
			if ( track ) {
				var card = track.querySelector( ".wss-sale-card" );
				var gap  = parseFloat( window.getComputedStyle( track ).gap ) || 16;
				var amount = card ? ( card.offsetWidth + gap ) : ( track.clientWidth * 0.85 );
				track.scrollBy( { left: next ? amount : -amount, behavior: "smooth" } );
			}
		}

		/* Team Slider nav buttons */
		var teamNext = e.target.closest( ".wss-team-next" );
		var teamPrev = e.target.closest( ".wss-team-prev" );
		if ( teamNext || teamPrev ) {
			var teamWrap  = ( teamNext || teamPrev ).closest( ".wss-team-slider-wrap" );
			var teamContainer = teamWrap ? teamWrap.querySelector( ".wss-team-track-container" ) : null;
			var teamTrack = teamWrap ? teamWrap.querySelector( ".wss-team-track" ) : null;
			if ( teamContainer && teamTrack ) {
				var teamCard = teamTrack.querySelector( ".wss-team-card" );
				var teamGap  = parseFloat( window.getComputedStyle( teamTrack ).gap ) || 32;
				var scrollAmount = teamCard ? ( teamCard.offsetWidth + teamGap ) : ( teamContainer.clientWidth * 0.85 );
				teamContainer.scrollBy( { left: teamNext ? scrollAmount : -scrollAmount, behavior: "smooth" } );
			}
		}

		/* Team Profile Modal: Open Trigger */
		var modalTrigger = e.target.closest( "[data-modal-target]" );
		if ( modalTrigger ) {
			// Don't trigger if user clicked directly on telephone or email links inside card footer
			if ( e.target.closest( ".wss-team-icon-link" ) ) {
				return;
			}
			var targetSelector = modalTrigger.getAttribute( "data-modal-target" );
			if ( targetSelector ) {
				var targetModal = document.querySelector( targetSelector );
				if ( targetModal ) {
					e.preventDefault();
					targetModal.classList.add( "wss-modal-active" );
					document.body.classList.add( "wss-modal-open" );
				}
			}
		}

		/* Team Profile Modal: Close Trigger (Close Button or Overlay) */
		var modalClose = e.target.closest( ".wss-team-modal-close, .wss-modal-close" );
		var modalOverlay = e.target.closest( ".wss-team-modal-overlay" );
		if ( modalClose || modalOverlay ) {
			var openModal = ( modalClose || modalOverlay ).closest( ".wss-team-modal" );
			if ( openModal ) {
				e.preventDefault();
				openModal.classList.remove( "wss-modal-active" );
				if ( ! document.querySelector( ".wss-team-modal.wss-modal-active" ) ) {
					document.body.classList.remove( "wss-modal-open" );
				}
			}
		}
	} );

	document.addEventListener( "keydown", function ( e ) {
		if ( e.key === "Escape" ) {
			if ( document.body.classList.contains( "wss-menu-open" ) ) {
				document.body.classList.remove( "wss-menu-open" );
			}
			var activeModals = document.querySelectorAll( ".wss-team-modal.wss-modal-active" );
			if ( activeModals.length ) {
				activeModals.forEach( function ( m ) {
					m.classList.remove( "wss-modal-active" );
				} );
				document.body.classList.remove( "wss-modal-open" );
			}
		}
	} );

	/* ─── 2. Newsletter & Contact Forms ─────────────────────── */
	document.addEventListener( "submit", function ( e ) {
		// A. Newsletter Form
		var nlForm = e.target.closest( ".wss-nl-form" );
		if ( nlForm ) {
			var isNlAjax = nlForm.classList.contains( "wss-ajax-form" );
			if ( ! nlForm.getAttribute( "action" ) && ! isNlAjax ) {
				e.preventDefault();
				var btn = nlForm.querySelector( "button" );
				if ( btn ) { btn.textContent = "Subscribed"; }
				nlForm.reset();
				return;
			}

			if ( isNlAjax ) {
				e.preventDefault();
				var btn = nlForm.querySelector( "button" );
				var msg = nlForm.querySelector( ".wss-nl-msg" );
				var originalBtnText = btn ? btn.innerHTML : "Submit";
				
				if ( btn ) btn.innerHTML = "Sending...";
				if ( msg ) { msg.style.display = "none"; msg.style.color = "var(--wss-white)"; }

				var formData = new FormData( nlForm );

				fetch( nlForm.getAttribute( "action" ), {
					method: "POST",
					body: formData
				} )
				.then( function( response ) { return response.json(); } )
				.then( function( data ) {
					if ( msg ) {
						msg.style.display = "block";
						msg.innerHTML = data.data && data.data.message ? data.data.message : ( data.success ? "Subscribed successfully!" : "Error submitting form." );
						msg.style.color = data.success ? "#4caf50" : "#f44336";
					}
					if ( btn ) btn.innerHTML = data.success ? "Subscribed" : originalBtnText;
					if ( data.success ) nlForm.reset();
				} )
				.catch( function( error ) {
					if ( msg ) {
						msg.style.display = "block";
						msg.innerHTML = "A network error occurred.";
						msg.style.color = "#f44336";
					}
					if ( btn ) btn.innerHTML = originalBtnText;
				} );
			}
			return;
		}

		// B. Contact Form
		var contactForm = e.target.closest( ".wss-contact-ajax-form" );
		if ( contactForm ) {
			e.preventDefault();
			var submitBtn = contactForm.querySelector( "button[type='submit'], .wss-send-btn" );
			var statusMsg = contactForm.querySelector( ".wss-form-status-msg" );
			var toast = document.getElementById( "wssToast" ) || document.querySelector( ".wss-toast-msg" );
			var originalBtnHtml = submitBtn ? submitBtn.innerHTML : "<span>SEND MESSAGE</span>";

			if ( submitBtn ) {
				submitBtn.disabled = true;
				var spanText = submitBtn.querySelector( "span" );
				if ( spanText ) { spanText.textContent = "SENDING..."; }
			}

			if ( statusMsg ) { statusMsg.style.display = "none"; }

			var contactFormData = new FormData( contactForm );

			fetch( contactForm.getAttribute( "action" ), {
				method: "POST",
				body: contactFormData
			} )
			.then( function( response ) { return response.json(); } )
			.then( function( data ) {
				if ( submitBtn ) {
					submitBtn.disabled = false;
					submitBtn.innerHTML = originalBtnHtml;
				}

				var replyText = data.data && data.data.message ? data.data.message : ( data.success ? "Message sent successfully!" : "Error submitting form." );

				if ( statusMsg ) {
					statusMsg.style.display = "block";
					statusMsg.innerHTML = replyText;
					statusMsg.style.background = data.success ? "rgba(56, 161, 105, 0.12)" : "rgba(229, 62, 62, 0.12)";
					statusMsg.style.color = data.success ? "#276749" : "#c53030";
					statusMsg.style.border = "1px solid " + ( data.success ? "rgba(56, 161, 105, 0.3)" : "rgba(229, 62, 62, 0.3)" );
				}

				if ( toast ) {
					var toastSpan = toast.querySelector( "span" );
					if ( toastSpan ) { toastSpan.textContent = replyText; }
					toast.classList.add( "show" );
					setTimeout( function () { toast.classList.remove( "show" ); }, 5000 );
				}

				if ( data.success ) {
					contactForm.reset();
				}
			} )
			.catch( function( error ) {
				if ( submitBtn ) {
					submitBtn.disabled = false;
					submitBtn.innerHTML = originalBtnHtml;
				}
				if ( statusMsg ) {
					statusMsg.style.display = "block";
					statusMsg.innerHTML = "A network error occurred. Please try again.";
					statusMsg.style.background = "rgba(229, 62, 62, 0.12)";
					statusMsg.style.color = "#c53030";
					statusMsg.style.border = "1px solid rgba(229, 62, 62, 0.3)";
				}
			} );
			return;
		}

		// C. Buyer Guide & Lead Magnet Form
		var guideForm = e.target.closest( ".wss-buyer-guide-form" );
		if ( guideForm ) {
			e.preventDefault();
			var guideBtn = guideForm.querySelector( "button[type='submit'], .wss-buyer-guide-submit-btn" );
			var formBox = guideForm.closest( ".wss-buyer-guide-form-box" );
			var successBox = formBox ? formBox.querySelector( ".wss-buyer-guide-success-state" ) : null;
			var originalBtnHtml = guideBtn ? guideBtn.innerHTML : "<span>Download Guide</span>";
			var autoDownload = guideForm.getAttribute( "data-auto-download" ) === "yes";
			var pdfUrl = guideForm.getAttribute( "data-pdf-url" ) || "";

			if ( guideBtn ) {
				guideBtn.disabled = true;
				guideBtn.innerHTML = "<span>SENDING...</span>";
			}

			var guideFormData = new FormData( guideForm );

			fetch( guideForm.getAttribute( "action" ), {
				method: "POST",
				body: guideFormData
			} )
			.then( function( response ) { return response.json(); } )
			.then( function( data ) {
				if ( guideBtn ) {
					guideBtn.disabled = false;
					guideBtn.innerHTML = originalBtnHtml;
				}

				if ( data.success ) {
					guideForm.style.display = "none";
					if ( successBox ) {
						successBox.style.display = "block";
						var pTag = successBox.querySelector( "p" );
						if ( pTag && data.data && data.data.message ) {
							pTag.textContent = data.data.message;
						}
					}
					var resolvedPdfUrl = ( data.data && data.data.pdf_url ) ? data.data.pdf_url : pdfUrl;
					if ( autoDownload && resolvedPdfUrl ) {
						var tempLink = document.createElement( "a" );
						tempLink.href = resolvedPdfUrl;
						tempLink.setAttribute( "download", "" );
						tempLink.setAttribute( "target", "_blank" );
						document.body.appendChild( tempLink );
						tempLink.click();
						document.body.removeChild( tempLink );
					}
				} else {
					var errorMsg = data.data && data.data.message ? data.data.message : "Error submitting form. Please try again.";
					alert( errorMsg );
				}
			} )
			.catch( function( error ) {
				if ( guideBtn ) {
					guideBtn.disabled = false;
					guideBtn.innerHTML = originalBtnHtml;
				}
				alert( "A network error occurred. Please try again." );
			} );
			return;
		}
	} );

	ready( function () {

		/* ─── 3. Preloader ──────────────────────────────────── */
		var preloader = document.getElementById( "wss-preloader" );
		if ( preloader ) {
			window.addEventListener( "load", function () {
				setTimeout( function () { preloader.classList.add( "wss-preloader--done" ); }, 350 );
			} );
		}

		/* ─── 4. Custom cursor ──────────────────────────────── */
		if ( window.matchMedia( "(hover:hover) and (pointer:fine)" ).matches ) {
			var cursor = document.getElementById( "wss-cursor" );
			if ( ! cursor ) {
				cursor = document.createElement( "div" );
				cursor.id = "wss-cursor";
				cursor.innerHTML = "<span>VIEW</span>";
				document.body.appendChild( cursor );
			}
			var mx = 0, my = 0, cx = 0, cy = 0;
			window.addEventListener( "mousemove", function ( e ) { mx = e.clientX; my = e.clientY; } );
			( function loop() {
				cx += ( mx - cx ) * 0.18;
				cy += ( my - cy ) * 0.18;
				cursor.style.transform = "translate(" + cx + "px, " + cy + "px) translate(-50%,-50%)";
				requestAnimationFrame( loop );
			} )();
			document.querySelectorAll( ".wss-img-cover, .wss-tri-panel, .wss-lg-item, .wss-sales-nav button" ).forEach( function ( el ) {
				el.addEventListener( "mouseenter", function () { cursor.classList.add( "wss-cursor--big" ); } );
				el.addEventListener( "mouseleave", function () { cursor.classList.remove( "wss-cursor--big" ); } );
			} );
		}

		/* ─── 5. Scroll-reveal via IntersectionObserver (Viewport Enter) ─────── */
		var scrollObserver = null;
		function initScrollReveal( rootEl ) {
			var isEditor = document.body.classList.contains( "elementor-editor-active" ) || document.querySelector( ".elementor-editor-active" );
			var targetScope = rootEl || document;
			var reveals = targetScope.querySelectorAll( ".wss-reveal, .wss-img-reveal" );
			if ( ! reveals.length ) return;

			if ( isEditor ) {
				reveals.forEach( function ( el ) {
					el.classList.add( "wss-is-visible" );
				} );
				return;
			}

			if ( "IntersectionObserver" in window ) {
				if ( ! scrollObserver ) {
					scrollObserver = new IntersectionObserver( function ( entries ) {
						entries.forEach( function ( entry ) {
							if ( entry.isIntersecting ) {
								entry.target.classList.add( "wss-is-visible" );
								scrollObserver.unobserve( entry.target );
							}
						} );
					}, { threshold: 0.01, rootMargin: "0px 0px 80px 0px" } );
				}

				reveals.forEach( function ( el ) {
					if ( ! el.classList.contains( "wss-is-visible" ) ) {
						// If element is already in current viewport on load, reveal immediately
						var rect = el.getBoundingClientRect();
						if ( rect.top < ( window.innerHeight || document.documentElement.clientHeight ) && rect.bottom > 0 ) {
							el.classList.add( "wss-is-visible" );
						} else {
							scrollObserver.observe( el );
						}
					}
				} );
			} else {
				reveals.forEach( function ( el ) {
					el.classList.add( "wss-is-visible" );
				} );
			}
		}

		initScrollReveal();

		/* ─── 6. Header: luxury sticky / smart scroll ─────────────── */
		function initHeaderSticky() {
			var headers = document.querySelectorAll( ".wss-header" );
			if ( ! headers.length ) return;

			headers.forEach( function ( header ) {
				var isStickyEnabled = header.getAttribute( "data-wss-sticky" ) === "yes" || header.classList.contains( "wss-header--sticky" );
				if ( ! isStickyEnabled ) {
					if ( header._onScrollHandler ) {
						window.removeEventListener( "scroll", header._onScrollHandler );
						header._onScrollHandler = null;
					}
					header.classList.remove( "wss-header--solid", "wss-is-sticky", "wss-header--hidden" );
					return;
				}

				if ( header._onScrollHandler ) {
					window.removeEventListener( "scroll", header._onScrollHandler );
				}

				var lastY = window.pageYOffset || document.documentElement.scrollTop;
				var stickyType = header.getAttribute( "data-sticky-type" ) || "custom";
				var customThresh = parseInt( header.getAttribute( "data-sticky-thresh" ), 10 );
				if ( isNaN( customThresh ) ) { customThresh = 100; }
				var behavior = header.getAttribute( "data-sticky-behavior" ) || "always_sticky";

				var baseIsOnHero = header.classList.contains( "wss-header--on-hero" ) || header.getAttribute( "data-is-on-hero" ) === "yes";
				if ( header.classList.contains( "wss-header--on-hero" ) ) {
					header.setAttribute( "data-is-on-hero", "yes" );
					baseIsOnHero = true;
				}

				function onScroll() {
					var y = window.pageYOffset || document.documentElement.scrollTop;
					var threshold = customThresh;

					if ( stickyType === "after_hero" ) {
						var heroEl = document.querySelector( ".wss-hero" );
						var heroH = heroEl ? heroEl.offsetHeight : 400;
						threshold = Math.max( heroH - 100, 50 );
					} else if ( stickyType === "instant" ) {
						threshold = 10;
					}

					var isPastThreshold = y > threshold;
					header.classList.toggle( "wss-header--solid", isPastThreshold );
					header.classList.toggle( "wss-is-sticky", isPastThreshold );

					if ( baseIsOnHero ) {
						header.classList.toggle( "wss-header--on-hero", ! isPastThreshold );
					}

					if ( behavior === "hide_on_scroll_down" ) {
						if ( y > lastY && y > threshold + 100 ) {
							header.classList.add( "wss-header--hidden" );
						} else {
							header.classList.remove( "wss-header--hidden" );
						}
					} else {
						header.classList.remove( "wss-header--hidden" );
					}

					lastY = y;
				}

				header._onScrollHandler = onScroll;
				window.addEventListener( "scroll", onScroll, { passive: true } );
				onScroll();
			} );
		}

		initHeaderSticky();

		/* ─── 7. Luxury Video Modal ───────────────────────────── */
		document.addEventListener( "click", function ( e ) {
			var trigger = e.target.closest( ".wss-video-trigger" );
			if ( trigger ) {
				var videoUrl = trigger.getAttribute( "data-video-url" );
				if ( ! videoUrl ) return;

				var modal = document.getElementById( "wss-video-modal" );
				if ( ! modal ) {
					modal = document.createElement( "div" );
					modal.className = "wss-video-modal";
					modal.id = "wss-video-modal";
					modal.innerHTML = '<button class="wss-modal-close" id="wss-modal-close" aria-label="Close video"><svg viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg></button><div class="wss-modal-content" id="wss-modal-content"></div>';
					document.body.appendChild( modal );

					modal.addEventListener( "click", function ( ev ) {
						if ( ev.target === modal || ev.target.closest( ".wss-modal-close" ) ) {
							modal.classList.remove( "wss-is-open" );
							setTimeout( function () {
								document.getElementById( "wss-modal-content" ).innerHTML = "";
							}, 600 );
						}
					} );
				}

				var content = document.getElementById( "wss-modal-content" );
				var ytMatch = videoUrl.match( /(?:youtube(?:-nocookie)?\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i );
				
				if ( ytMatch && ytMatch[1] ) {
					content.innerHTML = '<iframe src="https://www.youtube.com/embed/' + ytMatch[1] + '?autoplay=1&mute=0&rel=0&showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
				} else {
					content.innerHTML = '<video src="' + videoUrl + '" autoplay controls playsinline></video>';
				}

				setTimeout( function () {
					modal.classList.add( "wss-is-open" );
				}, 10 );
			}
		} );

		/* ─── 8. Newsletter Parallax & Motion Engine ────────── */
		function initNewsletterParallax() {
			var nlSections = document.querySelectorAll( ".wss-newsletter.wss-has-parallax" );
			if ( ! nlSections.length ) return;

			var ticking = false;

			function updateNlParallax() {
				var isMobile = window.innerWidth <= 768;
				var winH = window.innerHeight;

				nlSections.forEach( function ( section ) {
					var mode = section.getAttribute( "data-parallax-mode" ) || "scroll";
					var disableMobile = section.getAttribute( "data-parallax-disable-mobile" ) === "yes";
					var img = section.querySelector( ".wss-newsletter-bg.wss-parallax-img" );

					if ( ! img ) return;

					if ( isMobile && disableMobile ) {
						img.style.transform = "none";
						return;
					}

					var rect = section.getBoundingClientRect();
					if ( rect.top < winH && rect.bottom > 0 ) {
						var speed = parseFloat( section.getAttribute( "data-parallax-speed" ) ) || 0.18;
						var scale = parseFloat( section.getAttribute( "data-parallax-scale" ) ) || 1.25;
						var dir = section.getAttribute( "data-parallax-direction" ) || "up";
						var offset = ( rect.top + rect.height / 2 ) - ( winH / 2 );

						if ( mode === "scroll" ) {
							var moveX = 0;
							var moveY = 0;
							if ( dir === "up" ) {
								moveY = -offset * speed;
							} else if ( dir === "down" ) {
								moveY = offset * speed;
							} else if ( dir === "left" ) {
								moveX = -offset * speed;
							} else if ( dir === "right" ) {
								moveX = offset * speed;
							}
							img.style.transform = "scale(" + scale + ") translate3d(" + moveX.toFixed(2) + "px, " + moveY.toFixed(2) + "px, 0)";
						} else if ( mode === "zoom" ) {
							var progress = 1 - Math.abs( offset ) / ( winH + rect.height );
							progress = Math.max( 0, Math.min( 1, progress ) );
							var zoom = scale + ( progress * speed * 0.4 );
							img.style.transform = "scale(" + zoom.toFixed(3) + ")";
						}
					}
				} );
				ticking = false;
			}

			function requestNlParallaxTick() {
				if ( ! ticking ) {
					requestAnimationFrame( updateNlParallax );
					ticking = true;
				}
			}

			window.addEventListener( "scroll", requestNlParallaxTick, { passive: true } );
			window.addEventListener( "resize", requestNlParallaxTick, { passive: true } );
			updateNlParallax();

			/* 3D Tilt Mouse Parallax for Newsletter */
			nlSections.forEach( function ( section ) {
				var mode = section.getAttribute( "data-parallax-mode" );
				if ( mode === "tilt" && ! section._tiltBound ) {
					section._tiltBound = true;
					var img = section.querySelector( ".wss-newsletter-bg.wss-parallax-img" );
					var tiltMax = parseFloat( section.getAttribute( "data-tilt-max" ) ) || 10;
					var scale = parseFloat( section.getAttribute( "data-parallax-scale" ) ) || 1.15;

					section.addEventListener( "mousemove", function ( e ) {
						if ( window.innerWidth <= 768 && section.getAttribute( "data-parallax-disable-mobile" ) === "yes" ) return;
						var r = section.getBoundingClientRect();
						var x = ( e.clientX - r.left ) / r.width - 0.5;
						var y = ( e.clientY - r.top ) / r.height - 0.5;
						var rotX = -y * tiltMax;
						var rotY = x * tiltMax;
						if ( img ) {
							img.style.transform = "scale(" + scale + ") perspective(1000px) rotateX(" + rotX.toFixed(2) + "deg) rotateY(" + rotY.toFixed(2) + "deg)";
						}
					} );

					section.addEventListener( "mouseleave", function () {
						if ( img ) {
							img.style.transform = "scale(" + scale + ") perspective(1000px) rotateX(0deg) rotateY(0deg)";
						}
					} );
				}
			} );
		}

		initNewsletterParallax();

		/* ─── 9. About / Advisory Media Parallax & Motion Engine ─── */
		function initAboutParallax() {
			var parallaxItems = document.querySelectorAll( ".wss-about-media.wss-has-parallax" );
			if ( ! parallaxItems.length ) return;

			var ticking = false;

			function updateParallax() {
				var isMobile = window.innerWidth <= 768;
				var winH = window.innerHeight;

				parallaxItems.forEach( function ( wrap ) {
					var mode = wrap.getAttribute( "data-parallax-mode" ) || "scroll";
					var disableMobile = wrap.getAttribute( "data-parallax-disable-mobile" ) === "yes";
					var img = wrap.querySelector( ".wss-parallax-img" );

					if ( isMobile && disableMobile ) {
						if ( img ) { img.style.transform = "none"; }
						return;
					}

					var rect = wrap.getBoundingClientRect();
					if ( rect.top < winH && rect.bottom > 0 ) {
						var speed = parseFloat( wrap.getAttribute( "data-parallax-speed" ) ) || 0.18;
						var scale = parseFloat( wrap.getAttribute( "data-parallax-scale" ) ) || 1.15;
						var dir = wrap.getAttribute( "data-parallax-direction" ) || "up";
						var offset = ( rect.top + rect.height / 2 ) - ( winH / 2 );

						if ( mode === "scroll" && img ) {
							var moveX = 0;
							var moveY = 0;
							if ( dir === "up" ) {
								moveY = -offset * speed;
							} else if ( dir === "down" ) {
								moveY = offset * speed;
							} else if ( dir === "left" ) {
								moveX = -offset * speed;
							} else if ( dir === "right" ) {
								moveX = offset * speed;
							}
							img.style.transform = "scale(" + scale + ") translate3d(" + moveX.toFixed(2) + "px, " + moveY.toFixed(2) + "px, 0)";
						} else if ( mode === "zoom" && img ) {
							var progress = 1 - Math.abs( offset ) / ( winH + rect.height );
							progress = Math.max( 0, Math.min( 1, progress ) );
							var zoom = scale + ( progress * speed * 0.4 );
							img.style.transform = "scale(" + zoom.toFixed(3) + ")";
						}
					}
				} );
				ticking = false;
			}

			function requestParallaxTick() {
				if ( ! ticking ) {
					requestAnimationFrame( updateParallax );
					ticking = true;
				}
			}

			window.addEventListener( "scroll", requestParallaxTick, { passive: true } );
			window.addEventListener( "resize", requestParallaxTick, { passive: true } );
			updateParallax();

			/* 3D Tilt Mouse Parallax */
			parallaxItems.forEach( function ( wrap ) {
				var mode = wrap.getAttribute( "data-parallax-mode" );
				if ( mode === "tilt" && ! wrap._tiltBound ) {
					wrap._tiltBound = true;
					var img = wrap.querySelector( ".wss-parallax-img" );
					var tiltMax = parseFloat( wrap.getAttribute( "data-tilt-max" ) ) || 12;
					var scale = parseFloat( wrap.getAttribute( "data-parallax-scale" ) ) || 1.1;

					wrap.addEventListener( "mousemove", function ( e ) {
						if ( window.innerWidth <= 768 && wrap.getAttribute( "data-parallax-disable-mobile" ) === "yes" ) return;
						var r = wrap.getBoundingClientRect();
						var x = ( e.clientX - r.left ) / r.width - 0.5;
						var y = ( e.clientY - r.top ) / r.height - 0.5;
						var rotX = -y * tiltMax;
						var rotY = x * tiltMax;
						if ( img ) {
							img.style.transform = "scale(" + scale + ") perspective(800px) rotateX(" + rotX.toFixed(2) + "deg) rotateY(" + rotY.toFixed(2) + "deg)";
						}
					} );

					wrap.addEventListener( "mouseleave", function () {
						if ( img ) {
							img.style.transform = "scale(" + scale + ") perspective(800px) rotateX(0deg) rotateY(0deg)";
						}
					} );
				}
			} );
		}

		initAboutParallax();

		/* ─── 10. Contact Section Motion & Parallax Engine ────── */
		function initContactParallax() {
			var contactSections = document.querySelectorAll( ".wss-contact-right.wss-has-parallax" );
			if ( ! contactSections.length ) return;

			var ticking = false;

			function updateContactParallax() {
				var isMobile = window.innerWidth <= 768;
				var winH = window.innerHeight;

				contactSections.forEach( function ( section ) {
					var mode = section.getAttribute( "data-parallax-mode" ) || "scroll";
					var disableMobile = section.getAttribute( "data-parallax-disable-mobile" ) === "yes";
					var img = section.querySelector( ".wss-contact-bg.wss-parallax-img" );

					if ( ! img ) return;

					if ( isMobile && disableMobile ) {
						img.style.transform = "none";
						return;
					}

					var rect = section.getBoundingClientRect();
					if ( rect.top < winH && rect.bottom > 0 ) {
						var speed = parseFloat( section.getAttribute( "data-parallax-speed" ) ) || 0.18;
						var scale = parseFloat( section.getAttribute( "data-parallax-scale" ) ) || 1.15;
						var dir = section.getAttribute( "data-parallax-direction" ) || "up";
						var offset = ( rect.top + rect.height / 2 ) - ( winH / 2 );

						if ( mode === "scroll" ) {
							var moveX = 0;
							var moveY = 0;
							if ( dir === "up" ) {
								moveY = -offset * speed;
							} else if ( dir === "down" ) {
								moveY = offset * speed;
							} else if ( dir === "left" ) {
								moveX = -offset * speed;
							} else if ( dir === "right" ) {
								moveX = offset * speed;
							}
							img.style.transform = "scale(" + scale + ") translate3d(" + moveX.toFixed(2) + "px, " + moveY.toFixed(2) + "px, 0)";
						} else if ( mode === "zoom" ) {
							var progress = 1 - Math.abs( offset ) / ( winH + rect.height );
							progress = Math.max( 0, Math.min( 1, progress ) );
							var zoom = scale + ( progress * speed * 0.35 );
							img.style.transform = "scale(" + zoom.toFixed(3) + ")";
						}
					}
				} );
				ticking = false;
			}

			function requestContactParallaxTick() {
				if ( ! ticking ) {
					requestAnimationFrame( updateContactParallax );
					ticking = true;
				}
			}

			window.addEventListener( "scroll", requestContactParallaxTick, { passive: true } );
			window.addEventListener( "resize", requestContactParallaxTick, { passive: true } );
			updateContactParallax();

			/* 3D Mouse Tilt */
			contactSections.forEach( function ( section ) {
				var mode = section.getAttribute( "data-parallax-mode" );
				if ( mode === "tilt" && ! section._tiltBound ) {
					section._tiltBound = true;
					var img = section.querySelector( ".wss-contact-bg.wss-parallax-img" );
					var tiltMax = parseFloat( section.getAttribute( "data-tilt-max" ) ) || 10;
					var scale = parseFloat( section.getAttribute( "data-parallax-scale" ) ) || 1.12;

					section.addEventListener( "mousemove", function ( e ) {
						if ( window.innerWidth <= 768 && section.getAttribute( "data-parallax-disable-mobile" ) === "yes" ) return;
						var r = section.getBoundingClientRect();
						var x = ( e.clientX - r.left ) / r.width - 0.5;
						var y = ( e.clientY - r.top ) / r.height - 0.5;
						var rotX = -y * tiltMax;
						var rotY = x * tiltMax;
						if ( img ) {
							img.style.transform = "scale(" + scale + ") perspective(1000px) rotateX(" + rotX.toFixed(2) + "deg) rotateY(" + rotY.toFixed(2) + "deg)";
						}
					} );

					section.addEventListener( "mouseleave", function () {
						if ( img ) {
							img.style.transform = "scale(" + scale + ") perspective(1000px) rotateX(0deg) rotateY(0deg)";
						}
					} );
				}
			} );

			/* 3D Card Float */
			var tiltCards = document.querySelectorAll( ".wss-floating-card.wss-card-tilt" );
			tiltCards.forEach( function ( card ) {
				if ( card._cardTiltBound ) return;
				card._cardTiltBound = true;
				var parentSection = card.closest( ".wss-contact-right" );
				if ( ! parentSection ) return;

				parentSection.addEventListener( "mousemove", function ( e ) {
					if ( window.innerWidth <= 768 ) return;
					var r = parentSection.getBoundingClientRect();
					var x = ( e.clientX - r.left ) / r.width - 0.5;
					var y = ( e.clientY - r.top ) / r.height - 0.5;
					card.style.transform = "perspective(1200px) rotateX(" + (-y * 4).toFixed(2) + "deg) rotateY(" + (x * 4).toFixed(2) + "deg) translateZ(8px)";
				} );

				parentSection.addEventListener( "mouseleave", function () {
					card.style.transform = "perspective(1200px) rotateX(0deg) rotateY(0deg) translateZ(0px)";
				} );
			} );
		}

		initContactParallax();

		/* ─── 10. Luxury Scroll Indicator Engine ─────────────────── */
		function initScrollIndicators() {
			var indicators = document.querySelectorAll( "[data-wss-scroll-indicator]" );
			if ( ! indicators.length ) return;

			function updateScrollIndicators() {
				var scrollY = window.pageYOffset || document.documentElement.scrollTop;
				var docHeight = document.documentElement.scrollHeight - window.innerHeight;
				var progress = docHeight > 0 ? Math.min( Math.max( scrollY / docHeight, 0 ), 1 ) : 0;
				var percentInt = Math.round( progress * 100 );

				indicators.forEach( function ( wrap ) {
					// 1. Auto-hide check
					if ( wrap.getAttribute( "data-autohide" ) === "yes" ) {
						var thresh = parseInt( wrap.getAttribute( "data-autohide-thresh" ), 10 ) || 120;
						if ( scrollY > thresh ) {
							wrap.classList.add( "wss-is-hidden" );
						} else {
							wrap.classList.remove( "wss-is-hidden" );
						}
					}

					// 2. Reveal after scroll check (Back to top)
					if ( wrap.getAttribute( "data-reveal" ) === "yes" ) {
						var revThresh = parseInt( wrap.getAttribute( "data-reveal-thresh" ), 10 ) || 400;
						if ( scrollY > revThresh ) {
							wrap.classList.remove( "wss-is-hidden" );
						} else {
							wrap.classList.add( "wss-is-hidden" );
						}
					}

					// 3. Progress preset updates
					var progressBar = wrap.querySelector( ".wss-scroll-progress-bar" );
					if ( progressBar ) {
						var totalDash = 276.46; // 2 * PI * 44
						var offset = totalDash * ( 1 - progress );
						progressBar.style.strokeDashoffset = offset;
					}

					var progressVal = wrap.querySelector( ".wss-scroll-progress-val" );
					if ( progressVal ) {
						progressVal.textContent = percentInt + "%";
					}

					var linearFill = wrap.querySelector( ".wss-scroll-progress-linear-fill" );
					if ( linearFill ) {
						linearFill.style.width = percentInt + "%";
					}
				} );
			}

			// Scroll event listener (throttled with requestAnimationFrame)
			var ticking = false;
			window.addEventListener( "scroll", function () {
				if ( ! ticking ) {
					window.requestAnimationFrame( function () {
						updateScrollIndicators();
						ticking = false;
					} );
					ticking = true;
				}
			}, { passive: true } );

			// Click handler
			indicators.forEach( function ( wrap ) {
				if ( wrap._scrollBound ) return;
				wrap._scrollBound = true;

				var btn = wrap.querySelector( ".wss-scroll-indicator" );
				if ( ! btn ) return;

				btn.addEventListener( "click", function ( e ) {
					var action = wrap.getAttribute( "data-action" );
					if ( action === "none" || action === "link" ) return;

					e.preventDefault();
					var offsetY = parseInt( wrap.getAttribute( "data-offset-y" ), 10 ) || 0;

					if ( action === "back_to_top" ) {
						window.scrollTo( { top: 0, behavior: "smooth" } );
					} else if ( action === "scroll_100vh" ) {
						window.scrollBy( { top: window.innerHeight, behavior: "smooth" } );
					} else if ( action === "scroll_amount" ) {
						var px = parseInt( wrap.getAttribute( "data-scroll-px" ), 10 ) || 750;
						window.scrollBy( { top: px, behavior: "smooth" } );
					} else if ( action === "target_id" ) {
						var targetSel = wrap.getAttribute( "data-target-id" );
						if ( targetSel ) {
							var targetEl = document.querySelector( targetSel );
							if ( targetEl ) {
								var rect = targetEl.getBoundingClientRect();
								var absTop = rect.top + window.pageYOffset + offsetY;
								window.scrollTo( { top: absTop, behavior: "smooth" } );
							}
						}
					} else if ( action === "next_section" ) {
						// Look for parent section / container
						var parentSection = wrap.closest( "section, .elementor-section, .elementor-element-section, .e-con, .e-container, header, .wss-scope" );
						var nextEl = null;
						if ( parentSection ) {
							nextEl = parentSection.nextElementSibling;
							while ( nextEl && ( nextEl.tagName === "SCRIPT" || nextEl.tagName === "STYLE" || nextEl.offsetHeight === 0 ) ) {
								nextEl = nextEl.nextElementSibling;
							}
						}

						if ( nextEl ) {
							var rect = nextEl.getBoundingClientRect();
							var absTop = rect.top + window.pageYOffset + offsetY;
							window.scrollTo( { top: absTop, behavior: "smooth" } );
						} else {
							// Fallback: scroll down 1 screen
							window.scrollBy( { top: window.innerHeight * 0.85, behavior: "smooth" } );
						}
					}
				} );
			} );

			updateScrollIndicators();
		}

		/* ─── 8. Team Slider & Interactive Engine ─────────── */
		function initTeamWidgets() {
			var sliders = document.querySelectorAll( ".wss-team-slider-wrap" );
			sliders.forEach( function ( wrap ) {
				var container = wrap.querySelector( ".wss-team-track-container" );
				var track     = wrap.querySelector( ".wss-team-track" );
				var dotsWrap  = wrap.querySelector( ".wss-team-dots" );
				if ( ! container || ! track ) return;

				var cards = track.querySelectorAll( ".wss-team-card" );
				if ( ! cards.length ) return;

				// Bind dot clicks
				if ( dotsWrap ) {
					var existingDots = dotsWrap.querySelectorAll( ".wss-team-dot" );
					if ( existingDots.length ) {
						existingDots.forEach( function ( dot, i ) {
							dot.addEventListener( "click", function () {
								var gap = parseFloat( window.getComputedStyle( track ).gap ) || 32;
								var scrollTarget = i * ( cards[0] ? ( cards[0].offsetWidth + gap ) : 300 );
								container.scrollTo( { left: scrollTarget, behavior: "smooth" } );
							} );
						} );
					} else {
						dotsWrap.innerHTML = "";
						cards.forEach( function ( card, i ) {
							var dot = document.createElement( "button" );
							dot.type = "button";
							dot.className = "wss-team-dot" + ( i === 0 ? " wss-team-dot-active" : "" );
							dot.setAttribute( "aria-label", "Go to advisor slide " + ( i + 1 ) );
							dot.addEventListener( "click", function () {
								var gap = parseFloat( window.getComputedStyle( track ).gap ) || 32;
								var scrollTarget = i * ( card.offsetWidth + gap );
								container.scrollTo( { left: scrollTarget, behavior: "smooth" } );
							} );
							dotsWrap.appendChild( dot );
						} );
					}

					// Update active dot on scroll
					var scrollTimeout;
					container.addEventListener( "scroll", function () {
						clearTimeout( scrollTimeout );
						scrollTimeout = setTimeout( function () {
							var card = cards[0];
							var gap = parseFloat( window.getComputedStyle( track ).gap ) || 32;
							var cardWidth = card ? ( card.offsetWidth + gap ) : 1;
							var activeIndex = Math.round( container.scrollLeft / cardWidth );
							var dots = dotsWrap.querySelectorAll( ".wss-team-dot" );
							dots.forEach( function ( d, idx ) {
								if ( idx === activeIndex ) {
									d.classList.add( "wss-team-dot-active" );
								} else {
									d.classList.remove( "wss-team-dot-active" );
								}
							} );
						}, 50 );
					}, { passive: true } );
				}

				// Autoplay
				var isAutoplay = wrap.getAttribute( "data-autoplay" ) === "true";
				var speed      = parseInt( wrap.getAttribute( "data-speed" ), 10 ) || 4500;
				var loop       = wrap.getAttribute( "data-loop" ) === "true";
				var autoplayTimer = null;

				function startAutoplay() {
					if ( ! isAutoplay || autoplayTimer ) return;
					autoplayTimer = setInterval( function () {
						var card = cards[0];
						var gap = parseFloat( window.getComputedStyle( track ).gap ) || 32;
						var cardWidth = card ? ( card.offsetWidth + gap ) : 300;
						var maxScroll = container.scrollWidth - container.clientWidth;
						if ( container.scrollLeft >= maxScroll - 10 ) {
							if ( loop ) {
								container.scrollTo( { left: 0, behavior: "smooth" } );
							}
						} else {
							container.scrollBy( { left: cardWidth, behavior: "smooth" } );
						}
					}, speed );
				}

				function stopAutoplay() {
					if ( autoplayTimer ) {
						clearInterval( autoplayTimer );
						autoplayTimer = null;
					}
				}

				if ( isAutoplay ) {
					startAutoplay();
					wrap.addEventListener( "mouseenter", stopAutoplay );
					wrap.addEventListener( "mouseleave", startAutoplay );
					wrap.addEventListener( "touchstart", stopAutoplay, { passive: true } );
					wrap.addEventListener( "touchend", startAutoplay, { passive: true } );
				}
			} );
		}

		initTeamWidgets();

		/* Elementor editor live preview re-init */
		function bindElementorHooks() {
			if ( window.elementorFrontend && window.elementorFrontend.hooks ) {
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_about.default", function () {
					initAboutParallax();
				} );
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_newsletter.default", function () {
					initNewsletterParallax();
				} );
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_contact.default", function () {
					initContactParallax();
				} );
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_scroll_indicator.default", function () {
					initScrollIndicators();
				} );
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_header.default", function () {
					initHeaderSticky();
				} );
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_team.default", function ( $scope ) {
					initTeamWidgets();
					if ( $scope && $scope[0] ) {
						initScrollReveal( $scope[0] );
					}
				} );
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_buyer_hero.default", function ( $scope ) {
					if ( $scope && $scope[0] ) {
						initScrollReveal( $scope[0] );
					}
				} );
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_buyer_roadmap.default", function ( $scope ) {
					if ( $scope && $scope[0] ) {
						initScrollReveal( $scope[0] );
					}
				} );
				window.elementorFrontend.hooks.addAction( "frontend/element_ready/wss_buyer_guide.default", function ( $scope ) {
					if ( $scope && $scope[0] ) {
						initScrollReveal( $scope[0] );
					}
				} );
			}
		}

		if ( window.elementorFrontend && window.elementorFrontend.hooks ) {
			bindElementorHooks();
		} else {
			window.addEventListener( "elementor/frontend/init", bindElementorHooks );
		}

	} ); // end ready
} )();


