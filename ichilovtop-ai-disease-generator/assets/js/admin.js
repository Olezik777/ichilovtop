(function ($) {
	'use strict';

	function openModal() {
		if ($('#ichilovtop-ai-modal-overlay').length) {
			return;
		}

		var modalHtml = ''
			+ '<div id="ichilovtop-ai-modal-overlay" style="position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:100000;display:flex;align-items:center;justify-content:center;">'
			+ '  <div style="background:#fff;width:100%;max-width:560px;border-radius:8px;padding:20px;box-shadow:0 10px 30px rgba(0,0,0,.2);">'
			+ '    <h2 style="margin:0 0 14px;font-size:20px;">' + ichilovtopAiDiseaseGenerator.i18nTitle + '</h2>'
			+ '    <label for="ichilovtop-ai-source-url" style="display:block;font-weight:600;margin-bottom:6px;">' + ichilovtopAiDiseaseGenerator.i18nLabel + '</label>'
			+ '    <input id="ichilovtop-ai-source-url" type="url" placeholder="' + ichilovtopAiDiseaseGenerator.i18nPlaceholder + '" style="width:100%;margin-bottom:10px;" />'
			+ '    <p id="ichilovtop-ai-status" style="margin:0 0 12px;color:#646970;"></p>'
			+ '    <div style="display:flex;justify-content:flex-end;gap:8px;">'
			+ '      <button type="button" class="button" id="ichilovtop-ai-cancel">' + ichilovtopAiDiseaseGenerator.i18nCancel + '</button>'
			+ '      <button type="button" class="button button-primary" id="ichilovtop-ai-generate">' + ichilovtopAiDiseaseGenerator.i18nGenerate + '</button>'
			+ '    </div>'
			+ '  </div>'
			+ '</div>';

		$('body').append(modalHtml);
		$('#ichilovtop-ai-source-url').trigger('focus');
	}

	function closeModal() {
		$('#ichilovtop-ai-modal-overlay').remove();
	}

	function setStatus(message, isError) {
		$('#ichilovtop-ai-status')
			.text(message)
			.css('color', isError ? '#b32d2e' : '#646970');
	}

	$(document).on('click', '#ichilovtop-generate-disease-ai', function () {
		if (!ichilovtopAiDiseaseGenerator.postId) {
			window.alert(ichilovtopAiDiseaseGenerator.i18nSavePostFirst);
			return;
		}

		openModal();
	});

	$(document).on('click', '#ichilovtop-ai-cancel', function () {
		closeModal();
	});

	$(document).on('click', '#ichilovtop-ai-modal-overlay', function (event) {
		if (event.target.id === 'ichilovtop-ai-modal-overlay') {
			closeModal();
		}
	});

	$(document).on('click', '#ichilovtop-ai-generate', function () {
		var sourceUrl = ($('#ichilovtop-ai-source-url').val() || '').toString().trim();
		var ajaxEndpoint = ichilovtopAiDiseaseGenerator.ajaxUrl || window.ajaxurl || '/wp-admin/admin-ajax.php';

		if (!sourceUrl) {
			setStatus(ichilovtopAiDiseaseGenerator.i18nMissingUrl, true);
			return;
		}

		$('#ichilovtop-ai-generate').prop('disabled', true);
		$('#ichilovtop-ai-cancel').prop('disabled', true);
		setStatus(ichilovtopAiDiseaseGenerator.i18nWorking, false);

		$.ajax({
			url: ajaxEndpoint,
			method: 'POST',
			dataType: 'json',
			data: {
				action: ichilovtopAiDiseaseGenerator.action,
				nonce: ichilovtopAiDiseaseGenerator.nonce,
				post_id: ichilovtopAiDiseaseGenerator.postId,
				source_url: sourceUrl
			}
		}).done(function (response) {
			if (response && response.success) {
				setStatus(ichilovtopAiDiseaseGenerator.i18nSuccess, false);
				setTimeout(function () {
					window.location.reload();
				}, 900);
				return;
			}

			var message = (response && response.data && response.data.message)
				? response.data.message
				: ichilovtopAiDiseaseGenerator.i18nError;
			setStatus(message, true);
		}).fail(function (xhr) {
			var message = ichilovtopAiDiseaseGenerator.i18nError;

			if (xhr && xhr.responseJSON && xhr.responseJSON.data && xhr.responseJSON.data.message) {
				message = xhr.responseJSON.data.message;
			} else if (xhr && xhr.status) {
				message = 'HTTP ' + xhr.status + ': ' + (xhr.statusText || 'Request failed');
				if (xhr.responseText) {
					message += ' | ' + xhr.responseText.toString().slice(0, 160);
				}
			}

			if (window.console && console.error) {
				console.error('AI generation request failed', {
					ajaxEndpoint: ajaxEndpoint,
					status: xhr ? xhr.status : null,
					statusText: xhr ? xhr.statusText : null,
					responseText: xhr ? xhr.responseText : null
				});
			}

			setStatus(message, true);
		}).always(function () {
			$('#ichilovtop-ai-generate').prop('disabled', false);
			$('#ichilovtop-ai-cancel').prop('disabled', false);
		});
	});
})(jQuery);
