var sidenumber =1;
var week =1;

 $(document).ready(function(){
   $("#login").hide();
   $("#minsida").hide();
   $("#omoss").hide();
   $("#booking").hide();
   $("#admin").hide();
   $("#bookingStuff").hide();

  $(".selectedButton").click(function(){
     var date = $("#week").val();
     date += "/" + $("#day").val();
     date += "/" + $("#time").val();
     $("#valuDate").html(date);
   });

/******fadeIn // fadeOut page functions*********/
/*
1=home
2=login
3=minsida
4=omoss
5=booking
6=admin
7=bookingStuff

*/
$('.home').click(function(){
  pageChange();
  $('#home').fadeIn(1000);
  sidenumber=1;
  });

$('.login').click(function(){
  pageChange();
  $('#login').fadeIn(1000);
  sidenumber=2;
 });

$('.minsida').click(function(){
  pageChange();
  $('#minsida').fadeIn(1000);
  sidenumber=3;
  });

$('.omoss').click(function(){
  pageChange();
  $('#omoss').fadeIn(1000);
  sidenumber=4;
  });

$('.booking').click(function(){
  pageChange();
  $('#booking').fadeIn(1000);
  tableGenerator();
  sidenumber=5;
  });


//   $('.admin').click(function(){
//    pageChange();
//    $('#admin').fadeIn(1000);
//    sidenumber=6;
//    });
//
//   $('.bookingStuff').click(function(){
//    pageChange();
//    sidenumber=7;
//    });
/*******fadeOut function for Pages ******/
function pageChange(){
       if (sidenumber==1) { $("#home").fadeOut(500); }
  else if (sidenumber==2) { $("#login").fadeOut(500); }
  else if (sidenumber==3) { $("#minsida").fadeOut(500); }
  else if (sidenumber==4) { $("#omoss").fadeOut(500); }
  else if (sidenumber==5) { $("#booking").fadeOut(500); }
  else if (sidenumber==6) { $("#admin").fadeOut(500); }
  else{ $("#bookingStuff").fadeOut(500);}
  };

/**********Booknings sidan***************/
/*Here is the table made to booking side*/
  function tableGenerator() {
    var createBtn= '<div class="table-responsive"><table class="table"><thead><tr><th id="week">Vecka ' + week + '</th><th>Mån</th><th>Tis</th><th>Ons</th><th>Tor</th><th>Fre</th><th>Lör</th><th>Sön</th></tr></thead><tbody><tr><td class="col-sm-2">06-12</td>'
    for (var i = 1; i <= 3; i++) {
      for (var j = 1; j <= 7; j++) {
        if (i==1) {
          createBtn +='<td><button type="button" class="btn btn-success btn-lg selectedButton" id="'+ i + j + '"' + '></button></td>';
          if (j==7) {
            createBtn += '</tr><td class="col-sm-2">12-18</td>'
          }
        }
        else if (i==2) {
          createBtn +='<td><button type="button" class="btn btn-success btn-lg selectedButton" id="'+ i + j + '"' + '></button></td>';
          if (j==7) {
          createBtn += '</tr><td class="col-sm-2">18-24</td>'
          }
        }
        else if (i==3) {
          createBtn +='<td><button type="button" class="btn btn-success btn-lg selectedButton" id="'+ i + j + '"' + '></button></td>';
          if (j==7) {
          createBtn += '</tr></tbody></table></div>'
          }
        }
      }
    }
  $("#tabelplace").html(createBtn);

  $(".selectedButton").click(function(){
    var id=$(this).attr("id");
    var date = week;
    if (id>=11 && id<=17) {
      date += " 6-12 ";
      date += day(id,date);
    }
    else if (id>=21 && id<=27) {
      date += " 12-18 ";
      date += day(id,date);
    }
    else if (id>=31 && id<=37) {
      date += " 18-24 ";
      date += day(id,date);
    }
    $("#valuDate").html(date);
  });

  function day(id,date){
    if ((id == 11)  || (id==21) || (id==31)) {
        return " Måndag";
    }
    else if (id == 12  || id==22 || id==32) {
        return  " Tisdag";
    }
    else if (id == 13  || id==23 || id==33) {
        return  " Onsdag";
    }
    else if (id == 14  || id==24 || id==34) {
        return  " Torsdag";
    }
    else if (id == 15  || id==25 || id==35) {
        return  " Fredag";
    }
    else if (id == 16  || id==26 || id==36) {
        return  " Lördag";
    }
    else {
        return  " Söndag";
    }
  };
};

/*******Img animation(Blink)***********/
     for (var i = 0; i < 5; i++) {
          $(".img-thumbnail").fadeOut(500);
          $(".img-thumbnail").fadeIn(500);
        };

/***************Login*****************/
       //event handler for submit button
       $(".btn-login").click(function (e) {
         e.preventDefault();
           //collect userName and password entered by users
           var userName = $("#username").val();
           var password = $("#password").val();

           //call the authenticate function
           authenticate(userName, password);
       });

   //authenticate function to make ajax call
   function authenticate(userName, password) {

       $.ajax
       ({
           type: "POST",
           //the url where you want to sent the userName and password to
           url: "api.php",
           //dataType: 'json',
           async: false,
           //json object to sent to the authentication url
           data: '{"userName": "' + userName + '", "password" : "' + password + '"}',
           success: function (data) {

               $("#login").fadeOut(500);
               $("#minsida").fadeIn(1000);
               sidenumber=3;
               console.log(data);
           },
           error: function(OB, text, ET){
             console.log(text);
             console.log(ET);
           }
       })
     }
   });
