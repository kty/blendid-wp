import jquery from 'jquery'
import tether from 'tether'
import bootstrap from 'bootstrap'
import slick from 'slick-carousel'
import scrollTo from 'jquery.scrollto'

import './modules'

import Header from './components/Header'
import Slider from './components/Slider'
import Nav from './components/Nav'
import Comments from './components/Comments'

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