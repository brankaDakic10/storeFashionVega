(function ($) {
var $overlay = $('.page-overlay');
var winWid = $(window).width();
	$(function() {
		helper.toggleSubnav();
		helper.toggleLoginSubnav();
		helper.toggleBasketSubnav();
		helper.closeSubnav();
		helper.searchToggle();
		helper.navSubmenuHover();
		helper.languageDropdown();
		helper.subscribeBlock();
		helper.tabs();
		helper.colorSelection();
		helper.productSize();
		helper.filtersToggle();
		helper.fixedFiltersToggle();
		helper.filtersSelection();
		helper.resetFilters();
		helper.filtersPosition();
		helper.subrowToggle();
		helper.stickyProducts();
		helper.googleMaps();
		helper.productImageZoom();
		helper.gridToggle();
		helper.breadcrumbsToggle();
		helper.productColorSlider();
		helper.productSizeSlider();
		helper.discountToggle();
		helper.thumbPDP();
		helper.tooltipForm();
		helper.customLanguageDropdown();
	});

	$(window).on('load', function() {

	});

	$(window).resize(function() {

	});

	$(window).on('scroll', function() {
		helper.filtersPosition();
		helper.stickyProducts();
	});

var helper = (function () {
	return {

		// hamburger toggle subnav
		toggleSubnav: function () {
			$('.header .js-subnav-toggle').on('click', function () {
				$(this).toggleClass('opened');
				$('.header').toggleClass('nav-opened');
				if(winWid <= 1024) {
					$('.header .mobile-nav').stop().slideToggle(200);
				} else {
					$('.header .subnav').stop().slideToggle(200);
				}
			});
		},

		// header login toggle
		toggleLoginSubnav: function () {
			$('.header .js-login-subnav-toggle').on('click', function () {
				if(winWid <= 767) {
					$(this).removeClass('opened');
					$('.header .login-subnav').stop().slideDown(200);
				} else {
					$(this).toggleClass('opened');
					$('.header .login-subnav').stop().slideToggle(200);
				}
			});
		},

		// header login toggle
		toggleBasketSubnav: function () {
			$('.header .js-basket-subnav-toggle').on('click', function () {
				if(winWid <= 767) {
					$(this).removeClass('opened');
					$('.header .basket-subnav').stop().slideDown(200);
				} else {
					$(this).toggleClass('opened');
					$('.header .basket-subnav').stop().slideToggle(200);
				}
			});
		},

		// close header subnav panels
		closeSubnav: function () {
			$('.header .js-close-subnav').on('click', function () {
				$(this).parent().stop().slideUp(200);
			});
		},

		// header search toggle
		searchToggle: function () {
			$('.header .js-search-toggle').on('click', function () {
				$(this).toggleClass('active');
				$('.header .header-search').stop().slideToggle(300);
				$overlay.stop().fadeToggle(300);
			});
		},

		// main menu links hover shows dropdown
		navSubmenuHover: function () {
			var timeout;
			var $link = $('.main-nav > li');

			if(!$('.container').hasClass('products-page')) {
				$link.hover(function () {
					if($(this).find('.nav-submenu').length) {
						clearTimeout(timeout);
						$(this).find('.nav-submenu').stop().slideDown(300);
						$overlay.stop().fadeIn(300);
					}
				}, function () {
					var $self = $(this);
					if($(this).find('.nav-submenu').length) {
						timeout = setTimeout(function () {
							$self.find('.nav-submenu').stop().slideUp(200);
							$overlay.stop().fadeOut(200);
						}, 400);
					}
				});
			} else {
				$('.nav-submenu').addClass('active');
			}
		},

		// language and currency dropdown
		languageDropdown: function () {
			$('.header .js-cl-toggle').on('click', function () {
				$(this).toggleClass('opened');
				$('.header .cl-dropdown').stop().slideToggle(200);
			});
		},

		// subscribe block
		subscribeBlock: function() {
			setTimeout(function(){
				$('.subscribe-block').fadeIn();
			}, 5000);
			$('.subscribe-block .js-subscribe-close').on('click', function () {
				$('.subscribe-block').fadeOut();
			});
		},

		// tabs
		tabs: function () {
			$('.tabs').find('.tab-head').on('click', function() {
				var _tabbed = $(this).parents('.tabbed');
				var _index = $(this).parent().index();
				_tabbed.find('.tab-content .tab').removeClass('active');
				_tabbed.find('.tabs li').removeClass('active');
				$(this).parent().addClass('active');
				_tabbed.find('.tab-content .tab').eq(_index).addClass('active');
			});
		},

		// pdp color selection
		colorSelection: function () {
			var productColors = $('.product-colors');
			productColors.find('li a').on('click', function() {
				if(!$(this).parent().hasClass('disabled')) {
					var colorName = $(this).data('color');
					productColors.find('.selected-color .color-name').text(colorName);
					productColors.find('li.selected').removeClass('selected');
					$(this).parent().addClass('selected');
				}
			});
		},

		// pdp size selection
		productSize: function () {
			$('.product-sizes li a').on('click', function(e) {
				var item = $(this).parent();
				var items = item.siblings();
				var description = $(this).data('description');
				$('.size-description').text(description);
// 				data-description
				items.removeClass('selected');
				item.addClass('selected');
				e.preventDefault();
			});
		},

		// filters
		filtersToggle: function () {
			$('.js-product-filters .filter-toggle').on('click', function() {
				var $filter = $(this).parent();
				if(!$filter.hasClass('opened')) {
					$filter.siblings('.opened').removeClass('opened').find('.filter-body').stop().slideUp(300);
					$filter.addClass('opened');
					$filter.find('.filter-body').stop().slideDown(400);
				} else {
					$filter.removeClass('opened');
					$filter.find('.filter-body').stop().slideUp(300);
				}
			});

			// mobile filter, maybe move to a separate function
			$('.js-mobile-filter-toggle').on('click', function() {
				var content = $('.js-product-filters');

				content.addClass('mobile-filters').stop().slideToggle();
			});

			$('.js-close-filter').on('click', function() {
				$(this).parent('.js-product-filters').stop().slideToggle();
			});

			$('.mobile-filter-items .filter-toggle').on('click', function() {
				var $this = $(this);

				$this.next('.filter-body').slideToggle();
			});

		},
		fixedFiltersToggle: function () {
			$('.header .js-toggle-filters').on('click', function () {
				$(this).toggleClass('opened');
				$('.product-filters').stop().slideToggle(300);
			});
		},
		filtersSelection: function () {
			$('.filter-option').on('click', function() {
				var $filter = $(this).parent();
				$filter.toggleClass('selected');
			});
		},
		resetFilters: function () {
			$('.js-reset-filters').on('click', function() {
				$(this).parent().find('.selected').removeClass('selected');
			});
		},
		filtersPosition: function () {
			var $filtersWrap = $('.product-filters-wrap');
			if($(window).width() > 767) {
				if($filtersWrap.length) {
					var $filters = $('.product-filters');
					var initialFiltersPosition = $filtersWrap.offset().top;
					if($(window).scrollTop() > initialFiltersPosition) {
						$filters.addClass('fixed-filters');
						$('.header').addClass('hidden-menu');
						$('.js-toggle-filters').fadeIn();
					} else {
						$filters.removeClass('fixed-filters').removeAttr('style');
						$('.header').removeClass('hidden-menu');
						$('.js-toggle-filters').fadeOut();
					}
				}
			}
		},

		// product sticky header
		stickyProducts: function () {
			var $stickyProducts = $('.product-sticky-header');
			if($stickyProducts.length) {
				var productButtonPos = $('.product-page .product-basket, .product-page-shop .product-basket').offset().top;
				if($(window).scrollTop() > productButtonPos) {
					$stickyProducts.addClass('visible-sticky-product');
					$('.header').addClass('hidden-menu');
				} else {
					$stickyProducts.removeClass('visible-sticky-product');
					$('.header').removeClass('hidden-menu');
				}
			}
		},

		// product image zoom
		productImageZoom: function () {
			//PDP opening full size image
			$(document).on('click', '.js-open-zoom', function(e){
				var imgIndex = $(this).data('product-imgzoom');
				$('.full-size-image').addClass('zoomed').fadeIn(400, function(){
					if(!$('.full-size-image .slider-wrap').hasClass('slick-initialized')) {
						helper.fullSizeProductSlider();
					}
					setTimeout(function(){
						$('.full-size-image .slider-wrap').slick('slickGoTo', imgIndex - 1);
						if(winWid <= 1024) {
							helper.productImageMobileZoom();
						}
					}, 100);
				});
				$('body, html').addClass('no-scroll');
				e.preventDefault();
			});

			//PDP full size image zoom functionality
			if(winWid >= 1025) {
				$(document).on('mousemove', '.full-size-image .image-wrap', function (event) {
					var $img = $(this).find('img');
					var $container = $(this);
					var boxHeight = $container.height();
					var imgHeight = $img.height();
					var yPos = (imgHeight - boxHeight) / (boxHeight / (event.pageY - $(window).scrollTop()));

					$img.css('top', -yPos);
				});
			} else {
				$('.full-size-image .slider-wrap').on('afterChange', function(){
					helper.productImageMobileZoom();
				});
			}

			$(document).on('click', '.full-size-image .js-close-zoom', function(){
				$('.full-size-image').fadeOut(400).removeClass('zoomed');
				$('body, html').removeClass('no-scroll');
			});
		},

		// full size product slider
		fullSizeProductSlider: function () {
			if($('.full-size-image .slider-wrap').length){
				setTimeout(function() {
					$('.full-size-image .slider-wrap').slick({
						lazyLoad: 'ondemand',
						arrows: true,
						dots: false,
						prevArrow: '<span class="slick-prev"><i class="icon font-ico-slide-prev"></i></span>',
						nextArrow: '<span class="slick-next"><i class="icon font-ico-slide-next"></i></span>',
						infinite: true,
						speed: 500,
						fade: true,
						pauseOnHover: false,
						adaptiveHeight: false,
						slidesToShow: 1,
						slidesToScroll: 1,
						swipe: false
					});
				}, 50);
			}
		},

		// product image zoom for mobile
		productImageMobileZoom: function () {
			var setScaleAndPosition = function(x, y, scale, scaleElement) {
				scaleElement.style.webkitTransform = scaleElement.style.transform = 'translate(' + x + 'px, ' + y + 'px) scale(' + scale + ')';

				scaleElement.setAttribute('data-scale', scale);
				scaleElement.setAttribute('data-x', x);
				scaleElement.setAttribute('data-y', y);
			};

			$('.full-size-image .image-wrap').each(function() {
				var gestureArea = this,
					scaleElement = $(this).find('img')[0];

				setScaleAndPosition(0, 0, 1, scaleElement);

				interact(gestureArea)
					.off('gesturable')
					.off('draggable')
					.draggable({
						inertia: true,
						restrict: {
							restriction: "parent",
							endOnly: true
						},
						autoScroll: true,
						onmove: function dragMoveListener(event) {
							if (!$('.full-size-image').hasClass('zoomed')) {
								return;
							}

							var target = scaleElement,
								x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
								y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

							setScaleAndPosition(x, y, target.getAttribute('data-scale'), scaleElement);
						}
					})
					.gesturable({
						onmove: function(event) {
							if (!$('.full-size-image').hasClass('zoomed')) {
								return;
							}

							var scale = parseFloat(scaleElement.getAttribute('data-scale'));
							var newScale = scale * (1 + event.ds);
							scale = newScale > 4 ? 4 : Math.max(0.5, newScale);

							setScaleAndPosition(parseFloat(scaleElement.getAttribute('data-x')), parseFloat(scaleElement.getAttribute('data-y')), scale, scaleElement);
						}
					});
			});
		},

		// subrow toggle
		subrowToggle: function() {
			var toggle = $('.toggle-subrow');

			if(toggle.length) {
				toggle.each(function(){
					var content = $(this).next('.table-content');

					$(this).on('click', function(){
						content.slideToggle();
						$(this).toggleClass('open');
					});
				});
			}
		},

		// google maps
		googleMaps: function() {
			if(typeof google !== 'undefined') {
				google.maps.event.addDomListener(window, 'load', function(){
					var myLatlng = new google.maps.LatLng(43.565529, -80.197645);
					var mapOptions = {
						zoom: 8,
						center: myLatlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
					var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

					//=====Initialise Default Marker
					var marker = new google.maps.Marker({
						position: myLatlng,
						map: map,
						title: 'marker'
					//=====You can even customize the icons here
					});

					//=====Initialise InfoWindow
					var infowindow = new google.maps.InfoWindow({
						content: "<B>Skyway Dr</B>"
					});

					//=====Eventlistener for InfoWindow
					google.maps.event.addListener(marker, 'click', function() {
						infowindow.open(map,marker);
					});
				});
			}
		},

		// grid for liste page
		gridToggle: function() {
			var toggle = $('.js-grid-switch');
			var gridContainer = $('.js-product-gallery');

			toggle.on('click', function(e){
				if(!$(e.target).hasClass('selected')) {
					$('.grid-trigger').removeClass('selected');
					$(e.target).addClass('selected');
					gridContainer.toggleClass('gallery-rows gallery-columns');
				}
			});
		},

		// breadcrumbs toogle
		breadcrumbsToggle: function() {
			var bc = $('.breadcrumbs');
			var list = bc.find('.category-overlay');
			var link = bc.find('.sub-category li');
			var togglerMob = bc.find('.category-overlay .js-category-toggle');
			var closeOverlay = bc.find('.js-close-category a');

			if(winWid <= 1024) {
				togglerMob.on('click', function(e) {
					if(!list.hasClass('open')) {
						e.preventDefault();
						list.addClass('open');
						link.addClass('visible');
					} else {
						list.removeClass('open');
						link.removeClass('visible');
					}
				});

				link.on('click', function(e) {
					if(!list.hasClass('open')) {
						e.preventDefault();
						list.addClass('open');
						link.addClass('visible');
					} else {
						link.removeClass('visible');
						link.removeClass('selected');
						$(this).addClass('selected');
						list.removeClass('open');
					}
				});
				closeOverlay.on('click', function(e) {
					list.removeClass('open');
					link.removeClass('visible');
				});
			}
		},

		// product image zoom
		productColorSlider: function () {
			//PDP opening full size image
			if($('.products-list .product-colors .slider-wrap').length) {
				$('.products-list .product-colors .slider-wrap').slick({
					centerPadding: '0',
					arrows: true,
					prevArrow: '',
					nextArrow: '<span class="slick-next"><i class="icon font-ico-slide-next-small"></i></span>',
					infinite: true,
					speed: 300,
					slidesToShow: 9,
					slidesToScroll: 9,
					swipe: false,
					responsive: [
						{
							breakpoint: 1600,
							settings: {
								slidesToShow: 7,
								slidesToScroll: 7
							}
						},
						{
							breakpoint: 1440,
							settings: {
								slidesToShow: 5,
								slidesToScroll: 5
							}
						},
						{
							breakpoint: 1024,
							settings: {
								slidesToShow: 6,
								slidesToScroll: 6
							}
						},
						{
							breakpoint: 767,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 3
							}
						}
					]
				});
			}
		},
		productSizeSlider: function () {
			//PDP opening full size image
			if($('.products-list .product-sizes .slider-wrap').length) {
				$('.products-list .product-sizes .slider-wrap').slick({
					arrows: true,
					variableWidth: true,
					prevArrow: '',
					nextArrow: '<span class="slick-next"><i class="icon font-ico-slide-next-small"></i></span>',
					infinite: true,
					speed: 300,
					slidesToShow: 6,
					slidesToScroll: 6,
					swipe: false,
					responsive: [
						{
							breakpoint: 1280,
							settings: {
								slidesToShow: 6
							}
						},
						{
							breakpoint: 767,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2
							}
						}
					]
				});
			}
		},

		// checkout discount mobile toogle
		discountToggle: function() {
			if($(window).width() < 767) {
				$('.discount-code-form .form-label').on('click', function() {
					$(this).toggleClass('opened');
					$(this).parent().find('.disc-field-wrap').stop().slideToggle(300);
				});
			}
		},

		//Product thumbs click functionality on PDP page
		thumbPDP: function() {
			$('.product-page-shop .product-image .thumb a').on('click', function(e){
				var $product = $(this).parent().parent().parent();
				var newImage = $(this).attr('href');
				$product.addClass('test');
				$product.find('.img-wrap img').attr('src', newImage);
				$(this).parent().siblings().removeClass('selected');
				$(this).parent().addClass('selected');
				e.preventDefault();
			});
		},

		// form tooltip
		tooltipForm: function() {
			$('.has-tooltip').focus(function() {
				$(this).parent().find('.tooltip').fadeIn();
			}).blur(function(){
				$(this).parent().find('.tooltip').fadeOut();
			});
			$('.tooltip .icon').on('click', function() {
				$(this).parents().find('.tooltip').fadeOut();
			});
		},

		// language custom dropdown
		customLanguageDropdown: function() {
			$('.select-list .selected').on('click', function () {
				$(this).addClass('active');
				$(this).next('.js-dest-overlay').stop().fadeIn();
			});
			$('.select-list').find('.js-dest-overlay li').on('click', function () {
				$('.select-list .selected').removeClass('active');
				$('.select-list .js-dest-overlay').stop().fadeOut();
			});
			$('.select-list').each(function () {
				var $selectWrap = $(this);

				$selectWrap.find('.js-dest-overlay li').on('click', function () {
					$selectWrap.find('.selected').removeClass('not-active');
					if ($selectWrap.find('input.selected').length) {
						$selectWrap.find('input.selected').val($(this).find('.primary').text());
					} else {
						$selectWrap.find('span.selected').text($(this).find('.primary').text());
					}
					if ($selectWrap.find('.primary').has('img')) {
						$(this).find('.primary img').clone().prependTo($selectWrap.find('.selected'));
					}
				});
			});
		},

		//equal height function
		equalHeight: function (arrayItems, count) {
			if (arrayItems !== undefined && arrayItems.length > 0) {
				arrayItems.height('');

				var maxH = 0;

				if (count) {
					var arrays = [];
					while (arrayItems.length > 0) {
						arrays.push(arrayItems.splice(0, count));
					}

					for (var i = 0; i < arrays.length; i += 1) {
						var data = arrays[i];
						maxH = 0;
						for (var j = 0; j < data.length; j += 1) {
							var currentH = $(data[j]).outerHeight(true);
							if (currentH > maxH) {
								maxH = currentH;
							}
						}

						for (var k = 0; k < data.length; k += 1) {
							$(data[k]).css('height', maxH);
						}
					}
				} else {
					arrayItems.each(function () {
						var currentH2 = $(this).outerHeight(true);
						if (currentH2 > maxH) {
							maxH = currentH2;
						}
					});

					arrayItems.css('height', maxH);
				}
			}
		}
	}
} ());
})(jQuery);
