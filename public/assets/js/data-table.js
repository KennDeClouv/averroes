let fv, offCanvasEl;

document.addEventListener("DOMContentLoaded", function (e) {
    var t;
    (t = document.getElementById("form-add-new-record")),
        setTimeout(() => {
            let e = document.querySelector(".create-new"),
                t = document.querySelector("#add-new-record");
            e &&
                e.addEventListener("click", function () {
                    (offCanvasEl = new bootstrap.Offcanvas(t)),
                        (t.querySelector(".dt-full-name").value = ""),
                        (t.querySelector(".dt-post").value = ""),
                        (t.querySelector(".dt-email").value = ""),
                        (t.querySelector(".dt-date").value = ""),
                        (t.querySelector(".dt-salary").value = ""),
                        offCanvasEl.show();
                });
        }, 200),
        (fv = FormValidation.formValidation(t, {
            fields: {
                basicFullname: {
                    validators: {
                        notEmpty: { message: "The name is required" },
                    },
                },
                basicPost: {
                    validators: {
                        notEmpty: { message: "Post field is required" },
                    },
                },
                basicEmail: {
                    validators: {
                        notEmpty: { message: "The Email is required" },
                        emailAddress: {
                            message: "The value is not a valid email address",
                        },
                    },
                },
                basicDate: {
                    validators: {
                        notEmpty: { message: "Joining Date is required" },
                        date: {
                            format: "MM/DD/YYYY",
                            message: "The value is not a valid date",
                        },
                    },
                },
                basicSalary: {
                    validators: {
                        notEmpty: { message: "Basic Salary is required" },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".col-sm-12",
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus(),
            },
            init: (e) => {
                e.on("plugins.message.placed", function (e) {
                    e.element.parentElement.classList.contains("input-group") &&
                        e.element.parentElement.insertAdjacentElement(
                            "afterend",
                            e.messageElement
                        );
                });
            },
        })),
        (t = document.querySelector('[name="basicDate"]')) &&
            t.flatpickr({
                enableTime: !1,
                dateFormat: "m/d/Y",
                onChange: function () {
                    fv.revalidateField("basicDate");
                },
            });
}),
    $(function () {
        var l,
            t,
            e = $(".datatables-basic"),
            a = $(".dt-complex-header"),
            s = $(".dt-row-grouping"),
            n = $(".dt-multilingual"),
            r =
                (e.length &&
                    ((l = e.DataTable({
                        ajax: assetsPath + "json/table-datatable.json",
                        columns: [
                            { data: "" },
                            { data: "id" },
                            { data: "id" },
                            { data: "full_name" },
                            { data: "email" },
                            { data: "start_date" },
                            { data: "salary" },
                            { data: "status" },
                            { data: "" },
                        ],
                        columnDefs: [
                            {
                                className: "control",
                                orderable: !1,
                                searchable: !1,
                                responsivePriority: 2,
                                targets: 0,
                                render: function (e, t, a, s) {
                                    return "";
                                },
                            },
                            {
                                targets: 1,
                                orderable: !1,
                                searchable: !1,
                                responsivePriority: 3,
                                checkboxes: !0,
                                checkboxes: {
                                    selectAllRender:
                                        '<input type="checkbox" class="form-check-input">',
                                },
                                render: function () {
                                    return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                                },
                            },
                            { targets: 2, searchable: !1, visible: !1 },
                            {
                                targets: 3,
                                responsivePriority: 4,
                                render: function (e, t, a, s) {
                                    var n = a.avatar,
                                        l = a.full_name,
                                        r = a.post;
                                    return (
                                        '<div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar me-2">' +
                                        (n
                                            ? '<img src="' +
                                              assetsPath +
                                              "img/avatars/" +
                                              n +
                                              '" alt="Avatar" class="rounded-circle">'
                                            : '<span class="avatar-initial rounded-circle bg-label-' +
                                              [
                                                  "success",
                                                  "danger",
                                                  "warning",
                                                  "info",
                                                  "dark",
                                                  "primary",
                                                  "secondary",
                                              ][Math.floor(6 * Math.random())] +
                                              '">' +
                                              (n = (
                                                  ((n =
                                                      (l = a.full_name).match(
                                                          /\b\w/g
                                                      ) || []).shift() || "") +
                                                  (n.pop() || "")
                                              ).toUpperCase()) +
                                              "</span>") +
                                        '</div></div><div class="d-flex flex-column"><span class="emp_name text-truncate">' +
                                        l +
                                        '</span><small class="emp_post text-truncate text-muted">' +
                                        r +
                                        "</small></div></div>"
                                    );
                                },
                            },
                            { responsivePriority: 1, targets: 4 },
                            {
                                targets: -2,
                                render: function (e, t, a, s) {
                                    var a = a.status,
                                        n = {
                                            1: {
                                                title: "Current",
                                                class: "bg-label-primary",
                                            },
                                            2: {
                                                title: "Professional",
                                                class: " bg-label-success",
                                            },
                                            3: {
                                                title: "Rejected",
                                                class: " bg-label-danger",
                                            },
                                            4: {
                                                title: "Resigned",
                                                class: " bg-label-warning",
                                            },
                                            5: {
                                                title: "Applied",
                                                class: " bg-label-info",
                                            },
                                        };
                                    return void 0 === n[a]
                                        ? e
                                        : '<span class="badge ' +
                                              n[a].class +
                                              '">' +
                                              n[a].title +
                                              "</span>";
                                },
                            },
                            {
                                targets: -1,
                                title: "Actions",
                                orderable: !1,
                                searchable: !1,
                                render: function (e, t, a, s) {
                                    return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><ul class="dropdown-menu dropdown-menu-end m-0"><li><a href="javascript:;" class="dropdown-item">Details</a></li><li><a href="javascript:;" class="dropdown-item">Archive</a></li><div class="dropdown-divider"></div><li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li></ul></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-md"></i></a>';
                                },
                            },
                        ],
                        order: [[2, "desc"]],
                        dom: '<"card-header flex-column flex-md-row pb-0"<"head-label text-center"><"dt-action-buttons text-end pt-6 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        displayLength: 7,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        language: {
                            paginate: {
                                next: '<i class="bx bx-chevron-right bx-18px"></i>',
                                previous:
                                    '<i class="bx bx-chevron-left bx-18px"></i>',
                            },
                        },
                        buttons: [
                            {
                                extend: "collection",
                                className:
                                    "btn btn-label-primary dropdown-toggle me-4",
                                text: '<i class="bx bx-export bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                                buttons: [
                                    {
                                        extend: "print",
                                        text: '<i class="bx bx-printer me-1" ></i>Print',
                                        className: "dropdown-item",
                                        exportOptions: {
                                            columns: [3, 4, 5, 6, 7],
                                            format: {
                                                body: function (e, t, a) {
                                                    var s;
                                                    return e.length <= 0
                                                        ? e
                                                        : ((e = $.parseHTML(e)),
                                                          (s = ""),
                                                          $.each(
                                                              e,
                                                              function (e, t) {
                                                                  void 0 !==
                                                                      t.classList &&
                                                                  t.classList.contains(
                                                                      "user-name"
                                                                  )
                                                                      ? (s +=
                                                                            t
                                                                                .lastChild
                                                                                .firstChild
                                                                                .textContent)
                                                                      : void 0 ===
                                                                        t.innerText
                                                                      ? (s +=
                                                                            t.textContent)
                                                                      : (s +=
                                                                            t.innerText);
                                                              }
                                                          ),
                                                          s);
                                                },
                                            },
                                        },
                                        customize: function (e) {
                                            $(e.document.body)
                                                .css(
                                                    "color",
                                                    config.colors.headingColor
                                                )
                                                .css(
                                                    "border-color",
                                                    config.colors.borderColor
                                                )
                                                .css(
                                                    "background-color",
                                                    config.colors.bodyBg
                                                ),
                                                $(e.document.body)
                                                    .find("table")
                                                    .addClass("compact")
                                                    .css("color", "inherit")
                                                    .css(
                                                        "border-color",
                                                        "inherit"
                                                    )
                                                    .css(
                                                        "background-color",
                                                        "inherit"
                                                    );
                                        },
                                    },
                                    {
                                        extend: "csv",
                                        text: '<i class="bx bx-file me-1" ></i>Csv',
                                        className: "dropdown-item",
                                        exportOptions: {
                                            columns: [3, 4, 5, 6, 7],
                                            format: {
                                                body: function (e, t, a) {
                                                    var s;
                                                    return e.length <= 0
                                                        ? e
                                                        : ((e = $.parseHTML(e)),
                                                          (s = ""),
                                                          $.each(
                                                              e,
                                                              function (e, t) {
                                                                  void 0 !==
                                                                      t.classList &&
                                                                  t.classList.contains(
                                                                      "user-name"
                                                                  )
                                                                      ? (s +=
                                                                            t
                                                                                .lastChild
                                                                                .firstChild
                                                                                .textContent)
                                                                      : void 0 ===
                                                                        t.innerText
                                                                      ? (s +=
                                                                            t.textContent)
                                                                      : (s +=
                                                                            t.innerText);
                                                              }
                                                          ),
                                                          s);
                                                },
                                            },
                                        },
                                    },
                                    {
                                        extend: "excel",
                                        text: '<i class="bx bxs-file-export me-1"></i>Excel',
                                        className: "dropdown-item",
                                        exportOptions: {
                                            columns: [3, 4, 5, 6, 7],
                                            format: {
                                                body: function (e, t, a) {
                                                    var s;
                                                    return e.length <= 0
                                                        ? e
                                                        : ((e = $.parseHTML(e)),
                                                          (s = ""),
                                                          $.each(
                                                              e,
                                                              function (e, t) {
                                                                  void 0 !==
                                                                      t.classList &&
                                                                  t.classList.contains(
                                                                      "user-name"
                                                                  )
                                                                      ? (s +=
                                                                            t
                                                                                .lastChild
                                                                                .firstChild
                                                                                .textContent)
                                                                      : void 0 ===
                                                                        t.innerText
                                                                      ? (s +=
                                                                            t.textContent)
                                                                      : (s +=
                                                                            t.innerText);
                                                              }
                                                          ),
                                                          s);
                                                },
                                            },
                                        },
                                    },
                                    {
                                        extend: "pdf",
                                        text: '<i class="bx bxs-file-pdf me-1"></i>Pdf',
                                        className: "dropdown-item",
                                        exportOptions: {
                                            columns: [3, 4, 5, 6, 7],
                                            format: {
                                                body: function (e, t, a) {
                                                    var s;
                                                    return e.length <= 0
                                                        ? e
                                                        : ((e = $.parseHTML(e)),
                                                          (s = ""),
                                                          $.each(
                                                              e,
                                                              function (e, t) {
                                                                  void 0 !==
                                                                      t.classList &&
                                                                  t.classList.contains(
                                                                      "user-name"
                                                                  )
                                                                      ? (s +=
                                                                            t
                                                                                .lastChild
                                                                                .firstChild
                                                                                .textContent)
                                                                      : void 0 ===
                                                                        t.innerText
                                                                      ? (s +=
                                                                            t.textContent)
                                                                      : (s +=
                                                                            t.innerText);
                                                              }
                                                          ),
                                                          s);
                                                },
                                            },
                                        },
                                    },
                                    {
                                        extend: "copy",
                                        text: '<i class="bx bx-copy me-1" ></i>Copy',
                                        className: "dropdown-item",
                                        exportOptions: {
                                            columns: [3, 4, 5, 6, 7],
                                            format: {
                                                body: function (e, t, a) {
                                                    var s;
                                                    return e.length <= 0
                                                        ? e
                                                        : ((e = $.parseHTML(e)),
                                                          (s = ""),
                                                          $.each(
                                                              e,
                                                              function (e, t) {
                                                                  void 0 !==
                                                                      t.classList &&
                                                                  t.classList.contains(
                                                                      "user-name"
                                                                  )
                                                                      ? (s +=
                                                                            t
                                                                                .lastChild
                                                                                .firstChild
                                                                                .textContent)
                                                                      : void 0 ===
                                                                        t.innerText
                                                                      ? (s +=
                                                                            t.textContent)
                                                                      : (s +=
                                                                            t.innerText);
                                                              }
                                                          ),
                                                          s);
                                                },
                                            },
                                        },
                                    },
                                ],
                            },
                            {
                                text: '<i class="bx bx-plus bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Add New Record</span>',
                                className: "create-new btn btn-primary",
                            },
                        ],
                        responsive: {
                            details: {
                                display:
                                    $.fn.dataTable.Responsive.display.modal({
                                        header: function (e) {
                                            return (
                                                "Details of " +
                                                e.data().full_name
                                            );
                                        },
                                    }),
                                type: "column",
                                renderer: function (e, t, a) {
                                    a = $.map(a, function (e, t) {
                                        return "" !== e.title
                                            ? '<tr data-dt-row="' +
                                                  e.rowIndex +
                                                  '" data-dt-column="' +
                                                  e.columnIndex +
                                                  '"><td>' +
                                                  e.title +
                                                  ":</td> <td>" +
                                                  e.data +
                                                  "</td></tr>"
                                            : "";
                                    }).join("");
                                    return (
                                        !!a &&
                                        $(
                                            '<table class="table"/><tbody />'
                                        ).append(a)
                                    );
                                },
                            },
                        },
                    })),
                    $("div.head-label").html(
                        '<h5 class="card-title mb-0">DataTable with Buttons</h5>'
                    ),
                    $(".dt-buttons > .btn-group > button").removeClass(
                        "btn-secondary"
                    )),
                101);
        fv.on("core.form.valid", function () {
            var e = $(".add-new-record .dt-full-name").val(),
                t = $(".add-new-record .dt-post").val(),
                a = $(".add-new-record .dt-email").val(),
                s = $(".add-new-record .dt-date").val(),
                n = $(".add-new-record .dt-salary").val();
            "" != e &&
                (l.row
                    .add({
                        id: r,
                        full_name: e,
                        post: t,
                        email: a,
                        start_date: s,
                        salary: "$" + n,
                        status: 5,
                    })
                    .draw(),
                r++,
                offCanvasEl.hide());
        }),
            $(".datatables-basic tbody").on(
                "click",
                ".delete-record",
                function () {
                    l.row($(this).parents("tr")).remove().draw();
                }
            ),
            a.length &&
                a.DataTable({
                    ajax: assetsPath + "json/table-datatable.json",
                    columns: [
                        { data: "full_name" },
                        { data: "email" },
                        { data: "city" },
                        { data: "post" },
                        { data: "salary" },
                        { data: "status" },
                        { data: "" },
                    ],
                    columnDefs: [
                        {
                            targets: -2,
                            render: function (e, t, a, s) {
                                var a = a.status,
                                    n = {
                                        1: {
                                            title: "Current",
                                            class: "bg-label-primary",
                                        },
                                        2: {
                                            title: "Professional",
                                            class: " bg-label-success",
                                        },
                                        3: {
                                            title: "Rejected",
                                            class: " bg-label-danger",
                                        },
                                        4: {
                                            title: "Resigned",
                                            class: " bg-label-warning",
                                        },
                                        5: {
                                            title: "Applied",
                                            class: " bg-label-info",
                                        },
                                    };
                                return void 0 === n[a]
                                    ? e
                                    : '<span class="badge ' +
                                          n[a].class +
                                          '">' +
                                          n[a].title +
                                          "</span>";
                            },
                        },
                        {
                            targets: -1,
                            title: "Actions",
                            orderable: !1,
                            render: function (e, t, a, s) {
                                return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-md"></i></a>';
                            },
                        },
                    ],
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 7,
                    lengthMenu: [7, 10, 25, 50, 75, 100],
                    language: {
                        paginate: {
                            next: '<i class="bx bx-chevron-right bx-18px"></i>',
                            previous:
                                '<i class="bx bx-chevron-left bx-18px"></i>',
                        },
                    },
                }),
            s.length &&
                ((t = s.DataTable({
                    ajax: assetsPath + "json/table-datatable.json",
                    columns: [
                        { data: "" },
                        { data: "full_name" },
                        { data: "post" },
                        { data: "email" },
                        { data: "city" },
                        { data: "start_date" },
                        { data: "salary" },
                        { data: "status" },
                        { data: "" },
                    ],
                    columnDefs: [
                        {
                            className: "control",
                            orderable: !1,
                            targets: 0,
                            searchable: !1,
                            render: function (e, t, a, s) {
                                return "";
                            },
                        },
                        { visible: !1, targets: 2 },
                        {
                            targets: -2,
                            render: function (e, t, a, s) {
                                var a = a.status,
                                    n = {
                                        1: {
                                            title: "Current",
                                            class: "bg-label-primary",
                                        },
                                        2: {
                                            title: "Professional",
                                            class: " bg-label-success",
                                        },
                                        3: {
                                            title: "Rejected",
                                            class: " bg-label-danger",
                                        },
                                        4: {
                                            title: "Resigned",
                                            class: " bg-label-warning",
                                        },
                                        5: {
                                            title: "Applied",
                                            class: " bg-label-info",
                                        },
                                    };
                                return void 0 === n[a]
                                    ? e
                                    : '<span class="badge ' +
                                          n[a].class +
                                          '">' +
                                          n[a].title +
                                          "</span>";
                            },
                        },
                        {
                            targets: -1,
                            title: "Actions",
                            orderable: !1,
                            searchable: !1,
                            render: function (e, t, a, s) {
                                return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-sm"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-sm"></i></a>';
                            },
                        },
                    ],
                    order: [[2, "asc"]],
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 7,
                    lengthMenu: [7, 10, 25, 50, 75, 100],
                    language: {
                        paginate: {
                            next: '<i class="bx bx-chevron-right bx-18px"></i>',
                            previous:
                                '<i class="bx bx-chevron-left bx-18px"></i>',
                        },
                    },
                    drawCallback: function (e) {
                        var t = this.api(),
                            a = t.rows({ page: "current" }).nodes(),
                            s = null;
                        t.column(2, { page: "current" })
                            .data()
                            .each(function (e, t) {
                                s !== e &&
                                    ($(a)
                                        .eq(t)
                                        .before(
                                            '<tr class="group"><td colspan="8">' +
                                                e +
                                                "</td></tr>"
                                        ),
                                    (s = e));
                            });
                    },
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (e) {
                                    return "Details of " + e.data().full_name;
                                },
                            }),
                            type: "column",
                            renderer: function (e, t, a) {
                                a = $.map(a, function (e, t) {
                                    return "" !== e.title
                                        ? '<tr data-dt-row="' +
                                              e.rowIndex +
                                              '" data-dt-column="' +
                                              e.columnIndex +
                                              '"><td>' +
                                              e.title +
                                              ":</td> <td>" +
                                              e.data +
                                              "</td></tr>"
                                        : "";
                                }).join("");
                                return (
                                    !!a &&
                                    $('<table class="table"/><tbody />').append(
                                        a
                                    )
                                );
                            },
                        },
                    },
                })),
                $(".dt-row-grouping tbody").on(
                    "click",
                    "tr.group",
                    function () {
                        var e = t.order()[0];
                        (2 === e[0] && "asc" === e[1]
                            ? t.order([2, "desc"])
                            : t.order([2, "asc"])
                        ).draw();
                    }
                ));
        n.length &&
            n.DataTable({
                ajax: assetsPath + "json/table-datatable.json",
                columns: [
                    { data: "" },
                    { data: "full_name" },
                    { data: "post" },
                    { data: "email" },
                    { data: "start_date" },
                    { data: "salary" },
                    { data: "status" },
                    { data: "" },
                ],
                columnDefs: [
                    {
                        className: "control",
                        orderable: !1,
                        targets: 0,
                        searchable: !1,
                        render: function (e, t, a, s) {
                            return "";
                        },
                    },
                    {
                        targets: -2,
                        render: function (e, t, a, s) {
                            var a = a.status,
                                n = {
                                    1: {
                                        title: "Current",
                                        class: "bg-label-primary",
                                    },
                                    2: {
                                        title: "Professional",
                                        class: " bg-label-success",
                                    },
                                    3: {
                                        title: "Rejected",
                                        class: " bg-label-danger",
                                    },
                                    4: {
                                        title: "Resigned",
                                        class: " bg-label-warning",
                                    },
                                    5: {
                                        title: "Applied",
                                        class: " bg-label-info",
                                    },
                                };
                            return void 0 === n[a]
                                ? e
                                : '<span class="badge ' +
                                      n[a].class +
                                      '">' +
                                      n[a].title +
                                      "</span>";
                        },
                    },
                    {
                        targets: -1,
                        title: "Actions",
                        orderable: !1,
                        searchable: !1,
                        render: function (e, t, a, s) {
                            return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow me-1" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-sm"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-sm"></i></a>';
                        },
                    },
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json",
                    paginate: {
                        next: '<i class="bx bx-chevron-right bx-18px"></i>',
                        previous: '<i class="bx bx-chevron-left bx-18px"></i>',
                    },
                },
                order: [[2, "desc"]],
                displayLength: 7,
                dom: '<"row"<"col-sm-12 col-md-6 ps-md-4"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                lengthMenu: [7, 10, 25, 50, 75, 100],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (e) {
                                return "Details of " + e.data().full_name;
                            },
                        }),
                        type: "column",
                        renderer: function (e, t, a) {
                            a = $.map(a, function (e, t) {
                                return "" !== e.title
                                    ? '<tr data-dt-row="' +
                                          e.rowIndex +
                                          '" data-dt-column="' +
                                          e.columnIndex +
                                          '"><td>' +
                                          e.title +
                                          ":</td> <td>" +
                                          e.data +
                                          "</td></tr>"
                                    : "";
                            }).join("");
                            return (
                                !!a &&
                                $('<table class="table"/><tbody />').append(a)
                            );
                        },
                    },
                },
            }),
            setTimeout(() => {
                $(".dataTables_filter .form-control").removeClass(
                    "form-control-sm"
                ),
                    $(".dataTables_length .form-select").removeClass(
                        "form-select-sm"
                    );
            }, 300);
    });

$(function () {
    var e,
        t = $(".dt-scrollableTable"),
        a = $(".dt-fixedheader"),
        s = $(".dt-fixedcolumns"),
        l = $(".dt-select-table");
    t.length &&
        t.DataTable({
            ajax: assetsPath + "json/table-datatable.json",
            columns: [
                { data: "full_name" },
                { data: "post" },
                { data: "email" },
                { data: "city" },
                { data: "start_date" },
                { data: "salary" },
                { data: "age" },
                { data: "experience" },
                { data: "" },
                { data: "" },
            ],
            columnDefs: [
                {
                    targets: -2,
                    render: function (e, a, t, s) {
                        var t = t.status,
                            l = {
                                1: {
                                    title: "Current",
                                    class: "bg-label-primary",
                                },
                                2: {
                                    title: "Professional",
                                    class: " bg-label-success",
                                },
                                3: {
                                    title: "Rejected",
                                    class: " bg-label-danger",
                                },
                                4: {
                                    title: "Resigned",
                                    class: " bg-label-warning",
                                },
                                5: {
                                    title: "Applied",
                                    class: " bg-label-info",
                                },
                            };
                        return void 0 === l[t]
                            ? e
                            : '<span class="badge ' +
                                  l[t].class +
                                  '">' +
                                  l[t].title +
                                  "</span>";
                    },
                },
                {
                    targets: -1,
                    title: "Actions",
                    searchable: !1,
                    orderable: !1,
                    render: function (e, a, t, s) {
                        return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="item-edit text-body"><i class="bx bx-edit bx-md"></i></a>';
                    },
                },
            ],
            scrollY: "300px",
            scrollX: !0,
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                paginate: {
                    next: '<i class="bx bx-chevron-right bx-18px"></i>',
                    previous: '<i class="bx bx-chevron-left bx-18px"></i>',
                },
            },
            initComplete: function (e, a) {
                t.find("tbody tr:first").addClass("border-top-0");
            },
        }),
        a.length &&
            ((a = a.DataTable({
                ajax: assetsPath + "json/table-datatable.json",
                columns: [
                    { data: "" },
                    { data: "id" },
                    { data: "id" },
                    { data: "full_name" },
                    { data: "email" },
                    { data: "start_date" },
                    { data: "salary" },
                    { data: "status" },
                    { data: "" },
                ],
                columnDefs: [
                    {
                        className: "control",
                        orderable: !1,
                        targets: 0,
                        responsivePriority: 3,
                        render: function (e, a, t, s) {
                            return "";
                        },
                    },
                    {
                        targets: 1,
                        orderable: !1,
                        render: function () {
                            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                        },
                        checkboxes: {
                            selectAllRender:
                                '<input type="checkbox" class="form-check-input">',
                        },
                        responsivePriority: 4,
                    },
                    { targets: 2, visible: !1 },
                    {
                        targets: 3,
                        render: function (e, a, t, s) {
                            var l = t.avatar,
                                r = t.full_name,
                                d = t.post;
                            return (
                                '<div class="d-flex justify-content-start align-items-center"><div class="avatar-wrapper"><div class="avatar me-2">' +
                                (l
                                    ? '<img src="' +
                                      assetsPath +
                                      "img/avatars/" +
                                      l +
                                      '" alt="Avatar" class="rounded-circle">'
                                    : '<span class="avatar-initial rounded-circle bg-label-' +
                                      [
                                          "success",
                                          "danger",
                                          "warning",
                                          "info",
                                          "dark",
                                          "primary",
                                          "secondary",
                                      ][Math.floor(6 * Math.random())] +
                                      '">' +
                                      (l = (
                                          ((l =
                                              (r = t.full_name).match(
                                                  /\b\w/g
                                              ) || []).shift() || "") +
                                          (l.pop() || "")
                                      ).toUpperCase()) +
                                      "</span>") +
                                '</div></div><div class="d-flex flex-column"><span class="emp_name text-truncate">' +
                                r +
                                '</span><small class="emp_post text-truncate text-muted">' +
                                d +
                                "</small></div></div>"
                            );
                        },
                        responsivePriority: 5,
                    },
                    { responsivePriority: 1, targets: 4 },
                    { responsivePriority: 2, targets: 6 },
                    {
                        targets: -2,
                        render: function (e, a, t, s) {
                            var t = t.status,
                                l = {
                                    1: {
                                        title: "Current",
                                        class: "bg-label-primary",
                                    },
                                    2: {
                                        title: "Professional",
                                        class: " bg-label-success",
                                    },
                                    3: {
                                        title: "Rejected",
                                        class: " bg-label-danger",
                                    },
                                    4: {
                                        title: "Resigned",
                                        class: " bg-label-warning",
                                    },
                                    5: {
                                        title: "Applied",
                                        class: " bg-label-info",
                                    },
                                };
                            return void 0 === l[t]
                                ? e
                                : '<span class="badge ' +
                                      l[t].class +
                                      '">' +
                                      l[t].title +
                                      "</span>";
                        },
                    },
                    {
                        targets: -1,
                        title: "Actions",
                        orderable: !1,
                        render: function (e, a, t, s) {
                            return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded bx-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div><a href="javascript:;" class="btn btn-icon item-edit"><i class="bx bx-edit bx-md"></i></a>';
                        },
                    },
                ],
                order: [[2, "desc"]],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                language: {
                    paginate: {
                        next: '<i class="bx bx-chevron-right bx-18px"></i>',
                        previous: '<i class="bx bx-chevron-left bx-18px"></i>',
                    },
                },
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (e) {
                                return "Details of " + e.data().full_name;
                            },
                        }),
                        type: "column",
                        renderer: function (e, a, t) {
                            t = $.map(t, function (e, a) {
                                return "" !== e.title
                                    ? '<tr data-dt-row="' +
                                          e.rowIndex +
                                          '" data-dt-column="' +
                                          e.columnIndex +
                                          '"><td>' +
                                          e.title +
                                          ":</td> <td>" +
                                          e.data +
                                          "</td></tr>"
                                    : "";
                            }).join("");
                            return (
                                !!t &&
                                $('<table class="table"/><tbody />').append(t)
                            );
                        },
                    },
                },
            })),
            window.Helpers.isNavbarFixed()
                ? ((e = $("#layout-navbar").outerHeight()),
                  new $.fn.dataTable.FixedHeader(a).headerOffset(e))
                : new $.fn.dataTable.FixedHeader(a)),
        s.length &&
            s.DataTable({
                ajax: assetsPath + "json/table-datatable.json",
                columns: [
                    { data: "full_name" },
                    { data: "post" },
                    { data: "email" },
                    { data: "city" },
                    { data: "start_date" },
                    { data: "salary" },
                    { data: "age" },
                    { data: "experience" },
                    { data: "status" },
                    { data: "id" },
                ],
                columnDefs: [
                    {
                        targets: -2,
                        render: function (e, a, t, s) {
                            var t = t.status,
                                l = {
                                    1: {
                                        title: "Current",
                                        class: "bg-label-primary",
                                    },
                                    2: {
                                        title: "Professional",
                                        class: " bg-label-success",
                                    },
                                    3: {
                                        title: "Rejected",
                                        class: " bg-label-danger",
                                    },
                                    4: {
                                        title: "Resigned",
                                        class: " bg-label-warning",
                                    },
                                    5: {
                                        title: "Applied",
                                        class: " bg-label-info",
                                    },
                                };
                            return void 0 === l[t]
                                ? e
                                : '<span class="badge ' +
                                      l[t].class +
                                      '">' +
                                      l[t].title +
                                      "</span>";
                        },
                    },
                    {
                        targets: -1,
                        title: "Actions",
                        searchable: !1,
                        orderable: !1,
                        render: function (e, a, t, s) {
                            return '<div class="d-inline-block"><a href="javascript:;" class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Details</a><a href="javascript:;" class="dropdown-item">Archive</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record"></i>Delete</a></div></div><a href="javascript:;" class="item-edit text-body"><i class="bx bx-edit bx-md"></i></a>';
                        },
                    },
                ],
                dom: '<"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-2 d-flex"f><"col-sm-12 col-md-10 d-none"i>>t',
                scrollY: 300,
                scrollX: !0,
                scrollCollapse: !0,
                paging: !1,
                info: !1,
                fixedColumns: !0,
                initComplete: function (e, a) {
                    s.find("tbody tr:first").addClass("border-top-0");
                },
            }),
        l.length &&
            l.DataTable({
                ajax: assetsPath + "json/table-datatable.json",
                columns: [
                    { data: "id" },
                    { data: "full_name" },
                    { data: "post" },
                    { data: "email" },
                    { data: "city" },
                    { data: "start_date" },
                    { data: "salary" },
                    { data: "status" },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        searchable: !1,
                        orderable: !1,
                        render: function () {
                            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                        },
                        checkboxes: {
                            selectRow: !0,
                            selectAllRender:
                                '<input type="checkbox" class="form-check-input">',
                        },
                    },
                    {
                        targets: -1,
                        render: function (e, a, t, s) {
                            var t = t.status,
                                l = {
                                    1: {
                                        title: "Current",
                                        class: "bg-label-primary",
                                    },
                                    2: {
                                        title: "Professional",
                                        class: " bg-label-success",
                                    },
                                    3: {
                                        title: "Rejected",
                                        class: " bg-label-danger",
                                    },
                                    4: {
                                        title: "Resigned",
                                        class: " bg-label-warning",
                                    },
                                    5: {
                                        title: "Applied",
                                        class: " bg-label-info",
                                    },
                                };
                            return void 0 === l[t]
                                ? e
                                : '<span class="badge ' +
                                      l[t].class +
                                      '">' +
                                      l[t].title +
                                      "</span>";
                        },
                    },
                ],
                order: [[1, "desc"]],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    paginate: {
                        next: '<i class="bx bx-chevron-right bx-18px"></i>',
                        previous: '<i class="bx bx-chevron-left bx-18px"></i>',
                    },
                },
                select: { style: "multi" },
            }),
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 200);
});
