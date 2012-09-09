
// carousels
$('.carousel').carousel({
  interval: 2000
})

//modal
var trigger = $('#trigger-payment a.btn');
trigger.click(function(){

  var quantity = $('select[name=quantity]').val();
  var rythm    = $(this).data('rythm');
  var url      = $('#trigger-payment').data('modal-url');

  $('#modal .modal-body').load(url+'?recurrent='+rythm+'&quantity='+quantity, function(){
    $('#modal').modal('show');
    $('#modal form').submit(function(){
      console.log($(this));
      window.open($(this).attr('action')+'?'+$(this).serialize());
      return false;
    });
  });
});

$('#modal .btn-primary').live('click', function(){
  $('#modal form').submit();
});


$('.trigger-popover').popover();