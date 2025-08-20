class Envira_Link {
	constructor(data, images, lightbox) {
		var self = this;

		// Setup our Vars
		self.data = data;
		self.images = images;
		self.id = this.get_config('gallery_id');
		self.envirabox_config = lightbox;

		// Log if ENVIRA_DEBUG enabled
		self.log(self.data);
		self.log(self.images);
		self.log(self.envirabox_config);
		self.log(self.id);

		self.init();
	}

	init() {
		var self = this;

		self.lightbox();
	}

	/**
	 * Outputs the gallery init script in the footer.
	 *
	 * @since 1.7.1
	 */
	lightbox() {
		var self = this,
			touch_general = self.get_config('mobile_touchwipe_close')
				? { vertical: true, momentum: true }
				: { vertical: false, momentum: false },
			thumbs_hide_on_open = self.get_config('thumbnails_hide')
				? self.get_config('thumbnails_hide')
				: true,
			thumbs_rowHeight = self.is_mobile()
				? this.get_config('mobile_thumbnails_height')
				: this.get_config('thumbnails_height'),
			thumbs = self.get_config('thumbnails')
				? {
						autoStart: thumbs_hide_on_open,
						hideOnClose: true,
						position: self.get_lightbox_config('thumbs_position'),
						rowHeight:
							'side' ===
							self.get_lightbox_config('thumbs_position')
								? false
								: thumbs_rowHeight,
				  }
				: false,
			slideshow = self.get_config('slideshow')
				? {
						autoStart: self.get_config('autoplay'),
						speed: self.get_config('ss_speed'),
				  }
				: false,
			fullscreen =
				self.get_config('fullscreen') &&
				self.get_config('open_fullscreen')
					? { autoStart: true }
					: true,
			animationEffect =
				self.get_config('lightbox_open_close_effect') == 'zomm-in-out'
					? 'zoom-in-out'
					: self.get_config('lightbox_open_close_effect'),
			transitionEffect =
				self.get_config('effect') == 'zomm-in-out'
					? 'zoom'
					: self.get_config('effect'),
			lightbox_images = [],
			overlay_divs = '',
			no_cap_title_show_lightbox_themes = [
				'classical_dark',
				'classical_light',
				'infinity_dark',
				'infinity_light',
			];

		self.lightbox_options = {
			selector: '[data-envirabox="' + self.id + '"]',
			loop: self.get_config('loop'), // Enable infinite gallery navigation
			margin: self.get_lightbox_config('margins'), // Space around image, ignored if zoomed-in or viewport width is smaller than 800px
			gutter: self.get_lightbox_config('gutter'), // Horizontal space between slides
			keyboard: self.get_config('keyboard'), // Enable keyboard navigation
			arrows: self.get_lightbox_config('arrows'), // Should display navigation arrows at the screen edges
			arrow_position: self.get_lightbox_config('arrow_position'),
			infobar: self.get_lightbox_config('infobar'), // Should display infobar (counter and arrows at the top)
			toolbar: self.get_lightbox_config('toolbar'), // Should display toolbar (buttons at the top)
			idleTime: self.get_lightbox_config('idle_time')
				? self.get_lightbox_config('idle_time')
				: false, // by default there shouldn't be any, otherwise value is in seconds
			smallBtn: self.get_lightbox_config('show_smallbtn'),
			protect: false, // Disable right-click and use simple image protection for images
			image: { preload: false },
			animationEffect: animationEffect,
			animationDuration: self.get_lightbox_config('animation_duration')
				? self.get_lightbox_config('animation_duration')
				: 300, // Duration in ms for open/close animation
			btnTpl: {
				smallBtn: self.get_lightbox_config('small_btn_template'),
			},
			zoomOpacity: 'auto',
			transitionEffect: transitionEffect, // Transition effect between slides
			transitionDuration: self.get_lightbox_config('transition_duration')
				? self.get_lightbox_config('transition_duration')
				: 200, // Duration in ms for transition animation
			baseTpl: self.get_lightbox_config('base_template'), // Base template for layout
			spinnerTpl: '<div class="envirabox-loading"></div>', // Loading indicator template
			errorTpl: self.get_lightbox_config('error_template'), // Error message template
			fullScreen: self.get_config('fullscreen') ? fullscreen : false,
			touch: touch_general, // Set `touch: false` to disable dragging/swiping
			hash: false,
			insideCap: self.get_lightbox_config('inner_caption'),
			capPosition: self.get_lightbox_config('caption_position'),
			capTitleShow:
				self.get_config('lightbox_title_caption') &&
				self.get_config('lightbox_title_caption') != 'none' &&
				self.get_config('lightbox_title_caption') != '0' &&
				false ===
					no_cap_title_show_lightbox_themes.includes(
						self.get_config('lightbox_theme'),
					)
					? self.get_config('lightbox_title_caption')
					: false,
			media: {
				youtube: {
					params: {
						autoplay: 0,
					},
				},
			},
			wheel: this.get_config('mousewheel') == false ? false : true,
			slideShow: slideshow,
			thumbs: thumbs,
			lightbox_theme: self.get_config('lightbox_theme'),
			mobile: {
				clickContent: function (current, event) {
					return self.get_lightbox_config('click_content')
						? self.get_lightbox_config('click_content')
						: 'toggleControls';
				},
				clickSlide: function (current, event) {
					return self.get_lightbox_config('click_slide')
						? self.get_lightbox_config('click_slide')
						: 'close'; // clicked on the slide
				},
				dblclickContent: false,
				dblclickSlide: false,
			},
			// Clicked on the content
			clickContent: function (current, event) {
				return current.type === 'image' &&
					(self.get_config('disable_zoom') === 'undefined' ||
						self.get_config('disable_zoom') != '1') &&
					(self.get_config('zoom_hover') != '1' ||
						typeof envira_zoom === 'undefined' ||
						typeof envira_zoom.enviraZoomActive === 'undefined')
					? 'zoom'
					: false;
			}, // clicked on the image itself
			clickSlide: self.get_lightbox_config('click_slide')
				? self.get_lightbox_config('click_slide')
				: 'close', // clicked on the slide
			clickOutside: self.get_lightbox_config('click_outside')
				? self.get_lightbox_config('click_outside')
				: 'toggleControls', // clicked on the background (backdrop) element

			// Same as previous two, but for double click
			dblclickContent: false,
			dblclickSlide: false,
			dblclickOutside: false,

			// Video settings
			videoPlayPause: self.get_config('videos_playpause') ? true : false,
			videoProgressBar: self.get_config('videos_progress') ? true : false,
			videoPlaybackTime: self.get_config('videos_current') ? true : false,
			videoVideoLength: self.get_config('videos_duration') ? true : false,
			videoVolumeControls: self.get_config('videos_volume')
				? true
				: false,
			videoControlBar: self.get_config('videos_controls') ? true : false,
			videoFullscreen: self.get_config('videos_fullscreen')
				? true
				: false,
			videoDownload: self.get_config('videos_download') ? true : false,
			videoPlayIcon: self.get_config('videos_play_icon_thumbnails')
				? true
				: false,
			videoAutoPlay: self.get_config('videos_autoplay') ? true : false,

			// Callbacks
			//==========
			onInit: function (instance, current) {
				self.initImage = true;

				$(document).trigger('envirabox_api_on_init', [
					self,
					instance,
					current,
				]);
			},

			beforeLoad: function (instance, current) {
				$(document).trigger('envirabox_api_before_load', [
					self,
					instance,
					current,
				]);
			},

			afterLoad: function (instance, current) {
				$(document).trigger('envirabox_api_after_load', [
					self,
					instance,
					current,
				]);
			},

			beforeShow: function (instance, current) {
				if (
					self.data.lightbox_theme == 'base' &&
					overlay_divs == '' &&
					$('.envirabox-position-overlay').length > 0
				) {
					overlay_divs = $('.envirabox-position-overlay');
				}

				self.initImage = false;

				if (self.get_config('loop') === 0 && instance.currIndex == 0) {
					// hide the back navigation arrow
					$('.envirabox-slide--current a.envirabox-prev').hide();
				} else {
					$('.envirabox-slide--current a.envirabox-prev').show();
				}

				if (
					self.get_config('loop') === 0 &&
					instance.currIndex == Object.keys(instance.group).length - 1
				) {
					// hide the next navigation arrow
					$('.envirabox-slide--current a.envirabox-next').hide();
				} else {
					$('.envirabox-slide--current a.envirabox-next').show();
				}

				$(document).trigger('envirabox_api_before_show', [
					self,
					instance,
					current,
				]);
			},

			afterShow: function (instance, current) {
				/* this changes the classes for a visible box */

				$('.envirabox-thumbs ul').find('li').removeClass('focused');
				$('.envirabox-thumbs ul')
					.find('li.envirabox-thumbs-active')
					.focus()
					.addClass('focused');

				if (prepend == undefined || prepend_cap == undefined) {
					var prepend = false,
						prepend_cap = false;
				}

				if (prepend != true) {
					$('.envirabox-position-overlay').each(function () {
						$(this).prependTo(current.$content);
					});

					prepend = true;
				}

				if (self.get_config('loop') === 0 && instance.currIndex == 0) {
					// hide the back navigation arrow
					$('.envirabox-outer a.envirabox-prev').hide();
				} else {
					$('.envirabox-outer a.envirabox-prev').show();
				}

				if (
					self.get_config('loop') === 0 &&
					instance.currIndex == Object.keys(instance.group).length - 1
				) {
					// hide the next navigation arrow
					$('.envirabox-outer a.envirabox-next').hide();
				} else {
					$('.envirabox-outer a.envirabox-next').show();
				}

				/* support older galleries or if someone overrides the keyboard configuration via a filter, etc. */

				if (
					self.get_config('keyboard') !== undefined &&
					self.get_config('keyboard') === 0
				) {
					$(window).keypress(function (event) {
						if ([32, 37, 38, 39, 40].indexOf(event.keyCode) > -1) {
							event.preventDefault();
						}
					});
				}

				/* legacy theme we hide certain elements initially to prevent user seeing them for a second in the upper left until the CSS fully loads */

				$('.envirabox-slide--current .envirabox-title').css(
					'visibility',
					'visible',
				);
				if (
					$('.envirabox-slide--current .envirabox-caption').length >
						0 &&
					$('.envirabox-slide--current .envirabox-caption').html()
						.length > 0
				) {
					$('.envirabox-slide--current .envirabox-caption').css(
						'visibility',
						'visible',
					);
					$('.envirabox-slide--current .envirabox-caption-wrap').css(
						'visibility',
						'visible',
					);
				} else {
					$('.envirabox-slide--current .envirabox-caption').css(
						'visibility',
						'hidden',
					);
					$('.envirabox-slide--current .envirabox-caption-wrap').css(
						'visibility',
						'hidden',
					);
				}

				$('.envirabox-navigation').show();
				$('.envirabox-navigation-inside').show();

				/* if there's overlay divs to show, show them (applies again only to legacy) */

				if (
					overlay_divs !== undefined &&
					overlay_divs != '' &&
					$('.envirabox-slide--current .envirabox-image-wrap')
						.length > 0
				) {
					$('.envirabox-image-wrap').prepend(overlay_divs);
				} else if (
					overlay_divs !== undefined &&
					overlay_divs != '' &&
					$('.envirabox-slide--current .envirabox-content').length > 0
				) {
					$('.envirabox-content').prepend(overlay_divs);
				}

				$(document).trigger('envirabox_api_after_show', [
					self,
					instance,
					current,
				]);

				/* double check caption */

				if (
					instance.opts.capTitleShow !== undefined &&
					(instance.opts.capTitleShow == 'caption' ||
						instance.opts.capTitleShow == 'title_caption') &&
					current.caption == ''
				) {
					$('.envirabox-caption-wrap .envirabox-caption').css(
						'visibility',
						'hidden',
					);
				} else {
					$('.envirabox-caption-wrap .envirabox-caption').css(
						'visibility',
						'visible',
					);
				}
			},

			beforeClose: function (instance, current) {
				$(document).trigger('envirabox_api_before_close', [
					self,
					instance,
					current,
				]);
			},
			afterClose: function (instance, current) {
				$(document).trigger('envirabox_api_after_close', [
					self,
					instance,
					current,
				]);
			},

			onActivate: function (instance, current) {
				$(document).trigger('envirabox_api_on_activate', [
					self,
					instance,
					current,
				]);
			},
			onDeactivate: function (instance, current) {
				$(document).trigger('envirabox_api_on_deactivate', [
					self,
					instance,
					current,
				]);
			},
		};
		// Mobile Overrides
		if (self.is_mobile()) {
			if (self.get_config('mobile_thumbnails') !== 1) {
				self.lightbox_options.thumbs = false;
			}
		}
		// Load from json object if load all images is ture
		if (self.get_lightbox_config('load_all')) {
			var the_images = self.images;

			if (typeof the_images !== 'object') {
				// this will cause a JS error
				return;
			}

			$.each(the_images, function (i) {
				if (
					this.video !== undefined &&
					this.video.embed_url !== undefined
				) {
					// if this is a video, then the lightbox needs the embed url and not an image
					this.src = this.video.embed_url;
				}
				lightbox_images.push(this);
			});
		} else {
			var newIndex = 0;
			let $images = $('.envira-gallery-' + self.id);
			$.each($images, function (i) {
				lightbox_images.push(this);
			});
		}

		$(document).trigger('envirabox_options', self);

		$('#envira-links-' + self.id ).on('click', function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			var $this = $(this),
				images = [],
				$envira_images = $this.data('gallery-images'),
				sorted_ids = $this.data('gallery-sort-ids'), // sort by sort ids, not by output of gallery-images, because retaining object key order between unserialisation and serialisation in JavaScript is never guaranteed.
				sorting_factor =
					sorted_ids !== undefined &&
					self.data.gallery_sort == 'gallery'
						? 'id'
						: 'image',
				sorting_factor_data =
					sorted_ids !== undefined &&
					self.data.gallery_sort == 'gallery'
						? sorted_ids
						: $envira_images,
				active = $.envirabox.getInstance();

			// backup plan in case there isn't sorted_ids, we keep the lightbox_images even though this is probably not sorted
			if (sorted_ids !== undefined && sorted_ids != '') {
				lightbox_images = [];

				$.each(sorted_ids, function(i, val) {
					lightbox_images.push(sorting_factor_data[val]);
				});
			}

			if (active) {
				return;
			}

			$.envirabox.open(lightbox_images, self.lightbox_options);
		});
	}

	/**
	 * Get a config option based off of a key.
	 *
	 * @since 1.7.1
	 */
	get_config(key) {
		return this.data[key];
	}

	/**
	 * Helper method to get config by key.
	 *
	 * @since 1.7.1
	 */
	get_lightbox_config(key) {
		var self = this;

		return self.envirabox_config[key];
	}

	/**
	 * Helper method to get image from id
	 *
	 * @since 1.7.1
	 */
	get_image(id) {
		var self = this;

		return self.images[id];
	}
	is_mobile() {
		if (
			/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
				navigator.userAgent,
			)
		) {
			return true;
		}
		return false;
	}
	/**
	 * Helper method for logging if ENVIRA_DEBUG is true.
	 *
	 * @since 1.7.1
	 */
	log(log) {
		// Bail if debug or log is not set.
		if (
			envira_gallery.debug == undefined ||
			!envira_gallery.debug ||
			log == undefined
		) {
			return;
		}
		console.log(log);
	}
}

module.exports = Envira_Link;
