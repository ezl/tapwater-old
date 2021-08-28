/* Main menu */

function openMenu() {
  var openElement = document.getElementById("open-menu");
  var closeElement = document.getElementById("close-menu");
  var menu = document.getElementById("menu");
  openElement.classList.add("hidden");
  closeElement.classList.remove("hidden");
  menu.classList.remove("hidden");
}

function closeMenu() {
  var openElement = document.getElementById("open-menu");
  var closeElement = document.getElementById("close-menu");
  closeElement.classList.add("hidden");
  openElement.classList.remove("hidden");
  menu.classList.add("hidden");
}

/* Stick footer to bottom when little or no content */

document.addEventListener(
  "DOMContentLoaded",
  function () {
    var element = document.getElementById("bd");
    var height = element.offsetHeight;

    if (height < screen.height) {
      document.getElementById("footer").classList.add("stickybottom");
    }
  },
  false
);

/* Toc */

(function ($) {
  $(".toc").append(
    '<span class="dashicons dashicons-minus"></span><span class="dashicons dashicons-plus-alt2"></span><h3>Table of Contents</h3>'
  );

  function toc() {
    $(".entry-content h2").each(function (i) {
      $(this).attr("id", "title-" + i);
      $(".toc").append(
        '<a class="toc-item" href="#title-' +
          i +
          '">' +
          (i + 1) +
          ") " +
          $(this).text() +
          "</a>"
      );
    });
  }

  toc();

  //toggle open close

  $(".dashicons-minus").hide();
  $(".toc-item").hide();

  $(".toc h3, .toc .dashicons").click(function () {
    if ($(".dashicons-plus-alt2").css("display") != "none") {
      $(".toc-item").show();
      $(".dashicons-plus-alt2").hide();
      $(".dashicons-minus").show();
    } else {
      $(".toc-item").hide();
      $(".dashicons-plus-alt2").show();
      $(".dashicons-minus").hide();
    }
  });
})(jQuery);
