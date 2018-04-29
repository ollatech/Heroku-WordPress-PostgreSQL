/***************************************
* Ajax Call
***************************************/




/***************************************
* Ajax Call
***************************************/
function ajax_elements(args, callback) {
	var data = {
		action: 'stencil_elements',
		args: args
	};
	jQuery.post(ajaxurl, data, function(response) {
		var output = response;
		callback(output);
	});
}
function ajax_element(elementType, args, callback) {
	var data = {
		action: 'stencil_element',
		elementType: elementType,
		args: args,
		token: stencilToken
	};

	jQuery.post(stencilUrl, data, function(response) {

		callback(response);
	});
	
}
function ajax_element_edit(elementType, args, callback) {
	var data = {
		action: 'stencil_element_edit',
		elementType: elementType,
		args: args,
		token: stencilToken
	};

	jQuery.post(stencilUrl, data, function(response) {
		callback(response);
	});

}
/***************************************
* Reload
***************************************/

function sortableElement(instance, isMaster) {

	if(instance.children('.ve-elements').length > 0) {
		Sortable.create(instance.children('.ve-elements')[0], {
			group: "stle", 
			sort: true,  
			delay: 0,  
			animation: 150,
			draggable: '.ve-element',
			onAdd: function (evt) {
				var placeholder = $(evt.item);
				addElement(placeholder);
			}
		});
	}
}


function nestedElement(id) {
	var instance = $('#'+id);
	if($('#'+id).children('.ve-elements').length > 0) {
		var instance = $('#'+id).children('.ve-elements').first();
		Sortable.create(instance[0], {
			group: "stle", 
			sort: true,  
			delay: 0,  
			animation: 150,
			draggable: '.ve-element',
			onAdd: function (evt) {
				var placeholder = $(evt.item);
				addElement(placeholder);
			}
		});
	}
	toolElement(instance);
} 

function addElement(placeholder) {
	if(typeof placeholder.data('type') !== 'undefined')
	{
		placeholder.append('loading');
		var elementType = placeholder.data('type');
		var elementId = createId();
		ajax_element(elementType, {
			elementType: elementType,
			elementId: elementId
		}, function(response) {
			placeholder.after(response);
			placeholder.next().attr('id', elementId);
			placeholder.remove();
			nestedElement(elementId);
		});
	}
}

/***************************************
* Actions
***************************************/
function toolElement(instance, isMaster) {
	var tool = '' +
	'<div class="ve-tool" >' +
	'<div class="menu">' +
	'<button class="btn btn-edit">edit</button>' +
	'<button class="btn btn-delete">delete</button>' +
	'</div>' +
	'</div>';

	instance.mouseover(function (event) {
		event.stopPropagation();
		if(!isMaster) {
			instance.prepend(tool);
		}
	}).mouseout(function (event) {
		event.stopPropagation();
		instance.children('.ve-tool').remove();
	});
}
function stencilActions(instance) {
	instance.on('click', '.add-column', function(evt) {
		var element = $(this).closest('.ve-element');
		var elementType = 'column';
		var elementId = createId();
		ajax_element(elementType, {
			elementType: elementType,
			elementId: elementId
		}, function(response) {
			element.children('.ve-elements').append(response);
			element.children('.ve-elements').children('.ve-element').last().attr('id', elementId);
			nestedElement(elementId);
		});
	})
	instance.on('click', '.btn-edit', function(e) {
		var element = $(this).closest('.ve-element');

		ajax_element_edit('test', {}, function(response) {
			$('body').append(response);
			var stencilModal = jQuery('#stencilOptionModal');
			stencilModal.modal();	
			stencilModal.on('click', '.save', function(e) {	
				e.preventDefault();			
			});
			stencilModal.on('hidden.bs.modal', function(e) {
				stencilModal.remove();
			});
		});
	});
	instance.on('click', '.btn-delete', function(e) {
		var element = $(this).closest('.ve-element');
		element.remove();
	});
}

/***************************************
* Editor
***************************************/
jQuery(function ($) {
	/* options Section */
	$('.ve-options').each(function (index, value) { 
		var instance = $(this);
		Sortable.create(instance[0], {
			group: { name: "stle", pull: 'clone', put: false },
			sort: false, 
			delay: 0, 
			animation: 150,
			draggable: '.ve-option'
		});
	});
	/* Master Section */
	var master = $('#ve-editor');
	sortableElement(master, true);
	stencilActions(master);
	$('.ve-element').each(function (index, value) { 
		var instance = $(this);
		toolElement(instance);
		sortableElement(instance)
	});
});


/***************************************
* Tools
***************************************/
function createId() {
	return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}