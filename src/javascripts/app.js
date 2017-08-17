import jquery from 'jquery'
import tether from 'tether'
import bootstrap from 'bootstrap'
import slick from 'slick-carousel'
import scrollTo from 'jquery.scrollto'
import validation from 'jquery-validation'
import tooltipster from 'tooltipster'
import i18next from 'i18next'

import './modules'

import Header from './components/Header'
import Slider from './components/Slider'
import Nav from './components/Nav'
import Comments from './components/Comments'

i18next.init({
  lng: 'sv',
  resources: {
    sv: {
      translation: {
        "This field is required": "Det här fältet är obligatoriskt",
        "Please enter a valid email address": "Var god ange en giltig e-postadress",
        "Please enter at least 2 characters": "Var god ange minst två bokstäver"
      }
    }
  }
}, function(err, t) {
  // initialized and ready to go!
})

$(function() {
  let header = new Header('#header')

  let slider = new Slider('.slideshow-block .slider', {
    prevArrow: '<button type="button" class="slick-arrow slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
    nextArrow: '<button type="button" class="slick-arrow slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    infinite: true,
    dots: true,
    pauseOnHover: true
  })

  let nav = new Nav()

  let comments = new Comments()
})