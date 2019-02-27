(function ($) {
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
})(jQuery);
