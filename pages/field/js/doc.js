$(document).ready(function(){


    function fetch_data()
    {
        $.ajax({
            url:"../../pages/php/field_doc/select.php",
            method:"POST",
            success:function(data){
                $('#live_data_doc').html(data);
            }
        });
    }
    // var btnDoc = $('.btn_doc');

    $(document).on('click', ".btn_doc", fetch_data);


    $(document).on('click', ".btn_doc", function () {
        var id = $(this).closest('tr').find('.namefield').attr("data-id2");//.attr("data-id")
        var namefield = $(this).closest('tr').find('.namefield').text();


        $.ajax({
            url: "../../pages/php/field_doc/select.php",
            method: "POST",
            data: {namefield: namefield, id:id},
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
            }
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





    $(document).on('click', '#btn_add_doc', function(){
        var nfield = $('#nfield').text();
        var doc = $('#document').text();
        var doc_desc = $('#doc_desc').text();
        if(nfield == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите номер месторождения'
            }).show();
            return false;
        }
        if(doc == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите ссылку на документ'
            }).show();
            return false;
        }
        if(doc_desc == '')
        {
            new Noty({
                theme: 'nest',
                type: 'error',
                layout: 'topRight',
                timeout: 3000,
                text: 'Введите описание документа'
            }).show();
            return false;
        }
        $.ajax({
            url:"../../pages/php/field_doc/insert.php",
            method:"POST",
            data:{nfield:nfield, doc:doc, doc_desc:doc_desc},
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
            }
        })
    });

    function edit_data(id, text, column_name)
    {

        $.ajax({
            url:"../../pages/php/field_doc/edit.php",
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
    $(document).on('blur', '.nfield', function(){
        var id = $(this).data("id1");
        var first_name = $(this).text();
        edit_data(id, first_name, "nfield");
    });
    $(document).on('blur', '.doc', function(){
        var id = $(this).data("id2");
        var last_name = $(this).text();
        edit_data(id,last_name, "doc");
    });
    $(document).on('blur', '.doc_desc', function(){
        var id = $(this).data("id3");
        var last_name = $(this).text();
        edit_data(id,last_name, "doc_desc");
    });

    $(document).on('click', '.btn_delete_doc', function(){
        var id=$(this).data("id4");
        if(confirm("Вы уверены, что хотите удалить документ?"))
        {
            $.ajax({
                url:"../../pages/php/field_doc/delete.php",
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
                }
            });
        }
    });
});