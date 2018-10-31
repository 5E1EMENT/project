$(document).ready(function(){
    function fetch_data()
    {
        $.ajax({
            url:"/pages/php/chink/select.php",
            method:"POST",
            success:function(data){
                $('#live_data').html(data);
            }
        });
    }
    fetch_data();
    $(document).on('click', '#btn_add', function(){
        var nhole = $('#nhole').text();
        var nfield = $('#nfield').text();
        var x = $('#x').text();
        var y = $('#y').text();
        var z = $('#z').text();
        var a = $('#a').text();
        var b = $('#b').text();
        var d = $('#d').text();
        if(nhole == '')
        {
            alert("Enter hole number");
            return false;
        }
        if(nfield == '')
        {
            alert("Enter field number");
            return false;
        }
        if(x == '')
        {
            alert("Enter X coordinate");
            return false;
        }
        if(y == '')
        {
            alert("Enter Y coordinate");
            return false;
        }
        if(z == '')
        {
            alert("Enter Z coordinate");
            return false;
        }
        if(a == '')
        {
            alert("Enter Alfa angle");
            return false;
        }
        if(b == '')
        {
            alert("Enter B angle");
            return false;
        }
        if(d == '')
        {
            alert("Enter depth(d)");
            return false;
        }
        $.ajax({
            url:"/pages/php/chink/insert.php",
            method:"POST",
            data:{nhole:nhole, nfield:nfield, x:x, y:y,z:z,a:a,b:b,d:d},
            dataType:"text",
            success:function(data)
            {
                alert(data);
                fetch_data();
            }
        })
    });

    function edit_data(id, text, column_name)
    {
        $.ajax({
            url:"/pages/php/chink/edit.php",
            method:"POST",
            data:{id:id, text:text, column_name:column_name},
            dataType:"text",
            success:function(data){
                //alert(data);
                $('#result').html("<div class='alert alert-success'>"+data+"</div>");
            }
        });
    }
    $(document).on('blur', '.nhole', function(){
        var id = $(this).data("id1");
        var first_name = $(this).text();
        edit_data(id, first_name, "nhole");
    });
    $(document).on('blur', '.nfield', function(){
        var id = $(this).data("id2");
        var last_name = $(this).text();
        edit_data(id,last_name, "nfield");
    });
    $(document).on('blur', '.x', function(){
        var id = $(this).data("id3");
        var last_name = $(this).text();
        edit_data(id,last_name, "x");
    });
    $(document).on('blur', '.y', function(){
        var id = $(this).data("id4");
        var last_name = $(this).text();
        edit_data(id,last_name, "y");
    });
    $(document).on('blur', '.z', function(){
        var id = $(this).data("id5");
        var last_name = $(this).text();
        edit_data(id,last_name, "z");
    });
    $(document).on('blur', '.a', function(){
        var id = $(this).data("id6");
        var last_name = $(this).text();
        edit_data(id,last_name, "a");
    });
    $(document).on('blur', '.b', function(){
        var id = $(this).data("id7");
        var last_name = $(this).text();
        edit_data(id,last_name, "b");
    });
    $(document).on('blur', '.d', function(){
        var id = $(this).data("id8");
        var last_name = $(this).text();
        edit_data(id,last_name, "d");
    });
    $(document).on('click', '.btn_delete', function(){
        var id=$(this).data("id9");
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"/pages/php/chink/delete.php",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                    alert(data);
                    fetch_data();
                }
            });
        }
    });
});  