// show_data_table

var html,data;

$(document).ready(function(){   
    render();
});

function render(){
    html = '';

    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "show_cinema.php",
        data: {},
        success: function(response){
            // console.log("success" , response);
            data = response.result;

            for(var i=0; i<data.length; i++){
                html += `
                    <tr class="filter">
                        <td class="text-center">${i+1}</td>
                        <td>${data[i].c_title}</td>
                        <td>${data[i].c_description}</td>
                        <td>${data[i].c_contact_information}</td>
                        <td>${data[i].c_created_timestamp}</td>
                        <td>${data[i].c_latest_ticket_update_timestamp}</td>
                        <td>${data[i].c_status}</td>                        
                        <td class="text-center">
                            <div class="btn-control">
                                <div onclick="open_modal_edit(${i}, ${data[i].c_id})" class="btn btn-success">แก้ไข</div>
                                <div onclick="delete_cinema(${data[i].c_id})" class="btn btn-danger">ลบ</div>
                            </div>
                        </td>
                    </tr>
                `
            }
            $("#tbody_show").html(html);
        }, error: function(err) {
            // console.log("bad", err);
        }
    })
}


// Insert

function add(){
    $("#modal_insert").modal('show');
}

function add_data(){
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        url : 'insert_cinema.php',
        data: $("#add_data_flow").serialize(),
        success : function(response){
            if(response.result[0].code == 200){
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: 'บันทึกข้อมูลสำเร็จ'
                });
            }
            $("#modal_insert").modal('hide');              
            render();
        }
    })
}

// open_modal_update_show

function open_modal_edit(index,c_id){
    $("#modal_edit").modal('show');
    $("#c_title").val(data[index].c_title);
    $("#c_description").val(data[index].c_description);
    $("#c_contact_information").val(data[index].c_contact_information);
    $("#c_created_timestamp").val(data[index].c_created_timestamp); 
    $("#c_latest_ticket_update_timestamp").val(data[index].c_latest_ticket_update_timestamp);
    $("#c_status").val(data[index].c_status);                 
    id = c_id;
}

// modal_update_data

function update_cinema() {
        console.log("form submit successfully");
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "edit_cinema.php",
            data: {
                c_id:id,
                c_title: $("#c_title").val(),
                c_description: $("#c_description").val(),
                c_contact_information: $("#c_contact_information").val(),
                c_created_timestamp: $("#c_created_timestamp").val(),
                c_latest_ticket_update_timestamp: $("#c_latest_ticket_update_timestamp").val(),
                c_status: $("#c_status").val()           
            }, success: function(response) {
                console.log("good", response);
                if(response.result[0].code == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'แก้ไขข้อมูลสำเร็จ'
                    });
                    $('#modal_edit').modal('hide');
                    render();
                }
            }, error: function(err) {
                console.log("bad", err);
            }
        })
}

// delete

function delete_cinema(c_id){
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        url : 'del_cinema.php',
        data:{c_id:c_id},
        success:function(response){
            if(response.result[0].code == 200){
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'ลบข้อมูลสำเร็จ'
                    });
                render();
            }
        }
    })
}

// filter

$(document).ready(function(){
  $("#filter").on("keyup", function(){
    var value = $(this).val().toLowerCase();
    $(".filter").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});