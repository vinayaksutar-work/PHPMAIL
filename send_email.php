<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    $to = "vinayaksutar.work@gmail.com";
    $subject = "New Enquiry From " . $name;
    
   
    $txt = "<html><head><style>
h2{
    background-color:#6f8291;
    padding:10px;
    color:white;
}
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
         
        }
        

        th {
            background-color: #f2f2f2;
        }
        a{
            color:white;
        }
        </style></head><body>";
    $txt .= "<h2>New Inquiry Received : <a>javalikarraomore.org</a></h2>";
    $txt .= "<table border='1'>";
    $txt .= " <tr>
<td><b>Name</b></td>
<td>".$name."</td>
</tr>

<tr>
<td><b>Email </b></td>
<td>".$email."</td>
</tr>

<tr>
<td><b>Message </b></td>
<td>".$message."</td>
</tr>";

    $txt .= "</table>";
    $txt .= "</body></html>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From:" . $email;

     mail($to, $subject, $txt, $headers);
      echo json_encode(["status" => "success", "message" => "Our team will respond to you shortly"]);
      

    // Continue with sending the email...
} else {
    // If the request method is not POST, return an error
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
