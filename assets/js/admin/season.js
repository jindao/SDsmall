'use strict';
// Class definition
var validator;
var SEASONTABLE = function() {
    // Private functions
    
    var demo = function() {

        var datatable = $('#seasonTable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                // type : 'local',
                // source : dataJSONArray,
                source: {

                    read: {
                        url: base_url+'admin/season/ajaxList',
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
                serverFiltering: false,
                serverSorting: false,
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
                    pagination: {
                        // page size select
                        pageSizeSelect: [5, 10, 20, 30, 50], // display dropdown to select pagination size. -1 is used for "ALl" option
                    },
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
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
				input: $('#generalSearch'),
			},

            // columns definition
            columns: [
                
                /*
                {
                field: 'RunID',
                title: 'Defunct',
                sortable: false,
                width: 60,
                template : function(){

                    return `
                    <span class="kt-switch kt-switch--brand kt-switch--sm">
                        <label>
                        <input type="checkbox" checked="checked" name="">
                        <span></span>
                        </label>
                        </span>
                        `;
                }

            },  
            
            {
                field: 'id',
                title: `ID`,

            },*/
            {
                field: 'season_name',
                title: `NAME`,
                sortable: true,
            }, {
                field: 'season_link',
                title: `LINK`,
                sortable: true,
            },
            {
                field: 'league_name',
                title: `LEAGUE NAME`,
            }, 
            /*
            {
                field: '',
                title: 'ACTION',
                sortable: false,
                width: 110,
                autoHide: false,
                template: function() {
                    return `
                      
                        <a href="#" class = "dayHead editTable kt-menu__link"><i class="la la-edit la-2x"></i>  </a>
                      
                      `;
                },
            }
            */
        ],
        });

    };

    var validateFunc = function(){
        validator = $( "#formCreateSeason" ).validate({
            // define validation rules
            rules: {
                season_name: {
                    required: true
                },
                season_link: {
                    required: true
                },
                league_id: {
                    required: true
                },
            },
            
            //display error alert on form submit  
            invalidHandler: function(event, validator) {             
            // var alert = $('#kt_form_1_msg');
            // alert.removeClass('kt-hidden').show();
            // KTUtil.scrollTo('#price', -200);
            },
    
            submitHandler: function (form) {
                console.log(form);
                form[0].submit(); // submit the form
            }
        });  
    }

    return {
        // Public functions
        init: function() {
            // init dmeo
            demo();
            validateFunc();

        },

    };
}();



jQuery(document).ready(function() {
    
    SEASONTABLE.init();
    $('#addSeason').on('click', function() {
        $('#seasonModal').modal('show');
    });
    $('#league_id').select2({
        placeholder: "Please select one"
    });

      
});