(function($) {

    var html = "";
    var trows = "";
    var tcols = new Array();
    $.fn.ajaxifyTable = function(options) {
        var output = "";
        var init = this;

        // This is the easiest way to have default options.
        var myParams = $.extend({
            // These are the defaults.
            debug: false,
            id: "tbl" + new Date().getTime(),
            class: "table table-striped table-no-bordered table-hover",
            process: false,
            server: false,
            tag: "",
            url: "#",
            endpoint: "#",
            type: "GET",
            data: {},
            cols: {},
            headers: {},
        }, options);

        var buttons = {
            view: '<a target="_blank" href="'+ myParams.endpoint +'" class="btn btn-simple btn-success btn-icon view"><i class="material-icons">remove_red_eye</i></a>',
            edit: '<a  target="_blank" href="'+ myParams.endpoint +'" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">edit</i></a>',
            del: '<a  target="_blank" href="'+ myParams.endpoint +'" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>',
        }

        $.ajax({
            url: myParams.url,
            async: false,
            processing: myParams.process,
            serverSide: myParams.server,
            type: myParams.type,
            data: myParams.data,
        }).always(function(data) {
            if (myParams.debug) {
                console.log(data);
            };

            $.each(data, function(index, val) {
                var tempData = {};
                trows += '<tr>';
                $.each(myParams.cols, function(index2, val2) {
                    if ($(this)[0].db == "actions") {
                        trows += '<td>';
                        $.each($(this)[0].actions, function(index, val) {
                            if (val in buttons) {
                                trows += buttons[val];
                            } else {
                                trows += val;
                            };
                        });
                        trows += '</td>';

                    } else {
                        trows += '<td>';
                        if ($(this)[0].db instanceof Array) {
                            $.each($(this)[0].db, function(index, val) {
                                trows += val[$(this)[0].db] + " ";
                            });
                        } else {
                            trows += val[$(this)[0].db];
                        };
                        if (typeof $(this)[0].html !== "undefined") {
                            trows += $(this)[0].html;
                        };
                        trows += '</td>';
                    };
                });

                trows += '</tr>';

            });

            var thtf = ""
            thtf += '<tr>';
            $.each(myParams.cols, function(index, val) {
                tcols.push({ 'data': $(this)[0].db, 'name': $(this)[0].db });
                thtf += '<th>' + $(this)[0].td + '</th>';
            });
            thtf += '</tr>';
            html += '<table id="' + myParams.id + '" class="' + myParams.class + '" cellspacing="0" width="100%" style="width:100%">';
            html += '<thead>';
            html += thtf;
            html += '</thead>';
            html += '<tfoot>';
            html += thtf;
            html += '</tfoot>';
            html += '<tbody>';
            html += trows;
            html += '</tbody>';
            html += '</table>';

            //Initialize Table
            init.html($(html));

            var table = $('#' + myParams.id).DataTable({
                "columns": tcols,
                dom: '<"top"<"row"<"col-xs-2 col-sm-2 col-md-2 col-lg-2 btn-sm"l><"col-xs-6 col-sm-6 col-md-6 col-lg-6 "B><"col-xs-4 col-sm-4 col-md-4 col-lg-4 "f>><"clear">>rt<"bottom"<"col-xs-6 col-sm-6 col-md-6 col-lg-6 "i><"col-xs-6 col-sm-6 col-md-6 col-lg-6 "p><"clear">>',
                buttons: [{
                    extend: 'colvis',
                    className: 'btn btn-default buttons-collection buttons-colvis btn-sm',
                    text: '<i class="fa fa-eye"></i>',
                    titleAttr: 'Column Visibility',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'copy',
                    text: '<i class="fa fa-files-o"></i>',
                    className: 'btn btn-default buttons-copy buttons-html5 btn-sm',
                    titleAttr: 'COPY',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'csv',
                    text: '<i class="fa fa-file-text-o"></i>',
                    className: 'btn btn-default buttons-csv buttons-html5 btn-sm',
                    titleAttr: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    className: 'btn btn-default buttons-excel buttons-html5 btn-sm',
                    titleAttr: 'EXCEL',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    className: 'btn btn-default buttons-pdf buttons-html5 btn-sm',
                    titleAttr: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    download: 'open',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    className: 'btn btn-default buttons-print btn-sm',
                    titleAttr: 'PRINT',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, ],
                colReorder: true,
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }

            })
            $(table.table().footer()).find('th').each(function() {
                var title = $(this).text();
                if (title == "Actions") {
                    return;
                }
                $(this).html('<input type="text" class="form-control" placeholder="&#x1F50D; ' + title + '" style="width:100%"/>');
                $(this).css("width", "50px");

            });
        });
        return null;

    };


    $.fn.ajaxifySTable = function(options) {
        var output = "";
        var init = this;

        // This is the easiest way to have default options.
        var myParams = $.extend({
            // These are the defaults.
            debug: false,
            id: "tbl" + new Date().getTime(),
            class: "table table-striped table-no-bordered table-hover",
            process: true,
            server: true,
            tag: "",
            url: "#",
            endpoint: "#",
            type: "GET",
            data: {},
            cols: {},
            headers: {},
        }, options);

        var buttons = {
            view: '<a target="_blank" href="'+ myParams.endpoint +'" class="btn btn-simple btn-success btn-icon view"><i class="material-icons">remove_red_eye</i></a>',
            edit: '<a  target="_blank" href="'+ myParams.endpoint +'" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">edit</i></a>',
            del: '<a  target="_blank" href="'+ myParams.endpoint +'" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>',
        }

        var thtf = ""
        thtf += '<tr>';
        $.each(myParams.cols, function(index, val) {
            if ($(this)[0].db == "actions") {
                var dc = "";
                $.each($(this)[0].actions, function(index, val) {
                    if (val in buttons) {
                        dc += buttons[val];
                    } else {
                        dc += val;
                    };
                });

                tcols.push({ 'data': null, "defaultContent": dc });
            } else {
    
                tcols.push({ 'data': $(this)[0].db, 'name': $(this)[0].db });
            }


            thtf += '<th>' + $(this)[0].td + '</th>';
        });
        thtf += '</tr>';
        html += '<table id="' + myParams.id + '" class="' + myParams.class + '" cellspacing="0" width="100%" style="width:100%">';
        html += '<thead>';
        html += thtf;
        html += '</thead>';
        html += '<tfoot>';
        html += thtf;
        html += '</tfoot>';
        html += '</table>';

        //Initialize Table
        init.html($(html));

        var table = $('#' + myParams.id).DataTable({
            processing: myParams.process,
            serverSide: myParams.server,
            ajax: {
                url: myParams.url,
                method: myParams.type
            },
            "columns": tcols,
            dom: '<"top"<"row"<"col-xs-2 col-sm-2 col-md-2 col-lg-2 btn-sm"l><"col-xs-6 col-sm-6 col-md-6 col-lg-6 "B><"col-xs-4 col-sm-4 col-md-4 col-lg-4 "f>><"clear">>rt<"bottom"<"col-xs-6 col-sm-6 col-md-6 col-lg-6 "i><"col-xs-6 col-sm-6 col-md-6 col-lg-6 "p><"clear">>',
            buttons: [{
                extend: 'colvis',
                className: 'btn btn-default buttons-collection buttons-colvis btn-sm',
                text: '<i class="fa fa-eye"></i>',
                titleAttr: 'Column Visibility',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'copy',
                text: '<i class="fa fa-files-o"></i>',
                className: 'btn btn-default buttons-copy buttons-html5 btn-sm',
                titleAttr: 'COPY',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'csv',
                text: '<i class="fa fa-file-text-o"></i>',
                className: 'btn btn-default buttons-csv buttons-html5 btn-sm',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'excel',
                text: '<i class="fa fa-file-excel-o"></i>',
                className: 'btn btn-default buttons-excel buttons-html5 btn-sm',
                titleAttr: 'EXCEL',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf-o"></i>',
                className: 'btn btn-default buttons-pdf buttons-html5 btn-sm',
                titleAttr: 'PDF',
                orientation: 'landscape',
                pageSize: 'A4',
                download: 'open',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                className: 'btn btn-default buttons-print btn-sm',
                titleAttr: 'PRINT',
                exportOptions: {
                    columns: ':visible'
                }
            }, ],
            colReorder: true,
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            },
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var title = $(column.footer()).text();
                    if (title == "Actions") {
                        return;
                    }
                    var input = '<input type="text" class="form-control" placeholder="&#x1F50D; ' + title + '" style="width:100%"/>';
                    $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function() {
                            if (myParams.type == "POST") {
                                column.search($(this).val()).draw();
                            } else {
                                column.search($(this).val(), false, false, true).draw();
                            };

                        });
                    $(this).css("width", "50px");
                });
            }
        })

        return null;

    };


}(jQuery));
