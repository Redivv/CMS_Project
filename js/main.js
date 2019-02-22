$(document).ready(function(){
  main();
})

function main() {
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
}
