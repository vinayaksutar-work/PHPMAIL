<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css"> 
<title>Send Email</title>
</head>
<body>
    <div class="container my-5 ">
    <h2>Send Email</h2>
    <form action="send_email.php" method="post" id="contactForm">
        <label>Name</label>
        <input type="text" id="name" name="name" class="form-control">
        <label>Email:</label>
        <input type="email" id="email" name="email" class="form-control">
        <label>Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" class="form-control"></textarea>
        <input type="submit" value="Send Email" id="saveButton" class="btn btn-primary my-3 ">
    </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#saveButton").click(function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var message = $('#message').val();
            var email = $('#email').val();

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            //var mobileRegex = /^\d{10}$/;
            if (name == '') 
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Enter Your Name.',
                });
            }
            // else if (!mobileRegex.test(mobile)) 
            // {
            //   Swal.fire({
            //     icon: 'error',
            //     title: 'Invalid Mobile Number',
            //     text: 'Please enter a 10-digit mobile number.',
            //     showConfirmButton: false,
            //     timer: 2000
            //   });
            // }
            else if (email == '') 
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Enter Your Email ID.',
                });
            }
             else if (!emailRegex.test(email))
              {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address.',
                    showConfirmButton: false,
                    timer: 2000
                });
            } 
            else if (message == '') 
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Enter Your Message.',
                });
            } 
            else 
            {
              $.ajax({
                type: "POST",
                url: "send_email.php",
                data: {
                  name: name,
                  message: message,
                  email: email
                },
            dataType: "json",
            beforeSend: function() {

              $("#saveButton").attr("disabled", "true");
            },
            success: function(response) {
              // Display SweetAlert based on the server response
              if (response.status === "success") 
              {
                Swal.fire({
                  icon: 'success',
                  title: 'We have received your inquiry!',
                  text: response.message,
                });
              } 
              else 
              {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: response.message,
                });
              }
              $('#contactForm')[0].reset();
              $('#exampleModal').modal('hide');
              $("#saveButton").removeAttr("disabled");
            },
            error: function() 
            {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing your request.',
              });
            }
          });

        }

      });
    });
</script>
</body>
</html>

 
