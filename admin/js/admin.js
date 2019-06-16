$(document).ready(function(){
  main();
  check_ban();
});

function main(){
  $('.edit-btn').on('click',function(){         // po kliknięciu na przycisk do edycji wywołuje się prompt z pytaniem o nowy tytuł
    var cat_title = $(this).data('title');
    var id = $(this).data('id');
    var new_title = prompt("Edytuj Kategorię",cat_title);
    $.ajax({        // po wpisaniu nowego tytułu ajax wysyła dane do skryptu który to update-uje rekord w bazie
      url: "processing/ajax_category.php",
      data:{ id: id, new_title: new_title},
      type:"POST"
    }).success(function(data){     // po skończonej robocie strona jest przeładowywana
      location.reload();
    });
  });

  $('a.delete').on('click',function(event){     // to było...trudne dzbanie ;-;
    var you_sure = confirm("Czy na pewno chcesz usunąć?");
    if(you_sure != true){
      event.preventDefault();
    }
  });

  $('a.ban').on('click',function(event){
    var you_sure = confirm("Czy na pewno chcesz zablokować użytkownika na 1 dzień?");
    if(you_sure != true){
      event.preventDefault();
    }
  });

  $('a.reban').on('click',function(event){
    var you_sure = confirm("Czy na pewno chcesz odblokować użytkownika?");
    if(you_sure != true){
      event.preventDefault();
    }
  });
}

function check_ban(){
  $.ajax({     // request asks to check database for new comments and expects data to show in json
    url:"processing/fetch_ban.php",
    method:"POST",
    data:{check:'ban'},
    dataType:'json',
    success:function(data){
      if(data === 'redirect'){
        window.location.replace("http://port.loc/admin/logout.php");
      }
     }
   });

   setInterval(function(){
    check_ban();
   }, 50000);
}
