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
let slider = new Slider('.slideshow-block .slider')
let nav = new Nav()
let comments = new Comments()