'use strict';
$(document).ready(function(){
  main();
  check_ban();
})

function main() {

  // Search
  $('button[name=search_btn]').on('click',function(event){
      event.preventDefault();       // przekazanie dowolnego parametru przy nakładaniu nasłuchawicza - preventDefault powstrzymuje domyślną akcję przy włączeniu nasłuchwiacza np. click na <a> nie przenosi na inną stronę
      var search_content = $('input[name=search]').val();
      console.log(search_content);
      $.post(
        "includes/search.php",
        {
          wanted: search_content
        },
        function(data){
          $('#blog_posts').html(data);
        }
      )
  });
  // /.Search

  // Post
  $('textarea[name=comment]').keyup(function(){
    var value = $(this).val();
    if($.trim(value) != ''){$('button[name=comment_btn]').prop('disabled',false);}else{$('button[name=comment_btn]').prop('disabled',true);}
  })

  $('button[name=comment_btn]').on('click',function(event){
    event.preventDefault();
    var value = $('textarea[name=comment]').val();
    var author = $('textarea[name=comment]').data('author');
    var post = $('textarea[name=comment]').data('post');
    var img = $('#user_avatar').attr('src');
    $.ajax({
      url: '../admin/processing/add_comment.php',
      data: {content:value, author:author, post_id:post, img:img, },
      type:"POST",
      dataType:"text",
      success: function(data){
        $('#comment_content').val('');
        $('#new_comment').append(data);
        $('#comment_error_block').html('Dziękujemy za dodanie komentarza');
      }
    })
  });

  $('span.response').on('click',function(){
    $('#response_block').remove();
    $('#edit_block').remove();
    var form = '<div id="response_block"><form role="form"><div class="form-group"><input id="response" type="text" class="form-control" placeholder="Zostaw Odpowiedź" name="name"></div><button type="submit" name="response_btn" class="btn btn-primary" disabled>Wyślij</button> <button type="submit" name="delete_response_btn" class="btn btn-secondary">Anuluj</button></form></div><div class = "new_response"></div>';
    var params = getSearchParameters();
    var post = params['id'];
    var comment = $(this).data('comment');
    var img = $('#user_avatar').attr('src');
    $(this).parent().parent().append(form);
    $('#response').focus();

    $('#response').keyup(function(){
      var value = $(this).val();
      if($.trim(value) != ''){$('button[name=response_btn]').prop('disabled',false);}else{$('button[name=response_btn]').prop('disabled',true);}
    })

    $('button[name=delete_response_btn]').on('click',function(event){
      event.preventDefault();
      $('#response_block').remove();
    });

    $('button[name=response_btn]').on('click',function(event,post2 = post,comment2 = comment,img2 = img){
      event.preventDefault();
      var value = $('#response').val();
      $.ajax({
        url: '../admin/processing/add_comment.php',
        data: {content:value, img:img2, comment:comment2, post_id:post2},
        type:"POST",
        dataType:"text",
        success: function(data){
          $('#response_block').html("<div style='color:green;'>Dziękujemy za wysłanie odpowiedzi</div>");
          $('#response_block').next().html(data);
        }
      })
    });
  });

  $('span.edit').on('click',function(){
    $('#edit_block').remove();
    $('#response_block').remove();
    var old_content = $(this).parent().parent().prev().text();
    var form = '<div id="edit_block"><form role="form"><div class="form-group"><input id="edit" type="text" value="'+old_content+'" class="form-control" name="name"></div><button type="submit" name="edit_btn" class="btn btn-primary" disabled>Wyślij</button> <button type="submit" name="delete_edit_btn" class="btn btn-secondary">Anuluj</button></form></div>';
    var comment = $(this).data('comment');
    $(this).parent().parent().append(form);
    $('#edit').select();

    $('#edit').keyup(function(){
      var value = $(this).val();
      if($.trim(value) != ''){$('button[name=edit_btn]').prop('disabled',false);}else{$('button[name=edit_btn]').prop('disabled',true);}
    });

    $('button[name=delete_edit_btn]').on('click',function(event){
      event.preventDefault();
      $('#edit_block').remove();
    });

    $('button[name=edit_btn]').on('click',function(event,comment_id = comment){
      event.preventDefault();
      var value = $('#edit').val();
      var params = getSearchParameters();
      var post = params['id']
      $.ajax({
        url: '../admin/processing/edit_comment.php',
        data: {content:value, comment_id:comment_id, post_id:post},
        type:"POST",
        dataType:"text",
        success: function(data){
          $('#edit_block').parent().prev().html(data);
          $('#edit_block').html("<div style='color:green;'>Zedytowano</div>");
        }
      });
    });
  });

  $('span.delete').on('click',function(){
    var confirm_delete = confirm('Czy na pewno chcesz usunąć komentarz?');
    if(confirm_delete === true){
      var comment_id = $(this).data('comment');
      var params = getSearchParameters();
      var post = params['id'];
      var delete_btn = $(this);
      $.ajax({
        url: '../admin/processing/delete_comment.php',
        data: {comment_id:comment_id, post_id:post},
        type:"POST",
        dataType:"text",
        success: function(data){
          $(delete_btn).parent().parent().parent().parent().remove();
        }
      })
    }
  });
  // /.Post

}

function getSearchParameters() {
      var prmstr = window.location.search.substr(1);
      return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
    var params = {};
    var prmarr = prmstr.split("&");
    for ( var i = 0; i < prmarr.length; i++) {
        var tmparr = prmarr[i].split("=");
        params[tmparr[0]] = tmparr[1];
    }
    return params;
}

function check_ban(){
  $.ajax({     // request asks to check database for new comments and expects data to show in json
    url:"../admin/processing/fetch_ban.php",
    method:"POST",
    data:{check:'ban'}
   });

   setInterval(function(){
    check_ban();
   }, 50000);
}
