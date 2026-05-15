/* ini Dental — Admin JS */
jQuery(function ($) {
  'use strict';

  /* -----------------------------------------------------------------------
   * Page Sections sortable
   * -------------------------------------------------------------------- */
  if ($('#ini-sections-sortable').length) {
    $('#ini-sections-sortable').sortable({
      handle:      '.ini-drag-handle',
      axis:        'y',
      placeholder: 'ini-section-item ui-sortable-placeholder',
      tolerance:   'pointer',
    });
  }

  /* -----------------------------------------------------------------------
   * "Copy sections from page" AJAX
   * -------------------------------------------------------------------- */
  $('#ini-copy-sections-btn').on('click', function () {
    var sourceId = $('#ini-copy-source').val();
    if (!sourceId) {
      alert('Please select a page to copy from.');
      return;
    }

    var $btn = $(this).prop('disabled', true).text('Copying…');

    $.post(iniDentalAdmin.ajaxUrl, {
      action: 'ini_get_page_sections',
      page_id: sourceId,
      nonce: iniDentalAdmin.nonce,
    }, function (res) {
      $btn.prop('disabled', false).text('Copy');

      if (res.success && Array.isArray(res.data.sections)) {
        var sections = res.data.sections;
        var $list    = $('#ini-sections-sortable');
        var $items   = $list.find('.ini-section-item');
        var ordered  = [];

        // Activate + reorder matching items
        sections.forEach(function (slug) {
          var $item = $items.filter('[data-slug="' + slug + '"]');
          if ($item.length) {
            $item.find('input[type=checkbox]').prop('checked', true);
            ordered.push($item[0]);
          }
        });

        // Deactivate and append remaining items
        $items.each(function () {
          if (sections.indexOf($(this).data('slug')) === -1) {
            $(this).find('input[type=checkbox]').prop('checked', false);
            ordered.push(this);
          }
        });

        $list.append(ordered);

        $('.ini-copy-status')
          .text('✓ Copied!')
          .show()
          .delay(2500)
          .fadeOut();
      } else {
        alert('Could not retrieve sections. Please try again.');
      }
    }).fail(function () {
      $btn.prop('disabled', false).text('Copy');
      alert('Request failed. Please try again.');
    });
  });
});
