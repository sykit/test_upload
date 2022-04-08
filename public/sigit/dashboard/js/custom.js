
function isNumberKey(evt) {
var charCode = (evt.which) ? evt.which : event.keyCode;
if ((charCode < 40 || charCode > 57))
    return false;

return true;
}
$(document).ready(function() {
  // $.mask.definitions['~']='[+-]';
  $('.npwp').mask('99.999.999.9.999-999');
  $('.no_acc').mask('9-99-99-99-99');
  // $('.date-picker').datepicker({
	// 				autoclose: true,
	// 				todayHighlight: true
	// 			});
  $('#id-date-picker-detail').datepicker({
					autoclose: true,
					todayHighlight: true,
          dateFormat: 'dd-mm-yy'
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
  $('#id-date-picker-tambah').datepicker({
					autoclose: true,
					todayHighlight: true,
          dateFormat: 'dd-mm-yy'
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});


  // $('#id-date-picker-1').datepicker('disable');

});

function redirect(url){
  window.location.replace(url);
}

function reformatingCurrency(e){
  var value = $(e).val().replace(/\,/g,"").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  $(e).val(value)
  // alert($(e).val())
}
function stringToCurrency(string){
  if (string == ""|| string == null) {
    return "0";
  }
  var newValue = parseFloat(string).toFixed(2).toString().split(".")
  console.log(newValue);
  if(newValue[1] == "00"){
    var value = newValue[0].replace(/\,/g,"").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  }else{
    var value = parseFloat(string).toFixed(2).toString().replace(/\,/g,"").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  }
  // var value = string.toString().replace(/\,/g,"").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  // var value = parseFloat(string).toFixed(2).toString().replace(/\,/g,"").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  return value;
  // alert($(e).val())
}
function stringToCurrencyNoComa(string){
  if (string == "" || string == null) {
    return "0";
  }
  string = string.toString().split(".")[0];
  var value = string.replace(/\,/g,"").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return value;
  // alert($(e).val())
}


function recalculate(id){
  var netto = $('#'+id+' input[name=netto]').val().replace(/\,/g,"");
  var ppn_p = $('#'+id+' input[name=ppn_p]').val().replace(/\,/g,"");

  var ppn_r = parseInt(netto) * parseFloat(ppn_p) / 100;
  $('#'+id+' input[name=ppn_r]').val(stringToCurrency(parseInt(ppn_r).toString()));

  var jumlah = parseInt(netto)+parseInt(ppn_r)
  $('#'+id+' input[name=jumlah]').val(stringToCurrency(jumlah.toString()));
}

function switchDateYear(string){
  var arr = string.toString().split("-");
  return arr[2]+"-"+arr[1]+"-"+arr[0];
}

function getListMonth(param){
  if(param == ""||param == "0"||parseInt(param) > 12){
    return "";
  }

  var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
  return bulan[parseInt(param)-1];
}

function terbilang(bilangan) {

 bilangan    = String(bilangan);
 var minus = false;
 if(bilangan.includes("-")){
   minus = true;
 }
 var hasComa = false;
 arrbilangan  = bilangan.split('.')
 if (minus) {
   bilangan = arrbilangan[0].substr(1,arrbilangan[0].length);
 }else{
   bilangan = arrbilangan[0];
 }
 if (arrbilangan[1]!=null && arrbilangan[1] != "00") {
   hasComa = true
 }
 var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
 var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
 var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

 var panjang_bilangan = bilangan.length;

 /* pengujian panjang bilangan */
 if (panjang_bilangan > 15) {
   kaLimat = "Diluar Batas";
   return kaLimat;
 }

 /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
 for (i = 1; i <= panjang_bilangan; i++) {
   angka[i] = bilangan.substr(-(i),1);
 }

 i = 1;
 j = 0;
 kaLimat = "";


 /* mulai proses iterasi terhadap array angka */
 while (i <= panjang_bilangan) {

   subkaLimat = "";
   kata1 = "";
   kata2 = "";
   kata3 = "";

   /* untuk Ratusan */
   if (angka[i+2] != "0") {
     if (angka[i+2] == "1") {
       kata1 = "Seratus";
     } else {
       kata1 = kata[angka[i+2]].trim() + " Ratus";
     }
   }

   /* untuk Puluhan atau Belasan */
   if (angka[i+1] != "0") {
     if (angka[i+1] == "1") {
       if (angka[i] == "0") {
         kata2 = "Sepuluh";
       } else if (angka[i] == "1") {
         kata2 = "Sebelas";
       } else {
         kata2 = kata[angka[i]] + " Belas";
       }
     } else {
       kata2 = kata[angka[i+1]] + " Puluh";
     }
   }

   /* untuk Satuan */
   if (angka[i] != "0") {
     if (angka[i+1] != "1") {
       kata3 = kata[angka[i]];
     }
   }

   /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
   if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
     subkaLimat = kata1.trim()+" "+kata2.trim()+" "+kata3.trim()+" "+tingkat[j]+" ";
   }

   /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
   kaLimat = subkaLimat.trim()+" " + kaLimat.trim();
   i = i + 3;
   j = j + 1;

 }

 /* mengganti Satu Ribu jadi Seribu jika diperlukan */
 if ((angka[5] == "0") && (angka[6] == "0")) {
   kaLimat = kaLimat.replace("Satu Ribu","Seribu");
 }
 if (minus) {
   kaLimat = "Minus "+kaLimat.trim()
 }

 if (hasComa) {
   angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
   bilangan = arrbilangan[1];
   var panjang_bilangan = bilangan.length;

   for (i = 1; i <= panjang_bilangan; i++) {
     angka[i] = bilangan.substr(-(i),1);
   }

   i = 1;
   j = 0;
   kaLimatComa = "";


   /* mulai proses iterasi terhadap array angka */
   while (i <= panjang_bilangan) {

     subkaLimat = "";
     kata1 = "";
     kata2 = "";
     kata3 = "";

     /* untuk Ratusan */
     if (angka[i+2] != "0") {
       if (angka[i+2] == "1") {
         kata1 = "Seratus";
       } else {
         kata1 = kata[angka[i+2]] + " Ratus";
       }
     }

     /* untuk Puluhan atau Belasan */
     if (angka[i+1] != "0") {
       if (angka[i+1] == "1") {
         if (angka[i] == "0") {
           kata2 = "Sepuluh";
         } else if (angka[i] == "1") {
           kata2 = "Sebelas";
         } else {
           kata2 = kata[angka[i]] + " Belas";
         }
       } else {
         kata2 = kata[angka[i+1]] + " Puluh";
       }
     }

     /* untuk Satuan */
     if (angka[i] != "0") {
       if (angka[i+1] != "1") {
         kata3 = kata[angka[i]];
       }
     }

     /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
     if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
       subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
     }

     /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
     kaLimatComa = subkaLimat + kaLimatComa;
     i = i + 3;
     j = j + 1;

   }

   kaLimat = kaLimat.trim()+" Koma "+kaLimatComa.trim()
 }
 return "#"+kaLimat+" Rupiah#";
}
