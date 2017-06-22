<link rel="stylesheet" href="<?php echo asset('css/tables.css')?>" type="text/css"
      xmlns:width="http://www.w3.org/1999/xhtml">
<div>

    <meta http-equiv="refresh" content="2" >
    <h1><span class="blue">&lt;</span>SMSecret<span class="blue">&gt;</span> <span class="yellow">WebApp</pan></h1>
    <h2> Created by <a href="http://github.com/spc94" target="_blank">Diogo Monteiro</a></h2>
</div>



<div align="center">
    {!! QrCode::size(400)->generate($writer); !!}
</div>



