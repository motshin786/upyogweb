(function ($) {
  const app = {
    init: () => {
      if (!wpDarkMode.is_ultimate_active) return;

      app.removeBlockedSettings();

      $(document).on("click", ".add_row", app.addRow);
      $(document).on("click", ".remove_row", app.removeRow);

      $(document).on(
        "click",
        ".wp_dark_mode_select_img",
        app.handleImageUploader
      );
      $(document).on("click", ".wp_dark_mode_delete_img", app.deleteImage);

      $(document).on(
        "change paste keyup",
        ".image-settings-table input",
        app.handleChange
      );

    },

    handleChange: function () {
      const img = $(this).siblings("img");
      const delete_img = $(this).siblings(".wp_dark_mode_delete_img");

      const val = $(this).val();
      if (val) {
        img.attr("src", val);
        delete_img.removeClass("hidden");
      } else {
        img.attr("src", "");
        delete_img.addClass("hidden");
      }
    },

    handleImageUploader: function (event) {
      event.preventDefault();
      const input = $(this).siblings("input");
      const img = $(this).siblings("img");
      const delete_img = $(this).siblings(".wp_dark_mode_delete_img");

      const isImage = $(this).parents(".image_settings").length;

      // Create the media frame.
      const file_frame = (wp.media.frames.file_frame = wp.media({
        title: "Select image",
        library: {
          type: isImage ? "image" : "video",
        },
        button: {
          text: "Select this image",
        },
        multiple: false,
      }));

      file_frame.on("select", function () {
        const attachment = file_frame.state().get("selection").first().toJSON();
        input.val(attachment.url).change();
        img.attr("src", attachment.url);
        delete_img.removeClass("hidden");
      });

      // Finally, open the modal
      file_frame.open();
    },

    deleteImage: function (e) {
      e.preventDefault();

      const input = $(this).siblings("input");
      const img = $(this).siblings("img");

      input.val("").change();
      img.attr("src", "");

      $(this).addClass("hidden");
    },

    addRow: function (e) {
      e.preventDefault();

      const tr = $(this).closest("tr");
      const trHTML = tr.clone();
      trHTML.find("input").val("");
      trHTML.find("img").attr("src", "");
      trHTML.find(".wp_dark_mode_delete_img").addClass("hidden");

      tr.after(trHTML);
    },

    removeRow: function (e) {
      e.preventDefault();

      $(this).closest("tr").remove();
    },

    removeBlockedSettings: () => {
      $(".wp-dark-mode-settings-page tr").removeClass(
        "disabled  wp-dark-mode-badge wp-dark-mode-badge-pro wp-dark-mode-badge-ultimate"
      );
    },

  };

  app.init();
})(jQuery);
