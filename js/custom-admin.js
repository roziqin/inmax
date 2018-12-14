function selectprovinsi() {

    document.getElementById("dropdowndaerah").disabled = false;
    var stateID = $("#dropdownprovinsi :selected").val();
    var ID = $("#idproperty").val();
    if(stateID)
    
    {
      //alert('/kecamatan/'+stateID);   
        $.ajax({
            url: 'addproperty/kabupaten/'+stateID,
            type: "GET",
            dataType: "json",
            success:function(data)
            {

                console.log(data);
                $('select[name="kabupaten"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="kabupaten"]').append('<option value="'+ key +'">'+ value +'</option>');
                });

            }
        });
    }else
    {

        $('select[name="kabupaten"]').empty();
    }
  }
  function selectdaerah() {
    document.getElementById("dropdownkecamatan").disabled = false;
     var stateID = $("#dropdowndaerah :selected").val();
    var ID = $("#idproperty").val();
    if(stateID)
    
    {
        $.ajax({
            url: 'addproperty/kecamatan/'+stateID,
            type: "GET",
            dataType: "json",
            success:function(data)
            {

                console.log(data);
                $('select[name="kecamatan"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                });

            }
        });
    }else
    {

        $('select[name="kecamatan"]').empty();
    }
  }

  function selectkecamatan() {
    document.getElementById("dropdownkelurahan").disabled = false;
     var stateID = $("#dropdownkecamatan :selected").val();
    var ID = $("#idproperty").val();
    if(stateID)
    
    {
        $.ajax({
            url: 'addproperty/kelurahan/'+stateID,
            type: "GET",
            dataType: "json",
            success:function(data)
            {

                console.log(data);
                $('select[name="kelurahan"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="kelurahan"]').append('<option value="'+ key +'">'+ value +'</option>');
                });

            }
        });
    }else
    {

        $('select[name="kelurahan"]').empty();
    }
  }

  function selectprovinsiedit() {

    document.getElementById("dropdowndaerah").disabled = false;
    var stateID = $("#dropdownprovinsi :selected").val();
    var ID = $("#idproperty").val();

    if(stateID)
    
    {
      //alert('/kecamatan/'+stateID);   
        $.ajax({
            url: 'kabupaten/'+stateID,
            type: "GET",
            dataType: "json",
            success:function(data)
            {

                console.log(data);
                $('select[name="kabupaten"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="kabupaten"]').append('<option value="'+ key +'">'+ value +'</option>');
                });

            }
        });
    }else
    {

        $('select[name="kabupaten"]').empty();
    }
  }
  function selectdaerahedit() {
    document.getElementById("dropdownkecamatan").disabled = false;
     var stateID = $("#dropdowndaerah :selected").val();
    var ID = $("#idproperty").val();
    if(stateID)
    
    {
        $.ajax({
            url: 'kecamatan/'+stateID,
            type: "GET",
            dataType: "json",
            success:function(data)
            {

                console.log(data);
                $('select[name="kecamatan"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                });

            }
        });
    }else
    {

        $('select[name="kecamatan"]').empty();
    }
  }

  function selectkecamatanedit() {
    document.getElementById("dropdownkelurahan").disabled = false;
     var stateID = $("#dropdownkecamatan :selected").val();
    var ID = $("#idproperty").val();
    if(stateID)
    
    {
        $.ajax({
            url: 'kelurahan/'+stateID,
            type: "GET",
            dataType: "json",
            success:function(data)
            {

                console.log(data);
                $('select[name="kelurahan"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="kelurahan"]').append('<option value="'+ key +'">'+ value +'</option>');
                });

            }
        });
    }else
    {

        $('select[name="kelurahan"]').empty();
    }
  }

  function selectprovinsifront() {

      document.getElementById("dropdowndaerah").disabled = false;
      var stateID = $("#dropdownprovinsi :selected").val();
      var ID = $("#idproperty").val();
      var pathArray = window.location.pathname.split( '/' );
      var secondLevelLocation = pathArray[1];
      var token = getQueryVariable("_token");
      var status = getQueryVariable("status");
      var jenis = getQueryVariable("jenispropperty");
      var alamat = getQueryVariable("alamat");
      var ket = getQueryVariable("ket");
      var harga = getQueryVariable("harga");
      //alert(secondLevelLocation);
      if(stateID)
      
      {
          $.ajax({
              //url: 'cari?_token='+token+'&status='+status+'&jenis='+jenis+'&alamat='+alamat+'&ket='+ket+'&harga='+harga+'/'+stateID,
              url: 'cari/kabupaten/'+stateID,
              type: "GET",
              dataType: "json",
              success:function(data)
              {

                  console.log(data);
                  $('select[name="kabupaten"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="kabupaten"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });

              }
          });
      }else
      {

          $('select[name="kabupaten"]').empty();
      }
    }
    function selectdaerahfront() {
      document.getElementById("dropdownkecamatan").disabled = false;
       var stateID = $("#dropdowndaerah :selected").val();
      var ID = $("#idproperty").val();
      if(stateID)
      
      {
          $.ajax({
              url: 'cari/kecamatan/'+stateID,
              type: "GET",
              dataType: "json",
              success:function(data)
              {

                  console.log(data);
                  $('select[name="kecamatan"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });

              }
          });
      }else
      {

          $('select[name="kecamatan"]').empty();
      }
  }
    function selectkecamatanfront() {
      document.getElementById("dropdownkelurahan").disabled = false;
       var stateID = $("#dropdownkecamatan :selected").val();
      var ID = $("#idproperty").val();
      if(stateID)
      
      {
          $.ajax({
              url: 'cari/kelurahan/'+stateID,
              type: "GET",
              dataType: "json",
              success:function(data)
              {

                  console.log(data);
                  $('select[name="kelurahan"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="kelurahan"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });

              }
          });
      }else
      {

          $('select[name="kelurahan"]').empty();
      }
  }

  function selectprovinsijenis() {

      document.getElementById("dropdowndaerah").disabled = false;
      var stateID = $("#dropdownprovinsi :selected").val();
      var ID = $("#idproperty").val();
      var pathArray = window.location.pathname.split( '/' );
      var secondLevelLocation = pathArray[1];
      var token = getQueryVariable("_token");
      var status = getQueryVariable("status");
      var jenis = getQueryVariable("jenispropperty");
      var alamat = getQueryVariable("alamat");
      var ket = getQueryVariable("ket");
      var harga = getQueryVariable("harga");
      //alert(secondLevelLocation);
      if(stateID)
      
      {
          $.ajax({
              //url: 'cari?_token='+token+'&status='+status+'&jenis='+jenis+'&alamat='+alamat+'&ket='+ket+'&harga='+harga+'/'+stateID,
              url: 'jenis_property/kabupaten/'+stateID,
              type: "GET",
              dataType: "json",
              success:function(data)
              {

                  console.log(data);
                  $('select[name="kabupaten"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="kabupaten"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });

              }
          });
      }else
      {

          $('select[name="kabupaten"]').empty();
      }
    }
    function selectdaerahfrontjenis() {
      document.getElementById("dropdownkecamatan").disabled = false;
       var stateID = $("#dropdowndaerah :selected").val();
      var ID = $("#idproperty").val();
      if(stateID)
      
      {
          $.ajax({
              url: 'kecamatan/'+stateID,
              type: "GET",
              dataType: "json",
              success:function(data)
              {

                  console.log(data);
                  $('select[name="kecamatan"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });

              }
          });
      }else
      {

          $('select[name="kecamatan"]').empty();
      }
  }
    function selectkecamatanfrontjenis() {
      document.getElementById("dropdownkelurahan").disabled = false;
       var stateID = $("#dropdownkecamatan :selected").val();
      var ID = $("#idproperty").val();
      if(stateID)
      
      {
          $.ajax({
              url: 'kelurahan/'+stateID,
              type: "GET",
              dataType: "json",
              success:function(data)
              {

                  console.log(data);
                  $('select[name="kelurahan"]').empty();
                  $.each(data, function(key, value) {
                      $('select[name="kelurahan"]').append('<option value="'+ key +'">'+ value +'</option>');
                  });

              }
          });
      }else
      {

          $('select[name="kelurahan"]').empty();
      }
  }

  function selectjenis() {
    var ketjenis = $('#dropdownjenis :selected').val();
    var ketjenistext = $('#dropdownjenis :selected').text();
    var ket = $('#dropdownstatus :selected').val();
    
    if (ketjenistext == 'Rumah') {
      $("#luastanah").prop('required',true);
      $("#luasbangunan").prop('required',true);
      $("#dimensiluastanah").prop('required',false);
      $("#dimensibangunan").prop('required',false);

      $("#reqluastanah").removeClass('none');
      $("#reqluasbangunan").removeClass('none');
      $("#reqdimensiluastanah").addClass('none');
      $("#reqdimensibangunan").addClass('none');

    } else if (ketjenistext == 'Tanah') {
      $("#luastanah").prop('required',true);
      $("#luasbangunan").prop('required',false);
      $("#dimensiluastanah").prop('required',false);
      $("#dimensibangunan").prop('required',false);

      $("#reqluastanah").removeClass('none');
      $("#reqluasbangunan").addClass('none');
      $("#reqdimensiluastanah").addClass('none');
      $("#reqdimensibangunan").addClass('none');

    } else if (ketjenistext == 'Ruko') {
      $("#luastanah").prop('required',false);
      $("#luasbangunan").prop('required',true);
      $("#dimensiluastanah").prop('required',false);
      $("#dimensibangunan").prop('required',true);

      $("#reqluastanah").addClass('none');
      $("#reqluasbangunan").removeClass('none');
      $("#reqdimensiluastanah").addClass('none');
      $("#reqdimensibangunan").removeClass('none');

    } else {
      $("#luastanah").prop('required',false);
      $("#luasbangunan").prop('required',false);
      $("#dimensiluastanah").prop('required',false);
      $("#dimensibangunan").prop('required',false);

      $("#reqluastanah").addClass('none');
      $("#reqluasbangunan").addClass('none');
      $("#reqdimensiluastanah").addClass('none');
      $("#reqdimensibangunan").addClass('none');

    }


    if (ket == 'disewa') {
      document.getElementById("hargajual").disabled = true;
      $('#hargajual').val('');
      document.getElementById("hargajualtanah").disabled = true;
      $('#hargajualtanah').val('');
      document.getElementById("hargasewajual").disabled = false;
      $('#hargasewajual').val('');


    } else if (ket == 'dijual') {

      if (ketjenistext == 'Tanah') {
        document.getElementById("hargajual").disabled = false;
        $('#hargajual').val('');
        document.getElementById("hargajualtanah").disabled = false;
        $('#hargajualtanah').val('');
        document.getElementById("hargasewajual").disabled = true;
        $('#hargasewajual').val('');

      } else {

        document.getElementById("hargajual").disabled = false;
        $('#hargajual').val('');
        document.getElementById("hargajualtanah").disabled = true;
        $('#hargajualtanah').val('');
        document.getElementById("hargasewajual").disabled = true;
        $('#hargasewajual').val('');
      }
    } else if (ket == 'dijual;disewa') {
      if (ketjenistext == 'Tanah') {
        document.getElementById("hargajual").disabled = false;
        $('#hargajual').val('');
        document.getElementById("hargajualtanah").disabled = false;
        $('#hargajualtanah').val('');
        document.getElementById("hargasewajual").disabled = false;
        $('#hargasewajual').val('');
      } else {

        document.getElementById("hargajual").disabled = false;
        $('#hargajual').val('');
        document.getElementById("hargajualtanah").disabled = true;
        $('#hargajualtanah').val('');
        document.getElementById("hargasewajual").disabled = false;
        $('#hargasewajual').val('');
      }

    } else {
      document.getElementById("hargajual").disabled = true;
      $('#hargajual').val('');
      document.getElementById("hargajualtanah").disabled = true;
      $('#hargajualtanah').val('');
      document.getElementById("hargasewajual").disabled = true;
      $('#hargasewajual').val('');

    }

  }
  function selectstatus() {
    var ket = $('#dropdownstatus :selected').val();
    if (ket == '') {

    } else {
      document.getElementById("dropdownjenis").disabled = false;

    }
    
  }
  function disableTxtDate() {
    document.getElementById("pemiliklainnya").disabled = true;
    $('#pemiliklainnya').val('');
    document.getElementById("datepicker").disabled = true;
    $('#datepicker').val('');
  }
  function enableTxt() {
      document.getElementById("pemiliklainnya").disabled = false;
    document.getElementById("datepicker").disabled = true;
    $('#datepicker').val('');
  }
  function enableDate() {
      document.getElementById("datepicker").disabled = false;
    document.getElementById("pemiliklainnya").disabled = true;
    $('#pemiliklainnya').val('');
  }
  //
  function enableOwnerlama() {
      document.getElementById("owner").disabled = false;
      document.getElementById("name").disabled = true;
      $('#name').val('');
      document.getElementById("email").disabled = true;
      $('#email').val('');
      document.getElementById("ktp").disabled = true;
      $('#ktp').val('');
      document.getElementById("hp").disabled = true;
      $('#hp').val('');
      document.getElementById("alamat").disabled = true;
      $('#alamat').val('');
      document.getElementById("bbm").disabled = true;
      $('#bbm').val('');
      $("#idowner-2").addClass('hidden');
      $("#idowner-1").removeClass('hidden');
  }
  function enableOwnerbaru() {
      $("#owner").val("0");
      document.getElementById("owner").disabled = true;
      document.getElementById("name").disabled = false;
      $('#name').val('');
      document.getElementById("email").disabled = false;
      $('#email').val('');
      document.getElementById("bbm").disabled = false;
      $('#bbm').val('');
      document.getElementById("ktp").disabled = false;
      $('#ktp').val('');
      document.getElementById("hp").disabled = false;
      $('#hp').val('');
      document.getElementById("alamat").disabled = false;
      $('#alamat').val('');
      $("#idowner-1").addClass('hidden');
      $("#idowner-2").removeClass('hidden');

  }

function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
function boxDisable(t) {
    if (t.is(':checked')) {
      document.getElementById("lokasibaru").disabled = false;
      $('#lokasibaru').val('');
      document.getElementById("lokasi").disabled = true;
      $('#lokasi').val('');
    } else {
      document.getElementById("lokasibaru").disabled = true;
      $('#lokasibaru').val('');
      document.getElementById("lokasi").disabled = false;
      $('#lokasi').val('');
    }
}
function boxDisablepln(t) {
    if (t.is(':checked')) {
      document.getElementById("dayalistrik").disabled = false;
      $('#dayalistrik').val('0');
    } else {
      document.getElementById("dayalistrik").disabled = true;
      $('#dayalistrik').val('0');
    }
}
function boxDisabletlp(t) {
    if (t.is(':checked')) {
      document.getElementById("jumlahtelepon").disabled = false;
      $('#jumlahtelepon').val('0');
    } else {
      document.getElementById("jumlahtelepon").disabled = true;
      $('#jumlahtelepon').val('0');
    }
}
function boxDisableac(t) {
    if (t.is(':checked')) {
      document.getElementById("jumlahac").disabled = false;
      $('#jumlahac').val('0');
    } else {
      document.getElementById("jumlahac").disabled = true;
      $('#jumlahac').val('0');
    }
}
$(document).ready(function(){

  $("input#luastanah").change(function(){
    var jumlahluastanah = $('#luastanah').val();
    var jumlahhargajual = $('#hargajual').val();
    var jumlahhargajualtanah = $('#hargajualtanah').val();
    var jenisprop = $('#dropdownjenis :selected').text();

    if (jenisprop == 'Tanah' || jenisprop == 'Kavling') {
      if (jumlahhargajual!='') {
        var hasiltanah = jumlahhargajual/jumlahluastanah;
        $('#hargajualtanah').val(hasiltanah);
      }
      if (jumlahhargajualtanah!='') {
        var hasiljual = jumlahhargajualtanah*jumlahluastanah;
        $('#hargajual').val(hasiljual);
      }
    }
    
  });
  $("#ktp").change(function(){
      var ID = $("#ktp").val();
      var ketktp = $("#ktpedit").val();
      var link = '';
      if (ketktp == 'edit') {
        link = '/laravel/cari/ktp/';
      } else {
        link = 'cari/ktp/';

      }
    if(ID)
    
    {
      //alert('/kecamatan/'+stateID);   
        $.ajax({
            url: link+ID,
            type: "GET",
            dataType: "json",
            success:function(data)
            {


                console.log(data);
                
                   $("#ktp").removeClass('notif');
                  $("#name").val("");
                  $("#alamat").val("");
                  $("#ket").val("");
                  document.getElementById("name").disabled = false;
                  document.getElementById("alamat").disabled = false;
                  document.getElementById("name").focus();  
                $('select[name="kabupaten"]').empty();
                $.each(data, function(key, value) {
                  $("#ktp").addClass('notif');
                  $("#name").val(key);
                  $("#alamat").val(value);
                  $("#ket").val("ada");
                  document.getElementById("name").disabled = true;
                  document.getElementById("alamat").disabled = true;
                  document.getElementById("hp").focus();  
                });
            }
        });
    }else
    {

        
    }
  });

  $("#detaillokasi").change(function(){
      var detail = $("#lokasi").val()+';'+$("#detaillokasi").val()+';'+$("#dropdownkabupaten").val();
      
    if(detail)
    
    {
      //alert('/kecamatan/'+stateID);  

        $.ajax({
            url: 'cari/lokasi/'+detail,
            type: "GET",
            dataType: "json",
            success:function(data)
            {

                console.log(data);
                
                   $("#notifikasi").addClass('hidden');
                  $("#ketproperty").val("");
                $.each(data, function(key, value) {
                  var status = $("#idadmin").val();
                  $("#ceklink").removeClass('hidden');
                  $('#ceklink').attr('href', 'cekproperty/'+data[0].property_id+'?status='+status);
                  $("#notifikasi").removeClass('hidden');
                  $("#ketproperty").val("ada");
                });
            }
        });
    }else
    {

        
    }
  });
});
