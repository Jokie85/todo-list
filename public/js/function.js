
//Aus anderem Projekt und angepasst
$(document).ready(function(){
    var url = "/show";
 // Löschen des Datensatzes, nach dem Klick auf Löschen   
 $('.delete-task').click(function(){
        var task_id = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "DELETE",
            url: url + '/' + task_id,
            success: function (data) {
                console.log(data);

                $("#task" + task_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
    //Anzeigen der ausgewählten Aufgabe nach dem Click auf Bearbeiten
    $('.edit-task').click(function(){
        var task_id = $(this).val();

        $.get(url + '/' + task_id, function (data) {

            console.log(data);
            $('#task_id').val(data.id);
            $('#category').val(data.category);
            $('#heading').val(data.heading);
            $('#description').val(data.description);
            $('#done').val(data.done);
            $('#btn-save').val("update");

            $('#thisModal').modal('show');
        }) 
    });
     // Bearbeiten des Existierenden Datensatzes
        $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
            category: $('#category').val(),
            heading: $('#heading').val(),
            description: $('#description').val(),
            done: ( ($("#done")[0].checked == true) ? 1 : 0 ),
        }

        //Hie wird bestimmt das bei den Routen [update=PUT] verwendet wird
        var state = $('#btn-save').val();

        var task_id = $('#task_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //Um einen bestehenden Datensatz zu ändern
            my_url += '/' + task_id;
        }
  
        console.log(formData);
      
        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var task = '<tr id="task' + data.id + '" class="table-task-row">\n\
                            <td>' + data.category + '</td>\n\
                            <td>' + data.heading + '</td>\n\
                            <td>' + data.description + '</td>\n\
                            <td>' + data.done + '</td>\n\
                            <td>' + data.created_at + '</td>';
                task += '<td><button class="edit-task" value="' + data.id + '">Bearbeiten</button>';
                task += '<button class="delete-task"  value="' + data.id + '">Löschen</button></td></tr>';
                
                $("#task" + task_id).replaceWith( task );
                $('#form-task').trigger("reset");
                $('#thisModal').modal('hide');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});

//Modal Dialog-Fenster Frei aus dem Netz
$(function(){

    var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

      $('a[data-modal-id]').click(function(e) {
        e.preventDefault();
        $("body").append(appendthis);
        $(".modal-overlay").fadeTo(500, 0.9);
        //$(".js-modalbox").fadeIn(500);
        var modalBox = $(this).attr('data-modal-id');
        $('#'+modalBox).fadeIn($(this).data());
      });  

    $(".js-modal-close, .modal-overlay").click(function() {
      $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
      });
    });
    
    $(window).resize(function() {
      $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 4,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
      });
    });
    $(window).resize(); 
});