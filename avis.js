$(document).ready(function() {
  loadfiltredComments()



function loadfiltredComments() {
    $.ajax({
      type: 'GET',
      url: 'comments/get_filtred_coments.php',
      dataType: 'json',
      success: function(comments) {
        let commentsContainer = $('.comments');
        commentsContainer.empty();
        for (let i = 0; i < comments.length; i++) {
          let comment = comments[i];
          let stars = '';
          for (let j = 0; j < comment.rating; j++) {
            stars += '★';
          }
        let commentElement = 
          '<div class="comment">' +
            '<p class="nickname">' + comment.nickname + '</p>' +
            '<p class="comment-text">' + comment.text + '</p>' +
            '<p class="rating">' + stars + '</p>' +
          '</div>';
        commentsContainer.append(commentElement);
      }
    }
  });
}

});
