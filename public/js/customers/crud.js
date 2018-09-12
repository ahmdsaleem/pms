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


        bindEvents: function()
        {
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            cb(moment().subtract(29, 'days'), moment());

            $('#daterange').daterangepicker({
                "timePicker": true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                "linkedCalendars": false,
                "autoUpdateInput": false,
                "alwaysShowCalendars": true,
                "showWeekNumbers": true,
                "showDropdowns": true,
                "showISOWeekNumbers": true
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
