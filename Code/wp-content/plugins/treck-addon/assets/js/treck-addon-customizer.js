(function ($) {
  "use strict";
  $(document).ready(function () {
    $('[id*="-treck_"] .customize-control-select select').each(function () {
      $(this).select2();
    });
  });
})(jQuery);
