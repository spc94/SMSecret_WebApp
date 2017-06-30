<link rel="stylesheet" href="<?php echo asset('css/tables.css')?>" type="text/css">
<form action="/action_page.php">
    Phone Number: <input type="tel" name="phone" value="Mickey"><br>
    Message: <input type="text" name="msg" value="Mouse"><br>
    <input type="submit" value="Submit">
</form>


<h1><span class="blue">&lt;</span>SMSecret<span class="blue">&gt;</span> <span class="yellow">Send SMS</pan></h1>

@if($sent == "1")
    <h2>Message Sent!</h2>
@endif

@if($sent == "2")
    <h2>Invalid number or empty message!</h2>
@endif

<div align="center" method="get" action="/sendSms">
    <form class="form">
        <p class="name">
            <input type="tel", name="phone"/>
            <label for="tel">       Phone Number </label>
        </p>

        <p class="text">
            <textarea name="text"></textarea>
        </p>

        <p class="submit">
            <input type="submit" value="Send">
        </p>

    </form>
</div>