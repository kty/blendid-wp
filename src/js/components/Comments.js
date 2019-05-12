import Blendid from './Blendid'

class Comments extends Blendid {
  constructor() {
    super()

    this.init()
  }

  init() {
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
  }
}

export default Comments