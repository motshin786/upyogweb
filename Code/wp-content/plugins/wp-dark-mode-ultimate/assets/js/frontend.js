(function () {
  const app = {
    init: () => {
      if (typeof wpDarkMode === "undefined") {
        return;
      }

      app.replaceBgImages();
      app.replaceImages();
      app.replaceVideos();

      window.addEventListener("wp_dark_mode", app.replaceBgImages);
      window.addEventListener("wp_dark_mode", app.replaceImages);
      window.addEventListener("wp_dark_mode", app.replaceVideos);

      //run after some seconds to replace the lay load images
      setTimeout(app.replaceImages, 1000);
      setTimeout(app.replaceImages, 3000);

      //handle the woocommerce product gallery images
      jQuery(".woocommerce-product-gallery").on(
        "wc-product-gallery-after-init",
        function () {
          wc_single_product_params.zoom_options.callback = () => {
            app.replaceImages();
          };
        }
      );

      // check dynamic content mode
      app.dynamicContentMode();
    },

    replaceImages: () => {
      if (!wpDarkMode.is_ultimate_active) {
        return;
      }

      if (!wpDarkMode.frontend_mode) {
        return;
      }

      const elements = document.querySelectorAll("img");

      if (elements)
        elements.forEach((element) => {
          const url = element.getAttribute("src");
          const images = wpDarkMode.images;
          const dataKey = "data-light-img";

          if (!images) {
            return;
          }

          if (
            document
              .querySelector("html")
              .classList.contains("wp-dark-mode-active")
          ) {
            if (images.light_images.includes(url)) {
              const index = images.light_images.indexOf(url);

              element.setAttribute(dataKey, url);

              const srcset = element.getAttribute("srcset");
              if (srcset) {
                element.setAttribute("data-light-srcset", srcset);
                element.setAttribute("srcset", images.dark_images[index]);
              }

              element.setAttribute("src", images.dark_images[index]);
            }
          } else {
            const light_img = element.getAttribute(dataKey);
            const srcset = element.getAttribute("data-light-srcset");
            if (light_img) {
              element.setAttribute("src", light_img);
            }

            if (srcset) {
              element.setAttribute("srcset", srcset);
            }
          }
        });
    },

    replaceBgImages: () => {
      const elements = document.querySelectorAll(
        "header, footer, div, section"
      );

      if (elements)
        elements.forEach((element) => {
          const bi = window.getComputedStyle(element, false).backgroundImage;

          if (bi !== "none") {
            const url = bi.slice(4, -1).replace(/"/g, "");
            const images = wpDarkMode.images;
            const dataKey = "data-light-bg";

            if (!images) {
              return;
            }

            if (
              document
                .querySelector("html")
                .classList.contains("wp-dark-mode-active")
            ) {
              if (images.light_images.includes(url)) {
                const index = images.light_images.indexOf(url);

                element.setAttribute(dataKey, url);
                element.style.backgroundImage = `url('${images.dark_images[index]}')`;
              }
            } else {
              const light_bg = element.getAttribute(dataKey);
              if (light_bg) {
                element.style.backgroundImage = `url('${light_bg}')`;
              }
            }
          }
        });
    },

    replaceVideos: () => {
      const videos = wpDarkMode.videos;
      const dataKey = "data-light-video";
      const isDarkmode = document
        .querySelector("html")
        .classList.contains("wp-dark-mode-active");

      if (!videos) {
        return;
      }

      //video element loop
      const elements = document.querySelectorAll("video");
      if (elements)
        elements.forEach((element) => {
          const url = element.getAttribute("src");

          if (isDarkmode) {
            if (videos.light_videos.includes(url)) {
              const index = videos.light_videos.indexOf(url);
              element.setAttribute(dataKey, url);
              element.setAttribute("src", videos.dark_videos[index]);
            }
          } else {
            const light_video = element.getAttribute(dataKey);
            if (light_video) {
              element.setAttribute("src", light_video);
            }
          }
        });

      //iframe element loop
      const iframe = document.querySelectorAll("iframe");
      if (iframe)
        iframe.forEach((element) => {
          const url = element.getAttribute("src");

          const isYoutube = url.match(
            /^.*youtu.be\/|(v\/)|(\/u\/\w\/|embed\/|watch\?)\??v?=?(?<videoID>[^#&?]*).*/
          );
          const isVimeo = url.match(
            /(?:http:|https:|)\/\/(?:player.|www.)?vimeo\.com\/(?:video\/|embed\/|watch\?\S*v=|v\/)?(?<videoID>\d*)/
          );

          const videoID = !!isYoutube
            ? isYoutube.groups.videoID
            : !!isVimeo
            ? isVimeo.groups.videoID
            : null;

          if (!videoID) return;

          if (isDarkmode) {
            videos.light_videos.map((lightVideo, index) => {
              if (!lightVideo.includes(videoID)) return;

              element.setAttribute(dataKey, url);
              const darkVideoURL = videos.dark_videos[index];

              const isYoutube = darkVideoURL.match(
                /^.*youtu.be\/|(v\/)|(\/u\/\w\/|embed\/|watch\?)\??v?=?(?<videoID>[^#&?]*).*/
              );
              const isVimeo = darkVideoURL.match(
                /(?:http:|https:|)\/\/(?:player.|www.)?vimeo\.com\/(?:video\/|embed\/|watch\?\S*v=|v\/)?(?<videoID>\d*)/
              );

              const darkVideoID = !!isYoutube
                ? isYoutube.groups.videoID
                : !!isVimeo
                ? isVimeo.groups.videoID
                : null;

              if (!darkVideoID) return;

              const embedURL = !!isYoutube
                ? `https://www.youtube.com/embed/${darkVideoID}`
                : !!isVimeo
                ? `https://player.vimeo.com/video/${darkVideoID}`
                : null;

              if (!embedURL) return;

              element.setAttribute("src", embedURL);
            });
          } else {
            const light_video = element.getAttribute(dataKey);
            if (light_video) {
              element.setAttribute("src", light_video);
            }
          }
        });
    },

    /**
     * MutationObeserver for Dark Mode
     */
    wait: false,
    throttle: null,
    throttleRate: 600,
    restartThrottle() {
      app.wait = true;
      app.throttle = setTimeout(function () {
        app.wait = false;
        clearTimeout(app.throttle);
      }, 1000 / (app.throttleRate / 60));
    },

    dynamicContentMode() {
      if (!wpDarkModePro.dynamic_content_mode) return; 

      // Create an observer instance linked to the callback function
      const observer = new MutationObserver(function (mutationsList, observer) {
        // return if throttle disallowes this

        if (app.wait === true) return;

        // restart throttle for next queue
        app.restartThrottle();
        app.replaceBgImages();
        app.replaceImages();
        app.replaceVideos();
      });

      // Start observing the target node for configured mutations
      let mutationSelectors = "body";
      let selectors = document.querySelectorAll(mutationSelectors);
      if (selectors)
        selectors.forEach((selector) => {
          observer.observe(selector, {
            childList: true,
            subtree: true,
          });
        });
    },
  };

  // readystatechange
  window.addEventListener("DOMContentLoaded", app.init);
})();
