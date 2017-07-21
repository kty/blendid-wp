import jquery from 'jquery'
import tether from 'tether'
import bootstrap from 'bootstrap'
import slick from 'slick-carousel'

import './modules'

import Header from './components/Header'
import Slider from './components/Slider'
import Nav from './components/Nav'
import Comments from './components/Comments'

new Header()
new Nav()
new Comments()

new Slider('.slideshow-block .slider')