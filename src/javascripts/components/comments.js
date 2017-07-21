import App from './App'

class Comments extends App {
  constructor(props) {
    super(props)
  }

  init() {
    console.log('init comments')

    $('.comment-reply').on('click', function(event) {
      event.preventDefault();

      let reply_btn = $(this)
      let comment = $(this).parent('.blog-comment')
      let form = comment.children('.comment-form')

      $('.blog-comment .comment-reply').removeClass('hide')
      $('.blog-comment .comment-form').removeClass('show')

      reply_btn.addClass('hide')
      form.addClass('show')
    })

    $('.comment-cancel').on('click', function(event) {
      event.preventDefault();

      let comment = $(this).parents('.blog-comment')
      let form = comment.children('.comment-form')
      let reply_btn = comment.find('.comment-reply')

      $('.blog-comment .comment-form').removeClass('show')

      reply_btn.removeClass('hide')
      form.removeClass('show')
    })
  }
}

export default Comments