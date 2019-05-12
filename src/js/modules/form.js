class Form {
  constructor(el) {
    let self = this

    this.el = el
    this.alert = $(this.el).next('.alert')
    this.timer = {}

    this.init()
  }

  init() {
    let self = this

    let alert = $(self.alert)

    $('[data-module="form"] .form-control').tooltipster({
      trigger: 'custom',
      onlyOne: false,
      theme: "tooltipster-borderless"
    })

    $(this.el).validate({
      errorClass: "has-danger",
      validClass: "has-success",
      highlight: function(element, errorClass, validClass) {
        $(element).parent().removeClass(validClass).addClass(errorClass)
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).parent().removeClass(errorClass).addClass(validClass)
      },
      success: function(label, element) {
        $(element).tooltipster('hide')
      },
      errorPlacement: function(error, element) {
        if (!$(element).parent().hasClass('has-danger')) return

        let errorMessage = $(error).text()
        errorMessage = errorMessage.replace(/\./g,'')

        $(element).tooltipster('content', i18next.t(errorMessage))
        $(element).tooltipster('show')
      },
      rules: {
        firstname: {
          required: true,
          minlength: 2
        },
        lastname: {
          required: true,
          minlength: 2
        },
        email: {
          required: true,
          email: true
        },
      },
      submitHandler: function(form) {
        console.log('submit')

        let data = $(form).serializeArray()
          .reduce(function(a, x) { a[x.name] = x.value; return a; }, {});

        self.send(data)

        return false
      }
    })
  }

  send(data) {
    console.log('send')

    let self = this

    let form = $(self.el)
    let alert = $(self.alert)

    self.removeAlertClasses(alert)

    if (form.valid()) {
      $.ajax({
        dataType: 'json',
        method: 'POST',
        url: blendid.ajaxurl,
        data: data,
        success: function(response, status, jqXHR) {
          console.log('response', response)

          alert.text(response.message)

          if (response.status == true) {
            form.addClass('hide')
            
            alert.addClass('alert-success')
          } else {
            alert.addClass('alert-danger')
          }
        },
        error: function(jqXHR, status, error) {
          console.log(jqXHR, status, error)

          alert.addClass('alert-danger').text(error)
        }
      })
    } else {
      alert.addClass('alert-danger').text(blendid.errorMessage)
    }
  }

  removeAlertClasses(element) {
    element.removeClass(function (index, css) {
      return (css.match(/(^|\s)alert-\S+/g) || []).join(' ');
    })
  }
}

export default Form