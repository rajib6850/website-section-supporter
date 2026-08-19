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
	} );

	document.addEventListener( "keydown", function ( e ) {
		if ( e.key === "Escape" && document.body.classList.contains( "wss-menu-open" ) ) {
			document.body.classList.remove( "wss-menu-open" );
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

		/* ─── 5. Scroll-reveal via IntersectionObserver ─────── */
		var isEditor = document.body.classList.contains( "elementor-editor-active" ) || document.querySelector( ".elementor-editor-active" );
		if ( isEditor ) {
			document.querySelectorAll( ".wss-reveal, .wss-img-reveal" ).forEach( function ( el ) {
				el.classList.add( "wss-is-visible" );
			} );
		} else if ( "IntersectionObserver" in window ) {
			var io = new IntersectionObserver( function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( "wss-is-visible" );
						io.unobserve( entry.target );
					}
				} );
			}, { threshold: 0.15 } );

			document.querySelectorAll( ".wss-reveal, .wss-img-reveal" ).forEach( function ( el ) {
				io.observe( el );
			} );
		} else {
			/* Fallback for old browsers — just show everything */
			document.querySelectorAll( ".wss-reveal, .wss-img-reveal" ).forEach( function ( el ) {
				el.classList.add( "wss-is-visible" );
			} );
		}

		/* ─── 6. Header: solid / hide on scroll ─────────────── */
		var siteHeader = document.querySelector( ".wss-header--sticky" );
		if ( siteHeader ) {
			var lastY    = window.scrollY;
			var heroEl   = document.querySelector( ".wss-hero" );
			var heroH    = heroEl ? heroEl.offsetHeight : 400;
			var isTrans  = siteHeader.classList.contains( "wss-header--on-hero" );

			window.addEventListener( "scroll", function () {
				var y = window.scrollY;
				siteHeader.classList.toggle( "wss-header--solid",  y > heroH - 100 );
				if ( isTrans ) {
					siteHeader.classList.toggle( "wss-header--on-hero", y <= heroH - 100 );
				}
				if ( y > lastY && y > 300 ) {
					siteHeader.classList.add( "wss-header--hidden" );
				} else {
					siteHeader.classList.remove( "wss-header--hidden" );
				}
				lastY = y;
			} );
		}

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

		initScrollIndicators();

		/* Elementor editor live preview re-init */
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
		}

	} ); // end ready
} )();


