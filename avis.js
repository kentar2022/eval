$(document).ready(function() {
  loadComments();

  $('#comment-form').submit(function(e) {
    e.preventDefault();
    let formData = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'save_data.php',
      data: formData,
      success: function(response) {
        loadComments();
      }
    });
  });


//Cette fonction suprime le commentaire 
  $('.comments').on('click', '.delete-comment', function() {
    let commentId = $(this).data('commentid');
    $.ajax({
      type: 'POST',
      url: 'delete_comment.php',
      data: { commentId: commentId },
      success: function(response) {
        if (response.success) {
          
          $(`.comment.${commentId}`).remove();
        } else {
          alert('Erreur lors de la suppression du commentaire.');
        }
      }
    });
  });

//Cette fonc ajoute le commentaire sur la page d'accueil, et le suprime de le page de rédigement de commentaire
$('.comments').on('click', '.add-comment', function() {
  let commentId = $(this).data('commentid');
  $.ajax({
    type: 'POST',
    url: 'add_comment.php',
    data: { commentId: commentId },
    success: function(response) {
      if (response.success) {
        
        $(`.comment.${commentId}`).remove();
        alert("Commentaire ajouté avec succès à la page d'accueil.");
      } else {
        alert("Erreur. Le commentaire n'a pa pu être ajouté");
      }
      
      loadComments();
    }
  });
});


  function loadComments() {
    $.ajax({
      type: 'GET',
      url: 'get_comments.php',
      dataType: 'json',
      success: function(comments) {
        let commentsContainer = $('.comments');
        commentsContainer.empty();
        for (let i = 0; i < comments.length; i++) {
          let comment = comments[i];
          let commentElement = '<div class="comment ' + comment.id + '">' +
            '<p>' + comment.text + '</p>' +
            '<p>' + comment.nickname + '</p>' +
            '<p>Rating: ' + comment.rating + '</p>' +
            '<button class="add-comment" data-commentid="' + comment.id + '">Ajouter (' + comment.id + ')</button>' +
            '<button class="delete-comment" data-commentid="' + comment.id + '">Supprimer (' + comment.id + ')</button>' +
            '</div>';
          commentsContainer.append(commentElement);
        }
      }
    });
  }
});
