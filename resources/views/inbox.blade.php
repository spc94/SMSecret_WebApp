<link rel="stylesheet" href="<?php echo asset('css/tables.css')?>" type="text/css">
<h1><span class="blue">&lt;</span>SMSecret<span class="blue">&gt;</span> <span class="yellow">Inbox</pan></h1>

@if(count($inbox) > 1)
    <table class="container">

        <thead>
            <tr>
                <th><h1>Phone Number</h1></th>
                <th><h1>Message</h1></th>
            </tr>
        </thead>
        <tbody>

            @foreach($inbox as $record)
                <tr>
                    <td>{{"".$record->phone_number}}</td>
                    <td>{{"".$record->message}}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
@else
    <h2>The Database Table is Empty!</h2>
@endif

<h1><span class="blue">&lt;</span>SMSecret<span class="blue">&gt;</span> <span class="yellow">SafeBox</pan></h1>
@if(count($safebox)>1)
    <table class="container">

    <thead>
    <tr>
        <th><h1>Phone Number</h1></th>
        <th><h1>Message</h1></th>
    </tr>
    </thead>
    <tbody>

        @foreach($safebox as $record)
                <tr>
                <td>{{"".$record->phone_number}}</td>
                <td>{{"".$record->message}}</td>
            </tr>
        @endforeach


</table>
@else
    <h2>The Database Table is Empty!</h2>
@endif