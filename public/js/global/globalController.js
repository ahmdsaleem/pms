var GlobalController = function () {

    return {
        variables: {
            methods:
                {
                    get:"GET",
                    post:"POST",
                    put:"PUT",
                    patch:"PATCH",
                    delete:"DELETE"
                }

        },
        functions: {
                ajaxSetup: function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                },
                ajaxPromise: function (data, URL, method) {
                    return $.ajax({
                        url: URL,
                        type: method,
                        dataType: "JSON",
                        data: data
                    });
                }

                }



            }
}();