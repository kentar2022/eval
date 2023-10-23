$(document).ready(function() {
  loadComments(); 


  function loadComments() {
    $.ajax({
      type: 'GET',
      url: 'get_filtred_coments.php',
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
            '</div>';
          commentsContainer.append(commentElement);
        }
      }
    });
  }
});
