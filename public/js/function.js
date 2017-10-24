
//Aus anderem Projekt und angepasst
$(document).ready(function(){
    var url = "/show";

 // Löschen des Datensatzes, nach dem Klick auf Löschen   
 $('.delete-task').click(function(){
    var task_id = $(this).val();
    var txt;
    var r = confirm("'OK' drücken, wenn Sie sicher sind diesen Datensatz zu löschen!!!!");
    if (r == true) {
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
    }
    else{
        txt = "Abgebrochen";
    }
    });
    
    //Anzeigen der ausgewählten Aufgabe nach dem Click auf Bearbeiten
    $('.edit-task').click(function(){
        var task_id = $(this).val();

        $.get(url + '/' + task_id, function (data) {

            console.log(data);
            $('#task_id').val(data.id);
            $('#category').val(data.category_id);
            $('#heading').val(data.head_name);
            $('#done').val(data.ges_done);
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
                //Hier wird der Kategorie Text vorbereitet um ihn statt der ID, nach dem Speichern anzuzeigen 
                var selID=document.getElementById("category");
                var text=selID.options[selID.selectedIndex].text;
                
                if(data.ges_done == 1){
                    var pos ="erdedigt";
                    var task = '<tr id="task' + data.id + '" class="table-task-row">\n\
                            <td>' + text + '</td>\n\
                            <td>' + data.head_name + '</td>\n\
                            <td>' + pos + '</td>\n\
                            <td>' + data.created_at + '</td>';
                task += '<td id="button-td"><button class="edit-task" value="' + data.id + '">Bearbeiten</button>';
                task += '<button class="todo-task" value="' + data.id + '">Aufgaben anzeigen</button>';
                task += '<button class="delete-task"  value="' + data.id + '">Löschen</button></td></tr>';      
                }
                else{
                    var neg ="offen";
                    var task = '<tr id="task' + data.id + '" class="table-task-row">\n\
                            <td>' + text + '</td>\n\
                            <td>' + data.head_name + '</td>\n\
                            <td>'+ neg +'</td>\n\
                            <td>' + data.created_at + '</td>';
                task += '<td id="button-td"><button class="edit-task" value="' + data.id + '">Bearbeiten</button>';
                task += '<button class="todo-task" value="' + data.id + '">Aufgaben anzeigen</button>';
                task += '<button class="delete-task"  value="' + data.id + '">Löschen</button></td></tr>'; 
            }

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

//-----------------------------------------------------------------------------------------------------------------------------
//
//-----------------------------------------------------------------------------------------------------------------------------

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
//-----------------------------------------------------------------------------------------------------------------------------
//
//-----------------------------------------------------------------------------------------------------------------------------

$(document).ready(function(){
    var maxFields = 15;//Maximale Anzahl Eingabefelder 
    var wrapper = $(".add-inputs"); //Div Container
    var addButton = $(".more-inputs"); //Button zum hinzufügen
    var number = 1; //Start Anzahl
    $(addButton).click(function(e){
        e.preventDefault();
        if(number < maxFields){ //prüfen der maximalen anzahl der Eingabefelder
            number++; // Zähler für die Anzahl der Eingabefelder +1
            $(wrapper).append('<div id="remove"><input class="input-boxes"  type="text" name="newtask[]"  required/><button href="#" class="remove_field"><i class="material-icons">delete</i></i></button></div>');
        }
    });
    
    //zum entfernen der hinzugefügten Eingabefelder
    $(wrapper).on("click",".remove_field", function(e){
        e.preventDefault(); 
        $(this).parent('#remove').remove();
        number--;
    })
});
//-----------------------------------------------------------------------------------------------------------------------------
//
//-----------------------------------------------------------------------------------------------------------------------------
//Hier wird bei To-Do-Liste anlegen, die Aktivitätet der Dropdown oder dem Eingabefeld verändert
//Der ausgewählte Radio-Button deaktiviert das Element welches hinter dem zweiten Radio steht und gibt ihm eine andere Farbe. 
$(document).ready(function(){
    $("input[name='radiocategory']").change(function(e){
        if($(this).val() == '1') {
            $("#addCat").prop('disabled', true); 
            $("#addCat").css('background-color', 'rgba(193,193,193, 0.8)');
            $("#changeCat").prop("disabled", false);
            $("#changeCat").css('background-color', 'rgb(250, 255, 189)');
        } else if($(this).val() == '2') {
            $("#addCat").prop('disabled', false);
            $("#addCat").css('background-color', 'rgb(250, 255, 189)');
            $("#changeCat").prop("disabled", true);
            $("#changeCat").css('background-color', 'rgba(193,193,193, 0.8)');
        }
    });
});

