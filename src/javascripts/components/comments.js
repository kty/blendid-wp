$(function() {
  $('.comment-reply').on('click', function(event) {
    let comment = $(this).parent('.blog-comment')
    let form = comment.children('.comment-form')

    $('.blog-comment .comment-form').removeClass('d-block')
    form.addClass('d-block')
  })
});