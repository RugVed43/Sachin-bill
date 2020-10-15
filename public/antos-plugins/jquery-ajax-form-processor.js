(function($) {

    $.fn.dataForm = function(options) {
        var output = null;

        // This is the easiest way to have default options.
        var myParams = $.extend({
            // These are the defaults.
            url: "http://www.google.com",
            debug: false,
            type: "POST",
            data: {},
            notify: {
                icon: "notifications",
                message: "Saved Data Successfully !",
                from: "bottom",
                align: "left",
                type: "success",
            },
        }, options);

        if (myParams.debug) {
            console.log(options);
        };
        $.ajax({
            url: myParams.url,
            type: myParams.type,
            data: myParams.data,
        }).always(function(data) {
            if (myParams.debug) {
                console.log(data);
            };
            output = data;
            if (myParams.notify) {
                $.notify({
                    icon: myParams.notify.icon,
                    message: myParams.notify.message

                }, {
                    type: myParams.notify.type,
                    timer: 3000,
                    placement: {
                        from: myParams.notify.from,
                        align: myParams.notify.align
                    }
                });
            };
        });


        return output;

    };
    $.fn.fileForm = function(options) {
        var output = null;

        // This is the easiest way to have default options.
        var myParams = $.extend({
            // These are the defaults.
            tag: "",
            url: "http://www.google.com",
            debug: false,
            model: "",
            headers: {
                folder: null,
                model: null,
                mid: null,
            },
            notify: {
                icon: "notifications",
                message: "Saved Data Successfully !",
                from: "bottom",
                align: "left",
                type: "success",
            },
        }, options);
        if (myParams.debug) {
            console.log(options);
        };

        var file_data = myParams.tag.prop('files')[0];
        var form_data = new FormData();
        if (myParams.debug) {
            console.log(file_data, form_data, myParams.tag.prop('name'));
        };
        console.log(myParams.notify);
        if (typeof file_data != "undefined") {
            form_data.append(myParams.tag.prop('name'), file_data);
            $.ajax({
                url: myParams.url,
                cache: false,
                contentType: false,
                processData: false,
                headers: myParams.headers,
                data: form_data,
                type: 'POST',
                success: function(filedata) {
                    if (myParams.debug) {
                        console.log(filedata);
                    };
                    output = filedata;
                    if (myParams.notify) {
                        $.notify({
                            icon: myParams.notify.icon,
                            message: myParams.notify.message

                        }, {
                            type: myParams.notify.type,
                            timer: 3000,
                            placement: {
                                from: myParams.notify.from,
                                align: myParams.notify.align
                            }
                        });
                    };
                }
            });
        };


        return output;

    };

    $.fn.processForm = function(options) {
        var output = {};
        var ajaxData = null;

        // This is the easiest way to have default options.
        var myParams = $.extend({
            // These are the defaults.
            url: "http://www.google.com",
            fileurl: "http://www.google.com",
            debug: false,
            type: "POST",
            tag: null,
            data: {},
            headers: {
                folder: null,
                model: null,
                mid: null,
            },
            notify: {
                icon: "notifications",
                message: "Saved Data Successfully !",
                from: "bottom",
                align: "left",
                type: "success",
            },
        }, options);

        if (myParams.debug) {
            console.log(options);
        };
        $.each(myParams.tag.find('textarea, input[type!="file"], select'), function(index, val) {
            if ($(this).prop('type') == "radio" && $(this).prop('checked') == true) {
                myParams.data[$(this).prop('name')] = $(this).val();
            };
            if ($(this).prop('type') == "checkbox" && $(this).prop('checked') == true) {
                myParams.data[$(this).prop('name')] = $(this).val();
            };
            if ($(this).prop('type') == "textarea" || $(this).prop('type') == "text" || $(this).is('select') || $(this).prop('type') == "password") {
                myParams.data[$(this).prop('name')] = $(this).val();
            };
        });
        if (myParams.debug) {
            console.log(myParams.data);
        };
        $.ajax({
            url: myParams.url,
            type: myParams.type,
            data: myParams.data,
        }).always(function(data) {
            if (myParams.debug) {
                console.log(data);
            };
            output['formdata'] = data;
            // myParams.headers['id'] = output.id;

            $.each(myParams.tag.find('input[type="file"]'), function(index, val) {
                var file_data = $(this).prop('files')[0];
                var form_data = new FormData();
                var myUrl = myParams.fileurl;
                if (typeof $(this).data('url') != 'undefined') {
                    var myUrl = $(this).data('url');
                };
                myParams.headers['folder'] = $(this).data('folder');
                myParams.headers['model'] = $(this).data('model');
                myParams.headers['mid'] = data.id;
                if (myParams.debug) {
                    console.log(file_data, form_data, myParams.tag.prop('name'));
                };
                if (typeof file_data != "undefined") {
                    form_data.append($(this).prop('name'), file_data);
                    $.ajax({
                        url: myUrl,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: myParams.headers,
                        data: form_data,
                        type: 'POST',
                        success: function(filedata) {
                            if (myParams.debug) {
                                console.log(filedata);
                            };
                            output['filedata'] = filedata;
                        }
                    });
                };

            });
            if (myParams.notify) {
                $.notify({
                    icon: myParams.notify.icon,
                    message: myParams.notify.message
                }, {
                    type: myParams.notify.type,
                    timer: 3000,
                    placement: {
                        from: myParams.notify.from,
                        align: myParams.notify.align
                    }
                });
            };
        });

        setTimeout(function() {
            return output;
        }, 2000)

    };
}(jQuery));
