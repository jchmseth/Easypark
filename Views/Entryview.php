<!DOCTYPE html>
<html>
<head>
	<title>RFID Entry System</title>
	 <style>
        .card {
        margin-bottom: 20px;
        }
        
        #result {
        margin-top: 20px;
        }
        #time, #date {
        font-size: 20px;
        margin-bottom: 10px; /* Changed from 20px */
        color: #144272;
        font-family: 'Noto Sans JP', sans-serif;
        }
        .row{
        font-size: 20px;
        margin-bottom: 30px; /* Changed from 20px */
        margin-top: 100px;
        color: #144272;
        font-family: 'Noto Sans JP', sans-serif;
        
        }
        .container {
          margin-top: 50px; /* adjust the value as needed */
          margin-bottom: 50px; /* adjust the value as needed */
        }
        .container span {
          display: inline-block;
        }
        
    </style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet">
	
	<script>
        $(document).ready(function(){
            $('#rfid_data').on('keydown', function(event) {
                        if (event.keyCode === 13) { // 13 is the code for the Enter key
                            event.preventDefault();
                    $.ajax({
                        url: '<?php echo base_url('public/EntryController/read'); ?>',
                        type: 'POST',
                        data: $('#rfid-form').serialize(),
                        dataType: 'json',
                        success: function(data){
                           
                            if(data.status === 'success'){
        
                                $('#entryTime').text(data.entry_time);
                                
                                $('#parkingDetails').show();
                                $('#result').text(data.message);
                                
                                
                            }else if(data.status === 'invalid'){
                                $('#response-modal .modal-title').text('Error');
                                $('#response-modal .modal-body').html(data.message);
                                $('#response-modal').modal('show');
                            }
                            else{
                                // Display user already left message in the error modal
                              $('#response-modal .modal-title').text('Error');
                              $('#response-modal #response-message').html(data.message);
                              $('#response-modal').modal('show');
                            }
                           
                        }
                    });
                }
            });
        });
        
//Script for reloading Controller
        
        	$(document).ready(function() {
            updateClock(); // Call the function initially to start updating the clock
        
            setInterval(function(){
                $.ajax({
                    url: '<?php echo base_url('/public/EntryController/'); ?>',
                    type: 'GET',
                    success: function(response) {
                        location.reload();
                    },
                    error: function() {
                        console.log('Error: Unable to connect to the server.');
                    }
                });
            }, 10000); // Check for updates every 7 seconds
        
            });
        
//Script for Liveclock
        
            function updateClock() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var month = currentTime.getMonth() + 1; // Add 1 to the month index to get the correct month (0 = January)
            var day = currentTime.getDate();
            var year = currentTime.getFullYear();
        
            // Add leading zeros to hours, minutes, and seconds if they are less than 10
            hours = (hours < 10 ? "0" : "") + hours;
            minutes = (minutes < 10 ? "0" : "") + minutes;
            seconds = (seconds < 10 ? "0" : "") + seconds;
        
            // Update the time and date in the view
            $('#time').text(hours + ":" + minutes + ":" + seconds);
            $('#date').text(month + "/" + day + "/" + year);
        
            // Call this function again after 1 second
            setTimeout(updateClock, 1000);
            }

	        </script>
	
</head>
<body>
	    <div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="card">
               <div class="card-header" style="background-image: url('2.png'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; font-size: 20px; margin-bottom: 10px; color: #fff; font-family: 'Noto Sans JP', sans-serif;">
    <h5 class="text-center" style="font-size: 32px;">RFID Entry System</h5>
    <div class="card-body">
        <form id="rfid-form">
            <div class="form-group">
                <label for="rfid_data">Scan RFID Tag:</label>
                <input type="text" class="form-control" id="rfid_data" name="rfid_data" required autofocus>
            </div>
        </form>
    </div>
</div>

			    
			    <div class="container">
  <div>
    Current Time: <span id="time"></span>
  </div>
  <div>
    Current Date: <span id="date"></span>
  </div>
    <div class="text-center">
            <div id="result"></div>
            </div>
            <div class="text-center">
                <div id="parkingDetails" style="display: none;">
                    <p>Entry Time: <span id="entryTime"></span></p>
                </div>
                </div>
</div>
	</div>
			
			</div>
		</div>
	</div>

<div class="modal fade" id="response-modal" tabindex="-1" role="dialog" aria-labelledby="response-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="response-modal-label"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="response-message">
      </div>
    </div>
  </div>
</div>

</body>
</html>