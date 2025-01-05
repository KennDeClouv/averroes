$(function () {
    var theme = $("html").hasClass("light-style") ? "default" : "default-dark",
        treeElement = $("#jstree-custom-icons");
    if (treeElement.length) {
        treeElement.jstree({
            core: {
                themes: { name: theme },
                data: [
                    {
                        text: "css",
                        children: [
                            { text: "app.css", type: "css" },
                            { text: "style.css", type: "css" },
                        ],
                    },
                    {
                        text: "img",
                        state: { opened: true },
                        children: [
                            { text: "bg.jpg", type: "img" },
                            { text: "logo.png", type: "img" },
                            { text: "avatar.png", type: "img" },
                        ],
                    },
                    {
                        text: "js",
                        state: { opened: true },
                        children: [
                            { text: "jquery.js", type: "js" },
                            { text: "app.js", type: "js" },
                        ],
                    },
                    { text: "index.html", type: "html" },
                    { text: "page-one.html", type: "html" },
                    { text: "page-two.html", type: "html" },
                ],
            },
            plugins: ["types"],
            types: {
                default: { icon: "bx bx-folder" },
                html: { icon: "bx bxl-html5 text-danger" },
                css: { icon: "bx bxl-css3 text-info" },
                img: { icon: "bx bx-image text-success" },
                js: { icon: "bx bxl-nodejs text-warning" },
            },
        });
    }
});
