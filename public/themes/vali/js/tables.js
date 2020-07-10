function delete_confirm( d )
{
	confirm('Anda yakin akan menghapus data ini') ? window.location = d.attr('href') : '';
}

function hyperlink_target( d, type )
{
	var hl;
	switch (type) {
		case 'mailto':
			hl = 'mailto:' + d
			
			break;
		case 'tel':
			hl = 'tel:' + d

			break;
		case 'maps':
			hl = 'https://maps.google.com/?q=' + d
			
			break;
		default:
			hl = 'sms:' + d

			break;
	}

	return '<a href="'+ hl +'" target="_blank">'+ d +'<a>';
}

function format_action( d )
{
		return `<div> `+d.post_id+` </div>
						<div class="action" >
								<a class="label label-success" href="./form/edit/`+d.post_id+`"><i class="fa fa-edit">&nbsp;&nbsp;&nbsp;</i>Edit</a>
								<a class="label label-danger" onClick="delete_confirm(this);return false;" href='tett'><i class="fa fa-trash">&nbsp;&nbsp;&nbsp;</i>Delete</a>
						</div>`
}


$('a[data-toggle="tab"]').on('shown.bs.tab', function(event){
		var hrefAsId = $(this).attr('href');

		$('#posts').DataTable().clear().destroy();
		$('#posts').DataTable({
			"processing" :  true,
			"ajax"       :  {
								// "url" : window.location.href + '/show',
								"url" : window.location.href + '/show',
								"data" : {
												"typeProduct" : hrefAsId
								}, 
			},
			"columns"    :  [
								{
									"data"            : null,
									"orderable"       : false,
									"defaultContent"  : ""
								},
								{ "data"  : function(data)
									{
										return format_action(data)
									}
								},
								{ "data"  : "display_name"},
								{ "data"  : "post_status"},
								{ "data"  : "post_type"}
			]
		});
		
})
	

var dt 	= $('#posts').DataTable();

// Array to track idx of the displayed  rows. 
var detailRows = [];

$('#posts tbody').on('click', 'tr td.details-control', function()
{
var tr  = $(this).closest('tr');
var row = dt.row( tr );
var idx = $.inArray(  tr.attr('id'), detailRows );

if ( row.child.isShown() )
{
	tr.removeClass('details');
	row.child.hide();

	// Remove from the open array
	detailRows.splice(idx, 1);
}
else
{
	tr.addClass('details');
	row.child( format_action( row.data() ) ).show();

	if ( idx === -1)
	{
	detailRows.push( tr.attr('id') );
	
	}
}
})

//on each draw loop detailRow array and show any child row.
dt.on('draw', function(){
	$.each( detailRows, function(i, id)
	{
		$('#' + id + ' td.details-control').trigger('click');
	} );
})

