$(document).ready(function(){


    function fetch_data()
    {
        $.ajax({
            url:"../../pages/php/core/select.php",
            method:"POST",
            success:function(data){
                $('#live_data_core').html(data);

            }
        });
    }
    // var btnDoc = $('.btn_doc');

    //$(document).on('click', ".btn_doc", fetch_data);


    $(document).on('click', ".btn_core", function () {
        var idhole = $(this).closest('tr').find('.idhole').attr("data-id2");//.attr("data-id")

        //var nfield = $(this).closest('tr').find('.nfield').text();
        $('#live_data_core').stop().slideUp(400).stop().slideDown(400);
       
        $.ajax({
            url: "../../pages/php/core/select.php",
            method: "POST",
            data: {idhole: idhole },
            dataType:"html"
        }).done(function(data)
        {
             console.log(idhole);
            $('#live_data_core').html(data);

            $(document).on('click', ".live_data-close", function show () {
                console.log(1);
                $('#live_data_core').slideUp(400);
            });
            // new Noty({
            //     theme: 'nest',
            //     type: 'success',
            //     layout: 'topRight',
            //     timeout: 50000,
            //     text: data
            // }).show();
            //fetch_data();
        })

        // $.ajax({
        //     url: "../../pages/php/field_doc/select.php?namefield=" + namefield,
        //     method: "GET",
        //
        //     dataType:"text",
        //     success:function(data)
        //         {
        //             new Noty({
        //                 theme: 'nest',
        //                 type: 'success',
        //                 layout: 'topRight',
        //                 timeout: 5000,
        //                 text: data
        //             }).show();
        //             fetch_data();
        //         }
        // })




    });





    $(document).on('click', '#btn_add_core', function(){
        var nhole = $('#nhole').text();
        var ncore = $('#ncore').text();
        var l = $('#l').text();
        if(nhole == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите номер скважины'
            }).show();
            return false;
        }
        if(ncore == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите номер керна'
            }).show();
            return false;
        }
        if(l == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите длину керна'
            }).show();
            return false;
        }
        $.ajax({
            url:"../../pages/php/core/insert.php",
            method:"POST",
            data:{nhole:nhole, ncore:ncore, l:l},
            dataType:"text",
            success:function(data)
            {
                new Noty({
                    theme: 'nest',
                    type: 'success',
                    layout: 'topRight',
                    timeout: 5000,
                    text: data
                }).show();
                fetch_data();
                $('#live_data_core').slideUp(400);
                // $('#live_data_doc').slideDown(400);
            }
        })
    });

    function edit_data(id, text, column_name)
    {
        $.ajax({
            url:"../../pages/php/core/edit.php",
            method:"POST",
            data:{id:id, text:text, column_name:column_name},
            dataType:"text",
            success:function(data){
                //alert(data);
                //$('#result').html("<div class='alert alert-success'>"+data+"</div>");
                new Noty({
                    theme: 'nest',
                    type: 'info',
                    layout: 'topRight',
                    timeout: 4000,
                    text: data
                }).show();
            }
        });
    }
    $(document).on('blur', '.nhole', function(){
        var id = $(this).data("id1");
        var first_name = $(this).text();
        edit_data(id, first_name, "nhole");
    });
    $(document).on('blur', '.ncore', function(){
        var id = $(this).data("id2");
        var last_name = $(this).text();
        edit_data(id,last_name, "ncore");
    });
    $(document).on('blur', '.l', function(){
        var id = $(this).data("id3");
        var last_name = $(this).text();
        edit_data(id,last_name, "l");
    });

    $(document).on('click', '.btn_delete_core', function(){
        var id=$(this).data("id4");
        if(confirm("Вы уверены, что хотите удалить документ?"))
        {
            $.ajax({
                url:"../../pages/php/core/delete.php",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                    new Noty({
                        theme: 'nest',
                        type: 'success',
                        layout: 'topRight',
                        timeout: 3000,
                        text: data
                    }).show();
                    fetch_data();
                    $('#live_data_core').slideUp(400);
                }
            });
        }
    });
});
$(document).ready(function(){




});