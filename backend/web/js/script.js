/*!
 * Start Bootstrap - SB Admin v6.0.1 (https://startbootstrap.com/templates/sb-admin)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
(function ($) {
  'use strict';

  var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
  $('.sb-sidenav-menu a.nav-link').each(function () {
    let checkUrl = new RegExp(this.href, "i");
    if (path.match(checkUrl) !== null) {
      $(this).addClass('active');
    }
  });

  // Toggle the side navigation
  $('#sidebarToggle').on('click', function (e) {
    e.preventDefault();
    $('body').toggleClass('sb-sidenav-toggled');
  });

  // $('.select2').select2();

})(jQuery);

$(document).bind("ajaxSend", function () {
  NProgress.start();
}).bind("ajaxComplete", function () {
  NProgress.done();
});