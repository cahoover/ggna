---
title: 'Avoiding SPAM without CAPCHA'
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1605148219
id: 64874a88-227d-4f4a-a4d5-b7c3cdea022a
---
You've put together a beautiful landing page, and it's generating conversions for you like a welloiled machine. All is humming along wonderfully except for one small fly in the ointment: spam. Bots are filling out your form, clogging up your CRM with spam, and making themselves a nuisance.  What to do? The most common way to evade spambots is the CAPTCHA test. You know the ones; they try to get you to prove you're not a robot by typing in the letters and numbers seen in a distorted image.  ![](https://blog.adfury.io/wpcontent/uploads/download.png)  More recent versions of CAPTCHA are a bit more sophisticated; they try to be less disruptive by tracking your mouse movements for telltale human swerves and bounces.  ![](https://blog.adfury.io/wpcontent/uploads/herorecaptchademo.gif)  But no matter how you present a test for humanness, one thing remains clear: they are a killer for conversions. A 2009 post by Moz's Casey Henry described [CAPTCHA's effect on conversion rates](https://moz.com/blog/captchasaffectonconversionrates) and found that turning off CAPTCHA increased conversions by 3.2%. Considering that you can often directly map conversions to revenue, you should take seriously any reduction in performance. 

## The honeypot method: imperfect, but worth a try

 The goto method for avoiding spam bots is to use a socalled "honeypot" field in the form. Such a field is hidden from humans, but completed by bots. Simply discard submissions with text in the hidden field, and you've reduced conversion spam. 

## The traditional way to hide a field

 The first thing to try is including a "type=hidden" in the input field. It's easy because it doesn't even require messing around with the CSS. For example:  <input name="_" type="hidden" value="" autocomplete="off" tabindex="1">  Amazingly, some spam robots still add text to this field!  A very similar method uses the CSS style {display: none;}. Our friends at Wordstream [wrote about it this year](http://www.wordstream.com/blog/ws/2017/01/04/ppclandingpagetips), and there are [many similar articles](https://solutionfactor.net/blog/2014/02/01/honeypottechniquefasteasyspamprevention/) around the net.  To borrow the example used in both these posts, you simply create an additional field in your form, like so:  <[<span class="kw2">input</span>](http://december.com/html/4/element/input.html) <span class="kw3">id</span><span class="sy0">=</span><span class="st0">"odd_email"</span> <span class="kw3">type</span><span class="sy0">=</span><span class="st0">"text"</span> <span class="kw3">name</span><span class="sy0">=</span><span class="st0">"email"</span> <span class="kw3">size</span><span class="sy0">=</span><span class="st0">"25"</span> <span class="kw3">value</span><span class="sy0">=</span><span class="st0">"" autocomplete="off" tabindex="1"</span> <span class="sy0">/</span>>  And then hide it using the CSS display property, like so:  <span class="re0">#odd_email</span> <span class="br0">{</span>  <span class="kw1">display</span><span class="sy0">:</span> <span class="kw2">none</span><span class="sy0">;</span>  <span class="br0">}</span>  Often, this works just great. Sometimes it doesn't. 

## Some bots aren't fooled

 The problem with the type=hidden and {display:none;} techniques is that many modern bots are smart enough to avoid them.  So what to do? Well, to begin with, make sure you give the type="hidden"  technique a try.  If you're still getting spam, try {display:none;}.  Then try the related CSS visibility command.  .odd_email{visibility: hidden}  <input class="odd_email" name="email_field" type="text" autocomplete="off" tabindex="1">  These are the most straightforward methods, and they work for a lot of people. But if you're still getting spam, there are a few other options. All of them a riffs on the same theme: hide the field from humans, display it to bots. 

## Move the field out of the way

 You can try using CSS positioning to move the field out of the user's viewport. For example in your CSS  .odd_email{position: absolute; top: 3px; left: 680px;}  HTML  <input class="odd_email" name="email_field" type="text" autocomplete="off" tabindex="1"> 

## Make the field invisible

 You can use CSS to make the field transparent to human viewers using the opacity property.  CSS  .odd_email{opacity: 0;}  Note that the opacity value may not be supported by very old browsers. If this is a concern, be sure and test your field. 

## Bury the field behind the z

 The CSS zindex property defines where an element is located in the 3rd dimension (the z axis) relative to other layers. Define the main form fields with a positive zindex value, and then use a negative zindex value for the form that you wish to remain hidden.  CSS  .odd_email{position:relative; zindex: 100} 

## Indent the hidden field

 The CSS textindent property specifies the indentation of the element. By providing a value of 100%, you are indenting the field to the far right side of the form element. By adding the overflow:hidden property, you hide the indented field. By adding the whitespace:nowrap property, you ensure the indented field doesn't leave an awkward space in your form.  CSS  .odd_email{  textindent: 100%;  whitespace: nowrap;  overflow: hidden;  }  HTML 

<div class="odd_email"><input name="odd_email" type="text" autocomplete="off" tabindex="1"></div>



## Be careful of autocomplete features

 As you experiment with different techniques for hiding honeypot fields, you should be mindful that many browsers have autocomplete features that automatically fill out forms on behalf of their users. To make sure your honeypot isn't accidentally completed by a wellmeaning autocomplete bot, add autocomplete="off" to the honeypot's input tag. 

## Be careful of tab indexing

 Also, many people navigate through forms by clicking the tab button. You don't want them to tab to your hidden field and accidentally enter data.  To ensure the field isn't accessible by tab clicks, add  tabindex="1" to the input tag. 

## Be careful of obvious labels

 Some spam bots are programmed to watch for labels such as "honey," "honeypot," "spam" and similar variations. It's easiest to use some somewhat realistic but obviouslyfake name. I've used "odd_email" in the examples above. 

## Please share

 If you thought this post was useful or helpful, please share by clicking one of the social media buttons below!