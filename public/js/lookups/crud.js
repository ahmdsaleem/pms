var LookupController=(function () {
    var routes={
        base: "lookups/",
    };
    var projects_table;
    var project_lookup_table;

    return {

        loadProjectsDataTable: function () {
            projects_table = $('#projects-lookup-table').DataTable({
                "processing": true,
                "serverSide": true,
                "searchable": true,
                "ajax": "api/lookup/projects",
                "columns": [
                    {data: 'id', name: 'id', searchable:true},
                    {data: 'name', name: 'name',searchable:true},
                    {data: 'platform_assigned', name: 'platform_assigned',searchable:true},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        },

        loadProjectLookupDataTable : function()
        {
            project_lookup_table = $('#project-lookup').DataTable();
        },


        bindEvents: function()
        {

        },


        init: function () {
            this.loadProjectsDataTable();
            this.loadProjectLookupDataTable();
            this.bindEvents();

        }

    }

})();

$(document).ready( function () {
    LookupController.init();
});
