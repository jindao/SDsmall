'use strict';
// Class definition
KTDatatableInvoice
var KTDatatableInvoice = function() {
    // Private functions

    var demo = function() {

        var datatable = $('.kt-datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                // type : 'local',
                // source : dataJSONArray,
                source: {

                    read: {
                        url: '/SDmall/invoice.php',
                        map: function(raw) {

                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {

                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },

                },
                pageSize: 10, // display 20 records per page
                serverPaging: false,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false, // display/hide footer

                class : 'table-striped myFavouriteTable',
                customScrollbar : false,
            },
            // toolbar
            toolbar: {
                // toolbar placement can be at top or bottom or both top and bottom repeated
                placement: ['top', 'bottom'],

                // toolbar items
                items: {
                    // pagination
                    // pagination: {
                    //     // page size select
                    //     pageSizeSelect: [5, 10, 20, 30, 50], // display dropdown to select pagination size. -1 is used for "ALl" option
                    // },
                },
                icons: {
                    sort: {
                        asc: 'la la-arrow-up',
                        desc: 'la la-arrow-down'
                    },
                    rowDetail: {
                        expand: 'fa fa-caret-down',
                        collapse: 'fa fa-caret-right'
                    },
                }
            },

            rows: {
                autoHide: false,
                afterTemplate: function (row, data, index) {
                    // if(index) return ;
                    var cel = $(":first", row);

                    cel.on('click', function(){
                        var span = $(":first", cel);
                        span = $(":first", span);
                        if(span.hasClass('la-star-o')) {
                            span.removeClass('la-star-o');
                            span.addClass('la-star');
                        } else {
                            span.removeClass('la-star');
                            span.addClass('la-star-o');
                        }


                    });
                }
            },

            // column sorting
            sortable: true,

            pagination: false,



            // columns definition
            columns: [{
                field: 'RecordID',
                title: '#',
                sortable: false,
                width: 20,
                selector: {
                    class: 'kt-checkbox--solid '
                },
                textAlign: 'center',
            }, {
                    field: 'invoice',
                    title: `Invoice<i class = "flaticon2-sort"></i>`,

                }, {
                    field: 'amount',
                    title: `Amount<i class = "flaticon2-sort"></i>`,

                }, {
                    field: 'issued',
                    title: `Issued<i class = "flaticon2-sort"></i>`,

                }, {
                    field: 'due',
                    title: `Due<i class = "flaticon2-sort"></i>`,


                }, {
                    field: 'status',
                    title: `Status<i class = "flaticon2-sort"></i>`,
                    template: function() {
                        return '<span class="text-green">Paid </span>';
                    },
                }, {
                    field: 'asd',
                    title: 'PDF ',
                    sortable: false,
                    width: 110,
                    autoHide: false,
                    template: function() {
                        return '<a href = "#"><span class="viewsample">View </span></a>';
                    },
                }],
        });

    };


    return {
        // Public functions
        init: function() {
            // init dmeo
            demo();

        },

    };
}();


jQuery(document).ready(function() {
    KTDatatableInvoice.init();

});