$(window).ready(function(){
  $('#dgx-donate-container > div:not(#dgx-donate-form-donation-section, #dgx-donate-form-paypal-hidden-section, #dgx-donate-form-payment-section) > div:not(#donation_header, #_dgx_donate_tribute_gift, #_dgx_donate_memorial_gift, #_dgx_donate_honor_by_email, #_dgx_donate_honor_by_post_mail, #_dgx_donate_anonymous, #_dgx_donate_add_to_mailing_list, #dgx_donate_uk_gift_aid)').each(function(){
    $(this).addClass('text-input-section');
  });
  $('#dgx-donate-container .text-input-section, #dgx-donate-container #_dgx_donate_user_amount').each(function(){
    var c = 'text'+$(this).find('input[type="text"]').attr('name');
    $(this).find('input[type="text"]').attr('id', c).addClass('text-box');
    $(this).contents().filter(function(){
        return this.nodeType === 3; 
    }).wrap('<label for="'+c+'" class="text-label">');
  });
  $('#dgx-donate-form-donation-section span:not(#other_radio_button)').each(function(){
    var c = 'donate'+$(this).find('input').attr('value');
    $(this).find('input').attr('id', c).addClass('hidden-radio').addClass('no-icheck');
    $(this).contents().filter(function(){
        return this.nodeType === 3; 
    }).wrap('<label for="'+c+'" class="donation-amount">');
  });
  $('#dgx-donate-form-donation-section #other_radio_button, #dgx-donate-form-donation-section #_dgx_donate_repeating p').each(function(){
    var c = 'donate'+$(this).find('input').attr('value');
    $(this).find('input').attr('id', c);
    $(this).contents().filter(function(){
        return this.nodeType === 3; 
    }).wrap('<label for="'+c+'" class="other-amount">');
  });
  $('#_dgx_donate_tribute_gift, #_dgx_donate_memorial_gift, #_dgx_donate_honor_by_email, #_dgx_donate_honor_by_post_mail, #_dgx_donate_anonymous, #_dgx_donate_add_to_mailing_list, #dgx_donate_uk_gift_aid').each(function(){
    var c = 'donate'+$(this).attr('id');
    $(this).find('input').attr('id', c);
    $(this).contents().filter(function(){
        return this.nodeType === 3; 
    }).wrap('<label for="'+c+'" class="input-label">');
  });
  $('#dgx-donate-container input[type="checkbox"]+label').each(function(){
     var t = $(this).text();
     $(this).html('<span class="css-check checkradio"></span> '+t);
  });
  $('#dgx-donate-container input[type="radio"]:not(.hidden-radio)+label').each(function(){
     var t = $(this).text();
     $(this).html('<span class="css-radio checkradio"></span> '+t);
  });
  $('#dgx-donate-form-payment-section #dgx-donate-pay-enabled input').each(function(){
    console.log('Activated');
    $(this).addClass('paypalButton');
    console.log('Found it!');
  });
});