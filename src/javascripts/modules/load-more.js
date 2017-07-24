class LoadMore {
  constructor(el) {
    let self = this

    this.el = $(el)
    this.data = this.el.data()
    this.currentScroll = 0
    this.loadCount = 0

    this.settings = {
      loadTimes: 3
    }

    this.state = {
      loading: false,
      clicked: false,
      end: false
    }

    $(window).on('scroll', function() {
      if (self.state.clicked) return

      self.currentScroll = $(window).scrollTop()

      let loadOffset = $(document).height() / 3

      if (self.currentScroll > ($(document).height() - $(window).height()) - loadOffset) {
        self.loadMore()
      }
    })

    this.el.bind('click', function(event) {
      event.preventDefault()

      self.clickHandler()
    })

    this.loadMore()
  }

  clickHandler(event) {
    this.state.clicked = true

    this.loadMore()

    this.state.clicked = false
  }

  loadMore() {
    if (this.state.loading || this.state.end) return

    this.loadCount++

    if (this.loadCount > this.settings.loadTimes) return

    this.container = $('.load-more-posts')
    this.offset = $('.load-more-posts .tease').length

    this.state.loading = true

    this.makeRequest()
  }

  makeRequest() {
    let self = this

    self.data.action = 'load_posts'
    self.data.offset = self.offset

    self.el.addClass('loading').find('.fa').addClass('fa-spin')

    $.ajax({
      type: 'post',
      dataType: 'json',
      url: blendid.ajaxurl,
      data: self.data,
      success: function(response) {
        //console.log('success: ', response);

        if (response['have_posts'] == 1) {
          let newElements = $(response['html'])

          newElements.addClass('animate-out')
          self.container.append(newElements)

          setTimeout(function() {
            newElements.removeClass('animate-out').addClass('animate-in');
          }, 100)

          if (self.state.clicked) {
            $('html, body').scrollTo(newElements.first(), 600, {
              offset: - $('#header').height(),
              interrupt: true
            })
          }
          
          if (!response['have_posts_next']) {
            self.state.end = true

            self.el.addClass('hide')
          }
        } else {
          self.el.addClass('hide')
        }

        self.el.removeClass('loading').find('.fa').removeClass('fa-spin')
        self.state.loading = false
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //console.log('error: ', jqXHR, textStatus, errorThrown)
        self.state.loading = false
      }
    })

    this.state = self.state
  }
}

export default LoadMore