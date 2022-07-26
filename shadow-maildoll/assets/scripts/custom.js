jQuery(document).ready(function($){
  
    
    $(".listclass").click(function(){
      $(".listclass").addClass("active");
      $(".newclass").removeClass("active");
    });

    $(".newclass").click(function(){
      $(".newclass").addClass("active");
      $(".listclass").removeClass("active");
    });

   
  var api_all = scriptParams.API_key;
   
  console.log(api_all);


    $("#tabledata").ready(
        function(){

              var settings = {
                "url": "http://localhost/maildoll/api/contacts",
                "method": "GET",
                "timeout": 0,
                "headers": {
                "chirkut": api_all
                },
              };
              
              $.ajax(settings).done(function (response) {
                var responsedata=response;
              

                var output = '';

                for (let i = 0; i < responsedata.length; i++) {

                       
    
                    output += "<tr><td>" + responsedata[i]['id'] + "</td>" + "<td>" + responsedata[i]['name']  + "</td>" + "<td>" + responsedata[i]['email']  + "</td>" + "<td>" + responsedata[i]['phone']  + "</td></tr>";
                    
                    
                    $("#data-table").html(output);
                            
                }
                document.getElementById("preloader").style.display = 'none';

              });
               
         
          // get data

           

              // post data
            

              $("#adddataform").submit(function(e){
                e.preventDefault();
               
                var name = $("#name").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                
                var apiurl = "http://localhost/maildoll/api/store/contact?name="+name+"&email="+email+"&phone="+phone;
              
                var settings = {
                  "url": apiurl,
                  "method": "POST",
                  "timeout": 0,
                  "headers": {
                    "chirkut": api_all
                  },
                };
                
                $.ajax(settings).done(function (response) {
                  alert('data inserted');
                });

              });
         
        });

    


        $("#campaigntable").ready(
          function(){

             // get email campaign

      
             var settings = {
              "url": "http://localhost/maildoll/api/campaigns",
              "method": "GET",
              "timeout": 0,
              "headers": {
                "chirkut": api_all
               
              },
            };
            
            $.ajax(settings).done(function (response) {
              var res_campaign = response;
              console.log(res_campaign);

              var output = '';

              for (let index = 0; index < res_campaign.length; index++) {
                var type = res_campaign[index]['type'];
              
                
                // date difference
                let today = new Date().toISOString().slice(0, 10)

                const startDate  = res_campaign[index]['created_at'];
                const endDate    = today;

                const diffInMs   = new Date(endDate) - new Date(startDate)
                const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
                const roundday = Math.round(diffInDays);


                // alert( diffInDays  );

              
            
                if( type == 'email'){

                  if(res_campaign[index]['status']==1){
                    var status = "Active";
                  }else{
                    var status = "Inactive";
                  }
                
                output+="<tr><td>" + res_campaign[index]['id'] + "</td>" + "<td>" + res_campaign[index]['type'] + "</td>" + "<td>" + res_campaign[index]['name']  + "</td>" + "<td>" + res_campaign[index]['smtp_server_id']  + "</td>" + "<td>" + res_campaign[index]['template_id'] + "</td>" + "<td>" + status + "</td>" + "<td>" + roundday + " Days ago" + "</td>" + "<td>" + "<a href='' class='btn btn-danger'>Delete</a>" + "</td></tr>";
              }

                $("#campaign-table").html(output);
                
              }

              document.getElementById("preloader").style.display = 'none';
            });
          });

// Add new mail address in a campaign

          $("#addmailto").submit(function(e){
            e.preventDefault();
            var campaign= $("#campaignid").val();
            var emailinfo = $("#newemails").val();
           

            var urlpost = 'http://localhost/maildoll/api/add-emails-to-campaign?campaign_id='+campaign+'&emails=["'+emailinfo+'"]';

            

            var settings = {
              "url": urlpost,
              "method": "POST",
              "timeout": 0,
              "headers": {
                "chirkut": api_all
              },
            };
            
             $.ajax(settings).done(function (response) {
               var succeass =  response;
             });


             $("#postreport").html("succeass");

          }); 



          // dynamic campaign select

          $(".form-group").ready(function(){

           
            var settings = {
              "url": "http://localhost/maildoll/api/campaigns",
              "method": "GET",
              "timeout": 0,
              "headers": {
                "chirkut": api_all
                
              },
            };
            
            $.ajax(settings).done(function (response) {
              var res_campaign = response;
              
              var output = '';

              
              output +='<option></option>';

              for (let index = 0; index < res_campaign.length; index++) {
                res_campaign[index]['id']
                output+="<option value='"+ res_campaign[index]['id'] +"'>"+ res_campaign[index]['id'] +"</option>";

                $("#campaignid").html(output);
                $("#campaignid2").html(output);
                
              }

            });

          });

          // execute a campaign 

            $("#executecampaign").submit(function(e){
              e.preventDefault();
              var campaign= $("#campaignid").val();
             
              http://localhost/maildoll/api/campaign/send-email?campaign_id=3

              var urlpost = "http://localhost/maildoll/api/campaign/send-email?campaign_id="+campaign;

              console.log(urlpost);

              var settings = {
                "url": urlpost,
                "method": "GET",
                "timeout": 0,
                "headers": {
                "chirkut": api_all
                  
                }
              };
              
              $.ajax(settings).done(function (response) {
                

                $("#postreport").html("succeass");
              
              });

              

            });


            // create schedule

            $("#schedulecam").submit(function(e){
              e.preventDefault();
              var campaignid = $("#campaignid").val();
              var campaign_date = $("#start").val();
              var campaign_time = $("#appt").val();

              

              var mydate = new Date(campaign_date);
              var datestring = mydate.toDateString();
              var parts = datestring.split(' ');
              console.log("part1:", parts[0]);
              console.log("part2:", parts[1]);
              console.log("part3:", parts[2]);
              console.log("part4:", parts[3]);

              


              var scheduleurl = "http://localhost/maildoll/api/campaign/schedule-email?date="+parts[2]+" "+parts[1]+","+parts[3]+"&time="+campaign_time+"&campaign_id="+campaignid;

              var settings = {
                "url": scheduleurl,
                "method": "POST",
                "timeout": 0,
                "headers": {
                  "chirkut": api_all
                },
              };
              
              $.ajax(settings).done(function (response) {
                $("#report").html("Schedule Successfuly Created.");
              });

            });


            $("#campaignsmstable").ready(
              function(){
    
                 // get sms campaign
    
                 var settings = {
                  "url": "http://localhost/maildoll/api/campaigns",
                  "method": "GET",
                  "timeout": 0,
                  "headers": {
                    "chirkut": api_all
                   
                  },
                };
                
                $.ajax(settings).done(function (response) {
                  var res_campaign = response;
                
    
                  var output = '';
    
                  for (let index = 0; index < res_campaign.length; index++) {
                    var type = res_campaign[index]['type'];
                   

                    // date difference
                let today = new Date().toISOString().slice(0, 10)

                const startDate  = res_campaign[index]['created_at'];
                const endDate    = today;

                const diffInMs   = new Date(endDate) - new Date(startDate)
                const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
                const roundday = Math.round(diffInDays);


                // alert( diffInDays  );


                    if( type == 'sms'){
                      if(res_campaign[index]['status']==1){
                        var status = "Active";
                      }else{
                        var status = "Inactive";
                      }
                    
                    output+="<tr><td>" + res_campaign[index]['id'] + "</td>" + "<td>" + res_campaign[index]['type'] + "</td>" + "<td>" + res_campaign[index]['name']  + "</td>" + "<td>" + res_campaign[index]['smtp_server_id']  + "</td>" + "<td>" + res_campaign[index]['template_id'] + "</td>" + "<td>" + status + "</td>" + "<td>" + roundday + " Days ago" + "</td>" + "<td>" + "<a href='' class='btn btn-danger'>Delete</a>" + "</td></tr>";
                  }
    
                    $("#campaign-sms-table").html(output);
                    
                  }
    
                });
              });


        // add phone number to a campaign

              $("#addphoneto").submit(function(e){
                e.preventDefault();
                var campaign= $("#campaignid").val();
                var newphoneno = $("#newphoneno").val();
                var countrycode = $("#countrycode").val();
               
    
                var urlpost = 'http://localhost/maildoll/api/add-mobiles-to-campaign?campaign_id='+campaign+'&phones=["'+newphoneno+'"]&country_code=["'+countrycode+'"]';

    
                var settings = {
                  "url": urlpost,
                  "method": "POST",
                  "timeout": 0,
                  "headers": {
                    "chirkut": api_all
                  },
                };
                
                $.ajax(settings).done(function (response) {
                  console.log(response);
                });
    
    
                 $("#postreport").html("succeass");
    
              }); 


            // $("#apiform").submit(function(e){
            //   e.preventDefault();
            //   var appkey = $("#sd_appkey").val();
            //   var appsecretkey = $("#sd_app_secret_key").val();
            //   console.log(appkey, appsecretkey);

            //   var apikey = generateApiKey();

            //   function generateApiKey($appkey, $appsecretkey){
    
            //     return hash_hmac('sha256',$appkey.date('Y'), appsecretkey);
            //     // algorithm, data . year, key
            //     }

               
            //     console.log(apikey);
            //     $("#apikey").html(apikey);
            // });






});