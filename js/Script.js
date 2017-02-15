var sidenumber =1;
var week =1;
var id;

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

/******fadeIn page functions*********/
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

//Förberedelse ifall man skulle hinna med
//   $('.admin').click(function(){
//    pageChange();
//    $('#admin').fadeIn(1000);
//    sidenumber=6;
//    });

$('.bookingStuff').click(function(){
 pageChange();
 sidenumber=7;
 });

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
  availableTime();
  $(".selectedButton").click(function(){
    id=$(this).attr("id");

    var date = "";
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
    $("#valuDate").html(week + date);

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

  $(".weekbtn").click(function(){
    weekbtnid=$(this).attr("id");
    if (weekbtnid==="prevWeekBtn") {
      if (week<=1) {
          week =52
          tableGenerator();
      }
      else {
          week--;
          tableGenerator();
      }
    }
    else {
      if (week>=52) {
        week=1;
        tableGenerator();
      }
      else {
        week++;
        tableGenerator();
      }
    }
  });

function availableTime() {
  // $.ajax({
  //     type:'GET',
  //     url:"http://tvattapi.php",
  //     dataType:'json',
  //     data:"idnr:id",
  //     success:function(feed) {
  //
  //     },
  //     error: function(OB, text, ET){
  //       console.log(text);
  //       console.log(ET);
  //     }
  // });
  //hämta alla tider på denna veckan
  //foreach loop som kontrollerar ifall tiden är bokad eller inte.

  //var times = json.pars();

    // if (true) {
    //
    //   $("#").removeClass("btn-danger").addClass("btn-success");
    // }
    // else {
    //   $("#").removeClass("btn-success").addClass("btn-danger");
    // }
}


/*boka tvättid*/
$("#comfirm").click(function(){
  console.log(week +" "+ id);
    $.ajax({
        type: "POST",
        //the url where you want to sent the userName and password to
        url: "http://bokatvattidapi.php", //en annan URL ska det vara
        dataType: 'json',
        //json object to sent to the authentication url
        data: {"idnr": id },
        success: function (data) {
          console.log(data.id);
          console.log(data);
          if (data.idnr===true) {
            console.log();
                $("#"+id).removeClass("btn-success").addClass("btn-danger");//ändra till knappen med det id till btn-danger class i stället för btn success;
          }
          else {
            alert("This time is taken");
          }

        },
        error: function(OB, text, ET){
          console.log(text);
          console.log(ET);
        }
    });
});

$("#delete").click(function(){
  console.log(week +" "+ id);
    $.ajax({
        type: "POST",
        //the url where you want to sent the userName and password to
        url: "http://deletetvattidapi.php", //en annan URL ska det vara
        dataType: 'json',
        //json object to sent to the authentication url
        data: {"idnr": id },
        success: function (data) {
          console.log(data.id);
          console.log(data);
          if (data.idnr===true) {
            console.log("Time removed");
                $("#"+id).removeClass("btn-danger").addClass("btn-success");//ändra till knappen med det id till btn-danger class i stället för btn success;
          }
          else {
            alert("This time is taken");
          }

        },
        error: function(OB, text, ET){
          console.log(text);
          console.log(ET);
        }
    });
});


/*******Img animation(Blink)***********/
     for (var i = 0; i < 5; i++) {
          $(".img-thumbnail").fadeOut(500);
          $(".img-thumbnail").fadeIn(500);
        };

/***************Login*****************/
$body = $("body");
function loadingScreen(){
  $(document).on({
    ajaxStart: function() { $body.addClass("loading");},
    ajaxStop: function() { $body.removeClass("loading");}
  });
};

       //event handler for submit button
       $(".btn-login").click(function (e) {
         e.preventDefault();
         loadingScreen();
           //collect userName and password entered by users
           var user = $(".username").val();
           var pwd = $(".password").val();
           //call the authenticate function
           authenticate(user, pwd);
       });

   //authenticate function to make ajax call
   function authenticate(user, pwd) {

       $.ajax({
           type: "POST",
           //the url where you want to sent the userName and password to
           url: "http://api.php", //ändra url
           dataType: 'json',
           //json object to sent to the authentication url
           data: {user : user , pwd : pwd},
           success: function (data) {
             if ((data.user === true)&&(data.pwd === true)) {
               $("#login").fadeOut(500);
               $("#minsida").fadeIn(1000);
               sidenumber=3;
             }
             else {
               alert("Fel Användarnamn eller Lösenord")
             }
                        },
           error: function(OB, text, ET){
             console.log(text);
             console.log(ET);
           }
       })
     };

     /***********Logout**********************/
     $(".logout").click(function() {
            $.ajax({
                url: 'http://logout.php',
                success: function(data){
                    window.location.href = data;
                }
            });
        });
   });//document ready end tag
