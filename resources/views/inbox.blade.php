<link rel="stylesheet" href="<?php echo asset('css/tables.css')?>" type="text/css">
<h1><span class="blue">&lt;</span>SMSecret<span class="blue">&gt;</span> <span class="yellow">Inbox</pan></h1>

@if(count($inbox) > 0)
    <table class="container">

        <thead>
            <tr>
                <th><h1>Phone Number</h1></th>
                <th><h1>Message</h1></th>
            </tr>
        </thead>
        <tbody>

            @foreach($inbox as $i => $record)
                <tr>
                    <td>{{"".$record->phone_number}}</td>
                    <td>{{"".$record->message}}</td>
                    <td align="center"><a href="{!! ('/DeletionUnencrypted/'.$i) !!}">
                            <img src="/res/web_hi_res_512.png" height="50px" width="50px"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@else
    <h2>The Database Table is Empty!</h2>
@endif

<h1><span class="blue">&lt;</span>SMSecret<span class="blue">&gt;</span> <span class="yellow">SafeBox</pan></h1>
@if(count($safebox)>0)
    <table class="container">

    <thead>
    <tr>
        <th><h1>Phone Number</h1></th>
        <th><h1>Message</h1></th>
    </tr>
    </thead>
    <tbody>

        @foreach($safebox as $v => $record2)
                <tr>
                <td>{{"".$record2->phone_number}}</td>
                <td>{{"".$record2->message}}</td>
                    <td align="center"><a href="{!! ('/DeletionEncrypted/'.$v) !!}">
                            <img src="/res/web_hi_res_512.png" height="50px" width="50px"></a>
                    </td>
            </tr>
        @endforeach
    </tbody>

</table>
@else
    <h2>The Database Table is Empty!</h2>
@endif