var CustomerController=(function () {
    var routes={
        base: "customers/"
    };
    var table;

    return {

        loadCustomersDataTable: function () {
            table = $('#customers-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": "api/customers",
                "columns": [
                    {data: 'id', name: 'id', searchable:true},
                    {data: 'name', name: 'name',searchable:true},
                    {data: 'product_assigned', name: 'product_assigned',searchable:true},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        },

        filterData: function()
        {


                var form_data = $('#filter-customers-form').serialize();
                // table.clear();
                // table.destroy();
                var ajaxSetup = GlobalController.functions.ajaxSetup();
                $.when(ajaxSetup).done(function () {
                    var filterCustomers = GlobalController.functions.ajaxPromise(form_data, routes.base+"filter", GlobalController.variables.methods.get);
                    $.when(filterCustomers).done(function (data) {

                        for(var i=0;i<data.length;i++)
                        {
                            console.log(data[i].name);
                        }


                        // $('#customers-table').dataTable().fnClearTable();
                            //  for(var i=0;i<data.length;i++)
                            // $('#customers-table').dataTable().fnAddData(data[i]);
                    });
                    $.when(filterCustomers).fail(function (data) {

                    })
                });
        },



        bindEvents: function()
        {

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            cb(moment().subtract(29, 'days'), moment());
            $('#daterange').daterangepicker({
                "timePicker": true,
                startDate: moment().subtract(30, 'day'),
                endDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "linkedCalendars": false,
                "autoUpdateInput": true,
                "alwaysShowCalendars": true,
                "showWeekNumbers": true,
                "showDropdowns": true,
                "showISOWeekNumbers": true
            });

            $('#daterange').on('show.daterangepicker', function(ev, picker) {
                /*$('.daterangepicker select').selectpicker({
                    size: 10
                });*/
            });

            $('#products-filter').multiselect({
                enableCaseInsensitiveFiltering: true,
                enableFiltering: true,
                numberDisplayed: 3,
                nonSelectedText: 'Select a Product',
                buttonWidth: '400px',
                includeSelectAllOption: true,
                maxHeight: 300,

            });

            $('#products-filter').multiselect('selectAll',false);

            $('#filter-customers-form-submit').on('click',function () {
                event.preventDefault();
               CustomerController.filterData();
            });

            },


        init: function () {
            this.loadCustomersDataTable();
            this.bindEvents();

        }

    }

})();

$(document).ready( function () {
    CustomerController.init();

});
