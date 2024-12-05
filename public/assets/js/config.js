(window.config = {
  colors: {
    primary: "#888888",
    secondary: "#8592a3",
    success: "#71dd37",
    info: "#03c3ec",
    warning: "#ffab00",
    danger: "#ff3e1d",
    dark: "#233446",
    black: "#22303e",
    white: "#fff",
    cardColor: "#fff",
    bodyBg: "#f5f5f9",
    bodyColor: "#646E78",
    headingColor: "#384551",
    textMuted: "#a7acb2",
    borderColor: "#e4e6e8",
  },
  colors_label: {
    primary: "#696cff29",
    secondary: "#8592a329",
    success: "#71dd3729",
    info: "#03c3ec29",
    warning: "#ffab0029",
    danger: "#ff3e1d29",
    dark: "#181c211a",
  },
  colors_dark: {
    cardColor: "#2b2c40",
    bodyBg: "#232333",
    bodyColor: "#b2b2c4",
    headingColor: "#d5d5e2",
    textMuted: "#7e7f96",
    borderColor: "#4e4f6c",
  },
  enableMenuLocalStorage: !0,
}),
  (window.assetsPath =
    document.documentElement.getAttribute("data-assets-path")),
  (window.templateName =
    document.documentElement.getAttribute("data-template")),
  (window.rtlSupport = !0),
  "undefined" != typeof TemplateCustomizer &&
    (window.templateCustomizer = new TemplateCustomizer({
      cssPath: assetsPath + "vendor/css" + (rtlSupport ? "/rtl" : "") + "/",
      themesPath: assetsPath + "vendor/css" + (rtlSupport ? "/rtl" : "") + "/",
      displayCustomizer: !0,
      lang:
        localStorage.getItem("templateCustomizer-" + templateName + "--Lang") ||
        "en",
      controls: [
        "style",
        "headerType",
        "layoutCollapsed",
        "layoutNavbarOptions",
        "themes",
      ],
    }));
