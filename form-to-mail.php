<?php
if(!isset($_POST)['submit'])
{
  echo "error.You need to submit the form";
}
$name=$_POST['name'];
$visitor_email=$_POST['email-id'];
$address=$_POST['address'];
if(empty($name)||empty($visitor_email))
{
  echo "these fields are mandatory";
  exit;
}
if(IsInjected($visitor_email))
{
  echo "bad email value";
  exit;
}
$email_from='monemsa@live.com';
$email_subject="NEw form submission";
$email_body="you have received a new detail of service from use $name.\n"."With Email-id $visitor_email.\n"."Residing in $address";
$to= "monemsa@live.com";
$headers="From:$email_from \r\n";
$headers .= "Reply-To:$visitor_email \r\n";

//send email
mail($to,$email_subject,$email_body,$headers);
header('location: thank-you.html');

function IsInjected($str)
{
  $ininjections= array('(\n+)'),
                       '(\r+)',
                       '(\t+)',
                       '(%0A+)',
                       '(%0D+)',
                       '(%08+)',
                       '(%09+)'
                     );
$inject= join('|',$ininjections);
$inject="/$inject/i";
if(preg_match($inject,$str))
{
  return true;
}
              else {
                return false;
              }
}

?>
