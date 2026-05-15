/* ini Dental — Customizer Live Preview */
(function ($) {
  'use strict';

  var api = wp.customize;

  /* Helper: set text of matching elements */
  function liveText(settingId, selector) {
    api(settingId, function (value) {
      value.bind(function (newval) {
        $(selector).text(newval);
      });
    });
  }

  /* Helper: set HTML */
  function liveHtml(settingId, selector) {
    api(settingId, function (value) {
      value.bind(function (newval) {
        $(selector).html(newval);
      });
    });
  }

  /* Helper: set CSS custom property on :root */
  function liveCssVar(settingId, varName) {
    api(settingId, function (value) {
      value.bind(function (newval) {
        document.documentElement.style.setProperty(varName, newval);
      });
    });
  }

  /* --- Colors --- */
  liveCssVar('ini_color_cyan',   '--cyan-400');
  liveCssVar('ini_color_yellow', '--yellow');
  liveCssVar('ini_color_ink',    '--ink');
  liveCssVar('ini_color_muted',  '--muted');

  /* --- Hero --- */
  liveText('ini_hero_title',       '.hero h1 > :first-child');
  liveText('ini_hero_title2',      '.hero h1 .accent');
  liveText('ini_hero_description', '.hero-copy p');
  liveText('ini_hero_cta1_label',  '.hero-ctas .btn-yellow');
  liveText('ini_hero_members',     '.members .lbl b');
  liveText('ini_hero_members_lbl', '.members .lbl');
  liveText('ini_hero_stat1_num',   '.stat-stack .stat-card:nth-child(1) .stat-num');
  liveText('ini_hero_stat1_lbl',   '.stat-stack .stat-card:nth-child(1) .stat-lbl');
  liveText('ini_hero_stat2_num',   '.stat-stack .stat-card:nth-child(2) .stat-num');
  liveText('ini_hero_stat2_lbl',   '.stat-stack .stat-card:nth-child(2) .stat-lbl');
  liveText('ini_hero_stat3_num',   '.stat-stack .stat-card:nth-child(3) .stat-num');
  liveText('ini_hero_stat3_lbl',   '.stat-stack .stat-card:nth-child(3) .stat-lbl');

  /* --- About --- */
  liveText('ini_about_title',        '.about-copy h2');
  liveText('ini_about_description',  '.about-copy > p');
  liveText('ini_about_vision_title', '.vm:nth-child(1) h5');
  liveText('ini_about_vision_desc',  '.vm:nth-child(1) p');
  liveText('ini_about_mission_title','.vm:nth-child(2) h5');
  liveText('ini_about_mission_desc', '.vm:nth-child(2) p');
  liveText('ini_about_ceo_name',     '.ceo h6');
  liveText('ini_about_ceo_title',    '.ceo small');

  /* --- Services --- */
  liveText('ini_services_title', '.svc-head h2');
  liveText('ini_services_desc',  '.svc-head p');
  [1,2,3].forEach(function(i) {
    liveText('ini_svc'+i+'_title', '.svc-grid .svc-card:nth-child('+i+') h4');
    liveText('ini_svc'+i+'_desc',  '.svc-grid .svc-card:nth-child('+i+') p');
  });

  /* --- Testimonials --- */
  liveText('ini_testi_title', '.testi-copy h2');
  liveText('ini_testi_desc',  '.testi-copy p');

  /* --- Solutions --- */
  liveText('ini_sol_title',    '.sol-copy h2');
  liveText('ini_sol_desc',     '.sol-copy > p');
  liveText('ini_sol_check1',   '.check-row:nth-child(1) .lbl');
  liveText('ini_sol_check2',   '.check-row:nth-child(2) .lbl');
  liveText('ini_sol_check3',   '.check-row:nth-child(3) .lbl');
  liveText('ini_sol_wh_title', '.work-hours h5');
  liveText('ini_sol_wh_h1',    '.hrs li:nth-child(1)');
  liveText('ini_sol_wh_h2',    '.hrs li:nth-child(2)');

  /* --- Steps --- */
  liveText('ini_steps_title', '.steps-head h2');
  [1,2,3,4].forEach(function(i) {
    liveText('ini_step'+i+'_title', '.steps-grid .step:nth-child('+i+') h5');
    liveText('ini_step'+i+'_desc',  '.steps-grid .step:nth-child('+i+') p');
  });

  /* --- Blog --- */
  liveText('ini_blog_title',     '.blog-head h2');
  liveText('ini_blog_cta_label', '.blog-head .btn');

  /* --- Newsletter --- */
  liveText('ini_news_title', '.newsletter h3');
  liveText('ini_news_desc',  '.newsletter p');
  liveText('ini_news_btn_label', '.news-form button');

  /* --- Footer --- */
  liveText('ini_footer_about',   'footer .foot-col:first-child p');
  liveText('ini_footer_address', '.contact-li:nth-child(1)');
  liveText('ini_footer_phone',   '.contact-li:nth-child(2)');
  liveText('ini_footer_email',   '.contact-li:nth-child(3)');
  liveText('ini_footer_copyright', '.foot-base');

})(jQuery);
