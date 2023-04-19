<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PDF File</title>
</head>
<style>
    h1{
        text-align: center;
    }
</style>
<body>
    <h1>Blue Sky</h1>
    <h2>Agreement:</h2>
    <h3>Duration: {{$contract->start_date}} until {{$contract->end_date}}</h3>
    <h3>Price: {{$contract->price}} euro/kg</h3>
    <h3>Departlocatioin: {{$contract->depart_location}} airport</h3>
    <h3>Endlocation: {{$contract->destination_location}} airport</h3>
    <h5>Signature of both parties indicate the acceptance of this agreement</h5>
    <h4>Jef Manager</h4>
    <h4>Blue Sky general manager</h4>
    <h4>Signature:</h4>
    <h4></h4>
    <h4></h4>
    <h4>Client name:</h4>
    <h4>Client position:</h4>
    <h4>Signature:</h4>
</body>
</html>