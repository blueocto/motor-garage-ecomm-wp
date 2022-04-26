/* Javascript Document */
if ( commercekit_ajs.ajax_search == 1 ) {
document.addEventListener('DOMContentLoaded', function(){
	var minChar = commercekit_ajs.char_count;
	var maxHeight = 600;
	var deferRequestBy = 200;
	var cSuggestions = [];
	var cViewAlls = [];
	var inputs = document.querySelectorAll('input[type="search"]');
	inputs.forEach(function(input){
		var currentRequest = null;
		var currentCancel = null;
		var currentValue = '';
		var iwidth = input.offsetWidth;
		var form = input.closest('form');
		form.insertAdjacentHTML('beforeend', '<div class="commercekit-ajs-results" style="max-height: '+maxHeight+'px; width: '+iwidth+'px;"><div class="commercekit-ajs-suggestions" style="position: absolute; display: none; max-height: '+maxHeight+'px; z-index: 9999; width: '+iwidth+'px;"></div><div class="commercekit-ajs-view-all-holder" style="display: none;"></div></div>');
		input.setAttribute('autocomplete', 'off');
		input.classList.add('commercekit-ajax-search');

		input.addEventListener('keyup', function(e){
			clearTimeout(currentRequest);
			ckCloseAllSuggestions();
			formresult = form.querySelector('.commercekit-ajs-results');
			formsugg = form.querySelector('.commercekit-ajs-suggestions');
			formall = form.querySelector('.commercekit-ajs-view-all-holder');
			formsugg.innerHTML = ''; formsugg.style.display = 'none';
			formall.innerHTML = ''; formall.style.display = 'none';
			var code = (e.keyCode || e.which);
			if (code === 37 || code === 38 || code === 39 || code === 40 || code === 27 || code === 13 || input.value.length < minChar ) {
				return;
			} else {
				if( cSuggestions[input.value] !== undefined ){
					formsugg.innerHTML = cSuggestions[input.value];
					formsugg.style.display = 'block';
					formall.innerHTML = cViewAlls[input.value];
					if( cViewAlls[input.value] != '' ){
						formall.style.display = 'block';
						ckPrepareSuggestionsHeight(input, form, formall, formresult, formsugg);
					} else {
						ckPrepareSuggestionsHeight(input, form, null, formresult, formsugg);
					}
				} else {
					if( currentValue == input.value ){
						return;
					}
					currentRequest = setTimeout(function(){
						currentValue = input.value;
						input.setAttribute('style', 'background-image: url(' + commercekit_ajs.loader_icon + '); background-repeat: no-repeat; background-position:50% 50%;');
						var url = commercekit_ajs.ajax_url + '?action=' + commercekit_ajs.action+'&query='+input.value;
						if( currentCancel ){
							currentCancel.abort();
						}
						currentCancel = new AbortController();
						fetch(url, {signal: currentCancel.signal}).then(response => response.json()).then(json => {
							input.setAttribute('style', 'background-image: none; background-repeat: no-repeat; background-position:50% 50%;');
							var html = '';
							var canViewAll = true;
							if( json.suggestions.length == 0 ) {
								html = '<div class="autocomplete-no-suggestion">'+commercekit_ajs.no_results_text+'</div>';
								cSuggestions[input.value] = html;
								cViewAlls[input.value] = '';
								canViewAll = false;
							} else {
								json.suggestions.forEach(suggestion => {
									html += '<div class="autocomplete-suggestion">'+suggestion.data+'</div>';
								});
								cSuggestions[input.value] = html;
								cViewAlls[input.value] = json.view_all_link;
							}
							formsugg.innerHTML = cSuggestions[input.value];
							formsugg.style.display = 'block';
							if( canViewAll ) {
								formall.innerHTML = cViewAlls[input.value];
								formall.style.display = 'block';
								ckPrepareSuggestionsHeight(input, form, formall, formresult, formsugg);
							} else {
								ckPrepareSuggestionsHeight(input, form, null, formresult, formsugg);
							}
						}).catch(function(e){});

                    }, deferRequestBy);
				}
			}
		});
		input.addEventListener('focus', function(){
			var keyup = new Event('keyup');
			input.dispatchEvent(keyup);
		});
	});
	document.onclick = function(e){
		if( !e.target.classList.contains('commercekit-ajs-suggestions') && !e.target.classList.contains('commercekit-ajax-search') ){
			ckCloseAllSuggestions();
		}
	}	
});
}
function ckCloseAllSuggestions(){
	document.querySelectorAll('.commercekit-ajs-results').forEach(function(results){ 
		results.style.height = '0px';
	});
	document.querySelectorAll('.commercekit-ajs-suggestions').forEach(function(suggestion){
		suggestion.style.display = 'none';
	});
	document.querySelectorAll('.commercekit-ajs-view-all-holder').forEach(function(viewall){
		viewall.style.display = 'none';
	});
}
function ckPrepareSuggestionsHeight(input, form, formall, formresult, formsugg){
	var $height = 0;
	form.querySelectorAll('.autocomplete-suggestion, .autocomplete-no-suggestion').forEach(function(list){
		$height += list.offsetHeight;
	});
	if( formall ){
		$height += formall.offsetHeight;
	}
	formresult.style.height = $height+'px';
	formresult.style.width = input.offsetWidth+'px';
	formsugg.style.width = input.offsetWidth+'px';
	var oresult = form.querySelector('.commercekit-ajs-other-result');
	if( oresult ){
		oresult.parentNode.classList.add('commercekit-ajs-other-result-wrap');
	}
}