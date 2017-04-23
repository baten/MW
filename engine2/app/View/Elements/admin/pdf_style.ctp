<?php
echo $this->Html->css(
    [
        '/bootstrap/css/bootstrap.min',
        '/bootstrap/css/bootstrap-theme.min',
        'uy-sys',
        '/jquery-ui/jquery-ui.min',
        '/froala-editor/css/font-awesome.min',
        '/froala-editor/css/froala_editor.min'
    ]
);
echo $this->fetch('css');
?>
<style type="text/css" rel="stylesheet">
    body {
        background-color: #ffffff;
        font-size: 9px;
    }

    h3 {
        font-size: 1.5em;
    }

    table {
        width: 100%;
        border-spacing: 0px;
        border-collapse: separate;
        margin: 0px;
        padding: 0px;
        overflow: wrap;
    }

    table tr,table td {
        margin: 0px;
        padding: 3px;
    }


    .table tr:nth-child(odd) td {
        background-color: #F5F5F5;
        color: #222222;
    }

    .table tr:nth-child(even) td {
        background-color: #efefef;
        color: #222222;
    }

    .table thead tr td, .table thead tr th {
        background-color: #e0e0e0;
        border: 1px solid #ccc;
        padding: 7px 5px;
        font-size: 9px;
    }

    .col-md-4 {
        width: 27%;
        float: left;
    }
</style>