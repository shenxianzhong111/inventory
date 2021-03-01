// var APP_URL = location.pathname.substr(0, location.pathname.lastIndexOf('/') + 1);


require.config({

    paths: {

        bootstrap: APP_URL + '/libs/bootstrap/3.3.5/js/bootstrap.min',
        lightbox: APP_URL + '/libs/jquery.lightbox/js/simple-lightbox.min',
        clipboard: APP_URL + '/libs/jquery.clipboard/clipboard.min',
        layer: APP_URL + '/libs/layer/3.0/layer',
        echarts: APP_URL + '/libs/echarts/4.2.1/echarts.min',
        jquery: APP_URL + '/libs/jquery/2.1.1/jquery.min',
        autocomplete: APP_URL + '/libs/jquery.autocomplete/jquery.autocomplete.min',
        scrollUp: APP_URL + '/libs/scrollUp/js/jquery.scrollUp.min',
        bootbox: APP_URL + '/libs/bootbox/bootbox.min',
        datetimepicker: APP_URL + '/libs/datetimepicker/jquery.datetimepicker',
        qrcode: APP_URL + '/libs/qrcode/qrcode.min',
        jqPaginator: APP_URL + '/libs/jqPaginator/1.1.0/jqPaginator.min',
        cxSelect: APP_URL + '/libs/jquery.cxselect/jquery.cxselect.min',
        yntree: APP_URL + '/libs/yntree/yntree',
        yntree: APP_URL + '/libs/yntree/yntree',
        bootstrapTable: APP_URL + '/libs/bootstrap-table/bootstrap-table.min',
        bootstrapTableColumns: APP_URL + '/libs/bootstrap-table/bootstrap-table-fixed-columns',

    },
    shim: {

        bootstrap: {
            deps: ['css!' + APP_URL + '/libs/bootstrap/3.3.5/css/bootstrap.min.css', 'css!' + APP_URL + '/libs/todc-bootstrap/todc-bootstrap.css']
        },
        autocomplete: {
            deps: ['jquery', 'css!' + APP_URL + '/libs/jquery.autocomplete/jquery.autocomplete.css']
        },
        lightbox: {
            deps: ['css!' + APP_URL + '/libs/jquery.lightbox/css/simplelightbox.min.css']
        },
        clipboard: {
            deps: ['jquery']
        },
        lightbox: {
            deps: ['jquery', 'css!' + APP_URL + '/libs/jquery.lightbox/css/simplelightbox.min.css']
        },
        scrollUp: {
            deps: ['jquery', 'css!' + APP_URL + '/libs/scrollUp/css/themes/pill']
        },
        datetimepicker: {
            deps: ['jquery', 'css!' + APP_URL + '/libs/datetimepicker/jquery.datetimepicker']
        },
        qrcode: {
            deps: ['jquery']
        },
        jqPaginator: {
            deps: ['jquery']
        },
        cxSelect: {
            deps: ['jquery']
        },
        yntree: {
            deps: ['css!' + APP_URL + '/libs/yntree/yntree.min.css']
        },
        bootstrapTable: {
            deps: ['css!' + APP_URL + '/libs/bootstrap-table/bootstrap-table.min.css']
        },
        bootstrapTableColumns: {
            deps: ['bootstrapTable', 'css!' + APP_URL + '/libs/bootstrap-table/bootstrap-table-fixed-columns.css']
        },

    },
    map: {
        '*': {
            css: APP_URL + '/libs/css.min.js'
        }
    }




});
