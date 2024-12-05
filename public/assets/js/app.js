window.addEventListener("scroll", function () {
  let sections = document.querySelectorAll("section");
  let navLinks = document.querySelectorAll("[data-target]");

  sections.forEach(function (section) {
    let top = section.offsetTop - 100;
    let bottom = top + section.offsetHeight;

    if (window.pageYOffset >= top && window.pageYOffset < bottom) {
      navLinks.forEach(function (link) {
        if (link.getAttribute("data-target") === section.id) {
          link.classList.add("is-active");
        } else {
          link.classList.remove("is-active");
        }
      });
    } else {
      navLinks.forEach(function (link) {
        if (link.getAttribute("data-target") === section.id) {
          link.classList.remove("is-active");
        }
      });
    }
  });
});
