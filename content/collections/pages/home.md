---
title: 'Hi, I''m Chris'
intro: |
  <img style="float: right; max-width: 200px;  border-radius: 50%;" src="/img/home/Chris_Headshot.jpg">I've managed marketing and product for more than 15 years, mostly for B2B software and telecommunications products. I co-founded Adfury, a SaaS platform for optimizing search advertising. This site is my second brain for digital marketing reference and a collection of various thoughts. 
  
  A bit more about this site is [here](/about).
  
  If you enjoy the technical aspects of marketing, this might be helpful. If you don't, [get in touch](mailto:chris@generalgrowthanalytics.com) and I might be able to do it for you.
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1610824908
id: b785a320-1b83-48eb-b8bc-c5770f3caecb
---
## About this site
This site is maintained using [Statamic](https://statamic.com/), along with their static site generator (which you can get from [github](https://github.com/statamic/ssg). It uses [tailwind.css](https://tailwindcss.com/) and is hosted on the [Digital Ocean app platform](https://www.digitalocean.com/products/app-platform/).

### Why Statamic
I was looking for a very specific set of features:
* I wanted a flat file CMS, like [Grav](https://getgrav.org/) or [Kirby](https://getkirby.com/)
* I wanted native Git integration and a static site generator that let me deploy and go live quickly 
* I wanted native support for CSS compilation using [SASS](https://sass-lang.com/) or similar
* I wanted a robust and powerful templating language like [twig](https://twig.symfony.com/) so that I didn't have to futz directly with php.
* I wanted a good support for markdown for content
* I wanted a strong community and decent support (for which I am willing to pay)
* I wanted people to be making their living from the project so it's less likely to one day disappear

Statamic fit the bill. 

### Why not Webflow
I love [Webflow](https://webflow.com/), and I recommend it to marketing teams that are looking to build landing pages (for example) and need to create many different pages and quickly alter and update designs (for A/B testing or similar). 

Webflow is amazing for that. You can easily create stunning designs with intricate event-driven animations without needing to get into the CLI at all. Create and change pages fast with a low risk of introducing bugs. Too, for a visual designer it creates clean, well structured code without a overly complex DOM.

(If you're an agency and need to build landing pages for multiple clients, Webflow is amazing for that, too. You can white label your projects and bill directly through their system).

What kept me from using Webflow for this project? first, this site is content-centric, not design-centric. Content management is not (yet) an area of strength for Webflow. I find the CMS a little clunky to use. Second, I wanted my content to be maintained in my Github account, sync'd to my local machine.