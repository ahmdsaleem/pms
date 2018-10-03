var CustomerController=(function () {
    var routes={
        base: "customers/"
    };

    return {

        loadCustomersDataTable: function () {
            var daterange = $('#daterange').val();
            var projects = $('#projects-filter').val();
            $('#customers-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax":{
                    url:"api/customers",
                    type:"GET",
                    data: {
                        daterange:daterange,
                        projects:projects
                    }

                    }
                ,
                "columns": [
                    {data: 'id', name: 'id', searchable:true},
                    {data: 'name', name: 'name',searchable:true},
                    {data: 'email', name: 'email',searchable:true},
                    {data: 'state', name: 'state',searchable:true},
                    {data: 'country_code', name: 'country_code',searchable:true},
                    {data: 'project_assigned', name: 'project_assigned',searchable:true},
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
                startDate: moment().subtract(7, 'day'),
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

            $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                $('#customers-table').DataTable().destroy();
                CustomerController.loadCustomersDataTable();
            });

            $('#projects-filter').multiselect({
                enableCaseInsensitiveFiltering: true,
                enableFiltering: true,
                numberDisplayed: 3,
                nonSelectedText: 'Select a Project',
                buttonWidth: '400px',
                includeSelectAllOption: true,
                maxHeight: 300,

            });

            $('#projects-filter').multiselect('selectAll',false);

            $('#filter-customers-form-submit').on('click',function () {
                event.preventDefault();
                $('#customers-table').DataTable().destroy();
                CustomerController.loadCustomersDataTable();

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
